<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/admin', 'Home::adminHome');

// Login
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->post('/logout', 'AuthController::logout');

// Operator
$routes->get('/operator', 'OperatorController::index');
$routes->get('/operator/add', 'OperatorController::add');
$routes->post('/operator/add', 'OperatorController::store');
