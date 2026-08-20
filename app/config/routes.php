<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// Part D: Route for Student Home Page
$router->get('/student', 'StudentController::index');

// Part D: Route for Student Profile Page
$router->get('/student/profile', 'StudentController::profile', ['middleware' => ['StudentMiddleware']]);
$router->get('/student/login', 'StudentController::login');
$router->get('/student/logout', 'StudentController::logout');