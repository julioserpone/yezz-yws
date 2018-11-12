<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ trans('email.orders.order_delivered.case_number', ['order_number' => $order->order_number]) }}</title>
	<style>
	body {
		font-family: sans-serif;
	}
	.page-break {
	    page-break-after: always;
	}
	.paper {
		width: 100%;
		height: 940px;	
		border: 2px solid #000000;
		position: relative;
	}
	.topleft {
	    position: absolute;
	    top: 8px;
	    left: 16px;
	    font-size: 18px;
	}
	.topright {
	    position: absolute;
	    top: 8px;
	    right: 16px;
	    font-size: 18px;
	}
	.bottomleft {
	    position: absolute;
	    bottom: 35px;
	    left: 10px;
	    font-size: 23px;
	    text-align: center;
	}
	.center {
	    position: absolute;
	    left: 0;
	    top: 10%;
	    width: 100%;
	    text-align: center;
	    font-size: 18px;
	}
	.content {
	    position: absolute;
	    padding: 10px;
	    top: 20%;
	    width: 100%;
	    text-align: justify;
	    font-size: 20px;
	}
	.label {
		font-weight: 800;
	}
	.alert {
		color: #FF0000;
	}
	img {
		padding: 10px;
	}
	p {
		margin-top: 0px;
		margin-bottom: 10px;
	}
	.extra_padding {
		margin-bottom: 20px;
	}
	</style>
</head>
<body>
	<div class="paper">
		<div class="topleft">
			<img src="{{ asset('img/logo_yezz_small.png') }}" width="120" height="30" />
		</div>
		<div class="topright">
			<img src="{{ asset('img/logo_niu_small.png') }}" width="80" height="27" />
		</div>
		<div class="center alert">
			<h1>{{ trans('email.orders.order_delivered.case_number', ['order_number' => $order->order_number]) }}</h1>
		</div>
		<div class="content">
			&nbsp;
			<p><span class="label">{{ trans('email.orders.order_delivered.creation_date') }}:</span> {{ Carbon\Carbon::parse($order->order_date)->format('F j, Y') }}</p>
			<p><span class="label">{{ trans('email.orders.order_delivered.authorized_service_center') }}:</span> {{ $order->workshop->description }}</p>
			&nbsp;
			<p><span class="label">{{ trans('email.orders.order_delivered.customer') }}:</span> {{ $order->client->FullName }}</p>
			<p><span class="label">{{ trans('email.orders.order_delivered.address') }}:</span> {{ $order->client->FullShippingAddress }}
			</p>
			<p><span class="label">{{ trans('email.orders.order_delivered.phone_nro1') }}:</span> {{ $order->client->cellphone_number }}</p>
			@if ($order->client->homephone_number)
				<p><span class="label">{{ trans('email.orders.order_delivered.phone_nro2') }}:</span> {{ $order->client->homephone_number }}</p>
			@endif
			<p><span class="label">{{ trans('email.orders.order_delivered.email') }}:</span> {{ $order->client->email }}</p>
			&nbsp;
			<p><span class="label">{{ trans('email.orders.order_delivered.brand') }}:</span> {{ $order->product->brand->description }}</p>
			<p><span class="label">{{ trans('email.orders.order_delivered.model') }}:</span> {{ $order->product->model }}</p>
			<p><span class="label">{{ trans('email.orders.order_delivered.serial') }}:</span> {{ $order->gp_imei }}</p>
			&nbsp;
			<p><span class="label">{{ trans('email.orders.order_delivered.failure_reported') }}:</span> {{ $order->failure_description }}</p>
			
		</div>
		<div class="bottomleft">
			<span class="label alert">{{ trans('email.orders.order_delivered.footer_case') }}</span>
		</div>
	</div>
</body>
</html>