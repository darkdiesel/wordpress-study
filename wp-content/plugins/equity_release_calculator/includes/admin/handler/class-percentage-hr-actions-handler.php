<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Percentage_HR_Actions_Handler' ) ):
	class ER_Calculator_Percentage_HR_Actions_Handler {

		static $nonce_action_add = 'erc_percentage_hr_add';
		static $nonce_action_edit = 'erc_percentage_hr_edit';
		static $nonce_action_delete = 'erc_percentage_hr_delete';

		public static function percentage_hr_add_handler(){
			if ( isset( $_POST['erc_percentage_hr']['add'] ) && $_POST['erc_percentage_hr']['_wpnonce'] && wp_verify_nonce( $_POST['erc_percentage_hr']['_wpnonce'], self::$nonce_action_add ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-hr-model.php' );

				$erc_percentage_hr = $_POST['erc_percentage_hr'];

				unset($erc_percentage_hr['id']);
				unset($erc_percentage_hr['add']);
				unset($erc_percentage_hr['_wpnonce']);

				$result = ER_Calculator_Model_Percentages_HR::insert($erc_percentage_hr);
				$last_id = ER_Calculator_Model_Percentages_HR::insert_id();

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Home reversion is successfully added!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('add', 'percentage_hr', array_merge($erc_percentage_hr, array('id' => $last_id)));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Home reversion not add!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$percentages_hr_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

		public static function percentage_hr_edit_handler(){
			if ( isset( $_POST['erc_percentage_hr']['edit'] ) && $_POST['erc_percentage_hr']['_wpnonce'] && wp_verify_nonce( $_POST['erc_percentage_hr']['_wpnonce'], self::$nonce_action_edit ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-hr-model.php' );

				$erc_percentage_hr = $_POST['erc_percentage_hr'];
				$id = $erc_percentage_hr['id'];

				unset($erc_percentage_hr['edit']);
				unset($erc_percentage_hr['_wpnonce']);

				$result = ER_Calculator_Model_Percentages_HR::update($erc_percentage_hr, array('id'=>$id));

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Home reversion is successfully edited!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('update', 'percentage_hr', array_merge($erc_percentage_hr, array()));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Home reversion not edit!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$percentages_hr_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

		public static function percentage_hr_delete_handler(){
			if ( isset( $_POST['erc_percentage_hr']['delete'] ) && $_POST['erc_percentage_hr']['_wpnonce'] && wp_verify_nonce( $_POST['erc_percentage_hr']['_wpnonce'], self::$nonce_action_delete ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-hr-model.php' );

				$erc_percentage_hr = $_POST['erc_percentage_hr'];
				$id = $erc_percentage_hr['id'];

				unset($erc_percentage_hr['delete']);
				unset($erc_percentage_hr['_wpnonce']);

				$result = ER_Calculator_Model_Percentages_HR::delete( array( 'id' => $id ) );

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Home reversion is successfully deleted!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('delete', 'percentage_hr', array_merge($erc_percentage_hr, array()));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Home reversion not delete!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect(
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$percentages_hr_page,
							),
							admin_url( 'admin.php')
						))
				);

				exit();
			}
		}

	}
endif;

add_action( 'init', array('ER_Calculator_Percentage_HR_Actions_Handler', 'percentage_hr_add_handler') );
add_action( 'init', array('ER_Calculator_Percentage_HR_Actions_Handler', 'percentage_hr_edit_handler') );
add_action( 'init', array('ER_Calculator_Percentage_HR_Actions_Handler', 'percentage_hr_delete_handler') );