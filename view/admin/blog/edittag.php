<div class="col-md-12">
    <div class="col-md-12">
        <?php if (isset($error)) {?>
            <div class="alert alert-danger" role="alert"><?=$error?></div>
        <?php  }?>
    </div>

    <form name="newpost" method="post">
        <h2 class=" text-center"><?=$title?></h2>
        <div class="form-group ">
            <label for="name">Name:</label>
            <input name="name" type="text" id="name" class="form-control" value="<?=$name?>" required/>
        </div>
        <div class="form-group ">
            <label for="visits">Visits:</label>
            <input name="visits" type="number" id="visits" class="form-control" value="<?=$visits?>" required/>
        </div>

        <div class="form-group text-center">
            <button class="btn btn-lg btn-primary text-center"  type="submit">Edit</button>
        </div>
    </form>
</div>







