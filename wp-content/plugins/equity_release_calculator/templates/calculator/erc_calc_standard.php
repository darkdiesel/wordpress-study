<?php
global $isErcIframeMode;

//include_once 'functionality.php';
wp_register_script('erc_calc.js', WP_PLUGIN_URL . '/equity_release_calculator/assets/js/erc_calc.js');
wp_enqueue_script('erc_calc.js');

wp_localize_script(
	'erc_calc.js', 'er_calculator_vars',
	array(
		'wpnonce_calculate'  => wp_create_nonce( 'er_calculator_calculate_wpnonce' ),
		'wpnonce_adwords'  => wp_create_nonce( 'er_calculator_adwords_wpnonce' ),
		'ajax_url' => admin_url( 'admin-ajax.php' )
	)
);

wp_register_style('bootstrap.css', WP_PLUGIN_URL . '/equity_release_calculator/assets/css/bootstrap.css');
wp_enqueue_style('bootstrap.css');

wp_register_style('view.css', WP_PLUGIN_URL . '/equity_release_calculator/assets/css/view.css');
wp_enqueue_style('view.css');


wp_register_script('bootstrap.js', WP_PLUGIN_URL . '/equity_release_calculator/assets/js/bootstrap.js');
wp_enqueue_script('bootstrap.js');

$ercMainAreaBorder = "";
$ercMainAreaBorder .= "border-width: ".get_option('erc_main_area_border_width')."px;";
$ercMainAreaBorder .= "border-color: ".get_option('erc_' . $calc['id']  .  '_main_area_border_color').";";
$ercMainAreaBorder .= "border-style: ".get_option('erc_' . $calc['id']  .  '_main_area_border_style').";";
$ercMainAreaBorder .= "border-radius: ".get_option('erc_' . $calc['id']  .  '_main_area_border_radius')."px;";

$ercMainAreaBackground = "background-color: ".get_option('erc_' . $calc['id']  .  '_main_area_background_color')."; ";
$ercMainAreaBackground .= ER_Calculator()->functions->ercGenerateGradient(
    get_option('erc_' . $calc['id']  .  '_main_area_gradient_type'),
    get_option('erc_' . $calc['id']  .  '_main_area_gradient_linerc_position'),
    get_option('erc_' . $calc['id']  .  '_main_area_gradient_begin_color'),
    get_option('erc_' . $calc['id']  .  '_main_area_background_color')
);

$ercMainAreaTitle = "";
$ercMainAreaTitle .= "font-weight: ".get_option('erc_' . $calc['id']  .  '_main_area_title_font_weight').";";
$ercMainAreaTitle .= "font-family: ".get_option('erc_' . $calc['id']  .  '_main_area_title_font_family').";";
$ercMainAreaTitle .= "text-transform: ".get_option('erc_' . $calc['id']  .  '_main_area_title_text_transform').";";
$ercMainAreaTitle .= "color: ".get_option('erc_' . $calc['id']  .  '_main_area_title_text_color').";";
$ercMainAreaTitle .= "font-size: ".get_option('erc_' . $calc['id']  .  '_main_area_title_font_size')."px;";
$ercMainAreaTitle .= "font-style: ".get_option('erc_' . $calc['id']  .  '_main_area_title_font_style').";";
$ercMainAreaTitle .= "text-align: ".get_option('erc_' . $calc['id']  .  '_main_area_title_text_align').";";
$ercMainAreaTitle .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_main_area_title_padding_top')."px;";
$ercMainAreaTitle .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_main_area_title_padding_bottom')."px;";
$ercMainAreaTitle .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_main_area_title_padding_left')."px;";
$ercMainAreaTitle .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_main_area_title_padding_right')."px;";

$ercTextAreaOne = "";
$ercTextAreaOne .= "font-weight: ".get_option('erc_' . $calc['id']  .  '_text_area_one_font_weight').";";
$ercTextAreaOne .= "text-transform: ".get_option('erc_' . $calc['id']  .  '_text_area_one_text_transform').";";
$ercTextAreaOne .= "color: ".get_option('erc_' . $calc['id']  .  '_text_area_one_text_color').";";
$ercTextAreaOne .= "font-family: ".get_option('erc_' . $calc['id']  .  '_text_area_one_font_family').";";
$ercTextAreaOne .= "font-size: ".get_option('erc_' . $calc['id']  .  '_text_area_one_font_size')."px;";
$ercTextAreaOne .= "font-style: ".get_option('erc_' . $calc['id']  .  '_text_area_one_font_style').";";
$ercTextAreaOne .= "text-align: ".get_option('erc_' . $calc['id']  .  '_text_area_one_text_align').";";
$ercTextAreaOne .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_text_area_one_padding_top')."px;";
$ercTextAreaOne .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_text_area_one_padding_bottom')."px;";
$ercTextAreaOne .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_text_area_one_padding_left')."px;";
$ercTextAreaOne .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_text_area_one_padding_right')."px;";

