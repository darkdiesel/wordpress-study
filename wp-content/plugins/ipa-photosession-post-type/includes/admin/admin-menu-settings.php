<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_Photosession_PostType_Admin_Menu_Settings' ) ):
	class IPA_Photosession_PostType_Admin_Menu_Settings {
		public static function admin_menu_output() {
			$settings = IPA_Photosession_PostType()->plugin->get_settings();
			?>
			<div class="wrap">
				<div class="wrap-header">
					<h1><?php echo __( 'IPA Photosession Post Type Settings', IPA_Photosession_PostType()->plugin->get_text_domain() ); ?></h1>
				</div>

				<form id="ipa-photosession-post-type-settings-form"
				      novalidate="novalidate" action="" method="post">
					<input
						class="button button-primary button-large button-submit ipa-activex-integration-settings-submit"
						type="submit"
						name="ipa-activex-integration-settings-submit"
						value="<?php echo __( 'Save settings', IPA_Photosession_PostType()->plugin->get_text_domain() ) ?>"/>
					<span class="ajax-process">
					    <img src="<?php echo admin_url( 'images/spinner.gif' ) ?>" alt="">
					</span>

					<div class="ipa-postbox">
						<h2 class="ipa-hndle">
							<span><?php echo __( 'Settings', IPA_Photosession_PostType()->plugin->get_text_domain() ); ?></span></h2>
						<div class="ipa-inside">
							<table class="form-table">
								<tbody>
								<?php
								if ( function_exists( 'IPA_PostMeta' ) ) {
									$fields = IPA_Photosession_PostType()->plugin->get_settings_fields_arr();

									foreach ( $fields as $field ) {
										if ( isset( $settings[ $field['name'] ] ) ) {
											$value = $settings[ $field['name'] ];
										} else {
											$value = false;
										}

										echo IPA_PostMeta()->field->build( $field, $value );
									}
								} else { ?>
									<div class="notice notice-error">
										<?php echo _( 'For printing fields you need install and activate IPA_PostMeta Plugin', IPA_Photosession_PostType()->plugin->get_text_domain() ); ?>
									</div>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>

					<input
						class="button button-primary button-large button-submit ipa-activex-integration-settings-submit"
						type="submit"
						name="ipa-activex-integration-settings-submit"
						value="<?php echo __( 'Save settings', IPA_Photosession_PostType()->plugin->get_text_domain() ) ?>"/>
					<span class="ajax-process">
						<img src="<?php echo admin_url( 'images/spinner.gif' ) ?>" alt="">
					</span>
				</form>
			</div>
			<?php
		}

		public static function plugin_settings_ajax_save() {
			if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'ipa_photosession_post_type_menu_settings_wpnonce' ) ) {
				die( _( 'Permission check failed' ) );
			}

			//build setting array
			$settings = array();

			if ( isset( $_POST['form'] ) ) {
				foreach ( $_POST['form'] as $option ) {
					if ( strpos( $option['name'], '[]' ) ) {
						$settings[ substr( $option['name'], 0, strlen( $option['name'] ) - strpos( $option['name'], '[]' ) - 1 ) ][] = $option['value'];
					} else {
						$settings[ $option['name'] ] = $option['value'];
					}
				}
			}

			//save plugin settings
			update_option( IPA_Photosession_PostType()->plugin->plugin_settings_option, wp_slash( json_encode( $settings ) ) );

			//create response
			$response = array();

			$response['ajax']    = 'success';
			$response['message'] = sprintf( '<strong>%s</strong>', __( 'Settings successfully saved!', IPA_Photosession_PostType()->plugin->get_text_domain() ) );
			$response['fields']  = $settings;

			//return json
			echo json_encode( $response );

			die();
		}

		public static function admin_menu_scripts( $plugin_data ) {
			wp_deregister_script( 'ipa-photosession-post-type-menu-settings-script' );
			wp_register_script( 'ipa-photosession-post-type-menu-settings-script', IPA_PHOTOSESSION_POST_TYPE_URL . '/assets/js/admin-menu-settings.js', array( 'jquery' ), $plugin_data['Version'] );
			wp_enqueue_script( 'ipa-photosession-post-type-menu-settings-script' );

			wp_localize_script(
				'ipa-photosession-post-type-menu-settings-script', 'ipa_photosession_post_type_menu_settings_vars', array( 'wpnonce' => wp_create_nonce( 'ipa_photosession_post_type_menu_settings_wpnonce' ) )
			);
		}
	}
endif;

// class actions
add_action( "wp_ajax_ipa_photosession_post_type_settings_save", array(
	'IPA_Photosession_PostType_Admin_Menu_Settings',
	'plugin_settings_ajax_save'
) );