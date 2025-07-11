<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;


class SystemMenuGroupModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'menu_groups';
    protected $db;
    protected $str;

    public function showMenuGroups(): array
    {
        $this->str = "SELECT * FROM menu_groups";

        $query = $this->db->query($this->str);

        return $query->getResultArray();
    }

    public function showParentMenu($data, $parent = 0): array
    {
        $this->str = 'SELECT
                            mu.RecID,
                            X.menu_id,
                            X.parent AS ParentID,
                            NULL AS child,
                            X.name AS Name,
                            X.value AS Val,
                            X.SortOrder AS Sort,
                            X.icon
                        
                        FROM
                            menus X
                                LEFT JOIN
                            menu_user_access mu
                            ON
                                X.menu_id = mu.menu_id
                                    AND mu.group_id = ?
                        GROUP BY
                            X.menu_id,
                            X.parent,
                            X.name,
                            X.value,
                            X.SortOrder,
                            X.icon
                        ORDER BY
                            X.SortOrder';

        $menuItems = $this->db->query($this->str, $data)->getResultArray();

        $result = [];
        foreach ($menuItems as $menuItem) {
            if ($menuItem['ParentID'] == $parent) {
                $child = $this->showParentMenu($data, $menuItem['menu_id']);
                if ($child != null) {
                    $menuItem['child'] = $child;
                }
                $result[] = $menuItem;
            }
        }

        return $result;
    }



    public function showChildMenuByRole($data, $parent = 0): array
    {

        $this->str = 'SELECT
                            mu.RecID,
                            X.menu_id,
                            X.parent AS ParentID,
                            NULL AS child,
                            X.name AS Name,
                            X.value AS Val,
                            X.SortOrder AS Sort,
                            X.icon
                        
                        FROM
                            menus X
                                LEFT JOIN
                            menu_user_access mu
                            ON
                                X.menu_id = mu.menu_id
                                    AND mu.group_id = ?
                        WHERE parent = ? OR X.menu_id = ?
                        GROUP BY
                            X.menu_id,
                            X.parent,
                            X.name,
                            X.value,
                            X.SortOrder,
                            X.icon
                        ORDER BY
                            X.SortOrder';

        $menuItems = $this->db->query($this->str, $data)->getResultArray();

        $result = [];
        foreach ($menuItems as $menuItem) {
            if ($menuItem['ParentID'] == $parent) {
                $child = $this->showChildMenuByRole($data, $menuItem['menu_id']);
                if ($child != null) {
                    $menuItem['child'] = $child;
                }
                $result[] = $menuItem;
            }
        }

        return $result;
    }


    public function checkAccessRights($data): string
    {
        $this->str = 'SELECT count(*) as duplicate FROM menu_user_access  WHERE group_id =  ?';

        $query = $this->db->query($this->str, $data);

        $duplicateCount = $query->getRow()->duplicate;

        if ($duplicateCount > 0) {
            $this->db->table('menu_user_access')->delete(['group_id' => $data]);
        }

        return 200;
    }

    public function updateAccessRight($data): array
    {
        try {

            return $this->db->table('menu_user_access')->insert($data);


        } catch (\Throwable $th) {
            return [
                'status' => 400,
                'Message' => $th->getMessage()
            ];
        }
    }


    public function checkRole($data): string
    {
        $this->str = 'SELECT count(*) as duplicate FROM menu_groups  WHERE grp_name =  ?';

        $query = $this->db->query($this->str, $data);

        $result = $query->getRow();

        return $result->duplicate;
    }

    public function createRole($data)
    {
        $query = $this->db->table('menu_groups')->insert($data);

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
