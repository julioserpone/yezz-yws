
{!! Form::model($order, ['route'=>['order.upload_attachment',$order->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'orderFrmAttachment', 'id' => 'orderFrmAttachment', 'files' => true]) !!}
	<div class="row">
		<div class="form-group col-sm-12">
			{!! Form::label('order_attachment', trans('orders.order_attachment')) !!}
			{!! Form::file('order_attachment', ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12">
			{!! Form::label('comment_doc', trans('orders.comment_doc')) !!}
			{!! Form::text('comment_doc',  old('comment_doc'), ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12">
			<button type="button" class="btn btn-success pull-right" onclick="$('#orderFrmAttachment').submit();">
				<i class="fa fa-paper-plane-o"></i>&nbsp; {{ trans('globals.submit') }}
			</button>
		</div>
	</div>
	{!! Form::token() !!}
{!! Form::close() !!}