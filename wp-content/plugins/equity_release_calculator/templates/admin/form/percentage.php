<?php
/**
 * @var array $erc_percentage
 * @var string $action Type of form action (add|edit|delete)
 */
?>


<?php
switch ( $action ) {
	case 'add':
		$nonce_action
			          = ER_Calculator_Percentage_Actions_Handler::$nonce_action_add;
		$submit_label = __(
			'Add',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	case 'edit':
		$nonce_action
			          = ER_Calculator_Percentage_Actions_Handler::$nonce_action_edit;
		$submit_label = __(
			'Edit',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	case 'delete':
		$nonce_action
			          = ER_Calculator_Percentage_Actions_Handler::$nonce_action_delete;
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
        <input type='hidden' value="<?php echo !empty($erc_percentage['id']) ? $erc_percentage['id'] : '' ?>" name="erc_percentage[id]" />
        <input class="button button-primary" type="submit" name="erc_percentage[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>

    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="erc_ages"><?php _e('Age', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <select aria-required="true" required="" name="erc_percentage[age_key]" <?php echo (isset($_GET['action']) && in_array($_GET['action'], array('edit', 'delete'))) ? "disabled='disabled'":''?> id="erc_ages">
		            <?php foreach ($ages as $age): ?>
                        <option value="<?php echo $age['id']; ?>" <?php echo ((isset($erc_percentage['age_key'])) && ($erc_percentage['age_key'] == $age['id'])) ? 'selected="selected"' : '' ?>>
	                        <?php echo $age['age']; ?>
                        </option>
		            <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="erc_standard"><?php _e('Standard', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <input type="text" aria-required="true" required="" name="erc_percentage[standard]"  value="<?php echo !empty($erc_percentage['standard']) ? $erc_percentage['standard'] : '' ?>" id="erc_standard" />%
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="erc_enhanced"><?php _e('Enhanced', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <input type="text" aria-required="true" required="" name="erc_percentage[enhanced]"  value="<?php echo !empty($erc_percentage['enhanced']) ? $erc_percentage['enhanced'] : '' ?>" id="erc_enhanced" />%
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="erc_interest_only"><?php _e('Interest Only', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <input type="text" aria-required="true" required="" name="erc_percentage[interest_only]"  value="<?php echo !empty($erc_percentage['interest_only']) ? $erc_percentage['interest_only'] : '' ?>" id="erc_interest_only" />%
            </td>
        </tr>
        </tbody>
    </table>

    <?php wp_nonce_field($nonce_action, 'erc_percentage[_wpnonce]'); ?>

    <p class="submit">
        <input class="button button-primary" type="submit" name="erc_percentage[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>
</form>