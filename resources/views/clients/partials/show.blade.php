		<div class="col-sm-6">
			<div class="box box-info">
				<div class="box-header with-border">
					<i class="fa fa-user"></i>&nbsp;{{ trans('globals.section_title.clients.personal_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_type', trans('clients.type')) !!}:
							{!! Form::radio('mv_type_person', 'person', false, ['class' => 'minimal radio-inline', 'id' => 'mv_type_person']) !!} {{ trans('globals.type_client.person') }}
							{!! Form::radio('mv_type_business', 'business', false, ['class' => 'minimal radio-inline', 'id' => 'mv_type_business']) !!} {{ trans('globals.type_client.business') }}

							{!! Form::hidden('modal_client_id', '', array('id' => 'modal_client_id')) !!}
						</div>
					</div>
					<div class="row mvd_person">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_identification', trans('clients.identification')) !!}
							{!! Form::text('mv_identification',  '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row mvd_person">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_first_name', trans('clients.first_name')) !!}
							{!! Form::text('mv_first_name',  '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row mvd_person">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_last_name', trans('clients.last_name')) !!}
							{!! Form::text('mv_last_name', '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row mvd_business">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_code_identification', trans('clients.identification')) !!}
							{!! Form::text('mv_code_identification', '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row mvd_business">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_description', trans('clients.description')) !!}
							{!! Form::text('mv_description', '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row mvd_business">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_contact_name', trans('clients.contact_name')) !!}
							{!! Form::text('mv_contact_name',  '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_cellphone_number', trans('clients.cellphone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('mv_cellphone_number', '', ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_homephone_number', trans('clients.homephone_number')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								{!! Form::text('mv_homephone_number', '', ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_email', trans('clients.email')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope-o"></i>
								</div>
								{!! Form::email('mv_email', '', ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mvl_status', trans('globals.status')) !!}
							{!! Form::select('mvl_status', $status, '', ['class' => 'form-control', 'style' => 'width:100%']); !!}
						</div>
					</div>
				</div> {{-- box-body --}}
			@if(isset($modal_view))
				<div class="box-footer hidden-sm hidden-lg clearfix">
					<button type="button" class="btn btn-success pull-right sendDataToForm">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit_continue') }}
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
							{!! Form::label('mvl_country_id', trans('clients.country')) !!}
							{!! Form::text('mvl_country_id', '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mvl_province_id', trans('clients.province')) !!}
							{!! Form::text('mvl_province_id', '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mvl_city_id', trans('clients.city')) !!}
							{!! Form::text('mvl_city_id', '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_zip_code', trans('clients.zip_code')) !!}
							{!! Form::text('mv_zip_code', '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('mv_shipping_address', trans('clients.shipping_address')) !!}
							{!! Form::textarea('mv_shipping_address', '', ['class' => 'form-control', 'rows' => 2, 'cols' => 40]) !!}
						</div>
					</div>
				</div> {{-- box-body --}}
			@if(isset($modal_view))
				<div class="box-footer clearfix">
					<button type="button" class="btn btn-success pull-right sendDataToForm">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit_continue') }}
					</button>
				</div> {{-- box-footer --}}
			@endif
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}
