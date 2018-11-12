<script>
/*!
 * Laravel-Bootstrap-Modal-Form (https://github.com/JerseyMilker/Laravel-Bootstrap-Modal-Form)
 * Copyright 2015 Jesse Leite - MIT License
 *
 * Bromance:
 * Adam Wathan has nice boots. Thank you for BootForms magic.
 * Matt Higgins has nice beard. Thank you for JS wizardry.
 */
$('document').ready(function() {
    //Notify Animation
    var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};

    // Prepare reset.
    function resetModalFormErrors() {
        $('.form-group').removeClass('has-error');
        $('.form-group').find('.help-block').remove();
    }

    // Reset inputs and controls
    function resetModalFormControls(form, submitOriginal) {
        $(':input','#'+form.attr('id'))
            .not(':button, :submit, :reset, :hidden, :radio')
            .val('');
            //.removeAttr('checked')
            //.removeAttr('selected');
        
        // Reset submit
        if (submitOriginal) {
            var submit = form.find('[type=submit]');
            if (submit.is('button')) {
                submit.html(submitOriginal);
            } else if (submit.is('input')) {
                submit.val(submitOriginal);
            }
        }
    }

    // Intercept submit.
    $('form.bootstrap-modal-form').on('submit', function(submission) {
        submission.preventDefault();

        // Set vars.
        var form   = $(this),
            url    = form.attr('action'),
            submit = form.find('[type=submit]');

        // Check for file inputs.
        if (form.find('[type=file]').length) {

            // If found, prepare submission via FormData object.
            var input       = form.serializeArray(),
                data        = new FormData(),
                contentType = false;

            // Append input to FormData object.
            $.each(input, function(index, input) {
                data.append(input.name, input.value);
            });

            // Append files to FormData object.
            $.each(form.find('[type=file]'), function(index, input) {
                if (input.files.length == 1) {
                    data.append(input.name, input.files[0]);
                } else if (input.files.length > 1) {
                    data.append(input.name, input.files);
                }
            });
        }

        // If no file input found, do not use FormData object (better browser compatibility).
        else {
            var data        = form.serialize(),
                contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
        }

        // Please wait.
        if (submit.is('button')) {
            var submitOriginal = submit.html();
            submit.html('{{ trans("globals.please_wait") }}');
        } else if (submit.is('input')) {
            var submitOriginal = submit.val();
            submit.val('{{ trans("globals.please_wait") }}');
        }

        // Request.
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'json',
            cache: false,
            contentType: contentType,
            processData: false

        // Response.
        }).always(function(response, status) {

            // Reset errors.
            resetModalFormErrors();

            // Check for errors.
            if (response.status == 422) {
                var errors = $.parseJSON(response.responseText);
                // Iterate through errors object.
                $.each(errors, function(field, message) {
                    //console.error(field+': '+message);
                    var formGroup = $('[name='+field+']', form).closest('.form-group');
                    formGroup.addClass('has-error').append('<p class="help-block">'+message+'</p>');
                });

                // Reset submit.
                if (submit.is('button')) {
                    submit.html(submitOriginal);
                } else if (submit.is('input')) {
                    submit.val(submitOriginal);
                }

            // If successful, reload.
            } else {

                //reset fields
                resetModalFormControls(form, submitOriginal);

                //Close modal and notify success process
                $("#myModal").modal('hide');
                new PNotify({
                    title: '{{ trans("globals.success_alert_title") }}',
                    text: '{{ trans("globals.success_procces") }}',
                    type: 'success',
                    delay: 3500,
                    mouse_reset: true,
                    styling: 'bootstrap3',
                    addclass: "stack-bottomright", 
                    stack: stack_bottomright,
                    icon : true
                });
            }
        });
    });

    // Reset errors when opening modal.
    $('.bootstrap-modal-form-open').click(function() {
        //var form   = $('.bootstrap-modal-form'),
        //    submit = form.find('[type=submit]');

        resetModalFormErrors();
        //resetModalFormControls(form, null);
    });

});
</script>
