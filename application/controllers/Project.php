<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Filter Pages & Queries */
class Project extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model([
			'UsersModel',
			'FiltersModel',
			'Filter_ValuesModel',
			'Filter_Product_Category_RelationsModel'
		]);
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	/** Add Project */
	public function add_project()
	{
		if ($this->input->post('addProject')) {

			flash_message(
				'add/project',
				$this->input->post('projectTitle'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$project_exists = $this->Filter_ValuesModel->first([
				'project_title' => str_clean(
					$this->input->post('projectTitle'),
					[' ', '-', '_']
				)
			]);
			is_null($project_exists) or is_array($project_exists) and $project_exists = $project_exists['project_title'];

			flash_message(
				'add/project',
				empty($project_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Project Already Exists,<br>Please Try With Another Project Name."
			);

			$slug = str_clean($this->input->post('projectTitle'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->Filter_ValuesModel->first(['slug' => $slug]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/project' => 'projectImg']);

			/* Check Project Image Uploaded */
			flash_message(
				'add/user',
				isset($form_images['myImg']),
				'unsuccess',
				'Something Went Wrong',
				"Please Upload Project Image & Try Again."
			);

			isset($form_images['projectImg']) and $project_image = $form_images['projectImg'][0] or $project_image = "";

			$project = $this->Filter_ValuesModel->save([
				'slug'          => $slug,
				'project_title' => str_clean($this->input->post('projectTitle'), [' ', '-', '_']),
				'image'         => $project_image,
				'created_by'    => $_SESSION['USER_ID'],
				'modified_by'   => $_SESSION['USER_ID'],
				'status'        => true,
			]);

			flash_message(
				'add/project',
				$project,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/projects',
				$project,
				'success',
				"Project Created Successfully"
			);
		}


		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('project/add');
		$this->load->view('template/footer');
	}


	/** Load Project List Page */
	public function list_projects()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('property_list') or show_404();

		$projectData = json_decode(json_encode([
			'type' => 'Projects'
		]));
		$project = $this->Filter_ValuesModel->all([
			'fields'     => ['filter_values.*', 'users.first_name', 'users.last_name'],
			'conditions' => [
				'filter_values.status!='      => '3',
				'filter_values.filter_key_id' => '1'
			],
			'join' => [
				'tableName' => 'users',
				'condition' => 'users.id = filter_values.created_by'
			],
			'order' => [
				'by'   => 'filter_values.id',
				'type' => 'DESC'
			],
			'datatype' => 'json'
		]);

		show_debug($project);
		if (is($project))
			foreach ($project as $key => $val) {
				$product_count = count($this->Filter_Product_Category_RelationsModel->all([
					'conditions' => [
						'value_id' => $val->id
					],
					'fields' => ['DISTINCT(product_id)']
				]));

				is($product_count) and $project[$key]->total = $product_count or $project[$key]->total = '0';
			}

		is($project, 'array') and
			$projectData = json_decode(json_encode([
				'type' => 'Projects',
				'data' => $project
			]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('project/list', compact('projectData'));
		$this->load->view('template/footer');
	}


	/** Edit Project */
	public function edit_project($project_slug = null)
	{
		empty($project_slug) and show_404();
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('property_edit') or show_404();

		if ($this->input->post('editProject')) {

			flash_message(
				'edit/project/' . $project_slug,
				$this->input->post('filterTitle'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$filter_exists = $this->Filter_ValuesModel->first([
				'filter_value_title' => str_clean(
					$this->input->post('filterTitle'),
					[' ', '-', '_']
				),
				'slug!=' => $project_slug
			]);
			is_null($filter_exists) or is_array($filter_exists) and $filter_exists = $filter_exists['filter_value_title'];

			flash_message(
				'edit/project/' . $project_slug,
				empty($filter_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Project Already Exists,<br>Please Try With Another Project Name."
			);

			$slug = str_clean($this->input->post('filterTitle'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->Filter_ValuesModel->first([
				'filter_value_title!=' => str_clean($this->input->post('filterTitle'), [' ', '-', '_'], 'slug'),
				'slug'           => $slug
			]);
			is($slug_exists, 'array') and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/filter' => 'filterImg']);

			isset($form_images['filterImg']) and $filter_image = $form_images['filterImg'][0] or $filter_image = $this->input->post('oldfilterImg');

			$filter = $this->Filter_ValuesModel->updateTable([
				'slug'               => $slug,
				'filter_value_title' => str_clean($this->input->post('filterTitle'), [' ', '-', '_']),
				'image'              => $filter_image,
			], ['slug' => $project_slug]);

			flash_message(
				'edit/project/' . $project_slug,
				$filter,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/projects',
				$filter,
				'success',
				"Project Updated Successfully"
			);
		}

		$filterData = '';
		$filter = $this->Filter_ValuesModel->first([
			'conditions' => [
				'slug'     => $project_slug,
				'status!=' => '3',
			]
		]);
		empty($filter) or is_array($filter) and $filterData = json_decode(json_encode($filter));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('project/edit', compact('filterData'));
		$this->load->view('template/footer');
	}


	public function delete_project($project_slug = null)
	{
		empty($project_slug) and show_404();
		$project = $this->Filter_ValuesModel->updateTable([
			'status' => '3',
		], ['slug' => $project_slug]);
		flash_message(
			'list/projects',
			$project,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/projects',
			$project,
			'success',
			"Project Deleted Successfully"
		);
	}
}




    /* End of file  Project.php */
