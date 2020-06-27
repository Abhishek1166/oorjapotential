<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Test Pages & Queries */
class Test extends CI_Controller
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
		$this->load->model(['UsersModel', 'PostsModel']);
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	/** Add Test */
	public function add_test()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('test_add') or show_404();

		if ($this->input->post('addTest')) {

			flash_message(
				'add/test',
				$this->input->post('testTitle'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$test_exists = $this->TestsModel->first([
				'test_title' => str_clean(
					$this->input->post('testTitle'),
					[' ', '-', '_']
				)
			]);
			is_null($test_exists) or is_array($test_exists) and $test_exists = $test_exists['test_title'];

			flash_message(
				'add/test',
				empty($test_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Test Already Exists,<br>Please Try With Another Test Name."
			);

			$slug = str_clean($this->input->post('testTitle'), ['-', '_']);
			$slug_exists = $this->TestsModel->first(['slug' => $slug]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/test' => 'testImg']);

			isset($form_images['testImg']) and $test_image = $form_images['testImg'][0] or $test_image = "";

			$test = $this->TestsModel->save([
				'slug'         => $slug,
				'test_title' => str_clean($this->input->post('testTitle'), [' ', '-', '_']),
				'image'        => $test_image,
				'created_by'   => $_SESSION['USER_ID'],
				'modified_by'  => $_SESSION['USER_ID'],
				'status'       => true,
			]);

			flash_message(
				'add/test',
				$test,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/tests',
				$test,
				'success',
				"Test Created Successfully"
			);
		}


		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('test/add');
		$this->load->view('template/footer');
	}


	/** Load Test List Page */
	public function list_test()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);
		var_dump(get_data_from('posts'));

		// var_dump($this->UsersModel->all([
		// 	'conditions' => ['users.status' => true],
		// 	'fields'     => [
		// 		'users.username',
		// 		'parent.username as parentsName'
		// 	],
		// 	'join' => [
		// 		'tableName' => 'users as parent',
		// 		'condition'  => 'users.parent_id = secondCon' => 'parent.id'
		// 	],
		// 	'datatype' => 'json'
		// ]));
		echo $this->db->last_query();

		// die(var_dump($this->UsersModel->check_column_exists(['id', 'name'])));
		die;


		user_can('test_list') or show_404();
		$testData = json_decode(json_encode([
			'type' => 'Tests'
		]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('test/list', compact('testData'));
		$this->load->view('template/footer');
	}


	/** Edit Test */
	public function edit_test($test_slug = null)
	{
		empty($test_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('test_edit') or show_404();

		if ($this->input->post('editTest')) {
			flash_message(
				'edit/test/' . $test_slug,
				$this->input->post('testTitle'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$test_exists = $this->TestsModel->first([
				'test_title' => str_clean(
					$this->input->post('testTitle'),
					[' ', '-', '_']
				),
				'slug!=' => $test_slug
			]);
			is_null($test_exists) or is_array($test_exists) and $test_exists = $test_exists['test_title'];

			flash_message(
				'edit/test/' . $test_slug,
				empty($test_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Test Already Exists,<br>Please Try With Another Test Name."
			);

			$slug = str_clean($this->input->post('testTitle'), ['-', '_']);
			$slug_exists = $this->TestsModel->first([
				'test_title!=' => str_clean(
					$this->input->post('testTitle'),
					[' ', '-', '_']
				),
				'slug' => $slug
			]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/test' => 'testImg']);

			isset($form_images['testImg']) and $test_image = $form_images['testImg'][0] or $test_image = $this->input->post('oldtestImg');

			$test = $this->TestsModel->updateTable([
				'slug'         => $slug,
				'test_title' => str_clean($this->input->post('testTitle'), [' ', '-', '_']),
				'image'        => $test_image,
				'auto_add'     => $this->input->post('autoAdd'),
				'type'         => $this->input->post('type'),
				'image'        => $test_image,
				'created_by'   => $_SESSION['USER_ID'],
				'modified_by'  => $_SESSION['USER_ID'],
				'status'       => true,
			], ['slug' => $test_slug]);

			flash_message(
				'edit/test/' . $test_slug,
				$test,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/tests',
				$test,
				'success',
				"Test Updated Successfully"
			);
		}

		$testData = '';
		$test = $this->TestsModel->first([
			'conditions' => [
				'slug'     => $test_slug,
				'status!=' => '3',
			]
		]);
		empty($test) or is_array($test) and $testData = json_decode(json_encode($test));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('test/edit', compact('testData'));
		$this->load->view('template/footer');
	}

	/** Delete Test */
	public function delete_test($test_slug = null)
	{
		empty($test_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('test_delete') or show_404();
		$test = $this->TestsModel->updateTable([
			'status' => '3',
		], ['slug' => $test_slug]);
		flash_message(
			'list/tests',
			$test,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/tests',
			$test,
			'success',
			"Test Deleted Successfully"
		);
	}
}
    /* End of file  Test.php */
