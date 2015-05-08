<?php

class Blog_Model {

    /**
     * @param $page page number
     * @param $number number of page results
     * @param null $filter must be null, tags, date
     * @param null $filterValue if filter == tags then this is a tag id. If filter == date - this is an array with month and year
     * @return array|mixed returns posts array bean
     * @throws Exception
     * @throws InvalidIdException
     */
    public function GetPosts($page, $number, $filter = null, $filterValue = null)
    {
        $numOfPosts = $this->NumPosts($filter, $filterValue);

        // $number per page
        $limit = $number * $page;
        $start = $limit - $number;
        if ( ($start - $numOfPosts) > 0) {
            throw new Exception("Invalid page");
            //die("Invalid page");
        }

        switch($filter) {
            case null:
                $result = R::findAll('posts', ' ORDER BY date DESC LIMIT :start,:end ',
                    [ ':start' => $start, ':end' => $number  ]);
                return $result;
            case 'tags':
                $tagId = $filterValue;
                $tag = R::findOne('tags', 'id= ?', [ $tagId]);
                if ($tag == null) {
                    throw new InvalidIdException('Tag does not exist');
                }
                $result = $tag->with( ' ORDER BY date DESC LIMIT :start,:end ',
                    [ ':start' => $start, ':end' => $number  ])->sharedPosts;
                return $result;
            case 'date':
                $result = R::find('posts', 'MONTH(`date`) = :month AND YEAR(`date`) = :year ORDER BY date DESC LIMIT :start,:end ',
                    [
                        ':start' => $start,
                        ':end' => $number ,
                        ':month' => Helper::MonthStringToNumber($filterValue['month']) ,
                        ':year' => $filterValue['year']
                    ]);
                return $result;
            case 'search':
                $tags = R::find('tags', 'name LIKE ?', [ '%'.$filterValue.'%' ]);
                if ($tags == null) {
                    return null;
                }
                else {
                    $results = array();
                    foreach ($tags as $tag) {
                        $result = $tag->with(' ORDER BY date DESC ')->sharedPosts;
                        $results = array_merge($results,$result);
                    }
                    $returned = array_slice( $results, $start, $number);
                    return $returned;
                }
            default :
                throw new InvalidIdException("Unknown filter");
        }

    }

    public function NumPosts($filter = null, $filterValue = null){
        switch($filter) {
            case null:
                return R::count( 'posts' );
            case 'tags':
                $tagId = $filterValue;
                $tag = R::findOne('tags', 'id= ?', [$tagId]);
                if ($tag == null) {
                    throw new InvalidIdException('Tag does not exist');
                }
                $result = $tag->countShared('posts');
                return $result;
            case 'date':
                $result = R::count('posts', 'MONTH(`date`) = :month AND YEAR(`date`) = :year',
                    [
                        ':month' => Helper::MonthStringToNumber($filterValue['month']) ,
                        ':year' => $filterValue['year']
                    ]);
                return $result;
            case 'search':
                $tags = R::find('tags', 'name LIKE ?', [ '%'.$filterValue.'%' ]);
                if ($tags
                    == null) {
                    return 0;
                }
                else {
                    $results = 0;
                    foreach ($tags as $tag) {
                        $results = $results + $tag->countShared('posts');
                    }
                    return $results;
                }

        }
    }

    public function GetPost($id){
        $post = R::findOne('posts', 'id = ?', [$id]);
        if ($post === null) {
            throw new InvalidIdException("This page does not exist");
        }
        $post->visits = $post->visits +1;
        foreach ($post->sharedTags as $tag) {
            $tag->visits = $tag->visits +1;
        }
        R::store($post);
        return $post;
    }

    public function GetMonths($filter = null, $data = null){

        if ($filter == null) {
           return R::getAll( 'SELECT distinct monthname(date) as month, year(date) as year FROM posts order by year(date) desc');
        }

    }

    public function GetTags() {
        $result = R::findAll('tags', ' ORDER BY name' );
        return $result;
    }

    public function NewPost($title, $text, $tags){
        $post = R::dispense('posts');
        $post->title = $title;
        $post->text = $text;
        $post->date = new DateTime("NOW");
        $post->visits = 0;

        $post->users_id = $_SESSION['userId'];

        $this->AddTagsToPost($post,$tags);

        R::store($post);
        return $post->id;
    }

    public function NewComment($post, $text, $name = null, $email = null){

        $comment = R::dispense('comments');
        $comment->text = $text;
        $comment->date = new DateTime('NOW');

        if(isset($_SESSION['userId'])){
            $comment->users_id = $_SESSION['userId'];
        }
        else {
            $comment->name = $name;
            $comment->email = $email;
        }

        $post->ownCommentsList[] = $comment;
        R::store($post);
    }

    public function AddTagsToPost($post, $tags) {
        if ($tags !== null) {
            $tags = explode(',', $tags);

            $post->sharedTagsList = array();
            foreach ($tags as $key =>$tagname) {
                $tags[$key] = trim(mb_strtolower($tagname));
            }
            $tags = array_unique($tags);
            foreach ($tags as $tagname) {

                $tag = R::findOne('tags', 'name = ?', [$tagname ] );
                if ($tag === null) {
                    $tag = R::dispense('tags');
                    $tag->name = $tagname;
                    $tag->visits = 0;
                }

                $post->sharedTagsList[] = $tag;
            }
        }

        R::store($post);
    }
}