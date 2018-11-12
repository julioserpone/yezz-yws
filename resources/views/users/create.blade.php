@extends('layouts.app')

@section('htmlheader_title')
    {{ (isset($profile)) ? trans('globals.profile') : (($edit) ? trans('globals.section_title.users.edit') : trans('globals.section_title.users.add')) }}
@endsection

@section('contentheader_title')
    {{ (isset($profile)) ? trans('globals.profile') : (($edit) ? trans('globals.section_title.users.edit') : trans('globals.section_title.users.add')) }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ (isset($profile)) ? trans('globals.profile') : (($edit) ? trans('globals.section_title.users.edit') : trans('globals.section_title.users.add')) }}</li>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/akkargroup-bower/animate.css/animate.min.css') }}" rel = "stylesheet" type="text/css" />
	<link href = "{{ asset('/plugins/iCheck/all.css') }}" rel = "stylesheet" type="text/css" />
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['user.store'], 'method'=>'POST', 'name'=>'userFrm', 'id'=> 'userFrm', 'role'=>'form', 'files' => true]) !!}
        @else
        	@if(isset($profile))
        		{!! Form::model($user, ['route'=>['profile.update',$user->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'userFrm', 'id' => 'userFrm', 'files' => true]) !!}
        		{!! Form::hidden('isprofile', true, ['id' => 'isprofile','class' => 'form-control']) !!}
        	@else
            	{!! Form::model($user, ['route'=>['user.update',$user->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'userFrm', 'id' => 'userFrm', 'files' => true]) !!}
        	@endif
        @endif
        {!! Form::hidden('key', isset($user) && $user->password ? $user->password : '') !!}
		<div class="col-sm-6">
			<div class="box box-info">
				<div class="box-header with-border">
					<i class="fa fa-user"></i>&nbsp;{{ trans('globals.section_title.users.personal_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('identification', trans('users.identification')) !!}
							{!! Form::text('identification',  isset($user) && $user->identification ? $user->identification : old('identification'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('first_name', trans('users.first_name')) !!}
							{!! Form::text('first_name',  isset($user) && $user->first_name ? $user->first_name : old('first_name'), ['class' => 'form-control', isset($profile) ? 'readonly' : '']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('last_name', trans('users.last_name')) !!}
							{!! Form::text('last_name', isset($user) && $user->last_name ? $user->last_name : old('last_name'), ['class' => 'form-control', isset($profile) ? 'readonly' : '']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<div class="table-responsive"> 
								<table class="table">
									<tr>
										<td>
											{!! Form::label('gender', trans('users.gender')) !!} 
										</td>
										<td>
											{!! Form::radio('gender', 'male', isset($user->gender) && $user->gender == 'male' ? true : false, ['class' => 'minimal radio-inline', isset($profile) ? 'readonly' : '']) !!} {{ trans('globals.gender.male') }}
											{!! Form::radio('gender', 'female', isset($user->gender) && $user->gender == 'female' ? true : false, ['class' => 'minimal radio-inline', isset($profile) ? 'readonly' : '']) !!} {{ trans('globals.gender.female') }}
										</td>
									</tr>
									<tr>
										<td>
											{!! Form::label('language', trans('users.language')) !!} 
										</td>
										<td>
											{!! Form::radio('language', 'en', isset($user->language) && $user->language == 'en' ? true : false, ['class' => 'minimal radio-inline', isset($profile) ? 'readonly' : '']) !!} {{ trans('globals.language.en') }}
											{!! Form::radio('language', 'es', isset($user->language) && $user->language == 'es' ? true : false, ['class' => 'minimal radio-inline', isset($profile) ? 'readonly' : '']) !!} {{ trans('globals.language.es') }}
											{!! Form::radio('language', 'pt', isset($user->language) && $user->language == 'pt' ? true : false, ['class' => 'minimal radio-inline', isset($profile) ? 'readonly' : '']) !!} {{ trans('globals.language.pt') }}
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
								{!! Form::label('country', trans('users.country')) !!}
								{!! Form::select('country_id', $countries, isset($user->country_id) ? $user->country_id : old('country_id'), ['id' => 'country_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
							</div>
						</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('birth_date', trans('users.birth_date')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								{!! Form::text('birth_date', isset($user) && $user->birth_date ? $user->birth_date->format('Y-m-d') : old('birth_date'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('cellphone_number', trans('users.cellphone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('cellphone_number', isset($user) && $user->cellphone_number ? $user->cellphone_number : old('cellphone_number'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('homephone_number', trans('users.homephone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('homephone_number', isset($user) && $user->homephone_number ? $user->homephone_number : old('homephone_number'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">

						<div class="form-group col-sm-12">
							{!! Form::label('photo', trans('users.photo')) !!}
							{!! Form::file('photo', ['class' => 'form-control']) !!}
						</div>
						@if ($edit)
							<div class="form-group col-sm-12">
								<img src = "{{ getenv('FILES_STORAGE_SERVER') }}{{ Auth::user()->pic_url }}" class = "img-profile" alt = "{{ $user->first_name }}" />
							</div>
						@endif
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#userFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}

		<div class="col-sm-6">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-lock"></i>&nbsp;{{ trans('globals.section_title.users.access_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('username', trans('users.username')) !!}
							{!! Form::text('username',  isset($user) && $user->username ? $user->username : old('username'), ['class' => 'form-control', isset($profile) ? 'readonly' : '']) !!}
						</div>
						<div class="form-group col-sm-12">
							{!! Form::label('email', trans('users.email')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope-o"></i>
								</div>
								{!! Form::email('email', isset($user) && $user->email ? $user->email : old('email'), ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group col-sm-12">
							{!! Form::label('password', trans('users.password')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-lock"></i>
								</div>
								{{-- SI EL PASSWORD EXISTE, LO DEJO EN BLANCO. SI QUIERE ACTUALIZARLO, INGRESA NUEVA PASS Y AL ENVIAR EL CONTROLLER LO PROCESA. SI LO DEJA EN BLANCO, NO HACE EL UPDATE DEL PASS --}}
								<input id='password' name='password' class='form-control' type='password' data-toggle='password' value = "{{ isset($user->password) ? '' : old('password') }}">
							</div>
						</div>
						@if (!isset($profile))
							<div class="form-group col-sm-12">
								{!! Form::label('role', trans('users.role')) !!}
								{!! Form::select('role', $roles, isset($user->role) ? $user->role : old('role'), ['id' => 'role', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
							</div>
							<div class="type_workshop">
								<div class="form-group col-sm-12">
									{!! Form::label('workshop', trans('users.workshop')) !!}
									{!! Form::select('workshop_id', $workshops, isset($user) && ($user->workshop_id) ? $user->workshop_id : old('workshop_id'), ['id' => 'workshop_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
								</div>
							</div>
							<div class="form-group col-sm-12">
								{!! Form::label('status', trans('globals.status')) !!}
								{!! Form::select('status', $status, isset($user) && $user->status ? $user->status : old('status'), ['class' => 'form-control']); !!}
							</div>
						@endif

					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#userFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}
		{!! Form::token() !!}
		{!! Form::close() !!}
	</div> {{-- row --}}

@endsection

@include('layouts.partials.message')

@section ('jsCustoms')
	@parent
	<script src = "{{ asset('/plugins/iCheck/icheck.min.js') }}" type = "text/javascript"></script>
@endsection

@section ('jQueryScripts')
<script>
    $(function ()
    {
    	var $route_workshop = "{{ route('search.workshops_by_country', ['URL']) }}";
    	$("#birth_date").inputmask("{{ trans('globals.inputmask.date') }}", {"placeholder": "{{ trans('globals.inputmask.date') }}"});

    	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_square-red',
      		radioClass: 'iradio_square-red'
	    });

    	$("#role").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			data: {!! json_encode($roles) !!}
		});

		$("#country_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.countries') }}",
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
				  	return {
				    	results: data
				  	};
				},
			}
		});

		//Inicializate workshop list
		$("#role").on('select2:select', function (arg) {
			if (arg.params.data.id == 'workshop') {
				$(".type_workshop").show('slow');
			} else {
				$(".type_workshop").hide(500);
			}
			$("#workshop_id").val(null).trigger("change"); 
		});

		$("#country_id").on('select2:select', function (arg) {
			$("#workshop_id").val(null).trigger("change"); 
		});

		//load workshops by countries
		$("#workshop_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url:  function (params) {
      				return $route_workshop.replace('URL', $("#country_id").val());
    			},
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
				  return {
				    results: data
				  };
				},
			}
		});

    	$("#userFrm" ).submit(function( event )
    	{
    		//
		});

    });

    $( document ).ready(function() {
		//Update divs
    	if ($("#role").val() == "workshop") {
			$(".type_workshop").show('slow');
		} else {
			$(".type_workshop").hide(500);
		}
	});
</script>
@endsection


