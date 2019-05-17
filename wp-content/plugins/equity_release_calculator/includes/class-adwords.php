<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Adwords' ) ):
	class ER_Calculator_Adwords {
		public static function adwords(){
			if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'er_calculator_adwords_wpnonce' ) ) {
				die( _( 'Permission check failed' ) );
			}

			if (isset($_POST['adwords'])) {
				echo self::get_conversion_code((int)$_POST['adwords']);
				exit;
			}
		}

		static function get_conversion_code ($calcId)
		{
			if (!file_exists(ER_CALCULATOR_PATH . "/adwords/adwords_conversion_{$calcId}.html")) {
				return '';
			}

			return file_get_contents(ER_CALCULATOR_PATH . "/adwords/adwords_conversion_{$calcId}.html");
		}
	}
endif;

add_action( "wp_ajax_er_calculator_adwords", array(
	'ER_Calculator_Adwords',
	'adwords'
) );

add_action( "wp_ajax_nopriv_er_calculator_adwords", array(
	'ER_Calculator_Adwords',
	'adwords'
) );