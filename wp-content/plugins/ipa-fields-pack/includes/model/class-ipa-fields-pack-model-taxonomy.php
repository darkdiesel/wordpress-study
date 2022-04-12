<?php
/**
 * IPA Fields Pack Taxonomy Model Class
 *
 * @class    IPA_Fields_Pack_Model_Taxonomy
 */

/**
 * Class IPA_Fields_Pack_Model_Taxonomy
 */
class IPA_Fields_Pack_Model_Taxonomy {
	const TYPE_CUSTOM = 'custom';
	const TYPE_BUILTIN = 'builtin';

	/**
	 * @param $slug
	 *
	 * @return bool
	 */
	static function get( $slug ){
		$custom_taxonomies = get_option( IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME, array() );

		if(isset($custom_taxonomies[$slug])) {
			return $custom_taxonomies[$slug];
		} else {
			return FALSE;
		}
	}

	/**
	 * @param $taxonomy
	 *
	 * @return bool
	 */
	public static function insert( $taxonomy ) {
		$custom_taxonomies = get_option( IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME, array() );

		$custom_taxonomies[ $taxonomy['slug'] ] = $taxonomy;

		return update_option( IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME, $custom_taxonomies );
	}

	/**
	 * @param $taxonomy
	 *
	 * @return bool
	 */
	static function update($taxonomy){
		$custom_taxonomies = get_option( IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME, array() );

		$custom_taxonomies[ $taxonomy['slug'] ] = $taxonomy;

		return update_option( IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME, $custom_taxonomies );
	}

	/**
	 * @param $taxonomy
	 *
	 * @return bool
	 */
	static function delete($taxonomy){
		$custom_taxonomies = get_option( IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME, array() );

		if (isset($custom_taxonomies[ $taxonomy['slug'] ])) {
			unset($custom_taxonomies[ $taxonomy['slug'] ]);
		}

		return update_option( IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME, $custom_taxonomies );
	}

	public static function get_all() {
		return get_option( IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME, array() );
	}

	public static function get_all_limit() {

	}
}