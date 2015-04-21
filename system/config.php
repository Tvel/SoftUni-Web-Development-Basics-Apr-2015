<?php
spl_autoload_register(function ($class) {
    include_once( SITE_ROOT_DIR.'lib'.SITE_DS . $class . '.php');
});
spl_autoload_register(function ($class) {
    include_once( SITE_ROOT_DIR.'models'.SITE_DS . $class . '.php');
});


$db_host  = "localhost";  //The host on which database run
$db_name  = "";  //Database name
$db_login = "root";  //Database login
$db_pass  = "";  //password