<script>

	$(function ()
	{
		var $_token = "{{ csrf_token() }}";
		var $route_workshops = "{{ route('search.workshops_by_countries') }}";
		var $route_report_items    = "{{ route('report.items') }}";
		var $route_report_generate = "{{ route('report.generate') }}";
		var $route_export = "{{ route('report.export') }}";
		var $table_header = $('#table_header');   
		var $table_footer = $('#table_footer');   
		var $table_body   = $('#table_body');
		var $role_user = "{{ $user->role }}";
		var $workshop_user = "{{ $user->workshop_id }}";
		var $country_user = "{{ $user->country_id }}";

		/*Campos del Reporte*/
		var $report_item_list = $("#fields").select2({tags: true});
		var $country_list = $("#countries").select2({tags: true});
		var $workshops_list = $("#workshops").select2({tags: true});
		var daterangepicker_locale = {
			format: 'DD/MM/YYYY',
			daysOfWeek: [
				"{{ trans('globals.format.days_of_week.sunday') }}",
				"{{ trans('globals.format.days_of_week.monday') }}",
				"{{ trans('globals.format.days_of_week.tuesday') }}",
				"{{ trans('globals.format.days_of_week.wednesday') }}",
				"{{ trans('globals.format.days_of_week.thursday') }}",
				"{{ trans('globals.format.days_of_week.friday') }}",
				"{{ trans('globals.format.days_of_week.saturday') }}"
			],
			monthNames: [
				"{{ trans('globals.format.month_names.january') }}",
				"{{ trans('globals.format.month_names.february') }}",
				"{{ trans('globals.format.month_names.march') }}",
				"{{ trans('globals.format.month_names.april') }}",
				"{{ trans('globals.format.month_names.may') }}",
				"{{ trans('globals.format.month_names.june') }}",
				"{{ trans('globals.format.month_names.july') }}",
				"{{ trans('globals.format.month_names.august') }}",
				"{{ trans('globals.format.month_names.september') }}",
				"{{ trans('globals.format.month_names.optober') }}",
				"{{ trans('globals.format.month_names.november') }}",
				"{{ trans('globals.format.month_names.december') }}"
			],
		};

		var $order_date = $('input[name="order_date"]').daterangepicker({ locale: daterangepicker_locale });

		function getFormValues()
		{ 
			return {
				fields : ($report_item_list.val().length > 0) ? $report_item_list.val() : 0 ,
				countries: ($country_list.val().length > 0 ) ? $country_list.val() : 0,
				workshops: ($workshops_list.val().length > 0) ? $workshops_list.val() : 0,
				order_date: $order_date.val()
			} 
		}

		$("#workshops").select2({
	        minimumInputLength: 2,
	        multiple: true,
	        ajax: {
	        	headers: {'X-CSRF-TOKEN': $_token},
	            type: "POST",
	            url:  function (params) {
      				return $route_workshops;
    			}, 
	            dataType: 'json',
	            contentType: "application/json",
	            delay: 250,
	            data: function (params) {
	                return  JSON.stringify({
	                    q: params.term,
	                    countries: $("#countries").val()
	                });
	            },
	            processResults: function (data) {
	                return {
	                    /*results: $.map(data, function (item, i) {
	                        return {
	                            text: item,
	                            id: i
	                        }
	                    })*/
	                    results: data
	                };
	            }
	        },
	    });

		$('#btn_generate').on('click',function(){
			var data = getFormValues();
			data.type = 'preview';
			$('#params').val(JSON.stringify(data));
			$table_header.empty();
			$table_footer.empty();
			$table_body.empty();
			$.ajax({
				type: "POST",
				url: $route_report_generate,
				headers: {'X-CSRF-TOKEN': $_token},
				data: data,
				datatype: 'JSON',
				success: function(response) {
					/*if(response.data.length > 0)
					{
					addRemoveClass(['#btn_export'],'disabled','remove');
					}else{
					addRemoveClass(['#btn_export'],'disabled','add');
					}*/
					buildTable(response);
				}
			});
		});

		$('#btn_export').on('click',function(){
			var data = getFormValues();
			data.type = 'export';
			$('#params').val(JSON.stringify(data));
			$.ajax({
				cache: false,
				type: "POST",
				url: $route_export,
				headers: {'X-CSRF-TOKEN': $_token},
				data: data,
				success: function (response, textStatus, request) {
			        var a = document.createElement("a");
			        a.href = response.file; 
			        a.download = response.name;
			        document.body.appendChild(a);
			        a.click();
			        a.remove();
      			},
      			error: function (ajaxContext) {
        			alert('Export error: '+ajaxContext.responseText);
      			}
			});
		});

		function buildTable(response)
		{
			$.each(response.fields, function( index, value ) {
				var column = '<th class="text-center">'+value+'</th>'
				$table_header.append(column);
				$table_footer.append(column);
			});

			$.each(response.data, function( index, value ) {
				var tr = document.createElement("tr");   

				$.each(value, function(i, item ) {
					var cell = document.createElement('td');
					cell.innerHTML = '<td>'+ (item) ? item :'&nbsp;' +'</td>';
					tr.appendChild(cell);
				});

				$table_body.append(tr); 
			});
		}

		/*Params: 
		elements: Array  de Elementos del DOM,
		classes:  String CSS Class, 'disabled custom-ccs-class'
		mode:     String 'add', 'remove'
		*/
		function addRemoveClass(elements, classes, mode)
		{
			switch(mode){
				case "add":
				$.each(elements, function( index, value ) {
					$(value).addClass(classes);
				});
				break;
				case "remove":
				$.each(elements, function( index, value ) {
					$(value).removeClass(classes);
				});
				break;
			}
		}

		function selectedItems(list)
		{
			var result = [];
			$.each(list, function( index, value ) {
				result[index] = value.id;
			});
			return result;
		}

		if ($role_user == 'workshop')
		{
			$("#countries").val($country_user).trigger("change");
			$("#workshops").val($workshop_user).trigger("change");
		}

	});

</script>