<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

use App\Models\System\CompanyModel;
use App\Models\Operations\OperationsModel;

use App\Helpers\MpdfHelper;
class Operations extends BaseController
{
    protected CompanyModel $companyModel;
    protected OperationsModel $OperationsModel;
    protected IncomingRequest|CLIRequest $postRequest;
    protected MpdfHelper $MpdfHelper;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
        $this->OperationsModel = new OperationsModel();
        $this->postRequest = Services::request();
        $this->MpdfHelper = new MpdfHelper();

    }

    public function index()
    {
        return view('Pages/Operations/acquainted');
    }

    public function OperationList()
    {
        return view('Pages/Operations/OperationList');
    }

    public function AppointmentCalendar()
    {
        return view('Pages/Operations/AppointmentCalendar');
    }

    public function getprovince()
    {
        return json_encode($this->OperationsModel->getprovince());
    }

    public function getcities()
    {
        $request = \Config\Services::request();
        $province = $request->getPost('province');
        return json_encode($this->OperationsModel->getcities($province));
    }

    public function getbrgys()
    {
        $request = \Config\Services::request();
        $city = $request->getPost('city');
        return json_encode($this->OperationsModel->getbrgys($city));
    }

    public function RoomList()
    {
        return view('Pages/Operations/RoomList');
    }

    public function submit_clientinfo()
    {
        try {
            $request = \Config\Services::request();
            
            // Basic Info
            $FirstName      = $request->getPost('FirstName');
            $MiddleName     = $request->getPost('MiddleName');
            $LastName       = $request->getPost('LastName');
            $ExtName        = $request->getPost('ExtName');
            $BirthDate      = $request->getPost('BirthDate');
            $Gender         = $request->getPost('Gender');
            $Religion       = $request->getPost('Religion');
            $Nationality    = $request->getPost('Nationality');
            $no = 1; 
            $clientcode = $this->OperationsModel->insert_client($FirstName,$MiddleName,$LastName,$ExtName,$BirthDate,$Gender,$Religion,$Nationality,session('uname'));
            foreach($clientcode as $row)
            {
                $clientcode = $row->newclientcode;
            }
            // Basic Info

            // Client Address
            $Province = $request->getPost('Province');
            $City = $request->getPost('City');
            $Barangay = $request->getPost('Barangay');
            $Street = $request->getPost('Street'); 
            
            $data_client_address = array(
                "CLIAL_CLI_Code"        => $clientcode,
                "CLIAL_Type"            => 'PMA',
                "CLIAL_Area_Code"       => $Province,
                "CLIAL_City_Code"       => $City,
                "CLIAL_Barangay_Code"   => $Barangay,
                "CLIAL_Street"          => $Street,
                "CLIAL_Audit_User"      => session('uname')
            ); 
            $this->OperationsModel->insert_client_address($data_client_address);
            // Client Address

            // Client Contact Details
            $TelNo = $request->getPost('TelNo');
            $MobileNo = $request->getPost('MobileNo');
            $EmailAdd = $request->getPost('EmailAdd'); 
            $this->OperationsModel->insert_client_contact_logs($clientcode,$TelNo,$MobileNo,$EmailAdd,session('uname'));
            // Client Contact Details

            // Client Employment
            $Occupation = $request->getPost('Occupation');
            $OfficeAdd = $request->getPost('OfficeAdd');
            $OfficeTelNo = $request->getPost('OfficeTelNo');
            
            $data_employment = array(
                "CLIEL_CLI_Code"        => $clientcode,
                "CLIEL_Occupation"      => $Occupation,
                "CLIEL_Address"         => $OfficeAdd,
                "CLIEL_Contact_No"      => $OfficeTelNo,
                "CLIEL_Audit_User"      => session('uname')
            );
            if($Occupation!='')
            {
                $this->OperationsModel->insert_client_employment($data_employment); 
            }
            // Client Employment
            
            // Client Reference
            // $PersonResponsible = $request->getPost('PersonResponsible');
            // $PersonResponsibleAdd   = $request->getPost('PersonResponsibleAdd');
            $ReferredBy = $request->getPost('ReferredBy');
            $Guardian = $request->getPost('Guardian');
            $GuardianOccupation = $request->getPost('GuardianOccupation');
            $GuardianReason = $request->getPost('GuardianReason');
            $this->OperationsModel->insert_client_references($clientcode,$ReferredBy,$Guardian,$GuardianOccupation,$GuardianReason,session('uname'));
            // Client Reference
            

            // Medical History
            $Q1 = $request->getPost('Q1');
            $Q2 = $request->getPost('Q2');
            $Q2_Remarks = $request->getPost('Q2_Remarks');
            $Q3 = $request->getPost('Q3');
            $Q3_Remarks = $request->getPost('Q3_Remarks');
            $Q4 = $request->getPost('Q4');
            $Q4_Remarks = $request->getPost('Q4_Remarks');
            $Q5 = $request->getPost('Q5');
            $Q5_Remarks = $request->getPost('Q5_Remarks');
            $Q6 = $request->getPost('Q6');
            $Q7 = $request->getPost('Q7');
            $Q8 = $request->getPost('Q8');
            $Q9 = $request->getPost('Q9');
            $Q9_1 = $request->getPost('Q9_1');
            $Q9_2 = $request->getPost('Q9_2');
            $Q10 = $request->getPost('Q10');
            $Q11 = $request->getPost('Q11');
            $Q12 = $request->getPost('Q12');

            $data_medhistory = array(
                "CMH_Q1" => $Q1,
                "CMH_Q2" => $Q2,
                "CMH_Q2_Remarks" => $Q2_Remarks,
                "CMH_Q3" => $Q3,
                "CMH_Q3_Remarks" => $Q3_Remarks,
                "CMH_Q4" => $Q4,
                "CMH_Q4_Remarks" => $Q4_Remarks,
                "CMH_Q5" => $Q5,
                "CMH_Q5_Remarks" => $Q5_Remarks,
                "CMH_Q6" => $Q6,
                "CMH_Q7" => $Q7,
                "CMH_Q8" => json_encode($Q8),
                "CMH_Q9" => $Q9,
                "CMH_Q9_1" => $Q9_1,
                "CMH_Q9_2" => $Q9_2,
                "CMH_Q10" => $Q10,
                "CMH_Q11" => $Q11,
                "CMH_Q12" => json_encode($Q12),
                "CMH_Audit_User" => session('uname')
            );
            $this->OperationsModel->insert_client_medhistory($data_medhistory); 
            // Medical History
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create_new_app()
    { 
        try {
            $request = \Config\Services::request();  
            
            $app_client     = $request->getPost('app_client');
            $app_operation  = $request->getPost('app_operation');
            $app_dentist    = $request->getPost('app_dentist');
            $app_date       = $request->getPost('app_date');
            $app_time       = $request->getPost('app_time');
            $app_room       = $request->getPost('app_room');
            $app_remarks    = $request->getPost('app_remarks');

            $app_operation = explode('-', $app_operation);

            $operation      = $app_operation[0];
            // $app_duration   = $app_operation[1];
            $app_duration = $request->getPost('app_duration');
            $data_app = array(
                "CSL_Client_Code"       => $app_client,
                "CSL_Date"              => date('Y-m-d H:i:s', strtotime("$app_date $app_time")),
                "CSL_Action_Needed_By"  => $app_dentist,
                "CSL_Activity"          => $operation,
                "CSL_Location"          => $app_room,
                "CSL_Duration"          => $app_duration,
                "CSL_Remarks"           => $app_remarks,
                "CSL_Audit_User"        => session('uname')
            );
            
            $this->OperationsModel->insert_app($data_app);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function getclients()
    { 
        return json_encode($this->OperationsModel->getclients());
    }

    public function getrooms()
    { 
        return json_encode($this->OperationsModel->getrooms());
    }

    public function getoperations()
    { 
        return json_encode($this->OperationsModel->getoperations());
    }

    public function getdentists()
    {
        return json_encode($this->OperationsModel->getdentists());
    }

    public function getschedule()
    {
        return json_encode($this->OperationsModel->getschedule());
    }

    public function addoperation()
    {
        try {
            $request = \Config\Services::request();  
        
            $operationID    = $request->getPost('operationID');
            $operationDesc  = $request->getPost('operationDesc');
            $StandardHrs    = $request->getPost('StandardHrs');  
            $Price       = $request->getPost('Price');
            $Cost       = $request->getPost('Cost');
    
    
            $data_op = array(
                "OL_Operation_ID"       => $operationID,
                "OL_Operation_Desc"     => $operationDesc,
                "OL_Standard_Hrs"       => $StandardHrs,
                "OL_Price"              => $Price,
                "OL_Cost"               => $Cost,
                "OL_Audit_User"         => session('uname')
            );
            
            $this->OperationsModel->insert_operation($data_op);
            
            return true;
        } catch (\Throwable $th) {
            throw $th;
        } 
    }

    public function addroom()
    {
        try {
            $request = \Config\Services::request();  
        
            $RoomDesc    = $request->getPost('RoomDesc'); 
    
            $data_room = array(
                "RL_Description"       => $RoomDesc 
            );
            
            $this->OperationsModel->insert_room($data_room);
            
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function client_report()
    {
        $html = '<h1>Test</h1>';
        // $html = '<img src="http://localhost:8080/assets/images/System/PIVI/PIVI.png" alt="Test" width="500" height="600">';
        $output =  $this->MpdfHelper->generate($html);
        $response = service('response');
        $response->setContentType('application/pdf');
        return $response->setBody($output);
    }
    
    public function deleteproc()
    {
        $request = \Config\Services::request();
        $proc = $request->getPost('proc');
        $data = array(
            "OL_Status"         => 'Inactive',
            "OL_Audit_User"     => session('uname')
        );
        $this->OperationsModel->updateproc($proc,$data);
    }

    public function restoreproc()
    {
        $request = \Config\Services::request();
        $proc = $request->getPost('proc');
        $data = array(
            "OL_Status"         => 'Active',
            "OL_Audit_User"     => session('uname')
        );
        $this->OperationsModel->updateproc($proc,$data);
    }

    public function item_list()
    {
        return view('Pages/Operations/item_list');
    }

    
}
