<?php
/**
 * IPA Fields Pack Admin Taxonomies Handler
 *
 * @class    IPA_Fields_Pack_Admin_Taxonomies_Handler
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class IPA_Fields_Pack_Admin_Taxonomies_Handler
 */
class IPA_Fields_Pack_Admin_Taxonomies_Handler {

	static $nonce_action_add = 'ipa_fields_pack_taxonomy_add';
	static $nonce_action_edit = 'ipa_fields_pack_taxonomy_edit';
	static $nonce_action_delete = 'ipa_fields_pack_taxonomy_delete';

	public static function taxonomy_add_handler() {
		if ( isset( $_POST['ipa-fields-pack-taxonomy']['add'] ) && $_POST['ipa-fields-pack-taxonomy']['_wpnonce'] && wp_verify_nonce( $_POST['ipa-fields-pack-taxonomy']['_wpnonce'], self::$nonce_action_add ) ) {

			// include taxonomy model
			include_once IPA_FIELDS_PACK_PATH . 'includes/model/class-ipa-fields-pack-model-taxonomy.php';

			$taxonomy = $_POST['ipa-fields-pack-taxonomy'];

			unset( $taxonomy['add'] );
			unset( $taxonomy['_wpnonce'] );

			$result  = IPA_Fields_Pack_Model_Taxonomy::insert( $taxonomy );

			if ( $result ) {
				IPA_Fields_Pack_Admin_Notices::add_notice(
					__( 'Taxonomy is successfully added!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
					IPA_Fields_Pack_Admin_Notices::UPDATED
				);
			} else {
				IPA_Fields_Pack_Admin_Notices::add_notice(
					__( 'Taxonomy not add!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
					IPA_Fields_Pack_Admin_Notices::ERROR
				);
			}

			wp_redirect( esc_url( admin_url( 'admin.php?page=' . IPA_Fields_Pack_Admin_Menus::$ipa_fields_pack_taxonomies_page ) ) );
			exit();
		}
	}

	public static function taxonomy_edit_handler() {
		if ( isset( $_POST['ipa-fields-pack-taxonomy']['edit'] ) && $_POST['ipa-fields-pack-taxonomy']['_wpnonce'] && wp_verify_nonce( $_POST['ipa-fields-pack-taxonomy']['_wpnonce'], self::$nonce_action_edit ) ) {

			// include taxonomy model
			include_once IPA_FIELDS_PACK_PATH . 'includes/model/class-ipa-fields-pack-model-taxonomy.php';

			$taxonomy = $_POST['ipa-fields-pack-taxonomy'];

			unset( $taxonomy['edit'] );
			unset( $taxonomy['_wpnonce'] );

			$result  = IPA_Fields_Pack_Model_Taxonomy::update( $taxonomy );

			if ( $result ) {
				IPA_Fields_Pack_Admin_Notices::add_notice(
					__( 'Taxonomy is successfully edited!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
					IPA_Fields_Pack_Admin_Notices::UPDATED
				);
			} else {
				IPA_Fields_Pack_Admin_Notices::add_notice(
					__( 'Taxonomy not edit!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
					IPA_Fields_Pack_Admin_Notices::ERROR
				);
			}

			wp_redirect( esc_url( admin_url( 'admin.php?page=' . IPA_Fields_Pack_Admin_Menus::$ipa_fields_pack_taxonomies_page ) ) );
			exit();
		}
	}

	public static function taxonomy_delete_handler() {
		if ( isset( $_POST['ipa-fields-pack-taxonomy']['delete'] ) && $_POST['ipa-fields-pack-taxonomy']['_wpnonce'] && wp_verify_nonce( $_POST['ipa-fields-pack-taxonomy']['_wpnonce'], self::$nonce_action_delete ) ) {

			// include taxonomy model
			include_once IPA_FIELDS_PACK_PATH . 'includes/model/class-ipa-fields-pack-model-taxonomy.php';

			$taxonomy = $_POST['ipa-fields-pack-taxonomy'];

			unset( $taxonomy['delete'] );
			unset( $taxonomy['_wpnonce'] );

			$result  = IPA_Fields_Pack_Model_Taxonomy::delete( $taxonomy );

			if ( $result ) {
				IPA_Fields_Pack_Admin_Notices::add_notice(
					__( 'Taxonomy is successfully deleted!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
					IPA_Fields_Pack_Admin_Notices::UPDATED
				);
			} else {
				IPA_Fields_Pack_Admin_Notices::add_notice(
					__( 'Taxonomy not delete!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
					IPA_Fields_Pack_Admin_Notices::ERROR
				);
			}

			wp_redirect( esc_url( admin_url( 'admin.php?page=' . IPA_Fields_Pack_Admin_Menus::$ipa_fields_pack_taxonomies_page ) ) );
			exit();
		}
	}
}

add_action( 'init', array( 'IPA_Fields_Pack_Admin_Taxonomies_Handler', 'taxonomy_add_handler' ) );
add_action( 'init', array( 'IPA_Fields_Pack_Admin_Taxonomies_Handler', 'taxonomy_edit_handler' ) );
add_action( 'init', array( 'IPA_Fields_Pack_Admin_Taxonomies_Handler', 'taxonomy_delete_handler' ) );