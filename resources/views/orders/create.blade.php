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
		<!-- Modal Create Client -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
		  			{!! Form::model(Request::all(),['route'=>['client.store'], 'method'=>'POST', 'name'=>'clientFrm', 'id'=> 'clientFrm', 'role'=>'form', 'class'=>'bootstrap-modal-form']) !!}
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">{{ ($edit) ? trans('globals.section_title.clients.edit') : trans('globals.section_title.clients.add') }}</h4>
						</div>
						{{-- <div class="modal-body"> --}}
							@include('clients.partials.edit',[$status,$countries,$provinces,$cities,$modal_json])
						{{-- </div> --}}
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('globals.close') }}</button>
							<button type="submit" class="btn btn-primary">{{ trans('globals.submit') }}</button>
						</div>
					{!! Form::token() !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<!-- Modal Create Client -->
		<div class="modal fade" id="ModalSearchClients" tabindex="-1" role="dialog" aria-labelledby="ModalSearchClientsLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">		  			
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="ModalSearchClientsLabel">{{ trans('globals.search').' '.trans('globals.client') }}</h4>
						</div>
						@include('clients.partials.list',[$modal_view,$clients_grid])
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('globals.close') }}</button>
						</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ModalShowClient" tabindex="-1" role="dialog" aria-labelledby="ModalShowClientLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">		  			
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="ModalShowClientLabel">{{ trans('globals.show_more_information') }}</h4>
						</div>
						@include('clients.partials.show', [$modal_view])
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('globals.close') }}</button>
						</div>
				</div>
			</div>
		</div>
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['order.store'], 'method'=>'POST', 'name'=>'orderFrm', 'id'=> 'orderFrm', 'role'=>'form', 'files' => true]) !!}
        @else
            {!! Form::model($order, ['route'=>['order.update',$order->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'orderFrm', 'id' => 'orderFrm', 'files' => true]) !!}
        @endif

		@include('orders.partials.edit')

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
	@include('layouts.partials.laravel-bootstrap-modal-form')
	@include('clients.partials.scripts', [$edit])
	@include('clients.partials.script_grid')
	@include('orders.partials.scripts', [$edit])
@endsection


