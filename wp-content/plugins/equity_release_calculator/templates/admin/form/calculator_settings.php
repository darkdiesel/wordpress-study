<?php
/**
 * @var array $erc_calculator
 */
?>

<?php
$nonce_action
	= ER_Calculator_Calculator_Actions_Handler::$nonce_action_settings;
?>

<style type="text/css">
    table tr.header{
        background-color: #d3d3d3;
    }

    table tr th {
        text-align: left;
    }

    table tr.header th {
        font-weight: bold;
    }
</style>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <p class="submit">
        <input type='hidden' value="<?php echo !empty($erc_calculator['id']) ? $erc_calculator['id'] : '' ?>" name="erc_calculator_settings[id]" />
        <input class="button button-primary" type="submit" name="erc_calculator_settings[<?php echo $action;?>]" value="<?php _e('Save', ER_Calculator()->plugin->get_text_domain()); ?>" />
    </p>

    <div class="panel-group" id="accordion">
        <!-- General Panel Start -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <?php _e('General', ER_Calculator()->plugin->get_text_domain());?>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="form-table-low">
                        <tbody>
                        <tr class="header">
                            <th scope="row" colspan="3">
                                <?php _e('Email', ER_Calculator()->plugin->get_text_domain()); ?>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_email_from"><?php _e('From (My Name &lt;myname@example.com&gt;)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_email_from" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_email_from]" value="<?php echo get_option('erc_' . $calcId . '_email_from'); ?>"  size="100" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_email_to"><?php _e('To (comma separated)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_email_to" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_email_to]" value="<?php echo get_option('erc_' . $calcId . '_email_to'); ?>"  size="100" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_email_subject"><?php _e('Subject', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_email_subject" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_email_subject]" value="<?php echo get_option('erc_' . $calcId . '_email_subject'); ?>"  size="100" />
                            </td>
                        </tr>
                        <tr class="header">
                            <th scope="row" colspan="3">
                                <?php _e('User Email', ER_Calculator()->plugin->get_text_domain()); ?>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_user_email_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <select id="settings_user_email_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_user_email_enabled]" >
                                    <option value="1"  <?php echo get_option('erc_' . $calcId . '_user_email_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                    <option value="0"  <?php echo get_option('erc_' . $calcId . '_user_email_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_user_email_from"><?php _e('From (My Name &lt;myname@example.com&gt;)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_user_email_from" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_user_email_from]" value="<?php echo get_option('erc_' . $calcId . '_user_email_from'); ?>"  size="100" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_user_email_subject"><?php _e('Subject', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_user_email_subject" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_user_email_subject]" value="<?php echo get_option('erc_' . $calcId . '_user_email_subject'); ?>"  size="100" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_user_email_template"><?php _e('Email Template', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
		                        <?php $value = get_option('erc_' . $calcId . '_user_email_template'); ?>
                                <select id="settings_user_email_template" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_user_email_template]">
                                    <option value="default" <?= ($value == 'default') ? 'selected' : ''; ?>>Default (3 values)</option>
                                    <option value="home_reversion" <?= ($value == 'home_reversion') ? 'selected' : ''; ?>>Home Reversion (1 value)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_email_text_footer"><?php _e('Text Footer', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td><?php
		                        wp_editor(
			                        get_option('erc_' . $calcId . '_email_text_footer') ? get_option('erc_' . $calcId . '_email_text_footer') : "This lead was generated through the %Equity Release Solutions% website using the %Compare Deals% XML plugin.",
			                        'settings_email_text_footer',
			                        array (
				                        'media_buttons' => false,
				                        'teeny' => false,
				                        'tinymce' => true,
				                        'textarea_rows' => 5,
				                        'textarea_name' => 'erc_calculator_settings[erc_' . $calcId . '_email_text_footer]'
			                        )
		                        );
		                        ?>
                            </td>
                        </tr>
                        <tr class="header">
                            <th scope="row" colspan="3">
                                <?php _e('FLG 360 Integration', ER_Calculator()->plugin->get_text_domain()); ?>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <select id="settings_flg_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_enabled]" >
                                    <option value="1"  <?php echo get_option('erc_' . $calcId . '_flg_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                    <option value="0"  <?php echo get_option('erc_' . $calcId . '_flg_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_integration_method"><?php _e('Integration Method', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <?php $value = get_option('erc_' . $calcId . '_flg_integration_method'); ?>
                                <select id="settings_flg_integration_method" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_integration_method]">
                                    <option value="default" <?= ($value == 'default') ? 'selected' : ''; ?>>Default</option>
                                    <option value="home_reversion" <?= ($value == 'home_reversion') ? 'selected' : ''; ?>>Home Reversion</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_site_id"><?php _e('Site ID', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_site_id" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_site_id]" value="<?php echo get_option('erc_' . $calcId . '_flg_site_id'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_lead_group_id"><?php _e('Lead Group ID', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_lead_group_id" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_lead_group_id]" value="<?php echo get_option('erc_' . $calcId . '_flg_lead_group_id'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_source"><?php _e('Source', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_source" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_source]" value="<?php echo get_option('erc_' . $calcId . '_flg_source'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_access_key"><?php _e('Access Key', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_access_key" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_access_key]" value="<?php echo get_option('erc_' . $calcId . '_flg_access_key'); ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_name_deal"><?php _e('Name Of The Deal', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_name_deal" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_name_deal]" value="<?php echo get_option('erc_' . $calcId . '_flg_name_deal') ? get_option('erc_' . $calcId . '_flg_name_deal') : 'data8'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_firstname"><?php _e('Firstname', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_firstname" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_firstname]" value="<?php echo get_option('erc_' . $calcId . '_flg_firstname') ? get_option('erc_' . $calcId . '_flg_firstname') : 'firstname'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_lastname"><?php _e('Lastname', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_lastname" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_lastname]" value="<?php echo get_option('erc_' . $calcId . '_flg_lastname') ? get_option('erc_' . $calcId . '_flg_lastname') : 'lastname'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_phone"><?php _e('Phone', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_phone" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_phone]" value="<?php echo get_option('erc_' . $calcId . '_flg_phone') ? get_option('erc_' . $calcId . '_flg_phone') : 'phone1'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_email"><?php _e('Email', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_email" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_email]" value="<?php echo get_option('erc_' . $calcId . '_flg_email') ? get_option('erc_' . $calcId . '_flg_email') : 'email'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_age"><?php _e('Age', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_age" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_age]" value="<?php echo get_option('erc_' . $calcId . '_flg_age') ? get_option('erc_' . $calcId . '_flg_age') : 'data1'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_gender"><?php _e('Gender', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_gender" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_gender]" value="<?php echo get_option('erc_' . $calcId . '_flg_gender') ? get_option('erc_' . $calcId . '_flg_gender') : 'data48'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_property_value"><?php _e('Value Of Your Property [Currency]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_property_value" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_property_value]" value="<?php echo get_option('erc_' . $calcId . '_flg_property_value') ? get_option('erc_' . $calcId . '_flg_property_value') : 'data2'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_mortgage_value"><?php _e('Mortgage Outstanding [Currency]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_mortgage_value" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_mortgage_value]" value="<?php echo get_option('erc_' . $calcId . '_flg_mortgage_value') ? get_option('erc_' . $calcId . '_flg_mortgage_value') : 'data4'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_marital_status"><?php _e('Marital Status', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_marital_status" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_marital_status]" value="<?php echo get_option('erc_' . $calcId . '_flg_marital_status') ? get_option('erc_' . $calcId . '_flg_marital_status') : 'data18'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_age_of_spouse"><?php _e('Age of Spouse [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_age_of_spouse" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_age_of_spouse]" value="<?php echo get_option('erc_' . $calcId . '_flg_age_of_spouse') ? get_option('erc_' . $calcId . '_flg_age_of_spouse') : 'data19'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_notes"><?php _e('Notes [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_notes" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_notes]" value="<?php echo get_option('erc_' . $calcId . '_flg_notes') ? get_option('erc_' . $calcId . '_flg_notes') : 'data15'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_lead_origin"><?php _e('Lead Origin [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_lead_origin" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_lead_origin]" value="<?php echo get_option('erc_' . $calcId . '_flg_lead_origin') ? get_option('erc_' . $calcId . '_flg_lead_origin') : 'data25'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_introducer"><?php _e('Introducer [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_introducer" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_introducer]" value="<?php echo get_option('erc_' . $calcId . '_flg_introducer') ? get_option('erc_' . $calcId . '_flg_introducer') : 'data27'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_introducers_full_name"><?php _e('Introducers Full Name [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_introducers_full_name" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_introducers_full_name]" value="<?php echo get_option('erc_' . $calcId . '_flg_introducers_full_name') ? get_option('erc_' . $calcId . '_flg_introducers_full_name') : 'data30'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_introducers_email_address"><?php _e('Introducers Email Address [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_introducers_email_address" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_introducers_email_address]" value="<?php echo get_option('erc_' . $calcId . '_flg_introducers_email_address') ? get_option('erc_' . $calcId . '_flg_introducers_email_address') : 'data31'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_introducers_telephone_no"><?php _e('Introducers Telephone No [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_introducers_telephone_no" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_introducers_telephone_no]" value="<?php echo get_option('erc_' . $calcId . '_flg_introducers_telephone_no') ? get_option('erc_' . $calcId . '_flg_introducers_telephone_no') : 'data32'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_introducers_lead_source"><?php _e('Introducers Lead Source [Set]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_introducers_lead_source" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_introducers_lead_source]" value="<?php echo get_option('erc_' . $calcId . '_flg_introducers_lead_source') ? get_option('erc_' . $calcId . '_flg_introducers_lead_source') : 'data34'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_partner_account"><?php _e('Partner Account [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_partner_account" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_partner_account]" value="<?php echo get_option('erc_' . $calcId . '_flg_partner_account') ? get_option('erc_' . $calcId . '_flg_partner_account') : 'data38'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_partner_sub_account"><?php _e('Partner Sub-Account [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_partner_sub_account" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_partner_sub_account]" value="<?php echo get_option('erc_' . $calcId . '_flg_partner_sub_account') ? get_option('erc_' . $calcId . '_flg_partner_sub_account') : 'data39'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_partner_user_id"><?php _e('Partner User ID [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_partner_user_id" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_partner_user_id]" value="<?php echo get_option('erc_' . $calcId . '_flg_partner_user_id') ? get_option('erc_' . $calcId . '_flg_partner_user_id') : 'data40'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_flg_ip"><?php _e('IP [Text]', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_flg_ip" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_flg_ip]" value="<?php echo get_option('erc_' . $calcId . '_flg_ip') ? get_option('erc_' . $calcId . '_flg_ip') : 'ipaddress'; ?>" size="50"/>
                            </td>
                        </tr>
                        <tr class="header">
                            <th scope="row" colspan="3">
                                <?php _e('Background color (iframe)', ER_Calculator()->plugin->get_text_domain()); ?>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="settings_iframe_background_color"><?php _e('Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <input type="text" id="settings_iframe_background_color" class="colorpicker"  name="erc_calculator_settings[erc_<?php echo $calcId; ?>_iframe_background_color]" value="<?php echo get_option('erc_' . $calcId . '_iframe_background_color'); ?>"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- General Panel End -->

        <!-- Titles Fields Panel Start -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#titles">
                        <?php _e('Titles Fields / Input Fields', ER_Calculator()->plugin->get_text_domain()); ?>
                    </a>
                </h4>
            </div>
            <div id="titles" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="form-table-low">
                        <tbody>
                            <tr class="header">
                                <th scope="row" colspan="3"><?php _e('Standard', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            </tr>
                            <tr>
                                <th><?php _e('Full Name', ER_Calculator()->plugin->get_text_domain()); ?>:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_fullname"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_fullname" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_fullname]" value="<?php echo get_option('erc_' . $calcId . '_title_fullname'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_fullname')?>

                            <tr>
                                <th><?php _e('Age', ER_Calculator()->plugin->get_text_domain()); ?>:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_age"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_age" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_age]" value="<?php echo get_option('erc_' . $calcId . '_title_age'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_age'); ?>

                            <tr>
                                <th><?php _e('Email', ER_Calculator()->plugin->get_text_domain()); ?>:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_email"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_email" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_email]" value="<?php echo get_option('erc_' . $calcId . '_title_email'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_email'); ?>

                            <tr>
                                <th><?php _e('Estimated property value', ER_Calculator()->plugin->get_text_domain()); ?>:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_property_value"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_property_value" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_property_value]" value="<?php echo get_option('erc_' . $calcId . '_title_property_value'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_property_value')?>

                            <tr>
                                <th><?php _e('Telephone', ER_Calculator()->plugin->get_text_domain()); ?>:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_telephone"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_telephone" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_telephone]" value="<?php echo get_option('erc_' . $calcId . '_title_telephone'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_telephone'); ?>

                            <tr>
                                <th><?php _e('Mortgage outstanding', ER_Calculator()->plugin->get_text_domain()); ?>:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_mortgage"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_mortgage" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_mortgage]" value="<?php echo get_option('erc_' . $calcId . '_title_mortgage'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_mortgage'); ?>

                            <tr class="header">
                                <th colspan="3"><?php _e('Home Reversion', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            </tr>
                            <tr>
                                <th><?php _e('Application status', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_status"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_status" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_status]" value="<?php echo get_option('erc_' . $calcId . '_title_status'); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_single"><?php _e('Single', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_single" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_single]" value="<?php echo get_option('erc_' . $calcId . '_title_single'); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_married"><?php _e('Married', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_married" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_married]" value="<?php echo get_option('erc_' . $calcId . '_title_married'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_status')?>

                            <tr>
                                <th><?php _e('Age of spouse', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_age_hr"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_age_hr" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_age_hr]" value="<?php echo get_option('erc_' . $calcId . '_title_age_hr'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_age_hr'); ?>

                            <tr>
                                <th><?php _e('Gender', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_gender"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_gender" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_gender]" value="<?php echo get_option('erc_' . $calcId . '_title_gender'); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_gender_male"><?php _e('Male', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_gender_male" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_gender_male]" value="<?php echo get_option('erc_' . $calcId . '_title_gender_male'); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_gender_female"><?php _e('Female', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_gender_female" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_gender_female]" value="<?php echo get_option('erc_' . $calcId . '_title_gender_female'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_gender'); ?>

                            <tr>
                                <th><?php _e('% equity release', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_title_percent"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="settings_title_percent" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_title_percent]" value="<?php echo get_option('erc_' . $calcId . '_title_percent'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_field_percent'); ?>

                            <tr>
                                <th><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_title_field'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_title_field'); ?>

                            <tr class="header">
                                <th colspan="3"><?php _e('Input Fields', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_calc_style"><?php _e('Style', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="settings_calc_style" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calc_style]" >
                                        <option value="erc_input_container_horizontal"  <?php echo get_option('erc_' . $calcId . '_calc_style') == 'erc_input_container_horizontal' ? "selected" : '' ; ?>>Horizontal</option>
                                        <option value="erc_input_container_vertical"  <?php echo get_option('erc_' . $calcId . '_calc_style') == 'erc_input_container_vertical' ? "selected" : '' ; ?>>Vertical</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_input_fields_width"><?php _e('Width (GLOBAL)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="number" id="settings_input_fields_width" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_input_fields_width]" value="<?php echo get_option('erc_' . $calcId . '_input_fields_width'); ?>"/>
                                    <select id="settings_input_fields_width_px" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_input_fields_width_px]" >
                                        <option value="%" <?php echo get_option('erc_' . $calcId . '_input_fields_width_px') == '%' ? 'selected="selected"' : '' ?>>%</option>
                                        <option value="px" <?php echo get_option('erc_' . $calcId . '_input_fields_width_px') == 'px' ? 'selected="selected"' : '' ?>>px</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_input_fields_height"><?php _e('Height (GLOBAL)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="number" id="settings_input_fields_height" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_input_fields_height]" value="<?php echo get_option('erc_' . $calcId . '_input_fields_height'); ?>"/>
                                    <select id="settings_input_fields_height_px" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_input_fields_height_px]">
                                        <option value="%" <?php echo get_option('erc_' . $calcId . '_input_fields_height_px') == '%' ? 'selected="selected"' : '' ?>>%</option>
                                        <option value="px" <?php echo get_option('erc_' . $calcId . '_input_fields_height_px') == 'px' ? 'selected="selected"' : '' ?>>px</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="settings_input_fields_font_size"><?php _e('Size', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="number" id="settings_input_fields_font_size" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_input_fields_font_size]" value="<?php echo get_option('erc_' . $calcId . '_input_fields_font_size'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_input_fields'); ?>

                            <tr>
                                <th><?php _e('Border', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_input_fields', true); ?>

                            <tr>
                                <th><?php _e('Border Focus', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_input_fields_focus'); ?>

                            <tr>
                                <th><?php _e('Border Alert', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_input_fields_alert'); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- Titles Fields Panel End -->

        <!-- Calculator Panel Start -->
<!--        <div class="panel panel-default">-->
<!--            <div class="panel-heading">-->
<!--                <h4 class="panel-title">-->
<!--                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#calc">-->
<!--                        --><?php //_e('Calculator', ER_Calculator()->plugin->get_text_domain()); ?>
<!--                    </a>-->
<!--                </h4>-->
<!--            </div>-->
<!--            <div id="calc" class="panel-collapse collapse">-->
<!--                <div class="panel-body">-->
<!--                    <table class="form-table-low">-->
<!--                        <tr>-->
<!--                            <th>--><?php //_e('Position', ER_Calculator()->plugin->get_text_domain()); ?><!--</th>-->
<!--                            <th></th>-->
<!--                            <th></th>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td></td>-->
<!--                            <td>-->
<!--                                <label for="settings_calc_top">--><?php //_e('Top (px)', ER_Calculator()->plugin->get_text_domain()); ?><!--:</label>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <input type="number" id="settings_calc_top" name="erc_calculator_settings[erc_--><?php //echo $calcId; ?><!--_calc_top]" value="--><?php //echo get_option('erc_' . $calcId . '_calc_top'); ?><!--"/>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td></td>-->
<!--                            <td>-->
<!--                                <label for="setting_calc_right">--><?php //_e('Right (px)', ER_Calculator()->plugin->get_text_domain()); ?><!--:</label>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <input type="number" id="setting_calc_right" name="erc_calculator_settings[erc_--><?php //echo $calcId; ?><!--_calc_right]" value="--><?php //echo get_option('erc_' . $calcId . '_calc_right'); ?><!--"/>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td></td>-->
<!--                            <td>-->
<!--                                <label for="setting_calc_bottom">--><?php //_e('Bottom (px)', ER_Calculator()->plugin->get_text_domain()); ?><!--:</label>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <input type="number" id="setting_calc_bottom" name="erc_calculator_settings[erc_--><?php //echo $calcId; ?><!--_calc_bottom]" value="--><?php //echo get_option('erc_' . $calcId . '_calc_bottom'); ?><!--"/>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td></td>-->
<!--                            <td>-->
<!--                                <label for="setting_calc_left">--><?php //_e('Left (px)', ER_Calculator()->plugin->get_text_domain()); ?><!--:</label>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <input type="number" id="setting_calc_left" name="erc_calculator_settings[erc_--><?php //echo $calcId; ?><!--_calc_left]" value="--><?php //echo get_option('erc_' . $calcId . '_calc_left'); ?><!--"/>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!-- Calculator Panel End -->

        <!-- Main Area Panel Start -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#mainPanel">
                        <?php _e('Main Area', ER_Calculator()->plugin->get_text_domain());?>
                    </a>
                </h4>
            </div>
            <div id="mainPanel" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="form-table-low">
                        <tbody>
                            <tr>
                                <th><?php _e('Size', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_calc'); ?>

                            <tr>
                                <th>
                                    <label for="setting_main_area_float"><?php _e('Position', ER_Calculator()->plugin->get_text_domain()); ?></label>
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <select id="setting_main_area_float" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_main_area_float]">
                                        <option value="none"  <?php echo get_option('erc_' . $calcId . '_main_area_float') == 'none' ? "selected" : '' ; ?>>none</option>
                                        <option value="left"  <?php echo get_option('erc_' . $calcId . '_main_area_float') == 'left' ? "selected" : '' ; ?>>left</option>
                                        <option value="right"  <?php echo get_option('erc_' . $calcId . '_main_area_float') == 'right' ? "selected" : '' ; ?>>right</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e('Margin', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::short_margin_options_tpl('erc_' . $calcId . '_main_area'); ?>

                            <tr>
                                <th><?php _e('Background Image', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calc_image_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="setting_calc_image_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calc_image_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_calc_image_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_calc_image_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calc_image_url"><?php _e('Image', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <?php if ( get_option( 'erc_' . $calcId . '_calc_image_url' ) ): ?>
                                        <img height="30" src="<?php echo get_option('erc_' . $calcId . '_calc_image_url'); ?>" alt=""/>
                                    <?php endif; ?>
                                    <input type="file" id="setting_calc_image_url" name="erc_<?php echo $calcId;?>_calc_image_url"/>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e('Background', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_main_area_background_color"><?php _e('Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="setting_main_area_background_color" class="colorpicker"  name="erc_calculator_settings[erc_<?php echo $calcId; ?>_main_area_background_color]" value="<?php echo get_option('erc_' . $calcId . '_main_area_background_color'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::gradient_types_options_tpl('erc_' . $calcId . '_main_area'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::gradient_begin_color_options_tpl('erc_' . $calcId . '_main_area'); ?>

                            <tr>
                                <th><?php _e('Title', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_main_area_title_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="setting_main_area_title_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_main_area_title_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_main_area_title_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_main_area_title_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_main_area_title'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_main_area_title'); ?>

                            <tr>
                                <th><?php _e('Border', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_main_area_border_radius"><?php _e('Border Radius (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="number" id="setting_main_area_border_radius" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_main_area_border_radius]" value="<?php echo get_option('erc_' . $calcId . '_main_area_border_radius'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_main_area'); ?>

                            <tr class="header">
                                <th colspan="3" ><?php _e('Calculate Button', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            </tr>
                            <tr>
                                <th><?php _e('Value', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_text"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="setting_calculate_button_text" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_text]" value="<?php echo get_option('erc_' . $calcId . '_calculate_button_text'); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e('Size', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_calculate_button'); ?>

                            <tr>
                                <th><?php _e('Background Image', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_image_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="setting_calculate_button_image_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_image_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_calculate_button_image_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_calculate_button_image_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_image_url"><?php _e('Source', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <?php if ( get_option( 'erc_' . $calcId . '_calculate_button_image_url' ) ): ?>
                                        <img height="30" src="<?php echo get_option('erc_' . $calcId . '_calculate_button_image_url'); ?>" alt=""/>
                                    <?php endif; ?>
                                    <input type="file" id="setting_calculate_button_image_url" name="erc_<?php echo $calcId;?>_calculate_button_image_url"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_image_title"><?php _e('Calculate Title (SEO)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="setting_calculate_button_image_title" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_image_title]" value="<?php echo get_option('erc_' . $calcId . '_calculate_button_image_title'); ?>" size="50" />
                                </td>
                            </tr>

                            <tr>
                                <th><?php _e('Button Container', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_calculate_button_container') ;?>

                            <tr>
                                <th><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_calculate_button', true) ;?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_calculate_button') ;?>

                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_text_hover_color"><?php _e('Text Hover Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="setting_calculate_button_text_hover_color" class="colorpicker" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_text_hover_color]" value="<?php echo get_option('erc_' . $calcId . '_calculate_button_text_hover_color'); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_hover_text_decoration"><?php _e('Text Hover Decoration', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="setting_calculate_button_hover_text_decoration" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_hover_text_decoration]">
                                        <option value="none" <?php echo get_option('erc_' . $calcId . '_calculate_button_hover_text_decoration') == 'none' ? "selected" : '' ; ?>>none</option>
                                        <option value="underline" <?php echo get_option('erc_' . $calcId . '_calculate_button_hover_text_decoration') == 'underline' ? "selected" : '' ; ?>>underline</option>
                                        <option value="overline" <?php echo get_option('erc_' . $calcId . '_calculate_button_hover_text_decoration') == 'overline' ? "selected" : '' ; ?>>overline</option>
                                        <option value="line-through" <?php echo get_option('erc_' . $calcId . '_calculate_button_hover_text_decoration') == 'line-through' ? "selected" : '' ; ?>>line-through</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th><?php _e('Background', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_background_color"><?php _e('Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="setting_calculate_button_background_color" class="colorpicker" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_background_color]" value="<?php echo get_option('erc_' . $calcId . '_calculate_button_background_color'); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_hover_background_color"><?php _e('Hover Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="setting_calculate_button_hover_background_color" class="colorpicker" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_hover_background_color]" value="<?php echo get_option('erc_' . $calcId . '_calculate_button_hover_background_color'); ?>"/>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::gradient_types_options_tpl('erc_' . $calcId . '_calculate_button') ;?>
                            <?php ER_Calculator_Admin_Menu_Calculators::gradient_begin_color_options_tpl('erc_' . $calcId . '_calculate_button') ;?>

                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_hover_background_color"><?php _e('Gradient Begin Hover Color', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" id="setting_calculate_button_hover_background_color" class="colorpicker" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_gradient_hover_begin]" value="<?php echo get_option('erc_' . $calcId . '_calculate_button_gradient_hover_begin'); ?>"/>
                                </td>
                            </tr>

                            <tr>
                                <th><?php _e('Border', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_calculate_button') ;?>

                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_calculate_button_border_radius"><?php _e('Border Radius (px)', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <input type="number" id="setting_calculate_button_border_radius" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_calculate_button_border_radius]" value="<?php echo get_option('erc_' . $calcId . '_calculate_button_border_radius'); ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- Main Area Panel End -->

        <!-- Text Area One Panel Start -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#textAreaOne">
                        <?php _e('Text Area One', ER_Calculator()->plugin->get_text_domain()); ?>
                    </a>
                </h4>
            </div>
            <div id="textAreaOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="form-table-low">
                        <tbody>
                            <tr>
                                <th><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_text_area_one_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="setting_text_area_one_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_text_area_one_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_text_area_one_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_text_area_one_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_text_area_one'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_text_area_one'); ?>

                            <tr>
                                <th><?php _e('Line Before', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_text_area_one_line_enabled"><?php _e('Show', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="setting_text_area_one_line_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_text_area_one_line_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_text_area_one_line_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_text_area_one_line_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_text_area_one_line'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_text_area_one_line', true, false); ?>

                            <tr class="header">
                                <th colspan="3"><strong>Result Text Area One</strong></th>
                            </tr>
                            <tr>
                                <th><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_result_text_area_one_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="setting_result_text_area_one_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_text_area_one_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_result_text_area_one_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_result_text_area_one_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_result_text_area_one'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_result_text_area_one'); ?>

                            <tr>
                                <th><?php _e('Line Before', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_result_text_area_one_line_enabled"><?php _e('Show', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                                </td>
                                <td>
                                    <select id="setting_result_text_area_one_line_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_text_area_one_line_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_result_text_area_one_line_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_result_text_area_one_line_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_result_text_area_one_line'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_result_text_area_one_line', true, false); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- Text Area One Panel Start -->

        <!-- Body Area Panel Start -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#bodyArea">
                        <?php _e('Body Area', ER_Calculator()->plugin->get_text_domain());?>
                    </a>
                </h4>
            </div>
            <div id="bodyArea" class="panel-collapse collapse">
                <div class="panel-body">
                    <table>
                        <tr>
                            <th><?php _e('Line Before', ER_Calculator()->plugin->get_text_domain() ); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_body_container_line_before_enabled"><?php _e('Show', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <select id="setting_body_container_line_before_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_body_container_line_before_enabled]" >
                                    <option value="1"  <?php echo get_option('erc_' . $calcId . '_body_container_line_before_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                    <option value="0"  <?php echo get_option('erc_' . $calcId . '_body_container_line_before_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                </select>
                            </td>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_body_container_line_before'); ?>

                        <tr>
                            <th><?php _e('Line After', ER_Calculator()->plugin->get_text_domain() ); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_body_container_line_after_enabled"><?php _e('Show', ER_Calculator()->plugin->get_text_domain()); ?>:</label>
                            </td>
                            <td>
                                <select id="setting_body_container_line_after_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_body_container_line_after_enabled]" >
                                    <option value="1"  <?php echo get_option('erc_' . $calcId . '_body_container_line_after_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                    <option value="0"  <?php echo get_option('erc_' . $calcId . '_body_container_line_after_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                </select>
                            </td>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_body_container_line_after'); ?>

                        <tr>
                            <th><?php _e('Padding', ER_Calculator()->plugin->get_text_domain() ); ?></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::short_margin_options_tpl('erc_' . $calcId . '_body_area'); ?>
                    </table>
                </div>
            </div>
        </div><!-- Body Area Panel End -->

        <!-- Result Area Panel Start -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#resultArea">
                        <?php _e('Result Area', ER_Calculator()->plugin->get_text_domain()); ?>
                    </a>
                </h4>
            </div>
            <div id="resultArea" class="panel-collapse collapse">
                <div class="panel-body">
                    <table>
                        <tr class="header">
                            <th colspan="3"><?php _e('Rows', ER_Calculator()->plugin->get_text_domain()); ?></th>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_result_row', true, false); ?>

                        <tr class="header">
                            <th colspan="3"><?php _e('Labels', ER_Calculator()->plugin->get_text_domain()); ?></th>
                        </tr>
                        <tr>
                            <th><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_result_label_standard"><?php _e('Standard Plan', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_result_label_standard" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_label_standard]" value="<?php echo get_option('erc_' . $calcId . '_result_label_standard'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_result_label_enhanced"><?php _e('Enhanced Plan', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_result_label_enhanced" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_label_enhanced]" value="<?php echo get_option('erc_' . $calcId . '_result_label_enhanced'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_result_label_interest_only"><?php _e('Interest Only Plan', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_result_label_interest_only" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_label_interest_only]" value="<?php echo get_option('erc_' . $calcId . '_result_label_interest_only'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_result_label_home_reversion"><?php _e('Home Reversion Plan', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_result_label_home_reversion" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_label_home_reversion]" value="<?php echo get_option('erc_' . $calcId . '_result_label_home_reversion'); ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <th><?php _e('Style', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_result_label'); ?>

                        <tr class="header">
                            <th colspan="3"><?php _e('Result Value', ER_Calculator()->plugin->get_text_domain()); ?></th>
                        </tr>

                        <tr>
                            <th><?php _e('Size', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_result_value_width"><?php _e('Width', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="number" id="setting_result_value_width" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_value_width]" value="<?php echo get_option('erc_' . $calcId . '_result_value_width'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th><?php _e('Background', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_result_value_background_color"><?php _e('Color', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_result_value_background_color" class="colorpicker"  name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_value_background_color]" value="<?php echo get_option('erc_' . $calcId . '_result_value_background_color'); ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <th><?php _e('Style', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_result_value'); ?>
                        <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_result_value'); ?>
                        <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_result_value', true); ?>

                        <tr class="header">
                            <th colspan="3"><?php _e('Recalculate Button', ER_Calculator()->plugin->get_text_domain()); ?></th>
                        </tr>
                        <tr>
                            <th><?php _e('Value', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_text"><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_recalculate_button_text" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_text]" value="<?php echo get_option('erc_' . $calcId . '_recalculate_button_text'); ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <th><?php _e('Size', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::size_options_tpl('erc_' . $calcId . '_recalculate_button'); ?>

                        <tr>
                            <th><?php _e('Background Image', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_image_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <select id="setting_recalculate_button_image_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_image_enabled]" >
                                    <option value="1"  <?php echo get_option('erc_' . $calcId . '_recalculate_button_image_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                    <option value="0"  <?php echo get_option('erc_' . $calcId . '_recalculate_button_image_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_image_url"><?php _e('Source', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <?php if (get_option('erc_' . $calcId . '_recalculate_button_image_url')): ?>
                                    <img height="30" src="<?php echo get_option('erc_' . $calcId . '_recalculate_button_image_url'); ?>" alt=""/>
                                <?php endif; ?>
                                <input type="file" id="setting_recalculate_button_image_url" name="erc_<?php echo $calcId;?>_recalculate_button_image_url"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_image_title"><?php _e('Calculate Title (SEO)', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_recalculate_button_image_title" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_image_title]" value="<?php echo get_option('erc_' . $calcId . '_recalculate_button_image_title'); ?>" size="50" />
                            </td>
                        </tr>

                        <tr>
                            <th><?php _e('Button Container', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_recalculate_button_container') ;?>

                        <tr>
                            <th><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_recalculate_button', true) ;?>
                        <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_recalculate_button') ;?>

                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_text_hover_color"><?php _e('Text Hover Color', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_recalculate_button_text_hover_color" class="colorpicker" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_text_hover_color]" value="<?php echo get_option('erc_' . $calcId . '_recalculate_button_text_hover_color'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_hover_text_decoration"><?php _e('Text Hover Decoration', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <select id="setting_recalculate_button_hover_text_decoration" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_hover_text_decoration]">
                                    <option value="none" <?php echo get_option('erc_' . $calcId . '_recalculate_button_hover_text_decoration') == 'none' ? "selected" : '' ; ?>>none</option>
                                    <option value="underline" <?php echo get_option('erc_' . $calcId . '_recalculate_button_hover_text_decoration') == 'underline' ? "selected" : '' ; ?>>underline</option>
                                    <option value="overline" <?php echo get_option('erc_' . $calcId . '_recalculate_button_hover_text_decoration') == 'overline' ? "selected" : '' ; ?>>overline</option>
                                    <option value="line-through" <?php echo get_option('erc_' . $calcId . '_recalculate_button_hover_text_decoration') == 'line-through' ? "selected" : '' ; ?>>line-through</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th><?php _e('Background', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_background_color"><?php _e('Color', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_recalculate_button_background_color" class="colorpicker" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_background_color]" value="<?php echo get_option('erc_' . $calcId . '_recalculate_button_background_color'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_hover_background_color"><?php _e('Hover Color', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_recalculate_button_hover_background_color" class="colorpicker" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_hover_background_color]" value="<?php echo get_option('erc_' . $calcId . '_recalculate_button_hover_background_color'); ?>"/>
                            </td>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::gradient_types_options_tpl('erc_' . $calcId . '_recalculate_button') ;?>
                        <?php ER_Calculator_Admin_Menu_Calculators::gradient_begin_color_options_tpl('erc_' . $calcId . '_recalculate_button') ;?>

                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_gradient_hover_begin"><?php _e('Gradient Begin Hover Color', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="text" id="setting_recalculate_button_gradient_hover_begin" class="colorpicker" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_gradient_hover_begin]" value="<?php echo get_option('erc_' . $calcId . '_recalculate_button_gradient_hover_begin'); ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <th><?php _e('Border', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_recalculate_button') ;?>

                        <tr>
                            <td></td>
                            <td>
                                <label for="setting_recalculate_button_border_radius"><?php _e('Border Radius (px)', ER_Calculator()->plugin->get_text_domain()); ?></label>
                            </td>
                            <td>
                                <input type="number" id="setting_recalculate_button_border_radius" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_recalculate_button_border_radius]" value="<?php echo get_option('erc_' . $calcId . '_recalculate_button_border_radius'); ?>"/>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!-- Result Area Panel End -->

        <!-- Text Area Two Panel Start -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#textAreaTwo">
                        <?php _e('Text Area Two', ER_Calculator()->plugin->get_text_domain()); ?>
                    </a>
                </h4>
            </div>
            <div id="textAreaTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <table>
                        <tbody>
                            <tr>
                                <th><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_text_area_two_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?></label>
                                </td>
                                <td>
                                    <select id="setting_text_area_two_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_text_area_two_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_text_area_two_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_text_area_two_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_text_area_two'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_text_area_two'); ?>

                            <tr>
                                <th><?php _e('Line Before', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_text_area_two_line_enabled"><?php _e('Show', ER_Calculator()->plugin->get_text_domain()); ?></label>
                                </td>
                                <td>
                                    <select id="setting_text_area_two_line_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_text_area_two_line_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_text_area_two_line_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_text_area_two_line_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_text_area_two_line'); ?>

                            <tr class="header">
                                <th colspan="3"><?php _e('Result Text Area Two', ER_Calculator()->plugin->get_text_domain()); ?></th>
                            </tr>
                            <tr>
                                <th><?php _e('Text', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_result_text_area_two_enabled"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?></label>
                                </td>
                                <td>
                                    <select id="setting_result_text_area_two_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_text_area_two_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_result_text_area_two_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_result_text_area_two_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::text_options_tpl('erc_' . $calcId . '_result_text_area_two'); ?>
                            <?php ER_Calculator_Admin_Menu_Calculators::text_container_options_tpl('erc_' . $calcId . '_result_text_area_two'); ?>

                            <tr>
                                <th><?php _e('Line Before', ER_Calculator()->plugin->get_text_domain()); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <label for="setting_result_text_area_two_line_enabled"><?php _e('Show', ER_Calculator()->plugin->get_text_domain()); ?></label>
                                </td>
                                <td>
                                    <select id="setting_result_text_area_two_line_enabled" name="erc_calculator_settings[erc_<?php echo $calcId; ?>_result_text_area_two_line_enabled]" >
                                        <option value="1"  <?php echo get_option('erc_' . $calcId . '_result_text_area_two_line_enabled') == '1' ? "selected" : '' ; ?>>Yes</option>
                                        <option value="0"  <?php echo get_option('erc_' . $calcId . '_result_text_area_two_line_enabled') == '0' ? "selected" : '' ; ?>>No</option>
                                    </select>
                                </td>
                            </tr>

                            <?php ER_Calculator_Admin_Menu_Calculators::border_options_tpl('erc_' . $calcId . '_result_text_area_two_line'); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- Text Area Two Panel End -->
    </div>

    <?php wp_nonce_field($nonce_action, 'erc_calculator_settings[_wpnonce]'); ?>

    <p class="submit">
        <input class="button button-primary" type="submit" name="erc_calculator_settings[<?php echo $action;?>]" value="<?php _e('Save', ER_Calculator()->plugin->get_text_domain()); ?>" />
    </p>
</form>