<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Field_Select_AdminSection' ) ):
	class IPA_PostMeta_Field_Select_AdminSection extends IPA_PostMeta_Field_Abstract {

		private $option_template = '<option value="%s" class="%s" %s>%s</option>';
		private $class = 'ipa-post-meta-select-option';
		private $scripts_registered = FALSE;

		public function build( $params, $value ) {
		    $this->register_scripts();

			ob_start(); ?>

			<?php
			if ( isset( $params['class'] ) && $params['class'] ) {
				$field_class = $params['class'];
			} else {
				$field_class = $this->class;
			}
			?>

            <select id="<?php echo $this->build_field_id( $params ) ?>" name="<?php echo $params['name'] ?>" class="ipa-post-meta-select-admin-section">
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

		function register_scripts(){
		  if ( $this->scripts_registered ) {
			return TRUE;
		  }

		  $plugin_data = IPA_PostMeta()->plugin->get_data();

		  // select admin-section scripts
		  wp_deregister_script( 'ipa-post-meta-select-admin-section-script' );
		  wp_register_script( 'ipa-post-meta-select-admin-section-script', IPA_POSTMETA_URL . '/assets/scripts/admin/post-meta-select-admin-section.js', array('jquery'), $plugin_data['Version'] );
		  wp_enqueue_script('ipa-post-meta-select-admin-section-script');

		  $this->scripts_registered = TRUE;
        }
	}
endif;