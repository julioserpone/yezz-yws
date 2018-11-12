@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.chains.edit') : trans('globals.section_title.chains.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.chains.edit') : trans('globals.section_title.chains.add') }}</li>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/plugins/iCheck/all.css') }}" rel = "stylesheet" type="text/css" />
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['chain.store'], 'method'=>'POST', 'name'=>'chainFrm', 'id'=> 'chainFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($chain, ['route'=>['chain.update',$chain->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'chainFrm', 'id' => 'chainFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.chains.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.chains.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('chains.description')) !!}:
							{!! Form::text('description',  isset($chain->description) ? $chain->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('country', trans('chains.country')) !!}:
							{!! Form::select('country_id', $countries, isset($chains->country_id) ? $chains->country_id : old('country_id'), ['id' => 'country_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('admin_imei', trans('chains.admin_imei')) !!}:
							{!! Form::radio('admin_imei', 'yes', isset($chains->admin_imei) && $chains->admin_imei == 'yes' ? true : false, ['class' => 'minimal radio-inline']) !!} {{ ucwords(trans('globals.verification.yes')) }}
							{!! Form::radio('admin_imei', 'no', isset($chains->admin_imei) && $chains->admin_imei == 'no' ? true : false, ['class' => 'minimal radio-inline']) !!} {{ ucwords(trans('globals.verification.no')) }}
						</div>
					</div>

				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#chainFrm').submit();">
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

@section ('jsCustoms')
	@parent
	<script src = "{{ asset('/plugins/iCheck/icheck.min.js') }}" type = "text/javascript"></script>
@endsection

@section ('jQueryScripts')
<script>
    $(function ()
    {
    	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_square-red',
      		radioClass: 'iradio_square-red'
	    });

		$("#country_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.countries') }}",
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

