@extends('adminlte::page')

@section('content')
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">Talks</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="TeamTable" class="table table-bordered table-striped dataTable">
            <thead>
                <tr>
                    <th>Title</th>
                </tr>
            </thead>

            <tbody>

                @foreach($Talks as $Talk)
                <tr>
                    <td><a href="/talks/{{$Talk->id}}/edit">{{$Talk->title}}</a></td>
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