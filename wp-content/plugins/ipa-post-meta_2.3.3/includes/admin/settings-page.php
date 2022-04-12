<?php

/**
 * Class  IPA_PostMeta_Settings
 */
class  IPA_PostMeta_Settings {

	public static $options_slug = 'ipa-post-meta-option';

	static function addSettingsPage() {
		add_menu_page( __( 'IPA Post Meta' ), __( 'Post Meta' ), 'manage_options', 'ipa-post-meta', null, 'dashicons-groups', '101.5' );
		add_submenu_page( 'ipa-post-meta', __( 'Settings' ), __( 'Settings' ), 'manage_options', 'ipa-post-meta', array(
			' IPA_PostMeta_Settings',
			'settingsPageInterface'
		) );
	}

	static function settingsPageInterface() {
		$plugin_data = get_plugin_data( IPA_POSTMETA_PATH.'/ipa-post-meta.php' );

		// register scripts for settings page
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-accordion' );

		wp_register_style( 'jquery-ui-style', IPA_POSTMETA_URL . '/assets/bower_components/jquery-ui/themes/flick/jquery-ui.min.css', false, '1.11.4', 'screen' );
		wp_enqueue_style( 'jquery-ui-style' );

		wp_deregister_script( 'ipa-post-meta-settings-script' );
		wp_register_script( 'ipa-post-meta-settings-script', IPA_POSTMETA_URL . '/assets/scripts/settings.js', false, $plugin_data['Version'] );
		wp_enqueue_script( 'ipa-post-meta-settings-script' );

		wp_register_style( 'ipa-post-meta-settings-style', IPA_POSTMETA_URL . '/assets/styles/settings.css', false, $plugin_data['Version']);
		wp_enqueue_style( 'ipa-post-meta-settings-style' );
		?>

		<h2><?php echo __( 'IPA Post Meta Settings', 'ipa-post-meta' ) ?></h2>

		<?php
		if ( isset( $_POST['ipa-post-meta-settings-submit'] ) ) {
			if ( function_exists( 'current_user_can' ) && ! current_user_can( 'manage_options' ) ) {
				die( _e( 'Hacker?' ) );
			}

			if ( function_exists( 'check_admin_referer' ) ) {
				check_admin_referer( 'ipa_user_profile_settings_nonce' );
			}
			?>

			<?php
			$settings = array();
			?>

			<?php if ( isset( $_POST[ self::$options_slug ] ) ): ?>
				<?php if ( is_array( $_POST[ self::$options_slug ] ) ): ?>
					<?php foreach ( $_POST[ self::$options_slug ] as $option => $value ): ?>
						<?php
						$settings[ $option ] = $value;
						?>
					<?php endforeach; ?>
				<?php else: ?>
					<?php //TODO: Save option value if it not an array ?>
				<?php endif; ?>
			<?php endif; ?>
			<div id="message" class="updated fade">
				<p><?php echo __( 'IPA Post Meta settings updated!', 'ipa-post-meta' ); ?></p>
			</div>
			<?php

			self::saveSettings( $settings );
		}
		?>

		<?php
		$args = array(
			'posts_per_page' => - 1,
			'offset' => 0,
			'category' => '',
			'orderby' => 'post_date',
			'order' => 'ASC',
			'include' => '',
			'exclude' => '',
			'meta_key' => '',
			'meta_value' => '',
			'post_type' => 'page',
			'post_mime_type' => '',
			'post_parent' => '',
			'post_status' => 'publish',
			'suppress_filters' => true,
		);

		$posts = query_posts( $args );

		//settings
		$settings = self::getSettings();

		//TODO: Update file to add settings for IPA POST META Plugin
		?>

		<form id="ipa-post-meta-settings-form" name="ipa-post-meta-settings-form" method="post"
		      class="settings-form"
		      action="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<?php
			if ( function_exists( 'wp_nonce_field' ) ) {
				wp_nonce_field( 'ipa_user_profile_settings_nonce' );
			}
			?>

			<input class="button button-primary button-large button-submit" type="submit"
			       name="ipa-post-meta-settings-submit" id="ipa-post-meta-settings-submit"
			       value="<?php echo __( 'Save settings', 'ipa-post-meta' ) ?>">

			<div class="ipa-settings-accordion">
				<h3><?php echo __( "Main settings", 'ipa-post-meta' ); ?></h3>
				<div>
					<h1 class="title"><?php echo __( "Main settings", 'ipa-post-meta' ); ?></h1>
					<!--					settings description-->
					<p>
					</p>

					<table class="form-table">
						<tbody>
						<tr>
							<th scope="row">
								<label
									for="authorisation_page_id"><?php echo __( "Authorisation page:", 'ipa-post-meta' ); ?></label>
							</th>
							<td>
								<select id="authorisation_page_id"
								        name="<?php echo self::$options_slug ?>[authorisation_page_id]">
									<?php if ( count( $posts ) ) : ?>
										<?php global $post; ?>
										<option value=""><?php echo __( '-- Select Page --', 'ipa-post-meta' ); ?></option>
										<?php while ( have_posts() ) : ?>
											<?php the_post(); ?>
											<option
												value="<?php echo $post->ID; ?>" <?php echo ( $settings['authorisation_page_id'] == $post->ID ) ? 'selected' : ''; ?>>
												<?php echo $post->post_title ?>
											</option>
										<?php endwhile; ?>
									<?php else: ?>
										<option value="" selected>
											<?php echo __( 'No pages on the site', 'ipa-post-meta' ); ?>
										</option>
									<?php endif; ?>
								</select>

								<p class="description"><?php echo __( 'Select page for authorisation', 'ipa-post-meta' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label
									for="registration_page_id"><?php echo __( "Registration page:", 'ipa-post-meta' ); ?></label>
							</th>
							<td>
								<select id="registration_page_id"
								        name="<?php echo self::$options_slug ?>[registration_page_id]">
									<?php if ( count( $posts ) ) : ?>
										<?php global $post; ?>
										<option value="">
											<?php echo __( '-- Select Page --', 'ipa-post-meta' ); ?>
										</option>
										<?php while ( have_posts() ) : ?>
											<?php the_post(); ?>

											<option
												value="<?php echo $post->ID; ?>" <?php echo ( $settings['registration_page_id'] == $post->ID ) ? 'selected' : ''; ?>>
												<?php echo $post->post_title ?>
											</option>
										<?php endwhile; ?>
									<?php else: ?>
										<option value="" selected>
											<?php echo __( 'No pages on the site', 'ipa-post-meta' ); ?>
										</option>
									<?php endif; ?>
								</select>

								<p class="description"><?php echo __( 'Select page for registration', 'ipa-post-meta' ); ?></p>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>

			<input class="button button-primary button-large button-submit" type="submit"
			       name="ipa-post-meta-settings-submit" id="ipa-post-meta-settings-submit"
			       value="<?php echo __( 'Save settings', 'ipa-post-meta' ) ?>">
		</form>

		<?php
		// Reset Query
		wp_reset_query();
		?>

		<?php
	}

	static function getSetting( $settings, $value, $default = '' ) {
		if ( $settings ) {
			if ( isset( $settings[ $value ] ) ) {
				return $settings[ $value ];
			} else {
				return $default;
			}
		} else {
			return $default;
		}
	}

	static function getSettings() {
		$settings = get_option( self::$options_slug, '' );
		$settings = stripslashes( $settings );

		if ( empty( $settings ) ) {
			return false;
		};

		$settings = json_decode( $settings, true );

		if ( is_array( $settings ) ) {
			$settings = self::array_map_recursive( array(
				__CLASS__,
				'map_strip_slashes'
			), $settings );

			return $settings;
		} else {
			return false;
		}

	}

	static function saveSettings( $settings ) {
		$settingsJson = json_encode( $settings );
		update_option( self::$options_slug, wp_slash( $settingsJson ) );
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

