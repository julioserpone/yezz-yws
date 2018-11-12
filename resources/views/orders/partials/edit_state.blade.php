
{!! Form::model($order, ['route'=>['order.save_state',$order->id], 'method'=>'PUT', 'role'=>'form', 'name' => 'orderFrmState', 'id' => 'orderFrmState']) !!}
	<div class="row">
		<div class="form-group col-sm-12">
			{!! Form::label('state_id', trans('orders.state')) !!}
			{!! Form::select('state_id', $states, old('state_id'), ['id' => 'state_id', 'class' => 'form-control', 'style' => 'width:100%']); !!}
		</div>
	</div>

	<div class="dinamic-list-diagnostic">
		<div class="row">
			<div class="form-group col-sm-12">
				{!! Form::label('diagnostic_id', trans('orders.diagnostics')) !!}
				{!! Form::select('diagnostic_id',[], old('diagnostic_id'), ['id' => 'diagnostic_id', 'class' => 'form-control', 'style' => 'width:100%']); !!}
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-12">
				<button type="button" id="add_diagnostic_btn" class="btn btn-success btn-sm add"><i class="glyphicon glyphicon-log-in"></i>&nbsp;{{ trans('orders.insert_diagnostic') }}</button>
			</div>
		</div>

		<div class="row">
			<script class="template-mirror" type="text/x-jQuery-tmpl">
				<input type="hidden" name="diagnostics_list_temp[]" id="diagnostics_list_temp[]" value="${id},${diagnostic_id}">
			</script>

			<ul id="container-list-diagnostics">
				{{-- Aqui se imprimen los items agregados desde la lista --}}
				@php
				$diagnostics_list = (old('diagnostics_list') ? : \Session::get('diagnostics_list'))
				@endphp
				@if ($diagnostics_list)
				@foreach ($diagnostics_list as $key => $value)
				<li class="element r-ele-{{$key}}">{{ $value['text'] }} 
					<input type="hidden" name="diagnostics_list[]" id="diagnostics_list[]" value="{{$value['id']}},{{$value['text']}}" class="r-ele-{{$key}}">
					<button type="button" class="btn btn-danger btn-xs remove">{{ trans('globals.delete') }}</button>
				</li>
				@endforeach
				@endif
				<script class="template" type="text/x-jQuery-tmpl">
					<li>${diagnostic_id}
						<input type="hidden" name="diagnostics_list[]" id="diagnostics_list[]" value="${id},${diagnostic_id}">
						<button type="button" class="btn btn-danger btn-xs remove">	{{ trans('globals.delete') }}</button>
					</li>
				</script>
			</ul>

			<div id="mirror-container-list">
				@if ($diagnostics_list)
				@foreach ($diagnostics_list as $key => $value)
				<input type="hidden" name="diagnostics_list_temp[]" id="diagnostics_list_temp[]" value="{{$value['id']}},{{$value['text']}}" class="r-ele-{{$key}}">
				@endforeach
				@endif
			</div>
		</div>
	</div>


	<div class="dinamic-list-action">
		<div class="row">
			<div class="form-group col-sm-12">
				{!! Form::label('action_id', trans('orders.actions')) !!}
				{!! Form::select('action_id', [], old('action_id'), ['id' => 'action_id', 'class' => 'form-control', 'style' => 'width:100%']); !!}
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-12">
				<button type="button" id="add_action_btn" class="btn btn-success btn-sm add">
					<i class="glyphicon glyphicon-log-in"></i>&nbsp;{{ trans('orders.insert_action') }}</button>
			</div>
		</div>

		<div class="row">
			<script class="template-mirror" type="text/x-jQuery-tmpl">
				<input type="hidden" name="actions_list_temp[]" id="actions_list_temp[]" value="${id},${action_id}">
			</script>

			<ul id="container-list-actions">
				{{-- Aqui se imprimen los items agregados desde la lista --}}
				@php
				$actions_list = (old('actions_list') ? : \Session::get('actions_list'))
				@endphp
				@if ($actions_list)
				@foreach ($actions_list as $key => $value)
				<li class="element r-ele-{{$key}}">{{ $value['text'] }} 
					<input type="hidden" name="actions_list[]" id="actions_list[]" value="{{$value['id']}},{{$value['text']}}" class="r-ele-{{$key}}">
					<button type="button" class="btn btn-danger btn-xs remove">{{ trans('globals.delete') }}</button>
				</li>
				@endforeach
				@endif
				<script class="template" type="text/x-jQuery-tmpl">
					<li>${action_id}
						<input type="hidden" name="actions_list[]" id="actions_list[]" value="${id},${action_id}">
						<button type="button" class="btn btn-danger btn-xs remove">	{{ trans('globals.delete') }}</button>
					</li>
				</script>
			</ul>

			<div id="mirror-container-list">
				@if ($actions_list)
				@foreach ($actions_list as $key => $value)
				<input type="hidden" name="actions_list_temp[]" id="actions_list_temp[]" value="{{$value['id']}},{{$value['text']}}" class="r-ele-{{$key}}">
				@endforeach
				@endif
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-12">
			{!! Form::label('comment', trans('orders.comment')) !!}
			{!! Form::textarea('comment',  old('comment'), ['class' => 'form-control', 'rows' => 2, 'cols' => 40,]) !!}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12">
			<button type="button" class="btn btn-success pull-right" onclick="$('#orderFrmState').submit();">
				<i class="fa fa-paper-plane-o"></i>&nbsp; {{ trans('globals.submit') }}
			</button>
		</div>
	</div>
	{!! Form::token() !!}
{!! Form::close() !!}

