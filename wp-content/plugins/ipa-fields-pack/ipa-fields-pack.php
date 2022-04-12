<?php
/**
 * Plugin Name: IPA Fields Pack
 * Plugin URI: https://www.facebook.com/igor.peshkov.27.07.1988
 * Description: Plugin provide functionality for creating custom post type, taxonomy and fields
 * Author: Igor Peshkov
 * Author URI: https://www.facebook.com/igor.peshkov.27.07.1988
 * Version: 1.0.0
 * Text Domain: ipa-fields-pack
 * Domain Path: /languages/
 * Requires at least: 4.5
 * Tested up to: 5.2
 * Requires PHP: 5.6
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

// Define LETTERBOX_THUMBNAILS_PLUGIN_FILE.
if ( ! defined( 'IPA_FIELDS_PACK_PLUGIN_FILE' ) ) {
	define( 'IPA_FIELDS_PACK_PLUGIN_FILE', __FILE__ );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'IPA_FIELDS_PACK_VERSION', '1.0.0' );

if ( ! class_exists( 'IPA_Fields_Pack' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-ipa-fields-pack.php';
}

/**
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @return IPA_Fields_Pack
 * @since  1.0.0
 */
function IPA_Fields_Pack() {
	return IPA_Fields_Pack::instance();
}

// Global for backwards compatibility.
$GLOBALS['ipa-fields-pack'] = IPA_Fields_Pack();