<?php

namespace app\Models\Operations;

use CodeIgniter\Model;

class OperationsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_company';
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
        // $this->request = \Config\Services::request(); 
    }

    public function getprovince(){
        $sql = "SELECT * FROM area_list";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }

    public function getcities($province){
        $sql = "SELECT * FROM city_list where CM_Area_Code='$province'";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }

    public function getbrgys($city){
        $sql = "SELECT * FROM barangay_list where BL_City_Code='$city'";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }
    
    public function insert_client($FirstName,$MiddleName,$LastName,$ExtName,$BirthDate,$Gender,$Religion,$Nationality,$Audit_User){
        // $this->db->table('client_information')->insert($data);
        $sql = "CALL usp_jtj_insertclient ('$FirstName','$MiddleName','$LastName','$ExtName','$BirthDate','$Gender','$Religion','$Nationality','$Audit_User') "; 
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result;
    }

    public function insert_client_address($data)
    {
        $this->db->table('client_address_log')->insert($data);
    }

    public function insert_client_contact_logs($clientcode,$TelNo,$MobileNo,$EmailAdd,$Audit_User)
    {
        $sql = "CALL usp_jtj_insertclient_contactlogs ('$clientcode','$TelNo','$MobileNo','$EmailAdd','$Audit_User') "; 
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result;
    }

    public function insert_client_employment($data)
    {
        $this->db->table('client_employment_log')->insert($data); 
    }

    public function insert_client_references($clientcode,$ReferredBy,$Guardian,$GuardianOccupation,$GuardianReason,$Audit_User)
    {
        $sql = "CALL usp_jtj_insertclient_references ('$clientcode','$ReferredBy','$Guardian','$GuardianOccupation','$GuardianReason','$Audit_User') "; 
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result;
    }

    public function insert_client_medhistory($data)
    {
        $this->db->table('client_medical_history')->insert($data); 
    }

    public function insert_app($data){
        $this->db->table('client_status_log')->insert($data);
    }

    public function getclients(){
        $sql = "SELECT CLI_Code,CLI_FName,CLI_MName,CLI_LName
                FROM client_information ;";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }
    
    public function getrooms(){
        $sql = "SELECT *
                FROM room_list;";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }

    public function getoperations(){
        $sql = "SELECT OL_Operation_ID,OL_Ref_No,OL_Operation_Desc,OL_Standard_Hrs,OL_Cost,OL_Price,OL_Status FROM operation_list  ";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }

    public function getdentists(){
        $sql = "SELECT DID,FULLNAME FROM user_access where position ='1' and STATUS='1' order by FULLNAME";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result; 
    }

    public function getschedule(){
        $sql = "SELECT 
                CONCAT	(
                            (SELECT CONCAT(CLI_LName,', ',CLI_FName) FROM client_information where CLI_Code=CSL_Client_Code),' - ',
                            (SELECT OL_Operation_Desc FROM operation_list where OL_Ref_No=CSL_Activity),' - ',
                            (SELECT FULLNAME FROM user_access where DID=CSL_Action_Needed_By),' - ',
                            CSL_Location
                        ) as title,
                        '#1c2880' as backgroundColor,
                        'white' as borderColor,
                CSL_Date as start,
                DATE_ADD(CSL_Date, INTERVAL CSL_Duration HOUR) as end 
                FROM client_status_log;";
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result;
    }

    public function insert_operation($data){ 
        $this->db->table('operation_list')->insert($data);
    }

    public function insert_room($data){
        $this->db->table('room_list')->insert($data);

    }

    public function updateproc($refno,$data){
        $query = $this->db->table('operation_list');
        $query->where('OL_Ref_No', $refno);
        $query->update($data);
    }
    

    

}
