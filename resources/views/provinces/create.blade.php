@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.provinces.edit') : trans('globals.section_title.provinces.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.provinces.edit') : trans('globals.section_title.provinces.add') }}</li>
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['province.store'], 'method'=>'POST', 'name'=>'provinceFrm', 'id'=> 'provinceFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($province, ['route'=>['province.update',$province->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'provinceFrm', 'id' => 'provinceFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.provinces.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.provinces.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('country', trans('provinces.country')) !!}:
							{!! Form::select('country_id', $countries, isset($provinces->country_id) ? $provinces->country_id : old('country_id'), ['id' => 'country_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('provinces.description')) !!}:
							{!! Form::text('description',  isset($province->description) ? $province->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('iso_code', trans('provinces.iso_code')) !!}:
							{!! Form::text('iso_code',  isset($province->iso_code) ? $province->iso_code : old('iso_code'), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#provinceFrm').submit();">
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

