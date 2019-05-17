<?php
/**
 * @var string $optionName
 */
?>

<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_gradient_end_color"><?php _e('Gradient End Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <input id="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_gradient_end_color" type="text" class="colorpicker" name="erc_calculator_settings[<?php echo $optionName; ?>_gradient_end_color]" value="<?php echo get_option($optionName . '_gradient_end_color'); ?>"/>
    </td>
</tr>