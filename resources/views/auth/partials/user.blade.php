	<div class="row">
		<div class="col-sm-6">
			<div class="box box-info">
				<div class="box-header with-border">
					<i class="fa fa-user"></i>&nbsp;{{ trans('globals.section_title.users.personal_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('identification', trans('users.identification')) !!}
							{!! Form::text('identification', old('identification'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('first_name', trans('users.first_name')) !!}
							{!! Form::text('first_name',  old('first_name'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('last_name', trans('users.last_name')) !!}
							{!! Form::text('last_name', old('last_name'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('gender', trans('users.gender')) !!}:
							{!! Form::radio('gender', 'male', false, ['class' => 'minimal radio-inline']) !!} {{ trans('globals.gender.male') }}
							{!! Form::radio('gender', 'female', false, ['class' => 'minimal radio-inline']) !!} {{ trans('globals.gender.female') }}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('language', trans('users.language')) !!}:
							{!! Form::radio('language', 'en', false, ['class' => 'minimal radio-inline']) !!} {{ trans('globals.language.en') }}
							{!! Form::radio('language', 'es', true, ['class' => 'minimal radio-inline']) !!} {{ trans('globals.language.es') }}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('cellphone_number', trans('users.cellphone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('cellphone_number', old('cellphone_number'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('homephone_number', trans('users.homephone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('homephone_number', old('homephone_number'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
				</div> {{-- box-body --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}

		<div class="col-sm-6">
			<div class="box box-info">
				<div class="box-header with-border">
					<i class="fa fa-lock"></i>&nbsp;{{ trans('globals.section_title.users.access_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('username', trans('users.username')) !!}
							{!! Form::text('username',  old('username'), ['class' => 'form-control']) !!}
						</div>
						<div class="form-group col-sm-12">
							{!! Form::label('email', trans('users.email')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope-o"></i>
								</div>
								{!! Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email']) !!}
							</div>
						</div>
						<div class="form-group col-sm-12">
							{!! Form::label('password', trans('users.password')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-lock"></i>
								</div>
								<input id='password' name='password' class='form-control' type='password' data-toggle='password' value = "{{ old('password') }}">
							</div>
						</div>
					</div>
				</div> {{-- box-body --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}
	</div> {{-- row --}}