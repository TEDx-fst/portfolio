@extends('adminlte::page')

@section('content')

<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Add Talk</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{route('talks.store')}}" method="post" enctype="multipart/form-data">

        @csrf  
        <div class="box-body">

            <div class="form-group has-feedback {{ $errors->has('title') ? 'has-error' : '' }}">
                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                       placeholder="Talk Title">
                <span class="glyphicon glyphicon-paste form-control-feedback"></span>
                @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('url') ? 'has-error' : '' }}">
                <input type="text" name="url" class="form-control" value="{{ old('url') }}"
                       placeholder="Talk Link">
                <span class="glyphicon glyphicon-link form-control-feedback"></span>
                @if ($errors->has('url'))
                <span class="help-block">
                    <strong>{{ $errors->first('url') }}</strong>
                </span>
                @endif
            </div>


            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    save
                </button>
            </div>
    </form>
</div>

@stop