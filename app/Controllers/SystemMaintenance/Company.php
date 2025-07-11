<?php

namespace App\Controllers\SystemMaintenance;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\System\CompanyModel;
use Config\Services;

class Company extends BaseController
{
    protected CompanyModel $companyModel;
    protected IncomingRequest|CLIRequest $postRequest;

    public function __construct(){
        $this->companyModel = new CompanyModel();
        $this->postRequest = Services::request();
    }


    public function index() : string
    {
        return view('Pages/SystemMaintenance/Company/company');
    }

    public function visualAppearance() : string
    {
        return view('Pages/SystemMaintenance/Company/Details/visualAppearance');
    }

    public function getCompany() :string
    {
        return json_encode($this->companyModel->loadCompany());
    }


    public function createCompany() : string
    {


        //Inputs
        $companyCode = $this->request->getPost('companyCode');
        $companyName = $this->request->getPost('companyName');
        $companyAddress = $this->request->getPost('companyAddress');


        //Images
        $companyLogo = $this->request->getFile('companyLogo');
        $companySystem = $this->request->getFile('companySystem');
        $sideMenuMax = $this->request->getFile('sideMenuMax');
        $sideMenuMin = $this->request->getFile('sideMenuMin');



        $primaryColor = $this->request->getPost('primaryColor');
        $secondaryColor = $this->request->getPost('secondaryColor');


        $uploadPath = ROOTPATH . 'public/assets/images/System/'.$companyCode.'/Logo/';

        $customeName = $companyCode.'/Logo/';


        $checkData = [
            $companyName,
            $companyCode,
        ];

        $checkDuplicate = $this->companyModel->checkCompany($checkData);


        if($checkDuplicate == 1) {

            $response = [

                'title' => 'Error',
                'status' => 404,
                'Message' => 'Duplicate Found!',

            ];
            return json_encode($response);
        } else {

            $companyLogoName = $this->handleFileUpload($companyLogo, $uploadPath);
            $companySystemName = $this->handleFileUpload($companySystem, $uploadPath);
            $sideMenuMaxName = $this->handleFileUpload($sideMenuMax, $uploadPath);
            $sideMenuMinName = $this->handleFileUpload($sideMenuMin, $uploadPath);


            $data = [
                $companyName,
                $companyCode,
                $companyAddress,
                false,
                $customeName . $companyLogoName,
                $customeName . $companySystemName,
                $customeName . $sideMenuMaxName,
                $customeName . $sideMenuMinName,
                $primaryColor,
                $secondaryColor
            ];


            return $this->companyModel->createCompany($data);
        }


    }

    public function handleFileUpload($file, $uploadPath) {
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            if ($file->move($uploadPath, $newName)) {
                return $file->getName();
            } else {
                return $file->getErrorString();
            }
        } else {
            return 'Invalid file or already moved.';
        }
    }


}
