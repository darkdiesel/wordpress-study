<?php
/**
 * @var array $taxonomy
 * @var string $action Type of form action (add|edit|delete)
 */
?>

<?php
switch ( $action ) {
	case 'add':
		$nonce_action
			          = IPA_Fields_Pack_Admin_Taxonomies_Handler::$nonce_action_add;
		$submit_label = __(
			'Add',
			IPA_Fields_Pack()->plugin->get_txt_domain()
		);
		break;
	case 'edit':
		$nonce_action
			          = IPA_Fields_Pack_Admin_Taxonomies_Handler::$nonce_action_edit;
		$submit_label = __(
			'Edit',
			IPA_Fields_Pack()->plugin->get_txt_domain()
		);
		break;
	case 'delete':
		$nonce_action
			          = IPA_Fields_Pack_Admin_Taxonomies_Handler::$nonce_action_delete;
		$submit_label = __(
			'Delete',
			IPA_Fields_Pack()->plugin->get_txt_domain()
		);
		break;
	default:
		$nonce_action = '';
		$submit_label = __(
			'Submit',
			IPA_Fields_Pack()->plugin->get_txt_domain()
		);
		break;
}
?>

<?php
$defaults = array(
	'publicly_queryable'    => null,
	'meta_box_cb'           => null,
	'meta_box_sanitize_cb'  => null,
	'capabilities'          => array(),
	'rewrite'               => true,
	//'query_var'             => $this->name,
	'update_count_callback' => '',
	'show_in_rest'          => false,
	'rest_base'             => false,
	'rest_controller_class' => false,
	'_builtin'              => false,
);
?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <p class="submit">
        <input class="button button-primary" type="submit" name="ipa-fields-pack-taxonomy[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>

    <div class="postbox">
        <h2 class="hndle"><?php _e('Name and description', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></h2>
        <div class="inside">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-name"><?php _e('Name plural (required)', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['name'] ) ? $taxonomy['labels']['name'] : ''; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][name]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-name" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-singular-name"><?php _e('Name singular (required)', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['singular_name'] ) ? $taxonomy['labels']['singular_name'] : ''; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][singular_name]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-singular-name" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-slug"><?php _e('Slug (required)', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['slug'] ) ? $taxonomy['slug'] : ''; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[slug]"  value="<?php echo $option; ?>" id="ipa-fields-pack-slug" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-description"><?php _e('Description', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['description'] ) ? $taxonomy['description'] : ''; ?>
                        <textarea aria-required="false" name="ipa-fields-pack-taxonomy[description]" id="ipa-fields-pack-description" cols="30" rows="10"><?php echo $option; ?></textarea>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="postbox">
        <h2 class="hndle"><?php _e('Labels', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></h2>
        <div class="inside">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-search-items"><?php _e('Search items', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['search_items'] ) ? $taxonomy['labels']['search_items'] : 'Search %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][search_items]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-search-items" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-popular-items"><?php _e('Popular items', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['popular_items'] ) ? $taxonomy['labels']['popular_items'] : 'Popular %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][popular_items]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-popular-items" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-all-items"><?php _e('All items', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['all_items'] ) ? $taxonomy['labels']['all_items'] : 'All %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][all_items]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-all-items" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-parent-item"><?php _e('Parent item', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['parent_item'] ) ? $taxonomy['labels']['parent_item'] : 'Parent %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][parent_item]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-parent-item" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-parent-item-colon"><?php _e('Parent item with colon', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['parent_item_colon'] ) ? $taxonomy['labels']['parent_item_colon'] : 'Parent %s:'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][parent_item_colon]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-parent-item-colon" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-edit-item"><?php _e('Edit Item', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['edit_item'] ) ? $taxonomy['labels']['edit_item'] : 'Edit %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][edit_item]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-edit-item" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-view-item"><?php _e('View item', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['view_item'] ) ? $taxonomy['labels']['view_item'] : 'View %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][view_item]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-view-item" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-update-item"><?php _e('Update item', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['update_item'] ) ? $taxonomy['labels']['update_item'] : 'Update %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][update_item]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-update-item" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-add-new-item"><?php _e('Add new item', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['add_new_item'] ) ? $taxonomy['labels']['add_new_item'] : 'Add New %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][add_new_item]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-add-new-item" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-new-item-name"><?php _e('New item name', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['new_item_name'] ) ? $taxonomy['labels']['new_item_name'] : 'New %s Name'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][new_item_name]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-new-item-name" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-separate-items-with-commas"><?php _e('Separate items with commas', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['separate_items_with_commas'] ) ? $taxonomy['labels']['separate_items_with_commas'] : 'Separate %s with commas'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][separate_items_with_commas]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-separate-items-with-commas" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-add-or-remove-items"><?php _e('Add or remove items', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['add_or_remove_items'] ) ? $taxonomy['labels']['add_or_remove_items'] : 'Add or remove %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][add_or_remove_items]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-add-or-remove-items" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-choose-from-most-used"><?php _e('Choose from the most used items', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['choose_from_most_used'] ) ? $taxonomy['labels']['choose_from_most_used'] : 'Choose from the most used %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][choose_from_most_used]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-choose-from-most-used" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-not-found"><?php _e('No items found', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['not_found'] ) ? $taxonomy['labels']['not_found'] : 'No %s found.'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][not_found]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-not-found" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-no-terms"><?php _e('No items', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['no_terms'] ) ? $taxonomy['labels']['no_terms'] : 'No %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][no_terms]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-no-terms" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-items-list-navigation"><?php _e('Items list navigation', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['items_list_navigation'] ) ? $taxonomy['labels']['items_list_navigation'] : '%s list navigation'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][items_list_navigation]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-items-list-navigation" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-items-list"><?php _e('Items list', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['items_list'] ) ? $taxonomy['labels']['items_list'] : '%s list'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][items_list]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-items-list" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-most-used"><?php _e('Most used', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['most_used'] ) ? $taxonomy['labels']['most_used'] : 'Most used'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][most_used]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-most-used" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ipa-fields-pack-label-back-to-items"><?php _e('Back to items', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></label>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['labels']['back_to_items'] ) ? $taxonomy['labels']['back_to_items'] : 'Back to %s'; ?>
                        <input type="text" aria-required="true" name="ipa-fields-pack-taxonomy[labels][back_to_items]"  value="<?php echo $option; ?>" id="ipa-fields-pack-label-back-to-items" />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="postbox">
        <h2 class="hndle"><?php _e('Options', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></h2>
        <div class="inside">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
				        <?php _e('Public', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['public'] ) ? $taxonomy['public'] : TRUE; ?>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Public', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></span></legend>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[public]" value="1" <?php echo ($option == TRUE) ? 'checked="checked"' : ''; ?>> <?php _e('Yes', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[public]" value="0" <?php echo ($option == FALSE) ? 'checked="checked"' : ''; ?>> <?php _e('No', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
				        <?php _e('Hierarchical', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : TRUE; ?>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Hierarchical', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></span></legend>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[hierarchical]" value="1" <?php echo ($option == TRUE) ? 'checked="checked"' : ''; ?>> <?php _e('Yes', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[hierarchical]" value="0" <?php echo ($option == FALSE) ? 'checked="checked"' : ''; ?>> <?php _e('No', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
				        <?php _e('Show UI', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['show_ui'] ) ? $taxonomy['show_ui'] : TRUE; ?>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Show UI', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></span></legend>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_ui]" value="1" <?php echo ($option == TRUE) ? 'checked="checked"' : ''; ?>> <?php _e('Yes', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_ui]" value="0" <?php echo ($option == FALSE) ? 'checked="checked"' : ''; ?>> <?php _e('No', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
				        <?php _e('Show in menu', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['show_in_menu'] ) ? $taxonomy['show_in_menu'] : TRUE; ?>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Show in menu', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></span></legend>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_in_menu]" value="1" <?php echo ($option == TRUE) ? 'checked="checked"' : ''; ?>> <?php _e('Yes', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_in_menu]" value="0" <?php echo ($option == FALSE) ? 'checked="checked"' : ''; ?>> <?php _e('No', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
				        <?php _e('Show in navs menu', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['show_in_nav_menus'] ) ? $taxonomy['show_in_nav_menus'] : TRUE; ?>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Show in navs menu', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></span></legend>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_in_nav_menus]" value="1" <?php echo ($option == TRUE) ? 'checked="checked"' : ''; ?>> <?php _e('Yes', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_in_nav_menus]" value="0" <?php echo ($option == FALSE) ? 'checked="checked"' : ''; ?>> <?php _e('No', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
				        <?php _e('Show tag cloud', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['show_tagcloud'] ) ? $taxonomy['show_tagcloud'] : TRUE; ?>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Show tag cloud', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></span></legend>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_tagcloud]" value="1" <?php echo ($option == TRUE) ? 'checked="checked"' : ''; ?>> <?php _e('Yes', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_tagcloud]" value="0" <?php echo ($option == FALSE) ? 'checked="checked"' : ''; ?>> <?php _e('No', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
				        <?php _e('Show in quick edit', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['show_in_quick_edit'] ) ? $taxonomy['show_in_quick_edit'] : TRUE; ?>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Show in quick edit', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></span></legend>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_in_quick_edit]" value="1" <?php echo ($option == TRUE) ? 'checked="checked"' : ''; ?>> <?php _e('Yes', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_in_quick_edit]" value="0" <?php echo ($option == FALSE) ? 'checked="checked"' : ''; ?>> <?php _e('No', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
				        <?php _e('Show admin column', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                    </th>
                    <td>
				        <?php $option = isset( $taxonomy['show_admin_column'] ) ? $taxonomy['show_admin_column'] : TRUE; ?>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Show admin column', IPA_Fields_Pack()->plugin->get_txt_domain()) ?></span></legend>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_admin_column]" value="1" <?php echo ($option == TRUE) ? 'checked="checked"' : ''; ?>> <?php _e('Yes', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label>
                            <label>
                                <input type="radio" name="ipa-fields-pack-taxonomy[show_admin_column]" value="0" <?php echo ($option == FALSE) ? 'checked="checked"' : ''; ?>> <?php _e('No', IPA_Fields_Pack()->plugin->get_txt_domain()) ?>
                            </label><br>
                        </fieldset>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php wp_nonce_field($nonce_action, 'ipa-fields-pack-taxonomy[_wpnonce]'); ?>

    <p class="submit">
        <input class="button button-primary" type="submit" name="ipa-fields-pack-taxonomy[<?php echo $action;?>]" value="<?php echo $submit_label; ?>" />
    </p>
</form>