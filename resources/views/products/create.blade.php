@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.products.edit') : trans('globals.section_title.products.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.products.edit') : trans('globals.section_title.products.add') }}</li>
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['product.store'], 'method'=>'POST', 'name'=>'productFrm', 'id'=> 'productFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($product, ['route'=>['product.update',$product->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'productFrm', 'id' => 'productFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.products.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.products.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('product_type', trans('products.product_type')) !!}:
							{!! Form::select('producttype_id', $producttypes, isset($product->producttype_id) ? $product->producttype_id : old('producttype_id'), ['id' => 'producttype_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('brand', trans('products.brand')) !!}:
							{!! Form::select('brand_id', $brands, isset($product->brand_id) ? $product->brand_id : old('brand_id'), ['id' => 'brand_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('family', trans('products.family')) !!}:
							{!! Form::select('family_id', $families, isset($product->family_id) ? $product->family_id : old('family_id'), ['id' => 'family_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('technology', trans('products.technology')) !!}:
							{!! Form::select('technology_id', $technologies, isset($product->technology_id) ? $product->technology_id : old('technology_id'), ['id' => 'technology_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('scale', trans('products.scale')) !!}:
							{!! Form::select('scale_id', $scales, isset($product->scale_id) ? $product->scale_id : old('scale_id'), ['id' => 'scale_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('color', trans('products.color')) !!}:
							{!! Form::select('color_id', $colors, isset($product->color_id) ? $product->color_id : old('color_id'), ['id' => 'color_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('code', trans('products.code')) !!}:
							{!! Form::text('code',  isset($product->code) ? $product->code : old('code'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('part_number', trans('products.part_number')) !!}:
							{!! Form::text('part_number',  isset($product->part_number) ? $product->part_number : old('part_number'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('model', trans('products.model')) !!}:
							{!! Form::text('model',  isset($product->model) ? $product->model : old('model'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('products.description')) !!}:
							{!! Form::text('description',  isset($product->description) ? $product->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#productFrm').submit();">
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
		$("#producttype_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.producttypes') }}",
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

		$("#brand_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.brands') }}",
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

		$("#family_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.families') }}",
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

		$("#technology_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.technologies') }}",
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

		$("#scale_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.scales') }}",
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

		$("#color_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.colors') }}",
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

