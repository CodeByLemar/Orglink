<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setPrioritize();


$routes->group('', ['filter' => 'auth'], function ($routes) {

    //View Routes
    $routes->get('/Dashboard', 'Pages\Dashboard::index');


    //Company Maintenance
    $routes->get('/Company', 'SystemMaintenance\Company::index');
    //Company Maintenance Details
    $routes->get('/visualAppearance', 'SystemMaintenance\Company::visualAppearance');


    //Maintenance
    $routes->get('/RoleAndMenu', 'Maintenance\SystemMenu::viewMenuRole', ['as' => 'RoleAndMenu']);

    //User Managements
    $routes->get('/User-Management', 'Maintenance\Usermanagement::index', ['as' => 'usermanagement']);
    $routes->get('/getUsers', 'Maintenance\Usermanagement::loadUser', ['as' => 'getUsers']);

    //User Management Actions
    $routes->post('/createUsers', 'Maintenance\Usermanagement::createUser', ['as' => 'createUsers']);
    $routes->post('/updateUsers', 'Maintenance\Usermanagement::updateUser', ['as' => 'updateUsers']);
    $routes->post('/resetPassword', 'Maintenance\Usermanagement::resetPassword', ['as' => 'resetPassword']);


    //menus
    $routes->get('/getMenu', 'Maintenance\SystemMenu::index', ['as' => 'getMenu']);

    $routes->get('/getlistMenu', 'Maintenance\SystemMenu::getlistMenu', ['as' => 'getlistMenu']);
    $routes->get('/getParentName', 'Maintenance\SystemMenu::loadParentMenu', ['as' => 'getParentName']);
    $routes->get('/geticons', 'Maintenance\SystemMenu::geticons', ['as' => 'geticons']);
    $routes->post('/createMenu', 'Maintenance\SystemMenu::insertMenu', ['as' => 'createMenu']);
    $routes->post('/updateMenu', 'Maintenance\SystemMenu::updateMenu', ['as' => 'updateMenu']);


    //roles
    $routes->get('/getRoles', 'Maintenance\SystemRole::index', ['as' => 'getRoles']);
    $routes->post('/getParentMenuListByRole', 'Maintenance\SystemRole::loadParentMenu', ['as' => 'getParentMenuListByRole']);
    $routes->post('/getChildMenuListByRole', 'Maintenance\SystemRole::loadChildMenu', ['as' => 'getChildMenuListByRole']);

    $routes->post('/updateRoleAccessRight', 'Maintenance\SystemRole::updateAccessRight', ['as' => 'updateRoleAccessRight']);
    $routes->post('/createRole', 'Maintenance\SystemRole::createRole', ['as' => 'createRole']);


    $routes->get('/getCompany', 'SystemMaintenance\Company::getCompany', ['as' => 'getCompany']);
    $routes->post('/createCompany', 'SystemMaintenance\Company::createCompany', ['as' => 'createCompany']);


    // Reference Maintenance
    
    $routes->get('/ReferenceMaintenance', 'Maintenance\ReferenceMaintenance::index', ['as' => 'ReferenceMaintenance']);
    
    $routes->group('ReferenceMaintenance', static function ($routes) {
        $routes->post('getcompanylist', 'Maintenance\ReferenceMaintenance::getcompanylist');
        $routes->post('getdeptlist', 'Maintenance\ReferenceMaintenance::getdeptlist');
        $routes->post('getposlist', 'Maintenance\ReferenceMaintenance::getposlist');
        $routes->post('getseclist', 'Maintenance\ReferenceMaintenance::getseclist');
        
        $routes->post('addcompany', 'Maintenance\ReferenceMaintenance::addcompany');
        $routes->post('adddept', 'Maintenance\ReferenceMaintenance::adddept');
        $routes->post('addpos', 'Maintenance\ReferenceMaintenance::addpos');
        $routes->post('addsec', 'Maintenance\ReferenceMaintenance::addsec');

        $routes->post('UpdateRefList', 'Maintenance\ReferenceMaintenance::UpdateRefList');
 
        $routes->post('EditCompany', 'Maintenance\ReferenceMaintenance::EditCompany');
        $routes->post('EditDept', 'Maintenance\ReferenceMaintenance::EditDept');
        $routes->post('EditPos', 'Maintenance\ReferenceMaintenance::EditPos');
        $routes->post('EditSec', 'Maintenance\ReferenceMaintenance::EditSec');

        $routes->post('getcompanydeptlist', 'Maintenance\ReferenceMaintenance::getcompanydeptlist');
        $routes->post('getdeptpositionlist', 'Maintenance\ReferenceMaintenance::getdeptpositionlist');
        $routes->post('getdeptsectionlist', 'Maintenance\ReferenceMaintenance::getdeptsectionlist');

        $routes->post('addbranch', 'Maintenance\ReferenceMaintenance::addbranch');
        $routes->get('getbranchlist', 'Maintenance\ReferenceMaintenance::getbranchlist');
        $routes->get('getarealist', 'Maintenance\ReferenceMaintenance::getarealist');
        $routes->post('getcitylist', 'Maintenance\ReferenceMaintenance::getcitylist');
        $routes->post('getbrgylist', 'Maintenance\ReferenceMaintenance::getbrgylist');
        
        
    });

    
    // Reference Maintenance

});

