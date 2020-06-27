<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_ModulesModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'user_modules';
	}
}

/* End of file User_ModulesModel.php */
