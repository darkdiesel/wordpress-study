<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Field_Select' ) ):
	class IPA_PostMeta_Field_Select extends IPA_PostMeta_Field_Abstract {

		private $option_template = '<option value="%s" class="%s" %s>%s</option>';
		private $class = 'ipa-post-meta-select-option';

		public function build( $params, $value ) {
			ob_start(); ?>

			<?php
			if ( isset( $params['class'] ) && $params['class'] ) {
				$field_class = $params['class'];
			} else {
				$field_class = $this->class;
			}
			?>

            <select id="<?php echo $this->build_field_id( $params ) ?>" name="<?php echo $params['name'] ?>">
				<?php if ( isset( $params['options'] ) && is_array( $params['options'] ) && count( $params['options'] ) ) : ?>
					<?php if ( isset( $params['empty_option'] ) && $params['empty_option'] ): ?>
						<?php echo sprintf( $this->option_template, '', $field_class, '', '' ); ?>
					<?php endif; ?>

                    <?php foreach ( $params['options'] as $option_value => $label ): ?>
						<?php
						$selected = ( $value == $option_value );
						?>
						<?php echo sprintf( $this->option_template, $option_value, $field_class, ( $selected ) ? 'selected' : '', $label ); ?>
					<?php endforeach; ?>
				<?php endif; ?>
            </select>

			<?php
			return ob_get_clean();
		}
	}
endif;