<?php
/**
 * Plugin Name: Equity Release Calculator
 * Description: Equity Release Calculator
 * Version: 4.0.0
 * Author: Mark & Jamie Team and Igor Peshkov (Itransition)
 * Text Domain: er-calculator
 * Domain Path: /languages/
 * License: GPL2
 */
/*
Copyright 2016 Mark & Jamie Team
Copyright 2018 Itransition  (email : igor.peshkov@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator' ) ) :
	class ER_Calculator {
		/**
		 * @var ER_Calculator The single instance of the class
		 */
		protected static $_instance = null;

		/**
		 * @var ER_Calculator_Plugin class instance
		 */
		public $plugin = null;

		/**
		 * @var ER_Calculator_Core_Functions class instance
		 */
		public $functions = null;

		/**
		 * Plugin settings
		 *
		 * @var array
		 */

		function __construct() {
			$this->load_constants();
			$this->add_includes();
			$this->init_hooks();
		}

		/**
		 * Initialization function to hook into the WordPress init action
		 *
		 * Instantiates the class on a global variable and sets the class, actions
		 * etc. up for use.
		 */
		static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Hook into register_activation_hook action
		 */
		static function activate() {
			require_once( ER_CALCULATOR_PATH . '/includes/class-plugin-activation.php' );
			ER_Calculator_Plugin_Activation::install();
		}

		/**
		 * Hook into register_deactivation_hook action
		 */
		static function deactivate() {

		}

		/**
		 * Load Constants
		 *
		 * Convenience function to load the constants files for
		 * the activation and construct
		 */
		function load_constants() {
			if ( ! defined( 'ER_CALCULATOR_PATH' ) ) {
				define( 'ER_CALCULATOR_PATH', dirname( __FILE__ ) );
			}

			if ( ! defined( 'ER_CALCULATOR_URL' ) ) {
				define( 'ER_CALCULATOR_URL', plugin_dir_url( __FILE__ ) );
			}

			if ( ! defined( 'ER_CALCULATOR_TEMPLATE_DEBUG_MODE' ) ) {
				define( 'ER_CALCULATOR_TEMPLATE_DEBUG_MODE', FALSE );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		function add_includes() {
			require_once( ER_CALCULATOR_PATH . '/includes/class-plugin.php' );
			$this->plugin = new ER_Calculator_Plugin();

			// register shortcodes
			require_once( ER_CALCULATOR_PATH . '/includes/class-shortcodes.php' );

			// core function
			require_once( ER_CALCULATOR_PATH . '/includes/class-core-functions.php' );
			$this->functions = new ER_Calculator_Core_Functions();

			include_once( 'includes/class-iframe.php' );

			include_once ('includes/class-logger.php');
			include_once ('includes/class-synchronisation.php');

			if ( $this->is_request( 'admin' ) ) {
				include_once( 'includes/admin/class-admin.php' );

				include_once( 'includes/admin/handler/class-age-actions-handler.php' );
				include_once( 'includes/admin/handler/class-percentage-actions-handler.php' );
				include_once( 'includes/admin/handler/class-percentage-hr-actions-handler.php' );
				include_once( 'includes/admin/handler/class-calculator-actions-handler.php' );
			}

			if ( $this->is_request( 'ajax' ) ) {
				include_once( 'includes/class-calculate.php' );
				include_once( 'includes/class-flg360-integration.php' );
				include_once( 'includes/class-mail.php' );
				include_once( 'includes/class-adwords.php' );
			}

//			if ( $this->is_request( 'frontend' ) ) {
//
//			}

//			if ( $this->is_request( 'cron' ) ) {
//
//			}

		}

		/**
		 * Add in various hooks
		 *
		 * Place all add_action, add_filter, add_shortcode hook-ins here
		 */
		function init_hooks() {
			register_activation_hook( __FILE__, array(
				__CLASS__,
				'activate'
			) );
			register_deactivation_hook( __FILE__, array(
				__CLASS__,
				'deactivate'
			) );

			// add setting page fo product search
			//add_action( 'admin_menu', array( 'IPA_Video_Fixer_Settings', 'addSettingsPage' ), 100);

			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array(
				__CLASS__,
				'plugin_action_links'
			), 10, 2 );

//			add_filter( 'plugin_row_meta', array(
//				__CLASS__,
//				'plugin_row_meta'
//			), 10, 4 );

			add_action( 'wp_enqueue_scripts', array(
				__CLASS__,
				'load_wp_scripts'
			) );
			add_action( 'admin_enqueue_scripts', array(
				__CLASS__,
				'load_admin_scripts'
			) );
		}

		/**
		 * Load admin styles and scripts
		 */
		static function load_admin_scripts() {
			//$plugin_data = ER_Calculator()->plugin->get_data();

			//wp_register_style( 'jquery-ui-style', ER_CALCULATOR_URL . '/bower_components/jquery-ui/themes/flick/jquery-ui.min.css', false, '1.11.4', 'screen' );
			//wp_enqueue_style( 'jquery-ui-style' );
		}

		/**
		 * Load wp styles and scripts
		 */
		static function load_wp_scripts() {
			//$plugin_data = ER_Calculator()->plugin->get_data();

			//wp_register_script( 'plugin-script', 'http://domain.com/script.js', array(), '1.0.0', true );
		}

		/**
		 * What type of request is this?
		 * string $type ajax, frontend or admin
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin' :
					return is_admin();
				case 'ajax' :
					return defined( 'DOING_AJAX' );
				case 'cron' :
					return defined( 'DOING_CRON' );
				case 'frontend' :
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			}
		}

		static function plugin_action_links( $links ) {
			//add your links here
			//$links[] = sprintf( '<a href="%s"><span class="dashicons dashicons-admin-generic"></span>&nbsp;%s</a>', admin_url( 'admin.php?page=ipa-photosession-post-type-settings' ), __( 'Settings', ER_Calculator()->plugin->get_text_domain() ) );
			$links[] = sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( 'https://www.itransition.com/' ), __( 'Itransition', ER_Calculator()->plugin->get_text_domain() ) );

			return $links;
		}

		static function plugin_row_meta( $links, $file ) {
			if ( plugin_basename( __FILE__ ) === $file ) {
				$links[] = sprintf( '<a target="_blank" href="%s">%s</a>', esc_url( 'https://www.paypal.com' ), __( 'Donate', ER_Calculator()->plugin->get_text_domain() ) );
			}

			return $links;
		}


		/**
		 * Get the plugin url.
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

	}

	add_action( 'plugins_loaded', array( 'ER_Calculator', 'instance' ), 15 );
endif;

/**
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  4.0.0
 * @return ER_Calculator
 */
function ER_Calculator() {
	return ER_Calculator::instance();
}

// Global for backwards compatibility.
$GLOBALS['er-calculator'] = ER_Calculator();