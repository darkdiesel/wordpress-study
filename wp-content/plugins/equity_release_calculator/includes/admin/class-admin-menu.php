<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Admin_Menu' ) ):
	class ER_Calculator_Admin_Menu {
		public static $er_calculator_page = 'erc_menu';
		public $er_calculator_page_hook = '';

		public static $ages_page = 'erc_age';
		public $ages_page_hook = '';

		public static $percentages_page = 'erc_percentage';
		public $percentages_page_hook = '';

		public static $percentages_hr_page = 'erc_percentage_hr';
		public $percentages_hr_page_hook = '';

		public static $calculators_page = 'erc_calculator';
		public $calculators_page_hook = '';

		public static $sync_page = 'erc_synchronisation';
		public $sync_page_hook = '';

		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
			add_action( 'admin_enqueue_scripts', array(
				$this,
				'admin_menu_settings_scripts'
			) );

			include_once( 'class-admin-menu-ages.php' );
			include_once( 'class-admin-menu-percentages.php' );
			include_once( 'class-admin-menu-percentages-hr.php' );
			include_once( 'class-admin-menu-calculators.php' );
			include_once( 'class-admin-menu-synchronisation.php' );

			add_filter('set-screen-option',  array( 'ER_Calculator_Admin_Menu_Ages', 'per_page_set_option' ), 10, 3);
			add_filter('set-screen-option',  array( 'ER_Calculator_Admin_Menu_Percentages', 'per_page_set_option' ), 10, 3);
			add_filter('set-screen-option',  array( 'ER_Calculator_Admin_Menu_Percentages_HR', 'per_page_set_option' ), 10, 3);
			add_filter('set-screen-option',  array( 'ER_Calculator_Admin_Menu_Calculators', 'per_page_set_option' ), 10, 3);
		}

		public function admin_menu() {
			$this->er_calculator_page_hook = add_menu_page(
				__( 'ER Calculator', ER_Calculator()->plugin->get_text_domain() ),
				__( 'ER Calculator', ER_Calculator()->plugin->get_text_domain() ),
				'manage_options',
				self::$er_calculator_page,
				NULL,
				ER_CALCULATOR_URL .  '/calculator.png',
				7
			);

			// admin calculators hr sub-page
			$this->calculators_page_hook = add_submenu_page(
				self::$er_calculator_page,
				__( 'Calculators', ER_Calculator()->plugin->get_text_domain() ),
				__( 'Calculators', ER_Calculator()->plugin->get_text_domain() ),
				'manage_options',
				self::$er_calculator_page,
				array( 'ER_Calculator_Admin_Menu_Calculators', 'calculators_page_output' )
			);

			// screen options for ages page
			add_action( "load-$this->calculators_page_hook", array( 'ER_Calculator_Admin_Menu_Calculators', 'add_screen_options' ) );

			// admin ages sub-page
			$this->ages_page_hook = add_submenu_page(
				self::$er_calculator_page,
				__( 'Ages', ER_Calculator()->plugin->get_text_domain() ),
				__( 'Ages', ER_Calculator()->plugin->get_text_domain() ),
				'manage_options',
				self::$ages_page,
				array( 'ER_Calculator_Admin_Menu_Ages', 'ages_page_output' )
			);

			// screen options for ages page
			add_action( "load-$this->ages_page_hook", array( 'ER_Calculator_Admin_Menu_Ages', 'add_screen_options' ) );

			// admin percentages sub-page
			$this->percentages_page_hook = add_submenu_page(
				self::$er_calculator_page,
				__( 'Percentage', ER_Calculator()->plugin->get_text_domain() ),
				__( 'Percentage', ER_Calculator()->plugin->get_text_domain() ),
				'manage_options',
				self::$percentages_page,
				array( 'ER_Calculator_Admin_Menu_Percentages', 'percentages_page_output' )
			);

			// screen options for ages page
			add_action( "load-$this->percentages_page_hook", array( 'ER_Calculator_Admin_Menu_Percentages', 'add_screen_options' ) );

			// admin percentages hr sub-page
			$this->percentages_hr_page_hook = add_submenu_page(
				self::$er_calculator_page,
				__( 'Percentage Home Reversion', ER_Calculator()->plugin->get_text_domain() ),
				__( 'Percentage Home Reversion', ER_Calculator()->plugin->get_text_domain() ),
				'manage_options',
				self::$percentages_hr_page,
				array( 'ER_Calculator_Admin_Menu_Percentages_HR', 'percentages_hr_page_output' )
			);

			// screen options for ages page
			add_action( "load-$this->percentages_hr_page_hook", array( 'ER_Calculator_Admin_Menu_Percentages_HR', 'add_screen_options' ) );

			$this->sync_page_hook = add_submenu_page(
				self::$er_calculator_page,
				__( 'Synchronisation', ER_Calculator()->plugin->get_text_domain() ),
				__( 'Synchronisation', ER_Calculator()->plugin->get_text_domain() ),
				'manage_options',
				self::$sync_page,
				array( 'ER_Calculator_Admin_Menu_Synchronisation', 'admin_page_output' )
			);

			add_action('admin_print_styles-' . $this->sync_page_hook, array('ER_Calculator_Admin_Menu_Synchronisation','admin_menu_scripts'));
		}

		public function admin_menu_settings_scripts( $hook ) {

			if ( $this->er_calculator_page_hook != $hook ) {
				return;
			}

//			$plugin_data = ER_Calculator()->plugin->get_data();

//			wp_register_style( 'er-calculator-admin-style', ER_CALCULATOR_URL . '/assets/css/admin.css', false, $plugin_data['Version'] );
//			wp_enqueue_style( 'er-calculator-admin-style' );

			add_action('admin_print_styles-' . $this->er_calculator_page_hook, array('ER_Calculator_Admin_Menu_Calculators', 'admin_menu_calculators_styles'));
			//add_action('admin_print_styles-' . $this->ages_page_hook, array('ER_Calculator_Admin_Menu_Ages', 'admin_menu_ages_styles'));
			//add_action('admin_print_styles-' . $this->percentages_page_hook, array('ER_Calculator_Admin_Menu_Percentages', 'admin_menu_percentages_styles'));
			//add_action('admin_print_styles-' . $this->percentages_hr_page_hook, array('ER_Calculator_Admin_Menu_Percentages_HR', 'admin_menu_percentages_hr_styles'));

//			if ($this->ages_edit_page_hook){
//				add_action('admin_print_styles-' . $this->ages_edit_page_hook, array('ER_Calculator_Admin_Menu_Ages', 'admin_menu_ages_styles'));
//			}
		}
	}
endif;

return new ER_Calculator_Admin_Menu();