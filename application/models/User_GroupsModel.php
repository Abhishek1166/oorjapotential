<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_GroupsModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'user_groups';
	}
}

/* End of file User_GroupsModel.php */
