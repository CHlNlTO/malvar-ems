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
use App\Filament\Widgets\WasteCollectionLineChart;
use App\Filament\Widgets\WasteByTypeBarChart;
use App\Filament\Widgets\BarangayComparisonChart;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    // Configure the filters form
    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Start Date')
                            ->default(Carbon::now()->subMonths(3)),
                        DatePicker::make('endDate')
                            ->label('End Date')
                            ->default(Carbon::now()),
                        Select::make('barangay_id')
                            ->label('Barangay')
                            ->options(Barangay::all()->pluck('name', 'barangay_id'))
                            ->placeholder('All Barangays')
                            ->searchable(),
                    ])
                    ->columns(3),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportWasteReport')
                ->label('Export Waste Report')
                ->icon('heroicon-o-arrow-down-on-square')
                ->action(function () {
                    $filters = $this->getFiltersForm()->getState();

                    $startDate = $filters['startDate'] ?? Carbon::now()->subMonth();
                    $endDate = $filters['endDate'] ?? Carbon::now();
                    $barangayId = $filters['barangay_id'] ?? null;

                    return response()->streamDownload(function () use ($startDate, $endDate, $barangayId) {
                        echo Excel::raw(
                            new WasteCollectionReportExport($startDate, $endDate, $barangayId),
                            \Maatwebsite\Excel\Excel::XLSX
                        );
                    }, 'waste-collection-report-' . now()->format('Y-m-d') . '.xlsx');
                }),
        ];
    }

    public function getWidgets(): array
    {
        return [
            WasteStatsOverview::class,
            EnvironmentalClearanceStats::class,
            WasteCollectionLineChart::class,
            WasteByTypeBarChart::class,
            BarangayComparisonChart::class,
            UpcomingCollectionSchedules::class,
        ];
    }

    // Set the column span for widgets to ensure proper layout
    public function getColumns(): int|string|array
    {
        return [
            'default' => 1,
            'sm' => 2,
            'md' => 3,
            'lg' => 4,
        ];
    }
}
