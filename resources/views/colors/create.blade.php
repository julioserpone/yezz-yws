@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.colors.edit') : trans('globals.section_title.colors.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.colors.edit') : trans('globals.section_title.colors.add') }}</li>
@endsection

@section('cssCustoms')
	<link href = "{{ asset('/akkargroup-bower/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel = "stylesheet" type="text/css" />
@endsection

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['color.store'], 'method'=>'POST', 'name'=>'colorFrm', 'id'=> 'colorFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($color, ['route'=>['color.update',$color->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'colorFrm', 'id' => 'colorFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.colors.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.colors.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('colors.description')) !!}:
							{!! Form::text('description',  isset($color) && $color->description ? $color->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('hexadecimal', trans('colors.hexadecimal')) !!}:
							<div class="input-group colorpicker-component" id="color_picker">
								{!! Form::text('hexadecimal',  isset($color) && $color->hexadecimal ? $color->hexadecimal : old('hexadecimal'), ['class' => 'form-control']) !!}
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('secondary_hex', trans('colors.secondary_hex')) !!}:
							<div class="input-group colorpicker-component" id="secondary_color_picker">
								{!! Form::text('secondary_hex',  isset($color) && $color->secondary_hex ? $color->secondary_hex : old('secondary_hex'), ['class' => 'form-control']) !!}
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#colorFrm').submit();">
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
	<script src = "{{ asset('/akkargroup-bower/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}" type = "text/javascript"></script>

@endsection

@section ('jQueryScripts')
<script>
    $(function ()
    {
    	$('#color_picker').colorpicker();
    	$('#secondary_color_picker').colorpicker();
    });
</script>
@endsection	
