<script>
    $(function ()
    {
    	var $route_province = "{{ route('search.provinces_by_country', ['URL']) }}";
    	var $route_city = "{{ route('search.cities_by_province', ['URL']) }}";
    	var $route_workshop = "{{ route('search.workshops_by_country', ['URL']) }}";
    	var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
    	
    	var $options_country_order = {
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.countries') }}",
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
					$("#order_province_id").val(null).trigger("change"); 
					$("#order_city_id").val(null).trigger("change"); 
					$("#workshop_id").val(null).trigger("change"); 
				  	return {
				    	results: data
				  	};
				},
			}
		};

		var $options_province_order = {
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url:  function (params) {
      				return $route_province.replace('URL', $("#order_country_id").val());
    			}, 
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
					$("#city_id").val(null).trigger("change"); 
				  	return {
				    	results: data
				  	};
				},
			}
		};

		var $options_city_order = {
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url:  function (params) {
      				return $route_city.replace('URL', $("#order_province_id").val());
    			},
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
				  return {
				    results: data
				  };
				},
			}
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
		$('input[name="client_invoice_date"]').daterangepicker({
            locale: {
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
            },
            singleDatePicker: true,
            showDropdowns: true,
            }, 
            function(start, end, label) {
                $("#client_invoice_date").val(start.format('DD/MM/YYYY'));
            }
        );
    	/*
    	//DESHABILITO ESTA INSTANCIA PORQUE YA EN LOS SCRIPT DE CLIENTES LO INVOCO. VOLVER A LLAMAR ESO INHABILITA LA ACCION IFCHECKED DE CLIENTE
    	//OTRA OPCION ES PROBAR INSTANCIANDO CADA RADIOBUTTON DE ORDENES, Y NO HACERLO DE FORMA GENERAL
    	 $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_square-red',
      		radioClass: 'iradio_square-red'
	    });*/

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
            //Inputs visible
            $("#product_id").val('').trigger("change");
            $("#gp_customer_name").val('');
            $("#gp_item_description").val('');
            $("#gp_brand").val('');
            $("#gp_model").val('');
            $("#gp_part_number").val('');
            $("#gp_invoice_date").val('');
            $("#gp_num_doc").val('');
		}

		function searchClientData(id) {
			//search data client
			url = '{{route('search.clients')}}';
			data = {id: id};
			token = $('input[name=_token]').val();
			$.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                data: data,
                type: 'GET',
                datatype: 'JSON',
                success: function (resp) {
                	var obj = JSON && JSON.parse(resp) || $.parseJSON(resp);

                	//Falta precargar el pais, estado y ciudad para el cliente consultado
                	$options_country_order.data = obj[0]['country_description'];
                	$options_province_order.data = obj[0]['province_description'];
                	$options_city_order.data = obj[0]['city_description'];
                	$("#client_id").val(obj[0]['id']).trigger("change");
                	$("#order_country_id").select2('destroy').select2($options_country_order);
                	$("#order_country_id").val(obj[0]['country']).trigger("change");
                	$("#order_province_id").select2('destroy').select2($options_province_order);
                	$("#order_province_id").val(obj[0]['province']).trigger("change");
                	$("#order_city_id").select2('destroy').select2($options_city_order);
                	$("#order_city_id").val(obj[0]['city']).trigger("change");
                	$("#devolution_zip_code").val(obj[0]['zip_code']);
                	$("#devolution_address").val(obj[0]['shipping_address']);
                }
            });
		}

		$(".sendDataToForm").click(function(e){

			searchClientData($("#modal_client_id").val());
			$("#ModalShowClient").modal('hide');
			$("#ModalSearchClients").modal('hide');

		});

		//Get data client in modal search
		$("[name^='getDataClient']").click(function(e){
			e.preventDefault();
			var idclient = $(this).attr("data");
			url = '{{route('search.clients')}}';
			data = {id: idclient};
			token = $('input[name=_token]').val();
			$.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                data: data,
                type: 'GET',
                datatype: 'JSON',
                success: function (resp) {
                	var obj = JSON && JSON.parse(resp) || $.parseJSON(resp);

					$('#mv_type_person').iCheck('uncheck');
					$('#mv_type_business').iCheck('uncheck');

                	$('#mv_type_'+obj[0]['type']).iCheck('check');

					if (obj[0]['type'] == "business") {
						$(".mvd_person").hide(500);
						$(".mvd_business").show('slow');
					} else {
						$(".mvd_business").hide(500);
						$(".mvd_person").show('slow');
					}

					$("#modal_client_id").val(obj[0]['id']);
					$("#mv_identification").val(obj[0]['identification']);
					$("#mv_first_name").val(obj[0]['first_name']);
					$("#mv_last_name").val(obj[0]['last_name']);
					$("#mv_code_identification").val(obj[0]['code_identification']);
					$("#mv_description").val(obj[0]['description']);
					$("#mv_contact_name").val(obj[0]['contact_name']);
					$("#mv_cellphone_number").val(obj[0]['cellphone_number']);
					$("#mv_homephone_number").val(obj[0]['homephone_number']);
					$("#mv_email").val(obj[0]['email']);
					$("#mvl_status").val(obj[0]['status']).trigger("change");
                	$("#mvl_country_id").val(obj[0]['country_description'][0]['text']);
                	$("#mvl_province_id").val(obj[0]['province_description'][0]['text']);
                	$("#mvl_city_id").val(obj[0]['city_description'][0]['text']);
                	$("#mv_zip_code").val(obj[0]['zip_code']);
                	$("#mv_shipping_address").val(obj[0]['shipping_address']);

					//show modal
					$("#ModalShowClient").modal('show');
                }
            });
		});

		$("[name^='selClientList']").click(function(e){
			e.preventDefault();
			var idclient = $(this).attr("data");
			$("#client_id").val(idclient).trigger("change");
			searchClientData(idclient,'master');
			//close modal
			$("#ModalSearchClients").modal('hide');
		});

    	$("#client_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.clients') }}",
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
				  	return {
				    	results: data
				  	};
				},
			}
		});

		$("#client_id").on('select2:select', function (arg) {
			searchClientData(arg.params.data.id);
		});

    	$("#product_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.products') }}",
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
				  	return {
				    	results: data
				  	};
				},
			}
		});
		$("#product_id").on('select2:select', function (arg) {
  			$("#_product_id").val(arg.params.data.id);
		});

    	$("#order_country_id").select2($options_country_order);

		$("#order_province_id").select2($options_province_order);

		$("#order_city_id").select2($options_city_order);

		$("#failure").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url: "{{ route('search.failures') }}",
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
				  	return {
				    	results: data
				  	};
				},
			}
		});

		$("#workshop_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url:  function (params) {
      				return $route_workshop.replace('URL', $("#order_country_id").val());
    			},
				dataType: 'json',
				type: "GET",
				delay: 400,
				data: function(params) {
				    return {
				        q: params.term
				    }
				},
				processResults: function (data, page) {
				  return {
				    results: data
				  };
				},
			}
		});
		
		//Inicialize list in blank
		if (($("#_order_province_id").val()=='') && !($("#edit").val())) $("#order_province_id").val(null).trigger("change"); 
		if (($("#_order_city_id").val()=='')  && !($("#edit").val())) $("#order_city_id").val(null).trigger("change"); 
		if (($("#_workshop_id").val()=='') && !($("#edit").val())) $("#workshop_id").val(null).trigger("change");
		if (($("#_client_id").val()=='') && !($("#edit").val())) $("#client_id").val(null).trigger("change");

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

		//For modal client (all disabled)
        $("[name^='mv_']").prop("readonly", true);
        $("[name^='mvl_']").prop("disabled", true);
        //$("input[name=mv_type]:radio").iCheck('disable');
	});
</script>