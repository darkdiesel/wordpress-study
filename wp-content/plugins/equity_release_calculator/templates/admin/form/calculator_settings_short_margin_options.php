<?php
/**
 * @var string $optionName
 */
?>

<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_margin_tb"><?php _e('Top-Bottom (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_margin_tb" name="erc_calculator_settings[<?php echo $optionName; ?>_margin_tb]" value="<?php echo get_option($optionName . '_margin_tb'); ?>"/>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_margin_lr"><?php _e('Left-Right (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_margin_lr" name="erc_calculator_settings[<?php echo $optionName; ?>_margin_lr]" value="<?php echo get_option($optionName . '_margin_lr'); ?>"/>
    </td>
</tr>