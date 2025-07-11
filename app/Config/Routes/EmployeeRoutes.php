<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

$routes->setPrioritize();



$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->group('Employee', static function ($routes) {
 
        $routes->get('/', 'Pages\Employee::index');
        $routes->post('addNewEmployee', 'Pages\Employee::addNewEmployee');
        $routes->post('EditEmployee', 'Pages\Employee::EditEmployee');

        $routes->post('SubmitPersonalInfo', 'Pages\Employee::SubmitPersonalInfo');
        $routes->post('SubmitMiscInfo', 'Pages\Employee::SubmitMiscInfo');
        
        
        $routes->post('SearchEmployee', 'Pages\Employee::SearchEmployee'); 
        
        $routes->post('getEmployeeDetails', 'Pages\Employee::getEmployeeDetails'); 
        $routes->post('getEmployeeAddress', 'Pages\Employee::getEmployeeAddress'); 
        $routes->post('getEmployeeRelatives', 'Pages\Employee::getEmployeeRelatives'); 
        $routes->post('getEmployeeDependents', 'Pages\Employee::getEmployeeDependents'); 
        $routes->post('getEmployeeEducBackground', 'Pages\Employee::getEmployeeEducBackground'); 
        $routes->post('getEmployeeEmployment', 'Pages\Employee::getEmployeeEmployment'); 
        $routes->post('getEmployeeCharReference', 'Pages\Employee::getEmployeeCharReference'); 
        

        $routes->post('getProvinceList', 'Pages\Employee::getProvinceList'); 
        $routes->post('getCityList', 'Pages\Employee::getCityList'); 
        $routes->post('getBrgyList', 'Pages\Employee::getBrgyList');  

        $routes->post('ChangeEmpDetails', 'Pages\Employee::ChangeEmpDetails');  

        
    });
});