<?php
/**
 * @var string $optionName
 */
?>

<tr>
	<td></td>
	<td>
		<label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_size_width"><?php _e('Width (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
	</td>
	<td>
		<input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_size_width" name="erc_calculator_settings[<?php echo (isset($optionName) ? $optionName : ''); ?>_size_width]"
		       value="<?php echo get_option((isset($optionName) ? $optionName : '') . '_size_width'); ?>"/>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_size_height"><?php _e('Height (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
	</td>
	<td>
		<input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_size_height" name="erc_calculator_settings[<?php echo (isset($optionName) ? $optionName : ''); ?>_size_height]"
		       value="<?php echo get_option($optionName ? $optionName : '' . '_size_height'); ?>"/>
	</td>
</tr>