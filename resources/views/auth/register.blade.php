@extends('layouts.auth')

@section('htmlheader_title')
    {{ trans('auth.new_membership') }}
@endsection

@section('cssCustoms')
    <link href = "{{ asset('/plugins/iCheck/all.css') }}" rel = "stylesheet" type="text/css" />
@endsection

@section('content')

<body class="hold-transition register-page background-yezz">
    <div class="register-box-customer">
        <div class="register-box-logo">
            <div class="logo-yezz"></div>
        </div><!-- /.login-logo -->

        <div class="register-box-body">
            <p class="login-box-msg">{{ trans('auth.new_membership') }}</p>
            <div class="container">
                {!! Form::model(Request::all(),['route'=>['register.new.customer'], 'method'=>'POST', 'name'=>'registerFrm', 'id'=> 'registerFrm', 'role'=>'form', 'files' => true]) !!}
                    <section>
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active" data="step1">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="{{ trans('auth.register.user') }}">
                                        <span class="round-tab">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled" data="step2">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="{{ trans('auth.register.client') }}">
                                        <span class="round-tab">
                                            <i class="fa fa-user-o" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </li>
                                {{-- <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                        <span class="round-tab">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </li> --}}

                                <li role="presentation" class="disabled" data="step3">
                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="{{ trans('auth.register.complete') }}">
                                        <span class="round-tab">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form role="form">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">

                                    @include('auth.partials.user')

                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default next-step">{{ trans('globals.next') }}</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    
                                    @include('auth.partials.client')

                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">{{ trans('globals.back') }}</button></li>
                                        <li><button type="button" class="btn btn-default next-step">{{ trans('globals.next') }}</button></li>
                                    </ul>
                                </div>
                                {{-- <div class="tab-pane" role="tabpanel" id="step3">
                                    <h3>Step 3</h3>
                                    <p>This is step 3</p>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">{{ trans('globals.back') }}</button></li>
                                        <li><button type="button" class="btn btn-default next-step">{{ trans('globals.next') }}</button></li>
                                    </ul>
                                </div> --}}
                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <h3>{{ trans('auth.register.complete') }}</h3>
                                    <p>{{ trans('auth.register.complete_msg') }}</p>
                                    {!! Recaptcha::render() !!}
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary btn-info-full next-step" onclick="$('#registerFrm').submit();">{{ trans('globals.save') }}</button></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </section>
                {!! Form::token() !!}
                {!! Form::close() !!}
            </div>

            <a href="{{ url('/login') }}" class="text-center">{{ trans('auth.already_membership') }}</a>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->

@include('layouts.partials.scripts_auth')
    
    <script src = "{{ asset('/akkargroup-bower/bootstrap-show-password/bootstrap-show-password.min.js') }}" type = "text/javascript"></script>
    <script src = "{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type = "text/javascript"></script>
    <script src = "{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type = "text/javascript"></script>
    <script src = "{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type = "text/javascript"></script>
    <script src = "{{ asset('/plugins/select2/select2.full.min.js') }}" type = "text/javascript"></script>

@include('layouts.partials.message')

@include('auth.partials.register_script')

@endsection
</body>
