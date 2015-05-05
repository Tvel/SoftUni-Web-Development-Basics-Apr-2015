<div class="col-sm-8 blog-main">
    <?php
    foreach ($posts as $post) {
    ?>
    <div class="blog-post">
        <h2 class="blog-post-title"><?=$post->title?></h2>
        <p class="blog-post-meta"><?=$post->date?> by <a href="<?=SITE_ROOT_URL?>users/profile/<?=$post->users->id?>"><?=$post->users->username?></a></p>

        <p class="blog-post-meta">Tags:
            <?= implode(',', array_map(create_function('$o', 'return $o->name;'), $post->sharedTags))?>
        </p>

        <?=$post->text?>

        <p class="blog-post-meta"> <a href="<?=SITE_ROOT_URL?>blog/post/<?=$post->id?>">
                Comments :
            <?=  sizeof( $post->ownComments) ?> </a>

        </p>
    </div><!-- /.blog-post -->
    <?php
    }
    ?>

</div><!-- /.blog-main -->

<?php include_once(SITE_ROOT_DIR . 'view/master/sidebar.php'); ?>