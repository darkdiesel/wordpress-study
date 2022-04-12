<?php
/**
 * IPA Fields Pack Admin
 *
 * @class    IPA_Fields_Pack_Admin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class LetterboxThumbnails_Admin
 */
class IPA_Fields_Pack_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		//add_action( 'init', array( $this, 'includes' ) );

		$this->includes();

		add_action( 'admin_notices', array(
			'IPA_Fields_Pack_Admin_Notices',
			'check_relation_plugin'
		) );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		include_once dirname( __FILE__ ) . '/class-ipa-fields-pack-admin-menus.php';
		include_once dirname( __FILE__ ) . '/class-ipa-fields-pack-admin-notices.php';
	}
}

return new IPA_Fields_Pack_Admin();
