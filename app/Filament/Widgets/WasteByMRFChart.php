<?php

// app/Filament/Widgets/WasteByMRFChart.php

namespace App\Filament\Widgets;

use App\Models\MaterialRecyclingFacility;
use App\Models\WasteCollectionRecord;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class WasteByMRFChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Waste Collection by Material Recycling Facility';

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
            ->join('material_recycling_facilities', 'waste_collection_records.mrf_id', '=', 'material_recycling_facilities.mrf_id')
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->whereNotNull('waste_collection_records.mrf_id'); // Only records with assigned MRF

        // If a specific barangay is selected, filter by that barangay
        if ($selectedBarangayId) {
            $query->where('garbage_collection_schedules.barangay_id', $selectedBarangayId);
        }

        $records = $query->select(
            'material_recycling_facilities.name as mrf_name',
            'material_recycling_facilities.capacity',
            DB::raw('SUM(total_volume) as total_volume'),
            DB::raw('SUM(biodegradable_volume) as biodegradable'),
            DB::raw('SUM(non_biodegradable_volume) as non_biodegradable'),
            DB::raw('SUM(hazardous_volume) as hazardous')
        )
            ->groupBy('material_recycling_facilities.mrf_id', 'material_recycling_facilities.name', 'material_recycling_facilities.capacity')
            ->orderBy('total_volume', 'desc')
            ->limit(10) // Show top 10 MRFs
            ->get();

        // Calculate utilization percentages
        $utilizationData = $records->map(function ($record) use ($startDate, $endDate) {
            $daysDifference = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;
            $avgDailyWaste = $daysDifference > 0 ? $record->total_volume / $daysDifference : 0;
            $utilizationPercentage = $record->capacity > 0 ? min(($avgDailyWaste / $record->capacity) * 100, 100) : 0;
            return round($utilizationPercentage, 2);
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
                    'label' => 'Capacity Utilization (%)',
                    'data' => $utilizationData,
                    'backgroundColor' => '#8b5cf6', // Purple
                    'type' => 'line',
                    'yAxisID' => 'y1',
                    'borderColor' => '#8b5cf6',
                    'borderWidth' => 2,
                    'fill' => false,
                ],
            ],
            'labels' => $records->pluck('mrf_name')->toArray(),
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
                    'beginAtZero' => true,
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
                        'text' => 'Capacity Utilization (%)',
                    ],
                    'beginAtZero' => true,
                    'max' => 100,
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Material Recycling Facility',
                    ],
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
        ];
    }
}
