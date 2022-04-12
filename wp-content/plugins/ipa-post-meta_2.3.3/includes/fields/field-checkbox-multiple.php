<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( ! class_exists( 'IPA_PostMeta_Field_Checkbox_Multiple' ) ):
  class IPA_PostMeta_Field_Checkbox_Multiple extends IPA_PostMeta_Field_Abstract {

	private $checkbox_template = '<input type="checkbox" value="%s" name="%s[]" class="%s" %s />%s';
	private $class = 'ipa-post-meta-checkbox';

	public function build( $params, $values ) {
	  ob_start(); ?>

	  <?php
	  if (!is_array($values)) {
	    $values = array();
	  }
	  ?>

	  <?php
	  if ( isset( $params['class'] ) && $params['class'] ) {
		$field_class = $params['class'];
	  } else {
		$field_class = $this->class;
	  }
	  ?>

	  <?php if (isset($params['options']) && is_array($params['options']) && count($params['options'])) : ?>
		<ul class="list-table ipa-post-meta-checkboxes-wrapper">
		<?php foreach ($params['options'] as $value => $label): ?>
		  <?php
		  	$checked = in_array($value, $values);
		  ?>
		  <li class="ipa-post-meta-checkbox-wrapper">
			<div>
				<?php echo sprintf( $this->checkbox_template, $value, $params['name'], $field_class, ($checked) ? 'checked' : '', $label ); ?>
			</div>
		  </li>
		<?php endforeach; ?>
		</ul>
	  <?php endif; ?>

	  <?php
	  return ob_get_clean();
	}
  }
endif;