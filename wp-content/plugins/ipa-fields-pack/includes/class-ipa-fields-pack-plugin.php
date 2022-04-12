<?php
/**
 * IPA Fields Pack Plugin
 *
 * @class    IPA_Fields_Pack_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class LetterboxThumbnails_Plugin
 */
class IPA_Fields_Pack_Plugin {
	public $plugin_settings_option = 'ipa-fields-pack-settings';

	public $default_txt_domain = 'ipa-fields-pack';

	public $plugin_data = NULL;
	public $plugin_settings;

	function __construct() {

	}

	public function get_settings() {
		return json_decode( stripslashes_deep( get_option( $this->plugin_settings_option ) ), true );
	}

	/**
	 * Function return plugin data
	 *
	 * @param null $var
	 *
	 * @return array|bool|mixed|null
	 */
	public function get_data($var = null) {
		if ( ! $this->plugin_data ) {
			if ( function_exists( 'get_plugin_data' ) ) {
				$this->plugin_data = get_plugin_data( IPA_FIELDS_PACK_PATH . '/ipa-fields-pack.php' );
			}
		}

		if (is_null($var)){
			return $this->plugin_data;
		}

		if (!is_null($this->plugin_data)){
			if (is_array( $this->plugin_data ) && isset( $this->plugin_data[$var] )){
				return $this->plugin_data[$var];
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	/**
	 * Return plugin text domain
	 *
	 * @return string
	 */
	public function get_txt_domain() {

		$data = $this->get_data('TextDomain');

		if ( $data  ) {
			return $data;
		} else {
			return $this->default_txt_domain;
		}
	}

	/**
	 * Get the template path.
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'ipa_fields_pack_template_path', 'ipa-fields-pack/' );
	}
}
