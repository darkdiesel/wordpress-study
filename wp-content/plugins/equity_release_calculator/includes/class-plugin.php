<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Plugin' ) ):
	class ER_Calculator_Plugin {
		public $plugin_settings_option = 'er-calculator-settings';

		public static $sync_settings_option = 'er_calculator_data_sync_settings';
		const SYNC_SITE_TYPE_PARENT = 'parent';
		const SYNC_SITE_TYPE_CHILD = 'child';

		public $plugin_data;
		public $plugin_sync_settings;

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
					$this->plugin_data = get_plugin_data( ER_CALCULATOR_PATH . '/equity_release_calculator.php' );
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
			return 'er-calculator';
		}

		public function get_sync_settings() {
			if ( ! $this->plugin_sync_settings ) {
				$this->plugin_sync_settings = json_decode(
					stripslashes_deep(get_option(self::$sync_settings_option)),
					TRUE
				);
			}

			return $this->plugin_sync_settings;
		}

		/**
		 * Get the template path.
		 * @return string
		 */
		public function template_path() {
			return apply_filters( 'er_calculator_template_path', 'er/calculator/' );
		}
	}
endif;