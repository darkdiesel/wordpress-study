<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Field_Checkbox_Multiple_InputText' ) ):
    class IPA_PostMeta_Field_Checkbox_Multiple_InputText extends IPA_PostMeta_Field_Abstract {

        private $checkbox_template = '<input type="checkbox" value="%s" name="%s" class="%s" %s />%s';
        private $checkbox_class = 'ipa-post-meta-checkbox';

        private $input_template = '<input type="text" value="%s" name="%s" class="%s" />';
        private $input_class = 'regular-text';

        public function build( $params, $values ) {
            ob_start(); ?>

            <?php
            if (!is_array($values)) {
                $values = array();
            }
            ?>

            <?php
            if ( isset( $params['checkbox_class'] ) && $params['checkbox_class'] ) {
                $field_checkbox_class = $params['checkbox_class'];
            } else {
                $field_checkbox_class = $this->checkbox_class;
            }
            ?>

            <?php
            if ( isset( $params['input_class'] ) && $params['input_class'] ) {
                $field_input_class = $params['input_class'];
            } else {
                $field_input_class = $this->input_class;
            }
            ?>

            <?php if (isset($params['options']) && is_array($params['options']) && count($params['options'])) : ?>
                    <table>
                        <tbody>
                        <?php foreach ($params['options'] as $value => $label): ?>
                            <?php
                            $checked = isset($values[$value]['checked']);
                            ?>
                            <tr>
                                <td>
                                    <?php echo sprintf( $this->checkbox_template, $value, sprintf('%s[%s][%s]', $params['name'], $value, 'checked'), $field_checkbox_class, ($checked) ? 'checked' : '', $label ); ?>
                                </td>
                                <td>
                                    <?php echo sprintf( $this->input_template, (isset($values[$value]['label']) ? $values[$value]['label'] : ''), sprintf('%s[%s][%s]', $params['name'], $value, 'label'), $field_input_class ); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
            <?php endif; ?>

            <?php
            return ob_get_clean();
        }
    }
endif;