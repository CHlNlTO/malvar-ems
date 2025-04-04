<?php

// app/Filament/Widgets/EnvironmentalClearanceStats.php

namespace App\Filament\Widgets;

use App\Models\EnvironmentalClearance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;

class EnvironmentalClearanceStats extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?string $pollingInterval = null;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? Carbon::now()->subMonths(3);
        $endDate = $this->filters['endDate'] ?? Carbon::now();

        // Pending clearance requests
        $pendingClearances = EnvironmentalClearance::where('status', 'pending')
            ->whereBetween('submission_date', [$startDate, $endDate])
            ->count();

        // Approved clearance requests in period
        $approvedInPeriod = EnvironmentalClearance::where('status', 'approved')
            ->whereBetween('submission_date', [$startDate, $endDate])
            ->count();

        // Rejected clearance requests in period
        $rejectedInPeriod = EnvironmentalClearance::where('status', 'rejected')
            ->whereBetween('submission_date', [$startDate, $endDate])
            ->count();

        // Average processing time (days between submission and update for approved/rejected)
        $processedClearances = EnvironmentalClearance::whereIn('status', ['approved', 'rejected'])
            ->whereBetween('submission_date', [$startDate, $endDate])
            ->get();

        $totalProcessingDays = 0;
        foreach ($processedClearances as $clearance) {
            $totalProcessingDays += Carbon::parse($clearance->submission_date)->diffInDays(Carbon::parse($clearance->updated_at));
        }

        $avgProcessingTime = $processedClearances->count() > 0
            ? round($totalProcessingDays / $processedClearances->count(), 1)
            : 0;

        return [
            Stat::make('Pending Clearance Requests', $pendingClearances)
                ->description('Awaiting review')
                ->color('warning'),

            Stat::make('Approved in Selected Period', $approvedInPeriod)
                ->description('Environmental clearances')
                ->color('success'),

            Stat::make('Rejected in Selected Period', $rejectedInPeriod)
                ->description('Environmental clearances')
                ->color('danger'),

            Stat::make('Average Processing Time', $avgProcessingTime . ' days')
                ->description('From submission to decision')
                ->color($avgProcessingTime <= 7 ? 'success' : ($avgProcessingTime <= 14 ? 'warning' : 'danger')),
        ];
    }
}
