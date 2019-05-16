<?php
/**
 * Admin Template: Page - Settings
 */

defined( 'ABSPATH' ) || exit;

$action = 'save';
?>

<div class="wrap">
    <div class="wrap-header">
        <h1 class="wp-heading-inline"><?php _e('Letterbox Thumbnails Settings', LetterboxThumbnails()->plugin->get_txt_domain()); ?></h1>
    </div>

    <hr class="wp-header-end">

    <form id="letterbox-thumbnails-settings-form" novalidate="novalidate" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <label for=""><?php _e('LetterBox Background Color:', LetterboxThumbnails()->plugin->get_txt_domain()); ?></label>
                </th>
                <td>
	                <?php
	                $option = isset( $settings['color'] ) ? $settings['color'] : '';
	                ?>
                    <input type="text" value="<?php echo $option; ?>" name="color" class="wp-color-picker-field" />
                </td>
            </tr>
            </tbody>
        </table>

        <p class="submit">
            <input
                class="button button-primary button-large button-submit letterbox-thumbnails-settings-submit"
                type="submit"
                name="letterbox_thumbnails_settings[submit]"
                value="<?php _e( 'Save settings', LetterboxThumbnails()->plugin->get_txt_domain() ) ?>"/>

            <span class="ajax-process"><img src="<?php echo admin_url( 'images/spinner.gif' ) ?>" alt=""></span>
        </p>
    </form>
</div>