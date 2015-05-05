<?php
/**
 * Created by PhpStorm.
 * User: Tosil
 * Date: 3.5.2015 г.
 * Time: 17:05 ч.
 */

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
}