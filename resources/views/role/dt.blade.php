@extends('app')

@section('plugins_css')
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="box-title">List: Role</h4>
                @if(Entrust::can('role_create'))
                <div class="box-tools pull-right">
                    <a class="btn btn-primary" href="{{ url('roles/create') }}"><i class="fa fa-plus"></i> New</a>
                </div>
                @endif
            </div>
            <div class="box-body">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="width:40px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('plugins_js')
<script type="text/javascript" src="{{ asset('themes/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection

@section('contentjs')
<script type="text/javascript">
$(function() {
    // init before plugins

    // init plugins
    var oTable = $('#datatable').DataTable({
        processing      : true,
        serverSide      : true,
        ajax            : '{{ url('roles/dt') }}',
        columns         : [
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        pageLength      : 50,
        order           : [],
        searchDelay     : 1500,
        drawCallback    : function(settings) {
            $('a[data-toggle="tooltip"]', this.api().table().container()).tooltip({ container : 'body' });
        }
    });
    // init data

    // event
    $('body').on('click', '.row-delete', function() {
        if(confirm('Attempting to delete data, are you sure?')) {
            location.href = $(this).attr('data-url');
        }
    });
});
</script>
@endsection
