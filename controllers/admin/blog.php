<?php
class Blog_AdminController {

    public function index (){
        $this->stats();
    }

    public function stats(){
        if (!Auth_Check::Moderator()) {
            throw new NotAuthenticatedException("You have no rights to view stats");
        }
        $template = new Template('admin/blog/stats.php');
        $template->set_header('admin/header.php');
        $template->render();
    }

    public function posts(){
        if (!Auth_Check::OnlyAdmin()) {
            throw new NotAuthenticatedException("You have no rights to view all posts");
        }
        $template = new Template('user/myposts.php');
        $template->set_header('admin/header.php');
        $template->set('pageTitle', 'All Posts');

        $blog_model = new Blog_Model();

        $posts = $blog_model->GetPosts(1,PHP_INT_MAX);

        $users_posts = array();
        foreach ($posts as $post) {
            array_push($users_posts,array(
                'id' => $post->id,
                'title' => $post->title,
                'date' => $post->date,
                'comments' => $post->countOwn('comments'),
            ) );
        }
        $users_posts = json_encode($users_posts);

        $template->set('posts', $users_posts);



        $template->render();
    }

    public function editpost(){
        $blog_model = new Blog_Model();
        $post = $blog_model->GetPost(Parameters::get(0));

        if(!Auth_Check::CheckIfCanEditPost($post)){
            throw new NotAuthenticatedException("You don't have the rights to edit posts");
        }

        $postTags = implode(',', array_map(create_function('$o', 'return $o->name;'), $post->sharedTags));
        $template = new Template('master/newpost.php');
        $template->set_header('admin/header.php');
        $template->set('title', 'Admin Edit Post');
        $template->set('postTitle', $post->title);
        $template->set('text', $post->text);
        $template->set('tags', $postTags);

        if (isset($_POST['title']) && isset($_POST['text']) ) {
            $title = Helper::SanatizeString( $_POST['title']);
            $text = $_POST['text'];
            $tags = null;
            if (isset($_POST['tags'])) {
                $tags = Helper::SanatizeString($_POST['tags']);
            }
            try {
                $id = $blog_model->EditPost($post->id, $title, $text, $tags);

                header("Location: ".SITE_ROOT_URL."admin/blog/posts/");
                die();
            }
            catch (InvalidFormDataException $ex){
                $template->set('error', $ex->getMessage());
            }
        }

        $template->render();
    }

    public function deletepost(){
        $blog_model = new Blog_Model();
        $post = $blog_model->GetPost(Parameters::get(0));
        if(!Auth_Check::CheckIfCanEditPost($post)){
            throw new NotAuthenticatedException("You don't have the rights to delete posts");
        }
        $blog_model->DeletePost($post->id);

        header("Location: ".SITE_ROOT_URL."admin/blog/posts/");
        die();
    }
}