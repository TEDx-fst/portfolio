@extends('adminlte::page')

@section('content')
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Speakers</h3>
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

                @foreach($Speakers as $Speaker)
                <tr>
                    <td><a href="/speakers/{{$Speaker->id}}/edit">{{$Speaker->name}}</a></td>
                    <td>
                        <img src="/storage/{{$Speaker->image}}" class="img-thumbnail" style="width:15%"></td>
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