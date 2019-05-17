<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Admin' ) ):
	class ER_Calculator_Admin {
		public function __construct() {
			add_action( 'init', array( $this, 'includes' ) );

//			add_action( 'admin_notices', array(
//				'ER_Calculator_Admin_Notices',
//				'check_relation_plugin'
//			) );
		}

		public function includes() {
			include_once( 'class-admin-notices.php' );
			include_once( 'class-admin-menu.php' );
		}
	}
endif;

return new ER_Calculator_Admin();