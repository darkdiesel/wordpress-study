<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Calculate' ) ):
	class ER_Calculator_Calculate {
		public static function calculate() {
			if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'er_calculator_calculate_wpnonce' ) ) {
				die( _( 'Permission check failed' ) );
			}

			$integrationMethod = get_option('erc_' . $_POST['calcId'] . '_flg_integration_method');

			switch ($integrationMethod){
				case 'home_reversion':
					$leadID = ER_Calculator_Flg360_Integration::home_reversion_integration($_POST);
					break;
				default:
					$leadID = ER_Calculator_Flg360_Integration::default_integration($_POST);
					break;
			}

			ER_Calculator_Mail::send_email($_POST, $leadID);

			$send_user_email = get_option('erc_' . $_POST['calcId'] . '_user_email_enabled');

			if ($send_user_email) {
				ER_Calculator_Mail::send_user_email($_POST);
			}

			//create response
			$response = array();

			$response['ajax']    = 'success';

			//return json
			echo json_encode( $response );

			die();
		}
	}
endif;

add_action( "wp_ajax_er_calculator_calculate", array(
	'ER_Calculator_Calculate',
	'calculate'
) );

add_action( "wp_ajax_nopriv_er_calculator_calculate", array(
	'ER_Calculator_Calculate',
	'calculate'
) );