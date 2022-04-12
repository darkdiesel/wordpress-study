<?php
/**
 * IPA Fields Pack Admin Menu Settings
 *
 * @class    IPA_Fields_Pack_Admin_Menus_Settings
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class IPA_Fields_Pack_Admin_Menus_Settings
 */
class IPA_Fields_Pack_Admin_Menus_Settings {
	public static function output() {
		$settings = IPA_Fields_Pack()->plugin->get_settings();

		IPA_Fields_Pack()->functions->get_template(
			'admin/settings.php',
			array(
				'settings' => $settings,
			)
		);
	}

	public static function admin_menu_scripts() {
		wp_deregister_script( 'ipa-fields-pack-menu-settings-script' );
		wp_register_script( 'ipa-fields-pack-menu-settings-script', LETTERBOX_THUMBNAILS_URL . '/assets/js/admin_menu_settings.js', array( 'jquery' ), IPA_Fields_Pack()->get_version() );
		wp_enqueue_script( 'ipa-fields-pack-menu-settings-script' );

		//data_sync_settings
		wp_deregister_style( 'ipa-fields-pack-menu-settings-style' );
		wp_register_style( 'ipa-fields-pack-menu-settings-style', LETTERBOX_THUMBNAILS_URL . '/assets/css/admin_menu_settings.css', array(), IPA_Fields_Pack()->get_version() );
		wp_enqueue_style( 'ipa-fields-pack-menu-settings-style' );

		wp_localize_script(
			'ipa-fields-pack-menu-settings-script', 'ipa_fields_pack_menu_settings_vars',
			array(
				'wpnonce_settings' => wp_create_nonce( 'ipa_fields_pack_menu_settings_wpnonce' ),
			)
		);
	}
}
