@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('globals.section_title.products.module') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ trans('globals.section_title.products.list') }}</li>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/akkargroup-bower/sweetalert/dist/sweetalert.css') }}" rel = "stylesheet" type="text/css" />
@endsection

@section('main-content')

	<div class="box">

		<div class="box-header with-border">
			<h4 class="pull-left">
				<i class="fa fa-th"></i>&nbsp;{{ trans('globals.section_title.products.list') }}
			</h4>
			<a href="{{ route('product.create') }}" class="btn btn-sm btn-success pull-right">
				<span class="fa fa-plus-square"></span>&nbsp;{{ trans('globals.add_new') }}&nbsp;{{ trans('globals.product') }}
			</a>
			<a id="sincronize" url="{{ route('products.sincronize') }}" href="#" class="btn btn-sm btn-info pull-right">
				<span class="fa fa-refresh"></span>&nbsp;{{ trans('globals.sincronize') }}
			</a>
		</div>

		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<table id="datagrid" class="table table-bordered table-hover dataTable" role="grid">
				        <thead>
				            <tr>
				                <th class="text-center">{{ trans('products.code') }}</th>
				                <th class="text-center">{{ trans('products.description') }}</th>
				                <th class="text-center">{{ trans('products.part_number') }}</th>
				                <th class="text-center">{{ trans('globals.status') }}</th>
				                <th class="text-center">{{ trans('globals.actions') }}</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
				                <th class="text-center">{{ trans('products.code') }}</th>
				                <th class="text-center">{{ trans('products.description') }}</th>
				                <th class="text-center">{{ trans('products.part_number') }}</th>
				                <th class="text-center">{{ trans('globals.status') }}</th>
				                <th class="text-center">{{ trans('globals.actions') }}</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	@foreach ($products as $product)
					            <tr>
					            	<td class="text-center">{{ ucwords($product->code) }}</td>
					                <td>{{ ucwords($product->description) }}
					                	{{-- &nbsp; <label class="label" style="background-color: {{ $product->color->hexadecimal }};"><i class="glyphicon glyphicon-tint"></i></label>
					                	@if($product->color->secondary_hex) 
					                		/ &nbsp; <label class="label" style="background-color: {{ $product->color->secondary_hex }};"><i class="glyphicon glyphicon-tint"></i></label> 
					                	@endif 
					                	--}}
					                </td>
					                <td class="text-center">{{ ucwords($product->part_number) }}</td>
					                <td class="text-center"><label class = "{{ trans('globals.states_class.'.$product->state) }}">{{ ucfirst($product->state) }}</label></td>
					                <th class="text-center">
					                	<a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
					                	<a href="{{ route('product.change_states',[$product->id, $product->state]) }}" class="btn btn-{{ ($product->state=='active')?'danger':'success' }} btn-xs"><i class="glyphicon glyphicon-off"></i></a>
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

@section ('jsCustoms')
	@parent
	<script src = "{{ asset('/akkargroup-bower/sweetalert/dist/sweetalert.min.js') }}" type = "text/javascript"></script>
@endsection

@section ('jQueryScripts')
<script>
        $(function () {

        	$("#sincronize").click(function(e){
				e.preventDefault();
				var url = $(this).attr("url");
				token = "{{ csrf_token() }}";

				swal({   
					title: "{{ trans('globals.sincronize') }}",
					text: "{{ trans('products.product_sincronize_request') }}",   
					type: "info",   
					showCancelButton: true,   
					closeOnConfirm: false,   
					showLoaderOnConfirm: true, 
				}, function(){

					$.ajax({
		                url: url,
		                headers: {'X-CSRF-TOKEN': token},
		                type: 'POST',
		                datatype: 'JSON',
		                success: function (response) {
		                	if (response.status == 422) {
		                		var errors = $.parseJSON(response.responseText);
		                		swal("Error", errors, "error");
		                	} else {
		                		swal({   
									title: "{{ trans('globals.success_alert_title') }}",
									text: "{{ trans('products.product_sincronize_success') }}",   
									type: "success"
								}, function(){
									window.location.href = "{{ route('product.index') }}";
								});
		                	}
		                }
		            });
					
				});

			});
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


