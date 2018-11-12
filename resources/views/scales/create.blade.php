@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.scales.edit') : trans('globals.section_title.scales.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.scales.edit') : trans('globals.section_title.scales.add') }}</li>
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['scale.store'], 'method'=>'POST', 'name'=>'scaleFrm', 'id'=> 'scaleFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($scale, ['route'=>['scale.update',$scale->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'scaleFrm', 'id' => 'scaleFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.scales.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.scales.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('globals.scale_description')) !!}:
							{!! Form::text('description',  isset($scale) && $scale->description ? $scale->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>

				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#scaleFrm').submit();">
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



