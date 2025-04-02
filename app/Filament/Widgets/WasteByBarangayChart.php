<?php

// app/Filament/Widgets/WasteByBarangayChart.php

namespace App\Filament\Widgets;

use App\Models\Barangay;
use App\Models\WasteCollectionRecord;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WasteByBarangayChart extends ChartWidget
{
    protected static ?string $heading = 'Waste Collection by Barangay (Current Month)';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = WasteCollectionRecord::join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->join('barangays', 'garbage_collection_schedules.barangay_id', '=', 'barangays.barangay_id')
            ->whereMonth('garbage_collection_schedules.collection_date', Carbon::now()->month)
            ->whereYear('garbage_collection_schedules.collection_date', Carbon::now()->year)
            ->select(
                'barangays.name',
                DB::raw('SUM(biodegradable_volume) as biodegradable'),
                DB::raw('SUM(non_biodegradable_volume) as non_biodegradable'),
                DB::raw('SUM(hazardous_volume) as hazardous')
            )
            ->groupBy('barangays.name')
            ->orderBy(DB::raw('SUM(total_volume)'), 'desc')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Biodegradable',
                    'data' => $data->pluck('biodegradable')->toArray(),
                    'backgroundColor' => '#10b981',
                ],
                [
                    'label' => 'Non-Biodegradable',
                    'data' => $data->pluck('non_biodegradable')->toArray(),
                    'backgroundColor' => '#f59e0b',
                ],
                [
                    'label' => 'Hazardous',
                    'data' => $data->pluck('hazardous')->toArray(),
                    'backgroundColor' => '#ef4444',
                ],
            ],
            'labels' => $data->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
