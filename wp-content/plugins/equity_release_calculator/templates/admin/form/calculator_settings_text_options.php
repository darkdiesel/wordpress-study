<?php
/**
 * @var string $optionName
 * @var bool $textDecoration
 */
?>

<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_font_family"><?php _e('Font Family', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <select id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_font_family" name="erc_calculator_settings[<?php echo $optionName; ?>_font_family]">
            <option
                    value='' <?php echo get_option($optionName . '_font_family') == '' ? 'selected' : '' ; ?>>

            </option>
            <option
                    value='Tahoma, Times New Roman, Times, serif' <?php echo get_option($optionName . '_font_family') == 'Tahoma, Times New Roman, Times, serif' ? 'selected' : '' ; ?>>
                Tahoma, Times New Roman, Times, serif
            </option>
            <option
                    value='Helvetica Neue, Helvetica, Arial, sans-serif;' <?php echo get_option($optionName . '_font_family') == 'Helvetica Neue, Helvetica, Arial, sans-serif;' ? 'selected' : '' ; ?>>
                Helvetica Neue, Helvetica, Arial, sans-serif;
            </option>
            <option
                    value='Lucida Grande, Verdana, Arial, Bitstream Vera Sans, sans-serif' <?php echo get_option($optionName . '_font_family') == 'Lucida Grande, Verdana, Arial, Bitstream Vera Sans, sans-serif' ? 'selected' : '' ; ?>>
                Lucida Grande, Verdana, Arial, Bitstream Vera Sans, sans-serif
            </option>
            <option
                    value='Open Sans, Helvetica, Arial, sans-serif' <?php echo get_option($optionName . '_font_family') == 'Open Sans, Helvetica, Arial, sans-serif' ? 'selected' : '' ; ?>>
                Open Sans, Helvetica, Arial, sans-serif
            </option>
            <option
                    value='Open Sans, sans-serif' <?php echo get_option($optionName . '_font_family') == 'Open Sans, sans-serif' ? 'selected' : '' ; ?>>
                Open Sans, sans-serif
            </option>
            <option
                    value='Source Sans Pro, Helvetica, sans-serif' <?php echo get_option($optionName . '_font_family') == 'Source Sans Pro, Helvetica, sans-serif' ? 'selected' : '' ; ?>>
                Source Sans Pro, Helvetica, sans-serif
            </option>
            <option
                    value='Times New Roman Times' <?php echo get_option($optionName . '_font_family') == 'Times New Roman Times' ? 'selected' : '' ; ?>>
                Times New Roman Times
            </option>
            <option
                    value='Arial, Verdana' <?php echo get_option($optionName . '_font_family') == 'Arial, Verdana' ? 'selected' : '' ; ?>>
                Arial, Verdana
            </option>
            <option
                    value='Arial, Helvetica, sans-serif' <?php echo get_option($optionName . '_font_family') == 'Arial, Helvetica, sans-serif' ? 'selected' : '' ; ?>>
                Arial, Helvetica, sans-serif
            </option>
        </select>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_font_size"><?php _e('Font Size (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <input type="number" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_font_size" name="erc_calculator_settings[<?php echo $optionName; ?>_font_size]" value="<?php echo get_option($optionName . '_font_size'); ?>"/>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_font_style"><?php _e('Font Style', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <select id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_font_style" name="erc_calculator_settings[<?php echo $optionName; ?>_font_style]">
            <option value="normal" <?php echo get_option($optionName . '_font_style') == 'normal' ? "selected" : '' ; ?>>normal</option>
            <option value="italic" <?php echo get_option($optionName . '_font_style') == 'italic' ? "selected" : '' ; ?>>italic</option>
        </select>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_font_weight"><?php _e('Font Weight', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <select id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_font_weight" name="erc_calculator_settings[<?php echo $optionName; ?>_font_weight]">
            <option value="bold" <?php echo get_option($optionName . '_font_weight') == 'bold' ? "selected" : '' ; ?>>bold</option>
            <option value="100" <?php echo get_option($optionName . '_font_weight') == 100 ? "selected" : '' ; ?>>100</option>
            <option value="200" <?php echo get_option($optionName . '_font_weight') == 200 ? "selected" : '' ; ?>>200</option>
            <option value="300" <?php echo get_option($optionName . '_font_weight') == 300 ? "selected" : '' ; ?>>300</option>
            <option value="400" <?php echo get_option($optionName . '_font_weight') == 400 ? "selected" : '' ; ?>>400</option>
            <option value="500" <?php echo get_option($optionName . '_font_weight') == 500 ? "selected" : '' ; ?>>500</option>
            <option value="600" <?php echo get_option($optionName . '_font_weight') == 600 ? "selected" : '' ; ?>>600</option>
            <option value="700" <?php echo get_option($optionName . '_font_weight') == 700 ? "selected" : '' ; ?>>700</option>
            <option value="800" <?php echo get_option($optionName . '_font_weight') == 800 ? "selected" : '' ; ?>>800</option>
            <option value="900" <?php echo get_option($optionName . '_font_weight') == 900 ? "selected" : '' ; ?>>900</option>
            <option value="normal" <?php echo get_option($optionName . '_font_weight') == 'normal' ? "selected" : '' ; ?>>normal</option>
        </select>
    </td>
</tr>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_text_transform"><?php _e('Text Transform', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <select id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_text_transform" name="erc_calculator_settings[<?php echo $optionName; ?>_text_transform]">
            <option value="none" <?php echo get_option($optionName . '_text_transform') == 'none' ? "selected" : '' ; ?>>none</option>
            <option value="lowercase" <?php echo get_option($optionName . '_text_transform') == 'lowercase' ? "selected" : '' ; ?>>lowercase</option>
            <option value="uppercase" <?php echo get_option($optionName . '_text_transform') == 'uppercase' ? "selected" : '' ; ?>>uppercase</option>
        </select>
    </td>
</tr>
<?php if ( isset($textDecoration) && $textDecoration): ?>
    <tr>
        <td></td>
        <td>
            <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_text_decoration"><?php _e('Text Decoration', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
        </td>
        <td>
            <select id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_text_decoration" name="erc_calculator_settings[<?php echo $optionName; ?>_text_decoration]">
                <option value="none" <?php echo get_option($optionName . '_text_decoration') == 'none' ? "selected" : '' ; ?>>none</option>
                <option value="underline" <?php echo get_option($optionName . '_text_decoration') == 'underline' ? "selected" : '' ; ?>>underline</option>
                <option value="overline" <?php echo get_option($optionName . '_text_decoration') == 'overline' ? "selected" : '' ; ?>>overline</option>
                <option value="line-through" <?php echo get_option($optionName . '_text_decoration') == 'line-through' ? "selected" : '' ; ?>>line-through</option>
            </select>
        </td>
    </tr>
<?php endif; ?>
<tr>
    <td></td>
    <td>
        <label for="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_text_color"><?php _e('Text Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
    </td>
    <td>
        <input type="text" id="settings_<?php echo (isset($optionName) ? $optionName : ''); ?>_text_color" class="colorpicker" name="erc_calculator_settings[<?php echo $optionName; ?>_text_color]" value="<?php echo get_option($optionName . '_text_color'); ?>"/>
    </td>
</tr>