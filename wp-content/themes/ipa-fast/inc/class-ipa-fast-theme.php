<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fast_Theme' ) ) :

	class IPA_Fast_Theme {
		private static $theme = null;

		/**
		 * @return WP_Theme|null
		 */
		public static function get_theme(){
			if (!isset(self::$theme)) {
				self::$theme = wp_get_theme();
			}
			return self::$theme;
		}

		/**
		 * @param $data string
		 *
		 * @return false|string
		 */
		public static function get_theme_data($data){
			return  self::get_theme()->get($data);
		}

		/**
		 * @return false|string
		 */
		static function get_txt_domain() {
			return self::get_theme_data('TextDomain');
		}
	}

endif;