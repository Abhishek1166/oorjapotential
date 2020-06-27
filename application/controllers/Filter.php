<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Filter Pages & Queries */
class Filter extends CI_Controller
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
		$this->load->model(['UsersModel', 'FiltersModel', 'Filter_ValuesModel', 'Filter_Product_Category_RelationsModel']);
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	/** Add Filter */
	public function add_filter()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('filter_add') or show_404();

		if ($this->input->post('addFilter')) {

			flash_message(
				'add/filter',
				$this->input->post('filterTitle')
					and $this->input->post('postType'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$filter_exists = $this->FiltersModel->first([
				'filter_title' => str_clean(
					$this->input->post('filterTitle'),
					[' ', '-', '_']
				)
			]);
			is_null($filter_exists) or is_array($filter_exists) and $filter_exists = $filter_exists['filter_title'];

			flash_message(
				'add/filter',
				empty($filter_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Filter Already Exists,<br>Please Try With Another Filter Name."
			);

			/* Slug */
			$slug = str_clean($this->input->post('filterTitle'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->FiltersModel->first(['slug' => $slug]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Additional Options */
			is($_POST['autoAdd']) and $autoAdd = $this->input->post('autoAdd') or $autoAdd = '0';
			is($_POST['type'])	  and $type    = $this->input->post('type')    or $type = '0';

			/* Upload Images */
			$form_images = upload(['uploads/filter' => 'filterImg']);

			isset($form_images['filterImg']) and $filter_image = $form_images['filterImg'][0] or $filter_image = "";

			$filter = $this->FiltersModel->save([
				'slug'         => $slug,
				'filter_title' => str_clean($this->input->post('filterTitle'), [' ', '-', '_']),
				'post_type'    => str_clean($this->input->post('postType')),
				'auto_add'     => $autoAdd,
				'type'         => $type,
				'image'        => $filter_image,
				'created_by'   => $_SESSION['USER_ID'],
				'modified_by'  => $_SESSION['USER_ID'],
				'status'       => true,
			]);

			flash_message(
				'add/filter',
				$filter,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/filters',
				$filter,
				'success',
				"Filter Created Successfully"
			);
		}


		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('filter/add');
		$this->load->view('template/footer');
	}


	/** Load Filter List Page */
	public function list_filter()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('filter_list') or show_404();
		$filterData = json_decode(json_encode([
			'type' => 'Filters'
		]));
		$filter = $this->FiltersModel->all([
			'conditions' => [
				'status!=' => '3',
			],
			'order' => [
				'by' => 'id',
				'type' => 'DESC'
			]
		]);
		if (!empty($filter)) foreach ($filter as $key => $val) {
			$user = $this->UsersModel->first($val['created_by']);
			$product_count = count($this->Filter_Product_Category_RelationsModel->all([
				'conditions' => [
					'key_id' => $val['id']
				],
				'fields' => ['DISTINCT(product_id)']
			]));

			empty($user) and $filter[$key]['created_by'] = '' or $filter[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
			empty($product_count) and $filter[$key]['total'] = '' or $filter[$key]['total'] = $product_count;
		}

		empty($filter) or is_array($filter) and $filterData = json_decode(json_encode([
			'type' => 'Filters',
			'data' => $filter
		]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('filter/list', compact('filterData'));
		$this->load->view('template/footer');
	}


	/** Edit Filter */
	public function edit_filter($filter_slug = null)
	{
		empty($filter_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('filter_edit') or show_404();

		if ($this->input->post('editFilter')) {
			flash_message(
				'edit/filter/' . $filter_slug,
				$this->input->post('filterTitle'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$filter_exists = $this->FiltersModel->first([
				'filter_title' => str_clean(
					$this->input->post('filterTitle'),
					[' ', '-', '_']
				),
				'slug!=' => $filter_slug
			]);
			is_null($filter_exists) or is_array($filter_exists) and $filter_exists = $filter_exists['filter_title'];

			flash_message(
				'edit/filter/' . $filter_slug,
				empty($filter_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Filter Already Exists,<br>Please Try With Another Filter Name."
			);

			$slug = str_clean($this->input->post('filterTitle'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->FiltersModel->first([
				'filter_title!=' => str_clean(
					$this->input->post('filterTitle'),
					[' ', '-', '_']
				),
				'slug' => $slug
			]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/filter' => 'filterImg']);

			isset($form_images['filterImg']) and $filter_image = $form_images['filterImg'][0] or $filter_image = $this->input->post('oldfilterImg');

			$filter = $this->FiltersModel->updateTable([
				'slug'         => $slug,
				'filter_title' => str_clean($this->input->post('filterTitle'), [' ', '-', '_']),
				'post_type'    => str_clean($this->input->post('postType')),
				'image'        => $filter_image,
				'auto_add'     => $this->input->post('autoAdd'),
				'type'         => $this->input->post('type'),
				'image'        => $filter_image,
				'created_by'   => $_SESSION['USER_ID'],
				'modified_by'  => $_SESSION['USER_ID'],
				'status'       => true,
			], ['slug' => $filter_slug]);

			flash_message(
				'edit/filter/' . $filter_slug,
				$filter,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/filters',
				$filter,
				'success',
				"Filter Updated Successfully"
			);
		}

		$filterData = '';
		$filter = $this->FiltersModel->first([
			'conditions' => [
				'slug'     => $filter_slug,
				'status!=' => '3',
			]
		]);
		empty($filter) or is_array($filter) and $filterData = json_decode(json_encode($filter));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('filter/edit', compact('filterData'));
		$this->load->view('template/footer');
	}

	/** Delete Filter */
	public function delete_filter($filter_slug = null)
	{
		empty($filter_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('filter_delete') or show_404();
		$filter = $this->FiltersModel->updateTable([
			'status' => '3',
		], ['slug' => $filter_slug]);
		flash_message(
			'list/filters',
			$filter,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/filters',
			$filter,
			'success',
			"Filter Deleted Successfully"
		);
	}
}
    /* End of file  Filter.php */
