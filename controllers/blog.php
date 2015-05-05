<?php
//namespace Controllers;

class Blog_Controller {


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
        $tags = $blog_model->get_tags();

        $template = new Template('master/index.php');
       // $template->set('put', 'putted');
        $template->set('posts', $result);
        $template->set('months', $months);
        $template->set('tags', $tags);
        $template->render();
    }

    public function newpost(){

        $template = new Template('master/newpost.php');
        $template->set('title', 'New Post');

        if (isset($_POST['title']) && isset($_POST['text']) ) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $tags = null;
            if (isset($_POST['tags'])) {
                $tags = $_POST['tags'];
            }

            $blog_model = new Blog_Model();
            try {
                $id = $blog_model->new_post($title, $text, $tags);

                header("Location: ".SITE_ROOT_URL."blog/post/".$id);
                die();
            }
            catch (InvalidFormDataException $ex){
                $template->set('error', $ex->getMessage());
            }

        }


        $template->render();
    }
}