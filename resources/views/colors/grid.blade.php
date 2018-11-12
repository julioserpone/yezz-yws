@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('globals.section_title.colors.module') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ trans('globals.section_title.colors.list') }}</li>
@endsection

@section('main-content')

	<div class="box">

		<div class="box-header with-border">
			<h4 class="pull-left">
				<i class="fa fa-th"></i>&nbsp;{{ trans('globals.section_title.colors.list') }}
			</h4>
			<a href="{{ route('color.create') }}" class="btn btn-sm btn-success pull-right">
				<span class="fa fa-plus-square"></span>&nbsp;{{ trans('globals.add_new') }}&nbsp;{{ trans('globals.color') }}
			</a>
		</div>

		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<table id="datagrid" class="table table-bordered table-hover dataTable" role="grid">
				        <thead>
				            <tr>
				                <th>{{ trans('globals.description') }}</th>
				                <th class="text-center">{{ trans('globals.status') }}</th>
				                <th class="text-center">{{ trans('globals.actions') }}</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
				                <th>{{ trans('globals.description') }}</th>
				                <th class="text-center">{{ trans('globals.status') }}</th>
				                <th class="text-center">{{ trans('globals.actions') }}</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	@foreach($colors as $color)
					            <tr>
					                <td>{{ ucwords($color->description) }} 
					                	&nbsp; <label class="label" style="background-color: {{ $color->hexadecimal }};"><i class="glyphicon glyphicon-tint"></i></label>
					                	@if($color->secondary_hex) 
					                		/ &nbsp; <label class="label" style="background-color: {{ $color->secondary_hex }};"><i class="glyphicon glyphicon-tint"></i></label> 
					                	@endif 
					                </td>
					                <td class="text-center"><label class="{{ trans('globals.status_class.'.$color->status) }}">{{ ucfirst($color->status) }}</label></td>
					                <th class="text-center">
					                	<a href="{{ route('color.edit', $color->id) }}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
					                	<a href="{{ route('color.change_status',[$color->id, $color->status]) }}" class="btn btn-{{ ($color->status=='active')?'danger':'success' }} btn-xs"><i class="glyphicon glyphicon-off"></i></a>
					                </th>
					            </tr>
				            @endforeach
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>


@endsection

@include('layouts.partials.message')

@section ('jQueryScripts')
<script>
        $(function () {
            $(document).ready(function() {
			    $('#datagrid').DataTable({
			      	"paging": true,
			      	"lengthChange": true,
			      	"searching": true,
			      	"ordering": true,
			      	"info": true,
			      	"autoWidth": true
			    });
			});
        });
    </script>
@endsection


