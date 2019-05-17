<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Iframe' ) ):
	class ER_Calculator_Iframe {
		public static function init() {
			global $isErcIframeMode;

			if (isset($_GET['partner_id'])) {
				$isErcIframeMode = true;
			}
		}
	}
endif;

add_action('init', array('ER_Calculator_Iframe', 'init'));