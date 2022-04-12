<?php
/**
 * Plugin Name: IPA Post Meta
 * Plugin URI: https://plus.google.com/+IgorPeshkov
 * Description: Plugin provide functionality to add post meta fields
 * Version: 2.3.3
 * Author: Igor Peshkov (dark_diesel)
 * Author URI: https://plus.google.com/+IgorPeshkov
 * Text Domain: ipa-post-meta
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

if ( ! class_exists( 'IPA_PostMeta' ) ) :
	class IPA_PostMeta {
		/**
		 * @var IPA_PostMeta The single instance of the class
		 */
		protected static $_instance = null;

		/**
		 * @var IPA_PostMeta_Plugin class instance
		 */
		public $plugin = null;

		/**
		 * @var IPA_PostMeta_Field class instance
		 */
		public $field = null;

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
			( ! defined( 'IPA_POSTMETA_VERSION' ) ) ? define( 'IPA_POSTMETA_VERSION', '1.0.0' ) : false;

			if ( ! defined( 'IPA_POSTMETA_PATH' ) ) {
				define( 'IPA_POSTMETA_PATH', dirname( __FILE__ ) );
			}

			if ( ! defined( 'IPA_POSTMETA_URL' ) ) {
				define( 'IPA_POSTMETA_URL', plugin_dir_url( __FILE__ ) );
			}

			if ( ! defined( 'IPA_POSTMETA_EVENT_META_BOXES' ) ) {
				define( 'IPA_POSTMETA_EVENT_META_BOXES', 'ipa-faq-post-type-meta-boxes' );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		function add_includes() {
			require_once( IPA_POSTMETA_PATH . '/includes/plugin.php' );
			require_once( IPA_POSTMETA_PATH . '/includes/field.php' );

			require_once( IPA_POSTMETA_PATH . '/includes/option.php' );
			require_once( IPA_POSTMETA_PATH . '/includes/utils.php' );


			$this->plugin = new IPA_PostMeta_Plugin();
			$this->field = new IPA_PostMeta_Field();

			//include_once( IPA_POSTMETA_PATH . '/includes/admin/post-meta.php' );

			if ( $this->is_request( 'admin' ) ) {
				require_once( IPA_POSTMETA_PATH . '/includes/admin/admin.php' );
			}

//			if ( $this->is_request( 'ajax' ) ) {}
//
//			if ( $this->is_request( 'frontend' ) ) {}
//
//			if ( $this->is_request( 'cron' ) ) {}
		}

		/**
		 * Add in various hooks
		 *
		 * Place all add_action, add_filter, add_shortcode hook-ins here
		 */
		function init_hooks() {
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array(
				__CLASS__,
				'plugin_action_links'
			) );

			add_filter( 'plugin_row_meta', array(
				__CLASS__,
				'plugin_row_meta'
			), 10, 4 );

			// add setting page
			//add_action( 'admin_menu', array( 'IPA_PostMeta_Settings', 'addSettingsPage' ), 100);

			//add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_wp_scripts' ) );
			//add_action( 'admin_enqueue_scripts', array( __CLASS__, 'add_admin_enqueue_scripts' ) );
		}

		/**
		 * Add admin styles and scripts required for this plugin
		 */
		public static function add_admin_enqueue_scripts() {
			$plugin_data = IPA_PostMeta()->plugin->get_data();

			wp_register_style( 'jquery-ui-style', IPA_POSTMETA_URL . '/assets/bower_components/jquery-ui/themes/flick/jquery-ui.min.css', false, '1.11.4', 'screen' );
			wp_enqueue_style( 'jquery-ui-style' );

			// datepicker scripts
			wp_deregister_script( 'ipa-post-meta-input-text-datepicker-script' );
			wp_register_script( 'ipa-post-meta-input-text-datepicker-script', IPA_POSTMETA_URL . '/assets/scripts/admin/post-meta-input-text-datepicker.js', array('jquery', 'jquery-ui-dialog', 'jquery-ui-sortable' ), $plugin_data['Version'] );

			// slider scripts
			wp_deregister_script( 'ipa-post-meta-slider-script' );
			wp_register_script( 'ipa-post-meta-slider-script', IPA_POSTMETA_URL . '/assets/scripts/admin/post-meta-slider.js', array('jquery', 'jquery-ui-datepicker'), $plugin_data['Version'] );
            wp_enqueue_script('ipa-post-meta-slider-script');

			// upload scripts
			wp_deregister_script( 'ipa-post-meta-upload-script' );
			wp_register_script( 'ipa-post-meta-upload-script', IPA_POSTMETA_URL . '/assets/scripts/admin/post-meta-upload.js', array('jquery'), $plugin_data['Version'] );
            wp_enqueue_script('ipa-post-meta-upload-script');

			// common styles
			wp_register_style( 'um-ipa-golding-group-post-meta-field-style', IPA_POSTMETA_URL . '/assets/styles/admin/post-meta-fields.css', false, $plugin_data['Version']);
			wp_enqueue_style( 'um-ipa-golding-group-post-meta-field-style' );

			// jquery ui style
			wp_register_style( 'jquery-ui-style', IPA_POSTMETA_URL . '/assets/bower_components/jquery-ui/themes/flick/jquery-ui.min.css', false, '1.11.4', 'screen' );
		}

		/**
		 * Load wp styles and scripts
		 */
		static function load_wp_scripts() {
//			$plugin_data = IPA_PostMeta()->plugin->get_data();
//
//			wp_register_style( 'jquery-ui-style', IPA_POSTMETA_URL . '/assets/bower_components/jquery-ui/themes/flick/jquery-ui.min.css', false, '1.11.4', 'screen' );
//			wp_enqueue_style( 'jquery-ui-style' );
		}

		/**
		 * @return array|bool|mixed|string|void
		 */
		function getSettings() {
			return IPA_PostMeta_Settings::getSettings();
		}

		function savePostMeta($post_id, $post_meta_arr) {
			IPA_PostMeta::save_post_meta($post_id, $post_meta_arr);
		}

		/**
		 * @param $post_id
		 * @param $post_meta_name
		 * @param $post_meta_arr
		 *
		 * @return array|mixed|null
		 */
		function getPostMeta($post_id, $post_meta_name, $post_meta_arr = null){
			return IPA_PostMeta::get_post_meta($post_id, $post_meta_name, $post_meta_arr);
		}

		function getField($args){
			return IPA_PostMeta::get_meta_field($args);
		}

		public function get_option_arr($option, $default = false){
			return IPA_PostMeta_Option::get_option_arr($option, $default);
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
			$links[] = sprintf('<a href="%s" target="_blank">%s</a>', esc_url('https://plus.google.com/+IgorPeshkov'), __('Igor at Google Plus', IPA_PostMeta()->plugin->get_text_domain()));

			return $links;
		}

		static function plugin_row_meta( $links, $file ) {
			if( plugin_basename( __FILE__ ) === $file ) {
				$links[] = sprintf('<a target="_blank" href="%s">%s</a>', esc_url('http://www.donationalerts.ru/r/dark_diesel'), __( 'Donate', IPA_PostMeta()->plugin->get_text_domain() ));
			}
			return $links;
		}
	}

	register_activation_hook( __FILE__, array( 'IPA_PostMeta', 'activate' ) );
	register_deactivation_hook( __FILE__, array( 'IPA_PostMeta', 'deactivate' ) );

	add_action( 'plugins_loaded', array( 'IPA_PostMeta', 'instance' ), 15 );
endif;

/**
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return IPA_PostMeta
 */
function IPA_PostMeta() {
	return IPA_PostMeta::instance();
}

// Global for backwards compatibility.
$GLOBALS['ipa-post-meta'] = IPA_PostMeta();