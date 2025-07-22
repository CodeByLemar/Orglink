<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

$routes->setPrioritize();



$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->group('Reports', static function ($routes) {

        $routes->get('/', 'Pages\Reports::index');
        $routes->get('collection_report', 'Pages\Reports::collection_report'); 
        $routes->post('getcollection_report', 'Pages\Reports::getcollection_report');  
        
        $routes->get('gov_contribution_summary', 'Pages\Reports::gov_contribution_summary'); 
        $routes->get('payroll_summary', 'Pages\Reports::payroll_summary'); 
        $routes->get('Alphalist', 'Pages\Reports::Alphalist');  
        $routes->post('Generate_Alphalist', 'Pages\Reports::Generate_Alphalist');
        
        $routes->get('discrepancy_summary', 'Pages\Reports::discrepancy_summary'); 
        $routes->post('upload_dtr', 'Pages\Reports::upload_discrepancy');
        $routes->get('loadDisputeList', 'Pages\Reports::loaduploadeddiscrepancy');
        $routes->get('PayholdSummary', 'Pages\Reports::PayholdSummary');
        $routes->get('getpayholdlist', 'Pages\Reports::getpayholdlist');
        
    });
});