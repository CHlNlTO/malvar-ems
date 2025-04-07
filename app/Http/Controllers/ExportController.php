<?php

namespace App\Http\Controllers;

use App\Exports\WasteCollectionReportExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportWasteReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $barangayId = $request->input('barangay_id');

        $filename = 'waste_collection_report';
        if ($barangayId) {
            $filename .= '_barangay_' . $barangayId;
        }
        $filename .= '_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(
            new WasteCollectionReportExport($startDate, $endDate, $barangayId),
            $filename
        );
    }
}
