<?php

namespace app\Models\System;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_company';
    protected $db;
    protected $str;

    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
    }

    public function loadDefaultCompany() : array
    {

        $this->str = 'SELECT * FROM tbl_company WHERE IsActive = true';

        $query = $this->db->query($this->str);

        return $query->getResultArray();


    }

    public function loadCompany() : array
    {
        $this->str = "SELECT  *  FROM tbl_company";

        $query = $this->db->query($this->str);

        return $query->getResultArray();
    }


    public function checkCompany($data) : string
    {

        $this->str = 'SELECT count(*) as duplicate FROM tbl_company WHERE Company_name = ? AND Company_code = ?';

        $query = $this->db->query($this->str, $data);


        $result = $query->getRow();

        return $result->duplicate;


    }
    public function createCompany($data) : string
    {

        $this->str = 'INSERT INTO tbl_company (Company_name, Company_code, address,IsActive, CompanyLogo, SideMenuLogoMax,
                         logoSideMenuMin, SystemLogo, PrimaryColor, SecondColor)
                        VALUES (?,?,?,?,?,?,?,?,?,?);';



        $query = $this->db->query($this->str, $data);


        if($query === true){

            $response = [

                'title' => 'Success',
                'status' => 200,
                'Message' => 'Successfully Added',

            ];

        }else{
            $response = [

                'title' => 'Error',
                'status' => 404,
                'Message' => 'Something Went Wrong',

            ];
        }

        return json_encode($response);





    }

}
