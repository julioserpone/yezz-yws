		<div class="col-sm-6">
			<div class="box box-info">
				<div class="box-header with-border">
					<i class="fa fa-user"></i>&nbsp;{{ trans('globals.section_title.clients.personal_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('type', trans('clients.type')) !!}:
							{!! Form::radio('type', 'person', (isset($client) && $client->type == 'person') || (isset($modal_json)) ? true : false, ['class' => 'minimal radio-inline', ($edit) ? 'readonly' : '']) !!} {{ trans('globals.type_client.person') }}
							{!! Form::radio('type', 'business', isset($client) && ($client->type == 'business') ? true : false, ['class' => 'minimal radio-inline', ($edit) ? 'readonly' : '']) !!} {{ trans('globals.type_client.business') }}

							{!! Form::hidden('_type', isset($client) && $client->type ? $client->type : old('_type'), array('id' => '_type')) !!}
							{!! Form::hidden('is_customer', isset($is_customer) && ($is_customer) ? true : false, array('id' => 'is_customer')) !!}
							{!! Form::hidden('modal_json', isset($modal_json) ? $modal_json : old('modal_json'), array('id' => 'modal_json')) !!}
						</div>
					</div>
					<div class="row person">
						<div class="form-group col-sm-12">
							{!! Form::label('identification', trans('clients.identification')) !!}
							{!! Form::text('identification',  isset($client->person->identification) ? $client->person->identification : old('identification'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row person">
						<div class="form-group col-sm-12">
							{!! Form::label('first_name', trans('clients.first_name')) !!}
							{!! Form::text('first_name',  isset($client->person->first_name) ? $client->person->first_name : old('first_name'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row person">
						<div class="form-group col-sm-12">
							{!! Form::label('last_name', trans('clients.last_name')) !!}
							{!! Form::text('last_name', isset($client->person->last_name) ? $client->person->last_name : old('last_name'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row business">
						<div class="form-group col-sm-12">
							{!! Form::label('code_identification', trans('clients.identification')) !!}
							{!! Form::text('code_identification', isset($client->business->code_identification) ? $client->business->code_identification : old('code_identification'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row business">
						<div class="form-group col-sm-12">
							{!! Form::label('description', trans('clients.description')) !!}
							{!! Form::text('description',  isset($client->business->description) ? $client->business->description : old('description'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row business">
						<div class="form-group col-sm-12">
							{!! Form::label('contact_name', trans('clients.contact_name')) !!}
							{!! Form::text('contact_name',  isset($client->business->contact_name) ? $client->business->contact_name : old('contact_name'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('cellphone_number', trans('clients.cellphone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('cellphone_number', isset($client) && $client->cellphone_number ? $client->cellphone_number : old('cellphone_number'), ['class' => 'form-control']) !!}
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
								{!! Form::text('homephone_number', isset($client) && $client->homephone_number ? $client->homephone_number : old('homephone_number'), ['class' => 'form-control']) !!}
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
								{!! Form::email('email', isset($client) && $client->email ? $client->email : old('email'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('status', trans('globals.status')) !!}
							{!! Form::select('status', $status, isset($client) && $client->status ? $client->status : old('status'), ['class' => 'form-control']); !!}
						</div>
					</div>
				</div> {{-- box-body --}}
			@if(!isset($modal_json))
				<div class="box-footer hidden-sm hidden-lg clearfix">
					<button type="button" class="btn btn-success pull-right" onclick="$('#clientFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			@endif
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}

		<div class="col-sm-6">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-lock"></i>&nbsp;{{ trans('globals.section_title.clients.address_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('country_id', trans('clients.country')) !!}
							{!! Form::select('country_id', $countries, isset($client) && $client->country_id ? $client->country_id : old('country_id'), ['id' => 'country_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<input type="hidden" name="_province_id" id="_province_id" value="{{ isset($client) && $client->province_id ? $client->province_id : old('province_id') }}">
							{!! Form::label('province_id', trans('clients.province')) !!}
							{!! Form::select('province_id', $provinces, isset($client) && $client->province_id ? $client->province_id : old('province_id'), ['id' => 'province_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!} 
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<input type="hidden" name="_city_id" id="_city_id" value="{{ isset($client) && $client->city_id ? $client->city_id : old('city_id') }}">
							{!! Form::label('city_id', trans('clients.city')) !!}
							{!! Form::select('city_id', $cities, isset($client) && $client->city_id ? $client->city_id : old('city_id'), ['id' => 'city_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('zip_code', trans('clients.zip_code')) !!}
							{!! Form::text('zip_code',  isset($client) && $client->zip_code ? $client->zip_code : old('zip_code'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('shipping_address', trans('clients.shipping_address')) !!}
							{!! Form::textarea('shipping_address', isset($client) ? $client->shipping_address : old('shipping_address'), ['class' => 'form-control', 'rows' => 2, 'cols' => 40]) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
			@if(!isset($modal_json))
				<div class="box-footer clearfix">
					<button type="button" class="btn btn-success pull-right" onclick="$('#clientFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			@endif
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}
