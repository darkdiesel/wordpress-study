<?php
/**
 * Central file for admin 
 * 
 * @package htcc
 * @subpackage Admin
 * @since 1.0.0
 * 
 * subpackage Admin loads only on wp-admin 
 */


if ( ! defined( 'ABSPATH' ) ) exit;

require_once(HTCC_PLUGIN_DIR . 'inc/MobileMonkeyApi.php');

require_once('class-htcc-lang.php');

require_once('class-htcc-admin.php');


require_once('class-htcc-enqueue.php');



$api = new MobileMonkeyApi();
$admin = new HTCC_Admin();
add_action('admin_menu',  array( $admin, 'htcc_options_page') );
add_action( 'admin_init', array( $admin, 'htcc_custom_settings' ) );
add_action( 'admin_init', array( $admin, 'htcc_incomplete_setup' ) );
add_action('admin_init', 'htcc_admin_notice');
add_action('admin_notices', array( $admin, 'example_admin_notice'));
add_action('wp_ajax_send_done', array($admin,'set_tab_done'));
add_action('wp_ajax_email_section', array($admin,'email_section'));
add_action('wp_ajax_set_pre_val', array($admin,'pre_val'));
add_action('wp_ajax_get_done', array($admin,'get_tab_done'));
add_action('wp_ajax_set_current_tab', array($admin,'set_current_tab'));
add_action('wp_ajax_create_subscribe', array($api,'create_subscribe'));
add_action('wp_ajax_cancel_subscribe', array($api,'cancel_subscribe'));
add_action('wp_ajax_csv', array($api,'csv'));




#premium
if ( 'true' == HTCC_PRO ) {
    include_once HTCC_PLUGIN_DIR . 'admin/pro/htcc-pro-update.php';
    include_once HTCC_PLUGIN_DIR . 'admin/pro/class-admin-htcc-pro.php';
}


function htcc_admin_notice(){

	if (isset($_GET['activate'])&&($_GET['activate'])) {
		if( version_compare( get_bloginfo('version'), HTCC_WP_MIN_VERSION, '<') )  {
			echo '<style>.update-nag, .updated, .error, .is-dismissible ,.settings{ display: none; }</style>';
			echo '<style>.settings{ display: block; }</style><div class="updated error is-dismissible" style="display: block">
					 <p>Please update to WordPress '.HTCC_WP_MIN_VERSION.' or higher in order to be compatible with this plugin</p>
				 </div>';
			deactivate_plugins(HTCC_PLUGIN_FILE);
		}
		if( version_compare(PHP_VERSION, HTCC_PHP_MIN_VERSION, '<') )  {
			echo '<style>.update-nag, .updated, .error, .is-dismissible ,.settings{ display: none; }</style>';
			echo '<style>.settings{ display: block; }</style><div class="updated error is-dismissible" style="display: block">
					 <p>Please update to PHP '.HTCC_WP_MIN_VERSION.' or higher in order to be compatible with this plugin</p>
				 </div>';
			deactivate_plugins(HTCC_PLUGIN_FILE);
		}
	}
}

/**
 * ht_cc_service_content  -  by default there is no option .. 
 * so when no option exists .. so it not equal to 'hide'
 * so in admin sidebar the service content will display . . 
 * if clicks on hide box .. 
 *      then an option update will happen ( create an option )
 * 
 */
add_action( 'wp_ajax_ht_cc_service_content', 'ht_cc_service_content_ajax' );

function ht_cc_service_content_ajax() {

    $service_content = get_option( 'ht_cc_service_content' );

    // wp_localize_script can use - but this may be easy, as only one value .. 
    echo $service_content;

    wp_die();
}



// action -  ht_cc_service_content_hide
// update the option ht_cc_service_content to hide
add_action( 'wp_ajax_ht_cc_service_content_hide', 'ht_cc_service_content_hide_ajax' );

function ht_cc_service_content_hide_ajax() {

    $service_content = get_option( 'ht_cc_service_content' );

    update_option( 'ht_cc_service_content', 'hide' );

    wp_die();
}