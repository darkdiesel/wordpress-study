<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Field_InputPassword' ) ):
	class IPA_PostMeta_Field_InputPassword extends IPA_PostMeta_Field_Abstract {

		private $template = '<input type="password" value="%s" name="%s" class="%s" />';
		private $class = 'regular-text';

		public function build( $params, $value ) {
			ob_start(); ?>

			<?php
			if ( isset( $params['class'] ) && $params['class'] ) {
				$field_class = $params['class'];
			} else {
				$field_class = $this->class;
			}
			?>

			<?php echo sprintf( $this->template, $value, $params['name'], $field_class ); ?>

			<?php
			return ob_get_clean();
		}
	}
endif;