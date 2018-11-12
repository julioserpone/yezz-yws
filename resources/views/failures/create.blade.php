@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.failures.edit') : trans('globals.section_title.failures.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.failures.edit') : trans('globals.section_title.failures.add') }}</li>
@endsection

@include('layouts.partials.message')

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['failure.store'], 'method'=>'POST', 'name'=>'failureFrm', 'id'=> 'failureFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($failure, ['route'=>['failure.update',$failure->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'failureFrm', 'id' => 'failureFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.failures.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.failures.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group">
	                       	<label class="col-md-2 control-label text-right">
								{!! Form::label('code', trans('failures.code')) !!}:
							</label>
							<div class="col-md-8">
								{!! Form::text('code',  isset($failure) && $failure->code ? $failure->code : old('code'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
				@foreach (trans('locale') as $key=>$value)
                    <hr/>
                    <div class="row">
	                    <div class="form-group">
	                       	<label class="col-md-2 control-label text-right">
	                        	{{ trans('failures.name').' ('.$value.')' }}:
	                       	</label>
	                       	<div class="col-md-8">
	                       		{!! Form::text('name_'.$key,  isset($failure) && $failure->translate($key)->name ? $failure->translate($key)->name : old('name_'.$key), ['class' => 'form-control', 'placeholder' => trans('failures.name').' ('.$value.')']) !!}
	                       </div>
	                    </div>
	                </div>
                @endforeach
                	<hr/>
                	<div class="row">
						<div class="form-group">
							<label class="col-md-2 control-label text-right">
								{!! Form::label('status', trans('globals.status')) !!}
							</label>
							<div class="col-md-8">
								{!! Form::select('status', $status, isset($user) && $user->status ? $user->status : old('status'), ['class' => 'form-control']); !!}
							</div>
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#failureFrm').submit();">
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



