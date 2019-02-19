<?php

/**
 * IPA_FAST WP Theme defined constants
 */

//$path = get_parent_theme_file_path();

if ( ! defined( 'IPA_FAST_THEME_PATH' ) ) {
	define( 'IPA_FAST_THEME_PATH', get_template_directory() );
}

if ( ! defined( 'IPA_FAST_THEME_URI' ) ) {
	define( 'IPA_FAST_THEME_URI', get_template_directory_uri() );
}