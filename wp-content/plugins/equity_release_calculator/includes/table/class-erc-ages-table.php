<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Table_Ages_List_Table' ) ):
	class ER_Calculator_Table_Ages_List_Table extends WP_List_Table {

		var $results;

		static $plural = 'erc_ages';
		static $singular = 'age';

		function __construct() {
			parent::__construct( array(
				'singular' => $this::$singular,
				'plural'   => $this::$plural,
				'ajax'     => false,
			) );
		}

		function get_columns() {
			$columns = [
				'cb'  => '<input type="checkbox" />',
				'id'  => 'ID',
				'age' => 'Age',

			];

			return $columns;
		}

		function prepare_items() {
			$columns               = $this->get_columns();
			$hidden                = [];
			$sortable = $this->get_sortable_columns();
			$this->_column_headers = [ $columns, $hidden, $sortable ];

			$per_page     = $this->get_items_per_page( 'er_calculator_ages_list_table_per_page', 10 );
			$current_page = $this->get_pagenum();

			$search = ( ! empty( $_REQUEST['s'] ) ) ?$_REQUEST['s'] : '';

			// If no sort, default to title
			$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'age';
			// If no order, default to asc
			$order = ( ! empty( $_GET['order'] ) ) ? $_GET['order'] : 'ASC';

			$this->process_bulk_action();

			$this->results = ER_Calculator_Model_Ages::get_all_limit(
				array(
					'page'    => $current_page,
					'perpage' => $per_page,
					'search'  => $search,
					'orderby' => $orderby,
					'order'   => $order
				)
			);

			$total_items = $this->results['total'];

			$this->items = $this->results['items'];

			$this->set_pagination_args( [
				'total_items' => $total_items,
				'per_page'    => $per_page,
			] );
		}

		function get_bulk_actions() {
			$actions = array(
				'erc_age_delete'    => 'Delete'
			);
			return $actions;
		}

		function process_bulk_action() {
			if ( wp_verify_nonce( ( isset( $_REQUEST['_wpnonce'] ) ? $_REQUEST['_wpnonce'] : '' ), 'bulk-' . $this->_args['plural'] ) ) {
				if( 'erc_age_delete'===$this->current_action() && isset($_REQUEST['er_age'])) {
					$results = array('ok' => array(), 'fail' => array());

					foreach ($_REQUEST['er_age'] as $age){
						$result = ER_Calculator_Model_Ages::delete( array( 'id' => $age ) );

						if ($result){
							$results['ok'][] = $age;

							ER_Calculator_Synchronisation::send_request('delete', 'age', array('id' => $age));
						} else {
							$results['fail'][] = $age;
						}
					}

					if (count($results['ok'])){
						ER_Calculator_Admin_Notices::add_notice(
							implode(', ', $results['ok']).__(' ages are successfully deleted!', ER_Calculator()->plugin->get_text_domain()),
							ER_Calculator_Admin_Notices::UPDATED
						);
					}

					if (count($results['fail'])){
						ER_Calculator_Admin_Notices::add_notice(
							implode(', ', $results['ok']).__(' ages are not deleted!', ER_Calculator()->plugin->get_text_domain()),
							ER_Calculator_Admin_Notices::ERROR
						);
					}
				}
			}
		}

		function column_cb( $item ) {
			return sprintf(
				'<input type="checkbox" name="er_age[]" value="%s" />', $item['id']
			);
		}

		function column_age( $item ) {
			$actions = array(
				'edit' => sprintf('<a href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$ages_page,
								'action' => 'edit',
								'age_id' => $item['id']
							),
							admin_url( 'admin.php')
						)),
					__('Edit', ER_Calculator()->plugin->get_text_domain())
				),
				'delete' => sprintf('<a href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$ages_page,
								'action' => 'delete',
								'age_id' => $item['id']
							),
							admin_url( 'admin.php?')
						)),
					__('Delete', ER_Calculator()->plugin->get_text_domain())
				)
			);

			return sprintf('%1$s %2$s', $item['age'], $this->row_actions($actions) );
		}

		function column_default( $item, $column_name ) {
			switch ( $column_name ) {
				case 'id':
					return $item[$column_name];
				default:
					return print_r( $item, true ); //Show the whole array for troubleshooting purposes
			}
		}

		/**
		 * Get a list of sortable columns.
		 *
		 * @return array
		 */
		protected function get_sortable_columns() {
			return array(
				'age' => array('age', true)
			);
		}

		public function get_views() {
			$class = ( isset( $_REQUEST['erc_ages_status'] ) && $_REQUEST['erc_ages_status'] == '' ) || (!isset( $_REQUEST['erc_ages_status'])) ? 'current' : '';

			$status_links = array(
				'All' => sprintf(
					"<a class='%s' href='%s'>%s</a>",
					$class,
					esc_url( add_query_arg( array( 'erc_ages_status' => ''),admin_url( 'admin.php?' . $_SERVER['QUERY_STRING']))),
					__( 'All', ER_Calculator()->plugin->get_text_domain())
				)
			);

			return $status_links;
		}

		function no_items() {
			_e( 'No Ages Found', ER_Calculator()->plugin->get_text_domain() );
		}

	}

endif;