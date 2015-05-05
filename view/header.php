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

</head>
<body>

    <div class="blog-masthead">
        <div class="container">
            <nav class="blog-nav">
                <a class="blog-nav-item active" href="<?=SITE_ROOT_URL?>master/index/">Home</a>
                <?php if (isset($_SESSION['userId'] ) ){ ?>
                <a class="blog-nav-item" href="<?=SITE_ROOT_URL?>master/newpost">New post</a>
                <?php } ?>

                <?php if (isset($_SESSION['userId'] ) ){ ?>
                    <a class="blog-nav-item pull-right" href="<?=SITE_ROOT_URL?>user/logout">Logout</a>
                    <a class="blog-nav-item pull-right">Hello, <?=$_SESSION['userUsername']?></a>
                <?php } else { ?>
                <a class="blog-nav-item pull-right" href="<?=SITE_ROOT_URL?>user/login">Login</a>
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




