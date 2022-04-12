<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!class_exists('IPA_PostMeta_Field_InputText')):
  class IPA_PostMeta_Field_InputText extends IPA_PostMeta_Field_Abstract implements IPA_PostMeta_Field_Interface {
  	private $template;

	function __construct($template = '') {
	  if (isset($template) && $template){
	    $this->set_template($template);
	  } else {
	    $this->set_template('<input type="text" value="%s" name="%s" %s />');
	  }
	}

	public function build($params, $value) {
	  ob_start(); ?>
	  <?php

	  $attributes = $this->get_default_attributes();

	  if (isset($params['attributes']) && is_array($params['attributes'])){
		$attributes = $this->merge_attributes($attributes, $params['attributes']);
	  }

	  $attributes = $this->build_attributes_string($attributes);
	  ?>

	  <?php echo sprintf($this->get_template(), $value, $params['name'], $attributes); ?>

	  <?php
	  return ob_get_clean();
	}

	public function set_template($template){
	  $this->template = $template;
	}

	public function get_template(){
	  return $this->template;
	}

	function get_default_attributes(){
	  return array(
	    'class' => 'regular-text'
	  );
	}
  }
endif;