<?php
/**
 * IPA Fields Pack Admin Menus
 *
 * @class    IPA_Fields_Pack_Admin_Menus
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class IPA_Fields_Pack_Admin_Menus
 */
class IPA_Fields_Pack_Admin_Menus {
	public static $ipa_fields_pack_page = 'ipa-fields-pack';
	public static $ipa_fields_pack_settings_page = 'ipa-fields-pack-settings';
	public static $ipa_fields_pack_taxonomies_page = 'ipa-fields-pack-taxonomies';

	public $pages_hooks = array();

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		$this->includes();

		// TODO: move to more correct place
		add_filter('set-screen-option',  array( 'IPA_Fields_Pack_Admin_Menus_Taxonomies', 'per_page_set_option' ), 10, 3);

		// Add menus.
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );

		// admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_menu_settings_scripts') );
	}

	public function includes(){
		// Settings page
		include_once dirname( __FILE__ ) . '/class-ipa-fields-pack-admin-menus-settings.php';
		include_once dirname( __FILE__ ) . '/handler/class-ipa-fields-pack-admin-settings-handler.php';

		// Taxonomies page
		include_once dirname( __FILE__ ) . '/class-ipa-fields-pack-admin-menus-taxonomies.php';
		include_once dirname( __FILE__ ) . '/handler/class-ipa-fields-pack-admin-taxonomies-handler.php';
	}

	public function admin_menu(){
		add_menu_page(
			__( 'IPA Fields Pack', IPA_Fields_Pack()->plugin->get_txt_domain() ),
			__( 'IPA Fields Pack' ),
			'manage_options',
			self::$ipa_fields_pack_page,
			NULL,
			'dashicons-admin-tools',
			'103.5'
		);

		$this->pages_hooks[self::$ipa_fields_pack_taxonomies_page] = add_submenu_page(
			self::$ipa_fields_pack_page,
			__( 'Taxonomies', IPA_Fields_Pack()->plugin->get_txt_domain() ),
			__( 'Taxonomies', IPA_Fields_Pack()->plugin->get_txt_domain() ),
			'manage_options',
			self::$ipa_fields_pack_taxonomies_page,
			array( $this, 'ipa_fields_pack_taxonomies_page' )
		);

		// screen options for taxonomies page
		add_action( sprintf("load-%s",$this->pages_hooks[self::$ipa_fields_pack_taxonomies_page]), array( 'IPA_Fields_Pack_Admin_Menus_Taxonomies', 'add_screen_options' ) );

		$this->pages_hooks[self::$ipa_fields_pack_settings_page] = add_submenu_page(
			self::$ipa_fields_pack_page,
			__( 'Settings', IPA_Fields_Pack()->plugin->get_txt_domain() ),
			__( 'Settings', IPA_Fields_Pack()->plugin->get_txt_domain() ),
			'manage_options',
			self::$ipa_fields_pack_settings_page,
			array( $this, 'ipa_fields_pack_settings_page' )
		);



		add_action('admin_print_styles-' . $this->pages_hooks[self::$ipa_fields_pack_settings_page], array('IPA_Fields_Pack_Admin_Menus_Settings','admin_menu_scripts'));
	}

	public function ipa_fields_pack_settings_page(){
		IPA_Fields_Pack_Admin_Menus_Settings::output();
	}

	public function ipa_fields_pack_taxonomies_page(){
		IPA_Fields_Pack_Admin_Menus_Taxonomies::output();
	}

	public function admin_menu_settings_scripts( $hook ) {
		if ( ! in_array( $hook, $this->pages_hooks ) ) {
			return;
		}

		wp_register_style( 'ipa-fields-pack-admin-style', IPA_FIELDS_PACK_URL . '/assets/css/admin.css', FALSE, IPA_Fields_Pack()->get_version() );
		wp_enqueue_style( 'ipa-fields-pack-admin-style' );

//		if ( $this->pages_hooks['settings_page_hook'] == $hook ) {
//			IPA_Fields_Pack_Admin_Menu_Settings::admin_menu_scripts( $plugin_data );
//		}
	}

}

return new IPA_Fields_Pack_Admin_Menus();