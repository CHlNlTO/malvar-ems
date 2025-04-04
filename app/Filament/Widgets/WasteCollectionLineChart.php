<?php

// app/Filament/Widgets/WasteCollectionLineChart.php

namespace App\Filament\Widgets;

use App\Models\WasteCollectionRecord;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class WasteCollectionLineChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Waste Collection Trends';

    protected function getType(): string
    {
        return 'line';
    }

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? Carbon::now()->subMonths(3);
        $endDate = $this->filters['endDate'] ?? Carbon::now();
        $barangayId = $this->filters['barangay_id'] ?? null;

        $records = WasteCollectionRecord::query()
            ->join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->when($barangayId, function ($query, $barangayId) {
                return $query->where('garbage_collection_schedules.barangay_id', $barangayId);
            })
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->select(
                DB::raw('DATE_FORMAT(garbage_collection_schedules.collection_date, "%Y-%m-%d") as collection_date'),
                DB::raw('SUM(total_volume) as total_volume')
            )
            ->groupBy('collection_date')
            ->orderBy('collection_date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Waste (kg)',
                    'data' => $records->pluck('total_volume')->toArray(),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $records->pluck('collection_date')->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Waste Volume (kg)',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Date',
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
