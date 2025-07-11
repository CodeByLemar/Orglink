<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

use App\Models\Reports\ReportsModel;
use App\Models\Procedures\ProceduresModel;

use App\Helpers\MpdfHelper;
class Reports extends BaseController
{ 
    protected ReportsModel $ReportsModel;
    protected IncomingRequest|CLIRequest $postRequest;
    protected MpdfHelper $MpdfHelper;
    
    public function __construct()
    {
        $this->ReportsModel = new ReportsModel();
        $this->postRequest = Services::request();
        $this->MpdfHelper = new MpdfHelper();

    }

    public function index()
    {
        $data['current_date'] = $this->ReportsModel->getcurrentdate(); 
        return view('Pages/Reports/Collection_Report_view',$data);
    }

    public function collection_report()
    {
        $data['current_date'] = $this->ReportsModel->getcurrentdate(); 
        return view('Pages/Reports/Collection_Report_view',$data);
    }

    public function getcollection_report()
    {
        $request = \Config\Services::request();
        $from = $request->getPost('from');
        $to = $request->getPost('to');

        return json_encode($this->ReportsModel->getcollection_report($from,$to));
    }

    public function gov_contribution_summary(){
        $data['current_date'] = $this->ReportsModel->getcurrentdate(); 
        return view('Pages/Reports/Gov_Contribution_Summary_view',$data);
    }

    public function payroll_summary(){
        $data['current_date'] = $this->ReportsModel->getcurrentdate(); 
        return view('Pages/Reports/Payroll_Summary_view',$data);
    }

    public function Alphalist(){
        $data['current_date'] = $this->ReportsModel->getcurrentdate(); 
        return view('Pages/Reports/Alphalist_view',$data);
    }

