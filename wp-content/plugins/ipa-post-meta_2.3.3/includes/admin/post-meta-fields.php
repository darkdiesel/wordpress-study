<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_MetaFields' ) ) :

	/**
	 * Print post meta fields for Wordpress admin panel
	 *
	 * @param $meta_box
	 *
	 * Version: 3.0.0
	 * Author: Igor Peshkov (dark_diesel)
	 */
	class IPA_MetaField {
		/**
		 * Print input type=text meta box field
		 *
		 * @param $box_args
		 *
		 * @return string
		 */
		static function input_text_datepicker( $box_args ) {
			global $post;

			ob_start();

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-datepicker' );

//			wp_enqueue_style( "wp-jquery-ui-datepicker" );

			wp_enqueue_script( 'ipa-post-meta-input-text-datepicker-script' );

			wp_enqueue_style( 'jquery-ui-style' );

			extract( $box_args );

			/**
			 * @var string $post_meta_name
			 * @var string $label
			 * @var string $name
			 * @var string $description
			 * @var string $data_name
			 */

			$value = self::get_meta_data( $post->ID, $box_args );
			?>
			<div class="ipa-meta-box-container <?php echo sprintf( '%s-%s', $post_meta_name, $name ); ?>">
				<?php if ( isset( $label ) && $label ): ?>
					<div class="ipa-meta-box-title">
						<label for="<?php echo self::buildFieldID( $box_args ); ?>"><?php _e( $label ); ?></label>
					</div>
				<?php endif; ?>
				<div class="ipa-meta-box-input-text-datepicker-wrapper">
					<div class="ipa-meta-box-field">
						<input id="<?php echo self::buildFieldID( $box_args ); ?>"
						       name="<?php echo self::buildFieldName( $box_args ); ?>"
						       value="<?php echo esc_html( $value ); ?>"
						       type="text"
						       class="ipa-meta-box-input-text-datepicker"
						/>
					</div>
				</div>
				<?php if ( isset( $description ) ) : ?>
					<div class="ipa-meta-box-description">
						<?php echo $description ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
			return ob_get_clean();
		}

		static function select_post_meta_type( $box_args ) {
			global $post;
			ob_start();

			wp_enqueue_script( 'ipa-post-meta-select-post-meta-type-script' );

			extract( $box_args );

			/**
			 * @var string $post_meta_name
			 * @var string $label
			 * @var string $name
			 * @var string $default_value
			 * @var array $options
			 * @var string $description
			 */

			$value = self::get_meta_data( $post->ID, $box_args );
			?>

			<div class="ipa-meta-box-container <?php echo sprintf( '%s-%s', $post_meta_name, $name ); ?>">
				<?php if ( isset( $label ) && $label ): ?>
					<div class="ipa-meta-box-title">
						<label for="<?php echo self::buildFieldID( $box_args ); ?>"><?php _e( $label ); ?></label>
					</div>
				<?php endif; ?>
				<div class="ipa-meta-box-select-post-meta-wrapper">
					<div class="ipa-meta-box-field">
						<select name="<?php echo self::buildFieldName( $box_args ); ?>"
						        id="<?php echo self::buildFieldID( $box_args ); ?>"
						        class="ipa-meta-box-select-post-meta-type">
							<?php if ( is_array( $options ) && count( $options ) ) : ?>
								<?php foreach ( $options as $option => $arr ) : ?>
									<option
										value="<?php echo $option; ?>"
										data-target-field="<?php echo isset( $arr['field'] ) ? $arr['field'] : ''; ?>"
										<?php echo ( $option == esc_html( $value ) ) ? 'selected' : ''; ?>>
										<?php echo $arr['label']; ?>
									</option>
								<?php endforeach ?>
							<?php endif; ?>
						</select>
					</div>
				</div>
				<?php if ( isset( $description ) ) : ?>
					<div class="ipa-meta-box-description">
						<?php echo $description ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Print checkbox meta box field
		 *
		 * @param $box_args
		 *
		 * @return string
		 */
		//TODO: Fix and Test checkbox field
		static function checkbox( $box_args ) {
			global $post;
			ob_start();

			extract( $box_args );

			/**
			 * @var string $post_meta_name
			 * @var string $name
			 * @var string $value
			 * @var string $check_val
			 * @var string $label
			 * @var string $description
			 */

			$value = self::get_meta_data( $post->ID, $box_args );

			?>
			<div class="ipa-meta-box-container <?php echo sprintf( '%s-%s', $post_meta_name, $name ); ?>">
				<label for="<?php echo self::buildFieldID( $box_args ); ?>"
				       class="ipa-meta-box-title ipa-meta-box-checkbox-title">
					<input type="checkbox" id="<?php echo self::buildFieldID( $box_args ); ?>" <?php echo ( $check_val == $value ) ? 'checked="checked"' : ''; ?>
					       name="<?php echo self::buildFieldName( $box_args ); ?>" value="<?php echo $check_val; ?>"/>
					<?php echo $label ?>
				</label>

				<?php if ( isset( $description ) ) : ?>
					<div class="ipa-meta-box-description">
						<?php echo $description ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
			return ob_get_clean();
		}

		static function wp_editor( $box_args ) {
			global $post;
			ob_start();

			extract( $box_args );

			/**
			 * @var string $post_meta_name
			 * @var string $label
			 * @var string $name
			 * @var string $description
			 * @var string $data_name
			 */

			$value = self::get_meta_data( $post->ID, $box_args );

			if ( is_array( $value ) ) {
				$value = "";
			}
			?>

			<div class="ipa-meta-box-container <?php echo sprintf( '%s-%s', $post_meta_name, $name ); ?>">
				<?php if ( isset( $label ) && $label ): ?>
					<div class="meta-title">
						<label for="<?php echo self::buildFieldID( $box_args ); ?>"><?php _e( $label ); ?></label>
					</div>
				<?php endif; ?>
				<div class="ipa-meta-box-wp-editor-wrapper">
					<div class="ipa-meta-box-field">
						<?php
						wp_editor(
							htmlspecialchars_decode( $value ),
							self::buildFieldID( $box_args ),
							$settings = array(
								'textarea_name' => self::buildFieldName( $box_args )
							)
						);
						?>
					</div>
				</div>
				<?php if ( isset( $description ) ) : ?>
					<div class="ipa-meta-box-description">
						<?php echo $description ?>
					</div>
				<?php endif; ?>
			</div>

			<?php
			return ob_get_clean();
		}

		/**
		 * @return string
		 */
		static function buildFieldID( $args ) {
			extract( $args );

			/**
			 * @var string $post_meta_name
			 * @var string $name
			 * @var string $data_type
			 * @var string $data_name
			 * @var string $default_value
			 */

			if ( isset( $data_type ) ) {
				switch ( strtolower( $data_type ) ) {
					case 'json':
						if ( isset( $data_name ) ) {
							return sprintf( '%s-%s-%s', $post_meta_name, $name, $data_name );
						} else {
							return sprintf( '%s-%s', $post_meta_name, $name );
						}
						break;
					default:
						return $name;
						break;
				}
			} else {
				return $post_meta_name;
			}
		}

		/**
		 * @return string
		 */
		static function buildFieldName( $args ) {
			extract( $args );

			/**
			 * @var string $post_meta_name
			 * @var string $name
			 * @var string $data_type
			 * @var string $data_name
			 * @var string $default_value
			 */

			if ( isset( $data_type ) ) {
				switch ( strtolower( $data_type ) ) {
					case 'json':
						if ( isset( $data_name ) ) {
							return sprintf( '%s[%s][%s]', $post_meta_name, $name, $data_name );
						} else {
							return sprintf( '%s[%s]', $post_meta_name, $name );
						}
						break;
					default:
						return $name;
						break;
				}
			} else {
				return $post_meta_name;
			}
		}

		/**
		 * Return value for current meta field
		 *
		 * @param $post_id
		 * @param $args
		 *
		 * @return array|mixed|string
		 */
		static function get_meta_data( $post_id, $args ) {
			extract( $args );

			/**
			 * @var string $post_meta_name
			 * @var string $name
			 * @var string $data_type
			 * @var string $data_name
			 * @var string $default_value
			 */

			$post_meta = get_post_meta( $post_id, $post_meta_name, true );

			if ( empty( $post_meta ) ) {
				return $default_value;
			};

			if ( isset( $data_type ) ) {
				switch ( strtolower( $data_type ) ) {
					case 'json':
						$data = json_decode( $post_meta, true );

						$data = self::array_map_recursive( array(
							__CLASS__,
							'map_strip_slashes'
						), $data );

						if ( isset( $data[ $name ] ) ) {
							return $data[ $name ];
						} else {
							return $default_value;
						}
						break;
					default:
						return $post_meta;
						break;
				}
			} else {
				return $post_meta;
			}
		}

		/**
		 * Recursive mapping function $func to each array $arr elements
		 *
		 * @param callable $func
		 * @param array $arr
		 *
		 * @return array
		 */
		static function array_map_recursive( callable $func, array $arr ) {
			array_walk_recursive( $arr, function ( &$v ) use ( $func ) {
				$v = $func( $v );
			} );

			return $arr;
		}

		/**
		 * Filter meta fields value before printing
		 *
		 * @param $el
		 *
		 * @return string
		 */
		static function map_strip_slashes( &$el ) {
			if ( is_array( $el ) ) {
				return $el;
			} else {
				return stripslashes( $el );
			}
		}
	}

endif;