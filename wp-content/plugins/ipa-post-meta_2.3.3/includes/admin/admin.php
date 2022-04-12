<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Admin' ) ):
	class IPA_PostMeta_Admin {
		public function __construct() {
			add_action( 'init', array( $this, 'includes' ) );
		}

		public function includes() {

		}
	}
endif;

return new IPA_PostMeta_Admin();