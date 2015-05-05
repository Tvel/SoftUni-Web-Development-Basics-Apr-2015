<?php
define( 'SITE_DS', DIRECTORY_SEPARATOR );
define( 'SITE_ROOT_DIR', dirname( __FILE__ ) . SITE_DS );
define( 'SITE_ROOT_PATH', basename( dirname( __FILE__ ) ) . SITE_DS );
define( 'SITE_ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] .'/' );//. basename( dirname( __FILE__ ) ).'/' );
session_cache_limiter('none');
session_start();
require_once('system/config.php');
require_once('controllers/blog.php');
$controller = 'Blog';
$method = 'index';
$params = array();
$url = null;
$controller_path = "";

if ( ! empty( $_GET['url'] ) ) {
    //$action = $_GET['url'];
    $url = trim($_GET['url'], '/');
    $url = explode('/', $url);

    $offset = 0;
    if ($url[0] === 'admin') {
        $offset = 1;
        $controller_path = "admin/";
    }

    if (count($url) > $offset) {
        $controller = $url[$offset];
        if (count($url) > ( $offset + 1 )) {
            $method = $url[ $offset + 1 ];
        }
        if (count($url) > ( $offset + 2 )) {
            $params = array_slice($url, $offset + 2 );
            new Parameters($params);
        }
    }
 }

try {
    if ( isset( $controller ) && file_exists( 'controllers/' . $controller_path . $controller . '.php' ) ) {
        include_once 'controllers/' . $controller_path . $controller . '.php';
        $controller_class =  ucfirst( $controller ) . '_Controller';
        $instance = new $controller_class();

        if( method_exists( $instance, $method ) ) {
            call_user_func_array( array( $instance, $method ), array( $params ) );
        } else {
            // fallback to index
            call_user_func_array( array( $instance, 'index' ), array() );
        }
    }
    else {
        include_once 'controllers/Error.php';
        $controller_class =  ucfirst( 'error' ) . '_Controller';
        $instance = new $controller_class();
        call_user_func_array( array( $instance, 'index' ), array( 'Wrong controller '.$controller ) );
    }
}
catch ( Exception  $ex) {
    include_once 'controllers/Error.php';
    $controller_class =  ucfirst( 'error' ) . '_Controller';
    $instance = new $controller_class();
    call_user_func_array( array( $instance, 'index' ), array( $ex->getMessage() ) );
}


//ob_start();



//echo ob_get_clean();





echo '<br /> URL ';
var_dump($url);
echo '<br /> Controller ';
var_dump($controller);
echo '<br /> Method ';
var_dump($method);
echo '<br /> Params ';
var_dump($params);

//var_dump($_GET);
echo '<br />';
echo 'SITE_DS : '.SITE_DS;
echo '<br />';
echo 'SITE_ROOT_DIR : '.SITE_ROOT_DIR;
echo '<br />';
echo 'SITE_ROOT_PATH : '.SITE_ROOT_PATH;
echo '<br />';
echo 'SITE_ROOT_URL : '.SITE_ROOT_URL;
?>

