<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Photosession_PostType_Admin' ) ):
	class IPA_Photosession_PostType_Admin {
		public function __construct() {
			add_action( 'init', array( $this, 'includes' ) );

			add_action( 'admin_notices', array(
				'IPA_Photosession_PostType_Admin_Notices',
				'check_relation_plugin'
			) );
		}

		public function includes() {
			include_once( 'admin-notices.php' );
//			include_once( 'admin-menu.php' );
		}
	}
endif;

return new IPA_Photosession_PostType_Admin();