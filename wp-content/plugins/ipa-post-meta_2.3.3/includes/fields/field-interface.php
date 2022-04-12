<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!interface_exists('IPA_PostMeta_Field_Interface')):
  interface IPA_PostMeta_Field_Interface {
	/**
	 * Function build html of field by
	 *
	 * @param array $params Contains params for field.
	 * @param string $value Value for field
	 *
	 * @return string
	 */
	public function build($params, $value);

	/**
	 * Function return field template
	 *
	 * @return mixed
	 */
	public function get_template();

	/**
	 * Set field template
	 *
	 * @param $template
	 *
	 * @return mixed
	 */
	public function set_template($template);
  }
endif;