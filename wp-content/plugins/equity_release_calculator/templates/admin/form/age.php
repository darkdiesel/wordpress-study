<?php
/**
 * @var array $erc_age
 * @var string $action Type of form action (add|edit|delete)
 */
?>

<?php
switch ( $action ) {
	case 'add':
		$nonce_action
			          = ER_Calculator_Age_Actions_Handler::$nonce_action_add;
		$submit_label = __(
			'Add',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	case 'edit':
		$nonce_action
			          = ER_Calculator_Age_Actions_Handler::$nonce_action_edit;
		$submit_label = __(
			'Edit',
			ER_Calculator()->plugin->get_text_domain()
		);
		break;
	case 'delete':
		$nonce_action
			          = ER_Calculator_Age_Actions_Handler::$nonce_action_delete;
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
        <input type='hidden' value="<?php echo !empty($erc_age['id']) ? $erc_age['id'] : '' ?>" name="erc_age[id]" />
        <input class="button button-primary" type="submit" name="erc_age[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>

    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="erc_standard"><?php _e('Age', ER_Calculator()->plugin->get_text_domain()) ?></label>
            </th>
            <td>
                <input type="text" aria-required="true" name="erc_age[age]"  value="<?php echo !empty($erc_age['age']) ? $erc_age['age'] : '' ?>" id="erc_standard" />
            </td>
        </tr>
        </tbody>
    </table>

    <?php wp_nonce_field($nonce_action, 'erc_age[_wpnonce]'); ?>

    <p class="submit">
        <input class="button button-primary" type="submit" name="erc_age[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>
</form>