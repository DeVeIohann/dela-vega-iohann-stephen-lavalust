<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');


$db['default'] = array(
    'hostname' => getenv('DB_HOST') ?: 'mysql-334b58b3-delavegaiohann0-3b63.a.aivencloud.com',
    'username' => getenv('DB_USER') ?: 'avnadmin',
    'password' => getenv('DB_PASS') ?: '',
    'database' => getenv('DB_NAME') ?: 'dbact5',
    'port'     => getenv('DB_PORT') ?: 27354,
    'driver'   => 'mysql',
    'charset'  => 'utf8mb4',
    'collate'  => 'utf8mb4_unicode_ci',
    'prefix'   => ''
);
$database['main'] = array(
    'hostname' => getenv('DB_HOST') ?: 'localhost',
    'username' => getenv('DB_USERNAME') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
    'database' => getenv('DB_DATABASE') ?: 'defaultdb',
    'driver'   => 'mysql',
    'charset'  => 'utf8',
    'collate'  => 'utf8_general_ci',
    'port'     => getenv('DB_PORT') ?: 3306,
    'dbprefix' => ''
);


