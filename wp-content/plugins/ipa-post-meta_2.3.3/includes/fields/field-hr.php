<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!class_exists('IPA_PostMeta_Field_HR')):
  class IPA_PostMeta_Field_HR extends IPA_PostMeta_Field_Abstract {
	private $template = '<hr/>';


	public function build($params, $value) {
	  ob_start(); ?>
	  <?php echo $this->template; ?>
	  <?php
	  return ob_get_clean();
	}
  }
endif;