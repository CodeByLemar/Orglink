<?php

namespace App\Controllers\Pages;
use TCPDF;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

use App\Models\Payroll\PayrollModel; 


use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;

use App\Helpers\MpdfHelper;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Payroll extends BaseController
{
    protected PayrollModel $PayrollModel; 
    protected IncomingRequest|CLIRequest $postRequest;
    protected MpdfHelper $MpdfHelper;

    public function __construct()
    {
        $this->PayrollModel = new PayrollModel(); 
        $this->postRequest = Services::request();
        $this->MpdfHelper = new MpdfHelper();

    }

    public function index()
    {
        return view('Pages/Payroll/Payroll_view');
    }

    public function timekeeping(){
        return view('Pages/Payroll/Timekeeping_view');
    }

    public function uploadtimelogs(){
        $filename =  $this->request->getFile('timelog');
        
        $name = $filename->getName();
        $tempName = $filename->getTempName();
        $arr_file = explode(".", $name);
        $extension = end($arr_file);
        if ('csv' == $extension) {
            $reader = new Csv();
        } else {
            $reader = new excel();
        }
        $spreadsheet = $reader->load($tempName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
 
        $CompanyCode = $sheetData[0][1];
        $Datefrom = $sheetData[1][1];
        $Dateto = $sheetData[2][1];

        if (!empty($sheetData)) {
            
            for ($i = 5; $i < count($sheetData); $i++) {
                $EmpNo = $sheetData[$i][0];
                $EmpName = $sheetData[$i][1];
                $Position = $sheetData[$i][2];
                $Dept = $sheetData[$i][3];
 

                $data = array(
                    'CUT_Company_Code' => $CompanyCode,
                    'CUT_From' => date('Y-m-d',strtotime($Datefrom)),
                    'CUT_To' => date('Y-m-d',strtotime($Dateto)), 
                    'CUT_Client_ID' => $EmpNo,
                    'CUT_Emp_Name' => $EmpName,
                    'CUT_Position' => $Position,
                    'CUT_Dept' => $Dept,

                    'CUT_Late'      => $sheetData[$i][8] ?? 0,
                    'CUT_Undertime' => $sheetData[$i][9] ?? 0,
                    'CUT_Absent'    => $sheetData[$i][10] ?? 0,
                    // Allowance
                    // Seniority Allowance
                    // Stock Clerk Allowance 
                    'CUT_LHrs'      => $sheetData[$i][14] ?? 0,
                    'CUT_WHrs'      => $sheetData[$i][15] ?? 0,
                    // Daily Gross
                    // Total Allowance
                    // Total Seniority
                    // Total Store Clerk Allowance
                    // 'CUT_Hol_Pay'   => $sheetData[$i][10] ?? 0,
                    'CUT_NP'        => $sheetData[$i][20] ?? 0, 
                    // 10%
                    'CUT_Ovrbreak'  => $sheetData[$i][22] ?? 0,
                    // Total Overbreak 
                    'CUT_RWD_Ovt'   => $sheetData[$i][24] ?? 0,
                    'CUT_RWD_Ovt8'  => $sheetData[$i][26] ?? 0, 
                    'CUT_RWD_NP'    => $sheetData[$i][28] ?? 0,
                    'CUT_RWD_NP8'   => $sheetData[$i][30] ?? 0,
                    // 'CUT_RWD_NPOT'  => $sheetData[$i][17] ?? 0,

                    'CUT_RD_Ovt'    => $sheetData[$i][32] ?? 0,
                    'CUT_RD_Ovt8'   => $sheetData[$i][34] ?? 0,
                    'CUT_RD_NP'     => $sheetData[$i][36] ?? 0,  
                    'CUT_RD_NP8'    => $sheetData[$i][38] ?? 0,
                    // 'CUT_RD_NPOT'   => $sheetData[$i][22] ?? 0,

                    // 'CUT_ROT_Ovt'   => $sheetData[$i][40] ?? 0,
                    // 'CUT_ROT_Ovt8'  => $sheetData[$i][42] ?? 0,
                    // 'CUT_ROT_NP'    => $sheetData[$i][44] ?? 0, 
                    // 'CUT_ROT_NP8'   => $sheetData[$i][46] ?? 0, 
                    // 'CUT_ROT_NPOT'  => $sheetData[$i][26] ?? 0, 

                    'CUT_RHNR_Ovt'  => $sheetData[$i][40] ?? 0, 
                    'CUT_RHNR_Ovt8' => $sheetData[$i][42] ?? 0, 
                    'CUT_RHNR_NP'   => $sheetData[$i][44] ?? 0, 
                    'CUT_RHNR_NP8'  => $sheetData[$i][46] ?? 0, 
                    // 'CUT_RHNR_NPOT' => $sheetData[$i][48] ?? 0, 

                    'CUT_RHRD_Ovt'  => $sheetData[$i][50] ?? 0, 
                    'CUT_RHRD_Ovt8' => $sheetData[$i][52] ?? 0, 
                    'CUT_RHRD_NP'   => $sheetData[$i][54] ?? 0, 
                    'CUT_RHRD_NP8'  => $sheetData[$i][56] ?? 0, 
                    // 'CUT_RHRD_NPOT' => $sheetData[$i][36] ?? 0, 

                    'CUT_SHNR_Ovt'  => $sheetData[$i][58] ?? 0, 
                    'CUT_SHNR_Ovt8' => $sheetData[$i][60] ?? 0, 
                    'CUT_SHNR_NP'   => $sheetData[$i][62] ?? 0, 
                    'CUT_SHNR_NP8'  => $sheetData[$i][64] ?? 0, 
                    // 'CUT_SHNR_NPOT' => $sheetData[$i][66] ?? 0, 

                    'CUT_SHRD_Ovt'  => $sheetData[$i][66] ?? 0, 
                    'CUT_SHRD_Ovt8' => $sheetData[$i][68] ?? 0, 
                    'CUT_SHRD_NP'   => $sheetData[$i][70] ?? 0, 
                    'CUT_SHRD_NP8'  => $sheetData[$i][72] ?? 0, 
                    // 'CUT_SHRD_NPOT' => $sheetData[$i][46] ?? 0, 

                    // 'CUT_Remarks'   => $sheetData[$i][47] ?? 0, 
                    'CUT_Audit_User'=> session('u_id'), 
                );
                if($EmpNo!=''){ 

                    $duplicate = $this->PayrollModel->checkduplicatetimelogs($CompanyCode,date('Y-m-d',strtotime($Datefrom)),date('Y-m-d',strtotime($Dateto)),$EmpNo); 
                    if (!empty($duplicate)) { 
                        $CUT_Ref_No = $duplicate[0]->CUT_Ref_No;
                        $this->PayrollModel->updatetimelogs($CUT_Ref_No, $data);
                    } else {
                        $this->PayrollModel->inserttimelogs($data);
                    } 
                }

            }
        }

    }

    public function retrieveuploadedlogs(){
        try {
            $request = \Config\Services::request(); 
            
            $iCompany = $this->request->getPost('iCompany');
            $ifrom = $this->request->getPost('ifrom');
            $ito = $this->request->getPost('ito');
            return json_encode($this->PayrollModel->retrieveuploadedlogs($iCompany,$ifrom,$ito)); 
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function retrieveconvertedlogs(){
        try {
            $request = \Config\Services::request(); 
            $company = $this->request->getPost('company');
            $from = $this->request->getPost('from');
            $to = $this->request->getPost('to');
            return json_encode($this->PayrollModel->retrieveconvertedlogs($company,$from,$to));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getvalidatedlogs(){
        try {
            $request = \Config\Services::request(); 
            $company = $this->request->getPost('iCompany');
            $from = $this->request->getPost('ifrom');
            $to = $this->request->getPost('ito');
            return json_encode($this->PayrollModel->getvalidatedlogs($company,$from,$to));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generate_payslip(){
        $request = \Config\Services::request(); 
       
        $From       = $request->getPost('From');
        $To         = $request->getPost('To');
        $Company    = $request->getPost('Company');
        $Client     = $request->getPost('Client');
        session()->set('From', $From); 
        session()->set('To', $To); 
        session()->set('Company', $Company);  
        session()->set('Client', $Client);  
        
        return redirect()->to('/Payroll/payslip_pdf');
    }

    public function payslip_pdf(){ 
        // Load TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();
        
        $From       = session('From');
        $To         = session('To');
        $Company    = session('Company');
        $Client     = session('Client');
        
        $data = $this->PayrollModel->getemployeedetails($Company,$From,$To,$Client); 
        $data = [
            'emp'   => $data[0],
            'from'  => $From,
            'to'    => $To
        ];
        // $data = [
        //     'employee_name' => 'ABAY, dsads PATRICIA',
        //     'employee_id'   => '190678',
        //     'period'        => '01/01/2025 to 01/15/2025',
        //     'basic_pay'     => '9,030.00',
        //     'gross'         => '10,320.00',
        //     'net_pay'       => '10,587.70',
        // ];

        // Render view to string
        $html = view('Pages/Payroll/Payslip_template_view',$data);

       
        // Write the HTML to TCPDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Clean the output buffer (important!)
        ob_end_clean();

        // Set headers
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('payslip.pdf', 'I'); // 'I' = inline, 'D' = download
    }

    public function print_register(){
        $request = \Config\Services::request(); 
       
        $From       = $request->getPost('From');
        $To         = $request->getPost('To');
        $Company    = $request->getPost('Company'); 
        session()->set('From', $From); 
        session()->set('To', $To); 
        session()->set('Company', $Company); 
        
        return redirect()->to('/Payroll/print_register_pdf');
    }

    public function print_register_pdf(){  
        $pdf = new TCPDF('L', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
        $pdf->AddPage("L");

        $From       = session('From');
        $To         = session('To');
        $Company    = session('Company'); 

        $data = $this->PayrollModel->getprintregister($Company,$From,$To); 
        
        $data = [
            'row'   => $data,
            'emp'   => $data[0],
            'from'  => $From,
            'to'    => $To,
            'Company' => $Company
        ];
 
        $html = view('Pages/Payroll/Print_register_template_view',$data); 
        $pdf->writeHTML($html, true, false, true, false, ''); 
        ob_end_clean();
 
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('Print_register.pdf', 'I'); // 'I' = inline, 'D' = download
    }
}
?>