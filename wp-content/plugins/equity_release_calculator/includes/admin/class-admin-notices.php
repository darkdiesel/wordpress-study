<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Admin_Notices' ) ):
	class ER_Calculator_Admin_Notices {
		private static $notice_option = 'erc_messages';


		private static  $type_class = array(
			'updated' => 'updated',
			'error' => 'notice-error'
		);

		const ERROR = 'error';
		const UPDATED = 'updated';

		static function check_relation_plugin() {
			if ( ! is_plugin_active( 'ipa-post-meta/ipa-post-meta.php' ) ) {
				if ( current_user_can( 'install_plugins' ) ) {
					$class   = 'notice notice-error';
					$message = __( '<strong>Error!</strong> Plugin <strong>ER Calculator</strong> required <strong>IPA Post Meta</strong> plugin for correct work!', ER_Calculator()->plugin->get_text_domain() );

					printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
				}
			}
		}

		/**
		 *
		 * return html of plugin notices
		 *
		 * @return string
		 */
		static function get_notices_html(){
			ob_start();

			$notices = self::get_notices();

			if (empty($notices)) {
				return;
			}
			?>

            <?php foreach ($notices as $notice_type => $messages) : ?>
                <?php foreach ($messages as $message) : ?>
                    <div class="notice <?php echo self::get_notice_class($notice_type); ?>">
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
		static function get_notices(){
			return unserialize(get_option(self::$notice_option));
		}

		/**
		 * @param array $notices
		 *
		 * @return bool|mixed
		 */
		static function update_notices($notices){
			return update_option(self::$notice_option, serialize($notices));
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
		static function add_notice($message, $type = 'updated'){
			$notices = self::get_notices();

		    if (empty($notices)){
				$notices = array();
			}

			if (empty($notices[$type])){
				$notices[$type] = array();
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
		static function get_notice_class($type){
			if (isset(self::$type_class[$type])){
				return self::$type_class[$type];
			} else {
				return '';
			}
		}
	}
endif;