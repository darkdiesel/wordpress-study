<?php
/**
 * @var array $erc_calculator
 * @var string $action Type of form action (add|edit|delete)
 * @var array $lead_sources
 */
?>

<?php
switch ( $action ) {
	case 'add':
		$nonce_action
			          = ER_Calculator_Calculator_Actions_Handler::$nonce_action_add;
		$submit_label = __(
			'Add',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	case 'edit':
		$nonce_action
			          = ER_Calculator_Calculator_Actions_Handler::$nonce_action_edit;
		$submit_label = __(
			'Edit',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	case 'delete':
		$nonce_action
			          = ER_Calculator_Calculator_Actions_Handler::$nonce_action_delete;
		$submit_label = __(
			'Delete',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	default:
		$nonce_action = '';
		$submit_label = __(
			'Submit',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
}
?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <p class="submit">
        <input type='hidden' value="<?php echo !empty($erc_calculator['id']) ? $erc_calculator['id'] : '' ?>" name="erc_calculator[id]" />
        <input class="button button-primary" type="submit" name="erc_calculator[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="is_active"><?php _e('Enabled', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <select name="erc_calculator[is_active]" id="is_active">
                    <option value="1" <?php echo !empty($erc_calculator['is_active']) ? "selected='selected'" : '' ?>>YES</option>
                    <option value="0" <?php echo empty($erc_calculator['is_active']) ? "selected='selected'" : '' ?>>NO</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="title"><?php _e('Title', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
	            <?php
	            wp_editor( !empty($erc_calculator['title']) ? ER_Calculator()->functions->remove_slash($erc_calculator['title']) : '', 'title',
		            array(
			            'media_buttons' => false,
			            'teeny'         => false,
			            'tinymce'       => true,
			            'textarea_rows' => 5,
			            'textarea_name' => 'erc_calculator[title]'
		            )
	            );
	            ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="partner_id"><?php _e('Partner ID', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[partner_id]" id="partner_id" value="<?php echo  empty($erc_calculator['partner_id']) ? uniqid() : $erc_calculator['partner_id']?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="partner_full_name"><?php _e('Partner Full Name', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[partner_full_name]" id="partner_full_name" value="<?php echo !empty($erc_calculator['partner_full_name']) ? $erc_calculator['partner_full_name'] : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="partner_account"><?php _e('Partner Account', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[partner_account]" id="partner_account" value="<?php echo !empty($erc_calculator['partner_account']) ? $erc_calculator['partner_account'] : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="partner_sub_account"><?php _e('Partner Sub-Account', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[partner_sub_account]" id="partner_sub_account" value="<?php echo !empty($erc_calculator['partner_sub_account']) ? $erc_calculator['partner_sub_account'] : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="partner_user_id"><?php _e('Partner User ID', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[partner_user_id]" id="partner_user_id" value="<?php echo !empty($erc_calculator['partner_user_id']) ? $erc_calculator['partner_user_id'] : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="introducer"><?php _e('Introducer', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[introducer]" id="introducer" value="<?php echo !empty($erc_calculator['introducer']) ? $erc_calculator['introducer'] : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="introducers_full_name"><?php _e('Introducers Full Name', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[introducers_full_name]" id="introducers_full_name" value="<?php echo !empty($erc_calculator['introducers_full_name']) ? $erc_calculator['introducers_full_name'] : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="introducers_email_address"><?php _e('Introducers Email Address', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[introducers_email_address]" id="introducers_email_address" value="<?php echo !empty($erc_calculator['introducers_email_address']) ? $erc_calculator['introducers_email_address'] : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="introducers_telephone_no"><?php _e('Introducers Telephone No', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <input type="text" name="erc_calculator[introducers_telephone_no]" id="introducers_telephone_no" value="<?php echo !empty($erc_calculator['introducers_telephone_no']) ? $erc_calculator['introducers_telephone_no'] : ''; ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="introducers_lead_source"><?php _e('Introducers Lead Source', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <select name="erc_calculator[introducers_lead_source]" id="introducers_lead_source">
	                <?php foreach ($lead_sources as $lead_source_val => $lead_source_label): ?>
                        <option value="<?php echo $lead_source_val; ?>" <?php echo ((isset($erc_calculator['introducers_lead_source'])) && ($erc_calculator['introducers_lead_source'] == $lead_source_val)) ? 'selected="selected"' : '' ?>>
			                <?php echo $lead_source_label; ?>
                        </option>
	                <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="standard"><?php _e('Standard', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <select name="erc_calculator[standard]" id="standard">
                    <option value="1" <?php echo !empty($erc_calculator['standard']) ? "selected='selected'" : '' ?>>YES</option>
                    <option value="0" <?php echo empty($erc_calculator['standard']) ? "selected='selected'" : '' ?>>NO</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="enhanced"><?php _e('Enhanced', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <select name="erc_calculator[enhanced]" id="enhanced">
                    <option value="1" <?php echo !empty($erc_calculator['enhanced']) ? "selected='selected'" : '' ?>>YES</option>
                    <option value="0" <?php echo empty($erc_calculator['enhanced']) ? "selected='selected'" : '' ?>>NO</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="interest_only"><?php _e('Interest Only', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <select name="erc_calculator[interest_only]" id="interest_only">
                    <option value="1" <?php echo !empty($erc_calculator['interest_only']) ? "selected='selected'" : '' ?>>YES</option>
                    <option value="0" <?php echo empty($erc_calculator['interest_only']) ? "selected='selected'" : '' ?>>NO</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="home_reversion"><?php _e('Home Reversion', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
                <select name="erc_calculator[home_reversion]" id="home_reversion">
                    <option value="1" <?php echo !empty($erc_calculator['home_reversion']) ? "selected='selected'" : '' ?>>YES</option>
                    <option value="0" <?php echo empty($erc_calculator['home_reversion']) ? "selected='selected'" : '' ?>>NO</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="text_area_one"><?php _e('Text Area One', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
		        <?php
		        wp_editor( !empty($erc_calculator['text_area_one']) ? ER_Calculator()->functions->remove_slash($erc_calculator['text_area_one']) : '', 'text_area_one',
			        array(
				        'media_buttons' => false,
				        'teeny'         => false,
				        'tinymce'       => true,
				        'textarea_rows' => 5,
				        'textarea_name' => 'erc_calculator[text_area_one]'
			        )
		        );
		        ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="text_area_two"><?php _e('Text Area Two', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
		        <?php
		        wp_editor( !empty($erc_calculator['text_area_two']) ? ER_Calculator()->functions->remove_slash($erc_calculator['text_area_two']) : '', 'text_area_two',
			        array(
				        'media_buttons' => false,
				        'teeny'         => false,
				        'tinymce'       => true,
				        'textarea_rows' => 5,
				        'textarea_name' => 'erc_calculator[text_area_two]'
			        )
		        );
		        ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="result_text_area_one"><?php _e('Result Text Area One', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
		        <?php
		        wp_editor( !empty($erc_calculator['result_text_area_one']) ? ER_Calculator()->functions->remove_slash($erc_calculator['result_text_area_one']) : '', 'result_text_area_one',
			        array(
				        'media_buttons' => false,
				        'teeny' => false,
				        'tinymce' => true,
				        'textarea_rows' => 5,
				        'textarea_name' => 'erc_calculator[result_text_area_one]'
			        )
		        );
		        ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="result_text_area_two"><?php _e('Result Text Area Two', ER_Calculator()->plugin->get_text_domain()); ?></label>
            </th>
            <td>
		        <?php
		        wp_editor( !empty($erc_calculator['result_text_area_two']) ? ER_Calculator()->functions->remove_slash($erc_calculator['result_text_area_two']) : '', 'result_text_area_two',
			        array(
				        'media_buttons' => false,
				        'teeny' => false,
				        'tinymce' => true,
				        'textarea_rows' => 5,
				        'textarea_name' => 'erc_calculator[result_text_area_two]'
			        )
		        );
		        ?>
            </td>
        </tr>
        </tbody>
    </table>

    <?php wp_nonce_field($nonce_action, 'erc_calculator[_wpnonce]'); ?>

    <p class="submit">
        <input class="button button-primary" type="submit" name="erc_calculator[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>
</form>