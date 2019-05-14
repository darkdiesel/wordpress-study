<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Fast_Gutenberg' ) ) :
	class IPA_Fast_Gutenberg {

		static function organic_profile_block() {
			// Scripts.
			wp_register_script(
				'organic-profile-block-script', // Handle.
				get_theme_file_uri( '/assets/js/block.js' ),
				array(
					'wp-blocks',
					'wp-components',
					'wp-element',
					'wp-i18n',
					'wp-editor'
				), // Dependencies, defined above.
				filemtime( get_theme_file_path( '/assets/js/block.js' ) ),
				true // Load script in footer.
			);
			// Styles.
			wp_register_style(
				'organic-profile-block-editor-style', // Handle.
				get_theme_file_uri( '/assets/css/editor.css' ),
				array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
				filemtime( get_theme_file_path( '/assets/css/editor.css' ) )
			);
			wp_register_style(
				'organic-profile-block-frontend-style', // Handle.
				get_theme_file_uri( '/assets/css/style.css' ),
				array(), // Dependency to include the CSS after it.
				filemtime( get_theme_file_path( '/assets/css/style.css' ) )
			);

			// Register the block with WP using our namespacing
			// We also specify the scripts and styles to be used in the Gutenberg interface
			register_block_type( 'profile/block', array(
				'editor_script' => 'organic-profile-block-script',
				'editor_style' => 'organic-profile-block-editor-style',
				'style' => 'organic-profile-block-frontend-style',
			) );
		}

		static function test_block() {
			wp_register_script(
				'ipa-fast-gutenberg-test-block', // Handle.
				get_theme_file_uri( '/assets/js/test.js' ),
				array(
					'wp-blocks',
					'wp-element',
				), // Dependencies, defined above.
				filemtime( get_theme_file_path( '/assets/js/test.js' ) ),
				true // Load script in footer.
			);

			register_block_type( 'ipa/test-block-01', array(
				'editor_script' => 'ipa-fast-gutenberg-test-block',
			) );
		}

	}

	add_action( 'init', array( 'IPA_Fast_Gutenberg', 'organic_profile_block' ) );
	add_action( 'init', array( 'IPA_Fast_Gutenberg', 'test_block' ) );

endif;