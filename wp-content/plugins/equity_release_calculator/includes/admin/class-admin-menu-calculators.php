<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Admin_Menu_Calculators' ) ):
	class ER_Calculator_Admin_Menu_Calculators {
		public static function calculators_page_output() {
			global $erc_calculators_list_table;

			// include model
			include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-calculators-model.php' );

			$lead_sources = ER_Calculator_Model_Calculators::get_lead_sources();

			if (isset($_REQUEST['action'])){
				if (in_array($_REQUEST['action'], array('edit', 'delete'))){
					if ( isset( $_REQUEST['calculator_id'] ) ) {
						$erc_calculator = ER_Calculator_Model_Calculators::get( esc_attr( $_REQUEST['calculator_id'] ) );
					} else {
						$erc_calculator = array();
					}

					if ( ! $erc_calculator ) {
						ER_Calculator_Admin_Notices::add_notice(
							__( 'Percentage Home Reversion not founded!', ER_Calculator()->plugin->get_text_domain() ),
							ER_Calculator_Admin_Notices::ERROR
						);
					}
				}else if(in_array($_REQUEST['action'], array('settings'))){
					$calcId = esc_attr( $_REQUEST['calculator_id'] );
				}
			}

			ER_Calculator()->functions->get_template(
				'admin/calculators.php',
				array(
					'erc_calculators_list_table' => $erc_calculators_list_table,
					'erc_calculator' => isset( $erc_calculator ) ? $erc_calculator : array(),
					'lead_sources' => isset( $lead_sources ) ? $lead_sources : array(),
					'calcId' => isset( $calcId ) ? $calcId : FALSE
				)
			);
		}

		static function add_screen_options(){
			if( ! class_exists( 'WP_List_Table' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
			}

			include_once( ER_CALCULATOR_PATH . '/includes/table/class-erc-calculators-table.php' );

			global $erc_calculators_list_table;

			add_screen_option( 'per_page', array(
				'label'   => 'show on page',
				'default' => 10,
				'option'  => 'er_calculator_calculators_list_table_per_page',
			) );

			$erc_calculators_list_table = new ER_Calculator_Table_Calculators_List_Table();
		}

		public static function per_page_set_option($status, $option, $value) {
			if ( 'er_calculator_calculators_list_table_per_page' == $option ) return $value;

			return $status;
		}

		public static function plugin_calculators_ajax_save() {
			if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'er_calculator_menu_calculators_wpnonce' ) ) {
				die( _( 'Permission check failed' ) );
			}

			//build setting array
			$ages = array();

			if ( isset( $_POST['form'] ) ) {
				foreach ( $_POST['form'] as $option ) {
					if ( strpos( $option['name'], '[]' ) ) {
						$ages[ substr( $option['name'], 0, strlen( $option['name'] ) - strpos( $option['name'], '[]' ) - 1 ) ][] = $option['value'];
					} else {
						$ages[ $option['name'] ] = $option['value'];
					}
				}
			}

			//save plugin ages
			//update_option( ER_Calculator()->plugin->plugin_ages_option, wp_slash( json_encode( $ages ) ) );

			//create response
			$response = array();

			$response['ajax']    = 'success';
			$response['message'] = sprintf( '<strong>%s</strong>', __( 'Settings successfully saved!', ER_Calculator()->plugin->get_text_domain() ) );
			$response['fields']  = $ages;

			//return json
			echo json_encode( $response );

			die();
		}

		public static function admin_menu_calculators_styles() {
			$plugin_data = ER_Calculator()->plugin->get_data();

			wp_enqueue_script('wp-color-picker');
			wp_enqueue_style( 'wp-color-picker' );

			wp_register_style('bootstrap-admin.css', ER_CALCULATOR_URL . 'assets/css/bootstrap-admin.css');
			wp_enqueue_style('bootstrap-admin.css');

			wp_register_script('bootstrap.js', ER_CALCULATOR_URL . 'assets/js/bootstrap.js', array( 'jquery' ), $plugin_data['Version'] );
			wp_enqueue_script('bootstrap.js');

			wp_register_style('jquery-ui-1.10.4.custom.min.css', ER_CALCULATOR_URL . 'assets/css/ui-lightness/jquery-ui-1.10.4.custom.min.css');
			wp_enqueue_style('jquery-ui-1.10.4.custom.min.css');

			wp_register_script('erc_admin.js', ER_CALCULATOR_URL . 'assets/js/erc_admin.js', array( 'jquery' ), $plugin_data['Version'] );
			wp_enqueue_script('erc_admin.js');

//			wp_localize_script(
//				'er-calculator-menu-preferences-script', 'er_calculator_menu_preferences_vars', array( 'wpnonce' => wp_create_nonce( 'er_calculator_menu_preferences_wpnonce' ) )
//			);
		}

		/**
		 * @param $optionName
		 * _size_width
		 * _size_height
		 */
		static function size_options_tpl ($optionName)
		{
			ER_Calculator()->functions->get_template(
				'admin/form/calculator_settings_size_options.php',
				array(
					'optionName' => $optionName,
				)
			);
		}

		/**
		 * @param $optionName
		 * @param bool $textDecoration
		 * Generate
		 *             _font_family
		 * $optionName _font_size
		 * $optionName _font_style
		 * $optionName _font_weight
		 * $optionName _text_transform
		 * $optionName _text_color
		 */
		static function text_options_tpl ($optionName, $textDecoration = false)
		{
			ER_Calculator()->functions->get_template(
				'admin/form/calculator_settings_text_options.php',
				array(
					'optionName' => $optionName,
					'textDecoration' => $textDecoration
				)
			);
		}

		/**
		 * @param      $optionName
		 * @param bool $paddings
		 * @param bool $align
		 *
		 * $optionName _text_align
		 * $optionName _padding_top
		 * $optionName _padding_bottom
		 * $optionName _padding_left
		 * $optionName _padding_right

		 */
		static function text_container_options_tpl ($optionName, $paddings = true, $align = true)
		{
			ER_Calculator()->functions->get_template(
				'admin/form/calculator_settings_text_container_options.php',
				array(
					'optionName' => $optionName,
					'paddings' => $paddings,
					'align' => $align
				)
			);
		}

		/**
		 * @param $optionName
		 * @param bool $radius
		 * $optionName _border_color
		 * $optionName _border_width
		 *             _border_style
		 */
		static function border_options_tpl ($optionName, $radius = false)
		{
			ER_Calculator()->functions->get_template(
				'admin/form/calculator_settings_border_options.php',
				array(
					'optionName' => $optionName,
					'radius' => $radius
				)
			);
		}

		/**
		 * @param $optionName
		 *
		 * $optionName _margin_tb
		 * $optionName _margin_lr
		 */
		static function short_margin_options_tpl( $optionName )
		{
			ER_Calculator()->functions->get_template(
				'admin/form/calculator_settings_border_options.php',
				array(
					'optionName' => $optionName
				)
			);
		}

		/**
		 * @param $optionName
		 *
		 * _gradient_type
		 * _gradient_liner_position
		 * _gradient_radial_position
		 */
		static function gradient_types_options_tpl ($optionName)
		{
			ER_Calculator()->functions->get_template(
				'admin/form/calculator_settings_gradient_type_options.php',
				array(
					'optionName' => $optionName
				)
			);
		}

		/**
		 * @param $optionName
		 *
		 * _gradient_begin_color
		 */
		static function gradient_begin_color_options_tpl ($optionName)
		{
			ER_Calculator()->functions->get_template(
				'admin/form/calculator_settings_gradient_begin_color_options.php',
				array(
					'optionName' => $optionName
				)
			);
		}

		/**
		 * @param $optionName
		 *
		 * _gradient_end_color
		 */
		function gradient_end_color_options_tpl ($optionName)
		{
			ER_Calculator()->functions->get_template(
				'admin/form/calculator_settings_gradient_end_color_options.php',
				array(
					'optionName' => $optionName
				)
			);
		}
	}
endif;

// class actions
//add_action( "wp_ajax_er_calculator_calculators_save", array(
//	'ER_Calculator_Admin_Menu_Calculators',
//	'plugin_calculators_ajax_save'
//) );