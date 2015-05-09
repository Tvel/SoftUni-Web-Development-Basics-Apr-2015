<?php
class Error_Controller {

    public function index($error = 'Error'){

        $template = new Template('master/error.php');
        $template->set('error', $error);
        $template->render();
    }
}