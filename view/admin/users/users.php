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
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

</div>
<script>
    var users=<?=$users?>;

    $(document).ready(function(){
        var usrTable = $('#list').dataTable({
            "data": users,
            "processing": true,
            "deferRender": true,
            "order": [[ 1, "asc" ]],
            columns: [
                { "data": "id"},
                { "data": "username",
                    render: function ( data, type, row, meta) {
                        return ('<a href="<?=SITE_ROOT_URL?>user/profile/'+row['id']+'">'+data+'</a>');
                    }
                },
                { "data": "email"},
                { "data": "role"},
                { "data": "id",
                    render: function ( data, type, full, meta ) {
                        return ('<a class="btn btn-warning btn-sm" href="<?=SITE_ROOT_URL?>admin/users/edituser/'+data+'">Edit</a>');
                    }
                },
                { "data": "id",
                    render: function ( data, type, full, meta ) {
                        return ('<a class="btn btn-danger btn-sm" href="<?=SITE_ROOT_URL?>admin/blog/deleteuser/'+data+'">Delete</a>');
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