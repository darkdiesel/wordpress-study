<?php

defined( 'ABSPATH' ) || exit;

/**
 * Class IPA_Fields_Pack_i18n
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */
class IPA_Fields_Pack_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public static function load_plugin_textdomain() {
		load_plugin_textdomain(
			IPA_Fields_Pack()->plugin->get_txt_domain(),
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
