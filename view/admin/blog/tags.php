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
            <th>Name</th>
            <th>Post Count</th>
            <th>Visits</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

</div>
<script>
    var tags=<?=$tags?>;

    $(document).ready(function(){
        var usrTable = $('#list').dataTable({
            "data": tags,
            "processing": true,
            "deferRender": true,
            "order": [[ 3, "desc" ]],
            columns: [
                { "data": "id"},
                { "data": "name",
                    render: function ( data, type, row, meta) {
                        return ('<a href="<?=SITE_ROOT_URL?>blog/tag/'+row['id']+'">'+data+'</a>');
                    }
                },
                { "data": "count"},
                { "data": "visits"},
                { "data": "id",
                    render: function ( data, type, full, meta ) {
                        return ('<a class="btn btn-warning btn-sm" href="<?=SITE_ROOT_URL?>admin/blog/edittag/'+data+'">Edit</a>');
                    }
                },
                { "data": "id",
                    render: function ( data, type, full, meta ) {
                        var text = "Are you sure?";
                        return ('<a class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\');" href="<?=SITE_ROOT_URL?>admin/blog/deletetag/'+data+'">Delete</a>');
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