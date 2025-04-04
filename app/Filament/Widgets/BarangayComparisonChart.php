<?php

// app/Filament/Widgets/BarangayComparisonChart.php

namespace App\Filament\Widgets;

use App\Models\Barangay;
use App\Models\WasteCollectionRecord;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class BarangayComparisonChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Waste Collection by Barangay';

    protected function getType(): string
    {
        return 'bar';
    }

    protected int|string|array $columnSpan = 2;

    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? Carbon::now()->subMonths(3);
        $endDate = $this->filters['endDate'] ?? Carbon::now();
        $selectedBarangayId = $this->filters['barangay_id'] ?? null;

        $query = WasteCollectionRecord::query()
            ->join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->join('barangays', 'garbage_collection_schedules.barangay_id', '=', 'barangays.barangay_id')
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate]);

        // If a specific barangay is selected, only show that one,
        // otherwise show the top 10 by waste volume
        if ($selectedBarangayId) {
            $query->where('barangays.barangay_id', $selectedBarangayId);
        }

        $records = $query->select(
            'barangays.name',
            DB::raw('SUM(total_volume) as total_volume'),
            DB::raw('SUM(biodegradable_volume) as biodegradable'),
            DB::raw('SUM(non_biodegradable_volume) as non_biodegradable'),
            DB::raw('SUM(hazardous_volume) as hazardous')
        )
            ->groupBy('barangays.name')
            ->orderBy('total_volume', 'desc')
            ->limit($selectedBarangayId ? 100 : 10) // Show all if filtered, otherwise top 10
            ->get();

        // Calculate per capita waste for each barangay
        $barangays = Barangay::whereIn('name', $records->pluck('name'))->get()
            ->keyBy('name');

        $perCapitaData = $records->map(function ($record) use ($barangays) {
            $population = $barangays[$record->name]->population ?? 1;
            return round($record->total_volume / $population, 4);
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Waste (kg)',
                    'data' => $records->pluck('total_volume')->toArray(),
                    'backgroundColor' => '#3b82f6', // Blue
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Per Capita Waste (kg/person)',
                    'data' => $perCapitaData,
                    'backgroundColor' => '#8b5cf6', // Purple
                    'type' => 'line',
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $records->pluck('name')->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'Total Waste (kg)',
                    ],
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Per Capita (kg/person)',
                    ],
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
        ];
    }
}
