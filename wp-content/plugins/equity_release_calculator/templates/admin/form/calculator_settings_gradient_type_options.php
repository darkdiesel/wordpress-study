<?php
/**
 * @var string $optionName
 * @var bool $radius
 */
?>

<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_gradient_type"><?php _e('Gradient Type', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <select id="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_gradient_type" name="erc_calculator_settings[<?php echo $optionName; ?>_gradient_type]" >
            <option value="none"  <?php echo get_option($optionName . '_gradient_type') == 'none' ? "selected" : '' ; ?>>none</option>
            <option value="linear-gradient"  <?php echo get_option($optionName . '_gradient_type') == 'linear-gradient' ? "selected" : '' ; ?>>linear-gradient</option>
            <option value="radial-gradient"  <?php echo get_option($optionName . '_gradient_type') == 'radial-gradient' ? "selected" : '' ; ?>>radial-gradient</option>
        </select>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_gradient_liner_position"><?php _e('Linear Gradient Position', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <select id="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_gradient_liner_position" name="erc_calculator_settings[<?php echo $optionName; ?>_gradient_liner_position]" >
            <option value="to top"  <?php echo get_option($optionName . '_gradient_liner_position') == 'to top' ? "selected" : '' ; ?>>to top</option>
            <option value="to left"  <?php echo get_option($optionName . '_gradient_liner_position') == 'to left' ? "selected" : '' ; ?>>to left</option>
            <option value="to bottom"  <?php echo get_option($optionName . '_gradient_liner_position') == 'to bottom' ? "selected" : '' ; ?>>to bottom</option>
            <option value="to right"  <?php echo get_option($optionName . '_gradient_liner_position') == 'to right' ? "selected" : '' ; ?>>to right</option>
            <option value="to top left"  <?php echo get_option($optionName . '_gradient_liner_position') == 'to top left' ? "selected" : '' ; ?>>to top left</option>
            <option value="to top right"  <?php echo get_option($optionName . '_gradient_liner_position') == 'to top right' ? "selected" : '' ; ?>>to top right</option>
            <option value="to bottom left"  <?php echo get_option($optionName . '_gradient_liner_position') == 'to bottom left' ? "selected" : '' ; ?>>to bottom left</option>
            <option value="to bottom right"  <?php echo get_option($optionName . '_gradient_liner_position') == 'to bottom right' ? "selected" : '' ; ?>>to bottom right</option>
        </select>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_gradient_radial_position"><?php _e('Radial Gradient Position', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <select id="settings_<?php echo isset( $optionName ) ? $optionName : ''; ?>_gradient_radial_position" name="erc_calculator_settings[<?php echo $optionName; ?>_gradient_radial_position]" >
            <option value="at top left"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at top left' ? "selected" : '' ; ?>>at top left</option>
            <option value="at top center"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at top center' ? "selected" : '' ; ?>>at top center</option>
            <option value="at top right"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at top right' ? "selected" : '' ; ?>>at top right</option>
            <option value="at left center"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at left center' ? "selected" : '' ; ?>>at left center</option>
            <option value="at center center"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at center center' ? "selected" : '' ; ?>>at center center</option>
            <option value="at right center"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at right center' ? "selected" : '' ; ?>>at right center</option>
            <option value="at left bottom"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at left bottom' ? "selected" : '' ; ?>>at left bottom</option>
            <option value="at bottom center"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at bottom center' ? "selected" : '' ; ?>>at bottom center</option>
            <option value="at right bottom"  <?php echo get_option($optionName . '_gradient_radial_position') == 'at right bottom' ? "selected" : '' ; ?>>at right bottom</option>
        </select>
    </td>
</tr>