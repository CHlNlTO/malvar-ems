<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Barangay;
use App\Models\Document;
use App\Models\Official;
use App\Models\WasteCollectionRecord;
use App\Models\GarbageCollectionSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BarangayController extends Controller
{
    public function show(Request $request, $slug)
    {
        // Convert slug to barangay name format
        $name = Str::title(str_replace('-', ' ', $slug));

        // Find the barangay or abort with 404
        $barangay = Barangay::where('name', $name)->firstOrFail();

        // Get all barangays for the dropdown navigation
        $barangays = Barangay::orderBy('name')->get();

        // Get date range filters
        $startDate = $request->input('start_date', Carbon::now()->subMonths(3)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // Get officials for this barangay
        $officials = Official::where('barangay_id', $barangay->barangay_id)
            ->orderBy('category')
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        // Get upcoming collection schedules for this barangay
        $upcomingSchedules = GarbageCollectionSchedule::where('barangay_id', $barangay->barangay_id)
            ->where('collection_date', '>=', now())
            ->where('status', 'pending')
            ->orderBy('collection_date')
            ->orderBy('collection_time')
            ->limit(5)
            ->get();

        // Get barangay-specific waste collection stats
        $wasteStats = $this->getWasteStats($barangay->barangay_id, $startDate, $endDate);

        // Get waste collection comparison data (this barangay vs. municipal average)
        $comparisonData = $this->getComparisonData($barangay->barangay_id, $startDate, $endDate);

        // Get charts data
        $wasteCollectionLineData = $this->prepareWasteCollectionLineData($barangay->barangay_id, $startDate, $endDate);
        $wasteByTypeChartData = $this->prepareWasteByTypeChartData($barangay->barangay_id, $startDate, $endDate);

        // Get documents and announcements
        $documents = Document::where('is_active', true)
            ->orderBy('category')
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        $announcements = Announcement::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->orderBy('order')
            ->get();

        return view('barangays.show', compact(
            'barangay',
            'barangays',
            'officials',
            'upcomingSchedules',
            'wasteStats',
            'comparisonData',
            'wasteCollectionLineData',
            'wasteByTypeChartData',
            'documents',
            'announcements',
            'startDate',
            'endDate'
        ));
    }

    private function getWasteStats($barangayId, $startDate, $endDate)
    {
        // Total waste collected
        $totalWaste = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->where('garbage_collection_schedules.barangay_id', $barangayId)
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->sum('total_volume');

        // Collection efficiency
        $collectionData = GarbageCollectionSchedule::where('barangay_id', $barangayId)
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('COUNT(*) as total_scheduled'),
                DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed'),
                DB::raw('SUM(CASE WHEN status = "missed" THEN 1 ELSE 0 END) as missed')
            )
            ->first();

        $totalScheduled = $collectionData->total_scheduled ?? 0;
        $collectionEfficiency = $totalScheduled > 0
            ? round(($collectionData->completed / $totalScheduled) * 100, 1)
            : 0;

        // Waste by type
        $wasteByType = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->where('garbage_collection_schedules.barangay_id', $barangayId)
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('SUM(biodegradable_volume) as biodegradable'),
                DB::raw('SUM(non_biodegradable_volume) as non_biodegradable'),
                DB::raw('SUM(hazardous_volume) as hazardous')
            )
            ->first();

        // Per capita waste
        $perCapitaWaste = 0;
        $barangay = Barangay::find($barangayId);
        if ($barangay && $barangay->population > 0) {
            $perCapitaWaste = $totalWaste / $barangay->population;
        }

        return [
            'totalWaste' => $totalWaste,
            'collectionEfficiency' => $collectionEfficiency,
            'wasteByType' => $wasteByType,
            'perCapitaWaste' => $perCapitaWaste,
            'totalScheduled' => $totalScheduled,
            'completed' => $collectionData->completed ?? 0,
            'missed' => $collectionData->missed ?? 0,
        ];
    }

    private function getComparisonData($barangayId, $startDate, $endDate)
    {
        // Get municipal average data
        $municipalData = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->join('barangays', 'garbage_collection_schedules.barangay_id', '=', 'barangays.barangay_id')
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('AVG(total_volume) as avg_waste'),
                DB::raw('AVG(biodegradable_volume) as avg_biodegradable'),
                DB::raw('AVG(non_biodegradable_volume) as avg_non_biodegradable'),
                DB::raw('AVG(hazardous_volume) as avg_hazardous')
            )
            ->first();

        // Get municipal efficiency data
        $municipalEfficiency = GarbageCollectionSchedule::whereBetween('collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('COUNT(*) as total_scheduled'),
                DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed')
            )
            ->first();

        $municipalCollectionEfficiency = $municipalEfficiency->total_scheduled > 0
            ? round(($municipalEfficiency->completed / $municipalEfficiency->total_scheduled) * 100, 1)
            : 0;

        // Get barangay data
        $barangayData = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->where('garbage_collection_schedules.barangay_id', $barangayId)
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('SUM(total_volume) as total_waste'),
                DB::raw('SUM(biodegradable_volume) as biodegradable'),
                DB::raw('SUM(non_biodegradable_volume) as non_biodegradable'),
                DB::raw('SUM(hazardous_volume) as hazardous')
            )
            ->first();

        // Get barangay efficiency data
        $barangayEfficiency = GarbageCollectionSchedule::where('barangay_id', $barangayId)
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('COUNT(*) as total_scheduled'),
                DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed')
            )
            ->first();

        $barangayCollectionEfficiency = $barangayEfficiency->total_scheduled > 0
            ? round(($barangayEfficiency->completed / $barangayEfficiency->total_scheduled) * 100, 1)
            : 0;

        return [
            'municipal' => [
                'avgWaste' => $municipalData->avg_waste ?? 0,
                'avgBiodegradable' => $municipalData->avg_biodegradable ?? 0,
                'avgNonBiodegradable' => $municipalData->avg_non_biodegradable ?? 0,
                'avgHazardous' => $municipalData->avg_hazardous ?? 0,
                'collectionEfficiency' => $municipalCollectionEfficiency,
            ],
            'barangay' => [
                'totalWaste' => $barangayData->total_waste ?? 0,
                'biodegradable' => $barangayData->biodegradable ?? 0,
                'nonBiodegradable' => $barangayData->non_biodegradable ?? 0,
                'hazardous' => $barangayData->hazardous ?? 0,
                'collectionEfficiency' => $barangayCollectionEfficiency,
            ]
        ];
    }

    private function prepareWasteCollectionLineData($barangayId, $startDate, $endDate)
    {
        $records = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->where('garbage_collection_schedules.barangay_id', $barangayId)
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('DATE_FORMAT(garbage_collection_schedules.collection_date, "%Y-%m-%d") as collection_date'),
                DB::raw('SUM(total_volume) as total_volume')
            )
            ->groupBy('collection_date')
            ->orderBy('collection_date')
            ->get();

        return [
            'labels' => $records->pluck('collection_date')->map(function ($date) {
                return Carbon::createFromFormat('Y-m-d', $date)->format('M d, Y');
            })->toArray(),
            'data' => $records->pluck('total_volume')->toArray(),
        ];
    }

    private function prepareWasteByTypeChartData($barangayId, $startDate, $endDate)
    {
        $records = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->where('garbage_collection_schedules.barangay_id', $barangayId)
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('DATE_FORMAT(garbage_collection_schedules.collection_date, "%Y-%m") as month'),
                DB::raw('SUM(biodegradable_volume) as biodegradable'),
                DB::raw('SUM(non_biodegradable_volume) as non_biodegradable'),
                DB::raw('SUM(hazardous_volume) as hazardous')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'labels' => $records->pluck('month')->map(function ($month) {
                return Carbon::createFromFormat('Y-m', $month)->format('M Y');
            })->toArray(),
            'biodegradable' => $records->pluck('biodegradable')->toArray(),
            'non_biodegradable' => $records->pluck('non_biodegradable')->toArray(),
            'hazardous' => $records->pluck('hazardous')->toArray(),
        ];
    }
}
