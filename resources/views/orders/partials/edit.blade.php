		<div class="col-sm-6">
			<div class="box box-info">
				<div class="box-header with-border">
					<i class="fa fa-user"></i>&nbsp;{{ trans('globals.section_title.orders.equipment_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::hidden('edit', $edit, array('id' => 'edit')) !!}
							{!! Form::hidden('order_number', isset($order) && $order->order_number ? $order->order_number : old('order_number'), array('id' => 'order_number')) !!}
							{!! Form::hidden('gp_item_code', isset($order) && $order->gp_item_code ? $order->gp_item_code : old('gp_item_code'), array('id' => 'gp_item_code')) !!}
							{!! Form::hidden('gp_purchase_date', isset($order) && $order->gp_purchase_date ? $order->gp_purchase_date : old('gp_purchase_date'), array('id' => 'gp_purchase_date')) !!}
							{!! Form::hidden('gp_customer_code', isset($order) && $order->gp_customer_code ? $order->gp_customer_code : old('gp_customer_code'),array('id' => 'gp_customer_code')) !!}
							{!! Form::hidden('gp_country_name', isset($order) && $order->gp_country_name ? $order->gp_country_name : old('gp_country_name'),array('id' => 'gp_country_name')) !!}

							<input type="hidden" name="_client_id" id="_client_id" value="{{ old('client_id') }}">
							{!! Form::label('client_id', trans('orders.client')) !!}
							{!! Form::select('client_id', $clients, isset($order) && $order->client_id ? $order->client_id : old('client_id'), ['id' => 'client_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							@if(!$edit)
								<button class="btn btn-sm btn-success bootstrap-modal-form-open" type="button" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;{{ trans('globals.add_new') }}&nbsp;{{ trans('globals.client') }}</button>	
							@endif
							<button class="btn btn-sm hidden-xs btn-primary" type="button" data-toggle="modal" data-target="#ModalSearchClients"><i class="glyphicon glyphicon-search"></i>&nbsp;{{ trans('globals.search') }}&nbsp;{{ trans('globals.client') }}</button>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('type_management', trans('orders.type_management')) !!}: 

							{!! Form::radio('type_management', 'warranty', isset($order->type_management) && $order->type_management == 'warranty' ? true : false, ['class' => 'minimal radio-inline']) !!} {{ ucwords(trans('globals.type_management.warranty')) }}
							{!! Form::radio('type_management', 'out_of_warranty', isset($order->type_management) && $order->type_management == 'out_of_warranty' ? true : false, ['class' => 'minimal radio-inline']) !!} {{ ucwords(trans('globals.type_management.out_of_warranty')) }}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('gp_imei', trans('orders.gp_imei')) !!}
							<div class="input-group">
								{!! Form::text('gp_imei',  isset($order->gp_imei) ? $order->gp_imei : old('gp_imei'), ['class' => 'form-control', (($edit) ? 'readonly': '') ]) !!}
	  							<div class="input-group-btn">
	    							<!-- Buttons -->
	    							@if(!$edit)
	    								<button class="btn btn-info" name="searchProduct" id="searchProduct" type="button"><i class="glyphicon glyphicon-search"></i></button>
	    								<button class="btn btn-danger" name="recycle" id="recycle" type="button"><i class="glyphicon glyphicon-remove"></i></button>
	    							@endif
	  							</div>
	  						</div>
						</div>
					</div>
	
					{{-- //////////////////////// IMEI DATA ////////////////////////--}}

					<div class="panel-group" id="imeiDataCollapse" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="imeiDataSection">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#imeiDataCollapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										{{ trans('globals.show_more_information') }}
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="imeiDataSection">
								<div class="panel-body">

									<div class="row">
										<div class="form-group col-sm-12">
											<input type="hidden" name="_product_id" id="_product_id" value="{{ isset($order) && $order->product_id ? $order->product_id : old('_product_id') }}">
											{!! Form::label('product_id', trans('orders.product')) !!}
											{!! Form::select('product_id', $products, isset($order) && $order->product_id ? $order->product_id : old('_product_id'), ['id' => 'product_id', 'class' => 'form-control select2', 'style' => 'width:100%', (($edit) ? 'disabled': '')]); !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											{!! Form::label('gp_customer_name', trans('orders.gp_customer_name')) !!}
											{!! Form::text('gp_customer_name',  isset($order->gp_customer_name) ? $order->gp_customer_name : old('gp_customer_name'), ['class' => 'form-control', (($edit) ? 'readonly': '')]) !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											{!! Form::label('gp_item_description', trans('orders.gp_item_description')) !!}
											{!! Form::text('gp_item_description',  isset($order->gp_item_description) ? $order->gp_item_description : old('gp_item_description'), ['class' => 'form-control', (($edit) ? 'readonly': '')]) !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											{!! Form::label('gp_brand', trans('orders.gp_brand')) !!}
											{!! Form::text('gp_brand',  isset($order->gp_brand) ? $order->gp_brand : old('gp_brand'), ['class' => 'form-control', (($edit) ? 'readonly': '')]) !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											{!! Form::label('gp_model', trans('orders.gp_model')) !!}
											{!! Form::text('gp_model',  isset($order->gp_model) ? $order->gp_model : old('gp_model'), ['class' => 'form-control', (($edit) ? 'readonly': '')]) !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											{!! Form::label('gp_part_number', trans('orders.gp_part_number')) !!}
											{!! Form::text('gp_part_number',  isset($order->gp_part_number) ? $order->gp_part_number : old('gp_part_number'), ['class' => 'form-control', (($edit) ? 'readonly': '')]) !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											{!! Form::label('gp_invoice_date', trans('orders.gp_invoice_date')) !!}
											{!! Form::text('gp_invoice_date',  isset($order->gp_invoice_date) ? $order->gp_invoice_date : old('gp_invoice_date'), ['class' => 'form-control', (($edit) ? 'readonly': '')]) !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											{!! Form::label('gp_num_doc', trans('orders.gp_num_doc')) !!}
											{!! Form::text('gp_num_doc',  isset($order->gp_num_doc) ? $order->gp_num_doc : old('gp_num_doc'), ['class' => 'form-control', (($edit) ? 'readonly': '')]) !!}
										</div>
									</div>
 								</div>
    						</div>
  						</div>
					</div>
					{{-- ////////////////////// IMEI DATA END ////////////////////////--}}
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('client_invoice_number', trans('orders.client_invoice_number')) !!}
							{!! Form::text('client_invoice_number',  isset($order->client_invoice_number) ? $order->client_invoice_number : old('client_invoice_number'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('client_invoice_date', trans('orders.client_invoice_date')) !!}
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								{!! Form::text('client_invoice_date', isset($order) && $order->client_invoice_date ? $order->client_invoice_date->format('d/m/Y') : old('client_invoice_date'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-{{($edit)?6:12}}">
							{!! Form::label('client_invoice_doc', trans('orders.client_invoice_doc')) !!}
							{!! Form::file('client_invoice_doc', ['class' => 'form-control']) !!}

							{!! Form::hidden('_client_invoice_doc', isset($order) && $order->client_invoice_doc ? $order->client_invoice_doc : old('_client_invoice_doc'),array('id' => '_client_invoice_doc')) !!}

						</div>
					@if (($edit)&&($order->client_invoice_doc))
						<div class="form-group col-sm-{{($edit)?6:12}} center-block">
							&nbsp;<a href="{{ route('order.download_document', [$order->id,'invoice','show']) }}" class="btn btn-info center-block" role="button" target="blank"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;{{ trans('globals.show_invoice') }}</a>
						</div>
					@endif
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('failure_description', trans('orders.failure_description')) !!}
							{!! Form::textarea('failure_description', isset($order->failure_description) ? $order->failure_description : old('failure_description'), ['class' => 'form-control',  'rows' => 2, 'cols' => 40]) !!}
						</div>
					</div>
					<div class="dinamic-list">
						<div class="row">
							<div class="form-group col-sm-12">
								{!! Form::label('failures_list', trans('orders.failures_list')) !!}
								{!! Form::select('failure', $failures, old('failure'), ['id' => 'failure', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
							</div>
						</div>
								
						<div class="row">
							<div class="form-group col-sm-12">
								<button type="button" class="btn btn-success btn-sm add"><i class="glyphicon glyphicon-log-in"></i>&nbsp;{{ trans('globals.insert') }}&nbsp;{{ trans('orders.failure') }}</button>
							</div>
						</div>
						<div class="row">
							<script class="template-mirror" type="text/x-jQuery-tmpl">
								<input type="hidden" name="failures_list_temp[]" id="failures_list_temp[]" value="${id},${failure}">
							</script>
							
							<ul id="container-list">
								{{-- Aqui se imprimen los items agregados desde la lista --}}
								@php
									$failures_list = (old('failures_list') ? : \Session::get('failures_list'))
								@endphp
								@if ($failures_list)
									@foreach ($failures_list as $key => $value)
										<li class="element r-ele-{{$key}}">{{ $value['description'] }} 
										<input type="hidden" name="failures_list[]" id="failures_list[]" value="{{$value['id']}},{{$value['description']}}" class="r-ele-{{$key}}">
										<button type="button" class="btn btn-danger btn-xs remove">{{ trans('globals.delete') }}</button></li>
									@endforeach
								@endif
								<script class="template" type="text/x-jQuery-tmpl">
									<li>${failure}
									<input type="hidden" name="failures_list[]" id="failures_list[]" value="${id},${failure}">
									<button type="button" class="btn btn-danger btn-xs remove">	{{ trans('globals.delete') }}</button></li>
								</script>
							</ul>
							<div id="mirror-container-list">
							@if ($failures_list)
								@foreach ($failures_list as $key => $value)
									<input type="hidden" name="failures_list_temp[]" id="failures_list_temp[]" value="{{$value['id']}},{{$value['description']}}" class="r-ele-{{$key}}">
								@endforeach
							@endif
							</div>
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer hidden-sm hidden-lg clearfix">
					<button type="button" class="btn btn-success pull-right" onclick="$('#orderFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}

		<div class="col-sm-6">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-lock"></i>&nbsp;{{ trans('globals.section_title.orders.return_address_information') }}
				</div>
				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('personal_retreat', trans('orders.personal_retreat')) !!}: 

							{!! Form::radio('personal_retreat', 'yes', ((isset($order->personal_retreat) && $order->personal_retreat == 'yes') || (!$edit)) ? true : false, ['class' => 'minimal radio-inline']) !!} {{ ucwords(trans('globals.verification.yes')) }}
							{!! Form::radio('personal_retreat', 'no', isset($order->personal_retreat) && $order->personal_retreat == 'no' ? true : false, ['class' => 'minimal radio-inline']) !!} {{ ucwords(trans('globals.verification.no')) }}
						</div>
					</div>
					@if (!$edit)
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('email_notify', trans('orders.email_notify')) !!}: 

							{!! Form::radio('email_notify', 'yes', true, ['class' => 'minimal radio-inline']) !!} {{ ucwords(trans('globals.verification.yes')) }}
							{!! Form::radio('email_notify', 'no', false, ['class' => 'minimal radio-inline']) !!} {{ ucwords(trans('globals.verification.no')) }}
						</div>
					</div>
					@endif
					<div class="row personal">
						<div class="form-group col-sm-12">
							{!! Form::label('order_country_id', trans('orders.country')) !!}
							{!! Form::select('order_country_id', $countries, isset($order) && $order->country_id ? $order->country_id : old('order_country_id'), ['id' => 'order_country_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<input type="hidden" name="_order_province_id" id="_order_province_id" value="{{ old('order_province_id') }}">
							{!! Form::label('order_province_id', trans('orders.province')) !!}
							{!! Form::select('order_province_id', $provinces, isset($order) && $order->province_id ? $order->province_id : old('order_province_id'), ['id' => 'order_province_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<input type="hidden" name="_order_city_id" id="_order_city_id" value="{{ old('order_city_id') }}">
							{!! Form::label('order_city_id', trans('orders.city')) !!}
							{!! Form::select('order_city_id', $cities, isset($order) && $order->city_id ? $order->city_id : old('order_city_id'), ['id' => 'order_city_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!} 
						</div>
					</div>
					<div class="row personal_retreat">
						<div class="form-group col-sm-12">
							{!! Form::label('devolution_zip_code', trans('orders.devolution_zip_code')) !!}
							{!! Form::text('devolution_zip_code',  isset($order) && $order->devolution_zip_code ? $order->devolution_zip_code : old('devolution_zip_code'), ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="row personal_retreat">
						<div class="form-group col-sm-12">
							{!! Form::label('devolution_address', trans('orders.devolution_address')) !!}
							{!! Form::textarea('devolution_address', isset($order->devolution_address) ? $order->devolution_address : old('devolution_address'), ['class' => 'form-control',  'rows' => 2, 'cols' => 40]) !!}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<input type="hidden" name="_workshop_id" id="_workshop_id" value="{{ old('workshop_id') }}">
							{!! Form::label('workshop_id', trans('orders.workshop_to_send')) !!}
							{!! Form::select('workshop_id', $workshops, isset($order) && $order->workshop_id ? $order->workshop_id : old('workshop_id'), ['id' => 'workshop_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
						</div>
					</div>
				</div> {{-- box-body --}}
				<div class="box-footer clearfix">
					<button type="button" class="btn btn-success pull-right" onclick="$('#orderFrm').submit();">
						<i class="fa fa-paper-plane-o"></i>&nbsp;
						{{ trans('globals.submit') }}
					</button>
				</div> {{-- box-footer --}}
			</div> {{-- box box-info --}}
		</div> {{-- col-sm-6 --}}
