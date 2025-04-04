<?php

// app/Filament/Widgets/WasteStatsOverview.php

namespace App\Filament\Widgets;

use App\Models\WasteCollectionRecord;
use App\Models\GarbageCollectionSchedule;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class WasteStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        // Total waste collected this month
        $totalWasteThisMonth = WasteCollectionRecord::whereHas('schedule', function ($query) {
            $query->whereMonth('collection_date', Carbon::now()->month)
                ->whereYear('collection_date', Carbon::now()->year);
        })->sum('total_volume');

        // Total waste collected previous month
        $totalWastePrevMonth = WasteCollectionRecord::whereHas('schedule', function ($query) {
            $query->whereMonth('collection_date', Carbon::now()->subMonth()->month)
                ->whereYear('collection_date', Carbon::now()->subMonth()->year);
        })->sum('total_volume');

        // Calculate percentage change
        $percentageChange = $totalWastePrevMonth > 0
            ? round((($totalWasteThisMonth - $totalWastePrevMonth) / $totalWastePrevMonth) * 100, 2)
            : 0;

        // Scheduled collections this week
        $scheduledCollections = GarbageCollectionSchedule::whereBetween('collection_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->count();

        // Completed collections this week
        $completedCollections = GarbageCollectionSchedule::where('status', 'completed')
            ->whereBetween('collection_date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ])->count();

        return [
            Stat::make('Total Waste This Month', number_format($totalWasteThisMonth, 2) . ' kg')
                ->description($percentageChange >= 0
                    ? $percentageChange . '% increase from last month'
                    : abs($percentageChange) . '% decrease from last month')
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($percentageChange >= 0 ? 'danger' : 'success'),

            Stat::make('Scheduled Collections This Week', $scheduledCollections)
                ->description($scheduledCollections > 0
                    ? 'Across all barangays'
                    : 'No collections scheduled')
                ->color('warning'),

            Stat::make('Completed Collections This Week', $completedCollections)
                ->description($scheduledCollections > 0
                    ? round(($completedCollections / $scheduledCollections) * 100) . '% completion rate'
                    : 'No collections scheduled')
                ->color('success'),
        ];
    }
}
