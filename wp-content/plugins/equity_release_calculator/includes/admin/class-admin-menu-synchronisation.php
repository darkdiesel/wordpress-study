<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Admin_Menu_Synchronisation' ) ):
    class ER_Calculator_Admin_Menu_Synchronisation {

	    public static function admin_page_output() {
		    //get saved settings

		    $settings = self::get_settings();

		    ER_Calculator()->functions->get_template(
			    'admin/synchronisation.php',
			    array(
				    'settings' => $settings
			    )
		    );
	    }

        public static function plugin_settings_ajax_save() {
            if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'erc_menu_sync_settings_wpnonce' ) ) {
                die( _( 'Permission check failed' ) );
            }

            //build setting array
            $settings = array();

            if ( isset( $_POST['form'] ) ) {
                foreach ( $_POST['form'] as $option ) {
                    if ( strpos( $option['name'], '[]' ) ) {
                        $settings[ substr( $option['name'], 0, strpos( $option['name'], '[]' ) ) ][] = $option['value'];
                    } else {
                        $settings[ $option['name'] ] = $option['value'];
                    }
                }
            }

            //save plugin settings
            update_option(ER_Calculator_Plugin::$sync_settings_option, wp_slash( json_encode( $settings ) ) );

            //create response
            $response = array();

            $response['ajax']    = 'success';
            $response['message'] = sprintf( '<strong>%s</strong>', __( 'Settings successfully saved!' ) );
            $response['fields']  = $settings;

            //return json
            echo json_encode( $response );

            die();
        }

	    public static function get_settings() {
		    return json_decode( stripslashes_deep( get_option( ER_Calculator_Plugin::$sync_settings_option ) ), true );

	    }

        public static function admin_menu_scripts(  ) {
            $plugin_data = ER_Calculator()->plugin->get_data();

            wp_deregister_script( 'erc-menu-sync-settings-script' );
            wp_register_script( 'erc-menu-sync-settings-script', ER_CALCULATOR_URL . '/assets/js/erc_admin_sync_settings.js', array( 'jquery' ), $plugin_data['Version'] );
            wp_enqueue_script( 'erc-menu-sync-settings-script' );

            //data_sync_settings
	        wp_deregister_style( 'erc-menu-sync-settings-style' );
	        wp_register_style( 'erc-menu-sync-settings-style', ER_CALCULATOR_URL . '/assets/css/erc_admin_sync_settings.css', array(), $plugin_data['Version'] );
	        wp_enqueue_style( 'erc-menu-sync-settings-style' );

            wp_localize_script(
                'erc-menu-sync-settings-script', 'erc_menu_sync_settings_vars',
                array(
                	'wpnonce_settings' => wp_create_nonce( 'erc_menu_sync_settings_wpnonce' ),
                	'wpnonce_sync' => wp_create_nonce( 'erc_menu_sync_data_wpnonce' ),
                )
            );
        }
    }
endif;

// class actions
add_action( "wp_ajax_erc_sync_settings_save", array(
	'ER_Calculator_Admin_Menu_Synchronisation',
	'plugin_settings_ajax_save'
) );