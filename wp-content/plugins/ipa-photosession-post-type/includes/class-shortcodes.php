<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Photosession_PostType_Shortcodes' ) ) :

	class IPA_Photosession_PostType_Shortcodes {

		/**
		 * Shortcodes
		 *
		 * The array is created by using the following rules:
		 *
		 * [shortcode_name] => array(
		 *     [title] => 'title',
		 *     [description] => 'description',
		 *     [has_content] => true,
		 *     [attributes] => array(
		 *       [param1_name] => array(
		 *        'type' => 'param1_type',
		 *          'std'  => 'param1_std'
		 *        )
		 *        [param2_name] => array(
		 *        'type' => 'param2_type',
		 *          'std'  => 'param2_std'
		 *        )
		 *    )
		 * )
		 *
		 * @var array
		 *
		 */
		public static $shortcodes = [];

		/**
		 * Init
		 *
		 */
		public static function init() {
			add_action( 'wp_enqueue_scripts',
				[
					__CLASS__,
					'add_shortcodes_css_js',
				] );

			$shortcodes = [
				'ipa_photosession_block'          => [
					'title'       => __( 'Photossetions block',
						IPA_Photosession_PostType()->plugin->get_text_domain() ),
					'description' => __( 'block for displaying photosession post type',
						IPA_Photosession_PostType()->plugin->get_text_domain() ),
					'has_content' => FALSE,
					'attributes'  => [],
				],
			];

			self::$shortcodes = apply_filters( 'ipa_photosession_post_type_add_shortcodes',
				$shortcodes );
			asort( self::$shortcodes );
			self::add_shortcodes();
		}


		/**
		 * Register shortcodes
		 *
		 */
		public static function add_shortcodes() {
			foreach ( self::$shortcodes as $shortcode => $atts ) {
				if ( isset( $atts['create'] ) && ! $atts['create'] ) {
					continue;
				}
				add_shortcode( $shortcode, [ __CLASS__, 'add_shortcode' ] );
			}
		}

		/**
		 * Shortcode callback
		 *
		 * @param $atts array()
		 * @param $content mixed
		 * @param $shortcode string
		 *
		 * @return string
		 */
		public static function add_shortcode(
			$atts,
			$content = NULL,
			$shortcode
		) {

			$all_atts            = $atts;
			$all_atts['content'] = $content;

			if ( isset( self::$shortcodes[ $shortcode ]['unlimited'] ) && self::$shortcodes[ $shortcode ]['unlimited'] ) {
				$atts['content'] = $content;
			} else {
				//retrieves default atts
				$default_atts = [];

				if ( ! empty( self::$shortcodes[ $shortcode ]['attributes'] ) ) {
					foreach ( self::$shortcodes[ $shortcode ]['attributes'] as $name => $type ) {
						$default_atts[ $name ] = isset( $type['std'] ) ? $type['std'] : '';
					}
				}

				//combines with user attributes
				$atts            = shortcode_atts( $default_atts, $atts );
				$atts['content'] = $content;
			}

			// remove validate attrs
			foreach ( $atts as $att => $v ) {
				unset( $all_atts[ $att ] );
			}

			ob_start();

			IPA_Photosession_PostType()->functions->get_template( 'shortcodes/' . $shortcode . '.php',
				array_merge( $atts, [ 'other_atts' => $all_atts ] ) );

			$shortcode_html = ob_get_clean();

			return apply_filters( 'ipa_photosession_post_type_shortcode_' . $shortcode,
				$shortcode_html );
		}

		/**
		 * Add shortcodes style
		 *
		 */
		public static function add_shortcodes_css_js() {
			$plugin_data = IPA_Photosession_PostType()->plugin->get_data();

			wp_register_script( 'ipa-photosession-post-type-jquery-knob', IPA_PHOTOSESSION_POST_TYPE_URL . '/assets/js/jquery.knob.min.js', array('jquery'), $plugin_data['Version'] );
		}
	}
endif;

add_action( 'init', [ 'IPA_Photosession_PostType_Shortcodes', 'init' ] );