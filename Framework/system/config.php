<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'es_SV');	
date_default_timezone_set('America/El_Salvador');
define('VERSION', '1.00');

//DIRECTORIOS DEL SISTEMA

define('DIR_SYSTEM', 'system/');
define('DIR_FRONT','');
define('DIR_DATABASE', 'system/database/');
define('DIR_FUNCTIONS', 'system/functions/');

define('HTTP_SERVER',"http://$_SERVER[HTTP_HOST]/production/app/");
//define('HTTP_SERVER',"localhost/production/app/");

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'dbprodusessg');
define('DB_PREFIX', 'pp_');

?>