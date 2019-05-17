<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Core_Functions' ) ):
	class ER_Calculator_Core_Functions {
		/**
		 * Get other templates (e.g. product attributes) passing attributes and including the file.
		 *
		 * @access public
		 * @param string $template_name
		 * @param array $args (default: array())
		 * @param string $template_path (default: '')
		 * @param string $default_path (default: '')
		 */

		public function get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
			if ( ! empty( $args ) && is_array( $args ) ) {
				extract( $args );
			}

			$located = $this->locate_template( $template_name, $template_path, $default_path );

			if ( ! file_exists( $located ) ) {
				_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
				return;
			}

			// Allow 3rd party plugin filter template file from their plugin.
			$located = apply_filters( 'er_calculator_get_template', $located, $template_name, $args, $template_path, $default_path );

			do_action( 'er_calculator_before_template_part', $template_name, $template_path, $located, $args );

			include( $located );

			do_action( 'er_calculator_after_template_part', $template_name, $template_path, $located, $args );
		}

		/**
		 * Locate a template and return the path for inclusion.
		 *
		 * This is the load order:
		 *
		 *		yourtheme		/	$template_path	/	$template_name
		 *		yourtheme		/	$template_name
		 *		$default_path	/	$template_name
		 *
		 * @access public
		 * @param string $template_name
		 * @param string $template_path (default: '')
		 * @param string $default_path (default: '')
		 * @return string
		 */
		function locate_template( $template_name, $template_path = '', $default_path = '' ) {
			if ( ! $template_path ) {
				$template_path = ER_Calculator()->plugin->template_path();
			}

			if ( ! $default_path ) {
				$default_path = ER_Calculator()->plugin_path() . '/templates/';
			}

			// Look within passed path within the theme - this is priority.
			$template = locate_template(
				array(
					trailingslashit( $template_path ) . $template_name,
					$template_name
				)
			);

			// Get default template/
			if ( ! $template || ER_CALCULATOR_TEMPLATE_DEBUG_MODE ) {
				$template = $default_path . $template_name;
			}

			// Return what we found.
			return apply_filters( 'er_calculator_locate_template', $template, $template_name, $template_path );
		}

		/**
		 * @param $type
		 * @param $position
		 * @param $beginColor
		 * @param $endColor
		 *
		 * @return string
		 */
		function ercGenerateGradient( $type, $position, $beginColor, $endColor ) {
			if ( ( $type != 'linear-gradient' && $type != 'radial-gradient' )
			     || empty( $position )
			     || empty( $beginColor )
			     || empty( $endColor )
			) {

				return "";
			}

			$otherPosition = 'top';
			switch ( $position ) {
				case 'to top':
					$otherPosition = 'top';
					break;
				case 'to left':
					$otherPosition = 'left';
					break;
				case 'to bottom':
					$otherPosition = 'bottom';
					break;
				case 'to right':
					$otherPosition = 'right';
					break;
				case 'to top left':
					$otherPosition = 'top left';
					break;
				case 'to top right':
					$otherPosition = 'top right';
					break;
				case 'to bottom left':
					$otherPosition = 'bottom left';
					break;
				case 'to bottom right':
					$otherPosition = 'bottom right';
					break;
			}

			$result = '';
			if ( $type == 'linear-gradient' ) {
				$result .= "background-image: -moz-linear-gradient({$otherPosition}, {$beginColor}, {$endColor});";
				$result .= "background-image: -webkit-linear-gradient({$otherPosition}, {$beginColor}, {$endColor});";
				$result .= "background-image: -o-linear-gradient({$otherPosition}, {$beginColor}, {$endColor});";
				$result .= "filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='{$beginColor}', endColorstr='{$endColor}',GradientType=0);";
				$result .= "background-image: -ms-linear-gradient({$otherPosition}, {$beginColor}, {$endColor});";
				$result .= "background-image: linear-gradient({$position}, {$beginColor}, {$endColor});";
			} else {
				$result .= "background-image: -moz-radial-gradient({$otherPosition}, {$beginColor}, {$endColor});";
				$result .= "background-image: -webkit-radial-gradient({$otherPosition}, {$beginColor}, {$endColor});";
				$result .= "background-image: -o-radial-gradient({$otherPosition}, {$beginColor}, {$endColor});";
				$result .= "filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='{$beginColor}', endColorstr='{$endColor}',GradientType=1);";
				$result .= "background-image: -ms-radial-gradient({$otherPosition}, {$beginColor}, {$endColor});";
				$result .= "background-image: radial-gradient({$position}, {$beginColor}, {$endColor});";
			}
			$result .= "zoom: 1;";

			return $result;
		}

		function remove_slash( $text ) {
			return html_entity_decode( stripslashes( $text ), ENT_QUOTES, 'UTF-8' );
		}
	}
endif;