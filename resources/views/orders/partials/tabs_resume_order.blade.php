				<div class="row row_special">
					<div class="col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">{{ trans('globals.section_title.orders.order_data_tab') }} - <strong>{{ $order->order_number }}</strong></h3>
								<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<address>
											<strong>{{ trans('orders.order_date') }}: </strong>{{ $order->order_date->format('d/m/Y') }}<br>
											<strong>{{ trans('globals.created_by') }}: </strong>{{ $order->user->fullName }}<br>
											<strong>{{ trans('globals.updated_at') }}: </strong>{{ $order->updated_at->format('d/m/Y') }}<br>
											<strong>{{ trans('orders.state') }}: </strong>{{ $order->state->name }}<br>
											<strong>{{ trans('orders.product') }}: </strong>{{ $order->product->description }}<br>
										</address>
									</div>
									<div class="col-md-6">
										<address>
											<strong>{{ trans('orders.type_management') }}: </strong>{{ trans('globals.type_management.'.$order->type_management) }}<br>
											@if ((Auth::user()->role == 'admin') || (Auth::user()->role == 'analist'))
												<form id="UpdateTypeManagement" name="UpdateTypeManagement" accept-charset="UTF-8" 
												action="{{ route('order.update_type_management',[$order->id]) }}" method="POST">
													{{ csrf_field() }}
													<button class="btn btn-{{($order->type_management=='warranty')?'success':'danger'}} btn-xs" type="button" onclick="$('#UpdateTypeManagement').submit();">{{ trans('orders.change_type_management') }}</button>
												</form>
											@endif
										@if ($order->tracking)
											<strong>{{ trans('orders.courier') }}: </strong>{{ $order->courier->description }}<br>
											<strong>{{ trans('orders.tracking') }}: </strong>
											
											@if ($method=='POST')
												<form id="OrderTracking" name="OrderTracking" target="blank" accept-charset="UTF-8" 
												action="{{ $url_tracking }}" method="{{ $method }}">
													@foreach ($parameters as $key => $value)
														<input type="hidden" id="{{$key}}" name="{{$key}}" value="{{ ($value==':number_tracking') ? $order->tracking : $value }}" /> 
													@endforeach
													{{ $order->tracking }} 
													<button class="btn btn-default btn-xs" type="button" onclick="$('#OrderTracking').submit();">Tracking</button>
												</form>
											@else
												{{ $order->tracking }}
												<a href="{{ $url_tracking }}" target="blank" class="btn btn-default btn-xs">Tracking</a>
											@endif
											<br>
										@endif
											<a href="{{ route('order.assign_courier', $order->id) }}" class="btn btn-info btn-xs pull-left" role="button"><i class="fa fa-plane"></i>&nbsp;{{ trans('orders.assign_courier') }}</a>
										</address>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">{{ trans('globals.section_title.orders.return_address_information') }}</h3>
								<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<address>
											<strong>{{ trans('orders.country') }}: </strong>{{ $order->country->description }}<br>
											<strong>{{ trans('orders.province') }}: </strong>{{ $order->province->description }}<br>
											<strong>{{ trans('orders.city') }}: </strong>{{ $order->city->description }}<br>

										@if ($order->personal_retreat == 'no')
											<strong>{{ trans('orders.personal_retreat') }}: </strong>{{ $order->personal_retreat }}<br>
											<strong>{{ trans('orders.devolution_zip_code') }}: </strong>{{ $order->devolution_zip_code }}<br>
											<strong>{{ trans('orders.devolution_address') }}: </strong>{{ $order->devolution_address }}
										@endif
										</address>
										@if ($order->personal_retreat == 'yes')
										<div class="callout callout-info">
											<h4>{{ trans('globals.important') }}!</h4>
											{{ trans('orders.remove_cellphone_personally') }}
										</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row row_special">
					<div class="col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">{{ trans('globals.section_title.orders.invoice_information') }}</h3>
								<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<address>
											<strong>{{ trans('orders.gp_num_doc') }}: </strong>{{ $order->gp_num_doc }}<br>
											<strong>{{ trans('orders.gp_invoice_date') }}: </strong>{{ $order->gp_invoice_date }}<br>
											<strong>{{ trans('orders.gp_customer_name') }}: </strong>{{ $order->gp_customer_name }}<br>
											<strong>{{ trans('orders.gp_purchase_date') }}: </strong>{{ $order->gp_purchase_date }}<br>
											<strong>{{ trans('orders.gp_country_name') }}: </strong>{{ $order->gp_country_name }}
										</address>
									</div>
									<div class="col-md-6">
										<address>
											<strong>{{ trans('orders.gp_imei') }}: </strong>{{ $order->gp_imei }}<br>
											<strong>{{ trans('orders.gp_item_code') }}: </strong>{{ $order->gp_item_code }}<br>
											<strong>{{ trans('orders.gp_part_number') }}: </strong>{{ $order->gp_part_number }}<br>
											<strong>{{ trans('orders.gp_brand') }}: </strong>{{ $order->gp_brand }}<br>
											<strong>{{ trans('orders.gp_model') }}: </strong>{{ $order->gp_model }}<br><br>
											@if ($order->client_invoice_doc)
												<a href="{{ route('order.download_document', [$order->id,'invoice','show']) }}" class="btn btn-info btn-xs pull-left" role="button" target="blank"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;{{ trans('globals.show_invoice') }}</a>
											@endif
										</address>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">{{ trans('globals.section_title.orders.equipment_information') }}</h3>
								<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<address>
											<strong>{{ trans('orders.failure_description') }}: </strong>{{ $order->failure_description }}<br><br>
											<strong>{{ trans('orders.failures_list') }}</strong><br>
											<ul>
												@foreach ($order->failures as $item)
													<li>{!! $item->failure->name !!}</li>
												@endforeach
											</ul>
										</address>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>