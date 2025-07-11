<?php

namespace App\Controllers\Maintenance;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users\UserModel;
use Config\Services;

class Usermanagement extends BaseController
{

    
    protected IncomingRequest|CLIRequest $postRequest;
    protected  UserModel $usermodel;


    public function __construct(){

        $this->usermodel = new UserModel();
        $this->postRequest = Services::request();
    }
    public function index() : string
    {
        return view('Pages/Maintenance/user_management/user_management');
    }

    public function loadUser(): string{

       return  json_encode($this->usermodel->getUsers());
    }

    public function createUser():string
    {
        $requestJson = $this->postRequest->getJSON();

        $checkData = [
            $requestJson->userName,
            $requestJson->email,

        ];

        $checkDuplicate = $this->usermodel->checkUser($checkData);

        if($checkDuplicate == 1) {

            $response = [
                'title' => 'Error',
                'status' => 404,
                'Message' => 'Duplicate Found!',

            ];
            return json_encode($response);
        }else {

            $insert_data = [
                'FULLNAME' => $requestJson->firstName.' '.$requestJson->middleName[0].'. '.$requestJson->lastName,
                'FirstName' => $requestJson->firstName,
                'MiddleName' => $requestJson->middleName,
                'LastName' => $requestJson->lastName,
                'USERNAME' => $requestJson->userName,
                'PASSWORD' => sha1(md5($requestJson->password)),
                'USER_LEVEL' => $requestJson->roleSelected,
                'EMAIL_ADD' => $requestJson->email,
                'PhoneNum' => $requestJson->phone,
                'COMPANY' => 1,
                'STATUS' => 1
            ];




            return $this->usermodel->createUser($insert_data);

        }
    }

    public function updateUser():string
    {
        $requestJson = $this->postRequest->getJSON();

        $insert_data = [
            'FULLNAME' => $requestJson->firstname.' '.$requestJson->middlename[0].'. '.$requestJson->lastname,
            'FirstName' => $requestJson->firstname,
            'MiddleName' => $requestJson->middlename,
            'LastName' => $requestJson->lastname,
            'USERNAME' => $requestJson->userName,
            'USER_LEVEL' => $requestJson->roleSelected,
            'EMAIL_ADD' => $requestJson->email,
            'PhoneNum' => $requestJson->phone,
            'STATUS' => $requestJson->status
        ];

        return $this->usermodel->updateUser($insert_data,$requestJson->recId);
    }

    public function resetPassword() : string
    {
        $requestJson = $this->postRequest->getJSON();
        $insert_data = [
            'PASSWORD' => sha1(md5($requestJson->password)),
        ];

        return $this->usermodel->updateUser($insert_data,$requestJson->recId);
    }
}
