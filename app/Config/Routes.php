<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->post('/qr/generate', 'QRController::generate');
$routes->get("/api/chart", "ProductionController::chart");

// Login
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->post('/logout', 'AuthController::logout');

// Check if admin is login above ..
$routes->group("", ['filter' => 'checkadmin'], function ($routes) {
    $routes->get('/admin', 'Home::adminHome');
    $routes->get('/operator', 'Home::adminHome');

    // Operator
    $routes->get('/operator', 'OperatorController::index');
    $routes->get('/operator/add', 'OperatorController::add');
    $routes->post('/operator/add', 'OperatorController::store');
    $routes->get('/operator/edit/(:any)', 'OperatorController::edit/$1');
    $routes->post('/operator/edit/(:any)', 'OperatorController::update/$1');
    $routes->get('/operator/delete/(:any)', 'OperatorController::delete/$1');
    $routes->post('/operator/upload-image/(:any)', 'OperatorController::uploadImage/$1');


    // qr
    $routes->get('/qr', 'QRDataController::index');
    $routes->get('/qr/add', 'QRDataController::add');
    $routes->post('/qr/add', 'QRDataController::store');
    $routes->get('/qr/edit/(:any)', 'QRDataController::edit/$1');
    $routes->post('/qr/edit/(:any)', 'QRDataController::update/$1');
    $routes->get('/qr/delete/(:any)', 'QRDataController::delete/$1');


    //shifts
    $routes->get('/shift', 'ShiftController::index');
    $routes->get('/shift/add', 'ShiftController::add');
    $routes->post('/shift/add', 'ShiftController::store');
    $routes->get('/shift/edit/(:any)', 'ShiftController::edit/$1');
    $routes->post('/shift/edit/(:any)', 'ShiftController::update/$1');
    $routes->get('/shift/delete/(:any)', 'ShiftController::delete/$1');

    // item
    $routes->get('/item', 'ItemController::index');
    $routes->get('/item/add', 'ItemController::add');
    $routes->post('/item/add', 'ItemController::store');
    $routes->get('/item/edit/(:any)', 'ItemController::edit/$1');
    $routes->post('/item/edit/(:any)', 'ItemController::update/$1');
    $routes->get('/item/delete/(:any)', 'ItemController::delete/$1');


    // Machine
    $routes->get('/machine', 'MachineController::index');
    $routes->get('/machine/add', 'MachineController::add');
    $routes->post('/machine/add', 'MachineController::store');
    $routes->get('/machine/edit/(:any)', 'MachineController::edit/$1');
    $routes->post('/machine/edit/(:any)', 'MachineController::update/$1');
    $routes->get('/machine/delete/(:any)', 'MachineController::delete/$1');


});


$routes->group('',['filter' => 'checkppic'], function ($routes) {
    $routes->get('/ppic', 'Home::ppicHome');
});

// Check is operator that login into ...
$routes->group('', ['filter' => 'checkoperator'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/home', 'Home::index');

    // QR
    $routes->get("/api/qr/(:any)", "QRDataController::showQrData/$1");

    // production
    $routes->get('/production', 'ProductionController::index');
    $routes->get('/production/report', 'ProductionController::index');
    $routes->get('/production/add', 'ProductionController::add');
    $routes->post('/production/add/(:any)', 'ProductionController::store/$1');
    $routes->get('/production/edit/(:any)', 'ProductionController::edit/$1');
    $routes->post('/production/edit/(:any)', 'ProductionController::update/$1');
    $routes->get('/production/delete/(:any)', 'ProductionController::delete/$1');
    $routes->get("/qr/scan", "QRDataController::scan");
});

