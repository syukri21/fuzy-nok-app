<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/admin', 'Home::adminHome');
$routes->get('/operator', 'Home::adminHome');

// Login
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->post('/logout', 'AuthController::logout');

// Operator
$routes->get('/operator', 'OperatorController::index');
$routes->get('/operator/add', 'OperatorController::add');
$routes->post('/operator/add', 'OperatorController::store');
$routes->get('/operator/edit/(:any)', 'OperatorController::edit/$1');
$routes->post('/operator/edit/(:any)', 'OperatorController::update/$1');
$routes->get('/operator/delete/(:any)', 'OperatorController::delete/$1');
