<div class="col-md-12" style="margin-bottom: 20px;">
    <h1></h1>
    <?php
    $default =  'http://showdown.gg/wp-content/uploads/2014/05/default-user-300x300.png'; //SITE_ROOT_URL.'img/default-user.png';
    $size = 256;
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    ?>

    <div class="media">
        <div class="media-left">
            <a href="#">
                <img class="media-object" src="<?=$grav_url?>" style="width: 256px; height: 256px;">
            </a>
        </div>
        <div class="media-body">
                <h1 class="media-heading">Profile of <?=$user->username?></h1>
                <h2 class="media-heading">Role: <?=$user->role->name?></h2>
                <h2 class="media-heading">About:</h2>
                <div style="font-size: 130%"><?=$user->about?></div>

        </div>
    </div>
</div>

<div class="col-md-6" >
    <h2>5 most popular posts</h2>
    <?php foreach ($posts as $post) { ?>
        <div class="media">
            <div class="media-body">
                <h4 class="media-heading"><a href="<?=SITE_ROOT_URL?>blog/post/<?=$post->id?>"><?=$post->title?></a> - comments: <?=$post->countOwn('comments')?></h4>

            </div>
        </div>
    <?php } ?>
</div>
<div class="col-md-6">
    <h2>Last 5 comments</h2>
    <?php foreach ($comments as $comment) { ?>
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="<?=$grav_url?>" style="width: 64px; height: 64px;">
                </a>
            </div>
            <div class="media-body">
                    <h4 class="media-heading"><?=$user->username?> - <a href="<?=SITE_ROOT_URL?>blog/post/<?=$comment->posts_id?>">Go to post</a></h4>
                <?=$comment->text?>
            </div>
        </div>
    <?php } ?>
</div>
<div class="col-md-12" style="margin-bottom: 20px;"></div>