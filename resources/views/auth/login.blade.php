@extends('layouts.auth')

@section('htmlheader_title')
    {{ trans('auth.log_in') }}
@endsection

@section('content')
<body class="hold-transition login-page background-yezz">
    <div class="login-box">
        <div class="login-logo">
            <div class="logo-yezz"></div>
        </div><!-- /.login-logo -->

        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('auth.start_your_session') }}</p>
            <form action="{{ route('login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{ trans('auth.remember_me') }}
                            </label>
                        </div>
                        <a href="{{ url('/password/reset') }}">{{ trans('auth.forgot_pass') }}</a><br><br>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-grey btn-block btn-flat text-amazing">{{ trans('auth.sign_in') }}</button>
                    </div><!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-black btn-block btn-flat" href="{{ route('register') }}">{{ trans('auth.new_membership') }}</a>
                    </div>
                </div>
                
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </form>

            <hr>

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    @include('layouts.partials.scripts_auth')

    @include('layouts.partials.message')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
