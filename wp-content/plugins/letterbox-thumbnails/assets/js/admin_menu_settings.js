(function ($) {
    var ajaxQueue = $({});

    $.ajaxQueue = function(ajaxOpts) {
        // hold the original complete function
        var oldComplete = ajaxOpts.complete;

        // queue our ajax request
        ajaxQueue.queue(function(next) {

            // create a complete callback to fire the next event in the queue
            ajaxOpts.complete = function() {
                // fire the original complete if it was there
                if (oldComplete) oldComplete.apply(this, arguments);

                next(); // run the next query in the queue
            };

            // run the query
            $.ajax(ajaxOpts);
        });
    };

    $(document).ready(function () {
        $('.wp-color-picker-field').wpColorPicker();

        $('form#letterbox-thumbnails-settings-form').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);

            form.find('.ajax-process').show();

            var params = {
                action: 'letterbox_thumbnails_settings_save',
                wpnonce: letterbox_thumbnails_menu_settings_vars.wpnonce_settings,
                form: form.serializeArray()
            };

            // setup ajax request options
            $.ajaxSetup({
                dataType: "json"
            });

            var ajax_response = $.post(ajaxurl, params);

            ajax_response.success(function (response) {
                if (!$.isEmptyObject(response)) {
                    if ('message' in response) {
                        $('#wpbody-content').find('.wrap-header').append('<div class="notice notice-success lt-notice"><p>' + response.message + '</p></div>');

                        setTimeout(function () {
                            $('.lt-notice').slideUp();
                        }, 5000);
                    }

                    if ('fields' in response) {
                        $.each(response['fields'], function (key, value) {
                            form.find("[name='" + key + "']").val(value);
                        });
                    }
                }
            });

            ajax_response.always(function (responce_data) {
                form.find('.ajax-process').hide();
            })
        });
    });
})(jQuery);