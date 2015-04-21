<?php
//namespace Controllers;

class Master_Controller {


    public function index(){

        $test_model = new Test_Model();
        $result = $test_model->get_test();

        $template = new Template('master/index.php');
        $template->set('put', 'putted');
        $template->set('rows', $result);
        $template->render();
    }

    public function asd(){

        $template = new Template('master/index.php');
        $template->set('put', 'asd');
        $template->render();
    }
}