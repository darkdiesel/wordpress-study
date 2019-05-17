<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Logger' ) ):
	class ER_Calculator_Logger {
		static $log_file;

		public static function log($data) {
			if ( ! self::$log_file ) {
				self::$log_file = ER_CALCULATOR_PATH . '/log.txt';
			}

			$log_file = fopen( self::$log_file, "a+" );

			if ( $log_file ) {
				if (is_array($data)) {
					fwrite( $log_file,
						sprintf( "%s:\n%s\n", date( 'Y-m-d H:i:s' ), print_r($data, true) )
					);
				} else {
					fwrite( $log_file,
						sprintf( "%s:\n%s\n", date( 'Y-m-d H:i:s' ), $data )
					);
				}

				fclose( $log_file );
			}
		}
	}
endif;