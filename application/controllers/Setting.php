<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Setting Pages & Queries */
class Setting extends CI_Controller
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
			'SettingsModel',
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


	/** Add Setting */
	public function add_setting()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('setting_add') or show_404();

		if ($this->input->post('addSetting')) {

			flash_message(
				'add/setting',
				$this->input->post('title')
					and $this->input->post('postType'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$setting_exists = $this->SettingsModel->first([
				'title' => str_clean(
					$this->input->post('title'),
					[' ', '-', '_']
				)
			]);
			is_null($setting_exists) or is_array($setting_exists) and $setting_exists = $setting_exists['title'];

			flash_message(
				'add/setting',
				empty($setting_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Setting Already Exists,<br>Please Try With Another Setting Name."
			);

			/* Slug */
			$slug = str_clean($this->input->post('title'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->SettingsModel->first(['slug' => $slug]);
			is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

			/* Upload Images */
			$form_images = upload(['uploads/setting' => 'catImg']);

			/* Check Document Image Uploaded */
			// flash_message(
			// 	'add/setting',
			// 	isset($form_images['catImg']),
			// 	'unsuccess',
			// 	'Something Went Wrong',
			// 	"Please Upload Setting Image & Try Again."
			// );

			isset($form_images['catImg']) and $setting_image = $form_images['catImg'][0] or $setting_image = "";

			$setting = $this->SettingsModel->save([
				'slug'        => $slug,
				'title'       => str_clean($this->input->post('title'), [' ', '-', '_']),
				'parent_id'   => str_clean($this->input->post('cat')),
				'post_type'   => str_clean($this->input->post('postType')),
				'image'       => $setting_image,
				'created_by'  => $_SESSION['USER_ID'],
				'modified_by' => $_SESSION['USER_ID'],
				'status'      => true,
			]);

			flash_message(
				'add/setting',
				$setting,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/settings',
				$setting,
				'success',
				"Setting Created Successfully"
			);
		}

		$cats = json_decode(json_encode($this->SettingsModel->all([
			'feilds' => ['id', 'title'],
			'conditions' => ['status' => true]
		])));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('setting/add', compact('cats'));
		$this->load->view('template/footer');
	}


	/** Load Setting List Page */
	public function list_setting()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('setting_list') or show_404();

		$settingData = json_decode(json_encode([
			'type' => 'Settings'
		]));
		$setting = $this->SettingsModel->all(['order' => [
			'by'   => 'option_key',
			'type' => 'ASC'
		]]);

		empty($setting) or is_array($setting) and $settingData = json_decode(json_encode([
			'type' => 'Settings',
			'data' => $setting
		]));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('setting/list', compact('settingData'));
		$this->load->view('template/footer');
	}


	/** Edit Setting */
	public function edit_setting($setting_slug = null)
	{
		empty($setting_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('setting_edit') or show_404();

		if ($this->input->post('editSetting')) {

			flash_message(
				'edit/setting/' . $setting_slug,
				$this->input->post('option_value')
					or is($_FILES['option_value']),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			if (is($_FILES['option_value'])) {/* Upload Images */
				$form_images = upload(['uploads/setting' => 'option_value']);

				isset($form_images['option_value']) and $setting_image = $form_images['option_value'][0] or $setting_image = $this->input->post('oldoption_value');
			}else{
				$setting_image = $this->input->post('option_value');
			}

			$setting = $this->SettingsModel->updateTable([
				'option_value' => $setting_image
			], ['option_key' => $setting_slug]);

			flash_message(
				'edit/setting/' . $setting_slug,
				$setting,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/settings',
				$setting,
				'success',
				"Setting Updated Successfully"
			);
		}

		$settingData = '';
		$setting = $this->SettingsModel->first(['conditions' => ['option_key' => $setting_slug]]);
		empty($setting) or is_array($setting) and $settingData = json_decode(json_encode($setting));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('setting/edit', compact('settingData'));
		$this->load->view('template/footer');
	}


	/** Delete Setting */
	public function delete_setting($setting_slug = null)
	{
		empty($setting_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('setting_delete') or show_404();

		$setting = $this->SettingsModel->updateTable([
			'status' => '3',
		], ['slug' => $setting_slug]);
		flash_message(
			'list/settings',
			$setting,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/settings',
			$setting,
			'success',
			"Setting Deleted Successfully"
		);
	}
}

    /* End of file Setting.php */
