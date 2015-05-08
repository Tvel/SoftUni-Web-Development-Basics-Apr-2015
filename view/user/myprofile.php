<div class="col-md-12">
    <h1 class=" text-center">My Profile</h1>

    <div class="col-md-12">
        <?php if (isset($error)) {?>
            <div class="alert alert-danger" role="alert"><?=$error?></div>
        <?php  }?>
        <?php if (isset($success)) {?>
            <div class="alert alert-success" role="alert"><?=$success?></div>
        <?php  }?>
    </div>

    <div class="col-md-6">
        <form name="edit-profile-info" method="post">
            <h2 class=" text-center">Edit info</h2>

            <div class="form-group">
                <label for="email" >Email</label>
                <input name="email" type="email" id="email" class="form-control" placeholder="Email" value="<?=$email?>" required>
            </div>
            <div class="form-group">
                <label for="text">About Me</label>
                <textarea name="about" type="about" id="text" class="form-control ckeditor"><?=$about?></textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-lg btn-primary text-center"  type="submit">Edit</button>
            </div>
        </form>

    </div>

    <div class="col-md-6">
        <form name="edit-profile-pass" method="post">
            <h2 class=" text-center">Change password</h2>

            <div class="form-group">
                <label for="old-password" >Old Password</label>
                <input name="old-password" type="password" id="old-password" class="form-control" placeholder="old-password" required>
            </div>
            <div class="form-group">
                <label for="new-password" >New Password</label>
                <input name="new-password" type="password" id="new-password" class="form-control" placeholder="new password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password" >Confirm Password</label>
                <input name="confirm-password" type="password" id="confirm-password" class="form-control" placeholder="confirm password" required>
            </div>

            <div class="form-group">
                <button class="btn btn-lg btn-primary text-center"  type="submit">Change</button>
            </div>
        </form>
    </div>


</div>

<script src="<?=SITE_ROOT_URL?>js/ckeditor/ckeditor.js" ></script>