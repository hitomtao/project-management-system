@extends('layouts.admin')

@section('main-title','Project Status')

@section('content')

        <div class="row">

            <div class="col-md-12">
                <div class="pull-right">
                    <span><a class="btn btn-primary btn-raised pull-right"
                             href="{{ route('setup.project-status.create') }}">Create</a></span>
                </div>


                <hr/>
                <div class="clearfix"></div>

                <table class="table table-bordered" id="project-status-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Destroy</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

@endsection

@push('scripts')
<script>
    $(function () {
        $('#project-status-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('setup.project-status.datatables.data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},

                {
                    data: 'view',
                    name: 'view',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<a href="/setup/project-status/' + object.id + '">view</a>';
                    }
                },
                {
                    data: 'edit',
                    name: 'edit',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<a href="/setup/project-status/' + object.id + '/edit">Edit</a>';
                    }
                },
                {
                    data: 'destroy',
                    name: 'destroy',
                    sortable: false,
                    render: function (data, type, object, meta) {
                        return '<form id="project-status-destroy-' + object.id + '" method="post"  action="/setup/project-status/' + object.id + '" ><input type="hidden" name="_method" value="DELETE"/><input type="hidden" name="_token" value="{{ csrf_token() }}"/> </form> <a onclick="event.preventDefault();jQuery(\'#project-status-destroy-' + object.id + '\').submit()"  href="/setup/project-status/' + object.id + '">Destroy</a>';
                    }
                }
            ]
        });
    });
</script>
@endpush