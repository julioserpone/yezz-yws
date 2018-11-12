<script>
    $(function ()
    {
    	var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
    	var $config_select2 = {
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
		};
		var $config_colors_select2 = {
			ajax: {
			    url: "{{ route('search.colors.public') }}",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        q: params.term // search term
			        //page: params.page
			      };
			    },
			    processResults: function (data, params) {
			      
			    	params.page = params.page || 1;

			    	return {
			        	results: data.items
			      	};
			    },
			    cache: true
		  	},
		  	placeholder: '{{ trans("globals.select") }}',
		  	theme: "classic",
		  	escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		  	//minimumInputLength: 2,
		  	templateResult: formatRepo,
		  	templateSelection: formatRepoSelection
		};
    	$('.dinamic-list').repeter({
    		elements:{
    			//appendTo:'#container-list', 
    			allowDuplicated: false,	
    			itemVerify: 'failure',
    			animation: 'animated bounceOutLeft',	//bounceOutRight = salida por la derecha
    	 		mirror:{
    	 				selector:'#mirror-container-list',
					 	tmplSelector:'.template-mirror'
					 }
    		},
			tmplData:function(){
				var id=$('select[name="failure"]').val();
				var failure = $('select[name="failure"]').select2('data')[0].text;
				return {id:id,failure:failure};
			}
    	});
    	
    	//Masked Inputs
    	$("#gp_invoice_date").inputmask("{{ trans('globals.inputmask.date') }}", {"placeholder": "{{ trans('globals.inputmask.date') }}"});
    	$("#gp_purchase_date").inputmask("{{ trans('globals.inputmask.date') }}", {"placeholder": "{{ trans('globals.inputmask.date') }}"});


		function formatRepo (repo) {
			//console.log(repo);
			if (repo.loading) {
				return repo.text;
			}

			var markup = "<h4>" + repo.text + 
				" <span class='label label-show-colors' style='background-color:"+ repo.primary_color +"; color: "+ repo.primary_color +";'>P</span>";
			if (repo.secondary_color !== null) {
				markup += " <span class='label label-show-colors' style='background-color:"+ repo.secondary_color +"; color: "+ repo.secondary_color +";'>S</span></h4>";
			}

		  return markup;
		}

		function formatRepoSelection (repo) {
		  	return repo.text;
		}

		$('#searchProduct').click(function(){

            var imei, token, url_search_imei, data;
            token = $('input[name=_token]').val();
            imei = $('#gp_imei').val();
            url_search_imei = '{{route('products.getdatabyimei')}}';
            data = {imei: imei};

            cleanFields();
			disableFields(false);
            $.ajax({
                url: url_search_imei,
                headers: {'X-CSRF-TOKEN': token},
                data: data,
                type: 'GET',
                datatype: 'JSON',
                success: function (resp) {
                	var obj = JSON && JSON.parse(resp) || $.parseJSON(resp);

                	if (obj.hasOwnProperty('ERROR')){

						$('#gp_imei').focus();
                		new PNotify({
				            title: '{{ trans("globals.error_alert_title") }}',
				            text: obj['ERROR'],
				            type: 'error',
				            delay: 3500,
				            mouse_reset: true,
				            styling: 'bootstrap3',
				            addclass: "stack-bottomright", 
				            stack: stack_bottomright,
				            icon : true
				        });

                	} else {
	                	disableFields(true);
                		//Inputs hidden
	                	$("#gp_customer_code").val(obj['CUSTNMBR']);
	                	$("#gp_item_code").val(obj['ITEMNMBR']);
	                	$("#gp_country_name").val(obj['COUNTRY']);
	                	$("#gp_purchase_date").val(moment(obj['DATERECD']).format("{{ trans('globals.format.date') }}"));
	                	//Inputs visible
	                	$("#gp_customer_name").val(obj['CUSTNAME']);
	                	$("#gp_item_description").val(obj['ITEMDESC']);
	                	$("#gp_brand").val(obj['USCATVLS_1']);
	                	$("#gp_model").val(obj['USCATVLS_4']);
	                	$("#gp_part_number").val(obj['USCATVLS_2']);
	                	$("#gp_invoice_date").val(moment(obj['DOCDATE']).format("{{ trans('globals.format.date') }}"));
	                	$("#gp_num_doc").val(obj['SOPNUMBE']);

	                	//Search product and asign value in select2 PRODUCT_ID
	                	$("#product_id").val(obj['product_data']['id']).trigger("change");
						$("#_product_id").val(obj['product_data']['id']);
						$("#color_id").val(obj['product_data']['color_id']).trigger("change");
						$("#_color_id").val(obj['product_data']['color_id']);

	                	new PNotify({
				            title: '{{ trans("globals.success_alert_title") }}',
				            text: '{{ trans("globals.imei_registered_dinamicsgp") }}',
				            type: 'success',
				            delay: 3500,
				            mouse_reset: true,
				            styling: 'bootstrap3',
				            addclass: "stack-bottomright", 
				            stack: stack_bottomright,
				            icon : true
				        });
                	}
                }
            });
        });

        $('#recycle').click(function(){
        	disableFields(false);
        	cleanFields();
        	$('#gp_imei').val('');
        	$('#gp_imei').focus();
        });

		function disableFields(state) {
        	//Inputs visible
        	$("#product_id").prop("disabled", state);
        	$("#color_id").prop("disabled", state);
        	$("#gp_customer_name").prop("readonly", state);
        	$("#gp_item_description").prop("readonly", state);
        	$("#gp_brand").prop("readonly", state);
        	$("#gp_model").prop("readonly", state);
        	$("#gp_part_number").prop("readonly", state);
        	$("#gp_invoice_date").prop("readonly", state);
        	$("#gp_num_doc").prop("readonly", state);

		}

		function cleanFields() {
			//Inputs hidden
            $("#gp_customer_code").val('');
            $("#gp_item_code").val('');
            $("#gp_country_name").val('');
            $("#gp_purchase_date").val('');
            $("#gp_part_number").val('');
            //Inputs visible
            $("#product_id").val('').trigger("change");
            $("#color_id").val('').trigger("change");
            $("#gp_customer_name").val('');
            $("#gp_item_description").val('');
            $("#gp_brand").val('');
            $("#gp_model").val('');
            $("#gp_invoice_date").val('');
            $("#gp_num_doc").val('');
		}

    	$("#product_id").select2($config_select2);

		$("#failure").select2($config_select2);

		$("#workshop_id").select2($config_select2);
		
    	$("#color_id").select2($config_colors_select2);

    	//Personal Retreat actions (radiobuttons)
    	function showDevolutionAddress($object) {
    		
    		if ($object.attr('name') == 'personal_retreat') {
				if ($object.val() == "no") {
					$(".personal_retreat").show('slow');
				} else {
					$(".personal_retreat").hide(500);
				}
    		}
    	}

		$('input[type="checkbox"][name=personal_retreat].minimal, input[type="radio"][name=personal_retreat].minimal').on('ifChecked', function(event){
	    	showDevolutionAddress($(this));
		});
		
		$("input[name=type]:radio").change(function () {
			updateValueRadiobuttons($(this));
		});

		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_square-red',
      		radioClass: 'iradio_square-red'
	    });

	    @if($edit) $("input[name=type]:radio").iCheck('disable'); @endif

    	$("#orderFrm").submit(function(event)
    	{
    		//
		});

    });

	$( document ).ready(function() {
		//Update divs
    	if ($("input:radio[name='personal_retreat']:checked").val() == "no") {
			$(".personal_retreat").show('slow');
		} else {
			$(".personal_retreat").hide(500);
		}
	});
</script>