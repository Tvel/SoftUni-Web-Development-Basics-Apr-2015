<div class="col-sm-8 blog-main">
    <?php
    foreach ($posts as $post) {
    ?>
    <div class="blog-post">
        <h2 class="blog-post-title"><?=$post->title?></h2>
        <p class="blog-post-meta"><?=$post->date?> by <a href="<?=SITE_ROOT_URL?>users/profile/<?=$post->users->id?>"><?=$post->users->username?></a></p>

        <?=$post->text?>
    </div><!-- /.blog-post -->
    <?php
    }
    ?>

</div><!-- /.blog-main -->
<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>TosilV SoftUni exam blog</p>
    </div>
    <div class="sidebar-module">
        <h4>Tags</h4>
        <ol class="list-unstyled">
            <?php
            foreach ($months as $month) {
                ?>
                <li><a href="<?=SITE_ROOT_URL?>master/date/<?=$month['year']?>/<?=$month['month']?>"><?=$month['month']?> <?=$month['year']?></a></li>
            <?php
            }
            ?>
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <?php
            foreach ($months as $month) {
            ?>
            <li><a href="<?=SITE_ROOT_URL?>master/date/<?=$month['year']?>/<?=$month['month']?>"><?=$month['month']?> <?=$month['year']?></a></li>
            <?php
            }
            ?>
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="https://github.com/Tvel/">GitHub</a></li>
            <li><a href="https://twitter.com/tosilv">Twitter</a></li>
            <li><a href="https://www.facebook.com/tosilv">Facebook</a></li>
        </ol>
    </div>
</div><!-- /.blog-sidebar -->
