<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

use App\Models\System\CompanyModel;

class Acquainted extends BaseController
{
    protected CompanyModel $companyModel;
    protected IncomingRequest|CLIRequest $postRequest;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
        $this->postRequest = Services::request();

    }
    public function index()
    {
        return view('Pages/Procedures/acquainted');
    }
}
