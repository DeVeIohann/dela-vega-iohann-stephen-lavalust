<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$database['main'] = array(
    'hostname' => getenv('DB_HOST') ?: 'mysql-334b58b3-delavegaiohann0-3b63.a.aivencloud.com',
    'username' => getenv('DB_USERNAME') ?: 'avnadmin',
    'password' => getenv('DB_PASSWORD') ?: 'git add .',
    'database' => getenv('DB_DATABASE') ?: 'defaultdb',
    'driver'   => 'mysql',
    'charset'  => 'utf8',
    'collate'  => 'utf8_general_ci',
    'port'     => getenv('DB_PORT') ?: 27354,
    'dbprefix' => ''
);