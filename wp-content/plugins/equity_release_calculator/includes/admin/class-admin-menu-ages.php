<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Admin_Menu_Ages' ) ):
	class ER_Calculator_Admin_Menu_Ages {
		public static function ages_page_output() {
			global $erc_ages_list_table;

			include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-ages-model.php' );

			if (isset($_REQUEST['action'])){
				if (in_array($_REQUEST['action'], array('edit', 'delete'))){
					if ( isset( $_REQUEST['age_id'] ) ) {
						$erc_age = ER_Calculator_Model_Ages::get(esc_attr($_GET['age_id']));
					} else {
						$erc_age = array();
					}

					if ( !$erc_age ) {
						ER_Calculator_Admin_Notices::add_notice(
							__( 'Age not founded!', ER_Calculator()->plugin->get_text_domain() ),
							ER_Calculator_Admin_Notices::ERROR
						);
					}
				}
			}

			ER_Calculator()->functions->get_template(
				'admin/ages.php',
				array(
					'erc_ages_list_table' => $erc_ages_list_table,
					'erc_age' => isset( $erc_age ) ? $erc_age : array()
				)
			);
		}

		static function add_screen_options(){
			if( ! class_exists( 'WP_List_Table' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
			}

			include_once( ER_CALCULATOR_PATH . '/includes/table/class-erc-ages-table.php' );

			global $erc_ages_list_table;

			add_screen_option( 'per_page', array(
				'label'   => 'show on page',
				'default' => 10,
				'option'  => 'er_calculator_ages_list_table_per_page',
			) );

			$erc_ages_list_table = new ER_Calculator_Table_Ages_List_Table();
		}

		public static function per_page_set_option($status, $option, $value) {
			if ( 'er_calculator_ages_list_table_per_page' == $option ) return $value;

			return $status;
		}

		public static function plugin_ages_ajax_save() {
			if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'er_calculator_menu_ages_wpnonce' ) ) {
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

		public static function admin_menu_ages_styles() {
			$plugin_data = ER_Calculator()->plugin->get_data();
		}
	}
endif;

// class actions
//add_action( "wp_ajax_er_calculator_ages_save", array(
//	'ER_Calculator_Admin_Menu_Ages',
//	'plugin_ages_ajax_save'
//) );