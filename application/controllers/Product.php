<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Product Pages & Queries */
class Product extends CI_Controller
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

	/** Add Product */
	public function add_product()
	{

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('product_add') or show_404();

		if ($this->input->post('addProduct')) {

			flash_message(
				'add/product',
				$this->input->post('name')
					and $this->input->post('srtDesc')
					and $this->input->post('desc')
					and $this->input->post('cat')

					and $this->input->post('filter')
					and is_array($this->input->post('filter'))
					and $this->input->post('minPrice'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			/* Upload Images */
			$form_images = upload(['uploads/product' => 'productImg']);

			flash_message(
				'add/product',
				isset($form_images['productImg'][0])
					and !empty($form_images['productImg'][0]),
				'unsuccess',
				'Something Went Wrong',
				'Please Upload Atleast One Image.'
			);

			isset($form_images['productImg']) or $product_image = "";
			is_array($form_images['productImg']) and $product_image = implode('@', $form_images['productImg']);

			// Slug
			$slug = str_clean($this->input->post('name'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->ProductsModel->first(['slug' => $slug]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			$this->input->post('featured') === 'on' and $feature = true or $feature = '';
			$this->input->post('hotDeals') === 'on' and $deal    = true or $deal    = '';

			is($_POST['maxPrice'])
				and $maxPrice = $this->input->post('maxPrice')
				or  $maxPrice = $this->input->post('minPrice');

			$product_id = $this->ProductsModel->save([
				'title'           => $this->input->post('name'),

				'slug'            => $slug,
				'post_type'       => 'product',
				'category_id'     => $this->input->post('cat'),
				'srt_description' => $this->input->post('srtDesc'),
				'description'     => $this->input->post('desc'),
				'regular_price'   => $this->input->post('minPrice'),
				'sell_price'      => $maxPrice,
				'image'           => $product_image,
				'offers'          => $this->input->post('offers'),
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
							'product_id'  => $product_id,
							'category_id' => $this->input->post('cat')
						]);
					}
				}
			}

			flash_message(
				'list/products',
				$Relation,
				'unsuccess',
				'Something Went Wrong'
			);

			flash_message(
				'list/products',
				$Relation,
				'success',
				'Product Added Successfully'
			);
		}

		$category = json_decode(json_encode($this->CategoriesModel->all([
			'feilds' => ['id', 'title'],
			'conditions' => [
				'status!=' => 3,
				'post_type' => 'product'
			]
		])));

		$filters = json_decode(json_encode($this->FiltersModel->all([
			'feilds' => ['id', 'filter_title', 'slug'],
			'conditions' => [
				'status!='  => 3,
				'post_type' => 'product'

			],
		])));

		$filterValue = json_decode(json_encode($this->Filter_ValuesModel->all([
			'feilds' => ['id', 'filter_key_id', 'filter_value_title', 'slug'],
			'conditions' => ['status!=' => 3]
		])));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('products/add', compact('category', 'filters', 'filterValue'));
		$this->load->view('template/footer');
	}


	/** Load Product List Page */
	public function list_products()
	{

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('product_list') or show_404();
		$productData = json_decode(json_encode([
			'type' => 'Products'
		]));
		$product = $this->ProductsModel->all([
			'fields' => ['products.*', 'categories.title as category'],
			'conditions' => [
				'products.status!='  => '3',
				'products.post_type' => 'product'
			],
			'join' => [
				'tableName' => 'categories',
				'condition' => 'products.category_id = categories.id'
			],
			'order' => [
				'by'   => 'products.id',
				'type' => 'DESC'
			]
		]);

		$project_key = $this->FiltersModel->first(['filter_title' => 'projects'])['id'];

		if (is($product))
			foreach ($product as $key => $val) {

				// Product Relations
				$Projects = $this->Filter_Product_Category_RelationsModel->first([
					'product_id' => $val['id'],
					'key_id' => $project_key // Project Filter ID
				]);

				// Get User Name
				$user = $this->UsersModel->first($val['created_by']);
				is($user, 'array') and $product[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']) or $product[$key]['created_by'] = '';

				// Get Image
				strpos($val['image'], '@') and $img = explode('@', $val['image']) and is_array($img) and $product[$key]['image'] = $img[0] or $product[$key]['image'] = $val['image'];
			}

		is($product) and is_array($product) and $productData = json_decode(json_encode([
			'type' => 'Products',
			'data' => $product
		]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('products/list', compact('productData'));
		$this->load->view('template/footer');
	}


	/** Edit Product */
	public function edit_product($product_slug)
	{
		empty($product_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('product_edit') or show_404();

		if ($this->input->post('editProduct')) {

			flash_message(
				'edit/product/' . $product_slug,
				$this->input->post('name')
					and $this->input->post('srtDesc')
					and $this->input->post('desc')
					and $this->input->post('cat')
					and $this->input->post('filter')
					and is_array($this->input->post('filter'))
					and $this->input->post('minPrice'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);


			/* Upload Images */
			$form_images = upload(['uploads/product' => 'productImg']);

			flash_message(
				'edit/product/' . $product_slug,
				is($form_images['productImg'][0]) or is($_POST['oldproductImg']),
				'unsuccess',
				'Something Went Wrong',
				'Please Upload Atleast One Image.'
			);

			if (is_array($_POST['oldproductImg']))
				foreach ($_POST['oldproductImg'] as $img);
			is($form_images['productImg'], 'array') and $product_image = implode('@', $form_images['productImg']) or $product_image = $img;

			// Slug
			$slug = str_clean($this->input->post('name'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->ProductsModel->first(['slug' => $slug, 'id !=' => $this->input->post('product_id')]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);


			$this->input->post('featured') === 'on' and $feature = true or $feature = '';
			$this->input->post('hotDeals') === 'on' and $deal    = true or $deal    = '';

			is($_POST['maxPrice'])
				and $maxPrice = $this->input->post('maxPrice')
				or  $maxPrice = $this->input->post('minPrice');

			$product_id = $this->ProductsModel->updateTable([
				'title'           => $this->input->post('name'),
				'slug'            => $slug,
				'srt_description' => $this->input->post('srtDesc'),
				'description'     => $this->input->post('desc'),
				'category_id'     => $this->input->post('cat'),
				'regular_price'   => $this->input->post('minPrice'),
				'sell_price'      => $maxPrice,
				'image'           => $product_image,
				'offers'          => $this->input->post('offers'),
				'status'          => $this->input->post('status'),
				'on_deal'         => $deal,
				'is_featured'     => $feature,
				'created_by'      => $_SESSION['USER_ID'],
				'modified_by'     => $_SESSION['USER_ID'],
			], ['slug' => $product_slug]);

			if ($this->input->post('filter')) {

				$this->Filter_Product_Category_RelationsModel->destroy(['product_id' => $this->input->post('product_id')]);
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
							'product_id'  => $this->input->post('product_id'),
							'category_id' => $this->input->post('cat')
						]);
					}
				}
			}


			flash_message(
				'list/products',
				$product_id and $Relation,
				'unsuccess',
				'Something Went Wrong'
			);

			flash_message(
				'list/products',
				$product_id and $Relation,
				'success',
				'Product Updated Successfully'
			);
		}

		$product = json_decode(json_encode($this->ProductsModel->first([
			'conditions' => [
				'status!=' => '3',
				'slug' => $product_slug
			],
		])));

		$relation = json_decode(json_encode($this->Filter_Product_Category_RelationsModel->all([
			'conditions' => ['product_id' => $product->id]
		])));

		$category = json_decode(json_encode($this->CategoriesModel->all([
			'feilds' => [
				'id',
				'title'
			],
			'conditions' => [
				'status!=' => 3,
				'post_type' => 'product'
			]
		])));

		$filters = json_decode(json_encode($this->FiltersModel->all([
			'feilds' => [
				'id',
				'filter_title',
				'slug'
			],
			'conditions' => [
				'status!='  => 3,
				'post_type' => 'product'
			]
		])));

		$filterValue = json_decode(json_encode($this->Filter_ValuesModel->all([
			'feilds' => [
				'id',
				'filter_key_id',
				'filter_value_title',
				'slug'
			],
			'conditions' => ['status!=' => 3]
		])));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('products/edit', compact('category', 'filters', 'filterValue', 'product', 'relation'));
		$this->load->view('template/footer');
	}


	/** Delete Product */
	public function delete_product($product_slug = null)
	{
		empty($product_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('product_delete') or show_404();
		$product = $this->ProductsModel->updateTable([
			'status' => '3',
		], ['slug' => $product_slug]);
		flash_message(
			'list/products',
			$product,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/products',
			$product,
			'success',
			"Product Deleted Successfully"
		);
	}
}

    /* End of file  Product.php */
