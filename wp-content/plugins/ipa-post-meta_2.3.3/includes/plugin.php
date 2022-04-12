<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Plugin' ) ):
	class IPA_PostMeta_Plugin {
		public $plugin_data;

		/**
		 * Return plugin text domain
		 *
		 * @return string
		 */
		public function get_text_domain() {
			return 'ipa-post-meta';
		}

		/**
		 *
		 * Function return plugin data
		 *
		 * @return array
		 */
		public function get_data(){
			if (!$this->plugin_data){
				$this->plugin_data = get_plugin_data( IPA_POSTMETA_PATH . '/ipa-post-meta.php' );
			}

			return $this->plugin_data;
		}
	}
endif;