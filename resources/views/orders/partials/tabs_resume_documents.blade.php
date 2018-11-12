				<div class="container-fluid">
					<div class="well fix-well-button">
						@include('layouts.partials.modal',['onlyAction'=>true,'modalLabel'=>trans('orders.upload_file'),'link'=>false,'ajaxModal'=>route('order.show_form_attachment', [$order->id]), 'modalClass'=>'btn btn-info pull-right', 'modalId'=>'modalAttachments'])
					</div> 
						
					<div class="row">

					@foreach($order->attachments as $attachment)
						<div class="col-xs-18 col-sm-6 col-md-3">
							<div class="thumbnail">
								<div class="fa_custom">
									<i class="fa fa-file fa-5x" aria-hidden="true"></i>
								</div>
								<!--<img src="http://placehold.it/500x250/EEE">-->
								<div class="caption">
									<h4>{{ $attachment->comment_doc }}</h4>
									<p>{{ trans('globals.registered_by') }}: {{ $attachment->user->FullName }}</p>
									<!--<a href="#" class="btn btn-default btn-xs pull-right" role="button"><i class="glyphicon glyphicon-edit"></i></a> --> 
									<a href="{{ route('order.download_document', [$order->id,'attachment',$attachment->id]) }}" class="btn btn-info btn-xs" target="blank" role="button"><i class="fa fa-download" aria-hidden="true"></i> {{ trans('globals.download') }}</a> 
									@if (\Auth::user()->id == $attachment->user_id)
										<a href="#" class="btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i> {{ trans('globals.delete') }}</a>
									@endif
								</div>
							</div>
						</div>
					@endforeach
					
					</div><!--/row-->
				</div>
				<style type="text/css" media="screen">
					.fa_custom {  
						background: #f7f7f7;
						text-align: center;
						color: #c1c1c1;
						padding: 10px;
					} 
				</style>