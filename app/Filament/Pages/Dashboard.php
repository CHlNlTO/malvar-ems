<?php

// app/Filament/Pages/Dashboard.php

namespace App\Filament\Pages;

use App\Models\Barangay;
use App\Models\GarbageCollectionSchedule;
use App\Models\WasteCollectionRecord;
use App\Models\EnvironmentalClearance;
use App\Models\Company;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Support\Carbon;
use App\Exports\WasteCollectionReportExport;
use App\Filament\Widgets\EnvironmentalClearanceStats;
use App\Filament\Widgets\UpcomingCollectionSchedules;
use App\Filament\Widgets\WasteStatsOverview;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Actions\Action;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportWasteReport')
                ->label('Export Waste Report')
                ->icon('heroicon-o-arrow-down-on-square')
                ->action(function (array $data): void {
                    $startDate = isset($data['start_date']) ? Carbon::parse($data['start_date']) : Carbon::now()->subMonth();
                    $endDate = isset($data['end_date']) ? Carbon::parse($data['end_date']) : Carbon::now();
                    $barangayId = $data['barangay_id'] ?? null;

                    Excel::download(
                        new WasteCollectionReportExport($startDate, $endDate, $barangayId),
                        'waste-collection-report-' . now()->format('Y-m-d') . '.xlsx'
                    );
                })
                ->form([
                    \Filament\Forms\Components\DatePicker::make('start_date')
                        ->label('Start Date')
                        ->default(Carbon::now()->subMonth()),
                    \Filament\Forms\Components\DatePicker::make('end_date')
                        ->label('End Date')
                        ->default(Carbon::now()),
                    \Filament\Forms\Components\Select::make('barangay_id')
                        ->label('Barangay (Optional)')
                        ->options(Barangay::all()->pluck('name', 'barangay_id'))
                        ->searchable(),
                ]),
        ];
    }

    public function getWidgets(): array
    {
        return [
            WasteStatsOverview::class,
            EnvironmentalClearanceStats::class,
            UpcomingCollectionSchedules::class,
        ];
    }
}
