<?php

namespace app\Models\Procedures;

use CodeIgniter\Model;

class ProceduresModel extends Model
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

    public function getprovince(){
        $builder = $this->db->table("area_list");
        $builder->select("*");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT * FROM area_list";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result; 
    }

    public function getcities($province){
        $builder = $this->db->table("city_list");
        $builder->select("*");
        $builder->where("CM_Area_Code",$province);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT * FROM city_list where CM_Area_Code='$province'";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result; 
    }

    public function getbrgys($city){
        $builder = $this->db->table("barangay_list");
        $builder->select("*");
        $builder->where("BL_City_Code",$city);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
        // $sql = "SELECT * FROM barangay_list where BL_City_Code='$city'";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result; 
    }
    
    public function insert_client($oldclientcode,$FirstName,$MiddleName,$LastName,$ExtName,$BirthDate,$Gender,$Religion,$Nationality,$Discount,$disc_ref_no,$Audit_User){
        // $this->db->table('client_information')->insert($data);
        $sql = "CALL usp_jtj_insertclient (?,?,?,?,?,?,?,?,?,?,?,?) "; 
        $params = [
            $oldclientcode,
            $FirstName,
            $MiddleName,
            $LastName,
            $ExtName,
            $BirthDate,
            $Gender,
            $Religion,
            $Nationality,
            $Discount,
            $disc_ref_no,
            $Audit_User
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;

        // $sql = "CALL usp_jtj_insertclient ('$oldclientcode','$FirstName','$MiddleName','$LastName','$ExtName','$BirthDate','$Gender','$Religion','$Nationality','$Discount','$disc_ref_no','$Audit_User') "; 
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function insert_client_address($data)
    {
        $this->db->table('client_address_log')->insert($data);
    }

    public function insert_client_contact_logs($clientcode,$TelNo,$MobileNo,$EmailAdd,$Audit_User)
    {
        $sql = "CALL usp_jtj_insertclient_contactlogs (?,?,?,?,?) "; 
        $params = [
            $clientcode,
            $TelNo,
            $MobileNo,
            $EmailAdd,
            $Audit_User
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;

        // $sql = "CALL usp_jtj_insertclient_contactlogs ('$clientcode','$TelNo','$MobileNo','$EmailAdd','$Audit_User') "; 
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function insert_client_employment($data)
    {
        $this->db->table('client_employment_log')->insert($data); 
    }

    public function insert_client_references($clientcode,$ReferredBy,$Guardian,$GuardianOccupation,$GuardianReason,$Audit_User)
    {
        $sql = "CALL usp_jtj_insertclient_references (?,?,?,?,?,?) "; 
        $params = [
            $clientcode,
            $ReferredBy,
            $Guardian,
            $GuardianOccupation,
            $GuardianReason,
            $Audit_User
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;

        // $sql = "CALL usp_jtj_insertclient_references ('$clientcode','$ReferredBy','$Guardian','$GuardianOccupation','$GuardianReason','$Audit_User') "; 
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function insert_client_medhistory($data)
    {
        $this->db->table('client_medical_history')->insert($data); 
    }

    public function insert_app($data){
        $this->db->table('client_status_log')->insert($data);
        $id = $this->db->insertID();
        return $id;
    }

    public function insert_proc_log($data){ 
        $this->db->table('client_appointment_proc_log')->insert($data);
    }

    public function getclients(){
        $builder = $this->db->table("client_information");
        $builder->select("CLI_Code,CLI_FName,CLI_MName,CLI_LName");
        $query = $builder->get();
        $result = $query->getResult(); 
        return $result;
        // $sql = "SELECT CLI_Code,CLI_FName,CLI_MName,CLI_LName
        //         FROM client_information ;";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result; 
    }
    
    public function getrooms($branch){
        $builder = $this->db->table("room_list");
        $builder->select("room_list.*, BL_Branch_Desc");
        $builder->join("branch_list","RL_Branch_Code = BL_Branch_Code","LEFT");
        if($branch){
            $builder->where("BL_Branch_Code",$branch);
        }
        $builder->where("RL_Status","Active");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
       
        // if($branch){
        //     $sql = "SELECT room_list.*, BL_Branch_Desc
        //     FROM room_list
        //     LEFT JOIN branch_list ON RL_Branch_Code = BL_Branch_Code
        //     WHERE BL_Branch_Code = '$branch' and RL_Status='Active'";
        // }else{
        //     $sql = "SELECT room_list.*, BL_Branch_Desc
        //     FROM room_list
        //     LEFT JOIN branch_list ON RL_Branch_Code = BL_Branch_Code  
        //     WHERE RL_Status='Active'";
        // }
        
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result; 
    }

    public function getprocedurelist(){
        $builder = $this->db->table("procedure_list");
        $builder->select("PL_Ref_No,PL_Procedure_Desc,SPL_Ref_No,SPL_Procedure_ID,SPL_SubProcedure_ID,SPL_SubProcedure_Desc,SPL_Standard_Hrs,SPL_Price,SPL_Cost,SPL_Status");
        $builder->join("subprocedure_list","PL_Procedure_ID=SPL_Procedure_ID","INNER");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT PL_Ref_No,PL_Procedure_Desc,SPL_Ref_No,SPL_Procedure_ID,SPL_SubProcedure_ID,SPL_SubProcedure_Desc,SPL_Standard_Hrs,SPL_Price,SPL_Cost,SPL_Status  
        //             FROM procedure_list
        //             INNER JOIN subprocedure_list ON PL_Procedure_ID=SPL_Procedure_ID; ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function getprocedures(){
        $builder = $this->db->table("procedure_list");
        $builder->select("PL_Ref_No, PL_Procedure_ID,PL_Procedure_Desc");
        $builder->orderBy("PL_Procedure_Desc");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT PL_Ref_No, PL_Procedure_ID,PL_Procedure_Desc FROM procedure_list ORDER BY PL_Procedure_Desc ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result; 
    }

    public function getSubProcedures(){
        $builder = $this->db->table("subprocedure_list");
        $builder->select("* , CONCAT((SELECT PL_Procedure_Desc FROM procedure_list where PL_Procedure_ID=SPL_Procedure_ID),' - ',SPL_SubProcedure_Desc) as ProcDesc");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT * ,
        //         CONCAT((SELECT PL_Procedure_Desc FROM procedure_list where PL_Procedure_ID=SPL_Procedure_ID),' - ',SPL_SubProcedure_Desc) as ProcDesc
        //         FROM subprocedure_list ;";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result; 
    }

    public function getbranches(){
        $builder = $this->db->table("branch_list");
        $builder->select("*");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT * FROM branch_list  ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function getdentists(){
        $builder = $this->db->table("user_access");
        $builder->select("DID,FULLNAME");
        $builder->where("position",'1');
        $builder->where("STATUS",'1');
        $builder->orderBy("FULLNAME");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT DID,FULLNAME FROM user_access where position ='1' and STATUS='1' order by FULLNAME";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result; 
    }

    public function getschedule(){
        // (SELECT PL_procedure_Desc FROM procedure_list where PL_Ref_No=CSL_Activity),' - ',
        $builder = $this->db->table("client_status_log");
        $builder->select("CONCAT(CSL_Ref_No,' - ',
                                (SELECT CONCAT(CLI_LName,', ',CLI_FName) FROM client_information where CLI_Code=CSL_Client_Code),' - ',
                                
                                (SELECT FULLNAME FROM user_access where DID=CSL_Action_Needed_By),' - ',
                                RL_Description
                            ) as title, 
                        'black' as borderColor,
                        (SELECT Color_Tagging 
                        FROM user_access
                        WHERE DID=CSL_Action_Needed_By) as 	backgroundColor,
                        'black' as textColor, 
                CSL_Date as start, 
                DATE_ADD(CSL_Date, INTERVAL CSL_Duration HOUR) as end   ");
        // $query = $this->db->query($sql); 
        //         DATE_ADD(CSL_Date, INTERVAL CSL_Duration HOUR) as end");
        $builder->join("room_list","RL_Ref_No = CSL_Location","INNER");
        $builder->where("CSL_Status","Active");
        $query = $builder->get(); 
        $result = $query->getResult();
        return $result;
        // $sql = "SELECT 
        //         CONCAT	(
        //                     CSL_Ref_No,' - ',
        //                     (SELECT CONCAT(CLI_LName,', ',CLI_FName) FROM client_information where CLI_Code=CSL_Client_Code),' - ',
                            
        //                     (SELECT FULLNAME FROM user_access where DID=CSL_Action_Needed_By),' - ',
        //                     RL_Description
        //                 ) as title,
        //                 '#1c2880' as backgroundColor,
        //                 'white' as borderColor,
        //         CSL_Date as start,
        //         DATE_ADD(CSL_Date, INTERVAL CSL_Duration HOUR) as end 
        //         FROM client_status_log
        //         INNER JOIN room_list ON RL_Ref_No = CSL_Location;";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  s$result;
    }

    public function insert_procedure($data){ 
        $this->db->table('procedure_list')->insert($data);
    }

    public function insert_subprocedure($data){
        $this->db->table('subprocedure_list')->insert($data);
    }

    public function insert_branch($data){
        $this->db->table('branch_list')->insert($data);
    }

    public function insert_room($data){
        $this->db->table('room_list')->insert($data); 
    }

    public function updateproc($refno,$data){
        $query = $this->db->table('procedure_list');
        $query->where('PL_Ref_No', $refno);
        $query->update($data);
    }
    
    public function updatebranch($refno,$data){
        $query = $this->db->table('branch_list');
        $query->where('BL_Branch_Code', $refno);
        $query->update($data);
    }

    public function updateroom($refno,$data){
        $query = $this->db->table('room_list');
        $query->where('RL_Ref_No', $refno);
        $query->update($data);
    }

    public function addnewitem($item_no,$item_desc,$item_unit,$item_cost,$audituser){
        $sql = "CALL usp_jtj_addnewitem (?,?,?,?,?) "; 
        $params = [
            $item_no,
            $item_desc,
            $item_unit,
            $item_cost,
            $audituser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;

        // $sql = "CALL usp_jtj_addnewitem ('$item_no','$item_desc','$item_unit','$item_cost','$audituser') "; 
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }
 

    public function getitemmaster(){
        $builder = $this->db->table("item_master_list");
        $builder->select("*");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT * FROM item_master_list; ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    
    public function updateitem($refno,$data){
        $query = $this->db->table('item_master_list');
        $query->where('IM_Item_No', $refno);
        $query->update($data);
    }

    public function getconfigprocs($branch){
        $builder = $this->db->table("item_inventory_list as a");
        $builder->select("*");
        $builder->join("item_master_list as b","a.IVL_Item_No = b.IM_Item_No");
        $builder->where("IVL_Branch_Code",$branch);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "    SELECT * 
        //             FROM item_inventory_list as a
        //             INNER JOIN item_master_list as b ON a.IVL_Item_No = b.IM_Item_No
        //             WHERE IVL_Branch_Code=$branch ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function getproc_items($proc){
        $builder = $this->db->table("item_master_list as a");
        $builder->select("*");
        $builder->join("procedure_item_tagging_list as b","b.PTL_Item_No = a.IM_Item_No ","INNER");
        $builder->where("PTL_SubProcedure_ID",$proc);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "    SELECT * 
        //             FROM item_master_list as a
        //             INNER JOIN procedure_item_tagging_list as b ON b.PTL_Item_No = a.IM_Item_No 
        //             WHERE PTL_SubProcedure_ID='$proc' ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function add_itemproc($proc,$item,$audituser){
        $sql = "CALL usp_jtj_add_itemproc (?,?,?) "; 
        $params = [
            $proc,
            $item,
            $audituser
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;

        // $sql = "CALL usp_jtj_add_itemproc ('$proc','$item','$audituser') "; 
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function getbreakdown($refno){
        $builder = $this->db->table("client_status_log");
        $builder->select("CSL_Ref_No,
                            (SELECT FULLNAME FROM user_access where DID=CSL_Action_Needed_By) as incharge,
                            (SELECT CONCAT(CLI_LName,', ',CLI_FName) FROM client_information where CLI_Code=CSL_Client_Code) as clientname,
                            RL_Description, 
                            (SELECT BL_Branch_Desc FROM branch_list where BL_Branch_Code=RL_Branch_Code) as Branch,
                            CSL_Date as start,
                            DATE_ADD(CSL_Date, INTERVAL CSL_Duration HOUR) as end ,

                            PTL_Ref_No,
                            PTL_Item_No,
                            IM_Item_Description,
                            CSL_Result_Remarks,
                            CSL_Teeth,
                            (SELECT 
                                CONCAT(CLIAL_Street,' ',(SELECT BL_Barangay_Name FROM barangay_list where BL_Ref_No=CLIAL_Barangay_Code),', ',
                                        (SELECT CM_City_Municipality_Name FROM city_list where CM_Ref_No=CLIAL_City_Code),', ',
                                        (SELECT AL_Area_Desc FROM area_list where AL_Ref_No=CLIAL_Area_Code)
                                ) 
                            FROM client_address_log 
                            where CLIAL_CLI_Code=CSL_Client_Code) as Full_Address,
                            CSL_Result_Remarks,
                            ARML_Date as Billing_Date,
                            (SELECT SUM(ARPS_Amount) FROM ar_payment_schedule where ARPS_ARML_Ref_No=ARML_Ref_No) as AmountDue,
                            (SELECT SUM(PL_Amount_Paid) FROM payment_list where PL_ARML_Ref_No=ARML_Ref_No) as Payment");
        $builder->join("room_list","RL_Ref_No = CSL_Location","INNER");
        $builder->join("procedure_item_tagging_list","PTL_SubProcedure_ID=CSL_Activity","LEFT");
        $builder->join("item_master_list","IM_Item_No = PTL_Item_No","LEFT");
        $builder->join("ar_main_list","ARML_CSL_Ref_No = CSL_Ref_No","LEFT"); 
        $builder->where("CSL_Ref_No",$refno);
        $query = $builder->get();
        $result = $query->getResult();
        return $result; 
        // (SELECT GROUP_CONCAT((SELECT SPL_SubProcedure_Desc FROM subprocedure_list WHERE SPL_Ref_No=CAPL_Procedure))  as Procedures
        //             FROM client_appointment_proc_log where CAPL_CSL_Ref_No=CSL_Ref_No
        //             GROUP BY CAPL_Procedure) as Procs,
        
        // CSL_Result_Remarks,
        // ARML_Date as Billing_Date,
        // (SELECT PL_Date FROM payment_list where PL_ARML_Ref_No=ARML_Ref_No) as Payment
        // LEFT JOIN ar_main_list ON ARML_CSL_Ref_No=CSL_Ref_No

        // $sql = "    SELECT 
        //             CSL_Ref_No,
        //             (SELECT FULLNAME FROM user_access where DID=CSL_Action_Needed_By) as incharge,
        //             (SELECT CONCAT(CLI_LName,', ',CLI_FName) FROM client_information where CLI_Code=CSL_Client_Code) as clientname,
        //             RL_Description, 
        //             (SELECT BL_Branch_Desc FROM branch_list where BL_Branch_Code=RL_Branch_Code) as Branch,
        //             CSL_Date as start,
        //             DATE_ADD(CSL_Date, INTERVAL CSL_Duration HOUR) as end ,

        //             PTL_Ref_No,
        //             PTL_Item_No,
        //             IM_Item_Description,
        //             CSL_Result_Remarks,
        //             CSL_Teeth,
        //             (SELECT 
        //                 CONCAT(CLIAL_Street,' ',(SELECT BL_Barangay_Name FROM barangay_list where BL_Ref_No=CLIAL_Barangay_Code),', ',
        //                         (SELECT CM_City_Municipality_Name FROM city_list where CM_Ref_No=CLIAL_City_Code),', ',
        //                         (SELECT AL_Area_Desc FROM area_list where AL_Ref_No=CLIAL_Area_Code)
        //                 ) 
        //             FROM client_address_log 
        //             where CLIAL_CLI_Code=CSL_Client_Code) as Full_Address,
        //             CSL_Result_Remarks,
        //             ARML_Date as Billing_Date,
        //             (SELECT SUM(ARPS_Amount) FROM ar_payment_schedule where ARPS_ARML_Ref_No=ARML_Ref_No) as AmountDue,
        //             (SELECT SUM(PL_Amount_Paid) FROM payment_list where PL_ARML_Ref_No=ARML_Ref_No) as Payment
        //             FROM client_status_log 
        //             INNER JOIN room_list ON RL_Ref_No = CSL_Location
        //             LEFT JOIN procedure_item_tagging_list ON PTL_SubProcedure_ID=CSL_Activity
        //             LEFT JOIN item_master_list ON IM_Item_No = PTL_Item_No
        //             LEFT JOIN ar_main_list ON ARML_CSL_Ref_No = CSL_Ref_No
        //             where CSL_Ref_No='$refno'; ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function getprocbreakdown($refno){
        $builder = $this->db->table("client_appointment_proc_log as a ");
        $builder->select(" CLI_LName  ,CLI_MName ,CLI_FName ,CSL_Date,CAPL_Procedure,CSL_Client_Code,CLI_Code,CSL_Action_Needed_By,SPL_Ref_No,
	                    SPL_SubProcedure_Desc,SPL_Price,SPL_Cost,CLI_Discount,CLI_Discount_Ref_No");
                        $builder->join("subprocedure_list as b","a.CAPL_Procedure = b.SPL_Ref_No","INNER");
                        $builder->join("client_status_log","CSL_Ref_No =CAPL_CSL_Ref_No","INNER");
                        $builder->join("client_information","CLI_Code = CSL_Client_Code","INNER");
        $builder->where("CAPL_CSL_Ref_No",$refno);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "    SELECT 
        //                 CAPL_Procedure,CSL_Client_Code,CLI_Code,CSL_Action_Needed_By,SPL_Ref_No,
	    //                 SPL_SubProcedure_Desc,SPL_Price,SPL_Cost,CLI_Discount,CLI_Discount_Ref_No
                    
        //             FROM client_appointment_proc_log as a  
        //             INNER JOIN subprocedure_list as b ON a.CAPL_Procedure = b.SPL_Ref_No 
        //             INNER JOIN client_status_log ON CSL_Ref_No =CAPL_CSL_Ref_No
        //             INNER JOIN client_information ON CLI_Code = CSL_Client_Code
        //             where CAPL_CSL_Ref_No='$refno' ; ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function complete_app($refno,$data_update){
        $query = $this->db->table('client_status_log');
        $query->where('CSL_Ref_No', $refno);
        $query->update($data_update);
    }

    public function getclienthistory($client){
        $builder = $this->db->table("client_appointment_proc_log");
        $builder->select("CSL_Date,
                        SPL_SubProcedure_Desc,
                        (	SELECT CONCAT(LastName,', ',FirstName) 
                            FROM user_access 
                            where DID=CSL_Action_Needed_By)  as InCharge");
        $builder->join("subprocedure_list","SPL_Ref_No=CAPL_Procedure","INNER");
        $builder->join("client_status_log","CSL_Ref_No=CAPL_CSL_Ref_No","INNER");
        $builder->where("CSL_Client_Code",$client);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
        // $sql = "    SELECT 
        //                 CSL_Date,
        //                 SPL_SubProcedure_Desc,
        //                 (	SELECT CONCAT(LastName,', ',FirstName) 
        //                     FROM user_access 
        //                     where DID=CSL_Action_Needed_By)  as InCharge
        //             FROM client_appointment_proc_log
        //             INNER JOIN subprocedure_list ON SPL_Ref_No=CAPL_Procedure
        //             INNER JOIN client_status_log ON CSL_Ref_No=CAPL_CSL_Ref_No
        //             WHERE CSL_Client_Code='$client'; ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function insert_armain($data){ 
        $this->db->table('ar_main_list')->insert($data);
        $id = $this->db->insertID();
        return $id;
    }

    public function insert_arlist($data){
        $this->db->table('ar_list')->insert($data);
    }

    public function insertarpayment($data){
        $this->db->table('ar_payment_schedule')->insert($data);
    }

    public function getarpaymentschedule($refno){
        $builder = $this->db->table("ar_main_list");
        $builder->select("ARML_Ref_No,ARPS_Amount,ARPS_Date,
                (SELECT SUM(PL_Amount_Paid) FROM payment_list WHERE PL_ARML_Ref_No=ARML_Ref_No) as AmountPaid");
        $builder->join("ar_payment_schedule","ARPS_ARML_Ref_No = ARML_Ref_No","INNER");
        $builder->where("ARML_CSL_Ref_No",$refno);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT ARML_Ref_No,ARPS_Amount,ARPS_Date,
        //         (SELECT SUM(PL_Amount_Paid) FROM payment_list WHERE PL_ARML_Ref_No=ARML_Ref_No) as AmountPaid 
        //         FROM ar_main_list 
        //         INNER JOIN ar_payment_schedule ON ARPS_ARML_Ref_No = ARML_Ref_No
        //         where ARML_CSL_Ref_No='$refno'";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function insert_payment($data){
        $this->db->table('payment_list')->insert($data);
    }

    public function searchpatient($searchstring){
        $builder = $this->db->table("client_information");
        $builder->select("CLI_Code,CLI_FName,CLI_MName,CLI_LName");
        $builder->where("CLI_Status",'0');
        $builder->orLike("CLI_FName",'%'.$searchstring.'%');
        $builder->orLike("CLI_MName",'%'.$searchstring.'%');
        $builder->orLike("CLI_LName",'%'.$searchstring.'%');
        $builder->orLike("CONCAT(CLI_LName,', ',CLI_FName)",'%'.$searchstring.'%');
        $builder->orLike("CONCAT(CLI_LName,' ',CLI_FName)",'%'.$searchstring.'%');
        $builder->orLike("CONCAT(CLI_LName,CLI_FName)",'%'.$searchstring.'%');
        $builder->orLike("CONCAT(CLI_LName,', ',CLI_FName,' ',CLI_MName)",'%'.$searchstring.'%');
        $builder->limit(5);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "    SELECT CLI_Code,CLI_FName,CLI_MName,CLI_LName 
        //             FROM client_information
        //             WHERE CLI_Status='0'
        //             and
        //             CLI_FName like '%$searchstring%' or CLI_MName like '%$searchstring%' or CLI_LName like '%$searchstring%' 
        //             OR
        //             CONCAT(CLI_LName,', ',CLI_FName) like '%$searchstring%'
        //             OR
        //             CONCAT(CLI_LName,' ',CLI_FName) like '%$searchstring%'
        //             OR
        //             CONCAT(CLI_LName,CLI_FName) like '%$searchstring%'
        //             OR
        //             CONCAT(CLI_LName,', ',CLI_FName,' ',CLI_MName) like '%$searchstring%' LIMIT 5 ;";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
        
    }

    public function populateclientinfo($clientcode){
        $builder = $this->db->table("client_information");
        $builder->select("*");
        $builder->where("CLI_Code",$clientcode);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT *
        //         FROM client_information
        //         WHERE CLI_Code='$clientcode';";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function populateclientaddress($clientcode){
        $builder = $this->db->table("client_address_log");
        $builder->select("*");
        $builder->where("CLIAL_CLI_Code",$clientcode);
        $builder->orderBy("CLIAL_Ref_No",'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT *
        //         FROM client_address_log
        //         WHERE CLIAL_CLI_Code='$clientcode' ORDER BY CLIAL_Ref_No DESC 
        //         LIMIT 1;";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function populateclientcontactinfo($clientcode){
        $builder = $this->db->table("client_employment_log");
        $builder->select("*,
                (SELECT CLICL_Particulars FROM client_contact_log where CLICL_CLI_Code='CLI20' and CLICL_Type='Mobile' ORDER BY CLICL_Ref_No DESC LIMIT 1) as MobileNo,
                (SELECT CLICL_Particulars FROM client_contact_log where CLICL_CLI_Code='CLI20' and CLICL_Type='Email' ORDER BY CLICL_Ref_No DESC LIMIT 1) as EmailAdd,
                (SELECT CLICL_Particulars FROM client_contact_log where CLICL_CLI_Code='CLI20' and CLICL_Type='Telephone' ORDER BY CLICL_Ref_No DESC LIMIT 1) as TelNo");
        $builder->where("CLIEL_CLI_Code",$clientcode);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT *,
        //         (SELECT CLICL_Particulars FROM client_contact_log where CLICL_CLI_Code='CLI20' and CLICL_Type='Mobile' ORDER BY CLICL_Ref_No DESC LIMIT 1) as MobileNo,
        //         (SELECT CLICL_Particulars FROM client_contact_log where CLICL_CLI_Code='CLI20' and CLICL_Type='Email' ORDER BY CLICL_Ref_No DESC LIMIT 1) as EmailAdd,
        //         (SELECT CLICL_Particulars FROM client_contact_log where CLICL_CLI_Code='CLI20' and CLICL_Type='Telephone' ORDER BY CLICL_Ref_No DESC LIMIT 1) as TelNo
        //         FROM client_employment_log 
        //         WHERE CLIEL_CLI_Code='$clientcode'  ;
        //         ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function populateclientreference($clientcode){
        $builder = $this->db->table("client_character_reference");
        $builder->select("CCR_Name,
                    CCR_Occupation,
                    CCR_Remarks,
                    (SELECT CCR_Name FROM client_character_reference where CCR_Client_Code='CLI15' and CCR_Type='Referrer' ORDER BY CCR_Ref_No DESC limit 1) as Referrer");
        $builder->where("CCR_Client_Code",$clientcode);
        $builder->where("CCR_Type",'Guardian');
        $builder->orderBy("CCR_Ref_No",'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
        // $sql = "SELECT  
        //             CCR_Name,
        //             CCR_Occupation,
        //             CCR_Remarks,
        //             (SELECT CCR_Name FROM client_character_reference where CCR_Client_Code='CLI15' and CCR_Type='Referrer' ORDER BY CCR_Ref_No DESC limit 1) as Referrer
        //         FROM client_character_reference
        //         WHERE CCR_Client_Code='$clientcode' and CCR_Type='Guardian' ORDER BY CCR_Ref_No DESC LIMIT 1;  ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function populateclientmedhistory($clientcode){
        $builder = $this->db->table("client_medical_history");
        $builder->select("*");
        $builder->where("CMH_Client_Code",$clientcode);
        $builder->orderBy("CMH_Ref_No","DESC");
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "    SELECT * 
        //             FROM client_medical_history 
        //             WHERE CMH_Client_Code='$clientcode' 
        //             ORDER BY CMH_Ref_No DESC LIMIT 1 ;";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function gethmocompany(){
        $builder = $this->db->table("hmo_company_list");
        $builder->select("*");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function updatehmocom($refno,$data){
        $query = $this->db->table('hmo_company_list');
        $query->where('HCL_Ref_No', $refno);
        $query->update($data);
    }

    
    public function insert_hmocompany($data){
        $this->db->table('hmo_company_list')->insert($data); 
    }

    public function populate_bank(){
        $builder = $this->db->table("bank_list");
        $builder->select("*");
        $builder->where("BL_Status",'Active');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function populate_company(){
        $builder = $this->db->table("hmo_company_list");
        $builder->select("*");
        $builder->where("HCL_Status",'Active');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function insert_bank($data){
        $this->db->table('bank_list')->insert($data); 
    }

    public function getbanklist(){
        $builder = $this->db->table("bank_list");
        $builder->select("*");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function updatebank($refno,$data){
        $query = $this->db->table('bank_list');
        $query->where('BL_Ref_No', $refno);
        $query->update($data);
    }

    public function inserttreatmentplan($data){
        $this->db->table('treatment_plan_list')->insert($data);  
    }

    public function updatetreatmentplan($refno,$data){
        $query = $this->db->table('treatment_plan_list');
        $query->where('TPL_Ref_No', $refno);
        $query->update($data);
    }

    public function deletetreatmentplan($refno,$data){
        $query = $this->db->table('treatment_plan_list');
        $query->whereNotIn('TPL_Ref_No', $refno);
        $query->update($data);
    }

    public function gettreatmentplan($refno){
        $builder = $this->db->table("treatment_plan_list");
        $builder->select("*,(SELECT SPL_SubProcedure_Desc FROM subprocedure_list where SPL_Ref_No=TPL_SPL_Ref_No) as proc,
                                (SELECT CONCAT(CLI_LName,', ',CLI_FName,' ',CLI_MName) FROM client_information
                        INNER JOIN client_status_log ON CSL_Client_Code=CLI_Code
                        WHERE CSL_Ref_No='$refno') as Client_Name");
        $builder->whereIn("TPL_Status",["Active","Pending"]);
        $builder->where("TPL_CSL_Ref_No",$refno);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function reschedule_app($acc_refno,$new_date,$audituser){
        $sql = "CALL usp_jtj_reschedule_app (?,?,?) "; 
        $params = [
            $acc_refno,
            $new_date,
            $audituser 
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function getclientinfobyrefno($CSL_Ref_No){
        $builder = $this->db->table("client_information");
        $builder->select("CLI_Code,CONCAT(CLI_LName,', ',CLI_FName,' ',CLI_MName)  as Fullname");
        $builder->join("client_status_log","CLI_Code=CSL_Client_Code","INNER");
        $builder->where("CSL_Ref_No",$CSL_Ref_No);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    
    // public function submit_periodontalchart($clientcode,$date,$audituser){
       
    public function submit_periodontalchart(
                                                    $teeth,
                                                    $mobility,
                                                    $implants,
                                                    $furcations,

                                                    $bleed_buccal,
                                                    $bleed_palatal,
                                                    $bleed_lingual,
                                                    $bleed_buccal_bot,
 
                                                    $plaque_buccal,
                                                    $plaque_palatal,
                                                    $plaque_lingual,
                                                    $plaque_buccal_bot,
 
                                                    $gingivalmargin_buccal,
                                                    $gingivalmargin_palatal,
                                                    $gingivalmargin_lingual,
                                                    $gingivalmargin_buccal_bot,
 
                                                    $probingdepth_buccal,
                                                    $probingdepth_palatal,
                                                    $probingdepth_lingual,
                                                    $probingdepth_buccal_bot,

                                                    $date,
                                                    $audituser,
                                                    $clientcode
                                            ){
        $sql = "CALL usp_jtj_save_periodontaldata (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) "; //
        $params = [
            $clientcode, 
            $date,
            $audituser, 
            
            $teeth,
            $mobility,
            $implants,
            $furcations,

            $bleed_buccal,
            $bleed_palatal,
            $bleed_lingual,
            $bleed_buccal_bot,
 
            $plaque_buccal,
            $plaque_palatal,
            $plaque_lingual,
            $plaque_buccal_bot,
 
            $gingivalmargin_buccal,
            $gingivalmargin_palatal,
            $gingivalmargin_lingual,
            $gingivalmargin_buccal_bot,
 
            $probingdepth_buccal,
            $probingdepth_palatal,
            $probingdepth_lingual,
            $probingdepth_buccal_bot,
        ];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    }

    public function retrieveperiodontaldata($clientcode){
        // SELECT * FROM client_periodontal_list where CPL_Client_Code='CLI1' limit 1
        $sql = "SELECT * FROM client_periodontal_list where CPL_Client_Code='$clientcode' ORDER BY CPL_Date DESC limit 1 ;"; // 
        $query = $this->db->query($sql);
        $result = $query->getResult();
        return  $result;
    }

    public function submit_remarks($clientcode,$i_tooth_no,$i_type,$currentdate,$i_remarks,$audituser,$currentdatetime){
        $sql = "CALL usp_jtj_save_remarks(?,?,?,?,?,?,?)";
        $params = [$clientcode,$i_tooth_no,$i_type,$currentdate,$i_remarks,$audituser,$currentdatetime];
        $query = $this->db->query($sql,$params);
        $result = $query->getResult();
        return  $result;
    } 
    
    public function retrieve_remarks($i_tooth_no,$type,$clientcode,$currentdate){
        $builder = $this->db->table("client_periodontal_remarks_log");
        $builder->select("CPRL_Remarks");
        $builder->where("CPRL_Tooth_No",$i_tooth_no);
        $builder->where("CPRL_Type",$type);
        $builder->where("CPRL_Client_Code",$clientcode);
        $builder->where("CPRL_Date",$currentdate);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function gettreatmentnotes($tn_from,$tn_to,$clientcode){
        // SELECT  FROM client_periodontal_remarks_log where CPRL_Date>='' and CPRL_Date<='' and CPRL_Client_Code='';
        $builder = $this->db->table("client_periodontal_remarks_log");
        $builder->select("CPRL_Date,CPRL_Tooth_No,CPRL_Type,CPRL_Remarks,(SELECT CONCAT(CLI_LName,', ',CLI_FName,' ',CLI_MName) FROM client_information where CLI_Code=CPRL_Client_Code) as clientname");
        $builder->where("CPRL_Date >=",$tn_from);
        $builder->where("CPRL_Date <=",$tn_to); 
        $builder->where("CPRL_Client_Code",$clientcode); 
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
}
