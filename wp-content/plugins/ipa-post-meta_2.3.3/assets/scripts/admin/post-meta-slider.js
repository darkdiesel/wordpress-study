(function ($) {
    $(document).ready(function () {
        $(".ipa-meta-box-container").each(function () {
            // slider
            $(this).find('.ipa-meta-box-slider-wrapper').each(function(){
                // slider - add slide button
                $(this).on('click', '.ipa-meta-box-add-slide-btn', function () {
                    var btn = $(this);

                    var slides_container = btn.siblings('.ipa-meta-box-slider-items-container');

                    var custom_uploader = wp.media({
                        title: btn.attr('data-title'),
                        button: {text: btn.attr('data-button')},
                        library: {type: btn.data('type')},
                        multiple: false
                    }).on('select', function () {
                        var attachment = custom_uploader.state().get('selection').first().toJSON();

                        if (btn.data('type') == 'image') {
                            // items
                            var items = slides_container.find('.ipa-meta-box-slider-items');

                            // slider_name
                            var slider_name = slides_container.data('slider-name');
                            var slider_post_name = slides_container.data('slider-post-name');

                            // count slides in slider
                            var items_count = items.data('total-items');

                            // generate new classes for slide
                            var new_dialog_class = slider_name + '-options-' + (items_count + 1);
                            var new_slide_item_class = 'ipa-meta-box-slider-item-' + (items_count + 1);

                            var output_html = '';

                            output_html += '<li class="ipa-meta-box-slider-item ' + new_slide_item_class + '">';
                            output_html += '<div>';

                            if (typeof (attachment.sizes.thumbnail) !== 'undefined') {
                                output_html += '<div class="ipa-meta-box-slide-image-thumbnail">';
                                output_html += '<img src=' + attachment.sizes.thumbnail.url + ' />';
                                output_html += '<input type="hidden" name="' + slider_post_name + '[slides][' + (items_count + 1) + '][slide-image-id]" value="' + attachment.id + '" />';
                                output_html += '</div>';
                            } else {
                                output_html += '<div class="ipa-meta-box-slide-image-thumbnail">';
                                output_html += '<img src=' + attachment.url + ' />';
                                output_html += '<input type="hidden" name="' + slider_post_name + '[slides][' + (items_count + 1) + '][slide-image-id]" value="' + attachment.id + '" />';
                                output_html += '</div>';
                            }

                            output_html += '<input type="hidden" class="ipa-meta-box-slider-slide-title" name="' + slider_post_name + '[slides][' + (items_count + 1) + '][slide-title]" value="" />';
                            output_html += '<input type="hidden" class="ipa-meta-box-slider-slide-text" name="' + slider_post_name + '[slides][' + (items_count + 1) + '][slide-text]" value="" />';
                            output_html += '<input type="hidden" class="ipa-meta-box-slider-slide-button-text" name="' + slider_post_name + '[slides][' + (items_count + 1) + '][slide-button-text]" value="" />';
                            output_html += '<input type="hidden" class="ipa-meta-box-slider-slide-button-url" name="' + slider_post_name + '[slides][' + (items_count + 1) + '][slide-button-url]" value="" />';

                            output_html += '<a href="#" class="ipa-meta-box-slide-edit-btn" data-dialog-class="' + new_dialog_class + '">';
                            output_html += '<span class="dashicons dashicons-edit"></span>';
                            output_html += '</a>';

                            output_html += '<a href="#" class="ipa-meta-box-slide-delete-btn">';
                            output_html += '<span class="dashicons dashicons-trash"></span>';
                            output_html += '</a>';

                            // jQuery UI dialog with slider options
                            output_html += '<div class="ipa-meta-box-slide-options ' + new_dialog_class + '" title="Edit Slide" data-slide="' + new_slide_item_class + '">';
                            output_html += '<form>';

                            output_html += '<label for="slide-title" class="ipa-meta-box-slide-dialog-label">Slide Title</label>';
                            output_html += '<input type="text" name="slide-title" value="" class="text ui-widget-content ui-corner-all ipa-meta-box-slide-dialog-slide-title" />';

                            output_html += '<label for="slide-text" class="ipa-meta-box-slide-dialog-label">Slide Text</label>';
                            output_html += '<textarea name="slide-text" class="ipa-meta-box-slide-dialog-slide-text"></textarea>';

                            output_html += '<label for="slide-button-text" class="ipa-meta-box-slide-dialog-label">Slide Button Text</label>';
                            output_html += '<input type="text" name="slide-button-text" value="" class="text ui-widget-content ui-corner-all ipa-meta-box-slide-dialog-slide-button-text" />';

                            output_html += '<label for="slide-button-url" class="ipa-meta-box-slide-dialog-label">Slide Button URL</label>';
                            output_html += '<input type="text" name="slide-button-url" value="" class="text ui-widget-content ui-corner-all ipa-meta-box-slide-dialog-slide-button-url" />';

                            output_html += '</form>';
                            output_html += '</div>';

                            output_html += '</div>';
                            output_html += '</li>';

                            items.append(output_html);

                            $('.' + new_dialog_class).dialog({
                                autoOpen: false,
                                show: {
                                    effect: "blind",
                                    duration: 1000
                                },
                                hide: {
                                    effect: "explode",
                                    duration: 1000
                                },
                                buttons: {
                                    "Save": function () {
                                        var edited_slide = $('.' + $(this).data('slide'));

                                        $(edited_slide).find('.ipa-meta-box-slider-slide-title').val($(this).find('.ipa-meta-box-slide-dialog-slide-title').val());
                                        $(edited_slide).find('.ipa-meta-box-slider-slide-text').val($(this).find('.ipa-meta-box-slide-dialog-slide-text').val());
                                        $(edited_slide).find('.ipa-meta-box-slider-slide-button-text').val($(this).find('.ipa-meta-box-slide-dialog-slide-button-text').val());
                                        $(edited_slide).find('.ipa-meta-box-slider-slide-button-url').val($(this).find('.ipa-meta-box-slide-dialog-slide-button-url').val());

                                        $(this).dialog("close");
                                    },
                                    Cancel: function () {
                                        $(this).dialog("close");
                                    }
                                }
                            });

                            items.data('total-items', items.data('total-items') + 1);
                        }
                        //btn.siblings('#upload_image_text_meta').val(attachment.url);
                        //btn.siblings('#upload_image_attachment_id').val(attachment.id);
                    }).open();
                });

                // slider - save button for slide dialog
                $(this).find('.ipa-meta-box-slider-item').each(function () {
                    var slider_item = $(this);
                    var new_dialog_class = $(this).find('.ipa-meta-box-slide-edit-btn').data('dialog-class');

                    $('.' + new_dialog_class).dialog({
                        autoOpen: false,
                        show: {
                            effect: "blind",
                            duration: 1000
                        },
                        hide: {
                            effect: "explode",
                            duration: 1000
                        },
                        buttons: {
                            "Save": function () {
                                $(slider_item).find('.ipa-meta-box-slider-slide-title').val($(this).find('.ipa-meta-box-slide-dialog-slide-title').val());
                                $(slider_item).find('.ipa-meta-box-slider-slide-text').val($(this).find('.ipa-meta-box-slide-dialog-slide-text').val());
                                $(slider_item).find('.ipa-meta-box-slider-slide-button-text').val($(this).find('.ipa-meta-box-slide-dialog-slide-button-text').val());
                                $(slider_item).find('.ipa-meta-box-slider-slide-button-url').val($(this).find('.ipa-meta-box-slide-dialog-slide-button-url').val());

                                $(this).dialog("close");
                            },
                            Cancel: function () {
                                $(this).dialog("close");
                            }
                        }
                    });
                });

                // slider - edit slide button
                $(this).on('click', '.ipa-meta-box-slide-edit-btn', function (e) {
                    e.preventDefault();
                    var dialog = $(this).data('dialog-class');

                    $('.' + dialog).dialog("open");
                });

                // slider - delete slide button
                $(this).on('click', '.ipa-meta-box-slide-delete-btn', function (e) {
                    e.preventDefault();

                    $(this).closest('.ipa-meta-box-slider-item').slideUp("normal", function () {
                            $(this).remove();
                        }
                    );
                });

                // slider - sortarable items
                $(this).find(".ipa-meta-box-slider-items").each(function(){
                    $(this).sortable();
                    $(this).disableSelection();
                });
            });
        });
    });
})(jQuery);