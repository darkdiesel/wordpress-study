<?php
/**
 * @var string $optionName
 * @var bool $radius
 */
?>

<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_color"><?php _e('Border Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <input type="text" id="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_color" class="colorpicker" name="erc_calculator_settings[<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_color]" value="<?php echo get_option($optionName . '_border_color'); ?>"/>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_width"><?php _e('Border Width (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <input type="number" id="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_width" name="erc_calculator_settings[<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_width]" value="<?php echo get_option($optionName . '_border_width'); ?>"/>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_style"><?php _e('Border Style', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <select id="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_style" name="erc_calculator_settings[<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_style]">
            <option value="none"   <?php echo get_option("{$optionName}_border_style") == 'none' ?   "selected" : '' ; ?>>none</option>
            <option value="solid"  <?php echo get_option("{$optionName}_border_style") == 'solid' ?  "selected" : '' ; ?>>solid</option>
            <option value="dotted" <?php echo get_option("{$optionName}_border_style") == 'dotted' ? "selected" : '' ; ?>>dotted</option>
            <option value="dashed" <?php echo get_option("{$optionName}_border_style") == 'dashed' ? "selected" : '' ; ?>>dashed</option>
            <option value="double" <?php echo get_option("{$optionName}_border_style") == 'double' ? "selected" : '' ; ?>>double</option>
            <option value="hidden" <?php echo get_option("{$optionName}_border_style") == 'hidden' ? "selected" : '' ; ?>>hidden</option>
            <option value="groove" <?php echo get_option("{$optionName}_border_style") == 'groove' ? "selected" : '' ; ?>>groove</option>
            <option value="dashed" <?php echo get_option("{$optionName}_border_style") == 'dashed' ? "selected" : '' ; ?>>dashed</option>
            <option value="ridge"  <?php echo get_option("{$optionName}_border_style") == 'ridge' ?  "selected" : '' ; ?>>ridge</option>
        </select>
    </td>
</tr>

<?php if ( isset( $radius ) && $radius ): ?>
    <tr>
        <td></td>
        <td>
            <label for="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_radius"><?php _e('Border Radius (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
        </td>
        <td>
            <input type="number" id="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_radius" name="erc_calculator_settings[<?php echo isset( $optionName ) ? $optionName : ''; ?>_border_radius]" value="<?php echo get_option($optionName . '_border_radius'); ?>"/>
        </td>
    </tr>
<?php endif; ?>