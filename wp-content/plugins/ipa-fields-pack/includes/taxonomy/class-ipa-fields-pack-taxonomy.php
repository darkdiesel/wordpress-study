<?php
/**
 * IPA Fields Pack Taxonomy Class
 *
 * @class    IPA_Fields_Pack_Taxonomy
 */

class IPA_Fields_Pack_Taxonomy {

	/**
	 * @param string $output Optional. The type of output to return in the array. Accepts either taxonomy 'names'
	 *                         or 'objects'. Default 'names'.
	 *
	 * @return array|string[]|WP_Taxonomy[]
	 */

	public static function get_builtin( $output = 'names' ) {
		return get_taxonomies( array( 'public' => true, '_builtin' => true ), $output );
	}

	public static function get_status_label(){

	}
}