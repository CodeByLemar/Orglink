<?php

namespace App\Controllers\Maintenance;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users\UserModel;
use App\Models\Maintenance\ReferenceMaintenanceModel;
use Config\Services;

class ReferenceMaintenance extends BaseController
{ 
    protected IncomingRequest|CLIRequest $postRequest;
    protected  UserModel $usermodel;
    protected  ReferenceMaintenanceModel $ReferenceMaintenanceModel;


    public function __construct(){

        $this->usermodel = new UserModel();
        $this->ReferenceMaintenanceModel = new ReferenceMaintenanceModel();
        $this->postRequest = Services::request();
    }

    public function index() : string
    {
        return view('Pages/Maintenance/ReferenceMaintenance_view');
    }

    public function getcompanylist(){
        return json_encode($this->ReferenceMaintenanceModel->getcompanylist());
    }

    public function getdeptlist(){
        return json_encode($this->ReferenceMaintenanceModel->getdeptlist());
    }

    public function getposlist(){
        return json_encode($this->ReferenceMaintenanceModel->getposlist());
    }

    public function getseclist(){
        return json_encode($this->ReferenceMaintenanceModel->getseclist());
    }

    public function addcompany(){
        try {
            $request = \Config\Services::request();
            
            $CompanyCode = $request->getPost('CompanyCode');
            $CompanyName = $request->getPost('CompanyName');

            $Cutoff1_From = $request->getPost('Cutoff1_From');
            $Cutoff1_To = $request->getPost('Cutoff1_To');
            
            $Cutoff2_From = $request->getPost('Cutoff2_From');
            $Cutoff2_To = $request->getPost('Cutoff2_To');

            $Msg = $this->ReferenceMaintenanceModel->insertcompany($CompanyCode,$CompanyName,$Cutoff1_From,$Cutoff1_To,$Cutoff2_From,$Cutoff2_To,session('u_id'));
            
            return json_encode($Msg);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function adddept(){
        try {
            $request = \Config\Services::request();
            
            $DCompanyCode = $request->getPost('DCompanyCode');
            $DeptCode = $request->getPost('DeptCode');
            $DeptName = $request->getPost('DeptName');

            $msg = $this->ReferenceMaintenanceModel->insertdept($DCompanyCode,$DeptCode,$DeptName,session('u_id'));
            
            return json_encode($msg);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addpos(){
        try {
            $request = \Config\Services::request();
            
            $PDeptCode = $request->getPost('PDeptCode');
            $PosName = $request->getPost('PosName');
            $Level = $request->getPost('Level');

            $msg = $this->ReferenceMaintenanceModel->insertpos($PDeptCode,$PosName,$Level,session('u_id'));
            
            return json_encode($msg);
        } catch (\Throwable $th) {
            throw $th;
        }
    }   

    public function addsec(){
        try {
            $request = \Config\Services::request();
            
            $SDeptCode = $request->getPost('SDeptCode');
            $SecName = $request->getPost('SecName'); 

            $msg = $this->ReferenceMaintenanceModel->insertsec($SDeptCode,$SecName,session('u_id'));
            
            return json_encode($msg);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function UpdateRefList(){
        try {
            $request = \Config\Services::request(); 
                    
            $refno = $request->getPost('refno');
            $type = $request->getPost('type');
            $status = $request->getPost('status');

            $getcurrentdate = $this->ReferenceMaintenanceModel->getcurrentdate();
            foreach($getcurrentdate as $tmp){
                $current_date = $tmp->currentdatetime;
            }
            
            switch ($type) {
                case 'company':
                    $data = array(
                        // 'CCL_Company_Code'  
                        // 'CCL_Company_Name'
                        'CCL_Status'        => $status,
                        'CCL_Audit_User'    => session('u_id'),
                        'CCL_Audit_Date'    => $current_date
                    );
                    $this->ReferenceMaintenanceModel->UpdateCompany($refno,$data);

                    break;
                case 'dept':
                    $data = array(
                        // 'CCL_Company_Code'  
                        // 'CCL_Company_Name'
                        'CDL_Status'        => $status,
                        'CDL_Audit_User'    => session('u_id'),
                        'CDL_Audit_Date'    => $current_date
                    );
                    $this->ReferenceMaintenanceModel->UpdateDept($refno,$data);
                    
                    break;
                case 'pos':
                    $data = array(
                        // 'CCL_Company_Code'  
                        // 'CCL_Company_Name'
                        'CPL_Status'        => $status,
                        'CPL_Audit_User'    => session('u_id'),
                        'CPL_Audit_Date'    => $current_date
                    );
                    $this->ReferenceMaintenanceModel->UpdatePos($refno,$data);
                    
                    break;
                case 'sec':
                    $data = array(
                        // 'CCL_Company_Code'  
                        // 'CCL_Company_Name'
                        'CSL_Status'        => $status,
                        'CSL_Audit_User'    => session('u_id'),
                        'CSL_Audit_Date'    => $current_date
                    );
                    $this->ReferenceMaintenanceModel->UpdateSec($refno,$data);
                    
                    break;
                default:
                    # code...
                    break;
            } 
             
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function EditCompany(){
        try {
            $request = \Config\Services::request();
            
            $CCL_Ref_No = $request->getPost('CCL_Ref_No');
            $EditCompanyCode = $request->getPost('EditCompanyCode');
            $EditCompanyName = $request->getPost('EditCompanyName');

            $EditCutoff1_From = $request->getPost('EditCutoff1_From');
            $EditCutoff1_To = $request->getPost('EditCutoff1_To');
            $EditCutoff2_From = $request->getPost('EditCutoff2_From');
            $EditCutoff2_To = $request->getPost('EditCutoff2_To');
            $getcurrentdate = $this->ReferenceMaintenanceModel->getcurrentdate();
            
            foreach($getcurrentdate as $tmp){
                $current_date = $tmp->currentdatetime;
            }

            $data = array(
                'CCL_Ref_No'        => $CCL_Ref_No,
                'CCL_Company_Code'  => $EditCompanyCode,
                'CCL_Company_Name'  => $EditCompanyName,
                'CCL_Cutoff1_From'  => $EditCutoff1_From,
                'CCL_Cutoff1_To'    => $EditCutoff1_To,
                'CCL_Cutoff2_From'  => $EditCutoff2_From,
                'CCL_Cutoff2_To'    => $EditCutoff2_To,
                'CCL_Audit_User'    => session('u_id'),
                'CCL_Audit_Date'    => $current_date
            );
            $this->ReferenceMaintenanceModel->UpdateCompany($CCL_Ref_No,$data); 
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function EditDept(){
        try {
            $request = \Config\Services::request();
           
            $CDL_Ref_No = $request->getPost('CDL_Ref_No');
            $EditDCompanyCode = $request->getPost('EditDCompanyCode');
            $EditDeptCode = $request->getPost('EditDeptCode');
            $EditDeptName = $request->getPost('EditDeptName');
            $getcurrentdate = $this->ReferenceMaintenanceModel->getcurrentdate();
            
            foreach($getcurrentdate as $tmp){
                $current_date = $tmp->currentdatetime;
            }
             
            
            $data = array(
                'CDL_CCL_Ref_No'    => $EditDCompanyCode,
                'CDL_Dept_Code'     => $EditDeptCode,
                'CDL_Dept_Name'     => $EditDeptName, 
                'CDL_Audit_User'    => session('u_id'),
                'CDL_Audit_Date'    => $current_date
            );
            $this->ReferenceMaintenanceModel->UpdateDept($CDL_Ref_No,$data); 
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function EditPos(){
        try {
            $request = \Config\Services::request();
            
            $CPL_Ref_No = $request->getPost('CPL_Ref_No');
            $EditPDeptCode = $request->getPost('EditPDeptCode');
            $EditPosName = $request->getPost('EditPosName');
            $EditLevel = $request->getPost('EditLevel');
            $getcurrentdate = $this->ReferenceMaintenanceModel->getcurrentdate();
            
            foreach($getcurrentdate as $tmp){
                $current_date = $tmp->currentdatetime;
            } 

            $data = array(
                'CPL_CDL_Ref_No'    => $EditPDeptCode,
                'CPL_Position_Name' => $EditPosName,
                'CPL_Level'         => $EditLevel, 
                'CPL_Audit_User'    => session('u_id'),
                'CPL_Audit_Date'    => $current_date
            );
            $this->ReferenceMaintenanceModel->UpdatePos($CPL_Ref_No,$data); 
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function EditSec(){
        try {
            $request = \Config\Services::request();
            
            $CSL_Ref_No = $request->getPost('CSL_Ref_No');
            $EditSDeptCode = $request->getPost('EditSDeptCode');
            $EditSecName = $request->getPost('EditSecName'); 
            $getcurrentdate = $this->ReferenceMaintenanceModel->getcurrentdate();
            
            foreach($getcurrentdate as $tmp){
                $current_date = $tmp->currentdatetime;
            } 

            $data = array(
                'CSL_CDL_Ref_No'    => $EditSDeptCode,
                'CSL_Section'       => $EditSecName, 
                'CSL_Audit_User'    => session('u_id'),
                'CSL_Audit_Date'    => $current_date
            );
            $this->ReferenceMaintenanceModel->UpdateSec($CSL_Ref_No,$data); 
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getcompanydeptlist(){
        try {
            $request = \Config\Services::request();
            
            $val = $request->getPost('val'); 

            return json_encode($this->ReferenceMaintenanceModel->getcompanydeptlist($val));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getdeptsectionlist(){
        try {
            $request = \Config\Services::request();
            
            $val = $request->getPost('val'); 

            return json_encode($this->ReferenceMaintenanceModel->getdeptsectionlist($val));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getdeptpositionlist(){
        try {
            $request = \Config\Services::request();
            
            $val = $request->getPost('val'); 

            return json_encode($this->ReferenceMaintenanceModel->getdeptpositionlist($val));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}