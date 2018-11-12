
<div class="box">
	<div class="box-header with-border">
		<h4>{{trans('reports.orders')}}</h4>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('fields', trans('reports.fields')) !!}
					{!! Form::select('fields', $fields, old('fields'), ['id' => 'fields', 'class' => 'form-control select2 ', 'multiple'=>'multiple', 'style' => 'width:100%']); !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<div class="form-group">
					{!! Form::label('countries', trans('globals.countries')) !!}
					{!! Form::select('countries', $countries, old('countries'), ['id' => 'countries', 'class' => 'form-control select2', (($user->role == 'workshop' ) ? 'disabled' : ''),'multiple'=>'multiple', 'style' => 'width:100%']); !!}
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="form-group">
					{!! Form::label('workshops', trans('globals.workshops')) !!}
					{!! Form::select('workshops', $workshops, old('workshops'), ['id' => 'workshops', 'class' => 'form-control select2', (($user->role == 'workshop' ) ? 'disabled' : ''), 'multiple'=>'multiple', 'style' => 'width:100%']); !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ trans('orders.order_date') }}</label>

					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control pull-right" name="order_date">
					</div>
				</div>
			</div>
			<div class="col-md-6">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 text-center!">
				<div class="form-group" >
					<input type="hidden" name="params" id="params">
					<button class="btn btn-primary" id="btn_generate"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;{{ trans('reports.preview')}}</button>
					<button class="btn btn-success pull-right" id="btn_export"><i class="glyphicon glyphicon-download-alt"></i>&nbsp;{{ trans('reports.export_report')}}</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box">
	<div class="box-header with-border">
		<h4 class="pull-left">
			<i class="fa fa-th"></i>&nbsp;{{ trans('globals.section_title.orders.list') }}
		</h4>
	</div>

	<div class="box-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table id="datagrid" class="table table-bordered table-hover dataTable" role="grid" style="font-size: 14px;">
						<thead>
							<tr id="table_header">
							</tr>
						</thead>
						<tbody id="table_body">
						</tbody>
						<tfoot>
							<tr id="table_footer">
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

