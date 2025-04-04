<?php

// app/Exports/EnvironmentalClearanceExport.php

namespace App\Exports;

use App\Models\EnvironmentalClearance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class EnvironmentalClearanceExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;
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
