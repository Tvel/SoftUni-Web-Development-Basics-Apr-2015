<?php
/**
 * Created by PhpStorm.
 * User: Tvel
 * Date: 21.4.2015 г.
 * Time: 4:37
 */

class Error_Controller {

    public function index($error = 'Error'){

        $template = new Template('master/Error.php');
        $template->set('error', $error);
        $template->render();
    }
}