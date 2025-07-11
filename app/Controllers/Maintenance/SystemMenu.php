<?php

namespace App\Controllers\Maintenance;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\Maintenance\SystemMenuModel;
use Config\Services;

class SystemMenu extends BaseController
{
    protected SystemMenuModel $systemMenuModel;
    protected IncomingRequest|CLIRequest $postRequest;
    public function __construct(){
        $this->systemMenuModel = new SystemMenuModel();
        $this->postRequest = Services::request();
    }
    public function index() : string
    {
        return json_encode($this->systemMenuModel->getSystemMenu());
    }

    public function viewMenuRole() : string
    {
        return view('Pages/Maintenance/Menu/menu');
    }

    public function getlistMenu() :string
    {
        return json_encode($this->systemMenuModel->getListMenu());
    }

    public function loadParentMenu() : string
    {
        return json_encode($this->systemMenuModel->loadParentMenu());
    }

    public function geticons() : string
    {
        return json_encode($this->systemMenuModel->loadIcon());
    }


    public function insertMenu() : string
    {
        $requestJson = $this->postRequest->getJSON();

        $checkData = [
            $requestJson->menuNameId,
        ];

        $checkDuplicate = $this->systemMenuModel->checkMenuData($checkData);

        if($checkDuplicate == 1) {

            $response = [
                'title' => 'Error',
                'status' => 404,
                'Message' => 'Duplicate Found!',

            ];
            return json_encode($response);
        }else {

            $inputData = [
                $requestJson->parentNameID,
                $requestJson->menuNameId,
                $requestJson->urlID,
                $requestJson->iconId,
                $requestJson->sortId,
            ];

            return $this->systemMenuModel->insertMenu($inputData);
        }

    }

    public function updateMenu() : string
    {
        $requestJson = $this->postRequest->getJSON();
        $inputData = [
            $requestJson->parentNameID,
            $requestJson->menuNameId,
            $requestJson->urlID,
            $requestJson->iconId,
            $requestJson->sortId,
            $requestJson->MenuNameID,
        ];

        return $this->systemMenuModel->updateMenu($inputData);
    }
}
