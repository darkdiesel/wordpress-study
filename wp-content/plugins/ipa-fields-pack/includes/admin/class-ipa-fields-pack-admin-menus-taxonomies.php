<?php
/**
 * IPA Fields Pack Admin Menu Settings
 *
 * @class    IPA_Fields_Pack_Admin_Menus_Settings
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class IPA_Fields_Pack_Admin_Menus_Settings
 */
class IPA_Fields_Pack_Admin_Menus_Taxonomies {
	public static function output() {
		global $ipa_fields_pack_taxonomies_list_table;

		include_once IPA_FIELDS_PACK_PATH . 'includes/model/class-ipa-fields-pack-model-taxonomy.php';

		if (isset($_REQUEST['action'])){
			if (in_array($_REQUEST['action'], array('edit', 'delete'))){
				if ( isset( $_REQUEST['taxonomy'] ) ) {
					$taxonomy = IPA_Fields_Pack_Model_Taxonomy::get(esc_attr($_GET['taxonomy']));
				} else {
					$taxonomy = array();
				}

				if ( !$taxonomy ) {
					IPA_Fields_Pack_Admin_Notices::add_notice(
						__( 'Taxonomy not founded!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
						IPA_Fields_Pack_Admin_Notices::ERROR
					);
				}
			}
		}

		IPA_Fields_Pack()->functions->get_template(
			'admin/taxonomies.php',
			array(
				'taxonomies_list_table' => $ipa_fields_pack_taxonomies_list_table,
				'taxonomy' => isset( $taxonomy ) ? $taxonomy : array()
			)
		);
	}

	static function add_screen_options(){
		if( ! class_exists( 'WP_List_Table' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
		}

		include_once IPA_FIELDS_PACK_PATH . '/includes/tables/class-ipa-fields-pack-taxonomies-list-table.php';

		global $ipa_fields_pack_taxonomies_list_table;

		add_screen_option( 'per_page', array(
			'label'   => 'Taxonomies on page',
			'default' => 10,
			'option'  => 'ipa_fields_pack_taxonomies_list_table_per_page',
		) );

		$ipa_fields_pack_taxonomies_list_table = new IPA_Fields_Pack_Table_Taxonomies_List_Table();
	}

	public static function per_page_set_option($status, $option, $value) {
		if ( 'ipa_fields_pack_taxonomies_list_table_per_page' == $option ) return $value;

		return $status;
	}

	public static function admin_menu_scripts() {

	}
}
