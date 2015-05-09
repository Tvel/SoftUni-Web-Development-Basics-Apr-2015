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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css">

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
</head>
<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">

            <?php if (Auth_Check::Moderator()) { ?>
<!--                <a class="blog-nav-item  --><?php //if (Page_Check::AdminStats()) echo 'active'; ?><!--" href="--><?//=SITE_ROOT_URL?><!--admin/blog/stats">Stats</a>-->
                <a class="blog-nav-item  <?php if (Page_Check::AdminComments()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>admin/blog/comments">Edit Comments</a>
            <?php } ?>
            <?php if (Auth_Check::OnlyAdmin()) { ?>
                <a class="blog-nav-item  <?php if (Page_Check::AdminPosts()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>admin/blog/posts">Edit Posts</a>
                <a class="blog-nav-item  <?php if (Page_Check::AdminTags()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>admin/blog/tags">Edit Tags</a>
                <a class="blog-nav-item  <?php if (Page_Check::AdminUsers()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>admin/users/users">Edit Users</a>
            <?php } ?>

            <?php if (Auth_Check::Regular() ){ ?>
                <a class="blog-nav-item pull-right" href="<?=SITE_ROOT_URL?>user/logout">Logout</a>
                <a class="blog-nav-item pull-right <?php if (Page_Check::Home()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>blog/index/">Home</a>
                <a class="blog-nav-item pull-right  <?php if (Page_Check::MyProfile()) echo 'active'; ?>" href="<?=SITE_ROOT_URL?>user/myprofile">Hello, <?=$_SESSION['userUsername']?></a>
            <?php } ?>
        </nav>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="blog-header">
            <h2 class="blog-title">Administration</h2>
            <p class="lead blog-description">TosilV SoftUni exam blog</p>
        </div>
    </div>

    <div class="row">