<script>

$(document).ready(function() {

	var $route_actions = "{{ route('search.actions_by_states', ['URL']) }}";
	var $route_diagnostics = "{{ route('search.diagnostics_by_states', ['URL']) }}";

	//Regenerates a list of options for a SELECT control
	function formatOptions(html) {

		var options = "";
		var result = jQuery.parseJSON(html);

		for(var k in result) {
			options += "<option value="+result[k]['id']+">"+ result[k]['text'] +"</option>" ;
		}

		return options;
	}

	function asignValues() {
		clearDynamicList('container-list-diagnostics');
		clearDynamicList('container-list-actions');

		var state_id = $("#state_id").val();
		$.ajax({
			type: "GET",
			url: $route_actions.replace('URL', state_id),
			success: function(html) {
				var options = formatOptions(html);
				$("#action_id").html(options);

				if(options.length > 0)
				{
					$("#add_action_btn").removeClass("disabled");
				}else{
					$("#add_action_btn").addClass("disabled");
				}
			}
		});
		$.ajax({
			type: "GET",
			url: $route_diagnostics.replace('URL', state_id),
			success: function(html){
				var options = formatOptions(html);
				$("#diagnostic_id").html(options);
				if(options.length > 0)
				{
					$("#add_diagnostic_btn").removeClass("disabled");
				}else{
					$("#add_diagnostic_btn").addClass("disabled");
				}
			}
		});
	}

	//If the event is not yet associated with the control, we associate it.
	if (!$('#state_id').hasEvent('change')) {
		$('#state_id').on("change", asignValues);
	}
	asignValues();

	$('.dinamic-list-diagnostic').repeter({
		elements: {
			//appendTo:'#container-list', 
			allowDuplicated: false,	
			itemVerify: 'diagnostic_id',
			animation: 'animated bounceOutLeft',	//bounceOutRight = salida por la derecha
			mirror:{
				selector:'#mirror-container-list',
				tmplSelector:'.template-mirror'
			}
		},
		tmplData:function(){
			var id=$('select[name="diagnostic_id"]').val();
			var diagnostic_id = $("#diagnostic_id option:selected").text();
			return {id:id,diagnostic_id:diagnostic_id};
		}
	});

	$('.dinamic-list-action').repeter({
		elements: {
			//appendTo:'#container-list', 
			allowDuplicated: false,	
			itemVerify: 'action_id',
			animation: 'animated bounceOutLeft',	//bounceOutRight = salida por la derecha
			mirror:{
				selector:'#mirror-container-list',
				tmplSelector:'.template-mirror'
			}
		},
		tmplData:function(){
			var id=$('select[name="action_id"]').val();
			var action_id = $("#action_id option:selected").text();
			return {id:id,action_id:action_id};
		}
	});

	function clearDynamicList(container) {
		$('#'+container).each(function(){
			$(this).find('li').each(function(){
				$(this).remove();
			});
		});
	}

});
</script>