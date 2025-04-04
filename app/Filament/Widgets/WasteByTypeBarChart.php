<?php

// app/Filament/Widgets/WasteByTypeBarChart.php

namespace App\Filament\Widgets;

use App\Models\WasteCollectionRecord;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class WasteByTypeBarChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Waste Collection by Type';

    protected function getType(): string
    {
        return 'bar';
    }

    protected int|string|array $columnSpan = 2;

    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? Carbon::now()->subMonths(3);
        $endDate = $this->filters['endDate'] ?? Carbon::now();
        $barangayId = $this->filters['barangay_id'] ?? null;

        // Group by month for easier visualization
        $records = WasteCollectionRecord::query()
            ->join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->when($barangayId, function ($query, $barangayId) {
                return $query->where('garbage_collection_schedules.barangay_id', $barangayId);
            })
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
            'datasets' => [
                [
                    'label' => 'Biodegradable',
                    'data' => $records->pluck('biodegradable')->toArray(),
                    'backgroundColor' => '#10b981', // Green
                ],
                [
                    'label' => 'Non-Biodegradable',
                    'data' => $records->pluck('non_biodegradable')->toArray(),
                    'backgroundColor' => '#f59e0b', // Amber
                ],
                [
                    'label' => 'Hazardous',
                    'data' => $records->pluck('hazardous')->toArray(),
                    'backgroundColor' => '#ef4444', // Red
                ],
            ],
            'labels' => $records->pluck('month')->map(function ($month) {
                return Carbon::createFromFormat('Y-m', $month)->format('M Y');
            })->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'stacked' => false,
                    'title' => [
                        'display' => true,
                        'text' => 'Waste Volume (kg)',
                    ],
                ],
                'x' => [
                    'stacked' => false,
                    'title' => [
                        'display' => true,
                        'text' => 'Month',
                    ],
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => "function(context) { return context.dataset.label + ': ' + context.parsed.y.toFixed(2) + ' kg'; }",
                    ],
                ],
            ],
        ];
    }
}
