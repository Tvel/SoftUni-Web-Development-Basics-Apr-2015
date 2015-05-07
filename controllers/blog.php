<?php
//namespace Controllers;

class Blog_Controller {

    public function index(){
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
        if(!Auth_Check::Poster()){
            throw new NotAuthenticatedException("You don't have the rights to make new posts");
        }

        $template = new Template('master/newpost.php');
        $template->set('title', 'New Post');

        if (isset($_POST['title']) && isset($_POST['text']) ) {
            $title = Helper::SanatizeString( $_POST['title']);
            $text = Helper::SanatizeString($_POST['text']);
            $tags = null;
            if (isset($_POST['tags'])) {
                $tags = Helper::SanatizeString($_POST['tags']);
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

    public function tag(){
        $tagId = Parameters::get(0); // /blog/tag/:id
        $page = intval( Parameters::get(1) ); // /blog/tag/:id/:page
        if ($page < 1){
            $page = 1;
        }
        $number = 5; //5 items per page
        $blog_model = new Blog_Model();
        $result = $blog_model->get_posts($page, $number, 'tags', $tagId);

        $months = $blog_model->get_months();
        $tags = $blog_model->get_tags();

        $template = new Template('master/index.php');
        // $template->set('put', 'putted');
        $template->set('posts', $result);
        $template->set('months', $months);
        $template->set('tags', $tags);
        $template->set('tag_id', $tagId);

        $limit = $number * $page;
        if ($limit >= $blog_model->num_posts('tags', $tagId)) {
            $template->set('next_page', null);
        }
        else{
            $template->set('next_page', $page+1);
        }
        if ($page == 1 ) { $template->set('prev_page',null);}
        else {$template->set('prev_page', $page-1); }

        $template->render();
    }

    public function date(){
        $filters = array();
        $filters['year'] = Parameters::get(0); // /blog/date/:year/:month
        $filters['month'] = Parameters::get(1); // /blog/date/:year/:month
        $page = intval( Parameters::get(2) ); // /blog/date/:year/:month/:page
        if ($page < 1){
            $page = 1;
        }
        $number = 5; //5 items per page
        $blog_model = new Blog_Model();
        $result = $blog_model->get_posts($page, $number, 'date', $filters);

        $months = $blog_model->get_months();
        $tags = $blog_model->get_tags();

        $template = new Template('master/index.php');
        // $template->set('put', 'putted');
        $template->set('posts', $result);
        $template->set('months', $months);
        $template->set('tags', $tags);
        $template->set('year', $filters['year']);
        $template->set('month', $filters['month']);

        $limit = $number * $page;
        if ($limit >= $blog_model->num_posts('date', $filters)) {
            $template->set('next_page', null);
        }
        else{
            $template->set('next_page', $page+1);
        }
        if ($page == 1 ) { $template->set('prev_page',null);}
        else {$template->set('prev_page', $page-1); }

        $template->render();
    }
}