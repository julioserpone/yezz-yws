
{!! Form::model($order, ['route'=>'order.order_received', 'method'=>'POST', 'role'=>'form', 'name' => 'orderReceived', 'id' => 'orderReceived']) !!}
	<div class="row">
		<div class="form-group col-sm-12">
			{!! Form::hidden('order_id', isset($order) && $order->id ? $order->id : '', array('id' => 'order_id')) !!}
			{!! Form::label('gp_imei', trans('orders.gp_imei')) !!}
			{!! Form::textarea('gp_imei', isset($order->gp_imei) ? $order->gp_imei : old('gp_imei'), ['class' => 'form-control',  'rows' => 2, 'cols' => 40, (isset($order) && ($order->id)) ? 'readonly' : '' ]) !!}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12">
			{!! Form::label('accesories_received', trans('orders.accesories_received')) !!}: 
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-6">
			<input type="checkbox" id="accesories[]" name="accesories[]" class="minimal radio-inline" value="telephone" checked/>  {{ ucwords(trans('globals.accesories.telephone')) }}
		</div>
		<div class="form-group col-sm-6">
			<input type="checkbox" id="accesories[]" name="accesories[]" class="minimal radio-inline" value="battery" /> {{ ucwords(trans('globals.accesories.battery')) }}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-6">
			<input type="checkbox" id="accesories[]" name="accesories[]" class="minimal radio-inline" value="earphone" /> {{ ucwords(trans('globals.accesories.earphone')) }}
		</div>
		<div class="form-group col-sm-6">
			<input type="checkbox" id="accesories[]" name="accesories[]" class="minimal radio-inline" value="cover" />  {{ ucwords(trans('globals.accesories.cover')) }}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-6">
			<input type="checkbox" id="accesories[]" name="accesories[]" class="minimal radio-inline" value="usb_cable" /> {{ ucwords(trans('globals.accesories.usb_cable')) }}
		</div>
		<div class="form-group col-sm-6">
			<input type="checkbox" id="accesories[]" name="accesories[]" class="minimal radio-inline" value="dc_charger" />  {{ ucwords(trans('globals.accesories.dc_charger')) }}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-6">
			<input type="checkbox" id="accesories[]" name="accesories[]" class="minimal radio-inline" value="external_memory" /> {{ ucwords(trans('globals.accesories.external_memory')) }}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12">
			{!! Form::label('comment', trans('orders.comment')) !!}
			{!! Form::text('comment',  old('comment'), ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12">
			<button type="button" class="btn btn-success pull-right" onclick="$('#orderReceived').submit();">
				<i class="fa fa-paper-plane-o"></i>&nbsp; {{ trans('globals.submit') }}
			</button>
		</div>
	</div>
	{!! Form::token() !!}
{!! Form::close() !!}

<script>
    $(function ()
    {
    	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_square-red',
      		radioClass: 'iradio_square-red'
	    });
	});
</script>