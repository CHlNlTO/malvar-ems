<?php

// app/Exports/WasteCollectionReportExport.php

namespace App\Exports;

use App\Models\WasteCollectionRecord;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class WasteCollectionReportExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $startDate;
    protected $endDate;
    protected $barangayId;

    public function __construct($startDate = null, $endDate = null, $barangayId = null)
    {
        $this->startDate = $startDate ?? Carbon::now()->subMonth();
        $this->endDate = $endDate ?? Carbon::now();
        $this->barangayId = $barangayId;
    }

    public function query()
    {
        $query = WasteCollectionRecord::query()
            ->with(['schedule.barangay', 'collector'])
            ->whereHas('schedule', function ($query) {
                $query->whereBetween('collection_date', [$this->startDate, $this->endDate]);

                if ($this->barangayId) {
                    $query->where('barangay_id', $this->barangayId);
                }
            });

        return $query;
    }

    public function headings(): array
    {
        return [
            'Record ID',
            'Barangay',
            'Collection Date',
            'Biodegradable (kg)',
            'Non-Biodegradable (kg)',
            'Hazardous (kg)',
            'Total Volume (kg)',
            'Collector',
        ];
    }

    public function map($record): array
    {
        return [
            $record->record_id,
            $record->schedule->barangay->name,
            $record->schedule->collection_date->format('Y-m-d'),
            $record->biodegradable_volume,
            $record->non_biodegradable_volume,
            $record->hazardous_volume,
            $record->total_volume,
            $record->collector->name,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
