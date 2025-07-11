<?php
   require_once('tcpdf_include.php');

   // Start output buffering
   ob_start();
   include('payslip_template.php'); // This generates the HTML
   $html = ob_get_clean();
   
   // Create PDF
   $pdf = new TCPDF();
   $pdf->AddPage("L");
   $pdf->writeHTML($html, true, false, true, false, '');
   $pdf->Output('payslip.pdf', 'I');

?>