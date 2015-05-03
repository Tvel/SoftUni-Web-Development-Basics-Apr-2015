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
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <li><a href="http://getbootstrap.com/examples/blog/#">March 2014</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">February 2014</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">January 2014</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">December 2013</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">November 2013</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">October 2013</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">September 2013</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">August 2013</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">July 2013</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">June 2013</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">May 2013</a></li>
            <li><a href="http://getbootstrap.com/examples/blog/#">April 2013</a></li>
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
