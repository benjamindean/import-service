$(function ($) {

    var label = $('.file-input-name');
    $('.file-input').on('change', function (e) {
        var fileName = $(this).val().split('\\').pop() || false;
        if (fileName) {
            label.html(fileName);
            label.show();
        } else {
            label.hide();
        }
    });

    $("#form-submit").submit(function () {
        var formData = new FormData($(this)[0]);
        progress('pending');

        $.ajax({
            url: 'api/upload',
            type: 'POST',
            data: formData,
            async: true,
            success: function (data) {
                if (data['success']) {
                    progress('done');
                    handleSuccess();
                }
            },
            error: function (data) {
                progress('failed');
                handleErrors(data.responseJSON.errors[0]);
            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });

    function handleErrors(errors) {
        var errorBox = $('.error-box');
        $('.sucess-box').hide();
        $('.error-message').remove();
        errorBox.show();
        for (var key in errors) {
            errorBox.append('<p class="error-message">' + errors[key] + '</p>')
        }
    }

    function handleSuccess() {
        $('.error-box').hide();
        $('.success-box').show();
    }

    function progress(status) {
        var submitBtn = $('#submit-button'),
            spinner = $('.spinner');

        if (status === 'pending') {
            submitBtn
                .attr('disabled', true)
                .addClass('button-disabled');
            spinner.prev().hide();
            spinner.show();
        } else {
            submitBtn
                .attr('disabled', false)
                .removeClass('button-disabled');
            spinner.prev().show();
            spinner.hide();
        }
    }

})(jQuery);
