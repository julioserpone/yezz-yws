@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('globals.section_title.orders.edit_courier') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ trans('globals.section_title.orders.edit_courier') }}</li>
@endsection

@section('main-content')
	<div class="row">
        {!! Form::model($order, ['route'=>['order.save_courier',$order->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'orderFrm', 'id' => 'orderFrm']) !!}
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.orders.edit_courier') }}
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('courier', trans('orders.courier')) !!}:
							{!! Form::select('courier_id', $couriers, old('courier_id'), ['id' => 'courier_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('tracking', trans('orders.tracking')) !!}:
							{!! Form::text('tracking',  isset($order) && $order->tracking ? $order->tracking : old('tracking'), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#orderFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-12 --}}

		{!! Form::token() !!}
		{!! Form::close() !!}
	</div> {{-- row --}}

@endsection

@include('layouts.partials.message')

@section ('jQueryScripts')
<script>
    $(function ()
    {
		$("#courier_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.couriers') }}",
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
