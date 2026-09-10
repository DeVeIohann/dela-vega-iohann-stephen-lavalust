<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$host = getenv('DB_HOST') ?: getenv('DB_HOSTNAME') ?: 'localhost';
$username = getenv('DB_USERNAME') ?: getenv('DB_USER') ?: 'avnadmin';
$password = getenv('DB_PASSWORD') ?: getenv('DB_PASS') ?: '';
$database = getenv('DB_DATABASE') ?: getenv('DB_NAME') ?: 'app';
$port = getenv('DB_PORT') ?: 3306;

$db['default'] = array(
    'hostname' => $host,
    'username' => $username,
    'password' => $password,
    'database' => $database,
    'port'     => $port,
    'driver'   => 'mysql',
    'charset'  => 'utf8mb4',
    'collate'  => 'utf8mb4_unicode_ci',
    'prefix'   => ''
);


