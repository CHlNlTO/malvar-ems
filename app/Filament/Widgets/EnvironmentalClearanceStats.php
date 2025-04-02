<?php

// app/Filament/Widgets/EnvironmentalClearanceStats.php

namespace App\Filament\Widgets;

use App\Models\EnvironmentalClearance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class EnvironmentalClearanceStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        // Pending clearance requests
        $pendingClearances = EnvironmentalClearance::where('status', 'pending')->count();

        // Approved clearance requests this month
        $approvedThisMonth = EnvironmentalClearance::where('status', 'approved')
            ->whereMonth('updated_at', Carbon::now()->month)
            ->whereYear('updated_at', Carbon::now()->year)
            ->count();

        // Rejected clearance requests this month
        $rejectedThisMonth = EnvironmentalClearance::where('status', 'rejected')
            ->whereMonth('updated_at', Carbon::now()->month)
            ->whereYear('updated_at', Carbon::now()->year)
            ->count();

        return [
            Stat::make('Pending Clearance Requests', $pendingClearances)
                ->description('Awaiting review')
                ->color('warning'),

            Stat::make('Approved This Month', $approvedThisMonth)
                ->description('Environmental clearances')
                ->color('success'),

            Stat::make('Rejected This Month', $rejectedThisMonth)
                ->description('Environmental clearances')
                ->color('danger'),
        ];
    }
}
