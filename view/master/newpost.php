<div class="col-md-12">
    <div class="col-md-12">
        <?php if (isset($error)) {?>
            <div class="alert alert-danger" role="alert"><?=$error?></div>
        <?php  }?>
    </div>

    <form name="newpost" method="post">
        <h2 class=" text-center"><?=$title?></h2>

        <div class="form-group">
            <label for="title" >Title</label>
            <input name="title" type="text" id="title" class="form-control" placeholder="Title" value="<?=$postTitle?>" required autofocus>
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea name="text" type="text" id="text" class="form-control ckeditor" required><?=$text?></textarea>
        </div>

        <div class="form-group">
            <label for="tags" >Tags  <span>(separate by commas)</span></label>
            <div style="width: 100% !important">
                <input name="tags"
                       type="text"
                       id="tags"
                       class="form-control"
                       placeholder="tag"
                       data-role="tagsinput"
                       value="<?=$tags?>" >
            </div>

        </div>

        <div class="form-group">
        <button class="btn btn-lg btn-primary text-center"  type="submit">Post</button>
        </div>
    </form>


</div>

<script src="<?=SITE_ROOT_URL?>js/ckeditor/ckeditor.js" ></script>







