<?php
/**
 * IPA Fields Pack Admin Notices
 *
 * @class    IPA_Fields_Pack_Admin_Notices
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class IPA_Fields_Pack_Admin_Notices
 */
class IPA_Fields_Pack_Admin_Notices {
	private static $notice_option = 'ipa-fields-pack-flash-messages';

	const ERROR = 'error';
	const UPDATED = 'updated';

	private static $type_class = array(
		'updated' => 'updated',
		'error'   => 'notice-error'
	);

	static function check_relation_plugin() {

	}

	/**
	 *
	 * return html of plugin notices
	 *
	 * @return string
	 */
	static function get_notices_html() {
		ob_start();

		$notices = self::get_notices();

		if ( empty( $notices ) ) {
			return;
		}
		?>

		<?php foreach ( $notices as $notice_type => $messages ) : ?>
			<?php foreach ( $messages as $message ) : ?>
                <div class="notice <?php echo self::get_notice_class( $notice_type ); ?>">
                    <p><?php echo $message; ?></p>
                </div>
			<?php endforeach; ?>
		<?php endforeach; ?>

		<?php

		self::delete_notices();

		return ob_get_clean();
	}

	/**
	 *
	 * Return notices array
	 *
	 * @return array
	 */
	static function get_notices() {
		return unserialize( get_option( self::$notice_option ) );
	}

	/**
	 * @param array $notices
	 *
	 * @return bool|mixed
	 */
	static function update_notices( $notices ) {
		return update_option( self::$notice_option, serialize( $notices ) );
	}

	/**
	 * Delete option with notices
	 *
	 * @return bool
	 */
	static function delete_notices() {
		return delete_option( self::$notice_option );
	}

	/**
	 * @param string $message
	 * @param string $type
	 *
	 * @return bool|mixed
	 */
	static function add_notice( $message, $type = 'updated' ) {
		$notices = self::get_notices();

		if ( empty( $notices ) ) {
			$notices = array();
		}

		if ( empty( $notices[ $type ] ) ) {
			$notices[ $type ] = array();
		}

		$notices[ $type ][] = $message;

		return self::update_notices( $notices );
	}

	/**
	 *
	 * Return html class for notice type. Used for printing and visual formation
	 *
	 * @param $type
	 *
	 * @return mixed|string
	 */
	static function get_notice_class( $type ) {
		if ( isset( self::$type_class[ $type ] ) ) {
			return self::$type_class[ $type ];
		} else {
			return '';
		}
	}
}