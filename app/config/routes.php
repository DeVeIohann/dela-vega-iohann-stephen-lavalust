<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

// LavaLust Users Route
$router->get('/users', 'UsersController::index');

// Student Routes
$router->get('/', 'StudentController::index');
$router->get('/student', 'StudentController::index');
$router->get('/student/profile', 'StudentController::profile');
$router->get('/student/login', 'StudentController::login');
$router->get('/student/logout', 'StudentController::logout');