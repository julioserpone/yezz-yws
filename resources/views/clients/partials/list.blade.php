		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<table id="datagrid" class="table table-bordered table-hover dataTable" role="grid">
				        <thead>
				            <tr>
				                <th class="text-center query">{{ trans('clients.full_name') }}</th>
				            @if($modal_view)
				            	<th class="text-center query">{{ trans('clients.country') }}</th>
				            	<th class="text-center query">{{ trans('clients.province') }}</th>
				            	<th class="text-center query">{{ trans('clients.city') }}</th>
				            @else
				               	<th class="text-center">{{ trans('globals.status') }}</th>
				            @endif
				               	<th class="text-center">{{ trans('globals.actions') }}</th>
				            </tr>
				        </thead>
				        <tfoot>
				            <tr>
				                <th class="text-center">{{ trans('clients.full_name') }}</th>
				            @if($modal_view)
				            	<th class="text-center">{{ trans('clients.country') }}</th>
				            	<th class="text-center">{{ trans('clients.province') }}</th>
				            	<th class="text-center">{{ trans('clients.city') }}</th>
				            @else
				               	<th class="text-center">{{ trans('globals.status') }}</th>
				            @endif
				               	<th class="text-center">{{ trans('globals.actions') }}</th>
				            </tr>
				        </tfoot>
				        <tbody>
				        	@foreach ($clients_grid as $client)
					            <tr>
					                <td>
					                	@if($client->type == 'person')
					                		<i class="glyphicon glyphicon-user"></i>&nbsp; 
					                		@if($modal_view)
					                			<a name="selClientList{{$client->id}}" data="{{$client->id}}" href="#">{{ $client->person->full_name }}</a>
					                		@else
					                			{{ $client->person->full_name }}
					                		@endif
					                	@else
					                		<i class="glyphicon glyphicon-briefcase"></i>&nbsp; 
					                		@if($modal_view)
					                			<a name="selClientList{{$client->id}}" data="{{$client->id}}" href="#">{{ $client->business->description }}</a>
					                		@else
					                			{{ $client->business->description }}
					                		@endif
					                	@endif
					                </td>
					            @if($modal_view)
					            	<td class="text-center">{{ $client->country->description}}</td>
					            	<td class="text-center">{{ $client->province->description}}</td>
					            	<td class="text-center">{{ $client->city->description}}</td>
					            	<td class="text-center">
					            		<button class="btn btn-xs btn-info" name="getDataClient{{$client->id}}" role="button" data="{{$client->id}}""><i class="glyphicon glyphicon-search"></i>&nbsp;{{ trans('globals.show') }}</a>
					            	</td>
								@else
					                <td class="text-center"><label class = "{{ trans('globals.status_class.'.$client->status) }}">{{ ucfirst($client->status) }}</label></td>
					                <th class="text-center">
					                	<a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
					                	<a href="{{ route('client.change_status',[$client->id, $client->status]) }}" class="btn btn-{{ ($client->status=='active')?'danger':'success' }} btn-xs"><i class="glyphicon glyphicon-off"></i></a>
					                </th>
								@endif
					            </tr>
				            @endforeach
				        </tbody>
				    </table>
				</div>
			</div>
		</div>