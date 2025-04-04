<?php

namespace App\Exports;

use App\Models\WasteCollectionRecord;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;

class WasteCollectionReportExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles,
    WithDrawings,
    WithCustomStartCell,
    WithEvents
{
    protected $startDate;
    protected $endDate;
    protected $barangayId;
    protected $barangayName;

    public function __construct($startDate = null, $endDate = null, $barangayId = null)
    {
        $this->startDate = $startDate ?? Carbon::now()->subMonth();
        $this->endDate = $endDate ?? Carbon::now();
        $this->barangayId = $barangayId;

        // Get barangay name if barangay_id is provided
        if ($this->barangayId) {
            $this->barangayName = DB::table('barangays')
                ->where('barangay_id', $this->barangayId)
                ->value('name');
        }
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

    /**
     * Start the data table at row 11 to provide space for the header
     */
    public function startCell(): string
    {
        return 'A10';
    }

    /**
     * Add the Malvar logo to the worksheet
     */
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Municipality of Malvar Logo');
        $drawing->setPath(public_path('images/malvar_logo.jpg'));
        $drawing->setHeight(70);
        $drawing->setCoordinates('B2');

        return $drawing;
    }

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Get report title based on selected barangay
        $reportTitle = $this->barangayName
            ? "Waste Collection Report - {$this->barangayName}"
            : "Waste Collection Report - All Barangays";

        // Format date ranges
        $formattedStartDate = Carbon::parse($this->startDate)->format('M d, Y');
        $formattedEndDate = Carbon::parse($this->endDate)->format('M d, Y');

        // Create header with Municipality information
        $sheet->mergeCells('C2:H3');
        $sheet->setCellValue('C2', 'Municipality of Malvar');
        $sheet->getStyle('C2')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('C2')->getAlignment()->setVertical('center');

        $sheet->mergeCells('C4:H4');
        $sheet->setCellValue('C4', 'Malvar, Batangas');
        $sheet->getStyle('C4')->getFont()->setSize(12);

        $sheet->mergeCells('C5:H5');
        $sheet->setCellValue('C5', 'Municipal Environment and Natural Resources Office Malvar');
        $sheet->getStyle('C5')->getFont()->setBold(true)->setSize(12);

        // Add report title and date information
        $sheet->mergeCells('A7:H7');
        $sheet->setCellValue('A7', $reportTitle);
        $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A7')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('A8:H8');
        $sheet->setCellValue('A8', "Report Period: {$formattedStartDate} to {$formattedEndDate}");
        $sheet->getStyle('A8')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('A9:H9');
        $sheet->setCellValue('A9', "Export Date: " . Carbon::now()->format('M d, Y'));
        $sheet->getStyle('A9')->getAlignment()->setHorizontal('center');

        // Add footer
        $lastRow = $sheet->getHighestRow() + 2;
        $sheet->mergeCells("A{$lastRow}:H{$lastRow}");
        $sheet->setCellValue("A{$lastRow}", "Copyright © 2025 Malvar, Batangas, PH");
        $sheet->getStyle("A{$lastRow}")->getAlignment()->setHorizontal('center');

        $sheet->mergeCells("A" . ($lastRow + 1) . ":H" . ($lastRow + 1));
        $sheet->setCellValue("A" . ($lastRow + 1), "All Rights Reserved.");
        $sheet->getStyle("A" . ($lastRow + 1))->getAlignment()->setHorizontal('center');

        // Style the data table headers
        return [
            // Style for headers row
            10 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2FA734']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ],
        ];
    }

    /**
     * Register events for more complex formatting
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Format all cells in the data section
                $dataRange = 'A11:H' . ($sheet->getHighestRow());
                $sheet->getStyle($dataRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Apply number formatting to numeric columns
                $numericColumns = [
                    'D11:G' . $sheet->getHighestRow(), // Biodegradable, Non-Biodegradable, Hazardous, Total volume
                ];

                foreach ($numericColumns as $range) {
                    $sheet->getStyle($range)->getNumberFormat()->setFormatCode('#,##0.00');
                    $sheet->getStyle($range)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }

                // Date column formatting
                $dateColumn = 'C11:C' . $sheet->getHighestRow();
                $sheet->getStyle($dateColumn)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
                $sheet->getStyle($dateColumn)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Wrap text in text columns (Barangay, Collector)
                $textColumns = ['B11:B' . $sheet->getHighestRow(), 'H11:H' . $sheet->getHighestRow()];
                foreach ($textColumns as $range) {
                    $sheet->getStyle($range)->getAlignment()->setWrapText(true);
                }

                // Apply zebra striping to data rows
                $highestRow = $sheet->getHighestRow();
                for ($row = 11; $row <= $highestRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F2F2F2'],
                            ]
                        ]);
                    }
                }

                // Auto-size columns
                foreach (range('A', 'H') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            }
        ];
    }
}
