<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Photosession_PostType_Admin_Notices' ) ):
	class IPA_Photosession_PostType_Admin_Notices {
		static function check_relation_plugin() {
			if ( ! is_plugin_active( 'ipa-post-meta/ipa-post-meta.php' ) ) {
				if ( current_user_can( 'install_plugins' ) ) {
					$class   = 'notice notice-error';
					$message = __( '<strong>Error!</strong> Plugin <strong>IPA Photosession Post Type</strong> required <strong>IPA Post Meta</strong> plugin for correct work!', IPA_Photosession_PostType()->plugin->get_text_domain() );

					printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
				}
			}
		}
	}
endif;