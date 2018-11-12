@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('globals.section_title.scales.module') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ trans('globals.section_title.scales.list') }}</li>
@endsection

@section('main-content')

	<div class="box">

		<div class="box-header with-border">
			<h4 class="pull-left">
				<i class="fa fa-th"></i>&nbsp;{{ trans('globals.section_title.scales.list') }}
			</h4>
			<a href="{{ route('scale.create') }}" class="btn btn-sm btn-success pull-right">
				<span class="fa fa-plus-square"></span>&nbsp;{{ trans('globals.add_new') }}&nbsp;{{ trans('globals.scale') }}
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
				        	@foreach ($scales as $scale)
					            <tr>
					                <td>{{ ucwords($scale->description) }}</td>
					                <td class="text-center"><label class = "{{ trans('globals.status_class.'.$scale->status) }}">{{ ucfirst($scale->status) }}</label></td>
					                <th class="text-center">
					                	<a href="{{ route('scale.edit', $scale->id) }}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
					                	<a href="{{ route('scale.change_status',[$scale->id, $scale->status]) }}" class="btn btn-{{ ($scale->status=='active')?'danger':'success' }} btn-xs"><i class="glyphicon glyphicon-off"></i></a>
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


