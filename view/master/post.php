

<div class="col-sm-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title"><?=$post->title?></h2>
            <p class="blog-post-meta"><?=$post->date?> by <a href="<?=SITE_ROOT_URL?>users/profile/<?=$post->users->id?>"><?=$post->users->username?></a></p>

            <p class="blog-post-meta">Tags:
                <?= implode(',', array_map(create_function('$o', 'return $o->name;'), $post->sharedTags))?>
            </p>

            <?=$post->text?>

        </div><!-- /.blog-post -->
        <div class="blog-post">
            <h4 class="blog-post-title">Comments:</h4>

            <?php foreach ($post->ownComments as $comment) {
                if($comment->users_id === null) { ?>
                    <p class="blog-post-meta"> <?=$comment->name?></p>
                <?php } else { ?>
                    <p class="blog-post-meta"> <a href="<?=SITE_ROOT_URL?>users/profile/<?=$comment->users->id?>"><?=$comment->users->username?></a></p>
                <?php } ?>
                <p><?=$comment->text?></p>
            <?php } ?>


        </div>

        <div class="blog-post">
            <form method="post" >
                <?php if (!isset($_SESSION['userId'])) : ?>
                <label for="comment_name">Name</label>
                <input name="comment_name" id="comment_name" type="text" required />
                <label for="comment_email">Email</label>
                <input name="comment_email" id="comment_email" type="email" required />
                <?php endif;?>
                <textarea name="comment_text" id="comment_text" cols="30" rows="10"></textarea>
                <button type="submit">Send</button>
            </form>
        </div>


</div><!-- /.blog-main -->



<?php include_once(SITE_ROOT_DIR . 'view/master/sidebar.php'); ?>