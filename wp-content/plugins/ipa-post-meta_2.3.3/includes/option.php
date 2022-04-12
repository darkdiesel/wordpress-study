<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Option' ) ):
	class IPA_PostMeta_Option {
		public static function get_option_arr($option, $default = false){
			$settings = get_option( $option, $default );

			if ($settings == ''){
				return array();
			}

			$settings = stripslashes( $settings );
			$settings = json_decode( $settings, true );

			if (is_array($settings)){
				$settings = IPA_PostMeta_Utils::array_map_recursive( array(
					'IPA_PostMeta_Utils',
					'map_strip_slashes'
				), $settings );

				return $settings;
			} else {
				return array();
			}
		}
	}
endif;