<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Utils' ) ):
	class IPA_PostMeta_Utils {
		/**
		 * Recursive mapping function $func to each array $arr elements
		 *
		 * @param callable $func
		 * @param array $arr
		 *
		 * @return array
		 */
		public static function array_map_recursive( callable $func, array $arr ) {
			array_walk_recursive( $arr, function ( &$v ) use ( $func ) {
				$v = $func( $v );
			} );

			return $arr;
		}

		/**
		 * Filter meta fields value before printing
		 *
		 * @param $el
		 *
		 * @return string
		 */
		public static function map_strip_slashes( &$el ) {
			if ( is_array( $el ) ) {
				return $el;
			} else {
				return stripslashes( $el );
			}
		}
	}
endif;