$ercTextAreaOneLine = "";
$ercTextAreaOneLine .= "border-width: ".get_option('erc_' . $calc['id']  .  '_text_area_one_line_border_width')."px;";
$ercTextAreaOneLine .= "border-color: ".get_option('erc_' . $calc['id']  .  '_text_area_one_line_border_color').";";
$ercTextAreaOneLine .= "background-color: ".get_option('erc_' . $calc['id']  .  '_text_area_one_line_border_color').";";
$ercTextAreaOneLine .= "border-style: ".get_option('erc_' . $calc['id']  .  '_text_area_one_line_border_style').";";
$ercTextAreaOneLine .= 'margin-left: ' . get_option('erc_' . $calc['id']  .  '_text_area_one_line_padding_left') . 'px;';
$ercTextAreaOneLine .= 'margin-right: ' . get_option('erc_' . $calc['id']  .  '_text_area_one_line_padding_right') . 'px;';
$ercTextAreaOneLine .= 'margin-top: ' . get_option('erc_' . $calc['id']  .  '_text_area_one_line_padding_top') . 'px;';
$ercTextAreaOneLine .= 'margin-bottom: ' . get_option('erc_' . $calc['id']  .  '_text_area_one_line_padding_bottom') . 'px;';

$ercResultTextAreaOne = "";
$ercResultTextAreaOne .= "font-weight: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_font_weight').";";
$ercResultTextAreaOne .= "text-transform: ". get_option('erc_' . $calc['id']  .  '_result_text_area_one_text_transform').";";
$ercResultTextAreaOne .= "color: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_text_color').";";
$ercResultTextAreaOne .= "font-family: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_font_family').";";
$ercResultTextAreaOne .= "font-size: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_font_size')."px;";
$ercResultTextAreaOne .= "font-style: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_font_style').";";
$ercResultTextAreaOne .= "text-align: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_text_align').";";
$ercResultTextAreaOne .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_padding_top')."px;";
$ercResultTextAreaOne .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_padding_bottom')."px;";
$ercResultTextAreaOne .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_padding_left')."px;";
$ercResultTextAreaOne .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_padding_right')."px;";

$ercResultTextAreaOneLine = "";
$ercResultTextAreaOneLine .= "border-width: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_border_width')."px;";
$ercResultTextAreaOneLine .= "border-color: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_border_color').";";
$ercResultTextAreaOneLine .= "background-color: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_border_color').";";
$ercResultTextAreaOneLine .= "border-style: ".get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_border_style').";";
$ercResultTextAreaOneLine .= 'margin-left: ' . get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_padding_left') . 'px;';
$ercResultTextAreaOneLine .= 'margin-right: ' . get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_padding_right') . 'px;';
$ercResultTextAreaOneLine .= 'margin-top: ' . get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_padding_top') . 'px;';
$ercResultTextAreaOneLine .= 'margin-bottom: ' . get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_padding_bottom') . 'px;';

$ercTextAreaTwo = "";
$ercTextAreaTwo .= "font-weight: ".get_option('erc_' . $calc['id']  .  '_text_area_two_font_weight').";";
$ercTextAreaTwo .= "font-family: ".get_option('erc_' . $calc['id']  .  '_text_area_two_font_family').";";
$ercTextAreaTwo .= "text-transform: ".get_option('erc_' . $calc['id']  .  '_text_area_two_text_transform').";";
$ercTextAreaTwo .= "color: ".get_option('erc_' . $calc['id']  .  '_text_area_two_text_color').";";
$ercTextAreaTwo .= "font-size: ".get_option('erc_' . $calc['id']  .  '_text_area_two_font_size')."px;";
$ercTextAreaTwo .= "font-style: ".get_option('erc_' . $calc['id']  .  '_text_area_two_font_style').";";
$ercTextAreaTwo .= "text-align: ".get_option('erc_' . $calc['id']  .  '_text_area_two_text_align').";";
$ercTextAreaTwo .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_text_area_two_padding_top')."px;";
$ercTextAreaTwo .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_text_area_two_padding_bottom')."px;";
$ercTextAreaTwo .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_text_area_two_padding_left')."px;";
$ercTextAreaTwo .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_text_area_two_padding_right')."px;";

$ercTextAreaTwoLine = "";
$ercTextAreaTwoLine .= "border-width: ".get_option('erc_' . $calc['id']  .  '_text_area_two_line_border_width')."px;";
$ercTextAreaTwoLine .= "border-color: ".get_option('erc_' . $calc['id']  .  '_text_area_two_line_border_color').";";
$ercTextAreaTwoLine .= "background-color: ".get_option('erc_' . $calc['id']  .  '_text_area_two_line_border_color').";";
$ercTextAreaTwoLine .= "border-style: ".get_option('erc_' . $calc['id']  .  '_text_area_two_line_border_style').";";

$ercResultTextAreaTwo = "";
$ercResultTextAreaTwo .= "font-weight: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_font_weight').";";
$ercResultTextAreaTwo .= "font-family: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_font_family').";";
$ercResultTextAreaTwo .= "text-transform: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_text_transform').";";
$ercResultTextAreaTwo .= "color: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_text_color').";";
$ercResultTextAreaTwo .= "font-size: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_font_size')."px;";
$ercResultTextAreaTwo .= "font-style: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_font_style').";";
$ercResultTextAreaTwo .= "text-align: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_text_align').";";
$ercResultTextAreaTwo .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_padding_top')."px;";
$ercResultTextAreaTwo .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_padding_bottom')."px;";
$ercResultTextAreaTwo .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_padding_left')."px;";
$ercResultTextAreaTwo .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_padding_right')."px;";

