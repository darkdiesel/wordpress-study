<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Age_Actions_Handler' ) ):
	class ER_Calculator_Age_Actions_Handler {

		static $nonce_action_add = 'erc_age_add';
		static $nonce_action_edit = 'erc_age_edit';
		static $nonce_action_delete = 'erc_age_delete';

		public static function age_add_handler(){
			if ( isset( $_POST['erc_age']['add'] ) && $_POST['erc_age']['_wpnonce'] && wp_verify_nonce( $_POST['erc_age']['_wpnonce'], self::$nonce_action_add ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-ages-model.php' );

				$erc_age = $_POST['erc_age'];

				unset($erc_age['add']);
				unset($erc_age['_wpnonce']);

				$result  = ER_Calculator_Model_Ages::insert( $erc_age );
				$last_id = ER_Calculator_Model_Ages::insert_id();

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Age is successfully added!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('add', 'age', array_merge($erc_age, array('id' => $last_id)));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Age not add!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect( esc_url(admin_url( 'admin.php?page=' . ER_Calculator_Admin_Menu::$ages_page) ) );
				exit();
			}
		}

		public static function age_edit_handler(){
			if ( isset( $_POST['erc_age']['edit'] ) && $_POST['erc_age']['_wpnonce'] && wp_verify_nonce( $_POST['erc_age']['_wpnonce'], self::$nonce_action_edit ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-ages-model.php' );

				$erc_age = $_POST['erc_age'];
				$id = $erc_age['id'];

				unset($erc_age['edit']);
				unset($erc_age['_wpnonce']);

				$result = ER_Calculator_Model_Ages::update($erc_age, array('id'=>$id));

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Age is successfully edited!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('update', 'age', array_merge($erc_age, array()));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Age not edit!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect( esc_url(admin_url( 'admin.php?page=' . ER_Calculator_Admin_Menu::$ages_page) ) );
				exit();
			}
		}

		public static function age_delete_handler(){
			if ( isset( $_POST['erc_age']['delete'] ) && $_POST['erc_age']['_wpnonce'] && wp_verify_nonce( $_POST['erc_age']['_wpnonce'], self::$nonce_action_delete ) ) {

				// include age model
				include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-ages-model.php' );

				$erc_age = $_POST['erc_age'];
				$id = $erc_age['id'];

				unset($erc_age['delete']);
				unset($erc_age['_wpnonce']);

				$result = ER_Calculator_Model_Ages::delete( array( 'id' => $id ) );

				if ($result){
					ER_Calculator_Admin_Notices::add_notice(
						__('Age is successfully deleted!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::UPDATED
					);

					ER_Calculator_Synchronisation::send_request('delete', 'age', array_merge($erc_age, array()));
				} else {
					ER_Calculator_Admin_Notices::add_notice(
						__('Age not delete!', ER_Calculator()->plugin->get_text_domain()),
						ER_Calculator_Admin_Notices::ERROR
					);
				}

				wp_redirect( esc_url(admin_url( 'admin.php?page=' . ER_Calculator_Admin_Menu::$ages_page) ) );
				exit();
			}
		}
	}
endif;

add_action( 'init', array('ER_Calculator_Age_Actions_Handler', 'age_add_handler') );
add_action( 'init', array('ER_Calculator_Age_Actions_Handler', 'age_edit_handler') );
add_action( 'init', array('ER_Calculator_Age_Actions_Handler', 'age_delete_handler') );