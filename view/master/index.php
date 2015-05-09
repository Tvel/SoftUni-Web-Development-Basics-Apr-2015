<div class="col-sm-8 blog-main">
    <?php
    if ($posts !== null) foreach ($posts as $post) {
    ?>
    <div class="blog-post">
        <h2 class="blog-post-title">
            <a href="<?=SITE_ROOT_URL?>blog/post/<?=$post->id?>"><?=$post->title?></a>
            <?php  if(Auth_Check::CheckIfCanEditPost($post)) : ?>
                <a class="btn btn-warning btn-xs" href="<?=SITE_ROOT_URL?>blog/editpost/<?=$post->id?>">Edit</a>
            <?php endif; ?>
        </h2>
        <?php if ($post->users === null) : ?>
            <p class="blog-post-info"><?=$post->date?> by Anonymous - Vistis: <?=$post->visits?></p>
        <?php else : ?>
            <p class="blog-post-info"><?=$post->date?> by <a href="<?=SITE_ROOT_URL?>user/profile/<?=$post->users->id?>"><?=$post->users->username?></a> - Vistis: <?=$post->visits?></p>
        <?php endif; ?>


        <p class="blog-post-tags">Tags:
            <?php foreach( $post->sharedTags as $tag ) {
                echo '<a class="blog-post-tag" href="'.SITE_ROOT_URL.'blog/tag/'.$tag->id.'">'.$tag->name.'</a> ';
            } ?>
            <?php // implode(',', array_map(create_function('$o', 'return $o->name;'), $post->sharedTags))?>
        </p>

        <p><?=mb_substr(Helper::SanatizeString($post->text),0,200)?><a href="<?=SITE_ROOT_URL?>blog/post/<?=$post->id?>">... Read more</a></p>


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
                <?php if (Page_Check::Search()) : ?>
                    <a class="pull-right" href="<?=SITE_ROOT_URL?>blog/search/<?=$prev_page?>?filter=<?=$filter?>"><- Newer posts</a>
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
                <?php if (Page_Check::Search()) : ?>
                    <a class="pull-left" href="<?=SITE_ROOT_URL?>blog/search/<?=$next_page?>?filter=<?=$filter?>">Older posts -></a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div><!-- /.blog-main -->

<?php include_once(SITE_ROOT_DIR . 'view/master/sidebar.php'); ?>