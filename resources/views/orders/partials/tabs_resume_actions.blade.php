@if (($order->allowChangeState()) && (Auth::user()->allowChangeState()))
<div class="container-fluid">
	<div class="well fix-well-button">
		@include('layouts.partials.modal',['onlyAction'=>true,'modalLabel'=>trans('orders.register_diagnostic_action'),'link'=>false,'ajaxModal'=>route('order.show_form_state', [$order->id]), 'modalClass'=>'btn btn-default pull-right', 'modalIcon'=>'fa fa-plus-square-o', 'modalId'=>'modalStates'])
	</div>
</div>
@endif
<div class="container-fluid">
	<div class="col-md-12">
		<ul class="timeline">
			<?php 
				$found = false;
				$possible = false;
			?>
			@foreach($histories_list as $date_history => $histories)
			<!-- timeline time label -->
			<li class="time-label">
				<span class="bg-red">
					{{ $date_history }}
				</span>
			</li>
			<!-- /.timeline-label -->
			@foreach($histories as $key => $history)
			<!-- timeline item -->
			{{-- Si no he llegado al primer estado, entonces puedo mostrar posiblemente el boton para eliminar --}}
			<?php $possible = (($key < count($order->histories) - 1) && ($history->deleted_at == null)); ?>
			<li>
				<i class="fa fa-tasks bg-blue"></i>

				<div class="timeline-item">
					<span class="time {{ ($history->deleted_at != null)?'state_deleted_title':''}}"><i class="fa fa-clock-o"></i> {{ $history->TimeElapsed }}</span>

					<h3 class="timeline-header {{ ($history->deleted_at != null)?'state_deleted_title':''}}">
						<strong>
							{{ $history->state->name }} 
						</strong>
						@if ($history->deleted_at)
							<p>
								<span class="state_deleted_date">
									{{ trans('globals.deleted_by') }}: {{ $history->deletedBy->fullName }} ({{ $history->deleted_at->format('Y-m-d h:i:s A') }})
								</span>
							</p>
						@endif
						{{-- Opcion para eliminar estado (ordenado del ultimo al primero) --}}
						@if (($possible) && (!$found) && (Auth::user()->allowDeleteState()))
							<a class="btn btn-danger btn-xs" type="button" name="executeDelete" url="{{ route('order.delete.state', [$order->id]) }}" data="{{ $history->id }}"><i class="fa fa-times"></i>{{ trans('globals.delete') }}</a>
							<?php $found = true; ?>
						@endif
					</h3>
					{{--  Si el estatus tiene comentarios, diagnosticos o acciones --}}
					@if (($history->comments->count() > 0) || ($history->state->code == 'received') || ($history->diagnostics->count() > 0)  || ($history->actions->count() > 0))
					<div class="timeline-body">
						@if($history->state->code != 'received')

						<div class="row">
							<div class="col-md-6">
								<div class="panel-group" id="diagnostics{{$history->state->id}}a" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="diagnosticsDataSection{{$history->state->id}}a">
											<h4 class="panel-title">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#diagnostics{{$history->state->id}}a" href="#collapse{{$history->state->id}}a" aria-expanded="false" aria-controls="collapse{{$history->state->id}}a">
													{{ trans('orders.diagnostics') }}
												</a>
											</h4>
										</div>

										<div id="collapse{{$history->state->id}}a" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="diagnosticsDataSection{{$history->state->id}}a">
											<div class="panel-body">
												<ul>
													@if($history->diagnostics->count() == 0)
													<li>{{ trans('orders.no_diagnostics') }}</li>

													@endif
													@foreach($history->diagnostics as $diagnostic)
													<li>{{$diagnostic->diagnostic->name}}</li>
													@endforeach
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="panel-group" id="diagnostics{{$history->state->id}}b" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="diagnosticsDataSection{{$history->state->id}}b">
											<h4 class="panel-title">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#diagnostics{{$history->state->id}}b" href="#collapse{{$history->state->id}}b" aria-expanded="false" aria-controls="collapse{{$history->state->id}}b">
													{{ trans('orders.actions') }}
												</a>
											</h4>
										</div>

										<div id="collapse{{$history->state->id}}b" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="diagnosticsDataSection{{$history->state->id}}b">
											<div class="panel-body">
												<ul>
													@if($history->actions->count() == 0)
													<li>{{ trans('orders.no_actions') }}</li>
													@endif
													@foreach($history->actions as $action)
													<li>{{$action->action->name}}</li>
													@endforeach
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif
						<ul>
							@foreach($history->comments as $comment)
							<li> {{ $comment->comment }} </li>
							@endforeach
						</ul>
						
						@if ($history->state->code == 'received')
						<div class="btn-group" role="group" aria-label="Accesories"> 
							@foreach(json_decode($order->accesories_received) as $key => $value)
							<button type="button" class="btn btn-{{($value == 'no')?'default':'success'}}" data-toggle="tooltip" data-placement="top" title="{{ trans('orders.icons.'.$key.'.name') }}"><i class="{{ trans('orders.icons.'.$key.'.class') }}"></i>
								<span class="hidden-xs">{{ trans('orders.icons.'.$key.'.name') }}</span>
							</button> 
							@endforeach
						</div>
						@endif
					</div><!-- End timeline body-->
					@endif
					<div class="timeline-footer">
						<small><em>{{ trans('globals.registered_by') }}: {{ $history->user->fullName }}</em></small>
					</div>
				</div>
			</li>
			@endforeach
			@endforeach
			<!-- END timeline item -->
			<li>
				<i class="fa fa-clock-o bg-gray"></i>
			</li>
		</ul>
	</div>
</div>



