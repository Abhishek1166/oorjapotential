<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model
{

	/**
	 * Class constructor
	 *
	 * @link	https://github.com/bcit-ci/CodeIgniter/issues/5332
	 * @return	void
	 */
	public function __construct()
	{
	}

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}

	function check_column_exists($fields)
	{
		return $this->db->field_exists($fields, $this->tableName);
	}

	public function save(array $col_val_arr)
	{
		$this->db->insert($this->tableName, $col_val_arr);
		return $this->db->insert_id();
	}

	public function all(array $param = null)
	{
		if (isset($param['fields']) && !empty($param['fields'])) {
			$fields_str = implode(',', $param['fields']);
			$this->db->select($fields_str);
		} else {
			$this->db->select('*');
		}

		if (isset($param['conditions']) && !empty($param['conditions'])) {
			$this->db->where($param['conditions']);
		}

		if (isset($param['paging']) && !empty($param['paging'])) {
			$start = ($param['paging']['page'] - 1) * $param['paging']['limit'];
			$this->db->limit($param['paging']['limit'], $start);
		}

		if (isset($param['join']) && !empty($param['join'])) {
			isset($param['join']['type']) and !empty($param['join']['type']) and $type = $param['join']['type'] or $type = 'inner';
			$this->db->join($param['join']['tableName'], $param['join']['condition'], $type);
		}

		if (isset($param['order']) && !empty($param['order'])) {
			$this->db->order_by($param['order']['by'], $param['order']['type']);
		}
		$query = $this->db->get($this->tableName);
		isset($param['datatype']) || $result = $query->result_array();
		isset($param['datatype']) && !empty($param['datatype']) && $result = $query->result();
		return $result;
	}

	public function first($param)
	{
		if (is_array($param) == true) {
			if (isset($param['conditions'])) {
				$conditions = $param['conditions'];
			} else {
				$conditions = $param;
			}
		} else {
			$conditions = ['id' => $param];
		}

		if (isset($param['fields']) && !empty($param['fields'])) {
			$fields_str = implode(',', $param['fields']);
			$this->db->select($fields_str);
		} else {
			$this->db->select('*');
		}

		$query = $this->db->get_where($this->tableName, $conditions);
		//
		$result = $query->result_array();

		// $this->db->last_query();
		if (!empty($result)) {
			return $result[0];
		} else {
			return NULL;
		}
	}

	/**
	 * $where_data = $set_data = ['column_name1' => $value1, 'column_name21' => $value2]
	 * $where_data = $id
	 */
	public function updateTable($set_data, $where_data = null)
	{
		$this->db->set($set_data);
		if (isset($where_data) && $where_data != null) {
			if (is_array($where_data)) {
				$this->db->where($where_data);
			} else {
				$this->db->where('id', $where_data);
			}

			$this->db->update($this->tableName);
		}

		//echo $this->db->last_query();
		return $this->db->last_query();
	}


	public function destroy($where_data = null)
	{
		if (isset($where_data) && $where_data != null) {
			$this->db->where($where_data);
		}
		$this->db->delete($this->tableName);
	}

	public function count($param)
	{
		if (isset($param['conditions']) && !empty($param['conditions'])) {
			$this->db->where($param['conditions']);
		}
		$this->db->from($this->tableName);
		$return = $this->db->count_all_results();
		//echo $this->db->last_query();
		return $return;
	}
}
