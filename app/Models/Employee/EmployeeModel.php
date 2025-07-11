<?php

namespace app\Models\Employee;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_company';
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
        // $this->request = \Config\Services::request(); 
    }

    public function getcurrentdate(){
        $sql = "SELECT CURRENT_TIMESTAMP as currentdatetime";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }

    public function CheckEmployee($firstName,$lastName,$middleName){
        $builder = $this->db->table("client_employee_list");
        $builder->select("CEL_Ref_No");
        $builder->where("CEL_First_Name",$firstName);
        $builder->where("CEL_Middle_Name",$middleName);
        $builder->where("CEL_Last_Name",$lastName);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function addNewEmployee($data){
        $this->db->table('client_employee_list')->insert($data);
        $insertID = $this->db->insertID();  
        return $insertID;
    }

    public function EditEmployee($Ref_No,$data){
        $query = $this->db->table('client_employee_list');
        $query->where('CEL_Ref_No', $Ref_No);
        $query->update($data);
    }

    public function SearchEmployee($searchString){
        return $this->db->table('client_employee_list')
        ->select('CEL_Ref_No,CEL_Client_ID,CEL_First_Name,CEL_Middle_Name,CEL_Last_Name')
        ->groupStart()
            ->like('CEL_First_Name', $searchString)
            ->orLike('CEL_Middle_Name', $searchString)
            ->orLike('CEL_Last_Name', $searchString)
            ->orLike("CONCAT(CEL_Last_Name,' ',CEL_First_Name)", $searchString)
            ->orLike("CONCAT(CEL_Last_Name,', ',CEL_First_Name)", $searchString) 
        ->groupEnd()
        ->limit(10)
        ->get()
        ->getResult();
    }

    public function getEmployeeDetails($CEL_Ref_No){
        $builder = $this->db->table("client_employee_list");
        $builder->select("*, 
            (SELECT CCL_Company_Name FROM client_company_list where CCL_Ref_No=CEL_Company) as Company,
            (SELECT CDL_Dept_Name FROM client_department_list where CDL_Ref_No=CEL_Dept) as Dept,
            (SELECT CSL_Section FROM client_section_list where CSL_Ref_No=CEL_Section) as Section,
            (SELECT CPL_Position_Name FROM client_position_list where CPL_Ref_No=CEL_Position) as Position,
            (SELECT CPL_Level FROM client_position_list where CPL_Ref_No=CEL_Position) as Level ,
            (SELECT CESL_Date_From FROM client_emp_status_log where CESL_CEL_Ref_No=CEL_Ref_No and CESL_Emp_Status in ('PROBATIONARY','CONTRACTUAL') ORDER BY CESL_Date_From DESC limit 1) as DateHired 
        "); 
        $builder->where("CEL_Ref_No",$CEL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getProvinceList(){
        $builder = $this->db->table("area_list");
        $builder->select("AL_Ref_No,AL_Area_Desc"); 
        $builder->where("AL_Status",'Active');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getCityList($AL_Ref_No){
        $builder = $this->db->table("city_list");
        $builder->select("CM_Ref_No,CM_City_Municipality_Name"); 
        $builder->where("CM_Area_Code",$AL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getBrgyList($CM_Ref_No){
        $builder = $this->db->table("barangay_list");
        $builder->select("BL_Ref_No,BL_Barangay_Name"); 
        $builder->where("BL_City_Code",$CM_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function addEmpStatusLog($data){ 
        $this->db->table('client_emp_status_log')->insert($data);
    }

    public function checkStatusLog($Client_Ref_No,$DateHired){
        $builder = $this->db->table("client_emp_status_log");
        $builder->select("CESL_Ref_No"); 
        $builder->where("CESL_CEL_Ref_No",$Client_Ref_No);
        $builder->where("CESL_Date_From",$DateHired);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    
    public function EditEmpStatusLog($CESL_Ref_No,$data_status_log){
        $query = $this->db->table('client_emp_status_log');
        $query->where('CESL_Ref_No', $CESL_Ref_No);
        $query->update($data_status_log);
    }

    public function SubmitClientRelative($CEL_Ref_No,$FatherName,$Relation,$bdate,$Occupation,$audituser){
        $sql = "CALL usp_jtj_submitClientRelative(?,?,?,?,?,?) "; 
        $params = [
            $CEL_Ref_No,
            $FatherName,
            $Relation,
            $bdate,
            $Occupation,
            $audituser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function SubmitClientAddress($CEL_Ref_No,$Province,$City,$Barangay,$Street,$ZIPCode,$audituser){
        $sql = "CALL usp_jtj_submitClientAddress(?,?,?,?,?,?,?) "; 
        $params = [
            $CEL_Ref_No,
            $Province,
            $City,
            $Barangay,
            $Street,
            $ZIPCode,
            $audituser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function SubmitClientDependents($CEL_Ref_No,$names,$birthdates,$relations,$audituser){
        $sql = "CALL usp_jtj_submitClientDependents(?,?,?,?,?) "; 
        $params = [
            $CEL_Ref_No,
            $names,
            $birthdates,
            $relations,
            $audituser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function SubmitClientEducBackground($CEL_Ref_No,$School,$From,$To,$Degree,$level,$audituser){
        $sql = "CALL usp_jtj_submitClientEducBackground(?,?,?,?,?,?,?) "; 
        $params = [
            $CEL_Ref_No,
            $School,
            $From,
            $To,
            $Degree,
            $level,
            $audituser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function SubmitClientEmployment($CEL_Ref_No,$Company,$Position,$From,$To,$audituser){
        $sql = "CALL usp_jtj_submitClientEmployment(?,?,?,?,?,?) "; 
        $params = [
            $CEL_Ref_No,
            $Company,
            $Position,
            $From,
            $To,
            $audituser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function SubmitClientCharReference($CEL_Ref_No,$CharName,$CharPosition,$CharCompany,$CharContactNo,$audituser){
        $sql = "CALL usp_jtj_submitClientCharReference(?,?,?,?,?,?) "; 
        $params = [
            $CEL_Ref_No,
            $CharName,
            $CharPosition,
            $CharCompany,
            $CharContactNo,
            $audituser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function getEmployeeAddress($CEL_Ref_No){
        $builder = $this->db->table("client_address_list");
        $builder->select("*"); 
        $builder->where("CAL_CEL_Ref_No",$CEL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getEmployeeRelatives($CEL_Ref_No){
        $builder = $this->db->table("client_relatives_list");
        $builder->select("*"); 
        $builder->where("CRL_CEL_Ref_No",$CEL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getEmployeeDependents($CEL_Ref_No){
        $builder = $this->db->table("client_dependents_list");
        $builder->select("*"); 
        $builder->where("CDL_CEL_Ref_No",$CEL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getEmployeeEducBackground($CEL_Ref_No){
        $builder = $this->db->table("client_educ_attainment");
        $builder->select("*"); 
        $builder->where("CEA_CEL_Ref_No",$CEL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getEmployeeEmployment($CEL_Ref_No){
        $builder = $this->db->table("client_employment_list");
        $builder->select("*"); 
        $builder->where("CEMP_CEL_Ref_No",$CEL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    
    public function getEmployeeCharReference($CEL_Ref_No){
        $builder = $this->db->table("client_char_reference_list");
        $builder->select("*"); 
        $builder->where("CCR_CEL_Ref_No",$CEL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    
 
}
?>