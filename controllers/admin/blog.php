<?php
class Blog_AdminController {

    public function index (){
        $this->comments();
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

    public function comments(){
        if (!Auth_Check::Moderator()) {
            throw new NotAuthenticatedException("You have no rights to view all comments");
        }
        $template = new Template('admin/blog/comments.php');
        $template->set_header('admin/header.php');
        $template->set('pageTitle', 'Comments');
        $blog_model = new Blog_Model();
        $comments = $blog_model->GetComments();

        $comments_json = array();
        foreach ($comments as $comment) {
            if($comment->posts_id == null) {
                $title = null;
                $posts_id = null;
            }
            else {
                $title = $comment->posts->title;
                $posts_id = $comment->posts_id;
            }
            if($comment->users_id == null){
                $userName = $comment->name;
                $userEmail = $comment->email;
            }
            else {
                $userName = $comment->users->username;
                $userEmail =  $comment->users->email;
            }
            array_push($comments_json,array(
                'id' => $comment->id,
                'user' => $userName,
                'email' =>  $userEmail,
                'date' => $comment->date,
                'post' => $title,
                'text' => $comment->text,
                'users_id' => $comment->users_id,
                'posts_id' => $posts_id
            ) );

        }

        $comments_json = json_encode($comments_json);
        $template->set('comments', $comments_json);

        $template->render();
    }

    public function editcomment(){
        $blog_model = new Blog_Model();
        $comment= $blog_model->GetComment(Parameters::get(0));
        if(!Auth_Check::CheckIfCanEditComment($comment)){
            throw new NotAuthenticatedException("You don't have the rights to edit comments");
        }

        $template = new Template('admin/blog/editcomment.php');
        $template->set_header('admin/header.php');
        $template->set('title', 'Admin Edit Comment');

        if($comment->users_id == null){
            $userName = $comment->name;
            $userEmail = $comment->email;
        }
        else {
            $userName = $comment->users->username;
            $userEmail =  $comment->users->email;
        }

        $template->set('user', $userName);
        $template->set('email', $userEmail);
        $template->set('text', $comment->text);


        if ( isset($_POST['text']) ) {
            $text = Helper::SanatizeString( $_POST['text']);

            try {
                $id = $blog_model->EditComment($comment->id, $text);

                header("Location: ".SITE_ROOT_URL."admin/blog/comments/");
                die();
            }
            catch (InvalidFormDataException $ex){
                $template->set('error', $ex->getMessage());
            }
        }

        $template->render();
    }

    public function deletecomment(){
        $blog_model = new Blog_Model();
        $comment = $blog_model->GetComment(Parameters::get(0));
        if(!Auth_Check::CheckIfCanEditComment($comment)){
            throw new NotAuthenticatedException("You don't have the rights to delete comments");
        }
        $blog_model->DeleteComment($comment->id);

        header("Location: ".SITE_ROOT_URL."admin/blog/comments/");
        die();
    }

    public function tags(){
        if (!Auth_Check::CheckIfCanEditTags()) {
            throw new NotAuthenticatedException("You have no rights to view all tags");
        }
        $template = new Template('admin/blog/tags.php');
        $template->set_header('admin/header.php');
        $template->set('pageTitle', 'Tags');
        $blog_model = new Blog_Model();
        $tags = $blog_model->GetAllTags();

        $tags_json = array();
        foreach ($tags as $tag) {
            array_push($tags_json,array(
                'id' => $tag->id,
                'name' => $tag->name,
                'count' =>  $tag->countShared('posts'),
                'visits' => $tag->visits
            ) );

        }

        $tags_json = json_encode($tags_json);
        $template->set('tags', $tags_json);

        $template->render();
    }

    public function edittag(){
        if(!Auth_Check::CheckIfCanEditTags()){
            throw new NotAuthenticatedException("You don't have the rights to edit tags");
        }
        $blog_model = new Blog_Model();
        $tag =  $blog_model->GetTag(Parameters::get(0));


        $template = new Template('admin/blog/edittag.php');
        $template->set_header('admin/header.php');
        $template->set('title', 'Admin Edit Tag');

        $template->set('name', $tag->name);
        $template->set('visits', $tag->visits);

        if ( isset($_POST['name']) ) {
            $name = Helper::SanatizeString( $_POST['name']);
            $visits = Helper::SanatizeString( $_POST['visits']);

            try {
                $id = $blog_model->EditTag($tag->id, $name, $visits);

                header("Location: ".SITE_ROOT_URL."admin/blog/tags/");
                die();
            }
            catch (InvalidFormDataException $ex){
                $template->set('error', $ex->getMessage());
            }
        }

        $template->render();
    }

    public function deletetag(){
        if(!Auth_Check::CheckIfCanEditTags()){
            throw new NotAuthenticatedException("You don't have the rights to delete tags");
        }
        $blog_model = new Blog_Model();
        $blog_model->DeleteTag(Parameters::get(0));

        header("Location: ".SITE_ROOT_URL."admin/blog/tags/");
        die();
    }
}