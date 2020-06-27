<?php defined('BASEPATH') or exit('No direct script access allowed');

class Filter_Product_Category_RelationsModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'filter_product_category_relations';
	}
}

/* End of file Filter_Product_Category_RelationsModel.php */
