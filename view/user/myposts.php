<div class="col-md-12">
    <h1 class=" text-center"><?=$pageTitle?></h1>
    <?php if (isset($error)) {?>
        <div class="alert alert-danger" role="alert"><?=$error?></div>
    <?php  }?>
    <?php if (isset($success)) {?>
        <div class="alert alert-danger" role="alert"><?=$success?></div>
    <?php  }?>
</div>

<div class="col-md-12">
    <table class="table display table-striped table-hover" id="list">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Date</th>
            <th>Comments</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

</div>
<script>
    var posts=<?=$posts?>;

    $(document).ready(function(){
        var usrTable = $('#list').dataTable({
            "data": posts,
            "processing": true,
            "deferRender": true,
            "order": [[ 2, "desc" ]],
            columns: [
                { "data": "id"},
                { "data": "title",
                    render: function ( data, type, row, meta) {
                        return ('<a href="<?=SITE_ROOT_URL?>blog/post/'+row['id']+'">'+data+'</a>');
                    }
                },
                { "data": "date"},
                { "data": "comments"},
                { "data": "id",
                    render: function ( data, type, full, meta ) {
                        <?php if(Page_Check::AdminPosts()) : ?>
                            return ('<a class="btn btn-warning btn-sm" href="<?=SITE_ROOT_URL?>admin/blog/editpost/'+data+'">Edit</a>');
                        <?php endif; ?>
                        <?php if(Page_Check::MyPosts()) : ?>
                            return ('<a class="btn btn-warning btn-sm" href="<?=SITE_ROOT_URL?>blog/editpost/'+data+'">Edit</a>');
                        <?php endif; ?>
                    }
                },
                { "data": "id",
                    render: function ( data, type, full, meta ) {
                        <?php if(Page_Check::AdminPosts()) : ?>
                            return ('<a class="btn btn-danger btn-sm" href="<?=SITE_ROOT_URL?>admin/blog/deletepost/'+data+'">Delete</a>');
                        <?php endif; ?>
                        <?php if(Page_Check::MyPosts()) : ?>
                            return ('<a class="btn btn-danger btn-sm" href="<?=SITE_ROOT_URL?>blog/deletepost/'+data+'">Delete</a>');
                        <?php endif; ?>
                    }
                },
                ],
            "columnDefs": [
                { "visible": false,  "targets": [ 0 ] }
            ]

        })
    });

</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>