@extends('layouts.app')

@section('htmlheader_title')
    {{ ($edit) ? trans('globals.section_title.producttypes.edit') : trans('globals.section_title.producttypes.add') }}
@endsection

@section('breadcrumb_li')
	<li class="active">{{ ($edit) ? trans('globals.section_title.producttypes.edit') : trans('globals.section_title.producttypes.add') }}</li>
@endsection

@include('layouts.partials.message')

@section('main-content')
	<div class="row">
		@if(!$edit)
			{!! Form::model(Request::all(),['route'=>['producttype.store'], 'method'=>'POST', 'name'=>'producttypeFrm', 'id'=> 'producttypeFrm', 'role'=>'form']) !!}
        @else
            {!! Form::model($producttype, ['route'=>['producttype.update',$producttype->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'producttypeFrm', 'id' => 'producttypeFrm']) !!}
        @endif
		<div class="col-sm-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h4>
						@if ($edit)
							<i class="fa fa-pencil-square-o"></i>&nbsp;{{ trans('globals.section_title.producttypes.edit') }}
						@else
							<i class="fa fa-plus-square"></i>&nbsp;{{ trans('globals.section_title.producttypes.add') }}
						@endif
					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-6">
							{!! Form::label('description', trans('globals.producttype_description')) !!}:
							{!! Form::text('description',  isset($producttype) && $producttype->description ? $producttype->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>

				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#producttypeFrm').submit();">
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



