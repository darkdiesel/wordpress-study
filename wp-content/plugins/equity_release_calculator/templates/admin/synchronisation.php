<?php
/**
 * @var array $settings
 */
?>

<div class="wrap">
	<div class="wrap-header">
		<h1><?php _e( 'Equity Release Calculator Synchronisation Settings', ER_Calculator()->plugin->get_text_domain()); ?></h1>
	</div>

    <form id="erc-sync-form" novalidate="novalidate" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <input
                class="button button-controls button-large button-submit erc-sync-submit"
                type="submit"
                name="erc-sync-submit"
                value="<?php _e( 'Sync all data', ER_Calculator()->plugin->get_text_domain() ) ?>"/>

        <span class="ajax-process"><img src="<?php echo admin_url( 'images/spinner.gif' ) ?>" alt=""></span>
    </form>

    <br/>

	<form id="erc-sync-settings-form" novalidate="novalidate" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
		<input
			class="button button-primary button-large button-submit erc-sync-settings-submit"
			type="submit"
			name="erc-sync-settings-submit"
			value="<?php _e( 'Save settings', ER_Calculator()->plugin->get_text_domain() ) ?>"/>

		<span class="ajax-process"><img src="<?php echo admin_url( 'images/spinner.gif' ) ?>" alt=""></span>

		<div class="ipa-postbox">
			<h2 class="ipa-hndle">
				<span><?php _e( 'Settings', ER_Calculator()->plugin->get_text_domain() ); ?></span></h2>
			<div class="ipa-inside">
				<table class="form-table">
					<tbody>
					<tr>
						<td>
							<label for="enable"><?php _e('Enabled:', ER_Calculator()->plugin->get_text_domain()); ?></label>
						</td>
						<td>
							<?php
							$option = isset( $settings['enable'] ) ? $settings['enable'] : '';
							?>
							<select id="enable" name="enable" >
								<option value="1"  <?php echo ( $option ) ? "selected" : '' ; ?>><?php _e('Yes', ER_Calculator()->plugin->get_text_domain()); ?></option>
								<option value="0"  <?php echo ( !$option ) ? "selected" : '' ; ?>><?php _e('No', ER_Calculator()->plugin->get_text_domain()); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="site_type"><?php _e('Parent or Child site:', ER_Calculator()->plugin->get_text_domain()); ?></label>
						</td>
						<td>
							<?php
							$option = isset( $settings['site_type'] ) ? $settings['site_type'] : '';
							?>
							<select id="site_type" name="site_type" >
								<option value="<?php echo ER_Calculator_Plugin::SYNC_SITE_TYPE_CHILD; ?>" <?php echo $option == ER_Calculator_Plugin::SYNC_SITE_TYPE_CHILD ? "selected" : '' ; ?>><?php echo __('Child'); ?></option>
								<option value="<?php echo ER_Calculator_Plugin::SYNC_SITE_TYPE_PARENT; ?>" <?php echo $option == ER_Calculator_Plugin::SYNC_SITE_TYPE_PARENT ? "selected" : '' ; ?>><?php echo __('Parent'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="text"><?php _e('Secure phrase:', ER_Calculator()->plugin->get_text_domain()); ?></label>
						</td>
						<td>
							<?php
							$option = isset( $settings['secure'] ) ? $settings['secure'] : '';
							?>
							<input id="text" type="text" name="secure" value="<?php echo $option; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label for="sites"><?php _e('List of child sites:', ER_Calculator()->plugin->get_text_domain()); ?></label>
						</td>
						<td>
							<?php $option = isset( $settings['sites'] ) ? $settings['sites'] : ''; ?>
							<textarea name="sites" id="sites" cols="30" rows="10"><?php echo removeSlash($option); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<label for="data_types"><?php _e('Update data type:', ER_Calculator()->plugin->get_text_domain()); ?></label>
						</td>
						<td>
							<?php $option = isset( $settings['data_types'] ) ? $settings['data_types'] : ''; ?>
                            <select id="data_types" name="data_types[]" multiple="multiple">
                                <option value="age" <?php echo ( in_array( 'age', $option ) ) ? "selected" : '' ; ?>><?php _e('Age'); ?></option>
                                <option value="percentage"  <?php echo ( in_array( 'percentage', $option ) ) ? "selected" : '' ; ?>><?php _e('Percentages'); ?></option>
                                <option value="percentage_hr"  <?php echo ( in_array( 'percentage_hr', $option ) ) ? "selected" : '' ; ?>><?php _e('Percentages Home Reversion'); ?></option>
                                <option value="calculator"  <?php echo ( in_array( 'calculator', $option ) ) ? "selected" : '' ; ?>><?php _e('Calculators'); ?></option>
                            </select>
                            <p class="description"><?php _e('Select data that you need to update'); ?></p>
						</td>
					</tr>
					<tr>
						<td>
							<label for="ignore_ssl"><?php _e('Ignore valid ssl certificates on requests:', ER_Calculator()->plugin->get_text_domain()); ?></label>
						</td>
						<td>
							<?php
							$option = isset( $settings['ignore_ssl'] ) ? $settings['ignore_ssl'] : '';
							?>
							<select id="ignore_ssl" name="ignore_ssl" >
								<option value="1"  <?php echo ( $option ) ? "selected" : '' ; ?>><?php echo __('Yes'); ?></option>
								<option value="0"  <?php echo ( !$option ) ? "selected" : '' ; ?>><?php echo __('No'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="logger"><?php _e('Enable Logger:', ER_Calculator()->plugin->get_text_domain()); ?></label>
						</td>
						<td>
							<?php
							$option = isset( $settings['logger'] ) ? $settings['logger'] : '';
							?>
							<select id="logger" name="logger" >
								<option value="1"  <?php echo ( $option ) ? "selected" : '' ; ?>><?php _e('Yes', ER_Calculator()->plugin->get_text_domain()); ?></option>
								<option value="0"  <?php echo ( !$option ) ? "selected" : '' ; ?>><?php _e('No', ER_Calculator()->plugin->get_text_domain()); ?></option>
							</select>
							<p class="description"><?php _e('Logger write data to log.txt file in root plugin folder'); ?></p>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>

		<input
			class="button button-primary button-large button-submit erc-sync-settings-submit"
			type="submit"
			name="erc-sync-settings-submit"
			value="<?php _e( 'Save settings', ER_Calculator()->plugin->get_text_domain() ) ?>"/>

		<span class="ajax-process"><img src="<?php echo admin_url( 'images/spinner.gif' ) ?>" alt=""></span>
	</form>
</div>