		<div class="col-sm-6">
			<div class="box box-info">
				<div class="box-header with-border">
					<i class="fa fa-user"></i>&nbsp;{{ trans('globals.section_title.clients.client_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('type', trans('clients.type')) !!}:
							{!! Form::radio('type', 'person', true, ['class' => 'minimal radio-inline']) !!} {{ trans('globals.type_client.person') }}
							{!! Form::radio('type', 'business', false, ['class' => 'minimal radio-inline']) !!} {{ trans('globals.type_client.business') }}
						</div>
					</div>
					<div class="row person">
					</div>
					<div class="row business">
						<div class="form-group col-sm-12">
							{!! Form::label('code_identification', trans('clients.identification')) !!}
							{!! Form::text('code_identification', old('code_identification'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row business">
						<div class="form-group col-sm-12">
							{!! Form::label('description', trans('clients.description')) !!}
							{!! Form::text('description',  old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row business">
						<div class="form-group col-sm-12">
							{!! Form::label('contact_name', trans('clients.contact_name')) !!}
							{!! Form::text('contact_name',  old('contact_name'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('cellphone_number', trans('clients.cellphone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('cellphone_number_client', old('cellphone_number_client'), ['class' => 'form-control', 'id' => 'cellphone_number_client']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('homephone_number', trans('clients.homephone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('homephone_number_client', old('homephone_number_client'), ['class' => 'form-control', 'id' => 'homephone_number_client']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('email', trans('clients.email')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope-o"></i>
								</div>
								{!! Form::email('email_client', old('email_client'), ['class' => 'form-control', 'id' => 'email_client']) !!}
							</div>
						</div>
					</div>
					
				</div> {{-- box-body --}}
			
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}

		<div class="col-sm-6">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;{{ trans('globals.section_title.clients.address_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('country_id', trans('clients.country')) !!}
							<select id="country_id" name="country_id" class="form-control select2" style="width:100%">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('province_id', trans('clients.province')) !!}
							<select id="province_id" name="province_id" class="form-control select2" style="width:100%">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('city_id', trans('clients.city')) !!}
							<select id="city_id" name="city_id" class="form-control select2" style="width:100%">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('zip_code', trans('clients.zip_code')) !!}
							{!! Form::text('zip_code',  old('zip_code'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('shipping_address', trans('clients.shipping_address')) !!}
							{!! Form::textarea('shipping_address', old('shipping_address'), ['class' => 'form-control', 'rows' => 2, 'cols' => 40]) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}
