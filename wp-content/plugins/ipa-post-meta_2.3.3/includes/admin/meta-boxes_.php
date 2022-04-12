<?php

require_once( 'print-meta-boxes.php' );

class IPA_AdminMetaBoxes{
	static function getMetaBoxes(){
		return array(
			array(
				'meta_box_name' => IPA_ER_SUPERMARKET_POST_META_BOXES,
				'label' => __('Right Sidebar Widget:', THEME_TEXT_DOMAIN),
				'description' => __( 'If any sidebar selected it displayed at the right, if not - page displayed to 100% width', THEME_TEXT_DOMAIN ),
				'name'    => 'right-sidebar',
				'type'    => 'select',
				'data_type'   => 'json',
				'options' => IPA_Framework::getSidebarWidgetsList(true, '-- Select Right Sidebar')
			),
			array(
				'meta_box_name' => IPA_ER_SUPERMARKET_POST_META_BOXES,
				'label' => __('Right Sidebar Width:', THEME_TEXT_DOMAIN),
				'description' => __( 'Page 100% width = 12 points.', THEME_TEXT_DOMAIN ),
				'name'    => 'right-sidebar-width',
				'type'    => 'select',
				'data_type'   => 'json',
				'options' => array(
					'1' => '1/12',
					'2' => '2/12',
					'3' => '3/12',
					'4' => '4/12',
					'5' => '5/12',
					'6' => '6/12',
					'7' => '7/12',
					'8' => '8/12',
					'9' => '9/12',
					'10' => '10/12',
					'11' => '11/12',
					'12' => '12/12',
				)
			),
			array(
				'type' => 'hr'
			),
			array(
				'meta_box_name' => IPA_ER_SUPERMARKET_POST_META_BOXES,
				'label'       => __( 'Additional TOP HTML :', THEME_TEXT_DOMAIN ),
				'name'        => 'top-html',
				'type'        => 'wp_editor',
				'data_type'   => 'json',
				'description' => _( 'This HTML (text) appears under header and above main content.' )
			),
			array(
				'type' => 'hr'
			),
			array(
				'meta_box_name' => IPA_ER_SUPERMARKET_POST_META_BOXES,
				'label'       => __( 'Additional BOTTOM HTML:', THEME_TEXT_DOMAIN),
				'name'        => 'bottom-html',
				'type'        => 'wp_editor',
				'data_type'   => 'json',
				'description' => _( 'This HTML (text) appears under main content and above footer.' )
			)
//			array(
//				'meta_box_name' => IPA_ER_SUPERMARKET_POST_META_BOXES,
//				'label'   => __( 'Page Header Type:', THEME_TEXT_DOMAIN ),
//				'name'    => 'header-type',
//				'type'    => 'select',
//				'data_type'   => 'json',
//				'options' => array(
//					'' => '-- Select Header Type or leave default',
//					'header-type-google-map' => __( 'Google Map', THEME_TEXT_DOMAIN ),
//				)
//			)
		);
	}

	function add_page_meta_boxes() {
		add_meta_box( 'page-settings', __( 'Page settings', THEME_TEXT_DOMAIN ), 'IPA_AdminMetaBoxes::add_page_meta_boxes_output', 'page', 'normal', 'default' );
	}

	function add_page_meta_boxes_output() {
		?>
		<div class="post-option-meta" id="post-option-meta">
			<?php
			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'ipa_noxline_admin_meta_box', 'ipa_noxline_admin_meta_box_nonce' );

			foreach ( self::getMetaBoxes() as $meta_box ) {
				IPA_PrintMetaBoxes::print_meta( $meta_box );
			}
			?>
		</div>
	<?php
	}

	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	function save_meta_boxes( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['ipa_noxline_admin_meta_box_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['ipa_noxline_admin_meta_box_nonce'], 'ipa_noxline_admin_meta_box' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}


		// Check the user's permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

//		if ( isset( $_POST['post_type'] ) && ( ( $_POST['post_type'] == 'page' ) || ( $_POST['post_type'] == 'post' ) ) ) {
			foreach ( self::getMetaBoxes() as $meta_box ) {
				self::save_meta_box( $post_id, $meta_box );
			}
//		}
	}


}

