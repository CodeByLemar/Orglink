<?php

namespace App\Helpers;

use Mpdf\Mpdf;

class MpdfHelper
{
    public function generate($html, $filename = 'document.pdf', $stream = true)
    {
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'L'
        ]);

        
        $mpdf->WriteHTML($html);

        if ($stream) {
            $mpdf->Output($filename,"I"); 
        } 
    }
}