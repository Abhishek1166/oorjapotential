<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Admin Dashboard Pages */
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model(['UsersModel', 'User_Group_PowersModel', 'User_GroupsModel']);
		$this->load->library('encryption');
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	/** Load Admin Panel Login */
	public function login()
	{
		is_login() and redirect(SITE_URL . 'dashboard');

		if ($this->input->post('LoginAdmin')) {

			flash_message(
				'dashboard/login',
				$this->input->post('username')
					and $this->input->post('password'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);
			$username = str_clean(
				$this->input->post('username'),
				['@', '.', '-', '_']
			);
			$password = hash_hmac('sha1', $this->input->post('password'), PASSWORD_SALT);
			// die(password_hash(md5($this->input->post('password')), PASSWORD_ARGON2ID));
			// var_dump(password_verify(md5($this->input->post('password')), '$argon2id$v=19$m=65536,t=4,p=1$Nk92dU1SNmVEOUdVbU5hOQ$WRb/y4bsMicBZKo8zvjDWeoU/PuWGPZSJRS+zhnF92E'));
			// die;

			$user_exists = $this->UsersModel->first(['conditions' => "`email` = '$username' OR `mobile` = '$username' OR `username` = '$username'"]);


			/* flash_message(
				'dashboard/login',
				!is_null($user_exists)
					and is_array($user_exists)
					and $password === $user_exists['password']
					and $user_exists['user_type'] === 'ADMIN'
					and $user_exists['role_id'] !== '0'
					and $user_exists['status'] === '1',
				'unsuccess',
				'Incorrect Login Details',
				'Seems Like Your Account Not Found, Please Try With Correct Login Details.'
			); */

			is_array($user_exists)
				and $powers = $this->User_Group_PowersModel->all([
					'conditions' => [
						'group_id' => $user_exists['role_id'],
						'status!=' => '3'
					],
					'fields' => ['action_key']
				]) and $user_role = $this->User_GroupsModel->first($user_exists['role_id']);

			$power = [];
			if (isset($powers) and is_array($powers)) {
				foreach ($powers as $VALUE) {
					foreach ($VALUE as $val) {
						$power[] = $val;
					}
				}
				$this->session->set_userdata([
					'LOGIN'         => bin2hex($this->encryption->create_key(16)),
					'USER_ID'       => $user_exists['id'],
					'USER_USERNAME' => $user_exists['username'],
					'USER_NAME'     => ucwords($user_exists['first_name']),
					'USER_FULLNAME' => ucwords($user_exists['first_name'] . ' ' . $user_exists['last_name']),
					'USER_EMAIL'    => $user_exists['email'],
					'USER_MOBILE'   => $user_exists['mobile'],
					'USER_PIC'      => is_null($user_exists['profile_pic']) ? '' : $user_exists['profile_pic'],
					'USER_TYPE'     => $user_exists['user_type'],
					'USER_ROLE'     => $user_exists['role_id'],
					'USER_ROLE_NAME' => $user_role['group_title'],
					'USER_POWER'    => $power
				]);
			} else {
				flash_message(
					'dashboard/login',
					false,
					'unsuccess',
					'Something Went Wrong',
					'Your Role Not Define Properly Yet, Please Login After Some Time.'
				);
			}

			flash_message(
				'dashboard',
				!is_null($user_exists) and is_array($user_exists),
				'success',
				'Welcome Back, ' . $_SESSION['USER_NAME'],
				'Nice To See You, Have A Nice Day.'
			);
		}

		$this->load->view('template/header');
		$this->load->view('dashboard/login');
		$this->load->view('template/footer');
	}

	public function logout()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);
		unset($_SESSION['LOGIN'], $_SESSION['USER_ID'], $_SESSION['USER_USERNAME'], $_SESSION['USER_NAME'], $_SESSION['USER_EMAIL'], $_SESSION['USER_MOBILE'], $_SESSION['USER_PIC'], $_SESSION['USER_TYPE'], $_SESSION['USER_ROLE'], $_SESSION['USER_POWER']);
		flash_message(
			'dashboard/login',
			true,
			'success',
			'Your Account Logout Successfully',
			'See You Later.'
		);
	}


	/** Load Dashboard HomePage
	 *
	 * @return void */
	public function home()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('dashboard/index');
		$this->load->view('template/footer');
	}
}

    /* End of file  Admin.php */
