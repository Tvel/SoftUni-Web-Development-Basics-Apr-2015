<?php

class Blog_Model {

    public function get_posts($page)
    {
        $numOfPosts = R::count( 'posts' );

        // 5 per page
        $limit = 5 * $page;
        $start = $limit - 5;
        if ( ($start - $numOfPosts) > 0) {
            throw new Exception("Invalid page");
            //die("Invalid page");
        }

        $result = R::findAll('posts', ' ORDER BY date DESC LIMIT :start,:end ',
            [ ':start' => $start, ':end' => $limit  ]);
        return $result;
    }

    public function get_months($filter = null, $data = null){

        if ($filter == null) {
           return R::getAll( 'SELECT distinct monthname(date) as month, year(date) as year FROM posts order by year(date) desc');
        }

        if ($filter === 'tags') {

        }
        if ($filter === 'user') {

        }
    }

    public function get_tags() {
        $result = R::findAll('tags', ' ORDER BY name' );
        return $result;
    }

    public function new_post($title, $text, $tags){

        $post = R::dispense('posts');
        $post->title = $title;
        $post->text = $text;

        $post->users_id = $_SESSION['userId'];

        if ($tags !== null) {
            $tags = explode(',', $tags);

            $post->sharedTagsList = array();
            foreach ($tags as $tagname){
                $tagname = mb_strtolower($tagname);

                $tag = R::findOne('tags', 'name = ?', [$tagname ] );
                if ($tag === null) {
                    $tag = R::dispense('tags');
                    $tag->name = $tagname;
                }

                $post->sharedTagsList[] = $tag;
            }
        }

        R::store($post);
        return $post->id;

    }
}