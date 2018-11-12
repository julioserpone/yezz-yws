@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('globals.section_title.reports.reports')}}
@endsection

@section('contentheader_title')
	<strong>{{ trans('globals.section_title.reports.reports')}}</strong>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/akkargroup-bower/bootstrap-daterangepicker/daterangepicker.css') }}" rel = "stylesheet" type="text/css" />
@endsection

@section('main-content')

	<div class="container-fluid">
		@include('reports.partials.orders')
	</div>

@endsection

@include('layouts.partials.message')

@section ('jsCustoms')
@parent

	<script src = "{{ asset('/akkargroup-bower/moment/moment.js') }}" type = "text/javascript"></script>
	<script src = "{{ asset('/akkargroup-bower/bootstrap-daterangepicker/daterangepicker.js') }}" type = "text/javascript"></script>

@endsection

@section ('jQueryScripts')
	
	@include('reports.partials.static_scripts')

@endsection


