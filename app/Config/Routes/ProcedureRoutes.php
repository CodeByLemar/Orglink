<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

$routes->setPrioritize();



$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->group('Procedures', static function ($routes) {
        $routes->get('/', 'Pages\Procedures::index');
        
        $routes->post('submit_clientinfo', 'Pages\Procedures::submit_clientinfo');
        $routes->post('getprovince', 'Pages\Procedures::getprovince');
        $routes->post('getcities', 'Pages\Procedures::getcities');
        $routes->post('getbrgys', 'Pages\Procedures::getbrgys');

        $routes->get('AppointmentCalendar', 'Pages\Procedures::AppointmentCalendar');
        $routes->post('create_new_app', 'Pages\Procedures::create_new_app');

        $routes->post('getclients', 'Pages\Procedures::getclients');
        $routes->post('getdentists', 'Pages\Procedures::getdentists');
        $routes->post('getschedule', 'Pages\Procedures::getschedule');
        
        $routes->get('ProcedureList', 'Pages\Procedures::ProcedureList');
        $routes->post('getProcedures', 'Pages\Procedures::getProcedures');
        $routes->post('getSubProcedures', 'Pages\Procedures::getSubProcedures'); 
        $routes->post('addProcedure', 'Pages\Procedures::addProcedure');
        $routes->post('restoreproc', 'Pages\Procedures::restoreproc');
        $routes->post('deleteproc', 'Pages\Procedures::deleteproc');

        $routes->post('addsubprocedure', 'Pages\Procedures::addsubprocedure');
        $routes->post('getprocedurelist', 'Pages\Procedures::getprocedurelist');
        $routes->post('getclienthistory', 'Pages\Procedures::getclienthistory');
        


        
        $routes->get('RoomList', 'Pages\Procedures::RoomList');
        $routes->post('addroom', 'Pages\Procedures::addroom');
        $routes->post('getrooms', 'Pages\Procedures::getrooms');
        $routes->post('restoreroom', 'Pages\Procedures::restoreroom');
        $routes->post('deleteroom', 'Pages\Procedures::deleteroom');

        $routes->get('BranchList', 'Pages\Procedures::BranchList');
        $routes->post('addbranch', 'Pages\Procedures::addbranch'); 
        $routes->post('getbranches', 'Pages\Procedures::getbranches'); 
        $routes->post('restorebranch', 'Pages\Procedures::restorebranch');
        $routes->post('deletebranch', 'Pages\Procedures::deletebranch');

        $routes->get('InventoryList', 'Pages\Procedures::InventoryList'); 
        $routes->post('getitemmaster', 'Pages\Procedures::getitemmaster'); 
        $routes->post('addnewitem', 'Pages\Procedures::addnewitem');
        $routes->post('restoreitem', 'Pages\Procedures::restoreitem');
        $routes->post('deleteitem', 'Pages\Procedures::deleteitem');
        $routes->post('edititem', 'Pages\Procedures::edititem');
        
        $routes->post('getconfigprocs', 'Pages\Procedures::getconfigprocs');
        $routes->post('getproc_items', 'Pages\Procedures::getproc_items');
        $routes->post('add_itemproc', 'Pages\Procedures::add_itemproc');
        
        $routes->post('getbreakdown','Pages\Procedures::getbreakdown');
        $routes->post('getprocbreakdown','Pages\Procedures::getprocbreakdown');
        
        $routes->post('complete_app','Pages\Procedures::complete_app');
        
        $routes->post('submit_billing','Pages\Procedures::submit_billing');

        $routes->post('getarpaymentschedule', 'Pages\Procedures::getarpaymentschedule'); 
        
        $routes->post('submit_payment','Pages\Procedures::submit_payment');
        
        $routes->post('searchpatient','Pages\Procedures::searchpatient');
        $routes->post('populateclientinfo','Pages\Procedures::populateclientinfo');
        $routes->post('populateclientaddress','Pages\Procedures::populateclientaddress');
        $routes->post('populateclientcontactinfo','Pages\Procedures::populateclientcontactinfo');
        $routes->post('populateclientreference','Pages\Procedures::populateclientreference');
        $routes->post('populateclientmedhistory','Pages\Procedures::populateclientmedhistory');
        
        $routes->get('HMOCompanyList', 'Pages\Procedures::HMOCompanyList'); 
        $routes->post('gethmocompany','Pages\Procedures::gethmocompany');
        $routes->post('addhmocompany', 'Pages\Procedures::addhmocompany');
        $routes->post('restorehmocom', 'Pages\Procedures::restorehmocom');
        $routes->post('deletehmocom', 'Pages\Procedures::deletehmocom');
         
        $routes->post('populate_bank','Pages\Procedures::populate_bank');
        $routes->post('populate_company','Pages\Procedures::populate_company');
        
        $routes->get('BankList', 'Pages\Procedures::BankList'); 
        $routes->post('getbanklist','Pages\Procedures::getbanklist');
        $routes->post('addbank', 'Pages\Procedures::addbank');
        $routes->post('restorebank', 'Pages\Procedures::restorebank');
        $routes->post('deletebank', 'Pages\Procedures::deletebank');

        $routes->post('setclienttreatmentplan', 'Pages\Procedures::setclienttreatmentplan');
        $routes->get('treatmentplan', 'Pages\Procedures::treatmentplan');
        $routes->get('treatmentplan_pdf', 'Pages\Procedures::treatmentplan_pdf');
        $routes->post('submit_treatmentplan', 'Pages\Procedures::submit_treatmentplan');
        $routes->post('gettreatmentplan', 'Pages\Procedures::gettreatmentplan');

        $routes->post('submit_resched', 'Pages\Procedures::submit_resched');
        $routes->post('submit_cancel', 'Pages\Procedures::submit_cancel');
        
        
        $routes->post('setclientperiodontal', 'Pages\Procedures::setclientperiodontal');
        $routes->get('client_periodontal', 'Pages\Procedures::client_periodontal');

        $routes->post('getclientinfobyrefno', 'Pages\Procedures::getclientinfobyrefno');
        $routes->post('submit_periodontalchart', 'Pages\Procedures::submit_periodontalchart');
        $routes->post('retrieveperiodontaldata', 'Pages\Procedures::retrieveperiodontaldata');
        $routes->post('submit_remarks', 'Pages\Procedures::submit_remarks');
        $routes->post('retrieve_remarks', 'Pages\Procedures::retrieve_remarks');
        $routes->post('generate_treatmentnotes', 'Pages\Procedures::generate_treatmentnotes');
        $routes->get('Treatment_Notes_pdf', 'Pages\Procedures::Treatment_Notes_pdf');
        
    });

});

