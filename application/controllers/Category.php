<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Category Pages & Queries */
class Category extends CI_Controller
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


	/** Add Category */
	public function add_category()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('category_add') or show_404();

		if ($this->input->post('addCategory')) {

			flash_message(
				'add/category',
				$this->input->post('title')
					and $this->input->post('postType'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$category_exists = $this->CategoriesModel->first([
				'title' => str_clean(
					$this->input->post('title'),
					[' ', '-', '_']
				)
			]);
			is_null($category_exists) or is_array($category_exists) and $category_exists = $category_exists['title'];

			flash_message(
				'add/category',
				empty($category_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Category Already Exists,<br>Please Try With Another Category Name."
			);

			/* Slug */
			$slug = str_clean($this->input->post('title'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->CategoriesModel->first(['slug' => $slug]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/category' => 'catImg']);

			/* Check Document Image Uploaded */
			// flash_message(
			// 	'add/category',
			// 	isset($form_images['catImg']),
			// 	'unsuccess',
			// 	'Something Went Wrong',
			// 	"Please Upload Category Image & Try Again."
			// );

			isset($form_images['catImg']) and $category_image = $form_images['catImg'][0] or $category_image = "";

			$category = $this->CategoriesModel->save([
				'slug'        => $slug,
				'title'       => str_clean($this->input->post('title'), [' ', '-', '_']),
				'parent_id'   => str_clean($this->input->post('cat')),
				'post_type'   => str_clean($this->input->post('postType')),
				'image'       => $category_image,
				'created_by'  => $_SESSION['USER_ID'],
				'modified_by' => $_SESSION['USER_ID'],
				'status'      => true,
			]);

			flash_message(
				'add/category',
				$category,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/categories',
				$category,
				'success',
				"Category Created Successfully"
			);
		}

		$cats = json_decode(json_encode($this->CategoriesModel->all([
			'feilds' => ['id', 'title'],
			'conditions' => ['status' => true]
		])));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('category/add', compact('cats'));
		$this->load->view('template/footer');
	}


	/** Load Category List Page */
	public function list_Category()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('category_list') or show_404();

		$categoryData = json_decode(json_encode([
			'type' => 'Categoies'
		]));
		$category = $this->CategoriesModel->all([
			'conditions' => [
				'status!=' => '3',
			],
			'order' => [
				'by' => 'id',
				'type' => 'DESC'
			]
		]);

		if (!empty($category)) foreach ($category as $key => $val) {
			if (!empty($val['parent_id'])) {
				$user = $this->UsersModel->first($val['created_by']);
				$cats = $this->CategoriesModel->first($val['parent_id']);

				empty($user) and $category[$key]['created_by'] = '' or $category[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
				empty($cats) and $category[$key]['parent_id'] = 'Self' or $category[$key]['parent_id'] = ucwords($cats['title']);
			} else {
				$user = $this->UsersModel->first($val['created_by']);

				empty($user) and $category[$key]['created_by'] = '' or $category[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
				$category[$key]['parent_id'] = 'Self';
			}
		}

		empty($category) or is_array($category) and $categoryData = json_decode(json_encode([
			'type' => 'Categoies',
			'data' => $category
		]));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('category/list', compact('categoryData'));
		$this->load->view('template/footer');
	}


	/** Edit Category */
	public function edit_category($category_slug = null)
	{
		empty($category_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('category_edit') or show_404();

		if ($this->input->post('editCategory')) {

			flash_message(
				'edit/category/' . $category_slug,
				$this->input->post('title')
					and $this->input->post('postType'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$category_exists = $this->CategoriesModel->first([
				'title' => str_clean(
					$this->input->post('title'),
					[' ', '-', '_']
				),
				'slug !=' => $category_slug
			]);
			is_null($category_exists) or is_array($category_exists) and $category_exists = $category_exists['title'];

			flash_message(
				'edit/category/' . $category_slug,
				empty($category_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Category Already Exists,<br>Please Try With Another Category Name."
			);

			/* Slug */
			$slug = str_clean($this->input->post('title'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->CategoriesModel->first(['slug' => $slug, 'id !=' => $category_exists['id']]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/category' => 'catImg']);

			isset($form_images['catImg']) and $category_image = $form_images['catImg'][0] or $category_image = $this->input->post('oldcatImg');

			$category = $this->CategoriesModel->updateTable([
				'slug'        => $slug,
				'title'       => str_clean($this->input->post('title'), [' ', '-', '_']),
				'parent_id'   => str_clean($this->input->post('cat')),
				'image'       => $category_image,
				'post_type'   => str_clean($this->input->post('postType')),
				'modified_by' => $_SESSION['USER_ID'],
				'status'      => true,
			], ['slug' => $category_slug]);

			flash_message(
				'edit/category/' . $category_slug,
				$category,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/categories',
				$category,
				'success',
				"Category Created Successfully"
			);
		}

		$categoryData = '';
		$category = $this->CategoriesModel->first([
			'conditions' => [
				'slug'     => $category_slug,
				'status!=' => '3',
			]
		]);
		empty($category) or is_array($category) and $categoryData = json_decode(json_encode($category));

		$cats = json_decode(json_encode($this->CategoriesModel->all([
			'feilds' => ['id', 'title'],
			'conditions' => ['status' => true]
		])));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('category/edit', compact('cats', 'categoryData'));
		$this->load->view('template/footer');
	}


	/** Delete Category */
	public function delete_category($category_slug = null)
	{
		empty($category_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('category_delete') or show_404();

		$category = $this->CategoriesModel->updateTable([
			'status' => '3',
		], ['slug' => $category_slug]);
		flash_message(
			'list/categories',
			$category,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/categories',
			$category,
			'success',
			"Category Deleted Successfully"
		);
	}
}

    /* End of file Category.php */
