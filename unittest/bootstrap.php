<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author hucak
 */
// TODO: check include path
//ini_set('include_path', ini_get('include_path'));
// put your code here

      
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
xdebug_disable();
define('BASEPATH',"../system/");
ini_set('xdebug.show_exception_trace', 0);
define("APPPATH", "../application/");
define("ENVIRONMENT", "product");
define('VIEWPATH', APPPATH."views".DIRECTORY_SEPARATOR);
define('PHPUNIT',true);
$_SERVER['SERVER_PORT'] = 80;
$_SERVER['HTTP_HOST'] = "localhost";
$_SERVER['REQUEST_URI'] = "/admin/login";

require_once "../system/core/CodeIgniter.php";
require_once "../system/core/Common.php";
require_once "../system/core/Controller.php";
require_once "../system/core/Model.php";
require_once "../system/database/DB.php";


?>
