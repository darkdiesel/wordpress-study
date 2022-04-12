<?php
defined( 'ABSPATH' ) || exit;


class IPA_Fields_Pack_Table_Taxonomies_List_Table extends WP_List_Table {

	var $results;

	static $plural = 'taxonomies';
	static $singular = 'taxonomy';

	function __construct() {
		parent::__construct( array(
			'singular' => $this::$singular,
			'plural'   => $this::$plural,
			'ajax'     => false,
		) );
	}

	function get_columns() {
		$columns = array(
			'cb'       => '<input type="checkbox" />',
			'name'     => _( 'Name' ),
			'type'     => _( 'Type' ),
			//'name-singular' => 'Name Singular',
			//'name-plural'   => 'Name Plural',
			'taxonomy' => 'Taxonomy',
		);

		return $columns;
	}

	function prepare_items() {
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );

		$per_page     = $this->get_items_per_page( 'ipa_fields_pack_taxonomies_list_table_per_page', 10 );
		$current_page = $this->get_pagenum();

		$search = ( ! empty( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : '';

		// If no sort, default to title
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'slug';
		// If no order, default to asc
		$order = ( ! empty( $_GET['order'] ) ) ? $_GET['order'] : 'ASC';

		$this->process_bulk_action();

		$this->results = array(
			'total' => 0,
			'items' => array()
		);

		include_once IPA_FIELDS_PACK_PATH . 'includes/model/class-ipa-fields-pack-model-taxonomy.php';
		$custom_taxonomies  = IPA_Fields_Pack_Model_Taxonomy::get_all();
//		$builtin_taxonomies = IPA_Fields_Pack_Taxonomy::get_builtin();

		$data = array();

		if ( !empty($custom_taxonomies) ){
			global $wp_post_types;

			foreach( $custom_taxonomies as $slug => $taxonomy ) {
				$supports = array();

				if( isset( $taxonomy['supports'] ) ) {
					foreach( $taxonomy['supports'] as $post_type_slug => $value_one  ) {
						if( isset( $wp_post_types[$post_type_slug]->labels->name ) ) {
							$supports[$wp_post_types[$post_type_slug]->labels->name] = 1;
						} else {
							$supports[$post_type_slug] = 1;
						}
					}
				}

				$one = array(
					'description' => isset($taxonomy['description'])? wp_kses_post($taxonomy['description']):'',
					'supports' => $supports,
					'slug' => $taxonomy['slug'],
					'status' => (isset($taxonomy['disabled']) && $taxonomy['disabled'])? 'inactive':'active',
					'title' => isset($taxonomy['labels']['name']) ? wp_kses_post(stripslashes($taxonomy['labels']['name'])) : '',
					//WPCF_AUTHOR => isset($taxonomy[WPCF_AUTHOR])? $taxonomy[WPCF_AUTHOR]:0,
					'type' => IPA_Fields_Pack_Model_Taxonomy::TYPE_CUSTOM,
					'_builtin' => false,
				);
				$add_one = true;

				if ( $search ) {
					$add_one = false;
					foreach( array('description', 'slug', 'title' ) as $key ) {
						if ( $add_one || empty( $one[$key] ) ) {
							continue;
						}
						if ( is_numeric(strpos(mb_strtolower($one[$key]), $search))) {
							$add_one = true;
						}
					}
				}

				if ( $add_one ) {
					$data[$one['slug']] = $one;
				}
			}
		}

		// builtin taxonomies
//		foreach( $builtin_taxonomies as $taxonomy ) {
//			$pt = get_taxonomy($taxonomy);
//			$one = array(
//				'description' => __('This is built-in WordPress Taxonomy.', 'wpcf'),
//				'taxonomies' => isset($map_taxonomies_by_post_type[$taxonomy])? $map_taxonomies_by_post_type[$taxonomy]:array(),
//				'slug' => $taxonomy,
//				'status' => 'active',
//				'title' => $pt->labels->name,
//				'_builtin' => true,
//				'type' => IPA_Fields_Pack_Model_Taxonomy::TYPE_BUILTIN,
//				'supports' => array(),
//			);
//			$add_one = true;
//
//			if ( $search ) {
//				$add_one = false;
//				foreach( array('description', 'slug', 'title' ) as $key ) {
//					if ( $add_one || empty( $one[$key] ) ) {
//						continue;
//					}
//					if ( is_numeric(strpos(mb_strtolower($one[$key]), $search))) {
//						$add_one = true;
//					}
//				}
//			}
//
//			if ( $add_one ) {
//				// check if taxonomy is already stored in db
//				if ( isset( $data[$one['slug']]['supports'] ) ) {
//					$one['supports'] = $data[$one['slug']]['supports'];
//
//					// else use object_type for built_in taxonomies
//				} elseif ( isset($pt->object_type) ) {
//					foreach( $pt->object_type as $post_type ) {
//						$post_object = get_post_type_object( $post_type );
//
//						$post_type = is_object( $post_object ) && isset( $post_object->labels->name )
//							? $post_object->labels->name
//							: $post_type;
//
//						$one['supports'][$post_type] = 1;
//					}
//				}
//
//				// post types
//				$data[$one['slug']] = $one;
//			}
//		}

		$total_items = count($data);

		$data = array_slice($data,(($current_page-1)*$per_page),$per_page);

		$this->items = $data;

		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $per_page,
		) );
	}

	function get_bulk_actions() {
		$actions = array(
			'ipa_fields_pack_taxonomy_activate'   => 'Activate',
			'ipa_fields_pack_taxonomy_deactivate' => 'Deactivate',
			'ipa_fields_pack_taxonomy_delete'     => 'Delete',
		);

		return $actions;
	}

	function process_bulk_action() {
		if ( wp_verify_nonce( ( isset( $_REQUEST['_wpnonce'] ) ? $_REQUEST['_wpnonce'] : '' ), 'bulk-' . $this->_args['plural'] ) ) {
			if ( 'ipa_fields_pack_taxonomy_delete' === $this->current_action() && isset( $_REQUEST['ipa_field_pack_taxonomy'] ) ) {
				$results = array( 'ok' => array(), 'fail' => array() );

				foreach ( $_REQUEST['ipa_field_pack_taxonomy'] as $taxonomy ) {
					$result = ER_Calculator_Model_Ages::delete( array( 'slug' => $taxonomy ) );

					if ( $result ) {
						$results['ok'][] = $taxonomy;
					} else {
						$results['fail'][] = $taxonomy;
					}
				}

				if ( count( $results['ok'] ) ) {
					IPA_Fields_Pack_Admin_Notices::add_notice(
						implode( ', ', $results['ok'] ) . __( ' taxonomies are successfully deleted!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
						IPA_Fields_Pack_Admin_Notices::UPDATED
					);
				}

				if ( count( $results['fail'] ) ) {
					IPA_Fields_Pack_Admin_Notices::add_notice(
						implode( ', ', $results['ok'] ) . __( ' taxonomies are not deleted!', IPA_Fields_Pack()->plugin->get_txt_domain() ),
						IPA_Fields_Pack_Admin_Notices::ERROR
					);
				}
			}
		}
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="ipa_field_pack_taxonomy[]" value="%s" />', $item['title']
		);
	}

	function column_name( $item ) {
		$actions = array(
			'edit'   => sprintf( '<a href="%s">%s</a>',
				esc_url(
					add_query_arg(
						array(
							'page'     => IPA_Fields_Pack_Admin_Menus::$ipa_fields_pack_taxonomies_page,
							'action'   => 'edit',
							'taxonomy' => $item['slug']
						),
						admin_url( 'admin.php' )
					) ),
				__( 'Edit', IPA_Fields_Pack()->plugin->get_txt_domain() )
			),
			'delete' => sprintf( '<a href="%s">%s</a>',
				esc_url(
					add_query_arg(
						array(
							'page'     => IPA_Fields_Pack_Admin_Menus::$ipa_fields_pack_taxonomies_page,
							'action'   => 'delete',
							'taxonomy' => $item['slug']
						),
						admin_url( 'admin.php?' )
					) ),
				__( 'Delete', IPA_Fields_Pack()->plugin->get_txt_domain() )
			)
		);

		return sprintf( '%1$s %2$s', $item['title'], $this->row_actions( $actions ) );
	}

	function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'title':
			case 'type':
				return $item[ $column_name ];
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
		return array(//'slug' => array('slug', true)
		);
	}

	public function get_views() {
		$taxonomy_type = isset( $_REQUEST['taxonomy_type'] ) ? $_REQUEST['taxonomy_type'] : false;

		$status_links = array(
			'all'     => sprintf(
				"<a class='%s' href='%s'>%s</a>",
				( ! $taxonomy_type || $taxonomy_type == '' ) ? 'current' : '',
				esc_url( add_query_arg( array( 'taxonomy_type' => '' ), admin_url( 'admin.php?' . $_SERVER['QUERY_STRING'] ) ) ),
				__( 'All', IPA_Fields_Pack()->plugin->get_txt_domain() )
			),
			'custom'  => sprintf(
				"<a class='%s' href='%s'>%s</a>",
				( $taxonomy_type == 'custom' ) ? 'current' : '',
				esc_url( add_query_arg( array( 'taxonomy_type' => 'custom' ), admin_url( 'admin.php?' . $_SERVER['QUERY_STRING'] ) ) ),
				__( 'Custom', IPA_Fields_Pack()->plugin->get_txt_domain() )
			),
			'builtin' => sprintf(
				"<a class='%s' href='%s'>%s</a>",
				( $taxonomy_type == 'builtin' ) ? 'current' : '',
				esc_url( add_query_arg( array( 'taxonomy_type' => 'builtin' ), admin_url( 'admin.php?' . $_SERVER['QUERY_STRING'] ) ) ),
				__( 'Builtin', IPA_Fields_Pack()->plugin->get_txt_domain() )
			)
		);

		return $status_links;
	}

	function no_items() {
		_e( 'No Taxonomies Found', IPA_Fields_Pack()->plugin->get_txt_domain() );
	}

}