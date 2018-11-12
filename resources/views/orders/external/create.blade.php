@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.orders.edit').' '.$order->order_number  : trans('globals.section_title.orders.add') }}
@endsection

@section('contentheader_title')
    {{ ($edit) ? trans('globals.section_title.orders.edit').' '.$order->order_number : trans('globals.section_title.orders.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.orders.edit'): trans('globals.section_title.orders.add') }}</li>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/akkargroup-bower/animate.css/animate.min.css') }}" rel = "stylesheet" type="text/css" />
	<link href = "{{ asset('/plugins/iCheck/all.css') }}" rel = "stylesheet" type="text/css" />
@endsection


@section('main-content')
	<div class="row">
		
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['order.store_external'], 'method'=>'POST', 'name'=>'orderFrm', 'id'=> 'orderFrm', 'role'=>'form', 'files' => true]) !!}
        @else
            {!! Form::model($order, ['route'=>['order.update',$order->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'orderFrm', 'id' => 'orderFrm', 'files' => true]) !!}
        @endif

		@include('orders.external.partial')

		{!! Form::token() !!}
		{!! Form::close() !!}
	</div> {{-- row --}}

@endsection

@include('layouts.partials.message')

@section ('jsCustoms')
	@parent
	<script src = "{{ asset('/plugins/iCheck/icheck.min.js') }}" type = "text/javascript"></script>
	<script src = "{{ asset('/akkargroup-bower/moment/moment.js') }}" type = "text/javascript"></script>
	<script src = "{{ asset('/plugins/daterangepicker/daterangepicker.js') }}" type = "text/javascript"></script>
	<script src = "{{ asset('/akkargroup-bower/jquery-tmpl/jquery.tmpl.min.js') }}" type = "text/javascript"></script>
	<script src = "{{ asset('/js/jquery.repeter.js') }}" type = "text/javascript"></script>
@endsection

@section ('jQueryScripts')
	@include('orders.external.scripts', [$edit])
@endsection


