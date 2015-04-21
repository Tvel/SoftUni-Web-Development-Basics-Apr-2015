<?php
spl_autoload_register(function ($class) {
    if ( file_exists( SITE_ROOT_DIR.'lib'.SITE_DS . $class . '.php' ) ) {
        include_once( SITE_ROOT_DIR.'lib'.SITE_DS . $class . '.php');
    }

});
spl_autoload_register(function ($class) {
    if ( file_exists( SITE_ROOT_DIR.'models'.SITE_DS . $class . '.php' ) ) {
        include_once( SITE_ROOT_DIR.'models'.SITE_DS . $class . '.php');
    }
});


$db_host  = "localhost";  //The host on which database run
$db_name  = "softuni";  //Database name
$db_login = "root";  //Database login
$db_pass  = "";  //password

$db = new Database($db_host,$db_name,$db_login,$db_pass);