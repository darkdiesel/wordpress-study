<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Shortcodes' ) ) :

	class ER_Calculator_Shortcodes {

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
//			add_action( 'wp_enqueue_scripts',
//				[
//					__CLASS__,
//					'add_shortcodes_css_js',
//				] );

			$shortcodes = [
				'erc_calc'          => [
					'title'       => __( 'Equity Release calculator',
						ER_Calculator()->plugin->get_text_domain() ),
					'description' => __( 'block for displaying photosession post type',
						ER_Calculator()->plugin->get_text_domain() ),
					'has_content' => FALSE,
					'attributes'  => [
						'calc' => [
							'type' => 'int',
							'std'  => ''
						],
						'type' => [
							'type' => 'str',
							'std'  => ''
						]
					],
				],
			];

			self::$shortcodes = apply_filters( 'er_calculator_add_shortcodes',
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
			$content = null,
			$shortcode
		) {
			$all_atts            = [];
			if (is_array($atts)) {
				$all_atts            += $atts;
			}
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

			$dir = 'shortcodes/';

			if (isset(self::$shortcodes[ $shortcode ]['tpl_dir'])){
				$dir .= sprintf('%s/', self::$shortcodes[ $shortcode ]['tpl_dir']);
			}

			ER_Calculator()->functions->get_template( $dir . $shortcode . '.php',
				array_merge( $atts, [ 'other_atts' => $all_atts ] ) );

			$shortcode_html = ob_get_clean();

			return apply_filters( 'er_calculator_shortcode_' . $shortcode,
				$shortcode_html );
		}

		/**
		 * Add shortcodes style
		 *
		 */
		public static function add_shortcodes_css_js() {
			$plugin_data = ER_Calculator()->plugin->get_data();

//			wp_register_script( 'er-calculator-jquery-knob', ER_CALCULATOR_URL . '/assets/js/jquery.knob.min.js', array('jquery'), $plugin_data['Version'] );
		}
	}
endif;

add_action( 'init', [ 'ER_Calculator_Shortcodes', 'init' ] );