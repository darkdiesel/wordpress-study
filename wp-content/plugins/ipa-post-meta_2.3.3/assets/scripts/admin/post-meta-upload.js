(function ($) {
    $(document).ready(function () {
        $(".ipa-meta-box-container").each(function () {
            // slider
            $(this).find('.ipa-meta-box-upload-wrapper').each(function(){
                var upload_wrapper = $(this);

                upload_wrapper.on('click', '.ipa-meta-box-upload-btn', function(e){
                    e.preventDefault();

                    var upload_btn = $(this);
                    var data_type = upload_btn.data('type');

                    var custom_uploader = wp.media({
                        title: upload_btn.data('title'),
                        button: { text: upload_btn.data('button') },
                        library: { type: 'image' },
                        multiple: false
                    }).on('select',function () {
                        var attachment = custom_uploader.state().get('selection').first().toJSON();

                        if (data_type == 'image') {

                            var html = '';

                            html = '<div class="ipa-meta-box-upload-thumbnail-image-wrapper">';

                            if (typeof (attachment.sizes.thumbnail) !== 'undefined') {
                                html += '<img src=' + attachment.sizes.thumbnail.url + ' />';
                            } else {
                                html += '<img src=' + attachment.url + ' />';
                            }

                            html += '</div>';

                            html += '<div class="ipa-meta-box-upload-dialog" title="Edit Slide">';
                            html += '<form>';
                            html += '<label class="ipa-meta-box-upload-dialog-label">Image Title</label>';
                            html += '<input type="text" name="upload-title" value="" class="text ui-widget-content ui-corner-all ipa-meta-box-upload-dialog-upload-title"/>';
                            html += '<label class="ipa-meta-box-upload-dialog-label">Image Text</label>';
                            html += '<textarea name="slide-text" class="ipa-meta-box-upload-dialog-upload-text"></textarea>';
                            html += '<label class="ipa-meta-box-upload-dialog-label">Image URL</label>';
                            html += '<input type="text" name="upload-url" value="" class="text ui-widget-content ui-corner-all ipa-meta-box-upload-dialog-upload-url"/>';
                            html += '</form>';
                            html += '</div>';

                            html += '<a href="#" class="ipa-meta-box-upload-edit-btn">';
                            html += '<span class="dashicons dashicons-edit"></span>';
                            html += '</a>';

                            html += '<a href="#" class="ipa-meta-box-upload-delete-btn">';
                            html += '<span class="dashicons dashicons-trash"></span>';
                            html += '</a>';

                            upload_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-thumbnail-image').html(html);

                            // upload dialog
                            upload_wrapper.find('.ipa-meta-box-upload-dialog').dialog({
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
                                        upload_wrapper.find('.ipa-meta-box-upload-title').val($(this).find('.ipa-meta-box-upload-dialog-upload-title').val());
                                        upload_wrapper.find('.ipa-meta-box-upload-text').val($(this).find('.ipa-meta-box-upload-dialog-upload-text').val());
                                        upload_wrapper.find('.ipa-meta-box-upload-url').val($(this).find('.ipa-meta-box-upload-dialog-upload-url').val());

                                        $(this).dialog("close");
                                    },
                                    Cancel: function () {
                                        $(this).dialog("close");
                                    }
                                }
                            });
                        }

                        upload_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-image-url').val(attachment.url);
                        upload_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-attachment-id').val(attachment.id);
                    }).open();
                });

                upload_wrapper.on('click', '.ipa-meta-box-upload-delete-btn', function(e){
                    e.preventDefault();

                    var delete_btn = $(this);

                    delete_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-image-url').val("");
                    delete_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-attachment-id').val("");

                    delete_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-title').val("");
                    delete_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-text').val("");
                    delete_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-url').val("");

                    delete_btn.closest('.ipa-meta-box-container').find('.ipa-meta-box-upload-thumbnail-image').html('');

                    $('.ipa-meta-box-upload-dialog').dialog('destroy').remove();
                });

                // upload dialog
                upload_wrapper.find('.ipa-meta-box-upload-dialog').dialog({
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
                            upload_wrapper.find('.ipa-meta-box-upload-title').val($(this).find('.ipa-meta-box-upload-dialog-upload-title').val());
                            upload_wrapper.find('.ipa-meta-box-upload-text').val($(this).find('.ipa-meta-box-upload-dialog-upload-text').val());
                            upload_wrapper.find('.ipa-meta-box-upload-url').val($(this).find('.ipa-meta-box-upload-dialog-upload-url').val());

                            $(this).dialog("close");
                        },
                        Cancel: function () {
                            $(this).dialog("close");
                        }
                    }
                });

                upload_wrapper.on('click', '.ipa-meta-box-upload-edit-btn', function(e){
                    e.preventDefault();

                    $('.ipa-meta-box-upload-dialog').dialog('open');
                });
            });
        });
    });
})(jQuery);