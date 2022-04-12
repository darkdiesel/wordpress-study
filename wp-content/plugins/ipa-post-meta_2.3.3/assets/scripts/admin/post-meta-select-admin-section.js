(function ($) {
    $(document).ready(function () {
        var container = $('#wpcontent');

        // select post meta type
        $("select.ipa-post-meta-select-admin-section").each(function () {
            var select = $(this);

            console.log(select);

            var options = select.find('option');

            var field = '';
            var data_field = '';

            options.each(function () {
                data_field = $(this).attr('value');

                console.log(data_field);

                if (data_field) {
                    field = container.find('#' + data_field);

                    console.log(field);

                    if (field.length) {
                        field.hide();
                    }
                }
            });

            data_field = select.find(':selected').attr('value');

            if (data_field) {

                field = container.find('#' + data_field);

                if (field.length) {
                    field.show();
                }
            }

            select.bind('change', function () {
                options.each(function () {
                    data_field = $(this).attr('value');

                    if (data_field) {
                        field = container.find('#' + data_field);
                        if (field.length) {
                            field.slideUp();
                        }
                    }
                });

                data_field = select.find(':selected').attr('value');

                if (data_field) {

                    field = container.find('#' + data_field);

                    if (field.length) {
                        field.slideDown();
                    }
                }
            });
        });
    });
})(jQuery);