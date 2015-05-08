<?php
define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'root' );
//define( 'DB_USERNAME', 'evel_softuni' );
define( 'DB_PASSWORD', '' );
//define( 'DB_PASSWORD', 'evelsoftuni' );
define( 'DB_DATABASE', 'evel_softuni' );

function MyAutoload($class){
    if ( file_exists( SITE_ROOT_DIR.'lib'.SITE_DS . $class . '.php' ) ) {
        include_once( SITE_ROOT_DIR.'lib'.SITE_DS . $class . '.php');
    }
    if ( file_exists( SITE_ROOT_DIR.'models'.SITE_DS . $class . '.php' ) ) {
        include_once( SITE_ROOT_DIR.'models'.SITE_DS . $class . '.php');
    }
}
spl_autoload_register('MyAutoload');

//init DB
include_once( SITE_ROOT_DIR.'lib'.SITE_DS.'rb-3.5.13.php');
include_once( SITE_ROOT_DIR.'system'.SITE_DS.'Exceptions.php');
include_once( SITE_ROOT_DIR.'system'.SITE_DS.'Auth_Check.php');
include_once( SITE_ROOT_DIR.'system'.SITE_DS.'Page_Check.php');
include_once( SITE_ROOT_DIR.'system'.SITE_DS.'Helper.php');
new Database_RB();
