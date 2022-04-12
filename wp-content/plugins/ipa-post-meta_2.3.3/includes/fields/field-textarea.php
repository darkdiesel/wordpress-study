<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Field_TextArea' ) ):
	class IPA_PostMeta_Field_TextArea extends IPA_PostMeta_Field_Abstract{

		private $template = '<textarea name="%s" class="%s" %s>%s</textarea>';
		private $class = 'large-text code';

		public function build( $params , $value = false ) {
			ob_start(); ?>

			<?php
			if ( isset( $params['class'] ) && $params['class'] ) {
				$field_class = $params['class'];
			} else {
				$field_class = $this->class;
			}
			?>

			<?php
			$attributes = '';

			if (isset($params['attributes']) && is_array($params['attributes'])){
				foreach ($params['attributes'] as $attribute => $attribute_value){
					$attributes .= sprintf(' %s="%s"',$attribute, $attribute_value);
				}
			}
			?>

			<?php echo sprintf( $this->template, $params['name'], $field_class, $attributes, $value ); ?>

			<?php
			return ob_get_clean();
		}
	}
endif;