                  @if (!$order->state->close_order)
                        @if (($histories_list)&&($actions_list))
                        <div class="container-fluid">
                              <div class="well fix-well-button">
                                    @include('layouts.partials.modal',['onlyAction'=>true,'modalLabel'=>trans('orders.register_state'),'link'=>false,'ajaxModal'=>route('order.show_form_state', [$order->id, 'state']), 'modalClass'=>'btn btn-info pull-right', 'modalIcon'=>'fa fa-plus-square-o', 'modalId'=>'modalStates'])
                              </div>
                        </div>
                        @else
                        <div class="callout callout-info">
                              <h4>{{ trans('globals.important') }}!</h4>
                              {{ trans('orders.diagnostics_actions_not_registered') }}
                        </div>
                        @endif
                  @endif
                  <div class="col-md-12">

                        <ul class="timeline">

                              @foreach($histories_list as $date_history => $histories)
                                    <!-- timeline time label -->
                                    <li class="time-label">
                                          <span class="bg-red">
                                                {{ $date_history }}
                                          </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    @foreach($histories as $history)
                                          <!-- timeline item -->
                                          <li>
                                                <i class="fa fa-tasks bg-blue"></i>

                                                <div class="timeline-item">
                                                      <span class="time"><i class="fa fa-clock-o"></i> {{ $history->TimeElapsed }}</span>

                                                      <h3 class="timeline-header"><strong>{{ $history->state->name }}</strong></h3>

                                                      @if (($history->comments->count() > 0) || ($history->state->code == 'received'))
                                                      <div class="timeline-body">
                                                            <ul>
                                                                  @foreach($history->comments as $comment)
                                                                  <li> {{ $comment->comment }} </li>
                                                                  @endforeach
                                                            </ul>
                                                            @endif
                                                            @if ($history->state->code == 'received')
                                                            <div class="btn-group" role="group" aria-label="Accesories"> 
                                                                  @foreach(json_decode($order->accesories_received) as $key => $value)
                                                                        <button type="button" class="btn btn-{{($value == 'no')?'default':'success'}}" data-toggle="tooltip" data-placement="top" title="{{ trans('orders.icons.'.$key.'.name') }}"><i class="{{ trans('orders.icons.'.$key.'.class') }}"></i>
                                                                              <span class="hidden-xs">{{ trans('orders.icons.'.$key.'.name') }}</span>
                                                                        </button> 
                                                                  @endforeach
                                                            </div>
                                                      </div>
                                                      @endif
                                                      <div class="timeline-footer">
                                                            <small><em>{{ trans('globals.registered_by') }}: {{ $history->user->fullName }}</em></small>

                                                            {{-- <a class="btn btn-primary btn-xs">Read more</a>
                                                            <a class="btn btn-danger btn-xs">Delete</a> --}}
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