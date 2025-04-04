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
