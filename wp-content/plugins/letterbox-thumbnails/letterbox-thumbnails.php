<?php
/*
  Plugin Name: Letterbox Thumbnails
  Description: Letterbox Thumbnails
  Version: 2.0
  Author: Igor Peshkov
  Author URI: https://www.facebook.com/igor.peshkov.27.07.1988
  Text Domain: letterbox-thumbnails

  Copyright 2013, 2019  Igor Peshkov (email: igor.peshkov@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

defined( 'ABSPATH' ) || exit;

// Define WC_PLUGIN_FILE.
if ( ! defined( 'LETTERBOX_THUMBNAILS_PLUGIN_FILE' ) ) {
	define( 'LETTERBOX_THUMBNAILS_PLUGIN_FILE', __FILE__ );
}

if ( ! class_exists( 'LetterboxThumbnails' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-letterbox-thumbnails.php';
}

/**
 * Returns the main instance of LetterboxThumbnails to prevent the need to use globals.
 *
 * @since  2.0.0
 * @return LetterboxThumbnails
 */
function LetterboxThumbnails() {
	return LetterboxThumbnails::instance();
}

// Global for backwards compatibility.
$GLOBALS['letterbox-thumbnails'] = LetterboxThumbnails();