$ercResultTextAreaTwoLine = "";
$ercResultTextAreaTwoLine .= "border-width: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_line_border_width')."px;";
$ercResultTextAreaTwoLine .= "border-color: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_line_border_color').";";
$ercResultTextAreaTwoLine .= "background-color: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_line_border_color').";";
$ercResultTextAreaTwoLine .= "border-style: ".get_option('erc_' . $calc['id']  .  '_result_text_area_two_line_border_style').";";

$ercBorderArea = '';
$ercBorderArea .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_body_area_margin_tb')."px;";
$ercBorderArea .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_body_area_margin_tb')."px;";
$ercBorderArea .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_body_area_margin_lr')."px;";
$ercBorderArea .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_body_area_margin_lr')."px;";

$ercInputFields = '';
$ercInputFields .= 'width: ' . get_option('erc_' . $calc['id']  .  '_input_fields_width') . get_option('erc_' . $calc['id']  .  '_input_fields_width_px') .';';
$ercInputFields .= 'height: ' . get_option('erc_' . $calc['id']  .  '_input_fields_height') . get_option('erc_' . $calc['id']  .  '_input_fields_height_px') .';';
$ercInputFields .= "border-radius: ".get_option('erc_' . $calc['id']  .  '_input_fields_border_radius')."px;";
$ercInputFields .= "text-align: ".get_option('erc_' . $calc['id']  .  '_input_fields_text_align').";";
$ercInputFields .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_input_fields_padding_top')."px;";
$ercInputFields .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_input_fields_padding_bottom')."px;";
$ercInputFields .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_input_fields_padding_left')."px;";
$ercInputFields .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_input_fields_padding_right')."px;";
$ercInputFields .= "font-size: ".get_option('erc_' . $calc['id']  .  '_input_fields_font_size')."px;";

$ercCalc = '';
$ercCalc .= 'width:  ' . get_option('erc_' . $calc['id']  .  '_calc_size_width') . 'px;';
$ercCalc .= 'height: ' . get_option('erc_' . $calc['id']  .  '_calc_size_height') . 'px;';
$ercCalc .= 'float: ' . get_option('erc_' . $calc['id']  .  '_main_area_float') . ';';
$ercCalc .= 'margin-left: ' . get_option('erc_' . $calc['id']  .  '_main_area_margin_lr') . 'px;';
$ercCalc .= 'margin-right: ' . get_option('erc_' . $calc['id']  .  '_main_area_margin_lr') . 'px;';
$ercCalc .= 'margin-top: ' . get_option('erc_' . $calc['id']  .  '_main_area_margin_tb') . 'px;';
$ercCalc .= 'margin-bottom: ' . get_option('erc_' . $calc['id']  .  '_main_area_margin_tb') . 'px;';

if (get_option('erc_' . $calc['id']  .  '_calc_image_enabled')) {
    $ercCalc .= "background-image: url('" . get_option('erc_' . $calc['id']  .  '_calc_image_url') ."');";
    $ercCalc .= "background-repeat: no-repeat;";
}

//$ercCalc .= 'top: ' . get_option('erc_' . $calc['id']  .  '_calc_top') . 'px;';
//$ercCalc .= 'right: ' . get_option('erc_' . $calc['id']  .  '_calc_right') . 'px;';
//$ercCalc .= 'bottom: ' . get_option('erc_' . $calc['id']  .  '_calc_bottom') . 'px;';
//$ercCalc .= 'left: ' . get_option('erc_' . $calc['id']  .  '_calc_left') . 'px;';

$ercTitleField = "";
$ercTitleField .= "font-weight: ".get_option('erc_' . $calc['id']  .  '_title_field_font_weight').";";
$ercTitleField .= "font-family: ".get_option('erc_' . $calc['id']  .  '_title_field_font_family').";";
$ercTitleField .= "text-transform: ".get_option('erc_' . $calc['id']  .  '_title_field_text_transform').";";
$ercTitleField .= "color: ".get_option('erc_' . $calc['id']  .  '_title_field_text_color').";";
$ercTitleField .= "font-size: ".get_option('erc_' . $calc['id']  .  '_title_field_font_size')."px;";
$ercTitleField .= "font-style: ".get_option('erc_' . $calc['id']  .  '_title_field_font_style').";";
$ercTitleField .= "text-align: ".get_option('erc_' . $calc['id']  .  '_title_field_text_align').";";
$ercTitleField .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_title_field_padding_top')."px;";
$ercTitleField .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_title_field_padding_bottom')."px;";
$ercTitleField .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_title_field_padding_left')."px;";
$ercTitleField .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_title_field_padding_right')."px;";

$ercButtonCalculate = "";
$ercButtonCalculate .= "-moz-box-sizing: border-box; -web-box-sizing: border-box; box-sizing: border-box;";
if (get_option('erc_' . $calc['id']  .  '_calculate_button_image_enabled')) {
    $ercButtonCalculate .= "background-image: url('" . get_option('erc_' . $calc['id']  .  '_calculate_button_image_url') ."');";
}

