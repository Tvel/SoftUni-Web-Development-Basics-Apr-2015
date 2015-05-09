
<div class="col-sm-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title">
                <?=$post->title?>
                <?php  if(Auth_Check::CheckIfCanEditPost($post)) : ?>
                    <a class="btn btn-warning btn-xs" href="<?=SITE_ROOT_URL?>blog/editpost/<?=$post->id?>">Edit</a>
                <?php endif; ?>
            </h2>
            <?php if ($post->users === null) : ?>
                <p class="blog-post-info"><?=$post->date?> by Anonymous</p>
            <?php else : ?>
                <p class="blog-post-info"><?=$post->date?> by <a href="<?=SITE_ROOT_URL?>user/profile/<?=$post->users->id?>"><?=$post->users->username?></a></p>
            <?php endif; ?>

            <p class="blog-post-tags">Tags:
                <?php foreach( $post->sharedTags as $tag ) {
                    echo '<a class="blog-post-tag" href="'.SITE_ROOT_URL.'blog/tag/'.$tag->id.'">'.$tag->name.'</a> ';
                } ?>
                <?php // implode(',', array_map(create_function('$o', 'return $o->name;'), $post->sharedTags)) ?>
            </p>
            <?=$post->text?>
        </div><!-- /.blog-post -->

        <div class="blog-post">
            <h3>Comments:</h3>
            <?php foreach ($post->with("ORDER BY date")->ownComments as $comment) {
                $email = '';
                if($comment->users_id === null) {
                    $email = $comment->email;
                }
                else {
                    $email = $comment->users->email;
                }
                $default =  'http://showdown.gg/wp-content/uploads/2014/05/default-user-300x300.png'; //SITE_ROOT_URL.'img/default-user.png';
                $size = 64;
                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                ?>
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="<?=$grav_url?>" style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <?php  if($comment->users_id === null) { ?>
                        <h4 class="media-heading"><?=$comment->name?></h4>
                    <?php } else { ?>
                        <h4 class="media-heading"><a href="<?=SITE_ROOT_URL?>users/profile/<?=$comment->users->id?>"><?=$comment->users->username?></a></h4>
                    <?php } ?>
                    <?=$comment->text?>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="blog-post col-md-10 col-md-offset-1">
            <form method="post" >
                <?php if (!isset($_SESSION['userId'])) : ?>
                <div class="form-group">
                    <label for="comment_name">Name</label>
                    <input class="form-control" name="comment_name" id="comment_name" type="text" required />
                </div>
                <div class="form-group">
                    <label for="comment_email">Email</label>
                    <input class="form-control" name="comment_email" id="comment_email" type="email" required />
                </div>
                <?php endif;?>
                <div class="form-group">
                    <label for="comment_text">Comment</label>
                    <textarea class="form-control" name="comment_text" id="comment_text" cols="30" rows="10"></textarea>
                </div>
                <button type="submit">Send</button>
            </form>
        </div>


</div><!-- /.blog-main -->



<?php include_once(SITE_ROOT_DIR . 'view/master/sidebar.php'); ?>