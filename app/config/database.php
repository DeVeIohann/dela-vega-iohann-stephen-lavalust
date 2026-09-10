<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$host = getenv('DB_HOST') ?: getenv('DB_HOSTNAME') ?: 'localhost';
$username = getenv('DB_USERNAME') ?: getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: getenv('DB_PASS') ?: '';
$database_name = getenv('DB_DATABASE') ?: getenv('DB_NAME') ?: 'dbact5';
$port = getenv('DB_PORT') ?: 3306;

$database = array(
    'main' => array(
        'hostname' => $host,
        'username' => $username,
        'password' => $password,
        'database' => $database_name,
        'port'     => $port,
        'driver'   => 'mysql',
        'charset'  => 'utf8mb4',
        'collate'  => 'utf8mb4_unicode_ci',
        'prefix'   => '',
        'dbprefix' => ''
    ),
    'default' => array(
        'hostname' => $host,
        'username' => $username,
        'password' => $password,
        'database' => $database_name,
        'port'     => $port,
        'driver'   => 'mysql',
        'charset'  => 'utf8mb4',
        'collate'  => 'utf8mb4_unicode_ci',
        'prefix'   => '',
        'dbprefix' => ''
    )
);


