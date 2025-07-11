<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;


class ReferenceMaintenanceModel extends Model
{ 
    protected $str;


    public function getcurrentdate(){
        $sql = "SELECT CURRENT_TIMESTAMP as currentdatetime";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }

    public function getcompanylist(): array
    {
        $builder = $this->db->table("client_company_list");
        $builder->select("  CCL_Ref_No,
                            CCL_Company_Code,
                            CCL_Company_Name,
                            CCL_Cutoff1_From,
                            CCL_Cutoff1_To,
                            CCL_Cutoff2_From,
                            CCL_Cutoff2_To,
                            CCL_Status");
        $builder->orderBy("CCL_Company_Code,CCL_Company_Name");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function insertcompany($CompanyCode,$CompanyName,$Cutoff1_From,$Cutoff1_To,$Cutoff2_From,$Cutoff2_To,$AuditUser){
        $sql = "CALL usp_jtj_insertcompany(?,?,?,?,?,?,?) "; 
        $params = [
            $CompanyCode,
            $CompanyName, 
            $Cutoff1_From,
            $Cutoff1_To,
            $Cutoff2_From,
            $Cutoff2_To,
            $AuditUser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function insertdept($DCompanyCode,$DeptCode,$DeptName,$AuditUser){
        $sql = "CALL usp_jtj_insertdept(?,?,?,?) "; 
        $params = [
            $DCompanyCode,
            $DeptCode, 
            $DeptName,
            $AuditUser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function insertpos($PDeptCode,$PosName,$Level,$AuditUser){
        $sql = "CALL usp_jtj_insertpos(?,?,?,?) "; 
        $params = [
            $PDeptCode,
            $PosName, 
            $Level,
            $AuditUser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function insertsec($SDeptCode,$SecName,$AuditUser){
        $sql = "CALL usp_jtj_insertsec(?,?,?) "; 
        $params = [
            $SDeptCode,
            $SecName,  
            $AuditUser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function getdeptlist(){
        
        $builder = $this->db->table("client_department_list");
        $builder->select("  CDL_Ref_No,
                            CDL_CCL_Ref_No,
                            (SELECT CCL_Company_Name FROM client_company_list where CCL_Ref_No=CDL_CCL_Ref_No) as CompanyName,
                            CDL_Dept_Code,
                            CDL_Dept_Name,
                            CDL_Status");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getposlist(){
        $builder = $this->db->table("client_position_list");
        $builder->select("  CPL_Ref_No,
                            CPL_CDL_Ref_No,
                            (SELECT CDL_Dept_Name FROM client_department_list where CDL_Ref_No=CPL_CDL_Ref_No) as DeptName,
                            CPL_Position_Name,
                            CPL_Level,
                            CPL_Status");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getseclist(){
        $builder = $this->db->table("client_section_list");
        $builder->select("  CSL_Ref_No,
                            CSL_CDL_Ref_No,
                            (SELECT CDL_Dept_Name FROM client_department_list where CDL_Ref_No=CSL_CDL_Ref_No) as DeptName,
                            CSL_Section,
                            CSL_Status");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function UpdateCompany($refno,$data){
        $query = $this->db->table('client_company_list');
        $query->where('CCL_Ref_No', $refno);
        $query->update($data);
    }

    public function UpdateDept($refno,$data){
        $query = $this->db->table('client_department_list');
        $query->where('CDL_Ref_No', $refno);
        $query->update($data);
    }

    public function UpdatePos($refno,$data){
        $query = $this->db->table('client_position_list');
        $query->where('CPL_Ref_No', $refno);
        $query->update($data);
    }

    public function UpdateSec($refno,$data){
        $query = $this->db->table('client_section_list');
        $query->where('CSL_Ref_No', $refno);
        $query->update($data);
    }

    public function getcompanydeptlist($val){
        $builder = $this->db->table("client_department_list");
        $builder->select("  CDL_Ref_No,
                            CDL_CCL_Ref_No,
                            (SELECT CCL_Company_Name FROM client_company_list where CCL_Ref_No=CDL_CCL_Ref_No) as CompanyName,
                            CDL_Dept_Code,
                            CDL_Dept_Name,
                            CDL_Status");
        $builder->where('CDL_CCL_Ref_No',$val);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getdeptsectionlist($val){
        $builder = $this->db->table("client_section_list");
        $builder->select("  CSL_Ref_No,
                            CSL_CDL_Ref_No,
                            (SELECT CDL_Dept_Name FROM client_department_list where CDL_Ref_No=CSL_CDL_Ref_No) as DeptName,
                            CSL_Section,
                            CSL_Status");
        $builder->where('CSL_CDL_Ref_No',$val);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getdeptpositionlist($val){
        $builder = $this->db->table("client_position_list");
        $builder->select("  CPL_Ref_No,
                            CPL_CDL_Ref_No,
                            (SELECT CDL_Dept_Name FROM client_department_list where CDL_Ref_No=CPL_CDL_Ref_No) as DeptName,
                            CPL_Position_Name,
                            CPL_Level,
                            CPL_Status");
        $builder->where('CPL_CDL_Ref_No',$val);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
}


?>