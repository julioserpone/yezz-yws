@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('globals.section_title.orders.module') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ trans('globals.section_title.orders.list') }}</li>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/akkargroup-bower/sweetalert/dist/sweetalert.css') }}" rel = "stylesheet" type="text/css" />
	<link href = "{{ asset('/plugins/iCheck/all.css') }}" rel = "stylesheet" type="text/css" />
@endsection

@section('main-content')

	<div class="box">

		<div class="box-header with-border">
			<h4 class="pull-left">
				<i class="fa fa-th"></i>&nbsp;{{ trans('globals.section_title.orders.list') }}
			</h4>
			<a href="{{ route('order.create') }}" class="btn btn-sm btn-success pull-right">
				<span class="fa fa-plus-square"></span>&nbsp;{{ trans('globals.add_new') }}&nbsp;{{ trans('globals.order') }}
			</a>
			@if ((Auth::user()->role == 'admin') || (Auth::user()->role == 'workshop'))
				@include('layouts.partials.modal',['onlyAction'=>true,'modalLabel'=>trans('orders.register_reception'),'link'=>false,'ajaxModal'=>route('order.show_form_equipment_receive', ['all']), 'modalClass'=>'btn btn-sm btn-info pull-right'])
			@endif
		</div>

		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<table id="datagrid" class="table table-bordered table-hover dataTable" role="grid">
				        <thead>
				            <tr>
				                <th class="text-center">{{ trans('orders.order_number') }}</th>
				                <th class="text-center">{{ trans('orders.client') }}</th>
				                <th class="text-center">{{ trans('orders.gp_imei') }}</th>
				                <th class="text-center">{{ trans('orders.gp_model') }}</th>
				                <th class="text-center">{{ trans('orders.state') }}</th>
				                <th class="text-center">{{ trans('globals.actions') }}</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
				                <th class="text-center">{{ trans('orders.order_number') }}</th>
				                <th class="text-center">{{ trans('orders.client') }}</th>
				                <th class="text-center">{{ trans('orders.gp_imei') }}</th>
				                <th class="text-center">{{ trans('orders.gp_model') }}</th>
				                <th class="text-center">{{ trans('orders.state') }}</th>
				                <th class="text-center">{{ trans('globals.actions') }}</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	@foreach ($orders as $order)
					            <tr class="{{ ($order->state->code == 'issued_case')?'danger':'' }}">
					                <td class="text-center"><a href="{{ route('order.show', $order->id) }}">{{ $order->order_number }}</a></td>
					                <td>{{ ($order->client->type == 'person') ? $order->client->person->full_name : $order->client->business->description }}</td>
					                <td>{{ $order->gp_imei }}</td>
					                <td>{{ $order->product->model }}</td>
					                <td class="text-center">
					                	@if ((in_array(Auth::user()->role, ['admin','manager','workshop'])) && ($order->state->code == 'issued_case'))
											@include('layouts.partials.modal',['onlyAction'=>true,'modalLabel'=>$order->state->name,'link'=>false,'ajaxModal'=>route('order.show_form_equipment_receive', [$order->id]), 'modalClass'=>'btn btn-xs btn-warning'])
										@else
					                		{{ $order->state->name }}
										@endif
					                </td>
					                <td class="text-center">
					                	<div class="dropdown">
											<button class="btn btn-default dropdown-toggle btn-xs" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												&nbsp;&nbsp;&nbsp;{{ trans('globals.options') }}&nbsp;&nbsp;&nbsp;
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
												<li><a href="{{ route('order.edit', $order->id) }}"><i class="glyphicon glyphicon-edit"></i>&nbsp;{{ trans('globals.edit') }}</a></li>
												@if ($order->state->code == 'issued_case')
												<li><a name="resendEmail" data="{{$order->id}}" url="{{ route('order.resend', $order->id) }}" href="#"><i class="fa fa-envelope-o"></i>&nbsp;{{ trans('orders.resend_email_cliente') }}</a></li>
												@endif
												
												{{-- <li role="separator" class="divider"></li> --}}
												
											</ul>
										</div>
					                </td>
					            </tr>
				            @endforeach
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>

@include('layouts.partials.modal',['onlyModal'=>true,'modalTitle'=>trans('orders.register_reception')])

@endsection

@include('layouts.partials.message')

@section ('jsCustoms')
	@parent
	<script src = "{{ asset('/akkargroup-bower/sweetalert/dist/sweetalert.min.js') }}" type = "text/javascript"></script>
	<script src = "{{ asset('/plugins/iCheck/icheck.min.js') }}" type = "text/javascript"></script>
@endsection

@section ('jQueryScripts')
<script>
    $(function () {

		var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
		//Get data client in modal search
		$("[name^='resendEmail']").click(function(e){
			e.preventDefault();
			var idclient = $(this).attr("data");
			var url = $(this).attr("url");
			data = {id: idclient};
			token = "{{ csrf_token() }}";

			swal({   
				title: "{{ trans('orders.order_resent_title') }}",
				text: "{{ trans('orders.order_resend_request') }}",   
				type: "info",   
				showCancelButton: true,   
				closeOnConfirm: false,   
				showLoaderOnConfirm: true, 
			}, function(){

				$.ajax({
	                url: url,
	                headers: {'X-CSRF-TOKEN': token},
	                data: data,
	                type: 'POST',
	                datatype: 'JSON',
	                success: function (response) {
	                	if (response.status == 422) {
	                		var errors = $.parseJSON(response.responseText);
	                		swal("Error", errors, "error");
	                	} else {
	                		swal("{{ trans('globals.success_alert_title') }}", "{{ trans('orders.order_resend_email_success') }}", "success");
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


