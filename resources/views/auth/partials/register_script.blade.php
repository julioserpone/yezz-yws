<script>
    $(function () {

        var $route_province = "{{ route('register.search.provinces_by_country', ['URL']) }}";
        var $route_city = "{{ route('register.search.cities_by_province', ['URL']) }}";
        
        $("#birth_date").inputmask("{{ trans('globals.inputmask.date') }}", {"placeholder": "{{ trans('globals.inputmask.date') }}"});

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red'
        });

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
                url: "{{ route('register.search.countries') }}",
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

        $("#email").on("change", function() {
            $("#email_client").val($(this).val());
        });

        $("#cellphone_number").on("change", function() {
            $("#cellphone_number_client").val($(this).val());
        });

        $("#homephone_number").on("change", function() {
            $("#homephone_number_client").val($(this).val());
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


    });

    $(document).ready(function () {

        var $step1 = false;
        var $step2 = false;

        $("#registerFrm" ).submit(function( event )
        {
            return ($step1 && $step2);
        });
        
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();
        
        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);
        
            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            var $next = false;

            switch($active.attr('data')) {
                case 'step1':
                    $next = (
                        ($("#identification").val() !== "") &&
                        ($("#first_name").val() !== "") &&
                        ($("input:radio[name='gender']:checked").val() !== undefined) &&
                        ($("#username").val() !== "") &&
                        ($("#email").val() !== "") &&
                        ($("#password").val() !== "") 
                        );
                    $step1 = $next;
                    break;
                case 'step2':
                    $next = (
                        ($("#email_client").val() !== "") &&
                        ($("#country_id").val() !== "") &&
                        ($("#province_id").val() !== "") &&
                        ($("#city_id").val() !== "") &&
                        ($("#zip_code").val() !== "") &&
                        ($("#shipping_address").val() !== "") 
                        );
                    $step2 = $next;
                    break;
            }
            if ($next) {
                $active.next().removeClass('disabled');
                nextTab($active);
            }

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });

        //Update divs
        if ($("input:radio[name='type']:checked").val() == "business") {
            $(".person").hide(500);
            $(".business").show('slow');
        } else {
            $(".person").show('slow');
            $(".business").hide(500);
        }
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
</script>