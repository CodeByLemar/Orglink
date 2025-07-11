<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

$routes->setPrioritize();



$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->group('Payroll', static function ($routes) {
        
        $routes->get('timekeeping', 'Pages\Payroll::timekeeping'); 
        $routes->get('/', 'Pages\Payroll::index'); 

        $routes->post('uploadtimelogs', 'Pages\Payroll::uploadtimelogs', ['as' => 'uploadtimelogs']); 
        $routes->post('retrieveuploadedlogs', 'Pages\Payroll::retrieveuploadedlogs', ['as' => 'retrieveuploadedlogs']); 
        $routes->post('retrieveconvertedlogs', 'Pages\Payroll::retrieveconvertedlogs', ['as' => 'retrieveconvertedlogs']); 
        $routes->post('getvalidatedlogs', 'Pages\Payroll::getvalidatedlogs', ['as' => 'getvalidatedlogs']); 

        $routes->post('generate_payslip', 'Pages\Payroll::generate_payslip', ['as' => 'generate_payslip']);
        $routes->get('payslip_pdf', 'Pages\Payroll::payslip_pdf', ['as' => 'payslip_pdf']);

        
        $routes->post('print_register', 'Pages\Payroll::print_register', ['as' => 'print_register']);
        $routes->get('print_register_pdf', 'Pages\Payroll::print_register_pdf', ['as' => 'print_register_pdf']);  

        
    });
});