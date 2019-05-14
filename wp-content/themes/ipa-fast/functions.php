<?php

include_once 'inc/class-ipa-fast-theme.php';
include_once 'inc/class-ipa-fast-gutenberg.php';
include_once 'inc/constants.php';


if ( ! function_exists( 'ipa_fast_theme_setup' ) ) :
	function ipa_fast_theme_setup(){
		load_theme_textdomain( IPA_Fast_Theme::get_txt_domain(), get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary', IPA_Fast_Theme::get_txt_domain() ),
				'footer' => __( 'Footer Menu', IPA_Fast_Theme::get_txt_domain() ),
				'social' => __( 'Social Links Menu', IPA_Fast_Theme::get_txt_domain() ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', IPA_Fast_Theme::get_txt_domain() ),
					'shortName' => __( 'S', IPA_Fast_Theme::get_txt_domain() ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', IPA_Fast_Theme::get_txt_domain() ),
					'shortName' => __( 'M', IPA_Fast_Theme::get_txt_domain() ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', IPA_Fast_Theme::get_txt_domain() ),
					'shortName' => __( 'L', IPA_Fast_Theme::get_txt_domain() ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', IPA_Fast_Theme::get_txt_domain() ),
					'shortName' => __( 'XL', IPA_Fast_Theme::get_txt_domain() ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;

add_action( 'after_setup_theme', 'ipa_fast_theme_setup' );