<?php
define( 'SITE_DS', DIRECTORY_SEPARATOR );
define( 'SITE_ROOT_DIR', dirname( __FILE__ ) . SITE_DS );
define( 'SITE_ROOT_PATH', basename( dirname( __FILE__ ) ) . SITE_DS );
define( 'SITE_ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] .'/'. basename( dirname( __FILE__ ) ).'/' );
session_cache_limiter('none');
session_start();
require_once(SITE_ROOT_DIR.'system'.SITE_DS.'config.php');

$controller = 'Master';
$method = 'index';
$action = 'empty';
$url = 'none';
if ( ! empty( $_GET['url'] ) ) {
		$action = $_GET['url'];
		$url = trim($_GET['url'], '/');
		$url = explode('/', $url);


 }

//ob_start();

$template = new Template('master\index.php');
$template->set('put', 'putted');
$template->render();

//echo ob_get_clean();




//echo 'Action is: '.$action;
//echo '<br />';
//var_dump($url);
//echo '<br />';
//var_dump($_GET);
//echo '<br />';
//echo 'SITE_DS : '.SITE_DS;
//echo '<br />';
//echo 'SITE_ROOT_DIR : '.SITE_ROOT_DIR;
//echo '<br />';
//echo 'SITE_ROOT_PATH : '.SITE_ROOT_PATH;
//echo '<br />';
//echo 'SITE_ROOT_URL : '.SITE_ROOT_URL;

?>

