@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.countries.edit') : trans('globals.section_title.countries.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.countries.edit') : trans('globals.section_title.countries.add') }}</li>
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['country.store'], 'method'=>'POST', 'name'=>'countryFrm', 'id'=> 'countryFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($country, ['route'=>['country.update',$country->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'countryFrm', 'id' => 'countryFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.countries.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.countries.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('countries.description')) !!}:
							{!! Form::text('description',  isset($country->description) ? $country->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('iso_code', trans('countries.iso_code')) !!}:
							{!! Form::text('iso_code',  isset($country->iso_code) ? $country->iso_code : old('iso_code'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('calling_code', trans('countries.calling_code')) !!}:
							{!! Form::text('calling_code',  isset($country->calling_code) ? $country->calling_code : old('calling_code'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('coin_code', trans('countries.coin_code')) !!}:
							{!! Form::text('coin_code',  isset($country->coin_code) ? $country->coin_code : old('coin_code'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('coin_name', trans('countries.coin_name')) !!}:
							{!! Form::text('coin_name',  isset($country->coin_name) ? $country->coin_name : old('coin_name'), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#countryFrm').submit();">
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


