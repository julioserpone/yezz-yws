@extends('layouts.auth')

@section('htmlheader_title')
    {{ trans('auth.reset_password') }}
@endsection

@section('content')

<body class="login-page">
    <!-- @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif -->
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>{{ trans('auth.reset_password') }}</b></a>
        </div><!-- /.login-logo -->

        <div class="login-box-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email" class="control-label">{{ trans('auth.email_address') }}</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="password" class="control-label">{{ trans('auth.password') }}</label>
                        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="password-confirm" class="control-label">{{ trans('auth.password_confirmation') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('auth.process_reset_password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

@endsection

@include('layouts.partials.scripts_auth')

@include('layouts.partials.message')
