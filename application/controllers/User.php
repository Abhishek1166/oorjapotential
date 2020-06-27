<?php defined('BASEPATH') or exit('No direct script access allowed');

/** Load & Execute User Modules */
class User extends CI_Controller
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
		$this->load->model(['UsersModel', 'User_GroupsModel']);
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}

	/** Add Users
	 * @return void */
	public function add_user()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('admin_add') or show_404();
		if ($this->input->post('addUsers')) {

			flash_message(
				'add/user',
				$this->input->post('firstName')
					and $this->input->post('lastName')
					and $this->input->post('email')
					and $this->input->post('mobile')
					and $this->input->post('password')
					and $this->input->post('userRole'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			flash_message(
				'add/user',
				filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
				'unsuccess',
				'Something Went Wrong',
				'Oops, You Misstyped Your E-mail Address, Please Type Valid E-mail Address.'
			);

			flash_message(
				'add/user',
				preg_match('/^\d{10}$/', $this->input->post('mobile'))
					and strlen($this->input->post('mobile')) === 10,
				'unsuccess',
				'Something Went Wrong',
				'Oops, You Misstyped Your Mobile Number, Please Type Valid Mobile Number.'
			);

			$email_exists = $this->UsersModel->first([
				'email' => str_clean(
					$this->input->post('email'),
					['@', '.', '-', '_']
				)
			]);
			is_null($email_exists) or is_array($email_exists) and $email_exists = $email_exists['email'];

			flash_message(
				'add/user',
				empty($email_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, E-mail Address Already Exists,<br>Please Login With `$email_exists` Or Try With Another E-mail Address."
			);

			$mobile_exists = $this->UsersModel->first(['mobile' => $this->input->post('mobile')]);
			is_null($mobile_exists) or is_array($mobile_exists) and $mobile_exists = $mobile_exists['mobile'];

			flash_message(
				'add/user',
				empty($mobile_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Mobile Already Exists,<br>Please Login With `$mobile_exists` Or Try With Another Mobile."
			);

			$username = explode('@', str_clean($this->input->post('email'), ['@', '.', '-', '_']))[0];
			$username_exists = $this->UsersModel->first(['username' => $username]);
			is_null($username_exists) or is_array($username_exists) and $username = increment_string($username, '_', 1);

			/* Upload Images */
			$form_images = upload(['uploads/users' => 'myImg']);

			/* Check Profile Image Uploaded */
			flash_message(
				'add/user',
				isset($form_images['myImg']),
				'unsuccess',
				'Something Went Wrong',
				"Please Upload Profile Pic & Try Again."
			);

			isset($form_images['myImg']) and $user_image = $form_images['myImg'][0] or $user_image = "";

			$this->agent->is_browser() and $device_type = 'web';
			$this->agent->is_mobile()  and $device_type = 'mobile';

			$user = $this->UsersModel->save([
				'username'        => $username,
				'slug'            => $username,
				'first_name'      => str_clean($this->input->post('firstName')),
				'last_name'       => str_clean($this->input->post('lastName')),
				'email'           => str_clean($this->input->post('email'), ['@', '.', '-', '_']),
				'mobile'          => str_clean($this->input->post('mobile')),
				'password'        => hash_hmac('sha1', $this->input->post('password'), PASSWORD_SALT),
				'user_type'       => 'ADMIN',
				'role_id'         => str_clean($this->input->post('userRole')),
				'profile_pic'     => $user_image,
				'status'          => true,
				'parent_id'       => $_SESSION['USER_ID'],
				'created_by'      => $_SESSION['USER_ID'],
				'modified_by'     => $_SESSION['USER_ID'],
				'mobile_verified' => true,
				'email_verified'  => true,

				'user_ip'           => $this->input->ip_address(),
				'browser'           => $this->agent->browser(),
				'browser_version'   => $this->agent->version(),
				'device_type'       => $device_type,
				'os'                => $this->agent->platform(),
				'mobile_device'     => $this->agent->mobile(),
				'last_login_device' => $this->agent->agent_string()
			]);

			flash_message(
				'add/user',
				$user,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/roles',
				$user,
				'success',
				"User Created Successfully"
			);
		}

		$roles = $this->User_GroupsModel->all([
			'conditions' => ['status!=' => '3'],
			'datatype' => 'json'
		]);

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('users/add', compact('roles'));
		$this->load->view('template/footer');
	}


	/** List Of Users
	 *
	 * @param int $type
	 * @return void */
	public function list_users($type = 'user')
	{
		// echo '<pre>';
		// print_r(
		// 	$this->UsersModel->get_childs('3')
		// );
		// echo '</pre>';

		// die;
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('admin_list') or show_404();
		is($type)
			and $roles = $this->User_GroupsModel->first(['slug' => $type])
			or show_404();
		is($roles)
			and $role_id = $roles['id']
			and $role_title = $roles['group_title']
			or show_404();

		$userData = json_decode(json_encode([
			'type' => $role_title,
			'data' => ''
		]));
		$users = $this->UsersModel->all([
			'conditions' => [
				'status!='  => '3',
				'user_type' => 'ADMIN',
				'role_id'   => $role_id
			],
			'order' => [
				'by' => 'id',
				'type' => 'DESC'
			]
		]);
		empty($users) or is_array($users) and $userData = json_decode(json_encode([
			'type' => $role_title,
			'data' => $users
		]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('users/admin_list', compact('userData'));
		$this->load->view('template/footer');
	}
}

    /* End of file  User.php */
