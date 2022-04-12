<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!class_exists('IPA_PostMeta_Field_Radio')):
  class IPA_PostMeta_Field_Radio extends IPA_PostMeta_Field_Abstract {

	private $radio_template = '<label><input type="radio" value="%s" name="%s" %s %s>%s</label>';
	private $class = 'ipa-post-meta-radio'; // MAKE not overrided
	private $horizontal = FALSE;

	public function build($params, $value) {
	  ob_start(); ?>

	  <?php
	  // attributes
	  $attributes = $this->get_default_attributes();

	  if (isset($params['attributes']) && is_array($params['attributes'])) {
		$attributes = $this->merge_attributes($attributes, $params['attributes']);
	  }

	  $attributes = $this->build_attributes_string($attributes);

	  if (isset($params['horizontal']) && $params['horizontal']) {
		$horizontal = $params['horizontal'];
	  }
	  else {
		$horizontal = $this->horizontal;
	  }
	  ?>

	  <?php if (isset($params['options']) && is_array($params['options']) && count($params['options'])) : ?>
		<?php foreach ($params['options'] as $radio_value => $label): ?>
		  <?php
		  $checked = ($value == $radio_value);
		  echo sprintf($this->radio_template, $radio_value, $params['name'], $attributes, ($checked) ? 'checked' : '', $label);
		  echo $horizontal ? '<br/>' : ''
		  ?>
		<?php endforeach; ?>
	  <?php endif; ?>

	  <?php
	  return ob_get_clean();
	}

	function get_default_attributes() {
	  return array(
		'class' => $this->class
	  );
	}
  }
endif;