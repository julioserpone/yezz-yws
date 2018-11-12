@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.workshops.edit') : trans('globals.section_title.workshops.add') }}
@endsection

@section('contentheader_title')
    {{ ($edit) ? trans('globals.section_title.workshops.edit') : trans('globals.section_title.workshops.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.workshops.edit') : trans('globals.section_title.workshops.add') }}</li>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/plugins/iCheck/all.css') }}" rel = "stylesheet" type="text/css" />
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['workshop.store'], 'method'=>'POST', 'name'=>'workshopFrm', 'id'=> 'workshopFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($workshop, ['route'=>['workshop.update',$workshop->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'workshopFrm', 'id' => 'workshopFrm']) !!}
        @endif
		
		@include('workshops.partials.edit')

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

    	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_square-red',
      		radioClass: 'iradio_square-red'
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

		$("#route_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.routes') }}",
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
    });

</script>
@endsection

