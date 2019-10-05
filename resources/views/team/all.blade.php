@extends('adminlte::page')

@section('content')
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Team Members</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="TeamTable" class="table table-bordered table-striped dataTable">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Role</th>
                </tr>
            </thead>

            <tbody>

                @foreach($Users as $User)
                <tr>
                    <td>{{$User->first_name}} {{$User->last_name}}</td>
                    <td></td>
                </tr>

                @endforeach
            </tbody>

        </table>
    </div>
    <!-- /.box-body -->
</div>

@stop

@section('js')
<script>

    $(function () {

        $('#TeamTable').DataTable();

    });

</script>
@stop