$ercButtonReCalculate = "";
$ercButtonReCalculate .= "-moz-box-sizing: border-box; -web-box-sizing: border-box; box-sizing: border-box;";
if (get_option('erc_' . $calc['id']  .  '_recalculate_button_image_enabled')) {
    $ercButtonReCalculate .= "background-image: url('" . get_option('erc_' . $calc['id']  .  '_recalculate_button_image_url') ."');";
}

$ercBodyLineBefore = "";
$ercBodyLineBefore .= "border-width: ".get_option('erc_' . $calc['id']  .  '_body_container_line_before_border_width')."px;";
$ercBodyLineBefore .= "border-color: ".get_option('erc_' . $calc['id']  .  '_body_container_line_before_border_color').";";
$ercBodyLineBefore .= "background-color: ".get_option('erc_' . $calc['id']  .  '_body_container_line_before_border_color').";";
$ercBodyLineBefore .= "border-style: ".get_option('erc_' . $calc['id']  .  '_body_container_line_before_border_style').";";

$ercBodyLineAfter = "";
$ercBodyLineAfter .= "border-width: ".get_option('erc_' . $calc['id']  .  '_body_container_line_after_border_width')."px;";
$ercBodyLineAfter .= "border-color: ".get_option('erc_' . $calc['id']  .  '_body_container_line_after_border_color').";";
$ercBodyLineAfter .= "background-color: ".get_option('erc_' . $calc['id']  .  '_body_container_line_after_border_color').";";
$ercBodyLineAfter .= "border-style: ".get_option('erc_' . $calc['id']  .  '_body_container_line_after_border_style').";";

$ercResultLabel = "";
$ercResultLabel .= "font-weight: ".get_option('erc_' . $calc['id']  .  '_result_label_font_weight').";";
$ercResultLabel .= "font-family: ".get_option('erc_' . $calc['id']  .  '_result_label_font_family').";";
$ercResultLabel .= "text-transform: ".get_option('erc_' . $calc['id']  .  '_result_label_text_transform').";";
$ercResultLabel .= "color: ".get_option('erc_' . $calc['id']  .  '_result_label_text_color').";";
$ercResultLabel .= "font-size: ".get_option('erc_' . $calc['id']  .  '_result_label_font_size')."px;";
$ercResultLabel .= "font-style: ".get_option('erc_' . $calc['id']  .  '_result_label_font_style').";";

$ercResultValue  = "";
$ercResultValue .= "font-weight: ".get_option('erc_' . $calc['id']  .  '_result_value_font_weight').";";
$ercResultValue .= "font-family: ".get_option('erc_' . $calc['id']  .  '_result_value_font_family').";";
$ercResultValue .= "text-transform: ".get_option('erc_' . $calc['id']  .  '_result_value_text_transform').";";
$ercResultValue .= "color: ".get_option('erc_' . $calc['id']  .  '_result_value_text_color').";";
$ercResultValue .= "font-size: ".get_option('erc_' . $calc['id']  .  '_result_value_font_size')."px;";
$ercResultValue .= "font-style: ".get_option('erc_' . $calc['id']  .  '_result_value_font_style').";";
$ercResultValue .= "border-width: ".get_option('erc_' . $calc['id']  .  '_result_value_border_width')."px;";
$ercResultValue .= "border-color: ".get_option('erc_' . $calc['id']  .  '_result_value_border_color').";";
$ercResultValue .= "border-style: ".get_option('erc_' . $calc['id']  .  '_result_value_border_style').";";
$ercResultValue .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_result_value_padding_top')."px;";
$ercResultValue .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_result_value_padding_bottom')."px;";
$ercResultValue .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_result_value_padding_left')."px;";
$ercResultValue .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_result_value_padding_right')."px;";
$ercResultValue .= "background-color: ".get_option('erc_' . $calc['id']  .  '_result_value_background_color').";";
$ercResultValue .= "border-radius: ".get_option('erc_' . $calc['id']  .  '_result_value_border_radius')."px;";
$ercResultValue .= "width: ".get_option('erc_' . $calc['id']  .  '_result_value_width')."px;";
$ercResultValue .= "text-align: ".get_option('erc_' . $calc['id']  .  '_result_value_text_align').";";

$ercResultRow = '';
$ercResultRow .= "padding-top: ".get_option('erc_' . $calc['id']  .  '_result_row_padding_top')."px;";
$ercResultRow .= "padding-bottom: ".get_option('erc_' . $calc['id']  .  '_result_row_padding_bottom')."px;";
$ercResultRow .= "padding-left: ".get_option('erc_' . $calc['id']  .  '_result_row_padding_left')."px;";
$ercResultRow .= "padding-right: ".get_option('erc_' . $calc['id']  .  '_result_row_padding_right')."px;";

$ercResultRowValue = '';
$ercResultRowValue .= "width: ".get_option('erc_' . $calc['id']  .  '_result_value_width')."px;";

