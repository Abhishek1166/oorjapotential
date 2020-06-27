<?php defined('BASEPATH') or exit('No direct script access allowed');

class SettingsModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'settings';
	}

	function get_option($option_key = null)
	{
		if (empty($option_key))
			return false;

		return $this->first([
			'option_key' => $option_key
		])['option_value'];
	}

	function get_header_option()
	{
		$data['site_favicon'] = $this->get_option('site_favicon');
		$data['site_name']    = $this->get_option('site_name');
		$data['site_logo']    = $this->get_option('site_logo');
		$data['site_mobile']  = $this->get_option('site_mobile');
		$data['email']        = $this->get_option('site_mail');
		$data['facebook']     = $this->get_option('social_facebook');
		$data['instagram']    = $this->get_option('social_instagram');
		$data['twitter']      = $this->get_option('social_twitter');
		$data['youtube']      = $this->get_option('social_youtube');
		return $data;
	}
}

/* End of file SettingsModel.php */
