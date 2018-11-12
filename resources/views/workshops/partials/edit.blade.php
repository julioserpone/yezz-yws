		<div class="col-sm-6">
			<div class="box box-info">
				<div class="box-header with-border">
					<i class="fa fa-user"></i>&nbsp;{{ trans('globals.section_title.workshops.workshop_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('identification', trans('workshops.identification')) !!}:
							{!! Form::text('identification',  isset($workshop->identification) ? $workshop->identification : old('identification'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('description', trans('workshops.description')) !!}:
							{!! Form::text('description',  isset($workshop->description) ? $workshop->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('type', trans('workshops.type')) !!}
							{!! Form::select('type', $type_workshop, isset($workshop->type) ? $workshop->type : (old('type') ? : 'both'), ['class' => 'form-control']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('work_schedule', trans('workshops.work_schedule')) !!}:
							{!! Form::text('work_schedule',  isset($workshop->work_schedule) ? $workshop->work_schedule : old('work_schedule'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('route', trans('workshops.route')) !!}:
							{!! Form::select('route_id', $routes, isset($workshops->route_id) ? $workshops->route_id : old('route_id'), ['id' => 'route_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('comment', trans('workshops.comment')) !!}
							{!! Form::textarea('comment', isset($workshops->comment) ? $workshops->comment : old('comment'), ['class' => 'form-control', 'rows' => 3, 'cols' => 40]) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#workshopFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-12 --}}
		<div class="col-sm-6">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-lock"></i>&nbsp;{{ trans('globals.section_title.workshops.contact_info_address') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('contact_name', trans('workshops.contact_name')) !!}:
							{!! Form::text('contact_name',  isset($workshop->contact_name) ? $workshop->contact_name : old('contact_name'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('officephone_number', trans('workshops.officephone_number')) !!}:
							{!! Form::text('officephone_number',  isset($workshop->officephone_number) ? $workshop->officephone_number : old('officephone_number'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('email', trans('workshops.email')) !!}:
							{!! Form::text('email',  isset($workshop->email) ? $workshop->email : old('email'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('country', trans('workshops.country')) !!}:
							{!! Form::select('country_id', $countries, isset($workshops->country_id) ? $workshops->country_id : old('country_id'), ['id' => 'country_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('address', trans('workshops.address')) !!}
							{!! Form::textarea('address', isset($workshops->address) ? $workshops->address : old('address'), ['class' => 'form-control', 'rows' => 2, 'cols' => 40]) !!}
						</div>
					</div>

				</div> {{-- box-body --}}
				<div class="box-footer">
					<button type="button" class="btn btn-success" onclick="$('#workshopFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-12 --}}
