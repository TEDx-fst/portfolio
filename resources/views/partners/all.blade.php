@extends('adminlte::page')

@section('content')
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Partners</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="TeamTable" class="table table-bordered table-striped dataTable">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Image</th>
                </tr>
            </thead>

            <tbody>

                @foreach($Partners as $Partner)
                <tr>
                    <td><a href="/partners/{{$Partner->id}}/edit">{{$Partner->name}}</a></td>
                    <td>
                        <img src="/storage/{{$Partner->image}}" class="img-thumbnail" style="width:15%"></td>
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