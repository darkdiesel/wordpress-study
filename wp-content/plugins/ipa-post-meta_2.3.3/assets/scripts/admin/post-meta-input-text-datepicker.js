(function ($) {
    $(document).ready(function () {
        $(".ipa-meta-box-container").each(function () {
            // datepicker
            $(this).find(".ipa-meta-box-input-text-datepicker").datepicker({
                dateFormat: 'dd/mm/yy'
            });
        });
    });
})(jQuery);