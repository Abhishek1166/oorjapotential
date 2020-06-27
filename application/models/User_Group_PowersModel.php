<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_Group_PowersModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'user_group_powers';
	}
}

/* End of file User_Group_PowersModel.php */
