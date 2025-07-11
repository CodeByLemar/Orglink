<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

use App\Models\Reports\ReportsModel;
use App\Models\Procedures\DashboardModel;

class Dashboard extends BaseController
{
    protected ReportsModel $ReportsModel;
    protected DashboardModel $DashboardModel;
    protected IncomingRequest|CLIRequest $postRequest;

    public function __construct()
    {
        $this->ReportsModel = new ReportsModel();
        $this->DashboardModel = new DashboardModel();
        $this->postRequest = Services::request();

    }
    public function index()
    {   
        $data['current_date'] = $this->ReportsModel->getcurrentdate(); 
        return view('Pages/Dashboard/dashboard_view',$data);
    }

    public function getprocsmonth()
    {
        $request = \Config\Services::request();
        $from = $request->getPost('from');  
        $to = $request->getPost('to'); 
        return json_encode($this->DashboardModel->getprocsmonth($from,$to));
    }

    public function getunaccommonth()
    {
        $request = \Config\Services::request();
        $from = $request->getPost('from');  
        $to = $request->getPost('to'); 
        return json_encode($this->DashboardModel->getunaccommonth($from,$to));
    }

    public function getdentistprocs()
    {
        $request = \Config\Services::request();
        $from = $request->getPost('from');  
        $to = $request->getPost('to'); 
        return json_encode($this->DashboardModel->getdentistprocs($from,$to));
    }

    public function getproccountmonth()
    {
        $request = \Config\Services::request();
        $from = $request->getPost('from');  
        $to = $request->getPost('to'); 
        return json_encode($this->DashboardModel->getproccountmonth($from,$to));
    }
    
}
