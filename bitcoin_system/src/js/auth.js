siteObjJs.admin.authJs = function () {

    var init = function () {

        siteObjJs.validation.formValidateInit('#userlogin', handleUsernameValidateAjaxRequest);

    };


    var handleUsernameValidateAjaxRequest = function () {

        var username = $('input[name="username"]');
        var usernameVal = username.val();
        var recaptcha = $('#g-recaptcha-response');
        var recaptchaVal = recaptcha.val();

        $('#username-error').html('');
        $('#recaptcha-error').html('');
        $progressField = $("#progress");

        $('div.form-group').removeClass('has-error');
        $('.help-block-error').html('');

        if (!recaptchaVal) {
            //showError('g-recaptcha-response-error', 'Please check the checkbox.');
            $('#g-recaptcha-response-error').html('Please confirm you are human and not a robot.');
            setTimeout(function () {
                $('#g-recaptcha-response-error').html('');
            }, 5000);
        } else {
            
            var formElement = $(this.currentForm); // Retrive form from DOM and convert it to jquery object
            var actionUrl = formElement.attr("action");
            var actionType = formElement.attr("method");

            //var formData = formElement.serialize();
            var formData = formElement.serializeArray();
            var form = new FormData();
            formData.reduce(function (obj, item) {
                form.append(item.name, item.value);
            });
            $progressField.html('Processing...   <span class="glyphicon glyphicon-refresh spinning"></span> ');
            $.ajax({
                url: actionUrl,
                cache: false,
                data: form,
                dataType: "json",
                type: "POST",
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,
                success: function (data)
                {
                    if (data.success === true) {
                        grecaptcha.reset();
                        $('#login-form').html(data.loginform);                        
                        siteObjJs.validation.formValidateInit('#loginForm', handleLoginAjaxRequest);
                        $('input[name="username"]').val(usernameVal);
                        $("#password").focus();
                    }
                    if (data.success === false) {
                        var errors = data.errormsg;
                        $.each(errors, function (index, value) {
                            showError(index + '-error', value);
                        });
                    }
                    $progressField.html('');
                },
                error: function (data)
                {
                    grecaptcha.reset();
                    $progressField.html('');
                    //used when there is success = false and 422 unprocessing entity
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (index, value) {
                        if (index == 'username') {
                            showError('response-error', value);
                        } else {
                            showError(index + '-error', value);
                        }                        
                    });
                    
                }
            });

        }
        return false;
    }

    var handleLoginAjaxRequest = function () {
        var formElement = $(this.currentForm); // Retrive form from DOM and convert it to jquery object
        var actionUrl = formElement.attr("action");
        var actionType = formElement.attr("method");


        var formData = formElement.serializeArray();
        var form = new FormData();
        formData.reduce(function (obj, item) {
            form.append(item.name, item.value);
        });
        var username = $('input[name="username"]');
        var usernameVal = username.val();
        form.append('username', usernameVal);

        $progressField = $("#progress");
        $progressField.html('Processing...   <span class="glyphicon glyphicon-refresh spinning"></span> ');
        $.ajax({
            url: actionUrl,
            cache: false,
            data: form,
            dataType: "json",
            type: "POST",
            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            processData: false,
            contentType: false,
            success: function (data)
            {
                if (data.success === false) {
                    var errors = data.errormsg;
                    $.each(errors, function (index, value) {

                        Metronic.alert({
                            type: 'danger',
                            message: value,
                            container: $('#login-error-msg'),
                            place: 'prepend',
                            closeInSeconds: siteObjJs.admin.commonJs.constants.alertCloseSec
                        });
                    });
                }
                if (data.success === true) {
                    window.location.href = data.redirectToUrl;
                }
                $progressField.html('');
            },
            error: function (data)
            {
                $progressField.html('');
                $('.help-block-error').html('');
                //used when there is success = false and 422 unprocessing entity
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function (index, value) {
                    var element = $('input[name="' + index + '"]');
                    displayFormErrorPlacement(element, value);
                });
            }
        });
    }

    var showError = function (errdiv, msg) {
        Metronic.alert({
            type: 'danger',
            message: msg,
            container: $('#' + errdiv),
            place: 'prepend',
            closeInSeconds: siteObjJs.admin.commonJs.constants.alertCloseSec
        });
    };

    var displayFormErrorPlacement = function (element, text) { // render error placement for each input type
        var error = $('<span/>', {
            class: 'help-block help-block-error',
            text: text
        });
        if (element.parent(".input-group").size() > 0) {
            error.insertAfter(element.parent(".input-group"));
        } else if (element.attr("data-error-container")) {
            error.appendTo(element.attr("data-error-container"));
        } else if (element.parents('.radio-list').size() > 0) {
            error.appendTo(element.parents('.radio-list').attr("data-error-container"));
        } else if (element.parents('.radio-inline').size() > 0) {
            error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
        } else if (element.parents('.checkbox-list').size() > 0) {
            error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
        } else if (element.parents('.checkbox-inline').size() > 0) {
            error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
        } else {
            error.insertAfter(element);
        }
        element.closest('.form-group').addClass('has-error');
    };

    return {
        'init': init,
        'displayFormErrorPlacement': displayFormErrorPlacement
    };
}();