if (get_option('erc_' . $calc['id'] . '_calculate_button_gradient_type') != 'none') {
	$gradientCB = ercGenerateGradient(
		get_option('erc_' . $calc['id'] . '_calculate_button_gradient_type'),
		get_option('erc_' . $calc['id'] . '_calculate_button_gradient_liner_position'),
		get_option('erc_' . $calc['id'] . '_calculate_button_gradient_begin_color'),
		get_option('erc_' . $calc['id'] . '_calculate_button_background_color')
	);
	$gradientCBHover = ercGenerateGradient(
		get_option('erc_' . $calc['id'] . '_calculate_button_gradient_type'),
		get_option('erc_' . $calc['id'] . '_calculate_button_gradient_radial_position'),
		get_option('erc_' . $calc['id'] . '_calculate_button_gradient_hover_begin'),
		get_option('erc_' . $calc['id'] . '_calculate_button_hover_background_color')
	);
}

if (get_option('erc_' . $calc['id'] . '_recalculate_button_gradient_type') != 'none') {
	$gradientRCB = ercGenerateGradient(
		get_option('erc_' . $calc['id'] . '_recalculate_button_gradient_type'),
		get_option('erc_' . $calc['id'] . '_recalculate_button_gradient_liner_position'),
		get_option('erc_' . $calc['id'] . '_recalculate_button_gradient_begin_color'),
		get_option('erc_' . $calc['id'] . '_recalculate_button_background_color')
	);
	$gradientRCBHover = ercGenerateGradient(
		get_option('erc_' . $calc['id'] . '_recalculate_button_gradient_type'),
		get_option('erc_' . $calc['id'] . '_recalculate_button_gradient_radial_position'),
		get_option('erc_' . $calc['id'] . '_recalculate_button_gradient_hover_begin'),
		get_option('erc_' . $calc['id'] . '_recalculate_button_hover_background_color')
	);
}
?>

<?php if ( $isErcIframeMode ): ?>
<script>
    jQuery(function($){
        $('body').css('background-color', '<?php echo get_option('erc_' . $calc['id']  .  '_iframe_background_color'); ?>');
    });
</script>
<?php endif; ?>

<script>
    jQuery(function(){
        Calc_<?php echo $calc['id']; ?> = new Calc(
            <?php echo $calc['id']; ?>,
            <?php echo $calc['standard']; ?>,
            <?php echo $calc['enhanced']; ?>,
            <?php echo $calc['interest_only']; ?>,
            <?php echo $calc['home_reversion']; ?>,
            '<?php echo str_replace("\r\n",'', strip_tags($calc['title'])); ?>'
        );
        Calc_<?php echo $calc['id']; ?>.setPercentage('<?php echo json_encode($percentages); ?>');
        Calc_<?php echo $calc['id']; ?>.setPercentageHr('<?php echo json_encode($percentagesHr); ?>');
        Calc_<?php echo $calc['id']; ?>.init();
    })
</script>

<style>
    .erc_input_fields_<?php echo $calc['id']; ?> {
        border-color: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_border_color'); ?>;
        border-width: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_border_width'); ?>px;
        border-style: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_border_style'); ?>;
    }
    .erc_input_fields_<?php echo $calc['id']; ?>:focus {
        border-color: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_focus_border_color'); ?> !important;
        border-width: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_focus_border_width'); ?>px !important;
        border-style: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_focus_border_style'); ?> !important;
    }

    .erc_input_fields_alert_<?php echo $calc['id']; ?> {
        border-color: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_alert_border_color'); ?> !important;
        border-width: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_alert_border_width'); ?>px !important;
        border-style: <?php echo get_option('erc_' . $calc['id'] . '_input_fields_alert_border_style'); ?> !important;
    }

    .erc_calculate_button_container_<?php echo $calc['id']; ?> {
        text-align: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_container_text_align'); ?>!important;
        padding-left: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_container_padding_left'); ?>px !important;
        padding-right: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_container_padding_right'); ?>px !important;
        padding-top: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_container_padding_top'); ?>px !important;
        padding-bottom: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_container_padding_bottom'); ?>px !important;
    }

    .erc_recalculate_button_container_<?php echo $calc['id']; ?> {
        text-align: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_container_text_align'); ?>!important;
        padding-left: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_container_padding_left'); ?>px !important;
        padding-right: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_container_padding_right'); ?>px !important;
        padding-top: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_container_padding_top'); ?>px !important;
        padding-bottom: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_container_padding_bottom'); ?>px !important;
    }

    .erc_calculate_button_<?php echo $calc['id']; ?> {
        /*
         -moz-box-sizing: border-box;
         -web-box-sizing: border-box;
         box-sizing: border-box;*/

        display: inline-block !important;
        background-repeat: no-repeat;
        width: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_size_width'); ?>px !important;
        height: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_size_height'); ?>px !important;

        text-align: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_text_align'); ?>!important;
        padding-left: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_padding_left'); ?>px !important;
        padding-right: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_padding_right'); ?>px !important;
        padding-top: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_padding_top'); ?>px !important;
        padding-bottom: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_padding_bottom'); ?>px !important;

        font-family: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_font_family'); ?> !important;
        font-size: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_font_size'); ?>px !important;
        font-style: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_font_style'); ?> !important;
        font-weight: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_font_weight'); ?> !important;
        text-transform: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_text_transform'); ?> !important;
        color: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_text_color'); ?> !important;

        background-color: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_background_color'); ?> !important;
        <?php echo $gradientCB; ?>

        border-color: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_border_color'); ?> !important;
        border-width: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_border_width'); ?>px !important;
        border-style: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_border_style'); ?> !important;
        border-radius: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_border_radius'); ?>px !important;
        text-decoration: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_text_decoration'); ?> !important;

        line-height:<?php echo get_option('erc_' . $calc['id'] . '_calculate_button_font_size'); ?>px !important;
        outline: none !important;
    }

    .erc_calculate_button_<?php echo $calc['id']; ?>:hover {
        color: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_text_hover_color'); ?> !important;
        background-color: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_hover_background_color'); ?> !important;
        text-decoration: <?php echo get_option('erc_' . $calc['id'] . '_calculate_button_hover_text_decoration'); ?> !important;
        <?php echo $gradientCBHover; ?>
    }

    .erc_recalculate_button_<?php echo $calc['id']; ?> {
        /*
         -moz-box-sizing: border-box;
         -web-box-sizing: border-box;
         box-sizing: border-box;*/
        display: inline-block !important;
        background-repeat: no-repeat;
        width: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_size_width'); ?>px !important;
        height: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_size_height'); ?>px !important;

        text-align: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_text_align'); ?>!important;
        padding-left: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_padding_left'); ?>px !important;
        padding-right: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_padding_right'); ?>px !important;
        padding-top: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_padding_top'); ?>px !important;
        padding-bottom: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_padding_bottom'); ?>px !important;

        font-family: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_font_family'); ?> !important;
        font-size: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_font_size'); ?>px !important;
        font-style: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_font_style'); ?> !important;
        font-weight: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_font_weight'); ?> !important;
        text-transform: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_text_transform'); ?> !important;
        color: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_text_color'); ?> !important;

        background-color: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_background_color'); ?> !important;
        <?php echo $gradientRCB; ?>

        border-color: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_border_color'); ?> !important;
        border-width: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_border_width'); ?>px !important;
        border-style: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_border_style'); ?> !important;
        border-radius: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_border_radius'); ?>px !important;
        text-decoration: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_text_decoration'); ?> !important;

        line-height:<?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_font_size'); ?>px !important;
        outline: none !important;
    }

    .erc_recalculate_button_<?php echo $calc['id']; ?>:hover {
        color: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_text_hover_color'); ?> !important;
        background-color: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_hover_background_color'); ?> !important;
        text-decoration: <?php echo get_option('erc_' . $calc['id'] . '_recalculate_button_hover_text_decoration'); ?> !important;
        <?php echo $gradientRCBHover; ?>
    }
