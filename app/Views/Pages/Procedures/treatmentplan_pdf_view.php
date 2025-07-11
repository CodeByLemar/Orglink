<?php
    // Create a new PDF document
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Jayvee Javier');
    $pdf->SetTitle('Treatment Plan');
    $pdf->SetSubject('Treatment Plan'); 
    // Set default header data
    // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING); 
    // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();
    // line-height: 15px;
    // Set some content to print
    $pdf->SetMargins(25, 20,35); // New margins
    foreach($getcurrentdate as $tmp){
        $current_date = $tmp->currentdatetime;
    }
    
    $total=0;
    $total_discounted=0;
    $html_table = '';
    foreach($treatment_plan as $row){
        $clientname = $row->Client_Name;
        $html_table .= '  <tr>
                        <td style="font-size:9px;border: 1px solid black;" align="left">'.$row->proc.'</td>
                        <td style="font-size:9px;border: 1px solid black;" align="center">'.date("Y-m-d",strtotime($row->TPL_Date)).'</td>
                        <td style="font-size:9px;border: 1px solid black;" align="center">'.$row->TPL_Duration.'</td>
                        <td style="font-size:9px;border: 1px solid black;" align="center">'.$row->TPL_Tooth.'</td>
                        <td style="font-size:9px;border: 1px solid black;" align="center">'.$row->TPL_Tooth_Description.'</td>
                        <td style="font-size:9px;border: 1px solid black;" align="right">'.number_format($row->TPL_Price,2).'</td>
                        <td style="font-size:9px;border: 1px solid black;" align="right">'.number_format($row->TPL_Discounted_Price,2).'</td>
                    </tr>';
        
        $total = $total + $row->TPL_Price;
        $total_discounted = $total_discounted + $row->TPL_Discounted_Price;    
    }


    $companyname = session('Company_name');
    $html = '<style>
                body {
                    font-family: "Calibri", sans-serif;
                }

                .pdfbody {
                    text-indent: 3%; /* Indents the first line by 20 pixels */
                }

                .right-div {
                    float: right;
                    padding-right:10px;
                    margin-right:100px;
                }

                .styled-div {
                    font-size: 12px; /* Change this value to set the desired font size */ 
                    padding: 10px;  /* Optional: adds space inside the border */
                }
            </style>

            <div class="styled-div"  >
                <h5>TREATMENT QUOTATION AND PROPOSAL LETTER</h5>
                <br>
                <p>Date: <span>'.date('Y-m-d',strtotime($current_date)).'</span></p> 
                <p style="margin-bottom:15px !important;">To: <span>'.$clientname.'</span></p>
                <p>From: <span>'.$companyname.'</span></p>
                <p>Re: Treatment Plan</p>
                <br>
                <br>
                <p>Dear Mr/Ms. <span>'.$clientname.'</span></p>

                <p style="text-align: justify; text-indent: 3%;" class="pdfbody">After consultation, examination and intial diagnosis at our clinic, we would like to present to you the proposed Treatment Plan and Timeline for your case. Please be informed that this is merely and estimate and may change at any time as treatment progresses. We would like to assure you that the treatment plan is the ideal option after thorough consultations with our specialists. </p>

                <p style="text-align: justify; text-indent: 3%;" class="pdfbody">Kindly refer to the attached Annex A for the Price Estimate (Quotation) and treatment timeline.</p>

                <p style="text-align: justify; text-indent: 3%;" class="pdfbody">Please do not hesitate to ask any questions you may have regarding the proposed treatment plan, so we may explain further. We are looking forward to servicing your dental needs. </p>

                <div class="right-div" style="float: right;padding-right:10px;margin-right:100px;">
                        
                    <p>Sincerely,</p>
                    <p>_______________</p>
                    <p><i>Signature over printer name</i></p>


                    <p>Conformed by:</p>
                    <p>_______________</p>
                    <p><i>Signature over printer name</i></p>
                    <p><i>(Patients or guardian)</i></p>


                </div>
            </div>
            ';
    // Print text using writeHTML()
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();
    $html = '<style>
body {
    font-family: "Calibri", sans-serif;
}

.pdfbody {
    text-indent: 3%; /* Indents the first line by 20 pixels */
}

.right-div {
    float: right;
    padding-right:10px;
    margin-right:100px;
}

.styled-div {
    font-size: 12px; /* Change this value to set the desired font size */ 
    padding: 10px;  /* Optional: adds space inside the border */
}
</style>
<div class="styled-div">
    <h1>Annex A - Treatment Plan</h1>
    <p>To : '.$clientname.'</p>
    <p>From : '.$companyname.'</p>
    <p>Re : Treatment Plan</p>
    <p>Date : '.date('Y-m-d',strtotime($current_date)).'</p>
    <br><br>
    <table style="border: 1px solid black; ">
        <thead>
            <tr >
                <th align="center" style="font-size:10px !important;font-weight:bold; padding:10px; border: 1px solid black;">Procedure</th>
                <th align="center" style="font-size:10px !important;font-weight:bold; padding:10px; border: 1px solid black;">Date</th>
                <th align="center" style="font-size:10px !important;font-weight:bold; padding:10px;border: 1px solid black;">Duration</th>
                <th align="center" style="font-size:10px !important;font-weight:bold; padding:10px;border: 1px solid black;">Tooth No.</th>
                <th align="center" style="font-size:10px !important;font-weight:bold; padding:10px;border: 1px solid black;">Tooth Description</th>
                <th align="center" style="font-size:10px !important;font-weight:bold; padding:10px;border: 1px solid black;">Regular Price</th>
                <th align="center" style="font-size:10px !important;font-weight:bold; padding:10px;border: 1px solid black;">Discounted Price</th>
            </tr>
        </thead>
        <tbody>'; 
        $html.=$html_table;

$html.='</tbody>
        <tfoot class="treatment_tdata">
            <tr>
                <th style="font-size:10px !important;font-weight:bold; border: 1px solid black;padding:10px;" colspan="5">Total Price Estimated</th>
                <th style="font-size:10px !important;font-weight:bold; border: 1px solid black;padding:10px;" align="right">'.number_format($total,2).'</th>
                <th style="font-size:10px !important;font-weight:bold; border: 1px solid black;padding:10px;" align="right">'.number_format($total_discounted,2).'</th>
                <th></th>
            </tr>
        </tfoot>  
    </table>
    <br><br><br><br><br><br>
    <div style="border: 1px solid black;padding:100px !important  ;">
        <div style="background-color:yellow;text-align: center;">
            <span style="color:red;font-weight:bold;">NOTE</span>
        </div>
        <ol style="margin-right:100px !important;">
            <li ><p>A 50% down payment is required for multiple appointment procedure (i.e. the fabrication of dentures, crowns & bridges and placement of implants) prior to scheduling of appointments</p></li>
            <li><p>Cost estimate indicated above, is exclusive of x-rays and temporary fillings.</p></li>
        </ol>
    </div>
    
</div>';
    $pdf->writeHTML($html, true, false, true, false, '');

    // Set headers
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="sample.pdf"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Expires: 0');

    // Close and output PDF document
    $pdf->Output('Treatmentplan.pdf', 'I');
    exit;


?>