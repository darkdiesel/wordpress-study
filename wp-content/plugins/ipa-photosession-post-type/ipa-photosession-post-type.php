<?php
/**
 * Plugin Name: IPA Photosession Post Type
 * Plugin URI: https://plus.google.com/+IgorPeshkov
 * Description: Plugins adds new post type for photosessions
 * Version: 1.0.0
 * Author: Igor Peshkov (dark_diesel)
 * Author URI: https://plus.google.com/+IgorPeshkov
 * Text Domain: ipa-photosession-post-type
 * Domain Path: /languages/
 * License: GPL2
 */
/*  Copyright 2015  PLUGIN_AUTHOR_NAME  (email : igor.peshkov@gmail.com)

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

if ( ! class_exists( 'IPA_Photosession_PostType' ) ) :
	class IPA_Photosession_PostType {
		/**
		 * @var IPA_Photosession_PostType The single instance of the class
		 */
		protected static $_instance = null;

		/**
		 * @var IPA_Photosession_PostType_Plugin class instance
		 */
		public $plugin = null;

		/**
		 * @var IPA_Photosession_PostType_Core_Functions class instance
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
			if ( ! defined( 'IPA_PHOTOSESSION_POST_TYPE_PATH' ) ) {
				define( 'IPA_PHOTOSESSION_POST_TYPE_PATH', dirname( __FILE__ ) );
			}

			if ( ! defined( 'IPA_PHOTOSESSION_POST_TYPE_URL' ) ) {
				define( 'IPA_PHOTOSESSION_POST_TYPE_URL', plugin_dir_url( __FILE__ ) );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		function add_includes() {
			require_once( IPA_PHOTOSESSION_POST_TYPE_PATH . '/includes/class-plugin.php' );
			$this->plugin = new IPA_Photosession_PostType_Plugin();

			//register shortcodes
			require_once( IPA_PHOTOSESSION_POST_TYPE_PATH . '/includes/class-shortcodes.php' );

			//register post types
			require_once( IPA_PHOTOSESSION_POST_TYPE_PATH . '/includes/post-types/class-photosession-post-type.php' );

			require_once( IPA_PHOTOSESSION_POST_TYPE_PATH . '/includes/class-core-functions.php' );
			$this->functions = new IPA_Photosession_PostType_Core_Functions();


			if ( $this->is_request( 'admin' ) ) {
				include_once( 'includes/admin/admin.php' );
			}

//			if ( $this->is_request( 'ajax' ) ) {
//
//			}
//
//			if ( $this->is_request( 'frontend' ) ) {
//
//			}
//
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

			add_filter( 'plugin_row_meta', array(
				__CLASS__,
				'plugin_row_meta'
			), 10, 4 );

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
			//$plugin_data = IPA_Photosession_PostType()->plugin->get_data();

			//wp_register_style( 'jquery-ui-style', IPA_PHOTOSESSION_POST_TYPE_URL . '/bower_components/jquery-ui/themes/flick/jquery-ui.min.css', false, '1.11.4', 'screen' );
			//wp_enqueue_style( 'jquery-ui-style' );
		}

		/**
		 * Load wp styles and scripts
		 */
		static function load_wp_scripts() {
			//$plugin_data = IPA_Photosession_PostType()->plugin->get_data();

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
			//$links[] = sprintf( '<a href="%s"><span class="dashicons dashicons-admin-generic"></span>&nbsp;%s</a>', admin_url( 'admin.php?page=ipa-photosession-post-type-settings' ), __( 'Settings', IPA_Photosession_PostType()->plugin->get_text_domain() ) );
			$links[] = sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( 'https://plus.google.com/+IgorPeshkov' ), __( 'Igor at Google Plus', IPA_Photosession_PostType()->plugin->get_text_domain() ) );

			return $links;
		}

		static function plugin_row_meta( $links, $file ) {
			if ( plugin_basename( __FILE__ ) === $file ) {
				$links[] = sprintf( '<a target="_blank" href="%s">%s</a>', esc_url( 'http://www.donationalerts.ru/r/dark_diesel' ), __( 'Donate', IPA_Photosession_PostType()->plugin->get_text_domain() ) );
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

	add_action( 'plugins_loaded', array( 'IPA_Photosession_PostType', 'instance' ), 15 );
endif;

/**
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return IPA_Photosession_PostType
 */
function IPA_Photosession_PostType() {
	return IPA_Photosession_PostType::instance();
}

// Global for backwards compatibility.
$GLOBALS['ipa-photosession-post-type'] = IPA_Photosession_PostType();