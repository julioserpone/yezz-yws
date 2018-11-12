<script>
    $(function ()
    {
    	var $route_province = "{{ route('search.provinces_by_country', ['URL']) }}";
    	var $route_city = "{{ route('search.cities_by_province', ['URL']) }}";

    	function updateValueRadiobuttons($object) {
			if ($object.val() == "business") {
				$(".person").hide(500);
				$(".business").show('slow');
			} else {
				$(".business").hide(500);
				$(".person").show('slow');
			}
    	}

    	$("#country_id").select2({
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
					$("#province_id").val(null).trigger("change"); 
					$("#city_id").val(null).trigger("change"); 
				  	return {
				    	results: data
				  	};
				},
			}
		});

		$("#province_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url:  function (params) {
      				return $route_province.replace('URL', $("#country_id").val());
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
		});

		$("#city_id").select2({
			placeholder: '{{ trans("globals.select") }}',
			theme: "classic",
			ajax: {
				url:  function (params) {
      				return $route_city.replace('URL', $("#province_id").val());
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

		$("input[name=type]:radio").change(function () {
			updateValueRadiobuttons($(this));
		});

		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_square-red',
      		radioClass: 'iradio_square-red'
	    });

	    $('input[type="checkbox"][name=type].minimal, input[type="radio"][name=type].minimal').on('ifChecked', function(event){
	    	updateValueRadiobuttons($(this));
		});

	    @if($edit) $("input[name=type]:radio").iCheck('disable'); @endif

		if ($("#_province_id").val()=='')$("#province_id").val(null).trigger("change");
		if ($("#_city_id").val()=='')$("#city_id").val(null).trigger("change");

    	$("#clientFrm" ).submit(function( event )
    	{
    		//
		});

    });

    $( document ).ready(function() {
		//Update divs
		if ($("input:radio[name='type']:checked").val()  == "business") {
			$(".person").hide(500);
			$(".business").show('slow');
		} else {
			$(".business").hide(500);
			$(".person").show('slow');
		}
	});

</script>
