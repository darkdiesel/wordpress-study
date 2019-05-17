<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Percentage_Actions_Handler' ) ):
	class ER_Calculator_Percentage_Actions_Handler {

		static $nonce_action_add = 'erc_percentage_add';
		static $nonce_action_edit = 'erc_percentage_edit';
		static $nonce_action_delete = 'erc_percentage_delete';

		public static function percentage_add_handler(){
			if ( isset( $_POST['erc_percentage']['add'] ) && $_POST['erc_percentage']['_wpnonce'] && wp_verify_nonce( $_POST['erc_percentage']['_wpnonce'], self::$nonce_action_add ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-model.php' );

				$erc_percentage = $_POST['erc_percentage'];

				unset($erc_percentage['id']);
				unset($erc_percentage['add']);
				unset($erc_percentage['_wpnonce']);

				$result = ER_Calculator_Model_Percentages::insert($erc_percentage);
				$last_id = ER_Calculator_Model_Percentages::insert_id();

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Percentage is successfully added!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('add', 'percentage', array_merge($erc_percentage, array('id' => $last_id)));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Percentage not add!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$percentages_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

		public static function percentage_edit_handler(){
			if ( isset( $_POST['erc_percentage']['edit'] ) && $_POST['erc_percentage']['_wpnonce'] && wp_verify_nonce( $_POST['erc_percentage']['_wpnonce'], self::$nonce_action_edit ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-model.php' );

				$erc_percentage = $_POST['erc_percentage'];
				$id = $erc_percentage['id'];

				unset($erc_percentage['edit']);
				unset($erc_percentage['_wpnonce']);

				$result = ER_Calculator_Model_Percentages::update($erc_percentage, array('id'=>$id));

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Percentage is successfully edited!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('update', 'percentage', array_merge($erc_percentage, array()));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Percentage not edit!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$percentages_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

		public static function percentage_delete_handler(){
			if ( isset( $_POST['erc_percentage']['delete'] ) && $_POST['erc_percentage']['_wpnonce'] && wp_verify_nonce( $_POST['erc_percentage']['_wpnonce'], self::$nonce_action_delete ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-model.php' );

				$erc_percentage = $_POST['erc_percentage'];
				$id = $erc_percentage['id'];

				unset($erc_percentage['delete']);
				unset($erc_percentage['_wpnonce']);

				$result = ER_Calculator_Model_Percentages::delete( array( 'id' => $id ) );

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Percentage is successfully deleted!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('delete', 'percentage', array_merge($erc_percentage, array()));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Percentage not delete!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$percentages_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

	}
endif;

add_action( 'init', array('ER_Calculator_Percentage_Actions_Handler', 'percentage_add_handler') );
add_action( 'init', array('ER_Calculator_Percentage_Actions_Handler', 'percentage_edit_handler') );
add_action( 'init', array('ER_Calculator_Percentage_Actions_Handler', 'percentage_delete_handler') );