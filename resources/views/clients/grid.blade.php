@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('globals.section_title.clients.module') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ trans('globals.section_title.clients.list') }}</li>
@endsection

@section('main-content')

	<div class="box">

		<div class="box-header with-border">
			<h4 class="pull-left">
				<i class="fa fa-th"></i>&nbsp;{{ trans('globals.section_title.clients.list') }}
			</h4>
		@if(!$modal_view)
			<a href="{{ route('client.create') }}" class="btn btn-sm btn-success pull-right">
				<span class="fa fa-plus-square"></span>&nbsp;{{ trans('globals.add_new') }}&nbsp;{{ trans('globals.client') }}
			</a>
		@endif
		</div>

		@include('clients.partials.list')

	</div>


@endsection

@include('layouts.partials.message')

@section ('jQueryScripts')

@include('clients.partials.script_grid')

@endsection


