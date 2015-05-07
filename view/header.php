<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TosilV blog project for SoftUni</title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?=SITE_ROOT_URL?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=SITE_ROOT_URL?>css/blog.css" rel="stylesheet">
    <link href="<?=SITE_ROOT_URL?>css/bootstrap-tagsinput.css" rel="stylesheet">

</head>
<body>

    <div class="blog-masthead">
        <div class="container">
            <nav class="blog-nav">
                <a class="blog-nav-item <?php if (Page_Check::Home()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>blog/index/">Home</a>
                <?php if (Auth_Check::Poster()) { ?>
                <a class="blog-nav-item  <?php if (Page_Check::NewPost()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>blog/newpost">New post</a>
                <?php } ?>

                <?php if (Auth_Check::Regular() ){ ?>
                    <a class="blog-nav-item pull-right" href="<?=SITE_ROOT_URL?>user/logout">Logout</a>
                    <a class="blog-nav-item pull-right <?php if (Page_Check::Login()) echo 'active'; ?>">Hello, <?=$_SESSION['userUsername']?></a>
                <?php } else { ?>
                <a class="blog-nav-item pull-right <?php if (Page_Check::Login()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>user/login">Login</a>
                    <a class="blog-nav-item pull-right <?php if (Page_Check::Register()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>user/register">Register</a>
                <?php } ?>
            </nav>
        </div>
    </div>

    <div class="container">

        <div class="blog-header">
            <h1 class="blog-title">TosilV SoftUni exam blog</h1>
            <p class="lead blog-description">TosilV SoftUni exam blog</p>
    </div>

        <div class="row">




