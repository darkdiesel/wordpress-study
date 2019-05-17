<?php
/**
 * @var array $erc_percentage_hr
 * @var string $action Type of form action (add|edit|delete)
 */
?>


<?php
switch ( $action ) {
	case 'add':
		$nonce_action
			          = ER_Calculator_Percentage_HR_Actions_Handler::$nonce_action_add;
		$submit_label = __(
			'Add',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	case 'edit':
		$nonce_action
			          = ER_Calculator_Percentage_HR_Actions_Handler::$nonce_action_edit;
		$submit_label = __(
			'Edit',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	case 'delete':
		$nonce_action
			          = ER_Calculator_Percentage_HR_Actions_Handler::$nonce_action_delete;
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
        <input type='hidden' value="<?php echo !empty($erc_percentage_hr['id']) ? $erc_percentage_hr['id'] : '' ?>" name="erc_percentage_hr[id]" />
        <input class="button button-primary" type="submit" name="erc_percentage_hr[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>

    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="erc_ages"><?php _e('Age', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <select aria-required="true" required="" name="erc_percentage_hr[age_key]" <?php echo (isset($_GET['action']) && in_array($_GET['action'], array('edit', 'delete'))) ? "disabled='disabled'":''?> id="erc_ages">
		            <?php foreach ($ages as $age): ?>
                        <option value="<?php echo $age['id']; ?>" <?php echo ((isset($erc_percentage_hr['age_key'])) && ($erc_percentage_hr['age_key'] == $age['id'])) ? 'selected="selected"' : '' ?>>
	                        <?php echo $age['age']; ?>
                        </option>
		            <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="erc_male"><?php _e('Male', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <input type="text" aria-required="true" required="" name="erc_percentage_hr[male]"  value="<?php echo !empty($erc_percentage_hr['male']) ? $erc_percentage_hr['male'] : '' ?>" id="erc_male" />%
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="erc_female"><?php _e('Female', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <input type="text" aria-required="true" required="" name="erc_percentage_hr[female]"  value="<?php echo !empty($erc_percentage_hr['female']) ? $erc_percentage_hr['female'] : '' ?>" id="erc_female" />%
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="erc_joint"><?php _e('Joint', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <input type="text" aria-required="true" name="erc_percentage_hr[joint]"  value="<?php echo !empty($erc_percentage_hr['joint']) ? $erc_percentage_hr['joint'] : '' ?>" id="erc_joint" />%
            </td>
        </tr>
        </tbody>
    </table>

    <?php wp_nonce_field($nonce_action, 'erc_percentage_hr[_wpnonce]'); ?>

    <p class="submit">
        <input class="button button-primary" type="submit" name="erc_percentage_hr[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>
</form>