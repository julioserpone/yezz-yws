
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
							{!! Form::hidden('client_id', isset($client) ? $client->id : old('client_id'), array('id' => 'client_id')) !!}
							{!! Form::hidden('gp_item_code', isset($order) && $order->gp_item_code ? $order->gp_item_code : old('gp_item_code'), array('id' => 'gp_item_code')) !!}
							{!! Form::hidden('gp_item_description', isset($order) && $order->gp_item_description ? $order->gp_item_description : old('gp_item_description'), array('id' => 'gp_item_description')) !!}
							{!! Form::hidden('gp_purchase_date', isset($order) && $order->gp_purchase_date ? $order->gp_purchase_date : old('gp_purchase_date'), array('id' => 'gp_purchase_date')) !!}
							{!! Form::hidden('gp_customer_code', isset($order) && $order->gp_customer_code ? $order->gp_customer_code : old('gp_customer_code'),array('id' => 'gp_customer_code')) !!}
							{!! Form::hidden('gp_customer_name', isset($order) && $order->gp_customer_name ? $order->gp_customer_name : old('gp_customer_name'),array('id' => 'gp_customer_name')) !!}
							{!! Form::hidden('gp_brand', isset($order) && $order->gp_brand ? $order->gp_brand : old('gp_brand'),array('id' => 'gp_brand')) !!}
							{!! Form::hidden('gp_model', isset($order) && $order->gp_model ? $order->gp_model : old('gp_model'),array('id' => 'gp_model')) !!}
							{!! Form::hidden('gp_invoice_date', isset($order) && $order->gp_invoice_date ? $order->gp_invoice_date : old('gp_invoice_date'),array('id' => 'gp_invoice_date')) !!}
							{!! Form::hidden('gp_num_doc', isset($order) && $order->gp_num_doc ? $order->gp_num_doc : old('gp_num_doc'),array('id' => 'gp_num_doc')) !!}
							{!! Form::hidden('gp_country_name', isset($order) && $order->gp_country_name ? $order->gp_country_name : old('gp_country_name'),array('id' => 'gp_country_name')) !!}
							{!! Form::hidden('type_management', isset($order) && $order->type_management ? $order->type_management : 'warranty' , array('id' => 'type_management')) !!}
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
											{!! Form::label('gp_part_number', trans('orders.gp_part_number')) !!}
											{!! Form::text('gp_part_number',  isset($order->gp_part_number) ? $order->gp_part_number : old('gp_part_number'), ['class' => 'form-control', (($edit) ? 'readonly': '')]) !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											<input type="hidden" name="_product_id" id="_product_id" value="{{ isset($order) && $order->product_id ? $order->product_id : old('_product_id') }}">
											{!! Form::label('product_id', trans('orders.product')) !!}
											{!! Form::select('product_id', $products, isset($order) && $order->product_id ? $order->product_id : old('product_id'), ['id' => 'product_id', 'class' => 'form-control select2', 'style' => 'width:100%', (($edit) ? 'disabled': '')]); !!}
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											<input type="hidden" name="_color_id" id="_color_id" value="{{ isset($order) && $order->product->color_id ? $order->product->color_id : old('_color_id') }}">
											{!! Form::label('color_id', trans('products.color')) !!}
											{!! Form::select('color_id', $colors, isset($order) ? $order->product->color_id : old('color_id'), ['id' => 'color_id', 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
										</div>
									</div>
 								</div>
    						</div>
  						</div>
					</div>
					{{-- ////////////////////// IMEI DATA END ////////////////////////--}}
					<div class="row">
						<div class="form-group col-sm-12">
							{!! Form::label('failure_description', trans('orders.failure_description')) !!}
							{!! Form::textarea('failure_description', isset($order->failure_description) ? $order->failure_description : old('failure_description'), ['class' => 'form-control',  'rows' => 2, 'cols' => 40]) !!}
						</div>
					</div>
					<div class="dinamic-list">
						<div class="row">
							<div class="form-group col-sm-12">
								{!! Form::label('failures_list', trans('orders.failure_select')) !!}
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
