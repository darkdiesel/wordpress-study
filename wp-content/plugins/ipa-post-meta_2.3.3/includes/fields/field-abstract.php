<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!class_exists('IPA_PostMeta_Field_Abstract')):
  class IPA_PostMeta_Field_Abstract {
	/**
	 * @return array
	 */
	public function get_default_attributes() {
	  //Should be rewrited in child class!
	  return array();
	}

	public function merge_attributes($default, $new){
	  return array_replace($default, $new);
	}

	/**
	 * @param $attrs
	 *
	 * @return string
	 */
	public function build_attributes_string($attrs) {
	  if (!is_array($attrs)){
	    return '';
	  }

	  $attributes = '';

	  foreach ($attrs as $attribute => $attribute_value){
		$attributes .= sprintf(' %s="%s"',$attribute, $attribute_value);
	  }

	  return $attributes;
	}

	public function build_data_attributes_string($attrs) {
	  if (!is_array($attrs)){
		return '';
	  }

	  $attributes = '';

	  foreach ($attrs as $attribute => $attribute_value){
		$attributes .= sprintf(' data-%s="%s"',str_replace(' ', '-', $attribute), $attribute_value);
	  }

	  return $attributes;
	}

	/**
	 * @param $params
	 *
	 * @return string
	 */
	public function build_field_id($params) {
	  return sprintf('%s-%s', $params['type'], $params['name']);
	}



  }
endif;