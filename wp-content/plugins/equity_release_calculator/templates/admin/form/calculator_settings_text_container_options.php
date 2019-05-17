<?php
/**
 * @var string $optionName
 * @var bool $align
 * @var bool $paddings
 */
?>

<?php if ( $align ): ?>
    <tr>
        <td></td>
        <td>
            <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_text_align"><?php _e('Text Align', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
        </td>
        <td>
            <select id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_text_align" name="erc_calculator_settings[<?php echo (isset($optionName) ? $optionName : ''); ?>_text_align]">
                <option value="left"   <?php echo get_option((isset($optionName) ? $optionName : '') . '_text_align') == 'left'   ? "selected" : '' ; ?>>left</option>
                <option value="center" <?php echo get_option((isset($optionName) ? $optionName : '') . '_text_align') == 'center' ? "selected" : '' ; ?>>center</option>
                <option value="right"  <?php echo get_option((isset($optionName) ? $optionName : '') . '_text_align') == 'right'  ? "selected" : '' ; ?>>right</option>
            </select>
        </td>
    </tr>
<?php endif; ?>

<?php if ( isset( $paddings ) && $paddings ): ?>
    <tr>
        <td></td>
        <td>
            <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_top"><?php _e('Padding Top (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
        </td>
        <td>
            <input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_top" name="erc_calculator_settings[<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_top]"
                   value="<?php echo get_option((isset($optionName) ? $optionName : '') . '_padding_top'); ?>"/>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_bottom"><?php _e('Padding Bottom (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
        </td>
        <td>
            <input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_bottom" name="erc_calculator_settings[<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_bottom]"
                   value="<?php echo get_option((isset($optionName) ? $optionName : '') . '_padding_bottom'); ?>"/>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_left"><?php _e('Padding Left (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
        </td>
        <td>
            <input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_left" name="erc_calculator_settings[<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_left]"
                   value="<?php echo get_option((isset($optionName) ? $optionName : '') . '_padding_left'); ?>"/>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_right"><?php _e('Padding Right (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
        </td>
        <td>
            <input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_right" name="erc_calculator_settings[<?php echo (isset($optionName) ? $optionName : ''); ?>_padding_right]"
                   value="<?php echo get_option((isset($optionName) ? $optionName : '') . '_padding_right'); ?>"/>
        </td>
    </tr>
<?php endif; ?>