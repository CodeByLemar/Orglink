<?php

namespace app\Models\Procedures;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_company';
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
        // $this->request = \Config\Services::request(); 
    }

    public function getprocsmonth($from,$to)
    {   
        $builder = $this->db->table("client_status_log");
        $builder->select("COUNT(*) as proccount");
        $builder->where("CSL_Date>=",$from);
        $builder->where("CSL_Date<=",$to);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT COUNT(*) as proccount FROM client_status_log where CSL_Date>='$from' and CSL_Date<='$to';";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function getunaccommonth($from,$to)
    {   
        $builder = $this->db->table("client_status_log");
        $builder->select("COUNT(*) as unaccomcount");
        $builder->where(" CSL_Date>=",$from);
        $builder->where(" CSL_Date<=",$to);
        $builder->where(" CSL_Result_Remarks is null");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT COUNT(*) as unaccomcount FROM client_status_log where CSL_Date>='$from' and CSL_Date<='$to' and CSL_Result_Remarks is null;";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function getdentistprocs($from,$to)
    {
        $builder = $this->db->table("user_access");
        $builder->select("  CONCAT(LastName,', ',FirstName) as x,
                            COUNT(CSL_Ref_No)  as y ,
                            Color_Tagging as color ");
        $builder->join("client_status_log","DID=CSL_Action_Needed_By and CSL_Date>='$from' and CSL_Date<='$to' ","LEFT");
        $builder->where("POSITION",'1');
        $builder->where("STATUS",'1');
        $builder->groupBy(["DID","CONCAT(LastName,', ',FirstName)"]);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
        // $sql = "SELECT 
        //             -- DID,
        //             CONCAT(LastName,', ',FirstName) as x,
        //             COUNT(CSL_Ref_No)  as y ,
        //             Color_Tagging as color 
        //         FROM user_access  
        //         LEFT JOIN client_status_log ON DID=CSL_Action_Needed_By and CSL_Date>='$from' and CSL_Date<='$to' 
        //         WHERE POSITION='1' and STATUS='1'
        //         GROUP BY DID,CONCAT(LastName,', ',FirstName) ;  ";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }

    public function getproccountmonth($from,$to)
    {
        $builder = $this->db->table("client_appointment_proc_log");
        $builder->select("COUNT(CAPL_Procedure) as CAPL_Procedure,
                    SPL_SubProcedure_Desc");
        $builder->join("subprocedure_list","SPL_Ref_No=CAPL_Procedure","INNER");
        $builder->join("client_status_log","CSL_Ref_No = CAPL_CSL_Ref_No","INNER");
        $builder->where("CSL_Date>=",$from);
        $builder->where("CSL_Date<=",$to);
        $builder->groupBy("SPL_Subprocedure_Desc");
        $query = $builder->get();
        $result = $query->getResult();
        return $result;

        // $sql = "SELECT 
        //             COUNT(CAPL_Procedure) as CAPL_Procedure,
        //             SPL_SubProcedure_Desc    -- Procedures for the Month
        //         FROM client_appointment_proc_log
        //         INNER JOIN subprocedure_list ON SPL_Ref_No=CAPL_Procedure
        //         INNER JOIN client_status_log ON CSL_Ref_No = CAPL_CSL_Ref_No
        //         WHERE CSL_Date>='$from' and CSL_Date<='$to'
        //         GROUP BY SPL_Subprocedure_Desc;";
        // $query = $this->db->query($sql);
        // $result = $query->getResult();
        // return  $result;
    }
}
