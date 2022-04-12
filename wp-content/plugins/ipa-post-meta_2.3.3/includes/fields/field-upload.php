<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/*
 * TODO: Refactoring
 */
if ( ! class_exists( 'IPA_PostMeta_Field_Upload' ) ):
    class IPA_PostMeta_Field_Upload extends IPA_PostMeta_Field_Abstract {

        private $template = '<input type="text" value="%s" name="%s" class="%s" />';
        private $class = 'regular-text';

        public function build( $params, $value ) {
            ob_start(); ?>

            <?php
            if ( isset( $params['class'] ) && $params['class'] ) {
                $field_class = $params['class'];
            } else {
                $field_class = $this->class;
            }
            ?>

            <div class="ipa-meta-box-container">
				<div class="ipa-meta-box-upload-wrapper">
					<div class="ipa-meta-box-upload-thumbnail-image">
						<div class="ipa-meta-box-upload-thumbnail-image-wrapper">
							<?php if ( isset( $value['attachment-id'] ) && $value['attachment-id'] ): ?>
								<?php
								$thumb_src_preview = wp_get_attachment_image_src( $value['attachment-id'], 'thumbnail' );
								?>

								<?php if ( $thumb_src_preview ) : ?>
									<img src="<?php echo $thumb_src_preview[0] ?>"/>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<?php if ( isset( $value['attachment-id'] ) && $value['attachment-id'] ): ?>
							<div class="ipa-meta-box-upload-dialog" title="Upload options">
								<form>
									<label class="ipa-meta-box-upload-dialog-label">Image Title</label>
									<input type="text" name="upload-title"
										   value="<?php echo ( isset( $value['upload-title'] ) && $value['upload-title'] ) ? $value['upload-title'] : ''; ?>"
										   class="text ui-widget-content ui-corner-all ipa-meta-box-upload-dialog-upload-title"/>

									<label class="ipa-meta-box-upload-dialog-label">Image Text</label>

									<textarea name="slide-text"
											  class="ipa-meta-box-upload-dialog-upload-text"><?php echo ( isset( $value['upload-text'] ) && $value['upload-text'] ) ? $value['upload-text'] : ''; ?></textarea>

									<label class="ipa-meta-box-upload-dialog-label">Image URL</label>
									<input type="text" name="upload-url"
										   value="<?php echo ( isset( $value['upload-url'] ) && $value['upload-url'] ) ? $value['upload-url'] : ''; ?>"
										   class="text ui-widget-content ui-corner-all ipa-meta-box-upload-dialog-upload-url"/>
								</form>
							</div>
							<a href="#" class="ipa-meta-box-upload-edit-btn">
								<span class="dashicons dashicons-edit"></span>
							</a>
							<a href="#" class="ipa-meta-box-upload-delete-btn">
								<span class="dashicons dashicons-trash"></span>
							</a>
						<?php endif; ?>
					</div>

					<input name="<?php echo $params['name']; ?>[attachment-id]"
						   type="hidden"
						   value="<?php echo ( isset( $value['attachment-id'] ) && $value['attachment-id'] ) ? esc_attr( $value['attachment-id'] ) : ''; ?>"
						   class="ipa-meta-box-upload-attachment-id"/>

					<input class="ipa-meta-box-upload-title" type="hidden"
						   value="<?php echo ( isset( $value['upload-title'] ) && $value['upload-title'] ) ? esc_attr( $value['upload-title'] ) : ''; ?>"
						   name="<?php echo $params['name']; ?>[upload-title]">
					<input class="ipa-meta-box-upload-text" type="hidden"
						   value="<?php echo ( isset( $value['upload-text'] ) && $value['upload-text'] ) ? esc_attr( $value['upload-text'] ) : ''; ?>"
						   name="<?php echo $params['name']; ?>[upload-text]">
					<input class="ipa-meta-box-upload-url" type="hidden"
						   value="<?php echo ( isset( $value['upload-url'] ) && $value['upload-url'] ) ? esc_attr( $value['upload-url'] ) : ''; ?>"
						   name="<?php echo $params['name']; ?>[upload-url]">

					<div class="ipa-meta-box-field">
						<input type="text" class="newtag form-input-tip ipa-meta-box-upload-image-url"
							   value="<?php echo ( isset( $thumb_src_preview ) ) ? $thumb_src_preview[0] : ''; ?>" />

						<input type="button" data-title="<?php echo $params['popup_title']; ?>" data-button="<?php echo $params['popup_button_text']; ?>"
							   data-type="<?php echo $params['popup_type']; ?>"
							   class="button tagadd ipa-meta-box-upload-btn"
							   value="<?php echo _( 'Add' ); ?>"/>
					</div>
				</div>
			</div>

            <?php //echo sprintf( $this->template, $value, $params['name'], $field_class ); ?>

            <?php
            return ob_get_clean();
        }
    }
endif;