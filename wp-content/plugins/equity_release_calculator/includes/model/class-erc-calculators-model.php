<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Model_Calculators' ) ):
	class ER_Calculator_Model_Calculators {
		const NAME_TABLE = "erc_calculator";

		public static $primary_key = 'id';

		public static $lead_sources
			= array(
				'Calculator'                 => 'Calculator',
				'Contact Page'               => 'Contact Page',
				'Registration Form'          => 'Registration Form',
				'Newsletter Subscription'    => 'Newsletter Subscription',
				'Plug &amp; Play'            => 'Plug &amp; Play',
				'Compare Deals'              => 'Compare Deals',
				'Marketing Pack'             => 'Marketing Pack',
				'Registration Page'          => 'Registration Page',
				'News Page - Ask A Question' => 'News Page - Ask A Question'
			);

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
				'orderby' => 'id',
				'order' => 'ASC',
				'search' => '',
			);

			$args = array_merge($defaults, $args);

			$search_sql = '';

			if ($args['search']){
				$search_sql = sprintf("WHERE %s LIKE '%%%%%s%%%%'", self::$primary_key, $args['search']);
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
				$search_sql = sprintf("WHERE %s LIKE '%%%%%s%%%%'", self::$primary_key, $args['search']);
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

		/**
		 * Return list of lead sources
		 *
		 * @return array
		 */
		public static function get_lead_sources(){
			return self::$lead_sources;
		}
	}
endif;