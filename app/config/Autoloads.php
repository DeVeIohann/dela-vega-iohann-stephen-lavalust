<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$autoload['libraries'] = array('database', 'session');
$autoload['helpers']   = array('url');
$autoload['models']    = array('ProductModel', 'Usersmodel');