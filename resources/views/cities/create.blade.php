@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.cities.edit') : trans('globals.section_title.cities.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.cities.edit') : trans('globals.section_title.cities.add') }}</li>
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['city.store'], 'method'=>'POST', 'name'=>'cityFrm', 'id'=> 'cityFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($city, ['route'=>['city.update',$city->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'cityFrm', 'id' => 'cityFrm']) !!}
        @endif
        {!! Form::hidden('edit', $edit, array('id' => 'edit')) !!}
        <input type="hidden" name="_province_id" id="_province_id" value="{{ old('province_id') }}">
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.cities.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.cities.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
				@if (!$edit)
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('country', trans('cities.country')) !!}:
							{!! Form::select('country_id', $countries, old('country_id'), ['id' => 'country_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
				@else
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::text('country', $city->province->country->description, ['class' => 'form-control', 'readonly']) !!}
							{!! Form::hidden('country_id', $city->province->country->id, array('id' => 'country_id')) !!}
						</div>
					</div>
				@endif
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('province', trans('cities.province')) !!}:
							{!! Form::select('province_id', $provinces, isset($city->province_id) ? $city->province_id : old('province_id'), ['id' => 'province_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('cities.description')) !!}:
							{!! Form::text('description',  isset($city->description) ? $city->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('timezone', trans('cities.timezone')) !!}:
							{!! Form::select('timezone', $timezones, isset($client) && $city->timezone ? $city->timezone : old('timezone'), ['class' => 'form-control']); !!}
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#cityFrm').submit();">
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
    	var $route_province = "{{ route('search.provinces_by_country', ['URL']) }}";
    	var $mode_edition = "{{ $edit }}";
    	console.log($mode_edition);

    	if (!$mode_edition) {
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
						$("#province_id").val(null).trigger("change"); 
					  	return {
					    	results: data
					  	};
					},
				}
			});
    	}

		$("#province_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url:  function (params) {
      				return $route_province.replace('URL', $("#country_id").val());
    			},
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

		if (($("#_province_id").val()=='') && !($("#edit").val())) $("#province_id").val(null).trigger("change"); 

    });

</script>
@endsection

