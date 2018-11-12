@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.clients.edit') : trans('globals.section_title.clients.add') }}
@endsection

@section('contentheader_title')
    {{ ($edit) ? trans('globals.section_title.clients.edit') : trans('globals.section_title.clients.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.clients.edit') : trans('globals.section_title.clients.add') }}</li>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/plugins/iCheck/all.css') }}" rel = "stylesheet" type="text/css" />
@endsection


@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['client.store'], 'method'=>'POST', 'name'=>'clientFrm', 'id'=> 'clientFrm', 'role'=>'form', 'files' => true]) !!}
        @else
        	@if(!$is_customer)
            	{!! Form::model($client, ['route'=>['client.update',$client->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'clientFrm', 'id' => 'clientFrm', 'files' => true]) !!}
        	@else
        		{!! Form::model($client, ['route'=>['client.update.profile',$client->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'clientFrm', 'id' => 'clientFrm', 'files' => true]) !!}
        	@endif
        @endif

		@include('clients.partials.edit')

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
	@include('clients.partials.scripts',[$edit])
@endsection	