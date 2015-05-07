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

    <div class="col-md-12">
        <div class="col-md-6">
            <?php if ($prev_page !== null) : ?>
                <?php if (Page_Check::Home()) : ?>
                    <a class="pull-right" href="<?=SITE_ROOT_URL?>blog/index/<?=$prev_page?>"><- Newer posts</a>
                <?php endif; ?>
                <?php if (Page_Check::TagPosts()) : ?>
                    <a class="pull-right" href="<?=SITE_ROOT_URL?>blog/tag/<?=$tag_id?>/<?=$prev_page?>"><- Newer posts</a>
                <?php endif; ?>
                <?php if (Page_Check::DatePosts()) : ?>
                    <a class="pull-right" href="<?=SITE_ROOT_URL?>blog/date/<?=$year?>/<?=$month?>/<?=$prev_page?>"><- Newer posts</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <?php if ($next_page !== null) : ?>
                <?php if (Page_Check::Home()) : ?>
                    <a class="pull-left" href="<?=SITE_ROOT_URL?>blog/index/<?=$next_page?>">Older posts -></a>
                <?php endif; ?>
                <?php if (Page_Check::TagPosts()) : ?>
                    <a class="pull-left" href="<?=SITE_ROOT_URL?>blog/tag/<?=$tag_id?>/<?=$next_page?>">Older posts -></a>
                <?php endif; ?>
                <?php if (Page_Check::DatePosts()) : ?>
                    <a class="pull-left" href="<?=SITE_ROOT_URL?>blog/date/<?=$year?>/<?=$month?>/<?=$next_page?>">Older posts -></a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div><!-- /.blog-main -->

<?php include_once(SITE_ROOT_DIR . 'view/master/sidebar.php'); ?>