@extends('adminlte::page')

@section('content')

<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Add Speakers</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{route('speakers.store')}}" method="post" enctype="multipart/form-data">

        @csrf  
        <div class="box-body">

            <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                       placeholder="Speacker Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="userImage">Image</label>
                <input type="file" id="userImage" name="image">
                <div>
                    <img id="image"  style="width: 50%;">
                </div>
            </div>

            <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{old('description')}}</textarea>
                @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
                `
            </div>


            <div class="form-group has-feedback">
                <div class="row">
                    @foreach($SocialMediaData as $SocialMedia)
                    <div class="col-md-3">
                        <label for="{{$SocialMedia->social_media}}">{{$SocialMedia->social_media}}</label>
                        <input name="social[]" data-social-type="{{$SocialMedia->social_media}}" class="social" id="{{$SocialMedia->social_media}}" type="checkbox" value="{{$SocialMedia->id}}">
                        <div class="{{$SocialMedia->social_media}}"></div>
                    </div>
                    @endforeach
                </div>
            </div>


            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ trans('adminlte::adminlte.register') }}
                </button>
            </div>
    </form>
</div>

@stop

@section('js')
<script>

    $(function () {

        var SocialBox = $('.social');
        /*-------------------------------------------------------*/
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $("#userImage").change(function () {
            readURL(this);
        });
        /*-------------------------------------------------------*/

        function AppendSocialUrl()
        {
            var _this = $(this),
                    SocialInputClass = _this.data('social-type'),
                    SocialUrlObject = $('.' + SocialInputClass);

            if (_this.is(':checked')) {

                SocialUrlObject.html('<input name="SocilUrl[]" type="text"' + ' class="form-control ' + SocialInputClass + '">');
            } else {
                SocialUrlObject[1].remove();
            }


        }

        SocialBox.on('change', AppendSocialUrl);
        /*-------------------------------------------------------*/

    });

</script>
@stop