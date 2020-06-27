<?php
// -----------------------------------------------------------
// 					GET_DATA_FROM FUNCTION
// -----------------------------------------------------------
if (!function_exists('get_data_from')) {
	/** Format Numaric String to Indian Currency Format
	 * @param mixed $price
	 * @return string|0 */
	function get_data_from($table)
	{
		$ci = get_instance();
		if ($ci->db->table_exists($table)) {
			$ci->tableName = $table;

			$ci->db->select($table . '.*, parent.first_name, parent.last_name, parent.profile_pic');

			$ci->db->field_exists('created_by', $ci->tableName)
				and $ci->db->join('users as parent', $table . '.created_by = parent.id');

			$ci->db->where([$table . '.status' => true]);
			$ci->db->order_by($table . '.id', 'desc');

			$query = $ci->db->get($ci->tableName);
			return $query->result();
		}
		return error_show('`' . $table . '` Table Not Exists.');
	}
}


function get_properties_details($data)
{
	$ci = &get_instance();

	// Get Project Filter ID
	$project = $ci->db->get_where("filters", ['slug' => 'projects'])->first_row();
	is($project, 'json') and $project_id = $project->id;

	// Get Location Filter ID
	$location = $ci->db->get_where("filters", ['slug' => 'locality'])->first_row();
	is($location, 'json') and $location_id = $location->id;

	if (is($data))
		foreach ($data as $key => $value) {

			// Get Project & Property Relation
			is($project_id) and $project_relation = $ci->db->get_where("filter_product_category_relations", [
				'key_id'     => $project_id,
				'product_id' => $value->id
			])->first_row();
			is($project_relation, 'json') and $project_value_id = $project_relation->value_id;

			// Get Project Name
			is($project_value_id) and $project = $ci->db->get_where("filter_values", ['id' => $project_value_id])->first_row();
			is($project, 'json') and $project_name = $project->filter_value_title;

			// Send with Data
			is($project_name) and $data[$key]->project = $project_name;

			// Get Location Relation
			is($location_id) and $location_relation = $ci->db->get_where("filter_product_category_relations", [
				'key_id'     => $location_id,
				'product_id' => $value->id
			])->first_row();
			is($location_relation, 'json') and $location_value_id = $location_relation->value_id;

			// Get Location Name
			is($location_value_id) and $locationss = $ci->db->get_where("filter_values", ['id' => $location_value_id])->first_row();
			is($locationss, 'json') and $location_name = $locationss->filter_value_title;

			// Send with Data
			is($location_name) and $data[$key]->location = $location_name;

			//city
			is($value->extra_field_1) and $data[$key]->city = $value->extra_field_1;

			// Get Image
			strpos($value->image, '@') and $img = explode('@', $value->image) and is_array($img) and $data[$key]->image = $img[0] or $data[$key]->image = $value->image;
		}

	return $data;
}

/* End of file db_helper.php */
