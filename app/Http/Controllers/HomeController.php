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

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get active announcements
        $announcements = Announcement::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->orderBy('order')
            ->get();

        // Get barangays
        $barangays = Barangay::orderBy('name')->get();

        // Get documents by category
        $documents = Document::where('is_active', true)
            ->orderBy('category')
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        // Get officials grouped by category
        $officials = Official::orderBy('category')
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        // Get waste collection summary
        $startDate = $request->input('start_date', Carbon::now()->subMonths(3)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        $selectedBarangayId = $request->input('barangay_id');

        // Total waste collected
        $totalWaste = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->when($selectedBarangayId, function ($query, $selectedBarangayId) {
                return $query->where('garbage_collection_schedules.barangay_id', $selectedBarangayId);
            })
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->sum('total_volume');

        // Collection efficiency
        $collectionData = GarbageCollectionSchedule::when($selectedBarangayId, function ($query, $selectedBarangayId) {
            return $query->where('barangay_id', $selectedBarangayId);
        })
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
            ->when($selectedBarangayId, function ($query, $selectedBarangayId) {
                return $query->where('garbage_collection_schedules.barangay_id', $selectedBarangayId);
            })
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('SUM(biodegradable_volume) as biodegradable'),
                DB::raw('SUM(non_biodegradable_volume) as non_biodegradable'),
                DB::raw('SUM(hazardous_volume) as hazardous')
            )
            ->first();

        // Waste collection by barangay
        $wasteByBarangay = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->join('barangays', 'garbage_collection_schedules.barangay_id', '=', 'barangays.barangay_id')
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->groupBy('barangays.barangay_id', 'barangays.name')
            ->select(
                'barangays.barangay_id',
                'barangays.name',
                DB::raw('SUM(total_volume) as total_volume')
            )
            ->orderBy('total_volume', 'desc')
            ->get();

        // Upcoming collection schedules
        $upcomingSchedules = GarbageCollectionSchedule::with('barangay')
            ->where('collection_date', '>=', now())
            ->where('status', 'pending')
            ->orderBy('collection_date')
            ->orderBy('collection_time')
            ->limit(5)
            ->get();

        return view('home', compact(
            'announcements',
            'barangays',
            'documents',
            'officials',
            'totalWaste',
            'collectionEfficiency',
            'wasteByType',
            'wasteByBarangay',
            'upcomingSchedules',
            'startDate',
            'endDate',
            'selectedBarangayId'
        ));
    }
}
