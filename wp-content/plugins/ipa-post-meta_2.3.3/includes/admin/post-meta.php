<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta' ) ) :

	/**
	 * Print meta boxes fields for Wordpress admin panel
	 *
	 * @param $meta_box
	 *
	 * Version: 2.1.0
	 * Author: Igor Peshkov (dark_diesel)
	 */
	class IPA_PostMeta {

		/**
		 * @return string
		 */
		static function get_meta_field( $meta_box ) {
			include_once( IPA_POSTMETA_PATH . '/includes/admin/post-meta-fields.php' );

			if ( empty( $meta_box['default_value'] ) ) {
				$meta_box['default_value'] = '';
			}

			switch ( strtolower( $meta_box['type'] ) ) {
				case "input_text_datepicker":
					return IPA_MetaField::input_text_datepicker( $meta_box );
					break;
				case "select_post_meta_type":
					return IPA_MetaField::select_post_meta_type( $meta_box );
					break;
				case "checkbox":
					return IPA_MetaField::checkbox( $meta_box );
					break;
				case "wp_editor":
					return IPA_MetaField::wp_editor( $meta_box );
					break;
			}
		}

		static function save_post_meta( $post_id, $post_meta_arr ) {
			if ( isset( $post_meta_arr['data_type'] ) ) {
				switch ( strtolower( $post_meta_arr['data_type'] ) ) {
					case 'json':

						if ( isset( $_POST[ $post_meta_arr['post_meta_name'] ][ $post_meta_arr['name'] ] ) ) {
							$data = $_POST[ $post_meta_arr['post_meta_name'] ][ $post_meta_arr['name'] ];
						} else {
							$old_data       = get_post_meta( $post_id, $post_meta_arr['post_meta_name'], true );
							$old_data_array = json_decode( $old_data, true );

							$old_data_array[ $post_meta_arr['name'] ] = '';
							$new_data = json_encode( $old_data_array );

							update_post_meta( $post_id, $post_meta_arr['post_meta_name'], wp_slash( $new_data ), $old_data );

							return;
						}

						// save meta box by name
						$old_data       = get_post_meta( $post_id, $post_meta_arr['post_meta_name'], true );
						$old_data_array = json_decode( $old_data, true );

						switch ( strtolower( $post_meta_arr['type'] ) ) {
							case 'slider':
								$new_data_array = $old_data_array;

								$new_data_array[ $post_meta_arr['name'] ] = array();

								if ( isset( $data['slides'] ) ) {
									foreach ( $data['slides'] as $slide ) {
										$new_data_array[ $post_meta_arr['name'] ][] = array(
											'slide-image-id'    => $slide['slide-image-id'],
											'slide-title'       => $slide['slide-title'],
											'slide-text'        => $slide['slide-text'],
											'slide-button-text' => $slide['slide-button-text'],
											'slide-button-url'  => $slide['slide-button-url'],
										);
									}
								}

								$new_data = json_encode( $new_data_array );
								break;
							case 'upload':
								$new_data_array = $old_data_array;

								$new_data_array[ $post_meta_arr['name'] ] = array(
									'attachment-id' => $data['attachment-id'],
									'upload-title'  => $data['upload-title'],
									'upload-text'   => $data['upload-text'],
									'upload-url'    => $data['upload-url'],
								);

								$new_data = json_encode( $new_data_array );
								break;
							default:
								if ( is_array( $old_data_array ) ) {
									$old_data_array[ $post_meta_arr['name'] ] = $data;
								} else {
									$old_data_array = array(
										$post_meta_arr['name'] => $data
									);
								}

								$new_data = json_encode( $old_data_array );
								break;
						}

						// Update the meta field in the database.
						update_post_meta( $post_id, $post_meta_arr['post_meta_name'], wp_slash( $new_data ), $old_data );

						break;
					default:
						//default data type
						break;
				}
			} else {
				if ( isset( $_POST[ $post_meta_arr['post_meta_name'] ] ) ) {
					$data = $_POST[ $post_meta_arr['post_meta_name'] ];
				} else {
					$data = '';
				}

				// if no data set empty value
				$old_data = get_post_meta( $post_id, $post_meta_arr['post_meta_name'], true );
				$new_data = $data;
				update_post_meta( $post_id, $post_meta_arr['post_meta_name'], $new_data, $old_data );
			}
		}

		/**
		 * @param $post_id
		 * @param $post_meta_name
		 * @param $post_meta_arr
		 *
		 * @return array|mixed|null
		 */
		static function get_post_meta($post_id, $post_meta_name, $post_meta_arr){
			$default_value = '';

			$post_meta = get_post_meta( $post_id, $post_meta_name, true );

			if ( empty( $post_meta ) ) {
				return $default_value;
			};

			if ($post_meta_arr && isset( $post_meta_arr['data_type'] ) ) {
				switch ( strtolower( $post_meta_arr['data_type'] ) ) {
					case 'json':
						include_once( IPA_POSTMETA_PATH . '/includes/admin/post-meta-fields.php' );

						$data = json_decode( $post_meta, true );

						$data = IPA_MetaField::array_map_recursive( array(
								IPA_MetaField,
								'map_strip_slashes'
						), $data );

						return $data;
						break;
					default:
						return $post_meta;
						break;
				}
			} else {
				return $post_meta;
			}
		}
	}


endif;