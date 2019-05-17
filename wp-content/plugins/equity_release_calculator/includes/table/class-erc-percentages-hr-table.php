<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Table_Percentages_HR_List_Table' ) ):
	class ER_Calculator_Table_Percentages_HR_List_Table extends WP_List_Table {

		var $results;

		static $plural = 'erc_percentages_hr';
		static $singular = 'percentage_hr';

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
				'male' => 'Male %',
				'female' => 'Female %',
				'joint' => 'Joint %',
			];

			return $columns;
		}

		function prepare_items() {
			$columns               = $this->get_columns();
			$hidden                = [];
			$sortable = $this->get_sortable_columns();
			$this->_column_headers = [ $columns, $hidden, $sortable ];

			$per_page     = $this->get_items_per_page( 'er_calculator_percentages_hr_list_table_per_page', 10 );
			$current_page = $this->get_pagenum();

			$search = ( ! empty( $_REQUEST['s'] ) ) ?$_REQUEST['s'] : '';

			// If no sort, default to title
			$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'age';
			// If no order, default to asc
			$order = ( ! empty( $_GET['order'] ) ) ? $_GET['order'] : 'ASC';

			$this->process_bulk_action();

			$this->results = ER_Calculator_Model_Percentages_HR::get_all_limit(
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
				'erc_percentage_hr_delete'    => 'Delete'
			);
			return $actions;
		}

		function process_bulk_action() {
			if ( wp_verify_nonce( ( isset( $_REQUEST['_wpnonce'] ) ? $_REQUEST['_wpnonce'] : '' ), 'bulk-' . $this->_args['plural'] ) ) {
				if( 'erc_percentage_hr_delete'===$this->current_action() && isset($_REQUEST['er_percentage_hr'])) {
					$results = array('ok' => array(), 'fail' => array());

					foreach ($_REQUEST['er_percentage_hr'] as $percentage_hr){
						$result = ER_Calculator_Model_Percentages_HR::delete( array( 'id' => $percentage_hr ) );

						if ($result){
							$results['ok'][] = $percentage_hr;

							ER_Calculator_Synchronisation::send_request('delete', 'percentage_hr', array('id' => $percentage_hr));
						} else {
							$results['fail'][] = $percentage_hr;
						}
					}

					if (count($results['ok'])){
						ER_Calculator_Admin_Notices::add_notice(
							implode(', ', $results['ok']).__(' home reversions are successfully deleted!', ER_Calculator()->plugin->get_text_domain()),
							ER_Calculator_Admin_Notices::UPDATED
						);
					}

					if (count($results['fail'])){
						ER_Calculator_Admin_Notices::add_notice(
							implode(', ', $results['ok']).__(' home reversion are not deleted!', ER_Calculator()->plugin->get_text_domain()),
							ER_Calculator_Admin_Notices::ERROR
						);
					}
				}
			}
		}

		function column_cb( $item ) {
			return sprintf(
				'<input type="checkbox" name="er_percentage_hr[]" value="%s" />', $item['id']
			);
		}

		function column_id( $item ) {
			$actions = array(
				'edit' => sprintf('<a href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$percentages_hr_page,
								'action' => 'edit',
								'percentage_hr_id' => $item['id']
							),
							admin_url( 'admin.php')
						)),
					__('Edit', ER_Calculator()->plugin->get_text_domain())
					),
				'delete' => sprintf('<a href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$percentages_hr_page,
								'action' => 'delete',
								'percentage_hr_id' => $item['id']
							),
							admin_url( 'admin.php?')
						)),
					__('Delete', ER_Calculator()->plugin->get_text_domain())
				)
			);

			return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions) );
		}

		function column_default( $item, $column_name ) {
			switch ( $column_name ) {
				case 'age':
				case 'male':
				case 'female':
				case 'joint':
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
//		protected function get_sortable_columns() {
//			return array(
//				'age' => array('age', true)
//			);
//		}

		public function get_views() {
			$class = ( isset( $_REQUEST['erc_percentages_hr_status'] ) && $_REQUEST['erc_percentages_hr_status'] == '' ) || (!isset( $_REQUEST['erc_percentages_hr_status'])) ? 'current' : '';

			$status_links = array(
				'All' => sprintf(
					"<a class='%s' href='%s'>%s</a>",
					$class,
					esc_url( add_query_arg( array( 'erc_percentages_hr_status' => ''),admin_url( 'admin.php?' . $_SERVER['QUERY_STRING']))),
					__( 'All', ER_Calculator()->plugin->get_text_domain())
				)
			);

			return $status_links;
		}

		function no_items() {
			_e( 'No Percentages Home Reversion Found', ER_Calculator()->plugin->get_text_domain() );
		}

	}

endif;