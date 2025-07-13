<?php

namespace app\Models\Payroll;

use CodeIgniter\Model;

class PayrollModel extends Model
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

    public function inserttimelogs($data){ 
        $this->db->table('client_uploaded_timelogs')->insert($data);
    }

    public function updatetimelogs($refno,$data){
        return $this->db->table('client_uploaded_timelogs')
                    ->where('CUT_Ref_No', $refno)
                    ->update($data);
    }

    public function retrieveuploadedlogs($company,$from,$to){ 
        $sql = "CALL usp_jtj_gettimelogs (?,?,?) "; 
        $params = [
            $company,
            $from,
            $to
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;

        // $builder = $this->db->table("client_uploaded_timelogs");
        // $builder->select("*");
        // $builder->where("CUT_Company_Code",$company);
        // $builder->where("CUT_From",$from);
        // $builder->where("CUT_To",$to);
        // $query = $builder->get();
        // $result = $query->getResult(); 
        // return $result;
    }

    public function retrieveconvertedlogs($company,$from,$to){
        $sql = "CALL usp_jtj_converttimelogs (?,?,?) "; 
        $params = [
            $company,
            $from,
            $to
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function getvalidatedlogs($company,$from,$to){
        $sql = "CALL usp_jtj_getvalidatedlogs (?,?,?) "; 
        $params = [
            $company,
            $from,
            $to
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function getpayslip_details($From,$To,$Company,$Client){
        $sql = "CALL usp_jtj_getvalidatedlogs (?,?,?) "; 
        $params = [
            $From,
            $To,
            $Company,
            $Client
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function checkduplicatetimelogs($CompanyCode,$Datefrom,$Dateto,$EmpNo){
        $builder = $this->db->table("client_uploaded_timelogs");
        $builder->select("CUT_Ref_No");
        $builder->where("CUT_Company_Code",$CompanyCode);
        $builder->where("CUT_From",$Datefrom);
        $builder->where("CUT_To",$Dateto);
        $builder->where("CUT_Client_ID",$EmpNo);
        $query = $builder->get();
        $result = $query->getResult(); 
        return $result;
    }

    public function getemployeedetails($Company,$From,$To,$Client){
        $builder = $this->db->table("client_uploaded_timelogs"); 
        $builder->join("client_employee_list","CUT_Client_ID=CEL_Client_ID","INNER");
        $builder->select("*");
        $builder->where("CUT_Company_Code",$Company);
        $builder->where("CUT_From",$From);
        $builder->where("CUT_To",$To);
        $builder->where("CUT_Client_ID",$Client);

        $query = $builder->get();
        $result = $query->getResult(); 
        return $result;

    }

    public function getprintregister($Company,$From,$To){
        $builder = $this->db->table("client_uploaded_timelogs"); 
        $builder->select("*");
        $builder->join("client_employee_list","CUT_Client_ID=CEL_Client_ID","INNER");
        $builder->join("client_company_list","CCL_Company_Code=CUT_Company_Code","INNER");
        $builder->where("CUT_Company_Code",$Company);
        $builder->where("CUT_From",$From);
        $builder->where("CUT_To",$To);  
        $builder->orderBy("CEL_Last_Name,CEL_First_Name","ASC");
        $query = $builder->get();
        $result = $query->getResult(); 
        return $result;
    }
    // NAG CREATE AKO ISA PANG STORED PROC SIR. FILTERED BY ARRAY REFERENCES (SELECTED CUT_Ref_No)
    public function getselectedlogsdata($references){
        $sql = "CALL usp_jtj_gettimelogs_by_refno (?) "; 
        $params = [$references];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function insert_record($data, $table)
    {
        return $this->db->table($table)->insert($data); 
    }

    public function insert_batch($table, $data) 
    {
        $builder = $this->db->table($table);
        return $builder->insertBatch($data); 
    }

    public function update_logs($data, $id, $table, $field)
    {
        $builder = $this->db->table($table);
        $builder->where($field, $id); 
        return $builder->update($data); 
    }

    public function getemployeebycompanyId($code)
    {
        return $this->db->table('client_employee_list')
            ->select("CEL_Client_ID, CONCAT(CEL_Last_Name,', ',CEL_First_Name) AS Employee")
            ->join('client_company_list', 'CEL_Company = CCL_Ref_No', 'inner')
            ->where('CCL_Company_Code', $code)
            ->orderBy('Employee', 'asc')
            ->get()
            ->getResultArray();
    }
} 