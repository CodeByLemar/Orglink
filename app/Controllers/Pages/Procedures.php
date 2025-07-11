<?php

namespace App\Controllers\Pages;
use TCPDF;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

use App\Models\System\CompanyModel;
use App\Models\Procedures\ProceduresModel;

use App\Helpers\MpdfHelper;
class Procedures extends BaseController
{
    protected CompanyModel $companyModel;
    protected ProceduresModel $ProceduresModel;
    protected IncomingRequest|CLIRequest $postRequest;
    protected MpdfHelper $MpdfHelper;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
        $this->ProceduresModel = new ProceduresModel();
        $this->postRequest = Services::request();
        $this->MpdfHelper = new MpdfHelper();

    }

    public function index()
    {
        return view('Pages/Procedures/acquainted');
    }

    public function ProcedureList()
    {
        return view('Pages/Procedures/ProcedureList');
    }

    public function BranchList(){
        return view('Pages/Procedures/BranchList');
    }

    public function HMOCompanyList(){
        return view('Pages/Procedures/HMOCompanyList');
    }

    public function BankList(){
        return view('Pages/Procedures/BankList');
    }

    public function AppointmentCalendar()
    {
        return view('Pages/Procedures/AppointmentCalendar');
    }

    public function getprovince()
    {
        return json_encode($this->ProceduresModel->getprovince());
    }

    public function getcities()
    {
        $request = \Config\Services::request();
        $province = $request->getPost('province');
        return json_encode($this->ProceduresModel->getcities($province));
    }

    public function getbrgys()
    {
        try{
            $request = \Config\Services::request();
            $city = $request->getPost('city');
            return json_encode($this->ProceduresModel->getbrgys($city));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function RoomList()
    {
        return view('Pages/Procedures/RoomList');
    }

    public function submit_clientinfo()
    {
        try {
            $request = \Config\Services::request();
            
            // Basic Info
            $oldclientcode = $request->getPost('clientcode');
            
            $FirstName      = $request->getPost('FirstName');
            $MiddleName     = $request->getPost('MiddleName');
            $LastName       = $request->getPost('LastName');
            $ExtName        = $request->getPost('ExtName');
            $BirthDate      = $request->getPost('BirthDate');
            $Gender         = $request->getPost('Gender');
            $Religion       = $request->getPost('Religion');
            $Nationality    = $request->getPost('Nationality');

            $Religion       = $request->getPost('Religion');
            $Nationality    = $request->getPost('Nationality');

            $Discount       = $request->getPost('Discount');
            $disc_ref_no    = $request->getPost('disc_ref_no');

            $no = 1; 
            $clientcode = $this->ProceduresModel->insert_client($oldclientcode,$FirstName,$MiddleName,$LastName,$ExtName,$BirthDate,$Gender,$Religion,$Nationality,$Discount,$disc_ref_no,session('u_id'));
            if($oldclientcode!=null){
                foreach($clientcode as $row)
                {
                    $clientcode = $row->newclientcode;
                }
            }else{
                $clientcode = $oldclientcode;
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
                "CLIAL_Audit_User"      => session('u_id')
            ); 
            $this->ProceduresModel->insert_client_address($data_client_address);
            // Client Address

            // Client Contact Details
            $TelNo = $request->getPost('TelNo');
            $MobileNo = $request->getPost('MobileNo');
            $EmailAdd = $request->getPost('EmailAdd'); 
            $this->ProceduresModel->insert_client_contact_logs($clientcode,$TelNo,$MobileNo,$EmailAdd,session('u_id'));
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
                "CLIEL_Audit_User"      => session('u_id')
            );
            if($Occupation!='')
            {
                $this->ProceduresModel->insert_client_employment($data_employment); 
            }
            // Client Employment
            
            // Client Reference
            // $PersonResponsible = $request->getPost('PersonResponsible');
            // $PersonResponsibleAdd   = $request->getPost('PersonResponsibleAdd');
            $ReferredBy = $request->getPost('ReferredBy');
            $Guardian = $request->getPost('Guardian');
            $GuardianOccupation = $request->getPost('GuardianOccupation');
            $GuardianReason = $request->getPost('GuardianReason');
            $this->ProceduresModel->insert_client_references($clientcode,$ReferredBy,$Guardian,$GuardianOccupation,$GuardianReason,session('u_id'));
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
                "CMH_Client_Code"   => $clientcode,
                "CMH_Q1"            => $Q1,
                "CMH_Q2"            => $Q2,
                "CMH_Q2_Remarks"    => $Q2_Remarks,
                "CMH_Q3"            => $Q3,
                "CMH_Q3_Remarks"    => $Q3_Remarks,
                "CMH_Q4"            => $Q4,
                "CMH_Q4_Remarks"    => $Q4_Remarks,
                "CMH_Q5"            => $Q5,
                "CMH_Q5_Remarks"    => $Q5_Remarks,
                "CMH_Q6"            => $Q6,
                "CMH_Q7"            => $Q7,
                "CMH_Q8"            => json_encode($Q8),
                "CMH_Q9"            => $Q9,
                "CMH_Q9_1"          => $Q9_1,
                "CMH_Q9_2"          => $Q9_2,
                "CMH_Q10"           => $Q10,
                "CMH_Q11"           => $Q11,
                "CMH_Q12"           => json_encode($Q12),
                "CMH_Audit_User"    => session('u_id')
            );
            $this->ProceduresModel->insert_client_medhistory($data_medhistory); 
            // Medical History
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getclienthistory()
    {
        try{
            $request = \Config\Services::request();
            $app_client = $request->getPost('app_client');
            return json_encode($this->ProceduresModel->getclienthistory($app_client));
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

            // $app_operation = explode('-', $app_operation); 
            // $operation = $app_operation[0]; 
            
            $app_duration = $request->getPost('app_duration');
            $data_app = array(
                "CSL_Client_Code"       => $app_client,
                "CSL_Date"              => date('Y-m-d H:i:s', strtotime("$app_date $app_time")),
                "CSL_Action_Needed_By"  => $app_dentist,
                // "CSL_Activity"          => json_encode($new_operation),
                "CSL_Location"          => $app_room,
                "CSL_Duration"          => $app_duration,
                "CSL_Remarks"           => $app_remarks,
                "CSL_Audit_User"        => session('u_id')
            );
            $id = $this->ProceduresModel->insert_app($data_app);
            
            // $new_operation = array();
            for($i=0;$i<sizeof($app_operation);$i++){
                if($app_operation[$i] !='' && $app_operation[$i]!=null){
                    $op = explode('-', $app_operation[$i]); 
                    // array_push($new_operation,$op[0]); 

                    $data_proc = array(
                        "CAPL_CSL_Ref_No"   => $id,
                        "CAPL_Client_No"    => $app_client,
                        "CAPL_Procedure"    => $op[0],
                        "CAPL_Duration"     => $op[1],
                        "CAPL_Audit_User"   => session('u_id')
                    );
                    
                    $this->ProceduresModel->insert_proc_log($data_proc);
                }
            }
            
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function getclients()
    { 
        return json_encode($this->ProceduresModel->getclients());
    }

    public function getrooms()
    { 
        try{

            $request = \Config\Services::request();
            $branch    = $request->getPost('branch');
            return json_encode($this->ProceduresModel->getrooms($branch));
            
        }catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getProcedures()
    { 
        return json_encode($this->ProceduresModel->getProcedures());
    }

    public function getSubProcedures()
    {  
        return json_encode($this->ProceduresModel->getSubProcedures());
    } 


    public function getbranches()
    { 
        return json_encode($this->ProceduresModel->getbranches());
    }

    public function getdentists()
    {
        return json_encode($this->ProceduresModel->getdentists());
    }

    public function getschedule()
    {
        return json_encode($this->ProceduresModel->getschedule());
    }

    public function addProcedure()
    {
        try {
            $request = \Config\Services::request();  
        
            $ProcedureID    = $request->getPost('ProcedureID');
            $ProcedureDesc  = $request->getPost('ProcedureDesc');
            // $StandardHrs    = $request->getPost('StandardHrs');  
            // $Price       = $request->getPost('Price');
            // $Cost       = $request->getPost('Cost');
    
    
            $data = array(
                "PL_Procedure_ID"       => $ProcedureID,
                "PL_Procedure_Desc"     => $ProcedureDesc, 
                "PL_Audit_User"         => session('u_id')
            );
            
            $this->ProceduresModel->insert_procedure($data);
            
            return true;
        } catch (\Throwable $th) {
            throw $th;
        } 
    }

    public function addsubprocedure()
    {
        try {
            $request = \Config\Services::request();  
        
            $sub_ProcedureID        = $request->getPost('sub_ProcedureID');
            $sub_subProcedureID     = $request->getPost('sub_subProcedureID');
            $sub_ProcedureDesc      = $request->getPost('sub_ProcedureDesc');
            $sub_Cost               = $request->getPost('sub_Cost');
            $sub_Price              = $request->getPost('sub_Price');
            $sub_StandardHrs        = $request->getPost('sub_StandardHrs');
    
    
            $data = array(
                "SPL_Procedure_ID"          => $sub_ProcedureID,
                "SPL_SubProcedure_ID"       => $sub_subProcedureID,
                "SPL_SubProcedure_Desc"     => $sub_ProcedureDesc,
                "SPL_Standard_Hrs"          => $sub_StandardHrs,
                "SPL_Price"                 => $sub_Price,
                "SPL_Cost"                  => $sub_Cost,
                "SPL_Audit_User"            => session('u_id') 
            );
            
            $this->ProceduresModel->insert_subprocedure($data);
            
            return true;
        } catch (\Throwable $th) {
            throw $th;
        } 
    }

    public function getprocedurelist()
    {
        return json_encode($this->ProceduresModel->getprocedurelist());
    }

    public function addbranch()
    {
        try {
            $request = \Config\Services::request();  
 
            $Branch_Code    = $request->getPost('Branch_Code');
            $Branch_Desc  = $request->getPost('Branch_Desc'); 
    
    
            $data_branch = array(
                "BL_Branch_Code"        => $Branch_Code,
                "BL_Branch_Desc"        => $Branch_Desc,   
                "BL_Audit_User"         => session('u_id')
            );
            
            $this->ProceduresModel->insert_branch($data_branch);
            
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
            $Branch    = $request->getPost('Branch'); 
    
            $data_room = array(
                "RL_Description"       => $RoomDesc
                // "RL_Branch_Code"        => $Branch 
            );
            
            $this->ProceduresModel->insert_room($data_room);
            
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

    public function deleteroom()
    {   
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $room = $request->getPost('room');
        $data = array(
            "RL_Status"         => 'Inactive',
            "RL_Audit_User"     => session('u_id'),
            "RL_Audit_Date"     => $current_date
        );
        $this->ProceduresModel->updateroom($room,$data);
    }

    public function restoreroom()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $room = $request->getPost('room');
        $data = array(
            "RL_Status"         => 'Active',
            "RL_Audit_User"     => session('u_id'),
            "RL_Audit_Date"     => $current_date
        );
        $this->ProceduresModel->updateroom($room,$data);
    }
    
    public function deleteproc()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $proc = $request->getPost('proc');
        $data = array(
            "OL_Status"         => 'Inactive',
            "OL_Audit_User"     => session('u_id'),
            "OL_Audit_Date"     => $current_date
        );
        $this->ProceduresModel->updateproc($proc,$data);
    }

    public function restoreproc()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $proc = $request->getPost('proc');
        $data = array(
            "OL_Status"         => 'Active',
            "OL_Audit_User"     => session('u_id'),
            "OL_Audit_Date"     => $current_date
        );
        $this->ProceduresModel->updateproc($proc,$data);
    }

    public function deletebranch()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $branch = $request->getPost('branch');
        $data = array(
            "BL_Status"         => 'Inactive',
            "BL_Audit_User"     => session('u_id'),
            "BL_Audit_Date"     => $current_date 
        );
        $this->ProceduresModel->updatebranch($branch,$data);
    }

    public function restorebranch()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $branch = $request->getPost('branch');
        $data = array(
            "BL_Status"         => 'Active',
            "BL_Audit_User"     => session('u_id'),
            "BL_Audit_Date"     => $current_date 
        );
        $this->ProceduresModel->updatebranch($branch,$data);
    }

    public function InventoryList()
    {
        return view('Pages/Procedures/InventoryList');
    }

    public function addnewitem()
    {
        $request = \Config\Services::request();
        $item_no = $request->getPost('item_no');
        $item_desc = $request->getPost('item_desc');
        $item_unit = $request->getPost('item_unit');
        $item_cost = $request->getPost('item_cost');
        
        return json_encode($this->ProceduresModel->addnewitem($item_no,$item_desc,$item_unit,$item_cost,session('u_id')));
    }

    public function edititem()
    {
        $request = \Config\Services::request();
        $item_no = $request->getPost('edit_item_no');
        $item_desc = $request->getPost('edit_item_desc');
        $item_unit = $request->getPost('edit_item_unit');
        $item_cost = $request->getPost('edit_item_cost');
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $data_update = array(
            "IM_Item_Description"   => $item_desc,
            // "IM_Barcode"            => $item_desc,
            "IM_Unit"               => $item_unit,
            "IM_Cost"               => $item_cost,
            "IM_Audit_User"         => session('u_id'),
            "IM_Audit_Date"         => $current_date,
        );
        $this->ProceduresModel->updateitem($item_no,$data_update) ;
        
    }

    public function getitemmaster()
    {
        return json_encode($this->ProceduresModel->getitemmaster());
    }

    public function deleteitem()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $item = $request->getPost('item');
        $data = array(
            "IM_Status"         => 'Inactive',
            "IM_Audit_User"     => session('u_id'),
            "IM_Audit_Date"     => $current_date 
        );
        $this->ProceduresModel->updateitem($item,$data);
    }

    public function restoreitem()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $item = $request->getPost('item');
        $data = array(
            "IM_Status"         => 'Active',
            "IM_Audit_User"     => session('u_id'),
            "IM_Audit_Date"     => $current_date 
        );
        $this->ProceduresModel->updateitem($item,$data);
    }

    public function getconfigprocs()
    {
        $request = \Config\Services::request();
        $branch = $request->getPost('branch');
        return json_encode($this->ProceduresModel->getconfigprocs($branch));
    }

    public function getproc_items()
    {
        $request = \Config\Services::request();
        $proc = $request->getPost('proc');
        return json_encode($this->ProceduresModel->getproc_items($proc));
    }

    public function add_itemproc()
    {
        $request = \Config\Services::request();
        $proc = $request->getPost('proc');
        $item = $request->getPost('item');
        return json_encode($this->ProceduresModel->add_itemproc($proc,$item,session('u_id')));
    }

    public function getbreakdown()
    {
        $request = \Config\Services::request();
        $refno = $request->getPost('refno'); 
        return json_encode($this->ProceduresModel->getbreakdown($refno));
    }

    public function getprocbreakdown()
    {
        $request = \Config\Services::request();
        $refno = $request->getPost('refno'); 
        return json_encode($this->ProceduresModel->getprocbreakdown($refno));
    }

    public function complete_app()
    {
        $request = \Config\Services::request();
        $refno = $request->getPost('refno'); 
        
        $remarks = $request->getPost('remarks'); 
        $ToothArray = $request->getPost('ToothArray'); 
        
        $data_update = array(
            'CSL_Result_Remarks'    => $remarks,
            'CSL_Teeth'             => json_encode($ToothArray)
        ); 
        $this->ProceduresModel->complete_app($refno,$data_update);
    }

    public function submit_billing()
    {
        $total_disc = 0;
        try{
            $request = \Config\Services::request();

            $getcurrentdate = $this->ProceduresModel->getcurrentdate();

            foreach($getcurrentdate as $tmp){ $current_date = $tmp->currentdatetime; }

            $acc_refno          = $request->getPost('acc_refno'); 
            $others_disc        = $request->getPost('others_disc');
            $pwd_senior_hid     = $request->getPost('pwd_senior_hid');
            $total_billing_hid  = $request->getPost('total_billing_hid');
            $incharge_hid       = $request->getPost('incharge_hid');
            $clientcode_hid     = $request->getPost('clientcode_hid');
            $total_disc = (float)$others_disc + (float)$pwd_senior_hid;
            
            
            $AR_Main = array(
                "ARML_CSL_Ref_No"       => $acc_refno,
                "ARML_Date"             => $current_date,      
                "ARML_Client_No"        => $clientcode_hid,
                "ARML_Incharge"         => $incharge_hid,
                "ARML_Total_Amount"     => $total_billing_hid,

                "ARML_Client_Discount"  => $pwd_senior_hid,
                "ARML_Other_Discount"   => $others_disc,
                
                "ARML_Audit_User"       => session('u_id')
            );
            $AR_Ref_No = $this->ProceduresModel->insert_armain($AR_Main);

            $AR_Payment = array(
                "ARPS_ARML_Ref_No"  => $AR_Ref_No,
                "ARPS_Date"         => $current_date,
                "ARPS_Amount"       => $total_billing_hid,
                "ARPS_Audit_User"   => session('u_id')
            );
            $this->ProceduresModel->insertarpayment($AR_Payment);
            
            $breakdown = $this->ProceduresModel->getprocbreakdown($acc_refno);
            foreach($breakdown as $row)
            {
                $AR_List = array(
                    "ARL_ARML_Ref_No"       => $AR_Ref_No,
                    "ARL_SubProcedure_ID"   => $row->SPL_Ref_No,
                    "ARL_Price"             => $row->SPL_Price,
                    "ARL_Cost"              => $row->SPL_Cost,
                    "ARL_Audit_User"        => session('u_id')
                );
                $this->ProceduresModel->insert_arlist($AR_List);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        


    }

    public function getarpaymentschedule()
    {
        $request = \Config\Services::request();
        $refno = $request->getPost('refno');
        return json_encode($this->ProceduresModel->getarpaymentschedule($refno));
    }

    public function submit_payment()
    {
        try{
            $request = \Config\Services::request(); 
            
            $arrefno            = $request->getPost('arrefno');
            $modeofpayment      = $request->getPost('modeofpayment');
            $ornumber           = $request->getPost('ornumber');
            $amount_due         = $request->getPost('amount_due');
            $amount_paid        = $request->getPost('amount_paid');

            $bank_company       = $request->getPost('bank_company');
            $approvedrefno      = $request->getPost('approvedrefno');
            $getcurrentdate = $this->ProceduresModel->getcurrentdate();
            foreach($getcurrentdate as $tmp){
                $current_date = $tmp->currentdatetime;
            }
            
            $payment = array(
                "PL_ARML_Ref_No"        => $arrefno,
                "PL_Amount_Paid"        => $amount_paid,
                "PL_Date"               => $current_date,
                "PL_Amount_Due"         => $amount_due,
                "PL_Mode_Of_Payment"    => $modeofpayment,
                "PL_OR_Number"          => $ornumber,

                "PL_Approved_Ref_No"    => $approvedrefno,
                "PL_Bank_Company"       => $bank_company,

                "PL_Received_By"        => session('u_id'),
                "PL_Audit_User"         => session('u_id')
            );
            $this->ProceduresModel->insert_payment($payment);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function searchpatient()
    { 
        try {
            $request = \Config\Services::request();  
            $searchstring = $request->getPost('searchstring');
            return json_encode($this->ProceduresModel->searchpatient($searchstring));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function populateclientinfo()
    {
        try {
            $request = \Config\Services::request();  
            $clientcode = $request->getPost('clientcode');
            return json_encode($this->ProceduresModel->populateclientinfo($clientcode));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function populateclientaddress()
    {
        try {
            $request = \Config\Services::request();  
            $clientcode = $request->getPost('clientcode');
            return json_encode($this->ProceduresModel->populateclientaddress($clientcode));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function populateclientcontactinfo()
    {
        try {
            $request = \Config\Services::request();  
            $clientcode = $request->getPost('clientcode');
            return json_encode($this->ProceduresModel->populateclientcontactinfo($clientcode));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function populateclientreference()
    {
        try {
            $request = \Config\Services::request();  
            $clientcode = $request->getPost('clientcode');
            return json_encode($this->ProceduresModel->populateclientreference($clientcode));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function populateclientmedhistory()
    {
        try {
            $request = \Config\Services::request();  
            $clientcode = $request->getPost('clientcode');
            return json_encode($this->ProceduresModel->populateclientmedhistory($clientcode));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function gethmocompany()
    {
        try{

            $request = \Config\Services::request(); 
            return json_encode($this->ProceduresModel->gethmocompany());
            
        }catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addhmocompany()
    {
        try {
            $request = \Config\Services::request();  
        
            $CompanyDesc    = $request->getPost('CompanyDesc');  
    
            $data_com = array(
                "HCL_Description"   => $CompanyDesc, 
                "HCL_Audit_User"    => session('u_id')
                // "RL_Branch_Code"        => $Branch 
            );
            
            $this->ProceduresModel->insert_hmocompany($data_com);
            
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deletehmocom()
    {   
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $com = $request->getPost('com');
        $data = array(
            "HCL_Status"         => 'Inactive',
            "HCL_Audit_User"     => session('u_id'),
            "HCL_Audit_Date"     => $current_date
        );
        $this->ProceduresModel->updatehmocom($com,$data);
    }

    public function restorehmocom()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $com = $request->getPost('com');
        $data = array(
            "HCL_Status"         => 'Active',
            "HCL_Audit_User"     => session('u_id'),
            "HCL_Audit_Date"     => $current_date
        );
        $this->ProceduresModel->updatehmocom($com,$data);
    }

    public function getbanklist()
    {
        try{

            $request = \Config\Services::request(); 
            return json_encode($this->ProceduresModel->getbanklist());
            
        }catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addbank()
    {
        try {
            $request = \Config\Services::request();  
        
            $BankDesc    = $request->getPost('BankDesc');  
            
            
            $data = array(
                "BL_Description"   => $BankDesc, 
                "BL_Audit_User"    => session('u_id')
                // "RL_Branch_Code"        => $Branch 
            );
            
            $this->ProceduresModel->insert_bank($data);
            
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deletebank()
    {   
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $bank = $request->getPost('bank');
        $data = array(
            "BL_Status"         => 'Inactive',
            "BL_Audit_User"     => session('u_id'),
            "BL_Audit_Date"     => $current_date
        );
        $this->ProceduresModel->updatebank($bank,$data);
    }

    public function restorebank()
    {
        $getcurrentdate = $this->ProceduresModel->getcurrentdate();
        foreach($getcurrentdate as $tmp){
            $current_date = $tmp->currentdatetime;
        }
        $request = \Config\Services::request();
        $bank = $request->getPost('bank');
        $data = array(
            "BL_Status"         => 'Active',
            "BL_Audit_User"     => session('u_id'),
            "BL_Audit_Date"     => $current_date
        );
        $this->ProceduresModel->updatebank($bank,$data);
    }

    public function populate_bank()
    {
        try{

            $request = \Config\Services::request(); 
            return json_encode($this->ProceduresModel->populate_bank());
            
        }catch (\Throwable $th) {
            throw $th;
        }
    }

    public function populate_company()
    {
        try{

            $request = \Config\Services::request(); 
            return json_encode($this->ProceduresModel->populate_company());
            
        }catch (\Throwable $th) {
            throw $th;
        }
    }

    public function setclienttreatmentplan(){   
        $request = \Config\Services::request();
      
        $acc_refno = $request->getPost('acc_refno');
        session()->set('acc_refno', $acc_refno);  
        
        return redirect()->to('/Procedures/treatmentplan');  
         
    }

    public function treatmentplan(){ 
        $acc_refno = session('acc_refno');   
        return view('Pages/Procedures/Treatment_Plan',['acc_refno' => $acc_refno] );
    }

    public function treatmentplan_pdf(){  
        
        $acc_refno = session('acc_refno');  
        $data['getcurrentdate'] = $this->ProceduresModel->getcurrentdate();  
        $data['treatment_plan'] = $this->ProceduresModel->gettreatmentplan($acc_refno);
        return view('Pages/Procedures/treatmentplan_pdf_view',$data); 
    }

    public function gettreatmentplan(){
        $request = \Config\Services::request();
        $refno = $request->getPost('refno'); 
        return json_encode($this->ProceduresModel->gettreatmentplan($refno));
    }

    public function submit_treatmentplan(){
        $request = \Config\Services::request();  
        
        $acc_refno  = $request->getPost('acc_refno');

        //arrays
        $refno          = $request->getPost('refno');
        $procedure      = $request->getPost('procedure');
        $tooth          = $request->getPost('tooth');
        $duration       = $request->getPost('duration');
        $effective_date = $request->getPost('effective_date');
        $desc           = $request->getPost('desc');
        $price          = $request->getPost('price');
        $disc_price     = $request->getPost('disc_price');
        //arrays

        $current_date  = $this->ProceduresModel->getcurrentdate();
        foreach($current_date as $tmp)
        {
            $currentdatetime = $tmp->currentdatetime;
        }
        // Delete all not existing Ref No
        $data_del = array( 
            "TPL_Status"        => 'Inactive',
            "TPL_Audit_User"    => session('u_id'),
            "TPL_Audit_Date"    => $currentdatetime
        );
        $this->ProceduresModel->deletetreatmentplan($refno,$data_del);
        // // Delete all not existing Ref No

        for($i=0;$i<sizeof($procedure);$i++){
            $data = array( 
                "TPL_CSL_Ref_No"        => $acc_refno, 
                "TPL_SPL_Ref_No"        => $procedure[$i],
                "TPL_Date"              => $effective_date[$i],
                "TPL_Duration"          => $duration[$i],
                "TPL_Tooth"             => $tooth[$i],
                "TPL_Tooth_Description" => $desc[$i], 
                "TPL_Price"             => $price[$i],
                "TPL_Discounted_Price"  => $disc_price[$i], 
                "TPL_Audit_User"        => session('u_id') 
            );

             
            if($refno[$i]==''){
                $this->ProceduresModel->inserttreatmentplan($data);
            }else{
                $this->ProceduresModel->updatetreatmentplan($refno[$i],$data);
            }

        }
    }

    public function submit_resched(){
        $request = \Config\Services::request();

        $acc_refno = $request->getPost('acc_refno');
        $new_date = $request->getPost('new_date');
        $resched_reason = $request->getPost('resched_reason');

        $data_update = array(
            'CSL_Reason'    => $resched_reason,
            'CSL_Status'    => 'Cancelled'
        );
        $this->ProceduresModel->complete_app($acc_refno,$data_update);

        $this->ProceduresModel->reschedule_app($acc_refno,$new_date,session('u_id'));
    }

    public function submit_cancel(){
        $request = \Config\Services::request();

        $acc_refno = $request->getPost('acc_refno');
        $new_date = $request->getPost('new_date');
        $cancel_reason = $request->getPost('cancel_reason');

        $data_update = array(
            'CSL_Reason'    => $cancel_reason,
            'CSL_Status'    => 'Cancelled'
        );
        $this->ProceduresModel->complete_app($acc_refno,$data_update); 
    }

    public function setclientperiodontal(){   
        $request = \Config\Services::request();
    
        // Check if it's a POST request
        if ($request->getMethod() === 'POST') {
            $acc_refno = $request->getPost('acc_refno');
            session()->set('acc_refno', $acc_refno); 
            // Optionally return a response or redirect
            return redirect()->to('/Procedures/client_periodontal'); // Adjust the URL accordingly
        } else {
            return 'Not a POST request';
        }
    }

    public function client_periodontal(){ 
        $acc_refno = session('acc_refno');  
        $data['acc_refno'] = $acc_refno; 
        $data['getcurrentdate'] = $this->ProceduresModel->getcurrentdate();
        return view('Pages/Procedures/client_periodontal_view',$data );
    }

    public function getclientinfobyrefno()
    { 
        $request = \Config\Services::request();
        $acc_refno = $request->getPost('acc_refno');
        return json_encode($this->ProceduresModel->getclientinfobyrefno($acc_refno));
    }

    public function submit_periodontalchart(){
        $request = \Config\Services::request(); 

        // Test
        // $bleed          = $request->getPost('bleed');
        // var_dump($bleed);
        // Test
 


        $teeth          = $request->getPost('teeth');
        $mobility       = $request->getPost('mobility');
        $implants       = $request->getPost('implants');
        $furcations     = $request->getPost('furcations');

        // $bleed          = $request->getPost('bleed');
        $bleed_buccal       = $request->getPost('bleed_buccal');
        $bleed_palatal      = $request->getPost('bleed_palatal');
        $bleed_lingual      = $request->getPost('bleed_lingual');
        $bleed_buccal_bot   = $request->getPost('bleed_buccal_bot');

        $plaque_buccal          = $request->getPost('plaque_buccal');
        $plaque_palatal         = $request->getPost('plaque_palatal');
        $plaque_lingual         = $request->getPost('plaque_lingual');
        $plaque_buccal_bot      = $request->getPost('plaque_buccal_bot');
 
        $gingivalmargin_buccal          = $request->getPost('gingivalmargin_buccal');
        $gingivalmargin_palatal         = $request->getPost('gingivalmargin_palatal');
        $gingivalmargin_lingual         = $request->getPost('gingivalmargin_lingual');
        $gingivalmargin_buccal_bot      = $request->getPost('gingivalmargin_buccal_bot');

        $probingdepth   = $request->getPost('probingdepth');
        $probingdepth_buccal          = $request->getPost('probingdepth_buccal');
        $probingdepth_palatal         = $request->getPost('probingdepth_palatal');
        $probingdepth_lingual         = $request->getPost('probingdepth_lingual');
        $probingdepth_buccal_bot      = $request->getPost('probingdepth_buccal_bot');

        $clientcode = $request->getPost('clientcode');
         
        $current_date  = $this->ProceduresModel->getcurrentdate();
        foreach($current_date as $tmp)
        {
            $currentdatetime = $tmp->currentdatetime;
        }  

        return json_encode( $this->ProceduresModel->submit_periodontalchart(
                                json_encode($teeth),
                                json_encode($mobility),
                                json_encode($implants),
                                json_encode($furcations),

                                json_encode($bleed_buccal),
                                json_encode($bleed_palatal),
                                json_encode($bleed_lingual),
                                json_encode($bleed_buccal_bot),

                                json_encode($plaque_buccal),
                                json_encode($plaque_palatal),
                                json_encode($plaque_lingual),
                                json_encode($plaque_buccal_bot),
 
                                json_encode($gingivalmargin_buccal),
                                json_encode($gingivalmargin_palatal),
                                json_encode($gingivalmargin_lingual),
                                json_encode($gingivalmargin_buccal_bot),
 
                                json_encode($probingdepth_buccal),
                                json_encode($probingdepth_palatal),
                                json_encode($probingdepth_lingual),
                                json_encode($probingdepth_buccal_bot),

                                $currentdatetime,
                                session('u_id'),
                                $clientcode)
                    );
    }

    public function retrieveperiodontaldata(){
        $request = \Config\Services::request();
        $clientcode = $request->getPost('clientcode');
        return json_encode($this->ProceduresModel->retrieveperiodontaldata($clientcode));
    }
    
    public function submit_remarks(){
        $request = \Config\Services::request();

        $i_remarks = $request->getPost('i_remarks');
        $i_tooth_no = $request->getPost('i_tooth_no'); 
        $i_type = $request->getPost('i_type');
        $currentdate = $request->getPost('currentdate');
        $clientcode = $request->getPost('clientcode');

        $current_date  = $this->ProceduresModel->getcurrentdate();
        foreach($current_date as $tmp)
        {
            $currentdatetime = $tmp->currentdatetime;
        }

        // $data = array(
        //     'CPRL_Client_Code'      => $clientcode,
        //     'CPRL_Tooth_No'         => $i_tooth_no,
        //     'CPRL_Date'             => $currentdate,
        //     'CPRL_Remarks'          => $i_remarks,
        //     'CPRL_Audit_User'       => session('u_id'),
        //     'CPRL_Audit_Date'       => $currentdatetime
        // );

        // $this->ProceduresModel->submit_remarks($data);
        $this->ProceduresModel->submit_remarks($clientcode,$i_tooth_no,$i_type,$currentdate,$i_remarks,session('u_id'),$currentdatetime);
    }

    public function retrieve_remarks(){
        $request = \Config\Services::request();
        $i_tooth_no = $request->getPost('i_tooth_no');
        $i_type = $request->getPost('i_type');
        $clientcode = $request->getPost('clientcode');
        $currentdate = $request->getPost('currentdate');
           

        return json_encode($this->ProceduresModel->retrieve_remarks($i_tooth_no,$i_type,$clientcode,$currentdate));
    }

    public function generate_treatmentnotes(){
        $request = \Config\Services::request(); 
        
        $from = $request->getPost('from');
        $to = $request->getPost('to');
        $clientcode = $request->getPost('clientcode');
        
        session()->set('tn_from', $from); 
        session()->set('tn_to', $to); 
        session()->set('clientcode', $clientcode);  
        
        return redirect()->to('/Procedures/Treatment_Notes_pdf');
    }

    public function Treatment_Notes_pdf(){  
        
        $tn_from    = session('tn_from');
        $tn_to      = session('tn_to');
        $clientcode = session('clientcode');

        $data['getcurrentdate'] = $this->ProceduresModel->getcurrentdate();  
        $data['treatment_notes'] = $this->ProceduresModel->gettreatmentnotes($tn_from,$tn_to,$clientcode);
        // var_dump($tn_from);var_dump($tn_to);var_dump($clientcode);
        // print_r($data);
        return view('Pages/Procedures/treatmentnotes_pdf_view',$data); 
    }

    public function generate_plan(){
        $request = \Config\Services::request(); 
        
        $accrefno = $request->getPost('accrefno');
        $audituser = session('u_id');
        $this->ProceduresModel->generate_plan($accrefno,$audituser);
    }
}