</style>

<div id="erc_main_area_<?php echo $calc['id'] ?>" class="erc_continer er_panel er_panel-default" style="position: relative; <?php echo $ercMainAreaBorder, $ercMainAreaBackground, $ercCalc; ?>">
    <?php if (get_option('erc_' . $calc['id']  .  '_main_area_title_enabled')): ?>
        <div  style="<?php echo $ercMainAreaTitle; ?>"><?php echo $calc['title']; ?></div>
    <?php endif; ?>

    <?php if (get_option('erc_' . $calc['id']  .  '_text_area_one_line_enabled')): ?>
        <hr id="area_one_line_<?php echo $calc['id'] ?>" style="margin: 0; padding: 0; <?php echo $ercTextAreaOneLine?>" />
    <?php endif; ?>

    <?php if (get_option('erc_' . $calc['id']  .  '_text_area_one_enabled')): ?>
        <div id="text_area_one_<?php echo $calc['id'] ?>" style="<?php echo $ercTextAreaOne; ?>"><?php echo $calc['text_area_one'] ?></div>
    <?php endif; ?>

    <?php if (get_option('erc_' . $calc['id']  .  '_result_text_area_one_line_enabled')): ?>
        <hr id="result_area_one_line_<?php echo $calc['id'] ?>" style="margin: 0; padding: 0; display: none; <?php echo $ercResultTextAreaOneLine?>" />
    <?php endif; ?>

    <?php if (get_option('erc_' . $calc['id']  .  '_result_text_area_one_enabled')): ?>
        <div id="result_text_area_one_<?php echo $calc['id'] ?>" style=" display: none; <?php echo $ercResultTextAreaOne; ?>"><?php echo $calc['result_text_area_one'] ?></div>
    <?php endif; ?>

    <div id="erc_body_container" style="<?php echo $ercBorderArea; ?>">
        <?php if (get_option('erc_' . $calc['id']  .  '_body_container_line_before_enabled')): ?>
            <hr style="margin: 10px 0; padding: 0; <?php echo $ercBodyLineBefore?>" />
        <?php endif; ?>

        <div id="erc_selectable_<?php echo $calc['id']; ?>">
            <ul style="list-style: none;" class="<?php echo get_option('erc_' . $calc['id']  .  '_calc_style') ? get_option('erc_' . $calc['id']  .  '_calc_style') : 'erc_input_container_horizontal';  ?>">
                <li style="list-style: none;">
                    <ul style="list-style: none;" class="erc_input_group">
                        <li style="list-style: none;"  class="erc_input_field">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_fullname"><?php echo get_option('erc_' . $calc['id']  .  '_title_fullname')?></span> <br/> <input class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_fullname_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_fullname_size_height'); ?>px;" id="erc_fullname_<?php echo $calc['id']; ?>" type="text" name=""/>
                        </li>
                        <li   class="erc_input_field erc_input_field_right">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_age"><?php echo get_option('erc_' . $calc['id']  .  '_title_age')?></span> <br/> <select class="erc_input_fields_<?php echo $calc['id']; ?>" name="" id="erc_age_<?php echo $calc['id']; ?>"  style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_age_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_age_size_height'); ?>px;">
                                <?php foreach($ages as $k => $v): ?>
                                    <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </li>
                    </ul>
                </li>
                
                <?php if ($calc['home_reversion']): ?>
                <li style="list-style: none;">
                    <ul style="list-style: none;"  class="erc_input_group">
                        <li style="list-style: none;" class="erc_input_field">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_marital_status"><?php echo get_option('erc_' . $calc['id']  .  '_title_status')?></span ><br/> <select class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_status_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_status_size_height'); ?>px;" id="erc_marital_status_<?php echo $calc['id']; ?>" name="">
                                <option value="single"><?php echo get_option('erc_' . $calc['id']  .  '_title_single')?></option>
                                <option value="married"><?php echo get_option('erc_' . $calc['id']  .  '_title_married')?></option>
                            </select>
                        </li>
                        <li style="list-style: none;" class="erc_input_field erc_input_field_right">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_age_spouse"><?php echo get_option('erc_' . $calc['id']  .  '_title_age_hr')?></span> <br/> <select class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_age_hr_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_age_hr_size_height'); ?>px;" id="erc_age_spouse_<?php echo $calc['id']; ?>" name="">
                                <?php foreach($percentagesHr as $percentageHr): ?>
                                    <option value="<?php echo $percentageHr['age']; ?>"><?php echo $percentageHr['age']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </li>

                    </ul>
                </li>
                <li style="list-style: none;">
                    <ul style="list-style: none;"  class="erc_input_group">
                        <li style="list-style: none;"  class="erc_input_field">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_gender"><?php echo get_option('erc_' . $calc['id']  .  '_title_gender')?></span> <br/> <select class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_gender_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_gender_size_height'); ?>px;" id="erc_gender_<?php echo $calc['id']; ?>" name="">
                                <option value="male"><?php echo get_option('erc_' . $calc['id']  .  '_title_gender_male')?></option>
                                <option value="female"><?php echo get_option('erc_' . $calc['id']  .  '_title_gender_female')?></option>
                            </select>
                        </li>
                        <li style="list-style: none;" class="erc_input_field erc_input_field_right">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_percent_er"><?php echo get_option('erc_' . $calc['id']  .  '_title_percent')?></span> <br/> <select class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_percent_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_percent_size_height'); ?>px;" id="erc_percent_er_<?php echo $calc['id']; ?>" name="">
                                <?php for($i = 30; $i <= 100; $i += 5): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?>%</option>
                                <?php endfor; ?>
                            </select>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <li style="list-style: none;">
                    <ul style="list-style: none;" class="erc_input_group">
                        <li style="list-style: none;"  class="erc_input_field">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_email"><?php echo get_option('erc_' . $calc['id']  .  '_title_email')?></span> <br/> <input class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_email_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_email_size_height'); ?>px;" id="erc_email_<?php echo $calc['id']; ?>" type="text" name=""/>
                        </li>
                        <li style="list-style: none;"  class="erc_input_field erc_input_field_right">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_property_value"><?php echo get_option('erc_' . $calc['id']  .  '_title_property_value')?></span> <br/> <input class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_property_value_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_property_value_size_height'); ?>px;" id="erc_property_value_<?php echo $calc['id']; ?>" type="text" name=""  pattern="[0-9]*" inputmode="numeric"/>
                        </li>
                    </ul>
                </li>
                <li style="list-style: none;">
                    <ul style="list-style: none;" class="erc_input_group">
                        <li style="list-style: none;"  class="erc_input_field">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_phone"><?php echo get_option('erc_' . $calc['id']  .  '_title_telephone')?></span> <br/> <input class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_telephone_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_telephone_size_height'); ?>px;" id="erc_phone_<?php echo $calc['id']; ?>" type="text" name="" pattern="[0-9]*" inputmode="numeric" />
                        </li>
                        <li style="list-style: none;" class="erc_input_field erc_input_field_right">
                            <span style="display: inline-block; width: 100%; text-align: left; <?php echo $ercTitleField; ?>" for="erc_mortage"><?php echo get_option('erc_' . $calc['id']  .  '_title_mortgage')?></span> <br/> <input class="erc_input_fields_<?php echo $calc['id']; ?>" style="<?php echo $ercInputFields; ?>; width: <?php echo get_option('erc_' . $calc['id'] . '_field_mortgage_size_width'); ?>px; height: <?php echo get_option('erc_' . $calc['id'] . '_field_mortgage_size_height'); ?>px;" id="erc_mortage_<?php echo $calc['id']; ?>" type="text" name=""  pattern="[0-9]*" inputmode="numeric" />
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="erc_result" id="erc_result_<?php echo $calc['id']; ?>" style="display: none;">
            <span id="adwordsCode" style="display: none;"></span>
            <ul style="list-style: none;" class="erc_result_horizontal">
                <li style="list-style: none;">
                    <?php if ($calc['standard']): ?>
                        <ul class="result_item" style="<?php echo $ercResultRow; ?>; list-style: none;">
                            <li style="list-style: none; <?php echo $ercResultLabel; ?>"><?php echo get_option('erc_' . $calc['id']  .  '_result_label_standard'); ?></li>
                            <li style="list-style: none;<?php echo $ercResultRowValue; ?>"><span  style="<?php echo $ercResultValue; ?> display: inline-block;" id="result_standard_<?php echo $calc['id']; ?>">N/A</span></li>
                        </ul>
                    <?php endif; ?>

                    <?php if ($calc['enhanced']): ?>
                        <ul class="result_item" style="list-style: none; <?php echo $ercResultRow; ?>">
                            <li style="list-style: none; <?php echo $ercResultLabel; ?>"><?php echo get_option('erc_' . $calc['id']  .  '_result_label_enhanced'); ?></li>
                            <li style="list-style: none; <?php echo $ercResultRowValue; ?>"><span  style="<?php echo $ercResultValue; ?> display: inline-block;" id="result_enhanced_<?php echo $calc['id']; ?>">N/A</span></li>
                        </ul>
                    <?php endif; ?>

                    <?php if ($calc['interest_only']): ?>
                        <ul class="result_item" style="list-style: none; <?php echo $ercResultRow; ?>">
                            <li style="list-style: none; <?php echo $ercResultLabel; ?>"><?php echo get_option('erc_' . $calc['id']  .  '_result_label_interest_only'); ?></li>
                            <li style="list-style: none; <?php echo $ercResultRowValue; ?>"><span style="<?php echo $ercResultValue; ?> display: inline-block;" id="result_interest_only_<?php echo $calc['id']; ?>">N/A</span></li>
                        </ul>
                    <?php endif; ?>
                    <?php if ($calc['home_reversion']): ?>
                        <ul class="result_item" style="list-style: none; <?php echo $ercResultRow; ?>">
                            <li style="list-style: none; <?php echo $ercResultLabel; ?>"><?php echo get_option('erc_' . $calc['id']  .  '_result_label_home_reversion'); ?></li>
                            <li style="list-style: none; <?php echo $ercResultRowValue; ?>"><span style="<?php echo $ercResultValue; ?> display: inline-block;" id="result_home_reversion_<?php echo $calc['id']; ?>">N/A</span></li>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        </div>

        <?php if (get_option('erc_' . $calc['id']  .  '_body_container_line_after_enabled')): ?>
            <hr style="margin: 10px 0; padding: 0; <?php echo $ercBodyLineAfter?>" />
        <?php endif; ?>

        <div id="erc_button_container_calculate_<?php echo $calc['id']; ?>" class="erc_calculate_button_container_<?php echo $calc['id']; ?>" style="">
            <a style="<?php echo $ercButtonCalculate; ?>" title="<?php echo get_option('erc_' . $calc['id']  .  '_calculate_button_image_title')?>" class="erc_calculate_button_<?php echo $calc['id']; ?>" id="erc_button_calculate_<?php echo $calc['id'];?>"  href="#"><?php echo get_option('erc_' . $calc['id']  .  '_calculate_button_text')?></a>
        </div>

        <div  id="erc_button_container_recalculate_<?php echo $calc['id']; ?>" class="erc_recalculate_button_container_<?php echo $calc['id']; ?>" style="display: none;">
            <a style="<?php echo $ercButtonReCalculate; ?>" title="<?php echo get_option('erc_' . $calc['id']  .  '_recalculate_button_image_title')?>" class="erc_recalculate_button_<?php echo $calc['id']; ?>" id="erc_button_recalculate_<?php echo $calc['id'];?>"  href="#"><?php echo get_option('erc_' . $calc['id']  .  '_recalculate_button_text')?></a>
        </div>

    </div>

    <?php if (get_option('erc_' . $calc['id']  .  '_text_area_two_line_enabled')): ?>
        <hr id="area_two_line_<?php echo $calc['id'] ?>" style="margin: 0; padding: 0;<?php echo $ercTextAreaTwoLine?>" />
    <?php endif; ?>

    <?php if (get_option('erc_' . $calc['id']  .  '_text_area_two_enabled')): ?>
        <div id="text_area_two_<?php echo $calc['id'] ?>" style="<?php echo $ercTextAreaTwo; ?>"><?php echo $calc['text_area_two'] ?></div>
    <?php endif; ?>

    <?php if (get_option('erc_' . $calc['id']  .  '_result_text_area_two_line_enabled')): ?>
        <hr id="result_area_two_line_<?php echo $calc['id'] ?>" style="display: none; margin: 0; padding: 0;<?php echo $ercResultTextAreaTwoLine?>" />
    <?php endif; ?>

    <?php if (get_option('erc_' . $calc['id']  .  '_result_text_area_two_enabled')): ?>
        <div id="result_text_area_two_<?php echo $calc['id'] ?>" style="display: none; <?php echo $ercResultTextAreaTwo; ?>"><?php echo $calc['result_text_area_two'] ?></div>
    <?php endif; ?>
</div>