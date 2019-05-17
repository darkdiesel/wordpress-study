<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Mail' ) ):
	class ER_Calculator_Mail {
		static function set_html_content_type()
		{
			return 'text/html';
		}

		static function set_html_content_charset()
		{
			return 'utf-8';
		}

		static function create_template( $message = '', $table_data = array(), $data = array() ) {
			ob_start(); ?>
			<html>
			<body>

			<?php if ( $message ) : ?>
				<?= $message; ?> <br/><br/>
			<?php endif; ?>

			<table>
				<tbody>
				<tr>
					<td><strong><?= _( 'Date:' ); ?></strong></td>
					<td><?= date( 'r' ); ?></td>
				</tr>
				<?php if ( count( $table_data ) ) : ?>
					<?php foreach ( $table_data as $label => $value ) : ?>
						<tr>
							<td><strong><?= str_replace(array('*', ':', ';'), '',$label); ?></strong></td>
							<td><?= htmlspecialchars( $value ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				<tr>
					<td><strong><?= _( 'IP:' ); ?></strong></td>
					<td><?= $_SERVER['REMOTE_ADDR']; ?></td>
				</tr>
				</tbody>
			</table>
			<?php foreach ($data as $item): ?>
				<?php if ($item): ?>
					<br>
					<strong><?= $item; ?></strong>
				<?php endif; ?>
			<?php endforeach; ?>

			</body>
			</html>
			<?php
			return ob_get_clean();
		}

		static function send_email( $formData, $leadID ) {

			if ( $leadID ) {
				$message = sprintf( 'Lead ID: <a href="%s/bo/BOSearchLeads.php#p=1&k=%s">%s</a> has been created on FLG360.', 'http://equityrelease.flg360.co.uk', $leadID, $leadID );
			} else {
				$message = '';
			}

			$table_data = array(
				get_option( 'erc_' . $formData['calcId'] . '_title_fullname' )              => $formData['full_name'],
				get_option( 'erc_' . $formData['calcId'] . '_title_age' )                   => $formData['age'],
				get_option( 'erc_' . $formData['calcId'] . '_title_email' )                 => $formData['email'],
				get_option( 'erc_' . $formData['calcId'] . '_title_telephone' )             => $formData['phone'],
				get_option( 'erc_' . $formData['calcId'] . '_title_status' )                => $formData['marital_status'],
				get_option( 'erc_' . $formData['calcId'] . '_title_age_hr' )                => $formData['age_spouse'],
				get_option( 'erc_' . $formData['calcId'] . '_title_gender' )                => $formData['gender'],
				get_option( 'erc_' . $formData['calcId'] . '_title_percent' )               => $formData['percent_er'],
				get_option( 'erc_' . $formData['calcId'] . '_title_property_value' )        => $formData['property_value'],
				get_option( 'erc_' . $formData['calcId'] . '_title_mortgage' )              => $formData['mortage'],
				get_option( 'erc_' . $formData['calcId'] . '_result_label_standard' )       => htmlspecialchars( $formData['standard'] ),
				get_option( 'erc_' . $formData['calcId'] . '_result_label_enhanced' )       => $formData['enhanced'],
				get_option( 'erc_' . $formData['calcId'] . '_result_label_interest_only' )  => $formData['interest_only'],
				get_option( 'erc_' . $formData['calcId'] . '_result_label_home_reversion' ) => $formData['home_reversion'],
				'Notes'                                                                     =>
					get_option( 'erc_' . $formData['calcId'] . '_title_status' ) . ': ' . htmlspecialchars( $formData['marital_status'] ) . '| ' .
					get_option( 'erc_' . $formData['calcId'] . '_title_percent' ) . ': ' . htmlspecialchars( $formData['percent_er'] )
			);

			$data = array(
				get_option('erc_' . $formData['calcId'] . '_email_text_footer')
			);

			$template = self::create_template( $message, $table_data,  $data);

			$from = get_option( 'erc_' . $formData['calcId'] . '_email_from' );

			add_filter( 'wp_mail_content_type',
				array( __CLASS__, 'set_html_content_type' ) );
			add_filter( 'wp_mail_charset',
				array( __CLASS__, 'set_html_content_charset' ) );

			$email = wp_mail(
				get_option( 'erc_' . $formData['calcId'] . '_email_to' ),
				get_option( 'erc_' . $formData['calcId'] . '_email_subject' ),
				$template,
				array(
					'From: ' . $from,
					'X-Return-Path: mark@equityreleasesupermarket.co.uk',
					'Error-to: mark@equityreleasesupermarket.co.uk',
				)
			);

			// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
			remove_filter( 'wp_mail_content_type',
				array( __CLASS__, 'set_html_content_type' ) );
			remove_filter( 'wp_mail_charset',
				array( __CLASS__, 'set_html_content_charset' ) );

			return $email;
		}

		static function send_user_email( $formData ) {
			$template_option = get_option( 'erc_' . $formData['calcId'] . '_user_email_template' );

			switch ( $template_option ) {
				case 'default':
					$template_name = 'mail-Calculator-Results.php';
					break;
				case 'home_reversion':
					$template_name = 'mail-Reversion-Calculator.php';
					break;
				default:
					$template_name = 'mail-Calculator-Results.php';
					break;
			}

			$data = array(
				'STANDARD'       => number_format( esc_attr( $formData['standard'] ), 0, '.', ',' ),
				'ENHANCED'       => number_format( esc_attr( $formData['enhanced'] ), 0, '.', ',' ),
				'INTEREST'       => number_format( esc_attr( $formData['interest_only'] ), 0, '.', ',' ),
				'HOME_REVERSION' => number_format( esc_attr( $formData['home_reversion'] ), 0, '.', ',' )
			);

			$template = self::get_email_template( $template_name, $data );

			$from = get_option( 'erc_' . $formData['calcId'] . '_user_email_from' );

			add_filter( 'wp_mail_content_type',
				array( __CLASS__, 'set_html_content_type' ) );
			add_filter( 'wp_mail_charset',
				array( __CLASS__, 'set_html_content_charset' ) );

			$email = wp_mail(
				sprintf( '%s <%s>', esc_attr( $formData['full_name'] ), esc_attr( $formData['email'] ) ),
				get_option( 'erc_' . $formData['calcId'] . '_user_email_subject' ),
				$template,
				array(
					'From: ' . $from,
					'X-Return-Path: mark@equityreleasesupermarket.co.uk',
					'Error-to: mark@equityreleasesupermarket.co.uk'
				)
			);

			// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
			remove_filter( 'wp_mail_content_type',
				array( __CLASS__, 'set_html_content_type' ) );
			remove_filter( 'wp_mail_charset',
				array( __CLASS__, 'set_html_content_charset' ) );

			return $email;
		}

		/**
		 * @param string $template
		 * @param array   $vars
		 *
		 * @return string email template html
		 */
		static function get_email_template( $template, $vars = array() ) {
			ob_start();
			ER_Calculator()->functions->get_template(
				'email/'.$template,
				$vars
			);
			return ob_get_clean();
		}
	}
endif;