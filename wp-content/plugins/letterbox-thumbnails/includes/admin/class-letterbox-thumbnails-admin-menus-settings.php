<?php
/**
 * LetterBox Thumbnails Admin Menu Settings
 *
 * @class    LetterboxThumbnails_Admin_Menus_Settings
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class LetterboxThumbnails_Admin_Menus_Settings
 */
class LetterboxThumbnails_Admin_Menus_Settings {
	public static function output() {
		$settings = LetterboxThumbnails()->plugin->get_settings();

		LetterboxThumbnails()->functions->get_template(
			'admin/settings.php',
			array(
				'settings' => $settings
			)
		);
	}

	public static function admin_menu_scripts() {
		$plugin_data = LetterboxThumbnails()->plugin->get_data();

		wp_enqueue_style( 'wp-color-picker' );

		wp_deregister_script( 'letterbox-thumbnails-menu-settings-script' );
		wp_register_script( 'letterbox-thumbnails-menu-settings-script', LETTERBOX_THUMBNAILS_URL . '/assets/js/admin_menu_settings.js', array( 'jquery', 'wp-color-picker' ), $plugin_data['Version'] );
		wp_enqueue_script( 'letterbox-thumbnails-menu-settings-script' );

		//data_sync_settings
		wp_deregister_style( 'letterbox-thumbnails-menu-settings-style' );
		wp_register_style( 'letterbox-thumbnails-menu-settings-style', LETTERBOX_THUMBNAILS_URL . '/assets/css/admin_menu_settings.css', array(), $plugin_data['Version'] );
		wp_enqueue_style( 'letterbox-thumbnails-menu-settings-style' );

		wp_localize_script(
			'letterbox-thumbnails-menu-settings-script', 'letterbox_thumbnails_menu_settings_vars',
			array(
				'wpnonce_settings' => wp_create_nonce( 'letterbox_thumbnails_menu_settings_wpnonce' ),
			)
		);
	}
}
