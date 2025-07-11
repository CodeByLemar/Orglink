<?php

namespace app\Models\Users;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'user_access';
    protected $db;
    protected $str;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
    }


    public function userAuthorization($data): array
    {

        $this->str = 'SELECT X.DID,X.FULLNAME,X.USERNAME,X.USER_LEVEL,X.PASSWORD,EMAIL_ADD,X.STATUS,A.grp_name,
                        C.Company_name,
                        C.address as Company_Address
                        FROM user_access X
                        LEFT JOIN menu_groups A on A.RecID =  X.USER_LEVEL
                        LEFT JOIN tbl_company C ON C.RecID = X.COMPANY
                      WHERE X.USERNAME = ? AND X.PASSWORD = ?';


        $query = $this->db->query($this->str, $data);

        return $query->getResultArray();

    }

    public function getUsers(): array
    {
        $this->str = 'SELECT * FROM user_access a
                      LEFT JOIN menu_groups b on b.RecID = a.USER_LEVEL';

        $query = $this->db->query($this->str);

        return $query->getResultArray();
    }

    public function checkUser($data): string
    {
        $this->str = 'SELECT count(*) as duplicate FROM user_access  WHERE USERNAME =  ? AND EMAIL_ADD = ? ';

        $query = $this->db->query($this->str, $data);

        $result = $query->getRow();

        return $result->duplicate;
    }

    public function createUser($data): string
    {
        $query = $this->db->table('user_access')->insert($data);

        if ($query == true) {

            $response = [

                'title' => 'Success',
                'status' => 200,
                'Message' => 'Successfully Created',

            ];

        } else {
            $response = [

                'title' => 'Error',
                'status' => 404,
                'Message' => 'Something Went Wrong',

            ];
        }

        return json_encode($response);
    }


    public function updateUser($data, $recId): string
    {
        $query = $this->db->table('user_access')->update($data, array('DID' => $recId));

        if ($query == true) {

            $response = [

                'title' => 'Success',
                'status' => 200,
                'Message' => 'Successfully Created',

            ];

        } else {
            $response = [

                'title' => 'Error',
                'status' => 404,
                'Message' => 'Something Went Wrong',

            ];
        }

        return json_encode($response);

    }



}
