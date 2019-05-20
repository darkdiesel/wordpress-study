<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Photosession_PostType_Plugin' ) ):
	class IPA_Photosession_PostType_Plugin {
		public $plugin_settings_option = 'ipa-photosession-post-type-settings';

		public $plugin_data;
		public $plugin_settings;

		function __construct() {

		}

		/**
		 *
		 * Function return plugin data
		 *
		 * @return array
		 */
		public function get_data() {
			if ( ! $this->plugin_data ) {
				if (function_exists('get_plugin_data')){
					$this->plugin_data = get_plugin_data( IPA_PHOTOSESSION_POST_TYPE_PATH . '/ipa-photosession-post-type.php' );
				}
			}

			return $this->plugin_data;
		}

		/**
		 * Return plugin text domain
		 *
		 * @return string
		 */
		public function get_text_domain() {
			return 'ipa-photosession-post-type';
		}

		public function get_settings() {
			if ( ! $this->plugin_settings ) {
				$this->plugin_settings = IPA_PostMeta()->get_option_arr( $this->plugin_settings_option );
			}

			return $this->plugin_settings;
		}

		public function get_settings_fields_arr() {

			$fields = array(
				array(
					'label'       => __( 'Test:', IPA_Photosession_PostType()->plugin->get_text_domain() ),
					'name'        => 'test',
					'type'        => 'input-text',
					'description' => __( 'test.', IPA_Photosession_PostType()->plugin->get_text_domain() ),
					'attributes'  => array(
						'size'  => 54,
						'class' => ''
					)
				),
			);

			return $fields;
		}

		/**
		 * Get the template path.
		 * @return string
		 */
		public function template_path() {
			return apply_filters( 'ipa_photosession_post_type_template_path', 'ipa/photosession-post-type/' );
		}
	}
endif;