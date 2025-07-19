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
        $requestJson = $this->request->getJSON();
        $From = $requestJson->From ?? null;
        $To = $requestJson->To ?? null;
        $Company = $requestJson->Company ?? null;
        $clientId = $requestJson->clientId;
        
        session()->set('From', $From); 
        session()->set('To', $To); 
        session()->set('Company', $Company);  
        session()->set('Client', $clientId);  
        
        return $this->response->setJSON([
            'payslipUrl' => base_url('Payroll/payslip_pdf')
        ]);
    }

    public function payslip_pdf(){ 
        // Load TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();
        
        $Company = session('Company');
        $From = session('From');
        $To = session('To');
        $clientId = session('Client');
        
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

    public function GetSelectedLogsData()
    {
        $requestJson = $this->postRequest->getJSON(); 
        $references = $requestJson->references;

        $refArray = [];

        foreach ($references as $refObj) {
            $refArray[] = (int) $refObj->reference;
        }

        $referenceString = implode(',', $refArray);

        $data = [
            "References" => $referenceString,
            "data" => $this->PayrollModel->getselectedlogsdata($referenceString)
        ];

        return $this->response->setJSON($data);
    }

    public function SaveValidatedLogs(){
        $requestJson = $this->postRequest->getJSON(); 
        $references = $requestJson->references;

        $result = $this->PayrollModel->getselectedlogsdata($references);
            
        foreach($result as $row) {

            $this->validate_logs_main($row->CUT_Ref_No, $row->CUT_Client_ID);
            
            $data[] = [
                "VPDL_Emp_No" => $row->CUT_Client_ID,
                "VPDL_Company" => $row->CUT_Company_Code,
                "VPDL_Date_From" => $row->CUT_From,
                "VPDL_Date_To" => $row->CUT_To,
                "VPDL_Department" => $row->CUT_Dept,
                "VPDL_Late" => $row->CUT_Late,
                "VPDL_Under" => $row->CUT_Undertime,
                "VPDL_Abs" => $row->CUT_Absent,
                "VPDL_LHrs" => $row->CUT_LHrs,
                "VPDL_WHrs" => $row->CUT_WHrs,
                "VPDL_NP" => $row->CUT_NP,
                "VPDL_NP_Amount" => $row->CUT_NP_Amount,
                "VPDL_OverBreak" => $row->CUT_Ovrbreak,
                "VPDL_Total_Overbreak" => $row->CUT_Ovrbreak_Amount,
                "VPDL_RWD_Ovt" => $row->CUT_RWD_Ovt,
                "VPDL_RWD_Ovt_Amount" => $row->CUT_RWD_Ovt_Amount,
                "VPDL_RWD_Ovt8" => $row->CUT_RWD_Ovt8,
                "VPDL_RWD_Ovt8_Amount" => $row->CUT_RWD_Ovt8_Amount,
                "VPDL_RWD_NP" => $row->CUT_RWD_NP,
                "VPDL_RWD_NP_Amount" => $row->CUT_RWD_NP_Amount,
                "VPDL_RWD_NP8" => $row->CUT_RWD_NP8,
                "VPDL_RWD_NP8_Amount" => $row->CUT_RWD_NP8_Amount,
                "VPDL_RD_Ovt" => $row->CUT_RD_Ovt,
                "VPDL_RD_Ovt_Amount" => $row->CUT_RD_Ovt_Amount,
                "VPDL_RD_Ovt8" => $row->CUT_RD_Ovt8,
                "VPDL_RD_Ovt8_Amount" => $row->CUT_RD_Ovt8_Amount,
                "VPDL_RD_NP" => $row->CUT_RD_NP,
                "VPDL_RD_NP_Amount" => $row->CUT_RD_NP_Amount,
                "VPDL_RD_NP8" => $row->CUT_RD_NP8,
                "VPDL_RD_NP8_Amount" => $row->CUT_RD_NP8_Amount,
                "VPDL_RHNR_Ovt" => $row->CUT_RHNR_Ovt,
                "VPDL_RHNR_Ovt_Amount" => $row->CUT_RHNR_Ovt_Amount,
                "VPDL_RHNR_Ovt8" => $row->CUT_RHNR_Ovt8,
                "VPDL_RHNR_Ovt8_Amount" => $row->CUT_RHNR_Ovt8_Amount,
                "VPDL_RHNR_NP" => $row->CUT_RHNR_NP,
                "VPDL_RHNR_NP_Amount" => $row->CUT_RHNR_NP_Amount,
                "VPDL_RHNR_NP8" => $row->CUT_RHNR_NP8,
                "VPDL_RHNR_NP8_Amount" => $row->CUT_RHNR_NP8_Amount,
                "VPDL_RHRD_Ovt" => $row->CUT_RHRD_Ovt,
                "VPDL_RHRD_Ovt_Amount" => $row->CUT_RHRD_Ovt_Amount,
                "VPDL_RHRD_Ovt8" => $row->CUT_RHRD_Ovt8,
                "VPDL_RHRD_Ovt8_Amount" => $row->CUT_RHRD_Ovt8_Amount,
                "VPDL_RHRD_NP" => $row->CUT_RHRD_NP,
                "VPDL_RHRD_NP_Amount" => $row->CUT_RHRD_NP_Amount,
                "VPDL_RHRD_NP8" => $row->CUT_RHRD_NP8,
                "VPDL_RHRD_NP8_Amount" => $row->CUT_RHRD_NP8_Amount,
                "VPDL_SHNR_Ovt" => $row->CUT_SHNR_Ovt,
                "VPDL_SHNR_Ovt_Amount" => $row->CUT_SHNR_Ovt_Amount,
                "VPDL_SHNR_Ovt8" => $row->CUT_SHNR_Ovt8,
                "VPDL_SHNR_Ovt8_Amount" => $row->CUT_SHNR_Ovt8_Amount,
                "VPDL_SHNR_NP" => $row->CUT_SHNR_NP,
                "VPDL_SHNR_NP_Amount" => $row->CUT_SHNR_NP_Amount,
                "VPDL_SHNR_NP8" => $row->CUT_SHNR_NP8,
                "VPDL_SHNR_NP8_Amount" => $row->CUT_SHNR_NP8_Amount,
                "VPDL_SHRD_Ovt" => $row->CUT_SHRD_Ovt,
                "VPDL_SHRD_Ovt_Amount" => $row->CUT_SHRD_Ovt_Amount,
                "VPDL_SHRD_Ovt8" => $row->CUT_SHRD_Ovt8,
                "VPDL_SHRD_Ovt8_Amount" => $row->CUT_SHRD_Ovt8_Amount,
                "VPDL_SHRD_NP" => $row->CUT_SHRD_NP,
                "VPDL_SHRD_NP_Amount" => $row->CUT_SHRD_NP_Amount,
                "VPDL_SHRD_NP8" => $row->CUT_SHRD_NP8,
                "VPDL_SHRD_NP8_Amount" => $row->CUT_SHRD_NP8_Amount,
                "VPDL_Remarks" => $row->CUT_Remarks ?? '',
                "VPDL_Audit_User" => session('u_id'),
                "VPDL_Audit_Date" => $this->current_date(),

            ];
        }

        $response = $this->PayrollModel->insert_batch('validated_payroll_data_list', $data);

        if ($response) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Logs validated successfully"
            ]);
        } else {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "failed to validate logs"
            ]);
        }

    }

    private function validate_logs_main($reference){
        
        $employee_status = $this->PayrollModel->CheckEmployeePayrollStatus($client_id);
                
        if ($employee_status === 'Inactive') {
            $status = 'Pay Hold';
        } else {
            $status = 'Validated';
        }

        $this->PayrollModel->update_logs(["CUT_Status" => $status], $reference, 'client_uploaded_timelogs', 'CUT_Ref_No');
    }

    private function current_date(){
        $current_date = '';
        $getcurrentdate = $this->PayrollModel->getcurrentdate();
            foreach($getcurrentdate as $tmp){
                $current_date = $tmp->currentdatetime;
        }

        return $current_date;
            
    }

    public function upload_payslip()
    {
        $referenceNo = $this->request->getPost('employee');
        $file = $this->request->getFile('file');

        if (!$referenceNo || !$file || !$file->isValid() || $file->hasMoved()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid upload.'
            ]);
        }

        $uploadPath = FCPATH . 'uploads/Payslips/' . date('Y-m-d') . '/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true); 
        }

        $newName = $referenceNo . '.' . $file->getClientExtension();
        $file->move($uploadPath, $newName);

        $paysliplocation = 'uploads/Payslips/' . date('Y-m-d') . '/' . $newName;

        return $this->email_employee_payslip($referenceNo, $paysliplocation);
    }

    public function email_employee_payslip($referenceNo, $paysliplocation)
    {

        $email = \Config\Services::email();

        $email->setFrom('orglinkit@gmail.com', 'Orglink_IT');
        $email->setTo('lovereign21@gmail.com');
        $email->setSubject('Payslip for the Period');
        $email->setMessage('Please find your payslip attached.');


        $filePath = FCPATH . $paysliplocation;
        $email->attach($filePath);

        if ($email->send()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Payslip is sent successfully!'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $email->printDebugger(['headers'])
            ]);
        }
    }

    public function getemployeelist()
    {
        $requestJson = $this->postRequest->getJSON(); 
        $company = $requestJson->company;

        return $this->response->setJSON(
            $this->PayrollModel->getemployeebycompanyId($company)
        );
    }

    public function ProcessSelectedPayslip()
    {
        $data = $this->request->getJSON(true);
        $sent = 0;
        $unsent = 0;

        foreach ($data['reference'] as $ref) {
            $status = $this->email_payslip($ref['reference']);

            if ($status) {
                $sent++;
            } else {
                $unsent++;
            }
        }

        if ($sent === count($data['reference'])) {
            return $this->response->setJSON([
                "status" => "success",
                "message" => "Payslip sent successfully"
            ]);
        } else {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "$sent payslips sent, $unsent failed"
            ]);
        }
    }

    private function email_payslip($clientId)
    {
        $result = $this->PayrollModel->getemployeedetailsbyId($clientId);

        if (!$result || !isset($result[0])) {
            log_message('error', "No employee data found for ID: $clientId");
            return false;
        }

        $emp = $result[0];
        $from = $emp->CUT_From;
        $to   = $emp->CUT_To;

        $data = [
            'emp'  => $emp,
            'from' => $from,
            'to'   => $to
        ];

        $pdf = new \TCPDF();
        $pdf->AddPage();
        $html = view('Pages/Payroll/Payslip_template_view', $data);
        $pdf->writeHTML($html, true, false, true, false, '');

        $savePath = WRITEPATH . 'payslips/';
        if (!is_dir($savePath)) {
            mkdir($savePath, 0777, true);
        }

        $filename = $savePath . $emp->CUT_Client_ID . '_payslip_' . date('Ymd_His') . '.pdf';
        $pdf->Output($filename, 'F');

        $email = \Config\Services::email(true);
        $email->setFrom('orglinkit@gmail.com', 'Orglink_IT');
        $email->setTo($emp->CEL_Email);
        $email->setSubject('Your Payslip for ' . date('F Y', strtotime($from)));
        $email->setMessage("Dear " . $emp->CUT_Emp_Name . ",<br><br>Attached is your payslip for the period {$from} to {$to}.<br><br>Regards,<br>HR Team");
        $email->attach($filename);

        $sendSuccess = $email->send();

        unlink($filename);

        $email->clear(true);

        if ($sendSuccess) {
            $this->PayrollModel->update_logs(['CUT_Email_Sent' => 1], $clientId, 'client_uploaded_timelogs', 'CUT_Ref_No');
            return true;
        } else {
            log_message('error', 'Failed to send payslip to ' . $emp->CEL_Email . '. Error: ' . $email->printDebugger(['headers']));
            return false;
        }
    }

}
?>