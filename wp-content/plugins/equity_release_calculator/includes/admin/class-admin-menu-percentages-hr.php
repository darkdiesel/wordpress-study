<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Admin_Menu_Percentages_HR' ) ):
	class ER_Calculator_Admin_Menu_Percentages_HR {
		public static function percentages_hr_page_output() {
			global $erc_percentages_hr_list_table;

			// include model
			include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-ages-model.php' );
			include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-hr-model.php' );

			if (isset($_REQUEST['action'])){
				if (in_array($_REQUEST['action'], array('edit', 'delete'))){
					if ( isset( $_REQUEST['percentage_hr_id'] ) ) {
						$erc_percentage_hr = ER_Calculator_Model_Percentages_HR::get( esc_attr( $_REQUEST['percentage_hr_id'] ) );
					} else {
						$erc_percentage_hr = array();
					}

					if ( ! $erc_percentage_hr ) {
						ER_Calculator_Admin_Notices::add_notice(
							__( 'Percentage Home Reversion not founded!', ER_Calculator()->plugin->get_text_domain() ),
							ER_Calculator_Admin_Notices::ERROR
						);
					}

					$ages = ER_Calculator_Model_Ages::get_all();
				} elseif ($_REQUEST['action'] == 'add') {
					$ages = ER_Calculator_Model_Percentages_HR::get_free_ages();
				}
			}

			ER_Calculator()->functions->get_template(
				'admin/percentages_hr.php',
				array(
					'erc_percentages_hr_list_table' => $erc_percentages_hr_list_table,
					'erc_percentage_hr' => isset( $erc_percentage_hr ) ? $erc_percentage_hr : array(),
					'ages' => isset( $ages ) ? $ages : array(),
				)
			);
		}

		static function add_screen_options(){
			if( ! class_exists( 'WP_List_Table' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
			}

			include_once( ER_CALCULATOR_PATH . '/includes/table/class-erc-percentages-hr-table.php' );

			global $erc_percentages_hr_list_table;

			add_screen_option( 'per_page', array(
				'label'   => 'show on page',
				'default' => 10,
				'option'  => 'er_calculator_percentages_hr_list_table_per_page',
			) );

			$erc_percentages_hr_list_table = new ER_Calculator_Table_Percentages_HR_List_Table();
		}

		public static function per_page_set_option($status, $option, $value) {
			if ( 'er_calculator_percentages_hr_list_table_per_page' == $option ) return $value;

			return $status;
		}

		public static function plugin_percentages_hr_ajax_save() {
			if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'er_calculator_menu_percentages_hr_wpnonce' ) ) {
				die( _( 'Permission check failed' ) );
			}

			//build setting array
			$ages = array();

			if ( isset( $_POST['form'] ) ) {
				foreach ( $_POST['form'] as $option ) {
					if ( strpos( $option['name'], '[]' ) ) {
						$ages[ substr( $option['name'], 0, strlen( $option['name'] ) - strpos( $option['name'], '[]' ) - 1 ) ][] = $option['value'];
					} else {
						$ages[ $option['name'] ] = $option['value'];
					}
				}
			}

			//save plugin ages
			//update_option( ER_Calculator()->plugin->plugin_ages_option, wp_slash( json_encode( $ages ) ) );

			//create response
			$response = array();

			$response['ajax']    = 'success';
			$response['message'] = sprintf( '<strong>%s</strong>', __( 'Settings successfully saved!', ER_Calculator()->plugin->get_text_domain() ) );
			$response['fields']  = $ages;

			//return json
			echo json_encode( $response );

			die();
		}

		public static function admin_menu_percentages_hr_styles() {
			$plugin_data = ER_Calculator()->plugin->get_data();
		}
	}
endif;

// class actions
//add_action( "wp_ajax_er_calculator_percentages_hr_save", array(
//	'ER_Calculator_Admin_Menu_Percentages_HR',
//	'plugin_percentages_hr_ajax_save'
//) );