<?php
   require_once('tcpdf_include.php');

   ob_start();
   include('Print_register_template.php');
   $html = ob_get_clean();
   
   $pdf = new TCPDF();
   $pdf->AddPage();
   $pdf->writeHTML($html, true, false, true, false, '');
   $pdf->Output('Print_Register.pdf', 'I');

?>