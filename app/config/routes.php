<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$router->get('create-migration/{migration_class}', 'MigrationController::create_migration');
$router->get('migrate', 'MigrationController::migrate');
$router->get('rollback', 'MigrationController::rollback');
$router->get('rollback-all', 'MigrationController::rollback_all');
$router->get('refresh', 'MigrationController::refresh');
$router->get('status', 'MigrationController::status');


// Root and direct aliases
//$route['/']                     = 'AuthController/login';
//$route['login']                  = 'AuthController/login';
//$route['register']               = 'AuthController/register';
//$route['logout']                 = 'AuthController/logout';

// Core routes
//$route['auth/login']             = 'AuthController/login';
//$route['auth/register']          = 'AuthController/register';
// $route['auth/logout']            = 'AuthController/logout';
//$route['products']               = 'ProductController/index';
//$route['products/create']        = 'ProductController/create';
//$route['products/edit/(:num)']   = 'ProductController::edit';
//$route['products/delete/(:num)'] = 'ProductController::delete';
// Student Routes
//$router->get('/', 'StudentController::index');
//$router->get('/student', 'StudentController::index');
//$router->get('/student/profile', 'StudentController::profile');
//$router->get('/student/login', 'StudentController::login');
//$router->get('/student/logout', 'StudentController::logout');