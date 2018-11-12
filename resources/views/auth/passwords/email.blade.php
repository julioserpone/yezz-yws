@extends('layouts.auth')

@section('htmlheader_title')
    Password recovery
@endsection

@section('content')

<body class="login-page">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>{{ trans('auth.reset_password') }}</b></a>
        </div><!-- /.login-logo -->

        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('auth.email_password_form') }}</p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email" class="control-label">{{ trans('auth.email_address') }}</label>

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('auth.send_link_reset_password') }}
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
