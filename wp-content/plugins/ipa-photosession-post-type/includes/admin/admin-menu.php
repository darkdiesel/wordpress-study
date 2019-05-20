<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Photosession_PostType_Admin_Menu' ) ):
	class IPA_Photosession_PostType_Admin_Menu {
		public $settings_page_hook = '';

		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
			add_action( 'admin_enqueue_scripts', array(
				$this,
				'admin_menu_settings_scripts'
			) );

			include_once( 'admin-menu-settings.php' );
		}

		public function admin_menu() {
			$this->settings_page_hook = add_options_page(
				__( 'Photosession PostType Settings', IPA_Photosession_PostType()->plugin->get_text_domain() ),
				__( 'Photosession PostType Settings', IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'manage_options',
				'ipa-photosession-post-type-settings',
				array(
					'IPA_Photosession_PostType_Admin_Menu_Settings',
					'admin_menu_output'
				)
			);
		}

		public function admin_menu_settings_scripts( $hook ) {

			if ( $this->settings_page_hook != $hook ) {
				return;
			}

			$plugin_data = IPA_Photosession_PostType()->plugin->get_data();

			wp_register_style( 'ipa-photosession-post-type-admin-style', IPA_PHOTOSESSION_POST_TYPE_URL . '/assets/css/admin.css', false, $plugin_data['Version'] );
			wp_enqueue_style( 'ipa-photosession-post-type-admin-style' );

			if ( $this->settings_page_hook == $hook ) {
				IPA_Photosession_PostType_Admin_Menu_Settings::admin_menu_scripts( $plugin_data );
			}
		}
	}
endif;

return new IPA_Photosession_PostType_Admin_Menu();