<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setPrioritize();

$routes->group('', ['filter' => 'authLogin'], function ($routes) {
    $routes->get('/', 'Auth\Authentication::index', ['as' => 'LoginForm']);
    $routes->post('/login', 'Auth\Authentication::Login_validation', ['as' => 'login']);
});



$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/Logout', 'Auth\Authentication::logOut', ['as' => 'Logout']);

    $routes->get('/test', 'Auth\Authentication::test', ['as' => 'test']);



});