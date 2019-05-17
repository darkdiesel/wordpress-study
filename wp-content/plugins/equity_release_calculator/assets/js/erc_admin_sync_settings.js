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
        $('form#erc-sync-form').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);

            // data types for sync
            var data_type = ['age', 'percentage', 'percentage_hr', 'calculator'];

            $.each( data_type, function( key, obj ) {

                $.ajaxQueue({
                    url: ajaxurl,
                    dataType: "json",
                    data: {
                        action: 'erc_sync_all_data',
                        wpnonce: erc_menu_sync_settings_vars.wpnonce_sync,
                        type: obj
                    },
                    type: 'POST',
                    success: function(response) {
                        if (!$.isEmptyObject(response)) {
                            if ('message' in response) {
                                $('#wpbody-content').find('.wrap-header').append('<div class="notice notice-success er-notice"><p>' + response.message + '</p></div>');

                                setTimeout(function () {
                                    $('.er-notice').slideUp();
                                }, 5000);
                            }
                        }
                    },
                    beforeSend: function(){
                        form.find('.ajax-process').show();
                    },
                    always: function(){
                        form.find('.ajax-process').hide();
                    },
                    complete: function(){
                        form.find('.ajax-process').hide();
                    }
                });

                // ajax_response.always(function (responce_data) {
                //     form.find('.ajax-process').hide();
                // })
            });
        });

        $('form#erc-sync-settings-form').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);

            form.find('.ajax-process').show();

            var params = {
                action: 'erc_sync_settings_save',
                wpnonce: erc_menu_sync_settings_vars.wpnonce_settings,
                form: form.serializeArray()
            };

            // $.each(form.serializeArray(), function(){
            //     var name = this.name;
            //
            //     if(this.name.indexOf('[]') !== -1){
            //         name =  name.replace('[]', '');
            //     }
            //
            //     params['form'].push(
            //         {
            //             name: name,
            //             value: this.value
            //         }
            //     );
            // });

            // setup ajax request options
            $.ajaxSetup({
                dataType: "json"
            });

            var ajax_response = $.post(ajaxurl, params);

            ajax_response.success(function (response) {
                if (!$.isEmptyObject(response)) {
                    if ('message' in response) {
                        $('#wpbody-content').find('.wrap-header').append('<div class="notice notice-success er-notice"><p>' + response.message + '</p></div>');

                        setTimeout(function () {
                            $('.er-notice').slideUp();
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