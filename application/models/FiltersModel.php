<?php defined('BASEPATH') or exit('No direct script access allowed');

class FiltersModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'filters';
	}
}

/* End of file FiltersModel.php */
