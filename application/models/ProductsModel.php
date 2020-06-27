<?php defined('BASEPATH') or exit('No direct script access allowed');

class ProductsModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'products';
	}

	function get_featured_property()
	{
		$featured_products = $this->all([
			'conditions' => [
				'products.status'      => true,
				'products.is_featured' => true,
				'products.post_type'   => 'property',
			],
			'order' => [
				'by'   => 'is_featured',
				'type' => 'desc'
			],
			'datatype' => 'json'
		]);

		// Get Project Filter ID
		$project = $this->db->get_where("filters", ['slug' => 'projects'])->first_row();
		is($project, 'json') and $project_id = $project->id;

		// Get Location Filter ID
		$location = $this->db->get_where("filters", ['slug' => 'locality'])->first_row();
		is($location, 'json') and $location_id = $location->id;

		// Get City Filter ID
		$city = $this->db->get_where("filters", ['slug' => 'city'])->first_row();
		is($city, 'json') and $city_id = $city->id;

		if (is($featured_products))
			foreach ($featured_products as $key => $value) {

				// Get Project & Property Relation
				is($project_id) and $project_relation = $this->db->get_where("filter_product_category_relations", [
					'key_id'     => $project_id,
					'product_id' => $value->id
				])->first_row();
				is($project_relation, 'json') and $project_value_id = $project_relation->value_id;

				// Get Project Name
				is($project_value_id) and $project = $this->db->get_where("filter_values", ['id' => $project_value_id])->first_row();
				is($project, 'json') and $project_name = $project->filter_value_title;

				// Send with Data
				is($project_name) and $featured_products[$key]->project    = $project_name;
				is($project_name) and $featured_products[$key]->project_id = $project_value_id;

				// Get Project & Property Relation
				is($location_id) and $location_relation = $this->db->get_where("filter_product_category_relations", [
					'key_id'     => $location_id,
					'product_id' => $value->id
				])->first_row();
				is($location_relation, 'json') and $location_value_id = $location_relation->value_id;

				// Get Project Name
				is($location_value_id) and $location = $this->db->get_where("filter_values", ['id' => $location_value_id])->first_row();
				is($location, 'json') and $location_name = $location->filter_value_title;

				// Send with Data
				is($location_name) and $featured_products[$key]->location = $location_name;

				// Send with Data
				is($value->extra_field_1) and $featured_products[$key]->city = $value->extra_field_1;

				// Get Image
				strpos($value->image, '@') and $img = explode('@', $value->image) and is_array($img) and $featured_products[$key]->image = $img[0] or $featured_products[$key]->image = $value->image;
			}
		return $featured_products;
	}
}

/* End of file ProductsModel.php */
