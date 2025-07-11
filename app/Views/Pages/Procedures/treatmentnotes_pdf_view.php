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
    $pdf->SetMargins(15, 20,15); // New margins
    foreach($getcurrentdate as $tmp){
        $current_date = $tmp->currentdatetime;
    }
    
    $total=0;
    $total_discounted=0;
    $html_table = '';
    $pdf->SetCellPadding(1);
    foreach($treatment_notes as $row){ 
        $clientname = $row->clientname;
        $html_table .= '  <tr>
                        <td style="border: 1px solid black;font-size: 12px;padding:100px;" align="center"><span style="">'.date("Y-m-d",strtotime($row->CPRL_Date)).'</span></td>
                        <td style="border: 1px solid black;font-size: 12px;" align="center">'.ucfirst($row->CPRL_Type).' - #'.$row->CPRL_Tooth_No.'</td>
                        <td style="border: 1px solid black;font-size: 12px;" align="center">'.$row->CPRL_Remarks.'</td> 
                    </tr>';  
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
                }

                th, td {
                    padding: 125px !important;
                }   
            </style>

            <div class="styled-div">
                <h4 align="center"  >'.strtoupper($companyname).'</h4> 
                <h5 align="center">TREATMENT NOTES</h5>
                <br>
                <table>
                    <tbody>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span style="margin-top:30px;font-weight:bold;">Client: </span><span>'.$clientname.'</span></td>
                            <td ><span align="right" style="margin-top:30px;font-weight:bold;">Date Generated: </span><span>'.date('Y-m-d h:iA',strtotime($current_date)).'</span></td>
                         
                        </tr>
                    </tbody>
                </table>
                <br>  <br>  
            </div>
            <table style="border: 1px solid black; ">
                    <thead>
                        <tr >
                            <th align="center" style="font-weight:bold; padding:10px;font-size: 12px;border: 1px solid black;">Date</th>
                            <th align="center" style="font-weight:bold; padding:10px;font-size: 12px;border: 1px solid black;">Tooth No.</th>
                            <th align="center" style="font-weight:bold; padding:10px;font-size: 12px;border: 1px solid black;">Remarks</th> 
                        </tr>
                    </thead>
                    <tbody>'; 
                    $html.=$html_table;
// <h5 >Company: </h5>

// <span align="right">Date Generated: </span><span>'.date('Y-m-d h:iA',strtotime($current_date)).'</span>
// <h5>Client: <span>'.$clientname.'</span></h5>
            $html.='</tbody> 
                </table>
            ';
    // Print text using writeHTML()
    $pdf->writeHTML($html, true, false, true, false, ''); 
    

    // Set headers
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="sample.pdf"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Expires: 0');

    // Close and output PDF document
    $pdf->Output('Treatment_Notes.pdf', 'I');
    exit;


?>