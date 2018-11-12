@extends('layouts.app')

@section('htmlheader_title')
{{ trans('globals.section_title.orders.service_order').' #'.$order->order_number }}
@endsection

@section('contentheader_title')
<strong>{{ trans('globals.section_title.orders.service_order').' #'.$order->order_number }}</strong>
@endsection

@section('cssCustoms')
<link href = "{{ asset('/akkargroup-bower/animate.css/animate.min.css') }}" rel = "stylesheet" type="text/css" />
<link href = "{{ asset('/akkargroup-bower/sweetalert/dist/sweetalert.css') }}" rel = "stylesheet" type="text/css" />
<link href = "{{ asset('/plugins/iCheck/all.css') }}" rel = "stylesheet" type="text/css" />
<link href = "{{ asset('/css/tabs-rounded.css') }}" rel = "stylesheet" type="text/css" />
@endsection


@section('main-content')

@include('orders.partials.resume_order_top',[$order])

<div class="row">
	<div class="board">
		<div class="board-inner">
			<ul class="nav nav-tabs" id="myTab">
				<div class="liner"></div> 
				<li class="active text-center">
					<span class="visible-md visible-lg inline-tab-label">{{ trans('globals.section_title.orders.order_data_tab') }}</span> 
					<a href="#order_data" data-toggle="tab" title="{{ trans('globals.section_title.orders.order_data_tab') }}">

						<span class="round-tabs one">
							<i class="fa fa-folder-open" aria-hidden="true"></i>

						</span>
					</a>
				</li>
				<li class="text-center">
					<span class="visible-md visible-lg inline-tab-label">{{ trans('globals.section_title.orders.actions_diagnostics_tab') }}</span> 
					<a href="#comments" data-toggle="tab" title="{{ trans('globals.section_title.orders.actions_diagnostics_tab') }}">
						<span class="round-tabs three">
							<i class="fa fa-tasks" aria-hidden="true"></i>
						</span> 
					</a>
				</li>
				<li class="text-center pull-right">
					<span class="visible-md visible-lg inline-tab-label">{{ trans('globals.section_title.orders.documents_tab') }}</span> 
					<a href="#documents" data-toggle="tab" title="{{ trans('globals.section_title.orders.documents_tab') }}">
						<span class="round-tabs two">
							<i class="fa fa-file" aria-hidden="true"></i></i>
						</span> 
					</a>
				</li>
				<li class="text-center pull-right">
					<span class="visible-md visible-lg inline-tab-label">{{ trans('globals.section_title.orders.notes_tab') }}</span> 
					<a href="#notes" data-toggle="tab" title="{{ trans('globals.section_title.orders.notes_tab') }}">
						<span class="round-tabs five">
							<i class="fa fa-sticky-note" aria-hidden="true"></i>
						</span>
					</a>
				</li>
			</ul>
		</div>

		<div class="tab-content">
			<div class="tab-pane fade in active" id="order_data">
				@include('orders.partials.tabs_resume_order',[$order, $parameters])
			</div>
			<div class="tab-pane fade" id="comments">
				@include('orders.partials.tabs_resume_actions',[$order])
			</div>
			<div class="tab-pane fade" id="notes">
				@include('orders.partials.tabs_resume_notes',[$order])
			</div>
			<div class="tab-pane fade" id="documents">
				@include('orders.partials.tabs_resume_documents',[$order])
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

@include('layouts.partials.modal',['onlyModal'=>true,'modalTitle'=>trans('orders.upload_file'),'modalId'=>'modalAttachments'])
@include('layouts.partials.modal',['onlyModal'=>true,'modalTitle'=>trans('orders.register_state'),'modalId'=>'modalStates'])

@endsection

@include('layouts.partials.message')

@section ('jsCustoms')
@parent
<script src = "{{ asset('/akkargroup-bower/moment/moment.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/akkargroup-bower/sweetalert/dist/sweetalert.min.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/akkargroup-bower/jquery-tmpl/jquery.tmpl.min.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/iCheck/icheck.min.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/daterangepicker/daterangepicker.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/js/jquery.repeter.js') }}" type = "text/javascript"></script>

@endsection

@section ('jQueryScripts')
<script>
	$(function()
	{
		//tooltips for tabs
		$('a[title]').tooltip();

		$("[name^='executeDelete']").click(function(e){
			e.preventDefault();
			var id = $(this).attr("data");
			var url = $(this).attr("url");
			data = {id: id};
			token = "{{ csrf_token() }}";

			swal({   
				title: "{{ trans('orders.order_delete_state_title') }}",
				text: "{{ trans('orders.order_delete_state_msg') }}",   
				type: "info",   
				showCancelButton: true,   
				closeOnConfirm: false,   
				showLoaderOnConfirm: true, 
			}, function(){

				$.ajax({
	                url: url,
	                headers: {'X-CSRF-TOKEN': token},
	                data: data,
	                type: 'POST',
	                datatype: 'JSON',
	                success: function (response) {
	                	if (response.status == 422) {
	                		var errors = $.parseJSON(response.responseText);
	                		swal("Error", errors, "error");
	                	} else {
	                		swal({
	                			title: "{{ trans('globals.success_alert_title') }}", 
	                			text: "{{ trans('orders.order_updated', ['order_number' => $order->order_number]) }}", 
	                			type: "success"
	                		}, function(r)  {
	                			//actualizar pagina
	                			window.location.href = response.url;
	                		});
	                	}
	                }
	            });
				
			});

		});
	});

	$(document).on('click', '.panel-heading span.clickable', function(e){
		var $this = $(this);
		if(!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}
	});
	(function($){
		$.fn.hasEvent = function(event){
			if(!this.length || !event){
				return false;
			}
			event = (event + '').split('.');
			var d = $._data ? $._data($(this)[0], 'events') : $(this).data('events'),
			a = [],
			e = event[0],
			n = event[1],
			x = 0,
			y, z;
			if(d && e == ''){
				for(y in d){
					for(z in d[y]){
						if(d[y][z].namespace == n){
							a[x] = y;
							x ++;
						}
					}
				}
				if(!a.length){
					return false;
				}
				return a;
			}
			if(d && d[e]){
				if(n){
					for(y in d[e]){
						if(d[e][y].namespace == n){
							return true
						}
					}
					return false;
				}
				return true;
			}
			return false;
		};
	})(jQuery);
</script>
@endsection


