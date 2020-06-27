<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Property Pages & Queries */
class Property extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		$this->load->model([
			'CategoriesModel',
			'FiltersModel',
			'Filter_ValuesModel',
			'ProductsModel',
			'Filter_Product_Category_RelationsModel',
			'UsersModel'
		]);
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}

	/** Add Property */
	public function add_property()
	{

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('property_add') or show_404();

		if ($this->input->post('addProperty')) {

			flash_message(
				'add/property',
				$this->input->post('name')
					and $this->input->post('srtDesc')
					and $this->input->post('desc')
					and $this->input->post('cat')
					and $this->input->post('city')
					and $this->input->post('size')
					and $this->input->post('pdate')
					and $this->input->post('filter')
					and is_array($this->input->post('filter')),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			flash_message(
				'add/property',
				$this->input->post('pdate')
					and ($this->input->post('pdate') === 'rtmo') or ($this->input->post('pdate') === 'uc'
						and $this->input->post('ucdate')),
				'unsuccess',
				'Something Went Wrong',
				'Look Under Construction Date Not Fill, Please Fill & Try Again.'
			);

			/* Upload Images */
			$form_images = upload(['uploads/property' => 'propertyImg']);

			flash_message(
				'add/property',
				isset($form_images['propertyImg'][0])
					and !empty($form_images['propertyImg'][0]),
				'unsuccess',
				'Something Went Wrong',
				'Please Upload Atleast One Image.'
			);

			isset($form_images['propertyImg']) or $property_image = "";
			is_array($form_images['propertyImg']) and $property_image = implode('@', $form_images['propertyImg']);

			// Slug
			$slug = str_clean($this->input->post('name'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->ProductsModel->first(['slug' => $slug]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			$this->input->post('pdate') === 'rtmo' and $pdate = date('Y-m-d h:i:s', time());
			$this->input->post('pdate') === 'uc' and $pdate = $this->input->post('ucdate');

			$this->input->post('featured') === 'on' and $feature = true or $feature = '';
			$this->input->post('hotDeals') === 'on' and $deal    = true or $deal    = '';

			is($_POST['minPrice']) or $_POST['minPrice'] = 'on-request';
			is($_POST['maxPrice'])
				and $maxPrice = $this->input->post('maxPrice')
				or  $maxPrice = $this->input->post('minPrice');

			$property_id = $this->ProductsModel->save([
				'title'           => $this->input->post('name'),
				'slug'            => $slug,
				'post_type'       => 'property',
				'category_id'     => $this->input->post('cat'),
				'srt_description' => $this->input->post('srtDesc'),
				'description'     => $this->input->post('desc'),
				'regular_price'   => $this->input->post('minPrice'),
				'sell_price'      => $maxPrice,
				'image'           => $property_image,
				'extra_field'     => $this->input->post('size'),
				'extra_field_1'   => str_clean($this->input->post('city'), [' ', '-', '_'], 'slug'),
				'extra_date'      => $pdate,
				'offers'          => $this->input->post('offers'),
				'extra_id'        => $this->input->post('reraID'),
				'avg_rate'        => $this->input->post('rate'),
				'rating_count'    => $this->input->post('rateCount'),
				'status'          => true,
				'on_deal'         => $deal,
				'is_featured'     => $feature,
				'created_by'      => $_SESSION['USER_ID'],
				'modified_by'     => $_SESSION['USER_ID'],
			]);

			if ($this->input->post('filter')) {

				foreach ($_POST['filter'] as $key => $val) {

					$filter_id = $key;
					foreach ($val as $value) {

						(is_numeric($value) or $value_id = $this->Filter_ValuesModel->save([
							'filter_key_id'      => $key,
							'filter_value_title' => $value,
							'slug'               => str_clean($value, [' ', '-', '_'], 'slug'),
							'status'             => true,
							'created_by'         => $_SESSION['USER_ID'],
							'modified_by'        => $_SESSION['USER_ID']
						])) and $values = $this->Filter_ValuesModel->all(['filter_value_title' => $value]);

						if (!is_numeric($value)) {
							foreach ($values as $value) {
								$value = $value_id;
							}
						}

						$Relation = $this->Filter_Product_Category_RelationsModel->save([
							'key_id'      => $filter_id,
							'value_id'    => $value,
							'product_id'  => $property_id,
							'category_id' => $this->input->post('cat')
						]);
					}
				}
			}

			flash_message(
				'list/properties',
				$Relation,
				'unsuccess',
				'Something Went Wrong'
			);

			flash_message(
				'list/properties',
				$Relation,
				'success',
				'Property Added Successfully'
			);
		}

		$city = $this->ProductsModel->all([
			'fields' => ['distinct(extra_field_1) as city'],
			'conditions' => [
				'status'    => true,
				'post_type' => 'property'
			],
			'order' => [
				'by' => 'city',
				'type' => 'asc'
			],
			'datatype' => 'json'
		]);
		show_debug($city);

		$category = $this->CategoriesModel->all([
			'fields'     => ['id', 'title'],
			'conditions' => [
				'status'  => true,
				'post_type' => 'property'
			],
			'datatype' => 'json'
		]);

		$filters = $this->FiltersModel->all([
			'conditions' => [
				'status'  => true,
				'post_type' => 'property'
			],
			'datatype' => 'json'
		]);

		$filterValue = $this->Filter_ValuesModel->all([
			'fields'     => ['id', 'filter_key_id', 'filter_value_title', 'slug'],
			'conditions' => ['status' => true],
			'datatype'   => 'json'
		]);

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('property/add', compact('category', 'filters', 'filterValue', 'city'));
		$this->load->view('template/footer');
	}


	/** Load Property List Page */
	public function list_property()
	{

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('property_list') or show_404();
		$propertyData = json_decode(json_encode([
			'type' => 'Properties'
		]));
		$property = $this->ProductsModel->all([
			'conditions' => [
				'status!='  => '3',
				'post_type' => 'property'
			],
			'order' => [
				'by'   => 'id',
				'type' => 'DESC'
			]
		]);

		$project_key = $this->FiltersModel->first(['filter_title' => 'projects'])['id'];

		if (is($property)) foreach ($property as $key => $val) {

			// Product Relations
			$Projects = $this->Filter_Product_Category_RelationsModel->first([
				'product_id' => $val['id'],
				'key_id' => $project_key // Project Filter ID
			]);

			empty($Projects) or is_array($Projects) and $project = $this->Filter_ValuesModel->first([
				'filter_key_id' => $project_key,
				'id' => $Projects['value_id']
			]);
			empty($Projects) or is_array($Projects) and $cat = $this->CategoriesModel->first($Projects['category_id']);

			// Get User Name
			$user = $this->UsersModel->first($val['created_by']);
			empty($user) and $property[$key]['created_by'] = '' or $property[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);

			// Get Image
			strpos($val['image'], '@') and $img = explode('@', $val['image']) and is_array($img) and $property[$key]['image'] = $img[0] or $property[$key]['image'] = $val['image'];

			// Get Category
			empty($cat) and $property[$key]['category'] = '' or $property[$key]['category'] =  ucwords($cat['title']);

			// Get Project
			(empty($project) and is_null($project)) and $property[$key]['project'] = '' or $property[$key]['project'] =  ucwords($project['filter_value_title']);
		}

		is($property) and is_array($property) and $propertyData = json_decode(json_encode([
			'type' => 'Properties',
			'data' => $property
		]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('property/list', compact('propertyData'));
		$this->load->view('template/footer');
	}


	/** Edit Property */
	public function edit_property($property_slug)
	{
		empty($property_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('property_edit') or show_404();

		if ($this->input->post('editProperty')) {

			flash_message(
				'edit/property/' . $property_slug,
				$this->input->post('name')
					and $this->input->post('srtDesc')
					and $this->input->post('desc')
					and $this->input->post('cat')
					and $this->input->post('city')
					and $this->input->post('size')
					and $this->input->post('pdate')
					and $this->input->post('filter')
					and is_array($this->input->post('filter')),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			flash_message(
				'edit/property/' . $property_slug,
				$this->input->post('pdate')
					and ($this->input->post('pdate') === 'rtmo') or ($this->input->post('pdate') === 'uc'
						and $this->input->post('ucdate')),
				'unsuccess',
				'Something Went Wrong',
				'Look Under Construction Date Not Fill, Please Fill & Try Again.'
			);

			/* Upload Images */
			$form_images = upload(['uploads/property' => 'propertyImg']);

			flash_message(
				'edit/property/' . $property_slug,
				is($form_images['propertyImg'][0])
					or is($_POST['oldpropertyImg']),
				'unsuccess',
				'Something Went Wrong',
				'Please Upload Atleast One Image.'
			);

			if (is($_POST['oldpropertyImg'], 'array'))
				foreach ($_POST['oldpropertyImg'] as $img);
			is($form_images['propertyImg'], 'array')
				and $property_image = implode('@', $form_images['propertyImg'])
				or $property_image = $img;

			// Slug
			$slug = str_clean($this->input->post('name'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->ProductsModel->first([
				'slug'  => $slug,
				'id !=' => $this->input->post('product_id')
			]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			$this->input->post('pdate') === 'rtmo' and $pdate = date('Y-m-d h:i:s', time());
			$this->input->post('pdate') === 'uc' and $pdate = $this->input->post('ucdate');

			$this->input->post('featured') === 'on' and $feature = true or $feature = '';
			$this->input->post('hotDeals') === 'on' and $deal    = true or $deal    = '';

			is($_POST['minPrice']) or $_POST['minPrice'] = 'on-request';
			is($_POST['maxPrice'])
				and $maxPrice = $this->input->post('maxPrice')
				or  $maxPrice = $this->input->post('minPrice');

			$property_id = $this->ProductsModel->updateTable([
				'title'           => $this->input->post('name'),
				'slug'            => $slug,
				'srt_description' => $this->input->post('srtDesc'),
				'category_id'     => $this->input->post('cat'),
				'description'     => $this->input->post('desc'),
				'regular_price'   => $this->input->post('minPrice'),
				'sell_price'      => $maxPrice,
				'image'           => $property_image,
				'extra_field'     => $this->input->post('size'),
				'extra_field_1'   => str_clean($this->input->post('city'), [' ', '-', '_'], 'slug'),
				'extra_date'      => $pdate,
				'offers'          => $this->input->post('offers'),
				'extra_id'        => $this->input->post('reraID'),
				'avg_rate'        => $this->input->post('rate'),
				'rating_count'    => $this->input->post('rateCount'),
				'status'          => $this->input->post('status'),
				'on_deal'         => $deal,
				'is_featured'     => $feature,
				'modified_by'     => $_SESSION['USER_ID'],
			], ['slug' => $property_slug]);

			if ($this->input->post('filter')) {

				$this->Filter_Product_Category_RelationsModel->destroy([
					'product_id' => $this->input->post('product_id')
				]);
				foreach ($_POST['filter'] as $key => $val) {

					$filter_id = $key;
					foreach ($val as $value) {

						(is_numeric($value) or $value_id = $this->Filter_ValuesModel->save([
							'filter_key_id'      => $key,
							'filter_value_title' => $value,
							'slug'               => str_clean($value, [' ', '-', '_'], 'slug'),
							'status'             => true,
							'created_by'         => $_SESSION['USER_ID'],
							'modified_by'        => $_SESSION['USER_ID']
						]))
							and $values = $this->Filter_ValuesModel->all(['filter_value_title' => $value]);

						if (!is_numeric($value)) {
							foreach ($values as $value) {
								$value = $value_id;
							}
						}

						$Relation = $this->Filter_Product_Category_RelationsModel->save([
							'key_id'      => $filter_id,
							'value_id'    => $value,
							'product_id'  => $this->input->post('product_id'),
							'category_id' => $this->input->post('cat')
						]);
					}
				}
			}


			flash_message(
				'list/properties',
				$property_id and $Relation,
				'unsuccess',
				'Something Went Wrong'
			);

			flash_message(
				'list/properties',
				$property_id and $Relation,
				'success',
				'Property Updated Successfully'
			);
		}

		$property = json_decode(json_encode($this->ProductsModel->first([
			'conditions' => [
				'status' => true,
				'slug'   => $property_slug
			],
		])));

		is($property, 'json') and
			$relation = $this->Filter_Product_Category_RelationsModel->all([
				'conditions' => ['product_id' => $property->id],
				'datatype'   => 'json'
			]);


		$city = $this->ProductsModel->all([
			'fields' => ['distinct(extra_field_1) as city'],
			'conditions' => [
				'status'    => true,
				'post_type' => 'property'
			],
			'order' => [
				'by' => 'city',
				'type' => 'asc'
			],
			'datatype' => 'json'
		]);
		show_debug($city);

		$category = $this->CategoriesModel->all([
			'fields'     => ['id', 'title'],
			'conditions' => [
				'status'  => true,
				'post_type' => 'property'
			],
			'datatype' => 'json'
		]);

		$filters = $this->FiltersModel->all([
			'conditions' => [
				'status'  => true,
				'post_type' => 'property'
			],
			'datatype' => 'json'
		]);

		$filterValue = $this->Filter_ValuesModel->all([
			'fields'     => ['id', 'filter_key_id', 'filter_value_title', 'slug'],
			'conditions' => ['status' => true],
			'datatype'   => 'json'
		]);

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('property/edit', compact('category', 'filters', 'filterValue', 'property', 'relation', 'city'));
		$this->load->view('template/footer');
	}


	/** Delete Property */
	public function delete_property($property_slug = null)
	{
		empty($property_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('property_delete') or show_404();
		$property = $this->ProductsModel->updateTable([
			'status' => '3',
		], ['slug' => $property_slug]);
		flash_message(
			'list/properties',
			$property,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/properties',
			$property,
			'success',
			"Property Deleted Successfully"
		);
	}
}

    /* End of file  Property.php */
