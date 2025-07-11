<?php

namespace app\Models\Maintenance;

use CodeIgniter\Model;

class SystemMenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'menus';
    protected $db;
    protected $str;


    public function getSystemMenu($parent = 0)
    {

        $Userlevel = session()->get('userlevel');
        $this->str = 'SELECT X.menu_id AS RecID, X.parent AS ParentID, NULL AS child, X.name AS Name, X.value AS Val, X.SortOrder AS Sort, X.icon
                FROM menus X
                LEFT JOIN menu_user_access mu ON mu.menu_id = X.menu_id
                WHERE mu.group_id IN (?) AND mu.IsActive = 1
                GROUP BY X.menu_id, X.parent, X.name, X.value, X.SortOrder, X.icon
                ORDER BY X.SortOrder';

        $menuItems = $this->db->query($this->str,[$Userlevel])->getResultArray();
        
        $result = [];
        foreach ($menuItems as $menuItem) {
                if ($menuItem['ParentID'] == $parent) {
                $child = $this->getSystemMenu($menuItem['RecID']);
                if ($child != null) {
                    $menuItem['child'] = $child;
                }
                $result[] = $menuItem;
            }
        }

        return  $result;


    }


    public  function getListMenu() : array
    {
        $this->str = "SELECT
                        menu_id,
                        parent,
                        (SELECT name FROM menus WHERE menu_id = A.parent) as parentName, 
                        name,
                        value,
                        icon,
                        SortOrder
                    FROM menus A";

        $query = $this->db->query($this->str);

        return $query->getResultArray();
    }

    public function loadParentMenu() : array
    {
        $this->str = "SELECT
                          menu_id,
                          name
                        FROM menus A
                        where parent = 0";

        $query = $this->db->query($this->str);

        return $query->getResultArray();
    }

    public function loadIcon() : array
    {
        $this->str = "SELECT * FROM tbl_icons";

        $query = $this->db->query($this->str);

        return $query->getResultArray();

    }

    public function insertMenu($data): string
    {

        $query = 'INSERT INTO menus (parent, name, value, icon, SortOrder) VALUES (?,?,?,?,?)';

        $this->db->query($query, $data);


        if($query == true){

            $response = [

                'title' => 'Success',
                'status' => 200,
                'Message' => 'Successfully Menu',

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

    public function checkMenuData($data) : string
    {

        $this->str = 'SELECT count(*) as duplicate FROM menus WHERE name = ?';

        $query = $this->db->query($this->str, $data);


        $result = $query->getRow();

        return $result->duplicate;


    }

    public function updateMenu($data) : string
    {
        $query = 'UPDATE menus
                  SET  parent = ? , name = ? , value = ?, icon = ?, SortOrder = ?
                  WHERE menu_id = ? ';

        $this->db->query($query, $data);


        if($query == true){

            $response = [

                'title' => 'Success',
                'status' => 200,
                'Message' => 'Successfully Updated',

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
