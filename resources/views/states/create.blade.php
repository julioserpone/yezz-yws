@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.states.edit') : trans('globals.section_title.states.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.states.edit') : trans('globals.section_title.states.add') }}</li>
@endsection

@include('layouts.partials.message')

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['state.store'], 'method'=>'POST', 'name'=>'stateFrm', 'id'=> 'stateFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($state, ['route'=>['state.update',$state->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'stateFrm', 'id' => 'stateFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.states.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.states.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('code', trans('globals.code')) !!}:
							{!! Form::text('code',  isset($state) && $state->code ? $state->code : old('code'), ['class' => 'form-control']) !!}
						</div>
					</div>

				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#stateFrm').submit();">
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



