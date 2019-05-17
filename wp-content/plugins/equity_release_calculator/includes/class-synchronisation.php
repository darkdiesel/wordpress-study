<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Synchronisation' ) ):
	class ER_Calculator_Synchronisation {
		static function send_request($action, $data_type, $data) {
			$settings = ER_Calculator()->plugin->get_sync_settings();

			if (!$settings['enable'] || $settings['site_type'] != ER_Calculator_Plugin::SYNC_SITE_TYPE_PARENT || !in_array($data_type, $settings['data_types'])){
				return FALSE;
			}

			$sites_list = preg_split('/\r\n|[\r\n]/', $settings['sites']);

			$post_fields = http_build_query( array(
				'action' => $action,
				'data_type' => $data_type,
				'data' => $data
			) );

			$response = array();

			foreach ( $sites_list as $site ) {
				if ( ! $site ) {
					continue;
				}

				$ch = curl_init();

				if ( $settings['logger'] ) {
					ER_Calculator_Logger::log( sprintf( 'Send update request to %s', $site ) );
				}

				curl_setopt( $ch, CURLOPT_URL, $site . '/?erc_data_synchronisation&secret=' . $settings['secure'] );
				curl_setopt( $ch, CURLOPT_POST, 1 );
				//curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_fields );
				//curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' ) );

				if ( $settings['ignore_ssl'] ) {
					curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				}

				$result = curl_exec( $ch );

				// Check for errors
				if ( $result === false ) {
					$response[ $site ] = array(
						'status' => false,
						'error'  => curl_error( $ch )
					);

				} else {
					$response[ $site ] = array( 'status' => true );
				}

				curl_close( $ch );
			}

			return $response;
		}

		static function get_request(){
			if ( isset( $_GET['erc_data_synchronisation'] ) && isset($_GET['secret']) ) {

				$settings = ER_Calculator()->plugin->get_sync_settings();

				if ( ( ! $settings['enable'] ) || ( $settings['secure'] != $_GET['secret'] ) ) {
					ER_Calculator_Logger::log( 'Sync disabled or security phrase incorrect' );
					return FALSE;
				}

				if ( $_POST ) {
					if (isset($_POST['action']) & isset($_POST['data_type'])){

						if (!in_array($_POST['data_type'], $settings['data_types'])){
							exit( header( "Status: 200 OK" ) );
						}

						if ($settings['logger']){
							ER_Calculator_Logger::log(sprintf('Request to %s %s',$_POST['action'], $_POST['data_type']));
						}

						$data =  isset($_POST['data']) ? $_POST['data'] : array();

						ER_Calculator_Logger::log(sprintf('Requested data %s', print_r($data, TRUE)));

						switch ($_POST['data_type']){
							case 'age':
								include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-ages-model.php' );

								switch ($_POST['action']){
									case 'add':
										ER_Calculator_Model_Ages::insert($data);
										break;
									case 'update':
										$id = isset($data['id']) ? $data['id'] : 0;

										if ($id) {
											ER_Calculator_Model_Ages::update( $data, array( 'id' => $id ) );
										}
										break;
									case 'delete':
										$id = isset($data['id']) ? $data['id'] : 0;

										if ($id) {
											ER_Calculator_Model_Ages::delete( array( 'id' => $id ) );
										}
										break;
									case 'all':
										ER_Calculator_Model_Ages::delete_all();
										foreach ($data as $item){
											ER_Calculator_Model_Ages::insert($item);
										}
										break;
								}
								break;
							case 'percentage':
								include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-model.php' );

								switch ($_POST['action']){
									case 'add':
										ER_Calculator_Model_Percentages::insert($data);
										break;
									case 'update':
										$id = isset($data['id']) ? $data['id'] : 0;

										if ($id) {
											ER_Calculator_Model_Percentages::update( $data, array( 'id' => $id ) );
										}
										break;
									case 'delete':
										$id = isset($data['id']) ? $data['id'] : 0;

										if ($id) {
											ER_Calculator_Model_Percentages::delete( array( 'id' => $id ) );
										}
										break;
									case 'all':
										ER_Calculator_Model_Percentages::delete_all();
										foreach ($data as $item){
											unset($item['age']);
											ER_Calculator_Model_Percentages::insert($item);
										}
										break;
								}
								break;
							case 'percentage_hr':
								include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-hr-model.php' );

								switch ($_POST['action']){
									case 'add':
										ER_Calculator_Model_Percentages_HR::insert($data);
										break;
									case 'update':
										$id = isset($data['id']) ? $data['id'] : 0;

										if ($id) {
											ER_Calculator_Model_Percentages_HR::update( $data, array( 'id' => $id ) );
										}
										break;
									case 'delete':
										$id = isset($data['id']) ? $data['id'] : 0;

										if ($id) {
											ER_Calculator_Model_Percentages_HR::delete( array( 'id' => $id ) );
										}
										break;
									case 'all':
										ER_Calculator_Model_Percentages_HR::delete_all();
										foreach ($data as $item){
											unset($item['age']);
											ER_Calculator_Model_Percentages_HR::insert($item);
										}
										break;
								}
								break;
							case 'calculator':
								include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-calculators-model.php' );

								switch ($_POST['action']){
									case 'add':
										ER_Calculator_Model_Calculators::insert($data);
										break;
									case 'update':
										$id = isset($data['id']) ? $data['id'] : 0;

										if ($id) {
											ER_Calculator_Model_Calculators::update( $data, array( 'id' => $id ) );
										}
										break;
									case 'delete':
										$id = isset($data['id']) ? $data['id'] : 0;

										if ($id) {
											ER_Calculator_Model_Calculators::delete( array( 'id' => $id ) );
										}
										break;
									case 'all':
										ER_Calculator_Model_Calculators::delete_all();
											foreach ($data as $item){
												ER_Calculator_Model_Calculators::insert($item);
											}
										break;
								}
								break;
						}
					}
				}

				exit( header( "Status: 200 OK" ) );
			}
		}

		public static function download_image($file){
			$settings = ER_Calculator()->plugin->get_sync_settings();

			if ($settings['logger']){
				ER_Calculator_Logger::log(sprintf('Try download img file %s',$file));
			}

			$handle = curl_init($file);
			curl_setopt($handle, CURLOPT_CONNECTTIMEOUT ,5);
			curl_setopt($handle, CURLOPT_TIMEOUT, 10); //timeout in seconds
			curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

			if ( $settings['ignore_ssl'] ) {
				curl_setopt( $handle, CURLOPT_SSL_VERIFYHOST, false );
				curl_setopt( $handle, CURLOPT_SSL_VERIFYPEER, false );
			}

			/* Get the HTML or whatever is linked in $url. */
			$curl_response = curl_exec($handle);

			/* Check for 404 (file not found). */
			$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

			if ($settings['logger']){
				ER_Calculator_Logger::log(sprintf('HTTP code is: %s',$httpCode));
			}

			if($httpCode == 200) {
				$upload_file = wp_upload_bits( basename($file), null, $curl_response);

				if ( ! $upload_file['error'] ) {
					// get file name
					$filename = basename($upload_file['file']);

					// get file type
					$wp_filetype = wp_check_filetype($filename, null );

					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
						'post_content' => '',
						'post_status' => 'inherit'
					);

					// insert attachment and get id of it
					$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );

					if (!is_wp_error($attachment_id)) {

						if ($settings['logger']){
							ER_Calculator_Logger::log(sprintf('Attachment saved in db with id : %s',$attachment_id));
						}

						require_once(ABSPATH . "wp-admin" . '/includes/image.php');

						$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
						wp_update_attachment_metadata( $attachment_id,  $attachment_data );
					}

					$result = array(
						'status' => TRUE,
						'attachment_id' => $attachment_id,
						'file' => $upload_file
					);
				} else {
					// file not uploaded
					$result = array(
						'status' => FALSE,
					);
				}
			} else {
				// file not downloaded
				$result = array(
					'status' => false,
				);
			}

			curl_close($handle);

			return $result;
		}

		public static function sync_data() {
			if ( ! isset( $_POST['wpnonce'] ) || ! wp_verify_nonce( $_POST['wpnonce'], 'erc_menu_sync_data_wpnonce' ) ) {
				die( _( 'Permission check failed' ) );
			}

			$data = isset( $_POST['type'] ) ? $_POST['type'] : '';

			$result = FALSE;

			switch ($data){
				case 'age':
					include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-ages-model.php' );

					$items = ER_Calculator_Model_Ages::get_all();

					$result = ER_Calculator_Synchronisation::send_request('all', 'age', $items);
					break;
				case 'percentage':
					include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-model.php' );

					$items = ER_Calculator_Model_Percentages::get_all();

					$result = ER_Calculator_Synchronisation::send_request('all', 'percentage', $items);
					break;
				case 'percentage_hr':
					include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-percentages-hr-model.php' );

					$items = ER_Calculator_Model_Percentages_HR::get_all();

					$result = ER_Calculator_Synchronisation::send_request('all', 'percentage_hr', $items);
					break;
				case 'calculator':
					include_once( ER_CALCULATOR_PATH . '/includes/model/class-erc-calculators-model.php' );

					$items = ER_Calculator_Model_Calculators::get_all();

					$result = ER_Calculator_Synchronisation::send_request('all', 'calculator', $items);
					break;
			}

			//create response
			$response = array();

			$response['ajax']    = 'success';
			if ( $result ) {
				$response['message'] = sprintf( '<strong>%s %s %s</strong>', __( 'Data' ), $data,  __('successfully synced'));
			}

			//return json
			echo json_encode( $response );

			die();
		}
	}
endif;

add_action( 'init', array('ER_Calculator_Synchronisation', 'get_request') );

add_action( "wp_ajax_erc_sync_all_data", array(
	'ER_Calculator_Synchronisation',
	'sync_data'
) );