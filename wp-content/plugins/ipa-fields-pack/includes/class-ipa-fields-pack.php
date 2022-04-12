<?php
/**
 * IPA Fields Pack Main Class
 *
 * @class    IPA_Fields_Pack
 */

defined( 'ABSPATH' ) || exit;

class IPA_Fields_Pack {
	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * @var IPA_Fields_Pack The single instance of the class
	 */
	protected static $_instance = NULL;

	/**
	 * @var IPA_Fields_Pack_Plugin class instance
	 */
	public $plugin = null;

	/**
	 * @var ER_Calculator_Core_Functions class instance
	 */
	public $functions = null;


	/**
	 * LetterboxThumbnails constructor.
	 */
	function __construct() {
		if ( defined( 'IPA_FIELDS_PACK_VERSION' ) ) {
			$this->version = IPA_FIELDS_PACK_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		$this->define_constants();
		$this->includes();
		$this->init_hooks();
		$this->set_locale();
	}

	/**
	 * Initialization function to hook into the WordPress init action
	 *
	 * Instantiates the class on a global variable and sets the class, actions
	 * etc. up for use.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Load Constants
	 *
	 * Convenience function to load the constants files for
	 * the activation and construct
	 */
	private function define_constants() {
		if ( ! defined( 'IPA_FIELDS_PACK_PATH' ) ) {
			define( 'IPA_FIELDS_PACK_PATH', dirname( IPA_FIELDS_PACK_PLUGIN_FILE ) . '/' );
		}

		if ( ! defined( 'IPA_FIELDS_PACK_TEMPLATES_PATH' ) ) {
			define( 'IPA_FIELDS_PACK_TEMPLATES_PATH', IPA_FIELDS_PACK_PATH . 'templates/' );
		}

		if ( ! defined( 'IPA_FIELDS_PACK_URL' ) ) {
			define( 'IPA_FIELDS_PACK_URL', plugin_dir_url( IPA_FIELDS_PACK_PLUGIN_FILE ) . '/' );
		}

		if ( ! defined( 'IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME' ) ) {
			define( 'IPA_FIELDS_PACK_CUSTOM_TAXONOMIES_OPTION_NAME', 'ipa-fields-pack-custom-taxonomies' );
		}
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		include_once IPA_FIELDS_PACK_PATH . 'includes/class-ipa-fields-pack-plugin.php';
		include_once IPA_FIELDS_PACK_PATH . 'includes/class-ipa-fields-pack-functions.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		include_once IPA_FIELDS_PACK_PATH . 'includes/class-ipa-fields-pack-i18n.php';

		if ( $this->is_request( 'admin' ) ) {
			/**
			 * The class responsible for defining all actions that occur in the admin area.
			 */
			include_once IPA_FIELDS_PACK_PATH . 'includes/admin/class-ipa-fields-pack-admin.php';
		}

		include_once IPA_FIELDS_PACK_PATH . 'includes/taxonomy/class-ipa-fields-pack-taxonomy.php';

		$this->plugin    = new IPA_Fields_Pack_Plugin();
		$this->functions = new IPA_Fields_Pack_Functions();
	}

	/**
	 * Add in various hooks
	 *
	 * Place all add_action, add_filter, add_shortcode hook-ins here
	 */
	private function init_hooks() {
		add_filter( 'plugin_action_links_' . plugin_basename( IPA_FIELDS_PACK_PLUGIN_FILE ), array(
			__CLASS__,
			'plugin_action_links'
		), 10, 2 );

		add_filter( 'plugin_row_meta', array(
			__CLASS__,
			'plugin_row_meta'
		), 10, 4 );
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the IPA_Fields_Pack_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		add_action( 'plugins_loaded', array('IPA_Fields_Pack_i18n', 'load_plugin_textdomain') );
	}

	/**
	 * What type of request is this?
	 *
	 * @param string $type admin, ajax, cron or frontend.
	 *
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	static function plugin_action_links( $links ) {
		array_unshift( $links, sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=ipa-fields-pack-settings' ), __( 'Settings', LetterboxThumbnails()->plugin->get_txt_domain() ) ) );

		return $links;
	}

	static function plugin_row_meta( $links, $file ) {
		if ( plugin_basename( __FILE__ ) === $file ) {
			$links[] = sprintf( '<a target="_blank" href="%s">%s</a>', esc_url( 'http://www.donationalerts.ru/r/dark_diesel' ), __( 'Donate', LetterboxThumbnails()->plugin->get_txt_domain() ) );
		}

		return $links;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}