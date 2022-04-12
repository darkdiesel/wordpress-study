<?php
/**
 * Admin Template: Page - Settings
 *
 */


defined( 'ABSPATH' ) || exit;
$action = 'save';
?>

<div class="wrap">
    <div class="wrap-header">
        <h1 class="wp-heading-inline"><?php _e('IPA Fields Pack Settings', IPA_Fields_Pack()->plugin->get_txt_domain()); ?></h1>
    </div>

    <hr class="wp-header-end">

    <form id="ipa-fields-pack-settings-form" novalidate="novalidate" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <label for="color"><?php _e('Background Color:', IPA_Fields_Pack()->plugin->get_txt_domain()); ?></label>
                </th>
                <td>
	                <?php $option = isset( $settings['color'] ) ? $settings['color'] : ''; ?>
                    <input type="text" id="color" value="<?php echo $option; ?>" name="color" class="wp-color-picker-field" />
                </td>
            </tr>
            </tbody>
        </table>

        <p class="submit">
            <input
                class="button button-primary button-large button-submit ipa-fields-pack-settings-submit"
                type="submit"
                name="ipa_fields_pack_settings[submit]"
                value="<?php _e( 'Save settings', IPA_Fields_Pack()->plugin->get_txt_domain() ) ?>"/>

            <span class="ajax-process"><img src="<?php echo admin_url( 'images/spinner.gif' ) ?>" alt=""></span>
        </p>
    </form>
</div>