    public function Generate_Alphalist(){
        $request = \Config\Services::request();
        $iCompany = $request->getPost('iCompany');
        $result = $this->ReportsModel->generatealphalist($iCompany);
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
 
        $sheet->setCellValue('A1', 'tinNumber');
        $sheet->setCellValue('B1', 'branchCode');
        $sheet->setCellValue('C1', 'lastName');
        $sheet->setCellValue('D1', 'firstName');
        $sheet->setCellValue('E1', 'middleName');
        $sheet->setCellValue('F1', 'region');
        $sheet->setCellValue('G1', 'address');
        $sheet->setCellValue('H1', 'zipcode');
        $sheet->setCellValue('I1', 'birthday');
        $sheet->setCellValue('J1', 'telNumber');
        $sheet->setCellValue('K1', 'valid_Id');
        $sheet->setCellValue('L1', 'placeOfIssueOfId');
        $sheet->setCellValue('M1', 'nationality');
        $sheet->setCellValue('N1', 'employmentStatus');
        $sheet->setCellValue('O1', 'startDate');
        $sheet->setCellValue('P1', 'endDate');
        $sheet->setCellValue('Q1', 'reasonOfSeparation');
        $sheet->setCellValue('R1', 'substitutedFiling');
        $sheet->setCellValue('S1', 'prev_GrossCompensationIncome');
        $sheet->setCellValue('T1', 'prev_250KBelow');
        $sheet->setCellValue('U1', 'prev_13th_others');
        $sheet->setCellValue('V1', 'prev_deMinimis');
        $sheet->setCellValue('W1', 'prev_SSS_HDMF_Philhealth_Dues');
        $sheet->setCellValue('X1', 'prev_salariesOthers');
        $sheet->setCellValue('Y1', 'prev_totalNonTaxable');
        $sheet->setCellValue('Z1', 'prev_taxableBasicWage');
        $sheet->setCellValue('AA1', 'prev_taxable13th_others');
        $sheet->setCellValue('AB1', 'prev_taxableSalariesOthers');
        $sheet->setCellValue('AC1', 'prev_totalTaxable');
        $sheet->setCellValue('AD1', 'pres_GrossCompensationIncome');
        $sheet->setCellValue('AE1', 'pres_250KBelow');
        $sheet->setCellValue('AF1', 'pres_13th_others');
        $sheet->setCellValue('AG1', 'pres_deMinimis');
        $sheet->setCellValue('AH1', 'pres_SSS_HDMF_Philhealth_Dues');
        $sheet->setCellValue('AI1', 'pres_salariesOthers');
        $sheet->setCellValue('AJ1', 'pres_totalNonTaxable');
        $sheet->setCellValue('AK1', 'pres_taxableBasicWage');
        $sheet->setCellValue('AL1', 'pres_taxable13th_others');
        $sheet->setCellValue('AM1', 'pres_taxableSalariesOthers');
        $sheet->setCellValue('AN1', 'pres_totalTaxable');
        $sheet->setCellValue('AO1', 'totalGrossCompensationIncome');
        $sheet->setCellValue('AP1', 'netTaxableIncome');
        $sheet->setCellValue('AQ1', 'taxDue');
        $sheet->setCellValue('AR1', 'prev_taxPaid');
        $sheet->setCellValue('AS1', 'pres_taxPaid');
        $sheet->setCellValue('AT1', 'taxPaidDecember');
        $sheet->setCellValue('AU1', 'taxRefunded');
        $sheet->setCellValue('AV1', 'taxWithheldAdjusted');
        $sheet->setCellValue('AW1', 'peraAct2008');
		
        $i=2;
        foreach($result as $row){
            $sheet->setCellValue('A'.$i.'', $row->CEL_TIN);
            $sheet->setCellValue('B'.$i.'', '0');
            $sheet->setCellValue('C'.$i.'', $row->CEL_Last_Name);
            $sheet->setCellValue('D'.$i.'', $row->CEL_First_Name);
            $sheet->setCellValue('E'.$i.'', $row->CEL_Middle_Name);
            $sheet->setCellValue('F'.$i.'', $row->AL_Region);
            $sheet->setCellValue('G'.$i.'', $row->CAL_Street.' '.$row->BL_Barangay_Name.' '.$row->CM_City_Municipality_Name.' '.$row->AL_Area_Desc);
            $sheet->setCellValue('H'.$i.'', $row->CAL_Zip_Code);
            $sheet->setCellValue('I'.$i.'', $row->CEL_Birth_Date);
            $sheet->setCellValue('J'.$i.'', $row->CEL_Contact_No);
            $sheet->setCellValue('K'.$i.'', $row->CEL_SSS);
            $sheet->setCellValue('L'.$i.'', '');
            $sheet->setCellValue('M'.$i.'', $row->Cel_Citizenship);
            $sheet->setCellValue('N'.$i.'', $row->EmpStatus);
            $sheet->setCellValue('O'.$i.'', '');
            $sheet->setCellValue('P'.$i.'', $row->CEL_Contract_End_Date);
            $sheet->setCellValue('Q'.$i.'', '');
            $sheet->setCellValue('R'.$i.'', '');
            $sheet->setCellValue('S'.$i.'', '');
            $sheet->setCellValue('T'.$i.'', '');
            $sheet->setCellValue('U'.$i.'', '');
            $sheet->setCellValue('V'.$i.'', '');
            $sheet->setCellValue('W'.$i.'', '');
            $sheet->setCellValue('X'.$i.'', '');
            $sheet->setCellValue('Y'.$i.'', '');
            $sheet->setCellValue('Z'.$i.'', '');
            $sheet->setCellValue('AA'.$i.'', '');
            $sheet->setCellValue('AB'.$i.'', '');
            $sheet->setCellValue('AC'.$i.'', '');
            $sheet->setCellValue('AD'.$i.'', '');
            $sheet->setCellValue('AE'.$i.'', '');
            $sheet->setCellValue('AF'.$i.'', '');
            $sheet->setCellValue('AG'.$i.'', '');
            $sheet->setCellValue('AH'.$i.'', '');
            $sheet->setCellValue('AI'.$i.'', '');
            $sheet->setCellValue('AJ'.$i.'', '');
            $sheet->setCellValue('AK'.$i.'', '');
            $sheet->setCellValue('AL'.$i.'', '');
            $sheet->setCellValue('AM'.$i.'', '');
            $sheet->setCellValue('AN'.$i.'', '');
            $sheet->setCellValue('AO'.$i.'', '');
            $sheet->setCellValue('AP'.$i.'', '');
            $sheet->setCellValue('AQ'.$i.'', '');
            $sheet->setCellValue('AR'.$i.'', '');
            $sheet->setCellValue('AS'.$i.'', '');
            $sheet->setCellValue('AT'.$i.'', '');
            $sheet->setCellValue('AU'.$i.'', '');
            $sheet->setCellValue('AV'.$i.'', '');
            $sheet->setCellValue('AW'.$i.'', '');

            $i++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="AlphaList.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    
}

?>