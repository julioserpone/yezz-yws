<div class="panel-group hidden-md hidden-lg" id="ClientCollapse" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="ClientSectionCollapse">
			<h4 class="panel-title">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#ClientCollapse" href="#ClientCollapseOne" aria-expanded="false" aria-controls="ClientCollapseOne">
					<i class="fa fa-user" aria-hidden="true"></i> {{ trans('globals.section_title.clients.client_information') }}
				</a>
			</h4>
		</div>
		<div id="ClientCollapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ClientSectionCollapse">
			<div class="panel-body">
				<address>
					<h4><strong>{{ ($order->client->type == 'person') ? $order->client->person->full_name : $order->client->business->description }}</strong></h4>
					{{ $order->client->shipping_address }}<br>
					<strong>{{ trans('clients.country') }}: </strong>({{ $order->client->country->calling_code }}) &nbsp;{{ $order->client->country->description }}<br>
					<strong>{{ trans('clients.contact_name') }}: </strong>{{ $order->client->contact_name }}<br>
					<strong>{{ trans('clients.cellphone_number') }}: </strong>{{ $order->client->cellphone_number }}<br>
					<strong>{{ trans('clients.type') }}: </strong>{{ $order->client->type }}
				</address>
			</div>
		</div>
	</div>
</div>

<div class="panel-group hidden-md hidden-lg" id="WorkshopCollapse" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="WorkshopSectionCollapse">
			<h4 class="panel-title">
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#WorkshopCollapse" href="#WorkshopCollapseOne" aria-expanded="false" aria-controls="WorkshopCollapseOne">
					<i class="fa fa-industry" aria-hidden="true"></i> {{ trans('globals.section_title.workshops.workshop_information') }}
				</a>
			</h4>
		</div>
		<div id="WorkshopCollapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="WorkshopSectionCollapse">
			<div class="panel-body">
				<address>
					<h4><strong>{{ $order->workshop->description }}</strong></h4>
					{{ $order->workshop->address }}<br>
					<strong>{{ trans('workshops.country') }}: </strong>{{ $order->workshop->country->description }}<br>
					<strong>{{ trans('workshops.contact_name') }}: </strong>{{ $order->workshop->contact_name }}<br>
					<strong>{{ trans('workshops.officephone_number') }}: </strong>{{ $order->workshop->officephone_number }}<br>
					<strong>{{ trans('workshops.type') }}: </strong>{{ $order->workshop->type }}
				</address>
			</div>
		</div>
	</div>
</div>

	
<div class="row hidden-xs hidden-sm">
	<div class="col-xs-12 col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h4><i class="fa fa-user" aria-hidden="true"></i> {{ trans('globals.section_title.clients.client_information') }}</h4>
			</div>
			<div class="panel-body">
				<address>
					<h4><strong>{{ ($order->client->type == 'person') ? $order->client->person->full_name : $order->client->business->description }}</strong></h4>
					{{ $order->client->shipping_address }}<br>
					<strong>{{ trans('clients.country') }}: </strong>({{ $order->client->country->calling_code }}) &nbsp;{{ $order->client->country->description }}<br>
					<strong>{{ trans('clients.contact_name') }}: </strong>{{ $order->client->contact_name }}<br>
					<strong>{{ trans('clients.cellphone_number') }}: </strong>{{ $order->client->cellphone_number }}<br>
					<strong>{{ trans('clients.type') }}: </strong>{{ $order->client->type }}<br>
				</address>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h4><i class="fa fa-industry" aria-hidden="true"></i> {{ trans('globals.section_title.workshops.workshop_information') }}</h4>
			</div>
			<div class="panel-body">
				<address>
					<h4><strong>{{ $order->workshop->description }}</strong></h4>
					{{ $order->workshop->address }}<br>
					<strong>{{ trans('workshops.country') }}: </strong>{{ $order->workshop->country->description }}<br>
					<strong>{{ trans('workshops.contact_name') }}: </strong>{{ $order->workshop->contact_name }}<br>
					<strong>{{ trans('workshops.officephone_number') }}: </strong>{{ $order->workshop->officephone_number }}<br>
					<strong>{{ trans('workshops.type') }}: </strong>{{ $order->workshop->type }}
				</address>				
			</div>
		</div>
	</div>
</div> 