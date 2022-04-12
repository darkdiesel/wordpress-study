<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 * TODO: Refactoring
 */
if ( ! class_exists( 'IPA_PostMeta_Field_Slider' ) ):
	class IPA_PostMeta_Field_Slider extends IPA_PostMeta_Field_Abstract {

		private $template = '<input type="text" value="%s" name="%s" class="%s" />';
		private $class = 'regular-text';

		public function build( $params, $value ) {
			ob_start(); ?>

			<?php
			if ( ! is_array( $value ) ) {
				$value = array( 'slides' => array() );
			}
			?>

			<?php
			if ( isset( $params['class'] ) && $params['class'] ) {
				$field_class = $params['class'];
			} else {
				$field_class = $this->class;
			}
			?>

            <div class="ipa-meta-box-container">
                <div class="ipa-meta-box-slider-wrapper">
                    <div class="ipa-meta-box-field">
                        <input type="button"
                               class="button button-primary ipa-meta-box-add-slide-btn"
                               value="<?php echo _( 'Add Slide' ); ?>"
                               data-type="image"
                               data-title="Select image for new slide"
                               data-button="<?php echo _( 'Add Slide' ); ?>">

                        <div class="ipa-meta-box-slider-items-container"
                             data-slider-name="<?php echo $params['name'] ?>"
                             data-slider-post-name="<?php echo $params['name']; ?>">
                            <ul class="ipa-meta-box-slider-items"
                                data-total-items="<?php echo count( $value['slides'] ); ?>">
								<?php if ( count( $value['slides'] ) ): ?>
									<?php foreach ( $value['slides'] as $index => $slide ) : ?>
                                        <li class="ipa-meta-box-slider-item ipa-meta-box-slider-item-<?php echo $index; ?>">
                                            <div>
                                                <div class="ipa-meta-box-slide-image-thumbnail">
													<?php if ( $slide['slide-image-id'] ) : ?>
														<?php
														$thumb_src_preview = wp_get_attachment_image_src( $slide['slide-image-id'] );
														?>
                                                        <img src="<?php echo $thumb_src_preview[0]; ?>">

                                                        <input type="hidden"
                                                               value="<?php echo $slide['slide-image-id'] ?>"
                                                               name="<?php echo $params['name']; ?>[slides][<?php echo $index; ?>][slide-image-id]"/>
													<?php endif; ?>
                                                </div>
                                                <input class="ipa-meta-box-slider-slide-title"
                                                       type="hidden"
                                                       value="<?php echo( isset( $slide['slide-title'] ) ? esc_attr( $slide['slide-title'] ) : '' ); ?>"
                                                       name="<?php echo $params['name']; ?>[slides][<?php echo $index; ?>][slide-title]">
                                                <input class="ipa-meta-box-slider-slide-text"
                                                       type="hidden"
                                                       value="<?php echo( isset( $slide['slide-text'] ) ? esc_attr( $slide['slide-text'] ) : '' ); ?>"
                                                       name="<?php echo $params['name']; ?>[slides][<?php echo $index; ?>][slide-text]">
                                                <input class="ipa-meta-box-slider-slide-button-text"
                                                       type="hidden"
                                                       value="<?php echo( isset( $slide['slide-button-text'] ) ? esc_attr( $slide['slide-button-text'] ) : '' ); ?>"
                                                       name="<?php echo $params['name']; ?>[slides][<?php echo $index; ?>][slide-button-text]">
                                                <input class="ipa-meta-box-slider-slide-button-url"
                                                       type="hidden"
                                                       value="<?php echo( isset( $slide['slide-button-url'] ) ? esc_attr( $slide['slide-button-url'] ) : '' ); ?>"
                                                       name="<?php echo $params['name']; ?>[slides][<?php echo $index; ?>][slide-button-url]">

                                                <a class="ipa-meta-box-slide-edit-btn"
                                                   data-dialog-class="<?php echo $params['name'] ?>-options-<?php echo $index; ?>"
                                                   href="#">
                                                    <span class="dashicons dashicons-edit"></span>
                                                </a>
                                                <a class="ipa-meta-box-slide-delete-btn"
                                                   href="#">
                                                    <span class="dashicons dashicons-trash"></span>
                                                </a>

                                                <div
                                                        class="ipa-meta-box-slide-options <?php echo $params['name'] ?>-options-<?php echo $index; ?>"
                                                        title="Edit Slide"
                                                        data-slide="meta-box-slider-item-<?php echo $index; ?>">
                                                    <form>
                                                        <label for="title-slider"
                                                               class="ipa-meta-box-slide-dialog-label">Slide
                                                            Title</label>
                                                        <input type="text"
                                                               name="slider-title"
                                                               value="<?php echo( isset( $slide['slide-title'] ) ? esc_attr( $slide['slide-title'] ) : '' ); ?>"
                                                               class="text ui-widget-content ui-corner-all ipa-meta-box-slide-dialog-slide-title"/>

                                                        <label for="text-slider"
                                                               class="ipa-meta-box-slide-dialog-label">Slide
                                                            Text</label>

                                                        <textarea
                                                                name="slide-text"
                                                                class="ipa-meta-box-slide-dialog-slide-text"><?php echo( isset( $slide['slide-text'] ) ? esc_attr( $slide['slide-text'] ) : '' ); ?></textarea>

                                                        <label for="slide-button-text"
                                                               class="ipa-meta-box-slide-dialog-label">Slide
                                                            Button Text</label>
                                                        <input type="text"
                                                               name="slider-button-text"
                                                               value="<?php echo( isset( $slide['slide-button-text'] ) ? esc_attr( $slide['slide-button-text'] ) : '' ); ?>"
                                                               class="text ui-widget-content ui-corner-all ipa-meta-box-slide-dialog-slide-button-text"/>

                                                        <label for="url-button-slider"
                                                               class="ipa-meta-box-slide-dialog-label">Slider
                                                            Button URL</label>
                                                        <input type="text"
                                                               name="slider-button-url"
                                                               value="<?php echo( isset( $slide['slide-button-url'] ) ? esc_attr( $slide['slide-button-url'] ) : '' ); ?>"
                                                               class="text ui-widget-content ui-corner-all ipa-meta-box-slide-dialog-slide-button-url"/>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
									<?php endforeach; ?>
								<?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

			<?php //echo sprintf( $this->template, $value, $params['name'], $field_class ); ?>

			<?php
			return ob_get_clean();
		}
	}
endif;