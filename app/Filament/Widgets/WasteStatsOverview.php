<?php

// app/Filament/Widgets/WasteStatsOverview.php

namespace App\Filament\Widgets;

use App\Models\WasteCollectionRecord;
use App\Models\GarbageCollectionSchedule;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WasteStatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?string $pollingInterval = null;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? Carbon::now()->subMonths(3);
        $endDate = $this->filters['endDate'] ?? Carbon::now();
        $barangayId = $this->filters['barangay_id'] ?? null;

        // Get collection data for the selected period
        $totalWaste = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->when($barangayId, function ($query, $barangayId) {
                return $query->where('garbage_collection_schedules.barangay_id', $barangayId);
            })
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->sum('total_volume');

        // Get distribution by waste type
        $wasteByType = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->when($barangayId, function ($query, $barangayId) {
                return $query->where('garbage_collection_schedules.barangay_id', $barangayId);
            })
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('SUM(biodegradable_volume) as biodegradable'),
                DB::raw('SUM(non_biodegradable_volume) as non_biodegradable'),
                DB::raw('SUM(hazardous_volume) as hazardous')
            )
            ->first();

        // Get collection efficiency
        $collectionData = GarbageCollectionSchedule::when($barangayId, function ($query, $barangayId) {
            return $query->where('barangay_id', $barangayId);
        })
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('COUNT(*) as total_scheduled'),
                DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed'),
                DB::raw('SUM(CASE WHEN status = "missed" THEN 1 ELSE 0 END) as missed')
            )
            ->first();

        // Fix division by zero for collection efficiency
        $totalScheduled = $collectionData->total_scheduled ?? 0;
        $collectionEfficiency = $totalScheduled > 0
            ? round(($collectionData->completed / $totalScheduled) * 100, 1)
            : 0;

        // Calculate average daily collection
        $startCarbon = Carbon::parse($startDate);
        $endCarbon = Carbon::parse($endDate);
        $daysDifference = $startCarbon->diffInDays($endCarbon) + 1; // Include both start and end dates
        $avgDailyCollection = $daysDifference > 0 ? round($totalWaste / $daysDifference, 2) : 0;

        // Safety check for waste composition percentages to avoid division by zero
        $biodegradablePercent = $totalWaste > 0 ? round(($wasteByType->biodegradable / $totalWaste) * 100, 1) : 0;
        $nonBiodegradablePercent = $totalWaste > 0 ? round(($wasteByType->non_biodegradable / $totalWaste) * 100, 1) : 0;
        $hazardousPercent = $totalWaste > 0 ? round(($wasteByType->hazardous / $totalWaste) * 100, 1) : 0;

        return [
            Stat::make('Total Waste Collected', number_format($totalWaste, 2) . ' kg')
                ->description('From ' . $startCarbon->format('M d, Y') . ' to ' . $endCarbon->format('M d, Y'))
                ->color('primary'),

            Stat::make('Average Daily Collection', number_format($avgDailyCollection, 2) . ' kg')
                ->description($daysDifference . ' days in selected period')
                ->color('success'),

            Stat::make('Collection Efficiency', $collectionEfficiency . '%')
                ->description(($collectionData->completed ?? 0) . ' completed, ' . ($collectionData->missed ?? 0) . ' missed')
                ->color($collectionEfficiency >= 80 ? 'success' : ($collectionEfficiency >= 60 ? 'warning' : 'danger')),

            Stat::make('Waste Composition', 'Biodegradable: ' . $biodegradablePercent . '%')
                ->description('Non-biodegradable: ' . $nonBiodegradablePercent . '%, Hazardous: ' . $hazardousPercent . '%')
                ->color('info'),
        ];
    }
}
