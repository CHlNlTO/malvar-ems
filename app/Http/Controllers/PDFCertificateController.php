<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalClearance;
use App\Services\PDFCertificateService;
use Illuminate\Http\Request;

class PDFCertificateController extends Controller
{
    public function downloadCertificate(EnvironmentalClearance $clearance)
    {
        try {
            $pdfService = app(PDFCertificateService::class);
            $pdf = $pdfService->generateCertificate($clearance);

            return response($pdf, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="clearance_certificate_' . $clearance->clearance_id . '.pdf"',
            ]);
        } catch (\Exception $e) {
            \Log::error("PDF download error: " . $e->getMessage());
            return back()->with('error', 'Could not generate certificate. Please try again later.');
        }
    }
}
