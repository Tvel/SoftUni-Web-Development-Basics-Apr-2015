<div class="col-md-4 col-md-offset-4">
<form class="form-signin" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="username" class="sr-only">Username</label>
    <input name="username" type="text" id="username" class="form-control" placeholder="Username" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" style="margin-top:10px" type="submit">Sign in</button>
</form>
</div>
<div class="col-md-12" style="margin-top:20px">
    <?php if (isset($error)) {?>
        <div class="alert alert-danger" role="alert"><?=$error?></div>
    <?php  }?>
</div>