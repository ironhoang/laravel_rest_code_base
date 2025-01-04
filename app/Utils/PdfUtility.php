<?php

namespace App\Utilities;

use \setasign\Fpdi\Tcpdf\Fpdi;

class PdfUtility
{
    public static function mergePdfFiles(string $mergedPdfFilePath, array $pdfFiles): void
    {
        $pdf = new Fpdi();

        foreach ($pdfFiles as $pdfFile) {
            $count = $pdf->setSourceFile($pdfFile);
            for ($i = 1; $i <= $count; $i++) {
                $tplIdx = $pdf->importPage($i);
                $specs = $pdf->getTemplateSize($tplIdx);
                $pdf->addPage($specs['orientation'], [$specs['width'], $specs['height']]);
                $pdf->useTemplate($tplIdx);
            }
        }

        $pdf->output($mergedPdfFilePath, 'F');
    }
}
