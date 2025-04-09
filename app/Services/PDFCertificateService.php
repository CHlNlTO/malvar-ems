<?php

namespace App\Services;

use App\Models\EnvironmentalClearance;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PDFCertificateService
{
    public function generateCertificate(EnvironmentalClearance $clearance)
    {
        // Create new PDF document
        $pdf = new Fpdi();

        // Add the template
        $pageCount = $pdf->setSourceFile(public_path('files/malvar_clearance_request_certificate.pdf'));
        $templateId = $pdf->importPage(1);

        // Add a page
        $pdf->AddPage();
        $pdf->useTemplate($templateId);

        // Set font - using core fonts which don't have encoding issues
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->SetTextColor(0, 0, 0);

        try {
            // Handle text that might contain special characters
            $companyName = $this->cleanText($clearance->company->name);
            $projectTitle = $this->cleanText($clearance->project);
            $siteLocation = $this->cleanText($clearance->site);

            // Adjusted coordinates (these will need fine-tuning based on your actual PDF)
            // Certificate number
            $pdf->SetXY(138, 92);
            $pdf->Write(0, $clearance->clearance_id);

            // Company name (This is to certify that the ___________)
            $pdf->SetXY(77, 105);
            $pdf->Write(0, $companyName);

            // Project title (Project/Activity titled)
            $pdf->SetXY(69, 118);
            $pdf->Write(0, $projectTitle);

            // Site location (to be sited at)
            $pdf->SetXY(66, 123);
            $pdf->Write(0, $siteLocation);

            // Current date
            $date = Carbon::now();
            $pdf->SetXY(97, 214);
            $pdf->Write(0, $date->day);
            $pdf->SetXY(116, 214);
            $pdf->Write(0, $date->format('F'));
            $pdf->SetXY(134, 214);
            $pdf->Write(0, $date->format('y'));

            // Output the PDF
            return $pdf->Output('S');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error("PDF Generation Error: " . $e->getMessage());

            // Return a simple PDF with an error message
            $pdf = new \FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Helvetica', 'B', 16);
            $pdf->Cell(40, 10, 'Error generating certificate');
            $pdf->Ln();
            $pdf->SetFont('Helvetica', '', 12);
            $pdf->Cell(40, 10, 'Please contact administrator.');

            return $pdf->Output('S');
        }
    }

    /**
     * Clean text to make it safe for FPDF
     */
    private function cleanText($text)
    {
        if (empty($text)) {
            return '';
        }

        // First, try using iconv to convert the text
        $cleaned = @iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $text);

        // If iconv returns false or empty, try a different approach
        if (empty($cleaned)) {
            // Remove or replace problematic characters
            $cleaned = preg_replace('/[^\x20-\x7E]/', '', $text);
        }

        return $cleaned;
    }
}
