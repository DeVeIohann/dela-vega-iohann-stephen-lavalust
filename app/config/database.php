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



