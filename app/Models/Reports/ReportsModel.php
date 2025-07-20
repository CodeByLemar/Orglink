<?php

namespace app\Models\Reports;

use CodeIgniter\Model;

class ReportsModel extends Model
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

    public function getcollection_report($from,$to){
        $sql = " SELECT 
                    PL_ARML_Ref_No,
                    PL_Date,
                    CONCAT(CLI_LName,', ',CLI_FName,' ',CLI_MName) as clientname,
                    PL_Amount_Due,
                    PL_Amount_Paid,
                    (PL_Amount_Due - PL_Amount_Paid) as OustandingBal,
                    PL_Mode_Of_Payment,
                    PL_OR_Number,
                    CASE
                        WHEN PL_Mode_Of_Payment='Debit Card' THEN (SELECT BL_Description FROM Bank_List where BL_Ref_No=PL_Bank_Company limit 1) 
                        WHEN PL_Mode_Of_Payment='Credit Card' THEN (SELECT BL_Description FROM Bank_List where BL_Ref_No=PL_Bank_Company limit 1) 
                        WHEN PL_Mode_Of_Payment='Online Payment' THEN (SELECT BL_Description FROM Bank_List where BL_Ref_No=PL_Bank_Company limit 1) 
                        WHEN PL_Mode_Of_Payment='HMO' THEN (SELECT HCL_Description FROM hmo_company_list where HCL_Ref_No=PL_Bank_Company limit 1) 
                        ELSE ''
                    END as BankCompanyReference
                FROM dentistdb.payment_list 
                INNER JOIN ar_main_list ON PL_ARML_Ref_No=ARML_Ref_No
                INNER JOIN client_information ON CLI_Code=ARML_Client_No
                where PL_Date>='$from' and PL_Date<='$to'
                GROUP BY PL_ARML_Ref_No,PL_Date,ARML_Client_No,PL_Mode_Of_Payment,PL_OR_Number;";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }

    public function generatealphalist($company){
        $builder = $this->db->table("client_employee_list as emp");
        $builder->select("CEL_TIN,
                            CEL_Last_Name,
                            CEL_First_Name,
                            CEL_Middle_Name,
                            CEL_Birth_Date,
                            CEL_Contact_No,
                            Cel_Citizenship,
                            SUBSTRING(CEL_Emp_Status,1,1) as EmpStatus,
                            AL_Region,
                            AL_Area_Desc,
                            CM_City_Municipality_Name,
                            BL_Barangay_Name,
                            CAL_Street,
                            CAL_Zip_Code,
                            CEL_SSS,
                            CEL_Contract_End_Date");
        $builder->join("client_address_list as addr","emp.CEL_Ref_No=addr.CAL_CEL_Ref_No","LEFT");
        $builder->join("area_list","AL_Ref_No=CAL_Province","LEFT");
        $builder->join("city_list","CM_Ref_No=CAL_City","LEFT");
        $builder->join("barangay_list","BL_Ref_No=CAL_Brgy","LEFT");
        $builder->where('CEL_Company',$company);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function insert_dtr($table, $data) 
    {
        $builder = $this->db->table($table);
        return $builder->insertBatch($data); 
    }

    public function loaduploadedlistofdiscrepancy()
    {
        $builder = $this->db->table('client_discrepancy_report AS cdr');
        $builder->select('
            cdr.CDR_Ref_No,
            cdr.CDR_DTR_No,
            cdr.CDR_OT,
            cdr.CDR_Date_From,
            cdr.CDR_Date_To,
            cdr.CDR_Client_ID,
            cdr.CDR_Full_Name,
            ccl.CCL_Company_Name,
            cdr.CDR_WHrs,
            cdr.CDR_LHrs,
            cdr.CDR_RDOT,
            cdr.CDR_Regular_Hol_OT,
            cdr.CDR_Special_Hol_OT,
            cdr.CDR_OT8,
            cdr.CDR_NPOT,
            cdr.CDR_NP,
            cdr.CDR_NP8,
            cpl.CPL_Position_Name
        ');
        
        $builder->join('client_company_list AS ccl', 'cdr.CDR_Company_Code = ccl.CCL_Company_Code', 'inner');
        $builder->join('client_employee_list AS cel', 'cdr.CDR_Client_ID = cel.CEL_Client_ID', 'left');
        $builder->join('client_position_list AS cpl', 'cel.CEL_Position = cpl.CPL_Ref_No', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
?>
