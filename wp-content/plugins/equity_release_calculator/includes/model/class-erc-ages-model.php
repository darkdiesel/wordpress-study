<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Model_Ages' ) ):
	class ER_Calculator_Model_Ages {
		const NAME_TABLE = "erc_age";

		public static $primary_key = 'id';
		public static $age_key ='age';


		public static function getTableName() {
			global $wpdb;

			return $wpdb->prefix . self::NAME_TABLE;
		}

		static function get( $value ){
			global $wpdb;

			$sql = sprintf( 'SELECT * FROM %s WHERE %s = %%s', self::getTableName(), static::$primary_key );

			$sql = $wpdb->prepare( $sql, $value );

			return $wpdb->get_row( $sql, ARRAY_A );
		}

		static function insert( $data ) {
			global $wpdb;

			return $wpdb->insert( self::getTableName(), $data );
		}

		static function update( $data, $where ) {
			global $wpdb;

			return $wpdb->update( self::getTableName(), $data, $where );
		}

		static function delete( $where ) {
			global $wpdb;

			return $wpdb->delete(self::getTableName(), $where);
		}

		static function delete_all() {
			global $wpdb;

			$sql = sprintf(
				'DELETE * FROM %s WHERE 1 = 1',
				self::getTableName()
			);

			return $wpdb->query($sql);
		}

		static function insert_id() {
			global $wpdb;

			return $wpdb->insert_id;
		}

		public static function get_all($args = array()) {
			global $wpdb;

			// prepare query params
			$defaults = array(
				'orderby' => 'age',
				'order' => 'ASC',
				'search' => '',
			);

			$args = array_merge($defaults, $args);

			$search_sql = '';

			if ($args['search']){
				$search_sql = sprintf("WHERE %s LIKE '%%%%%s%%%%'", self::$age_key, $args['search']);
			}

			// get items from db
			$sql = sprintf(
				'SELECT * FROM %s %s ORDER BY %s %s',
				self::getTableName(),
				$search_sql,
				$args['orderby'],
				$args['order']
			);

			return $wpdb->get_results( $sql, ARRAY_A );
		}

		public static function get_all_limit($args = array()) {
			global $wpdb;

			// prepare query params
			$defaults = array(
				'orderby' => 'age',
				'order' => 'ASC',
				'search' => '',
				'page' => '1',
				'perpage' => 10
			);

			$args = array_merge($defaults, $args);

			$args['page'] =  ($args['page'] - 1) * $args['perpage'];

			$search_sql = '';

			if ($args['search']){
				$search_sql = sprintf("WHERE %s LIKE '%%%%%s%%%%'", self::$age_key, $args['search']);
			}

			// get items from db
			$sql = sprintf(
				'SELECT * FROM %s %s ORDER BY %s %s LIMIT %%d, %%d',
				self::getTableName(),
				$search_sql,
				$args['orderby'],
				$args['order']
			);

			$sql = $wpdb->prepare(
				$sql,
				array(
					$args['page'],
					$args['perpage']
				)
			);

			$results = $wpdb->get_results( $sql, ARRAY_A );

			// count total items
			$sql = sprintf(
				'SELECT COUNT(*) FROM %s %s',
				self::getTableName(),
				$search_sql

			);

			$total = $wpdb->get_var($sql);

			// return result
			return array(
				'items' => $results,
				'total' => $total
			);
		}
	}
endif;