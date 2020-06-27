<?php defined('BASEPATH') or exit('No direct script access allowed');

class Filter_ValuesModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'filter_values';
	}
}

/* End of file Filter_ValuesModel.php */
