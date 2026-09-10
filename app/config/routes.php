<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$route['default_controller'] = 'auth/login';

// Auth Routes
$route['auth/login']        = 'Auth/login';
$route['auth/authenticate'] = 'Auth/authenticate';
$route['auth/logout']       = 'Auth/logout';

// Product Routes
$route['products']             = 'Products/index';
$route['products/create']       = 'Products/create';
$route['products/store']        = 'Products/store';
$route['products/edit/(:num)']   = 'Products/edit/$1';
$route['products/update/(:num)'] = 'Products/update/$1';
$route['products/delete/(:num)'] = 'Products/delete/$1';
// LavaLust Users Route
$router->get('/users', 'UsersController::index');


// Student Routes
$router->get('/', 'StudentController::index');
$router->get('/student', 'StudentController::index');
$router->get('/student/profile', 'StudentController::profile');
$router->get('/student/login', 'StudentController::login');
$router->get('/student/logout', 'StudentController::logout');