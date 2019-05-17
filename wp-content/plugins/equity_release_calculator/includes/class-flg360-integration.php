<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ER_Calculator_Flg360_Integration' ) ):
	class ER_Calculator_Flg360_Integration {
		static function integration ($formData)
		{
			global $wpdb;
			$chips= explode(' ', trim(htmlspecialchars($formData['full_name'])));
			$firstName = $chips[0];
			unset($chips[0]);
			$lastName = empty($chips) ? 'N/A' : implode(' ', $chips);

			$sql = "SELECT * FROM " . $wpdb->prefix . "erc_calculator WHERE id = {$formData['calcId']}";
			$calculator = $wpdb->get_results($sql, ARRAY_A);
			$calculator = $calculator[0];

			$tagFirstName       = get_option('erc_' . $formData['calcId'] . '_flg_firstname');
			$tagLastName        = get_option('erc_' . $formData['calcId'] . '_flg_lastname');
			$tagPhone           = get_option('erc_' . $formData['calcId'] . '_flg_phone');
			$tagEmail           = get_option('erc_' . $formData['calcId'] . '_flg_email');
			$tagAge             = get_option('erc_' . $formData['calcId'] . '_flg_age');
			$tagGender          = get_option('erc_' . $formData['calcId'] . '_flg_gender');
			$tagPropertyValue   = get_option('erc_' . $formData['calcId'] . '_flg_property_value');
			$tagMortgageValue   = get_option('erc_' . $formData['calcId'] . '_flg_mortgage_value');
			$tagNameDeal        = get_option('erc_' . $formData['calcId'] . '_flg_name_deal');
			$tagMaritalStatus   = get_option('erc_' . $formData['calcId'] . '_flg_marital_status');
			$tagAgeOfSpouse     = get_option('erc_' . $formData['calcId'] . '_flg_age_of_spouse');
			$tagNotes           = get_option('erc_' . $formData['calcId'] . '_flg_notes');
			$tagLeadOrigin      = get_option('erc_' . $formData['calcId'] . '_flg_lead_origin');
			$tagIP              = get_option('erc_' . $formData['calcId'] . '_flg_ip');
			$tagIntroducer              = get_option('erc_' . $formData['calcId'] . '_flg_introducer');
			$tagIntroducersFullName              = get_option('erc_' . $formData['calcId'] . '_flg_introducers_full_name');
			$tagIntroducersEmailAddress              = get_option('erc_' . $formData['calcId'] . '_flg_introducers_email_address');
			$tagIntroducersTelephoneNo              = get_option('erc_' . $formData['calcId'] . '_flg_introducers_telephone_no');
			$tagIntroducersLeadSource              = get_option('erc_' . $formData['calcId'] . '_flg_introducers_lead_source');
			$tagPartnerAccount              = get_option('erc_' . $formData['calcId'] . '_flg_partner_account');
			$tagPartnerSubAccount              = get_option('erc_' . $formData['calcId'] . '_flg_partner_sub_account');
			$tagPartnerUserId              = get_option('erc_' . $formData['calcId'] . '_flg_partner_user_id');

			$notes = "";
			if (isset($formData['percent_er'])) {
				$notes .= " % Equity Sold: {$formData['percent_er']} \n";
			}
			if (isset($formData['marital_status'])) {
				$notes .= " Application Status: {$formData['marital_status']} \n";
			}

			$xml = '';
			$xml .= '<?xml version="1.0" encoding="ISO-8859-1"?>';
			$xml .= '<data>';
			$xml .= '    <lead>';
			$xml .= '        <key>' . get_option('erc_' . $formData['calcId'] . '_flg_access_key') . '</key>';
			$xml .= '        <leadgroup>' . get_option('erc_' . $formData['calcId'] . '_flg_lead_group_id') . '</leadgroup>';
			$xml .= '        <site>' . get_option('erc_' . $formData['calcId'] . '_flg_site_id') . '</site>';
			$xml .= '        <source>' . get_option('erc_' . $formData['calcId'] . '_flg_source') . '</source>';
			$xml .= '        <introducer>0</introducer>';
			$xml .= "        <{$tagFirstName}>{$firstName}</{$tagFirstName}>";
			$xml .= "        <{$tagLastName}>{$lastName}</{$tagLastName}>";
			$xml .= "        <{$tagPhone}>"  . htmlspecialchars($formData['phone']) .  "</{$tagPhone}>";
			$xml .= "        <{$tagEmail}>"  . htmlspecialchars($formData['email']) .  "</{$tagEmail}>";
			$xml .= "        <{$tagAge}>"  . htmlspecialchars($formData['age']) .  "</{$tagAge}>";
			$xml .= "        <{$tagLeadOrigin}>"  . get_option('erc_' . $formData['calcId'] . '_email_subject') .  "</{$tagLeadOrigin}>";
			if (!empty($notes)) {
				$xml .= "        <{$tagNotes}>"  . htmlspecialchars($notes) .  "</{$tagNotes}>";
			}
			if (isset($formData['gender'])) {
				$xml .= "    <{$tagGender}>"  . ($formData['gender'] == 'male' ? 'Male' : 'Female') .  "</{$tagGender}>";
			}
			$xml .= "        <{$tagPropertyValue}>"  . (float) str_replace(array('£', ' '), '',$formData['property_value']) .  "</{$tagPropertyValue}>";
			$xml .= "        <{$tagMortgageValue}>"  . (float) str_replace(array('£', ' '), '',$formData['mortage']) .  "</{$tagMortgageValue}>";
			$xml .= "        <{$tagNameDeal}>"  . htmlspecialchars($formData['calc_name']) .  "</{$tagNameDeal}>";
			$xml .= "        <{$tagMaritalStatus}>"  . htmlspecialchars($formData['marital_status']) .  "</{$tagMaritalStatus}>";
			$xml .= "        <{$tagAgeOfSpouse}>"  . htmlspecialchars($formData['age_spouse']) .  "</{$tagAgeOfSpouse}>";
			if (!empty($calculator['introducer'])) {
				$xml .= "        <{$tagIntroducer}>" . htmlspecialchars($calculator['introducer']) . "</{$tagIntroducer}>";
			}
			$xml .= "        <{$tagIntroducersFullName}>"  . htmlspecialchars($calculator['introducers_full_name']) .  "</{$tagIntroducersFullName}>";
			if (!empty($calculator['introducers_email_address'])) {
				$xml .= "        <{$tagIntroducersEmailAddress}>"  . htmlspecialchars($calculator['introducers_email_address']) .  "</{$tagIntroducersEmailAddress}>";
			}
			if (!empty($calculator['introducers_telephone_no'])) {
				$xml .= "        <{$tagIntroducersTelephoneNo}>" . htmlspecialchars($calculator['introducers_telephone_no']) . "</{$tagIntroducersTelephoneNo}>";
			}
			if (!empty($calculator['introducers_lead_source'])) {
				$xml .= "        <{$tagIntroducersLeadSource}>" . htmlspecialchars($calculator['introducers_lead_source']) . "</{$tagIntroducersLeadSource}>";
			}
			if (!empty($calculator['partner_account'])) {
				$xml .= "        <{$tagPartnerAccount}>" . htmlspecialchars($calculator['partner_account']) . "</{$tagPartnerAccount}>";
			}
			if (!empty($calculator['partner_sub_account'])) {
				$xml .= "        <{$tagPartnerSubAccount}>" . htmlspecialchars($calculator['partner_sub_account']) . "</{$tagPartnerSubAccount}>";
			}
			if (!empty($calculator['partner_user_id'])) {
				$xml .= "        <{$tagPartnerUserId}>" . htmlspecialchars($calculator['partner_user_id']) . "</{$tagPartnerUserId}>";
			}
			$xml .= "        <{$tagIP}>"  . $_SERVER['REMOTE_ADDR'] .  "</{$tagIP}>";
			$xml .= "        <contactphone>yes</contactphone>";
			$xml .= "        <contactemail>yes</contactemail>";
			$xml .= "        <contactsms>yes</contactsms>";
			$xml .= "        <contactmail>yes</contactmail>";
			$xml .= "        <contactfax>yes</contactfax>";
			$xml .= '    </lead>';
			$xml .= '</data>';

			$ch = curl_init( "https://equityrelease.flg360.co.uk/api/APILeadCreateUpdate.php" );
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-type: text/xml' ) );

			$result = curl_exec( $ch );

			if ( curl_errno( $ch ) ) {
				return false;
			} else {
				$returnCode = (int) curl_getinfo( $ch, CURLINFO_HTTP_CODE );
				switch ( $returnCode ) {
					case 200:
						$dom = new DOMDocument( '1.0', 'iso-8859-1' );
						$dom->loadXML( $result );

						if ( $dom->getElementsByTagName( 'code' )->item( 0 )->textContent == "0" ) {
							return $dom->getElementsByTagName( 'id' )->item( 0 )->textContent;
						} else {
							return false;
						}

						break;
					default:
						return false;
						break;
				}
			}
		}

		static function home_reversion_integration( $formData ) {
			$chips     = explode( ' ', trim( htmlspecialchars( $formData['full_name'] ) ) );
			$firstName = $chips[0];
			unset( $chips[0] );
			$lastName = empty( $chips ) ? 'N/A' : implode( ' ', $chips );

			$xml = '';
			$xml .= '<?xml version="1.0" encoding="ISO-8859-1"?>';
			$xml .= '<data>';
			$xml .= '    <lead>';
			$xml .= '        <key>' . get_option( 'erc_' . $formData['calcId'] . '_flg_access_key' ) . '</key>';
			$xml .= '        <leadgroup>' . get_option( 'erc_' . $formData['calcId'] . '_flg_lead_group_id' ) . '</leadgroup>';
			$xml .= '        <site>' . get_option( 'erc_' . $formData['calcId'] . '_flg_site_id' ) . '</site>';
			$xml .= '        <source>' . get_option( 'erc_' . $formData['calcId'] . '_flg_source' ) . '</source>';
			$xml .= '        <introducer>0</introducer>';
			$xml .= '        <firstname>' . $firstName . '</firstname>';
			$xml .= '        <lastname>' . $lastName . '</lastname>';
			$xml .= '        <phone1>' . htmlspecialchars( $formData['phone'] ) . '</phone1>';
			$xml .= '        <email>' . htmlspecialchars( $formData['email'] ) . '</email>';
			$xml .= '        <data1>' . htmlspecialchars( $formData['age'] ) . '</data1>';
			$xml .= '        <data2>' . (float) str_replace( array(
					'£',
					' '
				), '', $formData['property_value'] ) . '</data2>';//[Currency](Value Of Your Property?)
			$xml .= '        <data4>' . (float) str_replace( array(
					'£',
					' '
				), '', $formData['mortage'] ) . '</data4>';//[Currency](Value Of Your Property?)
			$xml .= '        <data8>' . htmlspecialchars( $formData['calc_name'] ) . '</data8>';//<data8>[Text](Name Of The Deal?)</data8>

			if (htmlspecialchars( $formData['marital_status'] ) != 'single'){
				$xml .= '<data20>' .  htmlspecialchars( $formData['age_spouse'] ) . '</data20>';
			}

			$xml .= '<data48>' . ucfirst(htmlspecialchars( $formData['gender'] )) . '</data48>';
			$xml .= '        <data15> <![CDATA[';
			$xml .= get_option( 'erc_' . $formData['calcId'] . '_title_status' ) . ' ' . htmlspecialchars( $formData['marital_status'] ) . ' | ';

			$xml .= get_option( 'erc_' . $formData['calcId'] . '_title_percent' ) . ' ' . htmlspecialchars( $formData['percent_er'] ) . ' | ';
			//$xml .=             get_option('erc_' . $formData['calcId'] . '_result_label_standard') . ' ' . htmlspecialchars($formData['standard']) . ' | ';
			//$xml .=             get_option('erc_' . $formData['calcId'] . '_result_label_enhanced') . ' ' . htmlspecialchars($formData['enhanced']) . ' | ';
			//$xml .=             get_option('erc_' . $formData['calcId'] . '_result_label_interest_only') . ' ' . htmlspecialchars($formData['interest_only']) . ' | ';
			//$xml .=             get_option('erc_' . $formData['calcId'] . '_result_label_home_reversion') . ' ' . htmlspecialchars($formData['home_reversion']) . ' | ';
			$xml .= '       ]]></data15>';//<data17>[Textlong](NOTES)</data17>
			//$xml .= '       <data18>' . htmlspecialchars( $formData['marital_status'] ) . '</data18>';//<data21>[Text](Application Status)</data21>
			//$xml .= '       <data19>' . htmlspecialchars( $formData['marital_status'] ) . '</data19>';//<data22>[Text](Age of Spouse)</data22>
			$xml .= '        <ipaddress>' . $_SERVER['REMOTE_ADDR'] . '</ipaddress>';
			$xml .= "        <contactphone>yes</contactphone>";
			$xml .= "        <contactemail>yes</contactemail>";
			$xml .= "        <contactsms>yes</contactsms>";
			$xml .= "        <contactmail>yes</contactmail>";
			$xml .= "        <contactfax>yes</contactfax>";
			$xml .= '    </lead>';
			$xml .= '</data>';

			$ch = curl_init( "https://equityrelease.flg360.co.uk/api/APILeadCreateUpdate.php" );
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			//curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-type: text/xml' ) );

			$result = curl_exec( $ch );

			if ( curl_errno( $ch ) ) {
				return false;
			} else {
				$returnCode = (int) curl_getinfo( $ch, CURLINFO_HTTP_CODE );
				switch ( $returnCode ) {
					case 200:
						$dom = new DOMDocument( '1.0', 'iso-8859-1' );
						$dom->loadXML( $result );

						if ( $dom->getElementsByTagName( 'code' )->item( 0 )->textContent == "0" ) {
							return $dom->getElementsByTagName( 'id' )->item( 0 )->textContent;
						} else {
							return false;
						}

						break;
					default:
						return false;
						break;
				}
			}
		}

		static function default_integration( $formData ) {
			$chips     = explode( ' ', trim( htmlspecialchars( $formData['full_name'] ) ) );
			$firstName = $chips[0];
			unset( $chips[0] );
			$lastName = empty( $chips ) ? 'N/A' : implode( ' ', $chips );

			$xml = '';
			$xml .= '<?xml version="1.0" encoding="ISO-8859-1"?>';
			$xml .= '<data>';
			$xml .= '    <lead>';
			$xml .= '        <key>' . get_option( 'erc_' . $formData['calcId'] . '_flg_access_key' ) . '</key>';
			$xml .= '        <leadgroup>' . get_option( 'erc_' . $formData['calcId'] . '_flg_lead_group_id' ) . '</leadgroup>';
			$xml .= '        <site>' . get_option( 'erc_' . $formData['calcId'] . '_flg_site_id' ) . '</site>';
			$xml .= '        <source>' . get_option( 'erc_' . $formData['calcId'] . '_flg_source' ) . '</source>';
			$xml .= '        <introducer>0</introducer>';
			$xml .= '        <firstname>' . $firstName . '</firstname>';
			$xml .= '        <lastname>' . $lastName . '</lastname>';
			$xml .= '        <phone1>' . htmlspecialchars( $formData['phone'] ) . '</phone1>';
			$xml .= '        <email>' . htmlspecialchars( $formData['email'] ) . '</email>';
			$xml .= '        <data1>' . htmlspecialchars( $formData['age'] ) . '</data1>';
			$xml .= '        <data2>' . (float) str_replace( array(
					'£',
					' '
				), '', $formData['property_value'] ) . '</data2>';//[Currency](Value Of Your Property?)
			$xml .= '        <data4>' . (float) str_replace( array(
					'£',
					' '
				), '', $formData['mortage'] ) . '</data4>';//[Currency](Value Of Your Property?)
			$xml .= '        <data8>' . htmlspecialchars( $formData['calc_name'] ) . '</data8>';//<data8>[Text](Name Of The Deal?)</data8>

			$xml .= '        <ipaddress>' . $_SERVER['REMOTE_ADDR'] . '</ipaddress>';
			$xml .= "        <contactphone>yes</contactphone>";
			$xml .= "        <contactemail>yes</contactemail>";
			$xml .= "        <contactsms>yes</contactsms>";
			$xml .= "        <contactmail>yes</contactmail>";
			$xml .= "        <contactfax>yes</contactfax>";
			$xml .= '    </lead>';
			$xml .= '</data>';

			$ch = curl_init( "https://equityrelease.flg360.co.uk/api/APILeadCreateUpdate.php" );
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			//curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-type: text/xml' ) );

			$result = curl_exec( $ch );

			if ( curl_errno( $ch ) ) {
				return false;
			} else {
				$returnCode = (int) curl_getinfo( $ch, CURLINFO_HTTP_CODE );
				switch ( $returnCode ) {
					case 200:
						$dom = new DOMDocument( '1.0', 'iso-8859-1' );
						$dom->loadXML( $result );

						if ( $dom->getElementsByTagName( 'code' )->item( 0 )->textContent == "0" ) {
							return $dom->getElementsByTagName( 'id' )->item( 0 )->textContent;
						} else {
							return false;
						}

						break;
					default:
						return false;
						break;
				}
			}
		}
	}
endif;