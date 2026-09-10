<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$route['default_controller'] = 'AuthController';

$route['auth/login']             = 'AuthController/login';
$route['auth/logout']            = 'AuthController/logout';
$route['products']               = 'ProductController/index';
$route['products/create']        = 'ProductController/create';
$route['products/edit/(:num)']   = 'ProductController/edit/$1';
$route['products/delete/(:num)'] = 'ProductController/delete/$1';
// Student Routes
//$router->get('/', 'StudentController::index');
//$router->get('/student', 'StudentController::index');
//$router->get('/student/profile', 'StudentController::profile');
//$router->get('/student/login', 'StudentController::login');
//$router->get('/student/logout', 'StudentController::logout');