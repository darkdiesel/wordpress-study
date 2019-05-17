<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Table_Calculators_List_Table' ) ):
	class ER_Calculator_Table_Calculators_List_Table extends WP_List_Table {

		var $results;

		static $plural = 'erc_calculators';
		static $singular = 'calculator';

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
				'is_active' => 'Active',
				'title' => 'Title',
				'partner_id' => 'Iframe ID',
				'partner_full_name' => 'Partner Full Name',
				'partner_account' => 'Partner Account',
				'partner_sub_account' => 'Partner Sub-Account',
				'partner_user_id' => 'Partner User ID',
				'introducer' => 'Introducer',
				'introducers_full_name' => 'Introducers Full Name',
				'introducers_email_address' => 'Introducers Email Address',
				'introducers_telephone_no' => 'Introducers Telephone No',
				'introducers_lead_source' => 'Introducers Lead Source',
				'standard' => 'Standard',
				'enhanced' => 'Enhanced',
				'interest_only' => 'Interest Only',
				'home_reversion' => 'Home Reversion',
				'text_area_one' => 'Text Area One',
				'text_area_two' => 'Text Area Two',
				'result_text_area_one' => 'Result Text Area One',
				'result_text_area_two' => 'Result Text Area Two',
			];

			return $columns;
		}

		function prepare_items() {
			$columns               = $this->get_columns();
			$hidden                = [];
			$sortable = $this->get_sortable_columns();
			$this->_column_headers = [ $columns, $hidden, $sortable ];

			$per_page     = $this->get_items_per_page( 'er_calculator_calculators_list_table_per_page', 10 );
			$current_page = $this->get_pagenum();

			$search = ( ! empty( $_REQUEST['s'] ) ) ?$_REQUEST['s'] : '';

			// If no sort, default to title
			$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'id';
			// If no order, default to asc
			$order = ( ! empty( $_GET['order'] ) ) ? $_GET['order'] : 'ASC';

			$this->process_bulk_action();

			$this->results = ER_Calculator_Model_Calculators::get_all_limit(
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
				'erc_calculator_delete'    => 'Delete'
			);
			return $actions;
		}

		function process_bulk_action() {
			if ( wp_verify_nonce( ( isset( $_REQUEST['_wpnonce'] ) ? $_REQUEST['_wpnonce'] : '' ), 'bulk-' . $this->_args['plural'] ) ) {
				if( 'erc_calculator_delete'===$this->current_action() && isset($_REQUEST['er_calculator'])) {
					$results = array('ok' => array(), 'fail' => array());

					foreach ($_REQUEST['er_calculator'] as $calculator){
						$result = ER_Calculator_Model_Calculators::delete( array( 'id' => $calculator ) );

						if ($result){
							$results['ok'][] = $calculator;

							ER_Calculator_Synchronisation::send_request('delete', 'calculator', array('id' => $calculator));
						} else {
							$results['fail'][] = $calculator;
						}
					}

					if (count($results['ok'])){
						ER_Calculator_Admin_Notices::add_notice(
							implode(', ', $results['ok']).__(' calculators are successfully deleted!', ER_Calculator()->plugin->get_text_domain()),
							ER_Calculator_Admin_Notices::UPDATED
						);
					}

					if (count($results['fail'])){
						ER_Calculator_Admin_Notices::add_notice(
							implode(', ', $results['ok']).__(' calculator are not deleted!', ER_Calculator()->plugin->get_text_domain()),
							ER_Calculator_Admin_Notices::ERROR
						);
					}
				}
			}
		}

		function column_cb( $item ) {
			return sprintf(
				'<input type="checkbox" name="er_calculator[]" value="%s" />', $item['id']
			);
		}

		function column_title( $item ) {
			$actions = array(
				'settings' => sprintf('<a href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$er_calculator_page,
								'action' => 'settings',
								'calculator_id' => $item['id']
							),
							admin_url( 'admin.php')
						)),
					__('Settings', ER_Calculator()->plugin->get_text_domain())
				),
				'edit' => sprintf('<a href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$er_calculator_page,
								'action' => 'edit',
								'calculator_id' => $item['id']
							),
							admin_url( 'admin.php')
						)),
					__('Edit', ER_Calculator()->plugin->get_text_domain())
					),
				'delete' => sprintf('<a href="%s">%s</a>',
					esc_url(
						add_query_arg(
							array(
								'page' => ER_Calculator_Admin_Menu::$er_calculator_page,
								'action' => 'delete',
								'calculator_id' => $item['id']
							),
							admin_url( 'admin.php?')
						)),
					__('Delete', ER_Calculator()->plugin->get_text_domain())
				)
			);

			return sprintf('%1$s %2$s', $item['title'], $this->row_actions($actions) );
		}


		function column_default( $item, $column_name ) {
			switch ( $column_name ) {
				case 'id':
					return $item[$column_name];
					break;
				case 'is_active':
				case 'standard':
				case 'enhanced':
				case 'interest_only':
				case 'home_reversion':
					return $item[$column_name] ? 'YES' : 'NO';
					break;
				case 'partner_id':
				case 'partner_full_name':
				case 'partner_account':
				case 'partner_sub_account':
				case 'partner_user_id':
				case 'introducer':
				case 'introducers_full_name':
				case 'introducers_email_address':
				case 'introducers_telephone_no':
				case 'introducers_lead_source':
				case 'text_area_one':
				case 'text_area_two':
				case 'result_text_area_one':
				case 'result_text_area_two':
					return apply_filters('the_content', $item[$column_name]);
					break;
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
				'id' => array('id', true)
			);
		}

		public function get_views() {
			$class = ( isset( $_REQUEST['erc_calculators_status'] ) && $_REQUEST['erc_calculators_status'] == '' ) || (!isset( $_REQUEST['erc_calculators_status'])) ? 'current' : '';

			$status_links = array(
				'All' => sprintf(
					"<a class='%s' href='%s'>%s</a>",
					$class,
					esc_url( add_query_arg( array( 'erc_calculators_status' => ''),admin_url( 'admin.php?' . $_SERVER['QUERY_STRING']))),
					__( 'All', ER_Calculator()->plugin->get_text_domain())
				)
			);

			return $status_links;
		}

		function no_items() {
			_e( 'No Calculators Found', ER_Calculator()->plugin->get_text_domain() );
		}

	}

endif;