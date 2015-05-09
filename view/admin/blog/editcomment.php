<div class="col-md-12">
    <div class="col-md-12">
        <?php if (isset($error)) {?>
            <div class="alert alert-danger" role="alert"><?=$error?></div>
        <?php  }?>
    </div>

    <form name="newpost" method="post">
        <h2 class=" text-center"><?=$title?></h2>

        <div class="form-group col-md-2">
            <?php
            $default =  'http://showdown.gg/wp-content/uploads/2014/05/default-user-300x300.png'; //SITE_ROOT_URL.'img/default-user.png';
            $size = 128;
            $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;?>
            <img class="media-object" src="<?=$grav_url?>" style="width: 128px; height: 128px; margin-top: 40px;">
        </div>
        <div class="form-group col-md-10">
            <label for="text"><h3><?=$user?> said:</h3></label>
            <textarea name="text" type="text" id="text" class="form-control" cols="30" rows="10" required><?=$text?></textarea>
        </div>

        <div class="form-group col-md-12 text-center">
            <button class="btn btn-lg btn-primary text-center"  type="submit">Edit</button>
        </div>
    </form>
</div>







