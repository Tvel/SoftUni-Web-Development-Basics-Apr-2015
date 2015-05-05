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
        $number = 5; //5 items per page
        $blog_model = new Blog_Model();
        $result = $blog_model->get_posts($page, $number);

        $months = $blog_model->get_months();
        $tags = $blog_model->get_tags();

        $template = new Template('master/index.php');
       // $template->set('put', 'putted');
        $template->set('posts', $result);
        $template->set('months', $months);
        $template->set('tags', $tags);


        $limit = $number * $page;
        if ($limit >= $blog_model->num_posts()) {
            $template->set('next_page', null);
        }
        else{
            $template->set('next_page', $page+1);
        }
        if ($page == 1 ) { $template->set('prev_page',null);}
        else {$template->set('prev_page', $page-1); }

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

    public function post(){

        $page_id = Parameters::get(0);


        $template = new Template('master/post.php');
        $blog_model = new Blog_Model();
        $post = $blog_model->get_post($page_id);
        $months = $blog_model->get_months();
        $tags = $blog_model->get_tags();
        $template->set('months', $months);
        $template->set('tags', $tags);
        $template->set('post', $post);

        if (isset($_POST['comment_text'])){
            $text = $_POST['comment_text'];

            $name = null;
            $email = null;
            if (isset($_POST['comment_name'])  ) $name = $_POST['comment_name'];
            if (isset($_POST['comment_email'])  )  $email = $_POST['comment_email'];

            $blog_model->new_comment($post, $text, $name, $email);
        }

        $template->render();
    }
}