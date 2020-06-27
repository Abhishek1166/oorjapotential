<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Module Pages & Queries */
class Module extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model(['UsersModel', 'ModulesModel', 'Module_ValuesModel']);
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	/** Add Module */
	public function add_filter()
	{
		if ($this->input->post('addModule')) {

			flash_message(
				'add/filter',
				$this->input->post('filterTitle'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$filter_exists = $this->ModulesModel->first([
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
				"Oops, Module Already Exists,<br>Please Try With Another Module Name."
			);

			$slug = str_clean($this->input->post('filterTitle'), ['-', '_']);
			$slug_exists = $this->ModulesModel->first(['slug' => $slug]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/filter' => 'filterImg']);

			isset($form_images['filterImg']) and $filter_image = $form_images['filterImg'][0] or $filter_image = "";

			$filter = $this->ModulesModel->save([
				'slug'         => $slug,
				'filter_title' => str_clean($this->input->post('filterTitle'), [' ', '-', '_']),
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
				"Module Created Successfully"
			);
		}


		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('filter/add');
		$this->load->view('template/footer');
	}


	/** Load Module List Page */
	public function list_filter()
	{
		$filterData = json_decode(json_encode([
			'type' => 'Modules'
		]));
		$filter = $this->ModulesModel->all([
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

			empty($user) and $filter[$key]['created_by'] = '' or $filter[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
		}

		empty($filter) or is_array($filter) and $filterData = json_decode(json_encode([
			'type' => 'Modules',
			'data' => $filter
		]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('filter/list', compact('filterData'));
		$this->load->view('template/footer');
	}


	/** Edit Module */
	public function edit_filter($filter_slug = null)
	{
		empty($filter_slug) and show_404();

		if ($this->input->post('editModule')) {

			flash_message(
				'edit/filter/' . $filter_slug,
				$this->input->post('filterTitle'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$filter_exists = $this->ModulesModel->first([
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
				"Oops, Module Already Exists,<br>Please Try With Another Module Name."
			);

			$slug = str_clean($this->input->post('filterTitle'), ['-', '_']);
			$slug_exists = $this->ModulesModel->first([
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

			$filter = $this->ModulesModel->updateTable([
				'slug'         => $slug,
				'filter_title' => str_clean($this->input->post('filterTitle'), [' ', '-', '_']),
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
				"Module Updated Successfully"
			);
		}

		$filterData = '';
		$filter = $this->ModulesModel->first([
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

	/** Delete Module */
	public function delete_filter($filter_slug = null)
	{
		empty($filter_slug) and show_404();
		$filter = $this->ModulesModel->updateTable([
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
			"Module Deleted Successfully"
		);
	}
}




    /* End of file  Module.php */
