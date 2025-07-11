<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

$routes->setPrioritize();



$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->group('Dashboard', static function ($routes) {
 
        $routes->post('getprocsmonth', 'Pages\Dashboard::getprocsmonth');  
        $routes->post('getunaccommonth', 'Pages\Dashboard::getunaccommonth');  
        $routes->post('getdentistprocs', 'Pages\Dashboard::getdentistprocs');  
        $routes->post('getproccountmonth', 'Pages\Dashboard::getproccountmonth');  
        

    });
});