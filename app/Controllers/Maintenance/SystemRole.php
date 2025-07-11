<?php

namespace App\Controllers\Maintenance;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Services;

use App\Models\Maintenance\SystemMenuGroupModel;

class SystemRole extends BaseController
{
    protected SystemMenuGroupModel $systemMenuModelGroup;
    protected IncomingRequest|CLIRequest $postRequest;
    public function __construct()
    {
        $this->systemMenuModelGroup = new SystemMenuGroupModel();
        $this->postRequest = Services::request();
    }

    public function index(): string
    {
        return json_encode($this->systemMenuModelGroup->showMenuGroups());
    }

    public function loadParentMenu(): string
    {
        $requestJson = $this->postRequest->getJSON();

        $data = [
            $requestJson->rolesId,
        ];

        return json_encode($this->systemMenuModelGroup->showParentMenu($data));

    }

    public function loadChildMenu(): string
    {
        $requestJson = $this->postRequest->getJSON();

        $data = [
            $requestJson->rolesId,
            $requestJson->parentId,
            $requestJson->parentId,
        ];

        return json_encode($this->systemMenuModelGroup->showChildMenuByRole($data));
    }

    public function updateAccessRight(): string
    {

        try {
            $requestJson = $this->postRequest->getJSON();


            $checkResult = $this->systemMenuModelGroup->checkAccessRights($requestJson->rolesId);
            $insert_data = [];
            if ($checkResult == 200) {

                foreach ($requestJson->AccessGrantedList as $menuID) {


                    $insert_data = [
                        'group_id' => $requestJson->rolesId,
                        'menu_id' => $menuID,
                        'IsActive' => 1
                    ];

                    $this->systemMenuModelGroup->updateAccessRight($insert_data);


                }

            }

            $response = [

                'title' => 'Success',
                'status' => 200,
                'Message' => 'Successfully Created',


            ];

            return json_encode($response);


        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function createRole(): string
    {
        $requestJson = $this->postRequest->getJSON();

        $checkData = [
            $requestJson->RoleName,
        ];

        $checkDuplicate = $this->systemMenuModelGroup->checkRole($checkData);

        if ($checkDuplicate == 1) {

            $response = [
                'title' => 'Error',
                'status' => 404,
                'Message' => 'Duplicate Found!',

            ];
            return json_encode($response);
        } else {


            $insert_data = [
                'grp_name' => $requestJson->RoleName,
                'IsActive' => 1
            ];


            return $this->systemMenuModelGroup->createRole($insert_data);
        }

    }




}
