<?php
//namespace Controllers;

class Master_Controller {


    public function index(){

        //$test_model = new Test_Model();
        //$result = $test_model->get_test();

        $page = intval( Parameters::get(0) );
        if ($page < 1){
            $page = 1;
        }

        $blog_model = new Blog_Model();
        $result = $blog_model->get_posts($page);

        $months = $blog_model->get_months();

        $template = new Template('master/index.php');
       // $template->set('put', 'putted');
        $template->set('posts', $result);
        $template->set('months', $months);
        $template->render();
    }

    public function asd(){

        $template = new Template('master/index.php');
        $template->set('put', 'asd');
        $template->render();
    }
}