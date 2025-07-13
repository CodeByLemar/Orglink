<?php

namespace App\Controllers\Pages;
use TCPDF;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

use App\Models\Employee\EmployeeModel; 

use App\Helpers\MpdfHelper;

class Employee extends BaseController
{
    protected EmployeeModel $EmployeeModel; 
    protected IncomingRequest|CLIRequest $postRequest;
    protected MpdfHelper $MpdfHelper;

    public function __construct()
    {
        $this->EmployeeModel = new EmployeeModel(); 
        $this->postRequest = Services::request();
        $this->MpdfHelper = new MpdfHelper();

    }

    public function index()
    {
        return view('Pages/Employee/EmployeeInfo_view');
    }

    public function addNewEmployee(){
        try { 
            $requestJson = $this->postRequest->getJSON();

            $checkduplicate = $this->EmployeeModel->CheckEmployee($requestJson->firstName,$requestJson->lastName,$requestJson->middleName);
            if(sizeof($checkduplicate)==0){
                $data = array(
                    'CEL_Client_ID'             => $requestJson->NewClientID,
                    'CEL_BioClock_ID'           => $requestJson->NewBioClockId,
                    'CEL_Last_Name'             => $requestJson->lastName,
                    'CEL_First_Name'            => $requestJson->firstName,
                    'CEL_Middle_Name'           => $requestJson->middleName,
                    'CEL_Company'               => $requestJson->NewCompanyDesc,
                    'CEL_Dept'                  => $requestJson->NewDepartmentDesc,
                    'CEL_Position'              => $requestJson->NewPositionDesc,
                    'CEL_Section'               => $requestJson->NewSectionDesc,
                    'CEL_Emp_Status'            => $requestJson->EmpStatus,
                    'CEL_SSS'                   => $requestJson->SSS,
                    'CEL_Philhealth'            => $requestJson->Philhealth,
                    'CEL_Pagibig'               => $requestJson->HDMFNo,
                    'CEL_TIN'                   => $requestJson->TIN,
                    'CEL_Basic_Rate'            => $requestJson->Rate,
                    'CEL_Allowance'             => $requestJson->Allowance,
                    'CEL_Rate_Type'             => $requestJson->RateType,
                    'CEL_Payroll_Processing'    => $requestJson->PayrollProcessing,
                    'CEL_Payroll_Status'        => $requestJson->PayrollStatus,
                    'CEL_Premium_Share'         => $requestJson->PremiumShare,
                    'CEL_Bank'                  => $requestJson->Bank,
                    'CEL_Account_No'            => $requestJson->ATMNo,
                    'CEL_Contract_End_Date'     => $requestJson->DateExpiry,
                    'CEL_Regularization_Date'   => $requestJson->DateRegular,
                    'CEL_Audit_User'            => session('u_id'), 
    
                );
                $id = $this->EmployeeModel->addNewEmployee($data);

                $data_status_log = array(
                    'CESL_CEL_Ref_No'   => $id,
                    'CESL_Date_From'    => $requestJson->DateHired,
                    'CESL_Date_To'      => $requestJson->DateHired,
                    'CESL_Emp_Status'   => $requestJson->EmpStatus,
                    'CESL_Audit_User'   => session('u_id')
                );
                $this->EmployeeModel->addEmpStatusLog($data_status_log);

            }else{
                $msg = 'Employee is already existing in the database.';
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function EditEmployee(){
        try { 
            $requestJson = $this->postRequest->getJSON();

                $datetime = $this->EmployeeModel->getcurrentdate();
                foreach($datetime as $tmp)
                {
                    $currentdatetime = $tmp->currentdatetime;
                }
                $data = array(
                    'CEL_Client_ID'             => $requestJson->ClientID,
                    'CEL_BioClock_ID'           => $requestJson->BioClockId,
                    'CEL_Last_Name'             => $requestJson->lastName,
                    'CEL_First_Name'            => $requestJson->firstName,
                    'CEL_Middle_Name'           => $requestJson->middleName,
                    // 'CEL_Company'               => $requestJson->NewCompanyDesc,
                    // 'CEL_Dept'                  => $requestJson->NewDepartmentDesc,
                    // 'CEL_Position'              => $requestJson->NewPositionDesc,
                    // 'CEL_Section'               => $requestJson->NewSectionDesc,
                    'CEL_Emp_Status'            => $requestJson->EmpStatus,
                    'CEL_SSS'                   => $requestJson->SSS,
                    'CEL_Philhealth'            => $requestJson->Philhealth,
                    'CEL_Pagibig'               => $requestJson->HDMFNo,
                    'CEL_TIN'                   => $requestJson->TIN,
                    'CEL_Basic_Rate'            => $requestJson->Rate,
                    'CEL_Allowance'             => $requestJson->Allowance,
                    'CEL_Rate_Type'             => $requestJson->RateType,
                    'CEL_Payroll_Processing'    => $requestJson->PayrollProcessing,
                    'CEL_Payroll_Status'        => $requestJson->PayrollStatus,
                    'CEL_Premium_Share'         => $requestJson->PremiumShare,
                    'CEL_Bank'                  => $requestJson->Bank,
                    'CEL_Account_No'            => $requestJson->ATMNo,
                    'CEL_Contract_End_Date'     => $requestJson->DateExpiry,
                    'CEL_Regularization_Date'   => $requestJson->DateRegular,
                    'CEL_Audit_User'            => session('u_id'), 
                    'CEL_Audit_Date'            => $currentdatetime 
                );
                $this->EmployeeModel->EditEmployee($requestJson->Client_Ref_No,$data);

                $checkstatuslog = $this->EmployeeModel->checkStatusLog($requestJson->Client_Ref_No,$requestJson->DateHired);
                if(sizeof($checkstatuslog)==0){
                    $data_status_log = array(
                        'CESL_CEL_Ref_No'   => $requestJson->Client_Ref_No,
                        'CESL_Date_From'    => $requestJson->DateHired,
                        'CESL_Date_To'      => $requestJson->DateHired,
                        'CESL_Emp_Status'   => $requestJson->EmpStatus,
                        'CESL_Audit_User'   => session('u_id')
                    );
                    $this->EmployeeModel->addEmpStatusLog($data_status_log);
                }
                else{
                    foreach($checkstatuslog as $tmp){
                        $CESL_Ref_No = $tmp->CESL_Ref_No;
                    }
                    $data_status_log = array(
                        'CESL_CEL_Ref_No'   => $requestJson->Client_Ref_No,
                        'CESL_Date_From'    => $requestJson->DateHired,
                        'CESL_Date_To'      => $requestJson->DateHired,
                        'CESL_Emp_Status'   => $requestJson->EmpStatus,
                        'CESL_Audit_User'   => session('u_id')
                    );
                    $this->EmployeeModel->EditEmpStatusLog($CESL_Ref_No,$data_status_log);
                }
                 
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function SearchEmployee(){
        try {
            $request = \Config\Services::request();
            $searchString = $request->getPost('SearchString'); 
            return json_encode($this->EmployeeModel->SearchEmployee($searchString));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getEmployeeDetails(){
        try {
            $request = \Config\Services::request();
            $CEL_Ref_No = $request->getPost('CEL_Ref_No'); 
            return json_encode($this->EmployeeModel->getEmployeeDetails($CEL_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getProvinceList(){
        try {
            $request = \Config\Services::request(); 
            return json_encode($this->EmployeeModel->getProvinceList());
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getCityList(){
        try {
            $request = \Config\Services::request(); 
            $AL_Ref_No = $request->getPost('AL_Ref_No'); 
            return json_encode($this->EmployeeModel->getCityList($AL_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getBrgyList(){
        try {
            $request = \Config\Services::request(); 
            $CM_Ref_No = $request->getPost('CM_Ref_No'); 
            return json_encode($this->EmployeeModel->getBrgyList($CM_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function SubmitPersonalInfo(){  
        try { 
            $requestJson = $this->postRequest->getJSON();

                $datetime = $this->EmployeeModel->getcurrentdate();
                foreach($datetime as $tmp)
                {
                    $currentdatetime = $tmp->currentdatetime;
                }
                
                $data = array(

                    'CEL_Birth_Date'        => $requestJson->BirthDate,
                    'CEL_Gender'            => $requestJson->Gender,
                    'CEL_Civil_Status'      => $requestJson->CivilStatus,
                    'CEL_Email'             => $requestJson->EmailAdd,
                    'CEL_Contact_No'        => $requestJson->EmpContactNo,
                    'CEL_Height'            => $requestJson->Height,
                    'CEL_Weight'            => $requestJson->Weight,
                    'CEL_Religion'          => $requestJson->Religion, 
                    'CEL_Citizenship'       => $requestJson->Citizenship, 
                    'CEL_Children'          => $requestJson->ChildCount,

                    'CEL_Audit_User'        => session('u_id'), 
                    'CEL_Audit_Date'        => $currentdatetime 
                );
                $this->EmployeeModel->EditEmployee($requestJson->Client_Ref_No,$data); 
                
                $this->EmployeeModel->SubmitClientAddress($requestJson->Client_Ref_No,$requestJson->Province,$requestJson->City,$requestJson->Barangay,$requestJson->Street,$requestJson->ZIPCode,session('u_id'));

                function datenullchecker($date)
                {
                    if (empty($date) || $date == '1900-01-01') {
                        return null;
                    }
                    return $date;
                }
                
                $this->EmployeeModel->SubmitClientRelative($requestJson->Client_Ref_No,$requestJson->FatherName,'Father',datenullchecker($requestJson->FatherBdate),$requestJson->FatherOccupation,session('u_id'));
                $this->EmployeeModel->SubmitClientRelative($requestJson->Client_Ref_No,$requestJson->MotherName,'Mother',datenullchecker($requestJson->MotherBdate),$requestJson->MotherOccupation,session('u_id'));
                $this->EmployeeModel->SubmitClientRelative($requestJson->Client_Ref_No,$requestJson->SpouseName,'Spouse',datenullchecker($requestJson->SpouseBdate),$requestJson->SpouseOccupation,session('u_id'));
                
                $names = $requestJson->DependentName;
                $birthdates = $requestJson->DependentBdate; 
                $relations = $requestJson->DependentRelation;
                for($i=0;$i<sizeof($names);$i++){

                    $this->EmployeeModel->SubmitClientDependents($requestJson->Client_Ref_No,$names[$i],$birthdates[$i],$relations[$i],session('u_id'));
                }
                
        } catch (\Throwable $th) {
            throw $th;
        }
    } 
    
    public function SubmitMiscInfo(){
        try { 
            $requestJson = $this->postRequest->getJSON();

                $datetime = $this->EmployeeModel->getcurrentdate();
                foreach($datetime as $tmp)
                {
                    $currentdatetime = $tmp->currentdatetime;
                } 

                function datenullchecker($date)
                {
                    if (empty($date) || $date == '1900-01-01') {
                        return null;
                    }
                    return $date;
                }
                
                
                $this->EmployeeModel->SubmitClientEducBackground($requestJson->Client_Ref_No,$requestJson->Primary_School,$requestJson->Primary_School_From,$requestJson->Primary_School_To,'None','Primary',session('u_id'));
                $this->EmployeeModel->SubmitClientEducBackground($requestJson->Client_Ref_No,$requestJson->Secondary_School,$requestJson->Secondary_School_From,$requestJson->Secondary_School_To,'None','Secondary',session('u_id'));
                $this->EmployeeModel->SubmitClientEducBackground($requestJson->Client_Ref_No,$requestJson->Tertiary_School,$requestJson->Tertiary_School_From,$requestJson->Tertiary_School_To,$requestJson->Tertiary_School_Degree,'Tertiary',session('u_id'));

                 
                $EmpCompany = $requestJson->EmpCompany;
                $EmpPosition = $requestJson->EmpPosition; 
                $CompanyFrom = $requestJson->CompanyFrom;
                $CompanyTo = $requestJson->CompanyTo;
                for($i=0;$i<sizeof($EmpCompany);$i++){

                    $this->EmployeeModel->SubmitClientEmployment($requestJson->Client_Ref_No,$EmpCompany[$i],$EmpPosition[$i],datenullchecker($CompanyFrom[$i]),datenullchecker($CompanyTo[$i]),session('u_id'));
                }
                
             
                $CharName = $requestJson->CharName;
                $CharPosition = $requestJson->CharPosition; 
                $CharCompany = $requestJson->CharCompany;
                $CharContactNo = $requestJson->CharContactNo;
                for($i=0;$i<sizeof($CharName);$i++){

                    $this->EmployeeModel->SubmitClientCharReference($requestJson->Client_Ref_No,$CharName[$i],$CharPosition[$i],$CharCompany[$i],$CharContactNo[$i],session('u_id'));
                }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getEmployeeAddress(){
        try {
            $request = \Config\Services::request();
            $CEL_Ref_No = $request->getPost('CEL_Ref_No'); 
            return json_encode($this->EmployeeModel->getEmployeeAddress($CEL_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getEmployeeRelatives(){
        try {
            $request = \Config\Services::request();
            $CEL_Ref_No = $request->getPost('CEL_Ref_No'); 
            return json_encode($this->EmployeeModel->getEmployeeRelatives($CEL_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getEmployeeDependents(){
        try {
            $request = \Config\Services::request();
            $CEL_Ref_No = $request->getPost('CEL_Ref_No'); 
            return json_encode($this->EmployeeModel->getEmployeeDependents($CEL_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function getEmployeeEducBackground(){
        try {
            $request = \Config\Services::request();
            $CEL_Ref_No = $request->getPost('CEL_Ref_No'); 
            return json_encode($this->EmployeeModel->getEmployeeEducBackground($CEL_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function getEmployeeEmployment(){
        try {
            $request = \Config\Services::request();
            $CEL_Ref_No = $request->getPost('CEL_Ref_No'); 
            return json_encode($this->EmployeeModel->getEmployeeEmployment($CEL_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getEmployeeCharReference(){
        try {
            $request = \Config\Services::request();
            $CEL_Ref_No = $request->getPost('CEL_Ref_No'); 
            return json_encode($this->EmployeeModel->getEmployeeCharReference($CEL_Ref_No));
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ChangeEmpDetails(){
        try {
            $request = \Config\Services::request();
            $CEL_Ref_No = $request->getPost('CEL_Ref_No'); 
            $NewCompany = $request->getPost('NewCompany'); 
            $NewDept = $request->getPost('NewDept'); 
            $NewSection = $request->getPost('NewSection'); 
            $NewPosition = $request->getPost('NewPosition'); 
            $data = array(
                'CEL_Company'   => $NewCompany,
                'CEL_Dept'      => $NewDept,
                'CEL_Section'   => $NewSection,
                'CEL_Position'  => $NewPosition,
            );
            $this->EmployeeModel->EditEmployee($CEL_Ref_No,$data);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
?>