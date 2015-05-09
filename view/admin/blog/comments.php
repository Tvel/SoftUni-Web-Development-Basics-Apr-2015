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
            <th>PostId</th>
            <th>UserId</th>
            <th>Id</th>
            <th>Text</th>
            <th>User</th>
            <th>Email</th>
            <th>Post</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

</div>
<script>
    var comments=<?=$comments?>;

    $(document).ready(function(){
        var usrTable = $('#list').dataTable({
            "data": comments,
            responsive: true,
            "processing": true,
            "deferRender": true,
            "order": [[ 7, "desc" ]],
            columns: [
                { "data": "posts_id",className: "never"},
                { "data": "users_id", className: "never"},
                { "data": "id", className: "never"},
                { "data": "text", className: "none"},
                { "data": "user", className: "all",
                    render: function ( data, type, row, meta) {
                        if (row['users_id'] != null) {
                            return ('<a href="<?=SITE_ROOT_URL?>user/profile/'+row['users_id']+'">'+data+'</a>');
                        }
                        return data;
                    }
                },
                { "data": "email", className: "all"},
                { "data": "post", className: "all",
                    render: function ( data, type, row, meta) {
                        if (row['posts_id'] != null) {
                            return ('<a href="<?=SITE_ROOT_URL?>blog/post/' + row['posts_id'] + '">' + data + '</a>');
                        }
                        return data;
                    }
                },
                { "data": "date", className: "all"},

                { "data": "id", className: "all",
                    render: function ( data, type, full, meta ) {
                        return ('<a class="btn btn-warning btn-sm" href="<?=SITE_ROOT_URL?>admin/blog/editcomment/'+data+'">Edit</a>');
                    }
                },
                { "data": "id", className: "all",
                    render: function ( data, type, full, meta ) {
                        return ('<a class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\');" href="<?=SITE_ROOT_URL?>admin/blog/deletecomment/'+data+'">Delete</a>');
                    }
                },
            ],
            "columnDefs": [
                { "visible": false,  "targets": [ 0 , 1, 2 ] }
            ]

        })
    });

</script>

<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.min.js"></script>