// add custom fields to filling stations post type
add_action( 'add_meta_boxes', 'IPA_AdminMetaBoxes::add_page_meta_boxes' );

// save custom fields
add_action( 'save_post', 'IPA_AdminMetaBoxes::save_meta_boxes' );

//$common_meta_boxes = array(
//	array(
//		'name'    => 'ipa-page-option-right-sidebar',
//		'label'       => __( 'Right Sidebar Widget:' ),
//		'description' => _( 'If any sidebar selected it displayed at the right, if not - page displayed to 100% width' ),
//		'type' => 'select',
//		'options'     => array(
//			''                   => '',
//			'page-sidebar-right' => __( 'Page Right Sidebar' ),
//			'blog-sidebar-right' => __( 'Blog Right Sidebar' ),
//		)
//	),
//	array(
//		'type' => 'hr'
//	),
//	array(
//		'label'   => __( 'Page Header Type:' ),
//		'name'    => 'ipa-page-option-header-type',
//		'type'    => 'select',
//		'options' => array(
//			'ipa-page-option-header-image'      => _( 'Featured Image' ),
//			'ipa-page-option-header-slider'     => _( 'Slider' ),
//			'ipa-page-option-header-google-map' => _( 'Google Map' ),
//			'ipa-page-option-header-user-menu'  => _( 'User Profile Navigation Menu' ),
//		)
//	),
//	array(
//		'label'       => __( 'Featured Image Title:' ),
//		'name'        => 'ipa-page-option-header-image',
//		'data_type'   => 'json',
//		'data_name'   => 'title',
//		'type'        => 'input_text',
//		'description' => _( 'Title appears at the header on the featured image.' )
//	),
//	array(
//		'label'       => __( 'Featured Image Text:' ),
//		'name'        => 'ipa-page-option-header-image',
//		'data_type'   => 'json',
//		'data_name'   => 'text',
//		'type'        => 'textarea',
//		'description' => _( 'Text appears at the header on the featured image.' )
//	),
//	array(
//		'label'       => __( 'Slider:' ),
//		'name'        => 'ipa-page-option-header-slider',
//		'data_type'   => 'json',
//		'data_name'   => 'slides',
//		'type'        => 'slider',
//		'description' => _( 'Slides appears at the header of the page.' )
//	),
//	array(
//		'label'       => __( 'User Menu Top Title:' ),
//		'name'        => 'ipa-page-option-header-user-menu',
//		'data_type'   => 'json',
//		'data_name'   => 'title',
//		'type'        => 'input_text',
//		'description' => _( 'Title appears at the header on the featured image.' )
//	),
//	array(
//		'label'       => __( 'User Menu Title:' ),
//		'name'        => 'ipa-page-option-header-user-menu',
//		'data_type'   => 'json',
//		'data_name'   => 'menu-title',
//		'type'        => 'input_text',
//		'description' => _( 'Title appears at the header above user menu on the featured image.' )
//	),
//	array(
//		'label'       => __( 'Google Map Title:' ),
//		'name'        => 'ipa-page-option-header-google-map',
//		'data_type'   => 'json',
//		'data_name'   => 'title',
//		'type'        => 'input_text',
//		'description' => _( 'Title appears at the header on the google map.' )
//	),
//	array(
//		'label'       => __( 'Google Map Text:' ),
//		'name'        => 'ipa-page-option-header-google-map',
//		'data_type'   => 'json',
//		'data_name'   => 'text',
//		'type'        => 'textarea',
//		'description' => _( 'Text appears at the header on the google map.' )
//	),
//	array(
//		'type' => 'hr'
//	),
//	array(
//		'label'       => __( 'Additional HTML under page header and above main content:' ),
//		'name'        => 'ipa-page-option-html-above-main-content',
//		'type'        => 'textarea',
//		'description' => _( 'This HTML (text) appears under main content before and before footer.' )
//	),
//	array(
//		'type' => 'hr'
//	),
//	array(
//		'label'       => __( 'Additional HTML under main content and above footer:' ),
//		'name'        => 'ipa-page-option-html-under-main-content',
//		'type'        => 'textarea',
//		'description' => _( 'This HTML (text) appears under main content before and before footer.' )
//	),
//);
