<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Calculator_Actions_Handler' ) ):
	class ER_Calculator_Calculator_Actions_Handler {

		static $nonce_action_add = 'erc_calculator_add';
		static $nonce_action_edit = 'erc_calculator_edit';
		static $nonce_action_delete = 'erc_calculator_delete';
		static $nonce_action_settings = 'erc_calculator_settings';

		public static function calculator_add_handler(){
			if ( isset( $_POST['erc_calculator']['add'] ) && $_POST['erc_calculator']['_wpnonce'] && wp_verify_nonce( $_POST['erc_calculator']['_wpnonce'], self::$nonce_action_add ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-calculators-model.php' );

				$erc_calculator = $_POST['erc_calculator'];

				unset($erc_calculator['id']);
				unset($erc_calculator['add']);
				unset($erc_calculator['_wpnonce']);

				$erc_calculator['title'] = ER_Calculator()->functions->remove_slash($erc_calculator['title']);
				$erc_calculator['text_area_one'] = ER_Calculator()->functions->remove_slash($erc_calculator['text_area_one']);
				$erc_calculator['text_area_two'] = ER_Calculator()->functions->remove_slash($erc_calculator['text_area_two']);
				$erc_calculator['result_text_area_one'] = ER_Calculator()->functions->remove_slash($erc_calculator['result_text_area_one']);
				$erc_calculator['result_text_area_two'] = ER_Calculator()->functions->remove_slash($erc_calculator['result_text_area_two']);

				$result = ER_Calculator_Model_Calculators::insert($erc_calculator);
				$last_id = ER_Calculator_Model_Calculators::insert_id();

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Calculator is successfully added!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('add', 'calculator', array_merge($erc_calculator, array('id' => $last_id)));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Calculator not add!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$er_calculator_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

		public static function calculator_edit_handler(){
			if ( isset( $_POST['erc_calculator']['edit'] ) && $_POST['erc_calculator']['_wpnonce'] && wp_verify_nonce( $_POST['erc_calculator']['_wpnonce'], self::$nonce_action_edit ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-calculators-model.php' );

				$erc_calculator = $_POST['erc_calculator'];
				$id = $erc_calculator['id'];

				unset($erc_calculator['edit']);
				unset($erc_calculator['_wpnonce']);

				$erc_calculator['title'] = ER_Calculator()->functions->remove_slash($erc_calculator['title']);
				$erc_calculator['text_area_one'] = ER_Calculator()->functions->remove_slash($erc_calculator['text_area_one']);
				$erc_calculator['text_area_two'] = ER_Calculator()->functions->remove_slash($erc_calculator['text_area_two']);
				$erc_calculator['result_text_area_one'] = ER_Calculator()->functions->remove_slash($erc_calculator['result_text_area_one']);
				$erc_calculator['result_text_area_two'] = ER_Calculator()->functions->remove_slash($erc_calculator['result_text_area_two']);

				$result = ER_Calculator_Model_Calculators::update($erc_calculator, array('id'=>$id));

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Calculator is successfully edited!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('update', 'calculator', array_merge($erc_calculator, array()));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Calculator not edit!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$er_calculator_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

		public static function calculator_delete_handler(){
			if ( isset( $_POST['erc_calculator']['delete'] ) && $_POST['erc_calculator']['_wpnonce'] && wp_verify_nonce( $_POST['erc_calculator']['_wpnonce'], self::$nonce_action_delete ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-calculators-model.php' );

				$erc_calculator = $_POST['erc_calculator'];
				$id = $erc_calculator['id'];

				unset($erc_calculator['delete']);
				unset($erc_calculator['_wpnonce']);

				$result = ER_Calculator_Model_Calculators::delete( array( 'id' => $id ) );

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Calculator is successfully deleted!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('delete', 'calculator', array_merge($erc_calculator, array()));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Calculator not delete!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$er_calculator_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

		public static function calculator_settings_handler(){
			if ( isset( $_POST['erc_calculator_settings']['settings'] ) && $_POST['erc_calculator_settings']['_wpnonce'] && wp_verify_nonce( $_POST['erc_calculator_settings']['_wpnonce'], self::$nonce_action_settings ) ) {

				$data = $_POST['erc_calculator_settings'];

				if ( ! empty( $_FILES ) ) {
					foreach ( $_FILES as $option => $fileOption ) {
						if ( ! empty( $fileOption['name'] ) ) {
							$file = wp_handle_upload( $fileOption, array( 'test_form' => false ) );
							$data[ $option ] = $file['url'];
						}
					}
				}

				foreach ( $data as $k => $v ) {
					if ( ! add_option( $k, trim( $v ) ) ) {
						update_option( $k, trim( $v ) );
					}
				}

				ER_Calculator_Admin_Notices::add_notice(
					__('Calculator settings is successfully updated!', ER_Calculator()->plugin->get_text_domain()),
					ER_Calculator_Admin_Notices::UPDATED
				);

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$er_calculator_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

	}
endif;

add_action( 'init', array('ER_Calculator_Calculator_Actions_Handler', 'calculator_add_handler') );
add_action( 'init', array('ER_Calculator_Calculator_Actions_Handler', 'calculator_edit_handler') );
add_action( 'init', array('ER_Calculator_Calculator_Actions_Handler', 'calculator_delete_handler') );
add_action( 'init', array('ER_Calculator_Calculator_Actions_Handler', 'calculator_settings_handler') );