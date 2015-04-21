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


define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_DATABASE', 'softuni' );

