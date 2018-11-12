@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.couriers.edit') : trans('globals.section_title.couriers.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.couriers.edit') : trans('globals.section_title.couriers.add') }}</li>
@endsection

@include('layouts.partials.message')

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['courier.store'], 'method'=>'POST', 'name'=>'courierFrm', 'id'=> 'courierFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($courier, ['route'=>['courier.update',$courier->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'courierFrm', 'id' => 'courierFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.couriers.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.couriers.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('couriers.code')) !!}:
							{!! Form::text('description',  isset($courier) && $courier->description ? $courier->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('code', trans('couriers.description')) !!}:
							{!! Form::text('code',  isset($courier) && $courier->code ? $courier->code : old('code'), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#courierFrm').submit();">
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



