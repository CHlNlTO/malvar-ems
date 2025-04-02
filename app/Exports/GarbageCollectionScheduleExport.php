<?php

// app/Exports/GarbageCollectionScheduleExport.php

namespace App\Exports;

use App\Models\GarbageCollectionSchedule;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GarbageCollectionScheduleExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        return GarbageCollectionSchedule::with('barangay');
    }

    public function headings(): array
    {
        return [
            'Schedule ID',
            'Barangay',
            'Collection Date',
            'Collection Time',
            'Status',
            'Created At',
        ];
    }

    public function map($schedule): array
    {
        return [
            $schedule->schedule_id,
            $schedule->barangay->name,
            $schedule->collection_date->format('Y-m-d'),
            $schedule->collection_time->format('h:i A'),
            ucfirst($schedule->status),
            $schedule->created_at->format('Y-m-d H:i:s'),
        ];
    }
}

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

// app/Exports/EnvironmentalClearanceExport.php

namespace App\Exports;

use App\Models\EnvironmentalClearance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EnvironmentalClearanceExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function query()
    {
        $query = EnvironmentalClearance::with('company');

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'Clearance ID',
            'Company',
            'Industry Type',
            'Submission Date',
            'Status',
            'Remarks',
        ];
    }

    public function map($clearance): array
    {
        return [
            $clearance->clearance_id,
            $clearance->company->name,
            $clearance->company->industry_type,
            $clearance->submission_date->format('Y-m-d'),
            ucfirst($clearance->status),
            $clearance->remarks ?? 'N/A',
        ];
    }
}
