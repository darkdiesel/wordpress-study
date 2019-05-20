<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Photosession_PostType_Photosession_Post_Type' ) ) :
	class IPA_Photosession_PostType_Photosession_Post_Type {

		private static $photosession_settings_additions_section = 'photosession-additions';

		private static $save_form_nonce_action = 'ipa_photosession_post_type_admin_meta_box_nonce';
		private static $save_form_nonce_name = 'ipa_photosession_post_type_admin_check';

		public static function init() {

			$post_type = 'photosession';

			if ( post_type_exists( $post_type ) ) {
				return;
			}

			if ( ! empty( $theme_option['photosession-slug'] ) ) {
				$photosession_slug          = $theme_option['photosession-slug'];
				$photosession_category_slug = $theme_option['photosession-category-slug'];
			} else {
				$photosession_slug          = $post_type;
				$photosession_category_slug = 'photosession-category';

			}

			register_post_type( $post_type,
				[
					'labels'              => [
						'name'                  => __( 'Photosessions',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'menu_name'             => __( "Photosessions",
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'singular_name'         => __( 'Photosession',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'add_new'               => __( 'Add New',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'add_new_item'          => __( 'Add New Photosession',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'edit_item'             => __( 'Edit Photosession',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'new_item'              => __( 'New Photosession',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'view_item'             => __( 'View Photosession',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'search_items'          => __( 'Search Photosessions',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'not_found'             => __( 'No photosessions found.',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'not_found_in_trash'    => __( 'No photosessions found in Trash.',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'parent_item_colon'     => NULL,
						'all_items'             => __( 'All Photosessions',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'featured_image'        => __( 'Featured Image',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'set_featured_image'    => __( 'Set featured image',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'remove_featured_image' => __( 'Remove featured image',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
						'use_featured_image'    => __( 'Use as featured image',
							IPA_Photosession_PostType()->plugin->get_text_domain() ),
					],
					'public'              => TRUE,
					'description'         => __( 'add photosession',
						IPA_Photosession_PostType()->plugin->get_text_domain() ),
					'publicly_queryable'  => TRUE,
					'show_ui'             => TRUE,
					'show_in_menu'        => TRUE,
					'show_in_nav_menus'   => TRUE,
					'show_in_admin_bar'   => TRUE,
					'query_var'           => TRUE,
					'rewrite'             => [ 'slug' => $photosession_slug ],
					'capability_type'     => 'post',
					'hierarchical'        => FALSE,
					'menu_position'       => 5,
					'menu_icon'           => 'dashicons-camera',
					'can_export'          => TRUE,
					'has_archive'         => TRUE,
					'exclude_from_search' => FALSE,
					'supports'            => [
						'title',
						'editor',
						'excerpt',
						'author',
						'thumbnail',
						'comments',
						'trackbacks',
						'revisions',
						'custom-fields',
					],
					'taxonomies'          => [  ],
				]
			);


			// studio taxonomy
			$labels = [
				'name'                       => __( 'Categoriess',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'singular_name'              => __( 'Categories',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'menu_name'                  => __( 'Categoriess',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'edit_item'                  => __( 'Edit Categories',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'update_item'                => __( 'Update Categories',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'add_new_item'               => __( 'Add New Categories',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'new_item_name'              => __( 'New Categories Name',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'parent_item'                => __( 'Parent Categories',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'parent_item_colon'          => __( 'Parent Categories:',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'all_items'                  => __( 'All Categoriess',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'search_items'               => __( 'Search Categoriess',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'popular_items'              => __( 'Popular Categoriess',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'separate_items_with_commas' => __( 'Separate Categoriess with commas',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'add_or_remove_items'        => __( 'Add or remove Categoriess',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'choose_from_most_used'      => __( 'Choose from the most used Categoriess',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
				'not_found'                  => __( 'No Categoriess found.',
					IPA_Photosession_PostType()->plugin->get_text_domain() ),
			];

			$args = [
				'labels'            => $labels,
				'public'            => TRUE,
				'show_in_nav_menus' => TRUE,
				'show_ui'           => TRUE,
				'show_tagcloud'     => TRUE,
				'hierarchical'      => TRUE,
				'rewrite'           => [ 'slug' => $photosession_category_slug ],
				'show_admin_column' => TRUE,
				'query_var'         => TRUE,
			];
			register_taxonomy( $photosession_category_slug, $post_type, $args );

			add_action( 'add_meta_boxes', [ __CLASS__, 'meta_boxes' ] );
			add_action( 'save_post', [ __CLASS__, 'save_post_meta' ] );
			add_filter( 'pre_get_posts',
				[ __CLASS__, 'get_post_photosession' ] );
		}

		/**
		 * @param $query WP_Query
		 *
		 * @return mixed
		 */
		static function get_post_photosession( $query ) {
			if ( is_home() && $query->is_main_query() ) {
				$query->set( 'post_type', [ 'post', 'photosession' ] );
			}

			return $query;
		}

		/**
		 * Add metaboxes for this post type
		 */
		static function meta_boxes() {
			add_meta_box( 'photosession-additional-data',
				__( 'Photosession Additional Data', 'vrbangres' ),
				[
					__CLASS__,
					'meta_boxes_photosession_additional_data_output',
				],
				'photosession',
				'normal',
				'high' );
		}


		/**
		 * Print metaboxes for this post type
		 */
		static function meta_boxes_photosession_additional_data_output() {
			global $post;
			?>
            <div class="post-option-meta">
				<?php
				// Add an nonce field so we can check for it later.
				wp_nonce_field( self::$save_form_nonce_action,
					self::$save_form_nonce_name );
				?>

				<?php if ( function_exists( 'IPA_PostMeta' ) ) : ?>
					<?php foreach ( self::get_post_meta_arr() as $field ) : ?>
						<?php if ( isset( $field['section'] ) && ( $field['section'] == self::$photosession_settings_additions_section ) ): ?>
							<?php
							if ( $field['type'] != 'hr' ) {
								$value = get_post_meta( $post->ID,
									$field['name'],
									TRUE );
							} else {
								$value = '';
							}
							?>
							<?php echo IPA_PostMeta()->field->build( $field,
								$value,
								'<div>%s</div><div>%s</div><p class="ipa-field-description">%s</p>' ); ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php else: ?>
                    <div class="notice notice-error">
						<?= _( 'For printing fields you need install and activate IPA_PostMeta Plugin' ); ?>
                    </div>
				<?php endif; ?>
            </div>
			<?php
		}

		/**
		 * @param $post_id
		 * Save post meta
		 */
		static function save_post_meta( $post_id ) {
			// Check if our nonce is set.
			if ( ! isset( $_POST[ self::$save_form_nonce_name ] ) || ! wp_verify_nonce( $_POST[ self::$save_form_nonce_name ],
					self::$save_form_nonce_action )
			) {
				return;
			}

			if ( function_exists( 'IPA_PostMeta' ) ) {
				foreach ( self::get_post_meta_arr() as $field ) {
					if ( isset( $_POST[ $field['name'] ] ) ) {
						update_post_meta( $post_id,
							$field['name'],
							$_POST[ $field['name'] ] );
					} elseif ( $field['type'] != 'hr' && isset( $field['name'] ) ) {
						update_post_meta( $post_id, $field['name'], NULL );
					}
				}
			}
		}

		/**
		 * Photosession post meta settings
		 *
		 * @return array
		 */
		static function get_post_meta_arr() {
			return [
				[
					'section' => self::$photosession_settings_additions_section,
					'label'   => __( 'Date:',
						IPA_Photosession_PostType()->plugin->get_text_domain() ),
					'name'    => 'ipa-photosession-date',
					'type'    => 'input-text',
				],
				[
					'section' => self::$photosession_settings_additions_section,
					'label'   => __( 'City:',
						IPA_Photosession_PostType()->plugin->get_text_domain() ),
					'name'    => 'ipa-photosession-city',
					'type'    => 'input-text',
				],
				[
					'section' => self::$photosession_settings_additions_section,
					'type'    => 'hr',
					'name'    => 'model-quality',
				],
				[
					'section'           => self::$photosession_settings_additions_section,
					'label'             => __( 'Photosession thumbnails:',
						IPA_Photosession_PostType()->plugin->get_text_domain() ),
					'type'              => 'slider',
					'name'              => 'photosession_thumbnails',
					'popup_type'        => 'image',
					'popup_title'       => _( 'Select images for slider' ),
					'popup_button_text' => _( 'Add' ),
				],
			];
		}
	}
endif;

add_action( 'init', [ 'IPA_Photosession_PostType_Photosession_Post_Type', 'init' ] );