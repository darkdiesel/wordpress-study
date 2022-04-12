<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!class_exists('IPA_PostMeta_Field')):
  class IPA_PostMeta_Field {

	private $label_template = '<h4><label for="%s">%s</label></h4>';
	private $field_template = '<tr><th scope="row">%s</th><td>%s%s</td></tr>';
	private $description_template = '<p class="ipa-field-description">%s</p>';

	private $scripts_registered = FALSE;

	/**
	 *
	 * Function build field by array $meta_arr
	 *
	 * @param array $params Field params.
	 * @param array|bool|string $value
	 * @param bool|string $template Field Template
	 * @param bool $echo Echo field.
	 *
	 * @return \IPA_PostMeta_Field_Abstract|string
	 */
	public function build($params, $value = FALSE, $template = FALSE, $echo = FALSE) {
	  $this->register_scripts();


	  include_once('fields/field-interface.php');
	  include_once('fields/field-abstract.php');

	  /**
	   * @var $field IPA_PostMeta_Field_Abstract
	   */
	  switch (strtolower($params['type'])) {
		case 'hr':
		  include_once('fields/field-hr.php');
		  $field = new IPA_PostMeta_Field_HR();
		  break;
		case 'input-text':
		  include_once('fields/field-input-text.php');
		  $field = new IPA_PostMeta_Field_InputText();
		  break;
		case 'input-password':
		  include_once('fields/field-input-password.php');
		  $field = new IPA_PostMeta_Field_InputPassword();
		  break;
		case 'textarea':
		  include_once('fields/field-textarea.php');
		  $field = new IPA_PostMeta_Field_TextArea();
		  break;
		case 'select':
		  include_once('fields/field-select.php');
		  $field = new IPA_PostMeta_Field_Select();
		  break;
		case 'select-multiple':
		  include_once('fields/field-select-multiple.php');
		  $field = new IPA_PostMeta_Field_Select_Multiple();
		  break;
		case 'select-admin-section':
		  include_once('fields/field-select-admin-section.php');
		  $field = new IPA_PostMeta_Field_Select_AdminSection();
		  break;
		case 'checkbox-multiple':
		  include_once('fields/field-checkbox-multiple.php');
		  $field = new IPA_PostMeta_Field_Checkbox_Multiple();
		  break;
		case 'checkbox-multiple-input-text':
		  include_once('fields/field-checkbox-multiple-input-text.php');
		  $field = new IPA_PostMeta_Field_Checkbox_Multiple_InputText();
		  break;
		case 'radio':
		  include_once('fields/field-radio.php');
		  $field = new IPA_PostMeta_Field_Radio();
		  break;
		case 'upload':
		  include_once('fields/field-upload.php');
		  $field = new IPA_PostMeta_Field_Upload();
		  break;
		case 'slider':
		  include_once('fields/field-slider.php');
		  $field = new IPA_PostMeta_Field_Slider();
		  break;
		default:
		  $field = new IPA_PostMeta_Field_Abstract();
		  break;
	  }

	  /**
	   * Setup field template
	   */
	  if ($template) {
		$field_template = $template;
	  }
	  else {
		$field_template = $this->field_template;
	  }

	  /**
	   * Build field with template
	   */
	  $field_id   = $field->build_field_id($params);
	  $field_html = $field->build($params, $value);

	  if (isset($params['label'])) {
		$field_label = sprintf($this->label_template, $field_id, $params['label']);
	  }
	  else {
		$field_label = '';
	  }

	  if (isset($params['description'])) {
		$field_description = sprintf($this->description_template, $params['description']);
	  }
	  else {
		$field_description = '';
	  }

	  $field_html = sprintf($field_template, $field_label, $field_html, $field_description);

	  if ($echo) {
		echo $field_html;
	  }

	  return $field_html;
	}

	public function set_template($template) {
	  if ($template) {
		$this->field_template = $template;
	  }
	}

	public function register_scripts() {
	  if ($this->scripts_registered) {
		return TRUE;
	  }

	  IPA_PostMeta::add_admin_enqueue_scripts();

	  $this->scripts_registered = TRUE;
	}
  }
endif;