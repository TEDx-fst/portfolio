@extends('adminlte::page')

@section('content')

<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Member</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{route('team.store')}}" method="post" enctype="multipart/form-data">

        @csrf  
        <div class="box-body">

            <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}"
                       placeholder="{{ trans('adminlte::adminlte.first_name') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('first_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"
                       placeholder="{{ trans('adminlte::adminlte.last_name') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                       placeholder="{{ trans('adminlte::adminlte.email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" class="form-control" name="role">
                    @foreach($Roles as $Role)
                    <option value="{{$Role->id}}">{{$Role->slug}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="userImage">Image</label>
                <input type="file" id="userImage" name="image">

                <div style="width:20%">
                    <img id="image" src="{{ $user->image }}">
                </div>
            </div>

            <div class="form-group has-feedback">
                <div class="row">
                    @foreach($SocialMediaData as $SocialMedia)
                    @php
                    $selected = '';
                    $TextBox = '';
                    @endphp

                    @foreach($UserSocial as $UserSocialMedia)

                    @if($UserSocialMedia->social_id == $SocialMedia->id)
                    @php
                    $selected = ' checked';
                    $TextBox ="<input name='SocilUrl[]' value='$UserSocialMedia->url' class='form-control $SocialMedia->social_media' type='text'>";
                    @endphp
                    @endif
                    @endforeach

                    <div class="col-md-3">
                        <label for="{{$SocialMedia->social_media}}">{{$SocialMedia->social_media}}</label>
                        <input name="social[]" {{$selected}} data-social-type="{{$SocialMedia->social_media}}" class="social" id="{{$SocialMedia->social_media}}" type="checkbox" value="{{$SocialMedia->id}}">
                        <div class="{{$SocialMedia->social_media}}">
                            {!!$TextBox!!}
                        </div>
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