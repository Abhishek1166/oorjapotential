<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lead extends CI_Controller
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

		$this->load->model('UsersModel');
	}

	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	public function add_lead()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('lead_list') or show_404();
		if ($this->input->post('addLeads')) {

			flash_message(
				'add/lead',
				$this->input->post('firstName')
					and $this->input->post('lastName')
					and $this->input->post('email')
					and $this->input->post('mobile')
					and $this->input->post('requirement'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			flash_message(
				'add/lead',
				filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
				'unsuccess',
				'Something Went Wrong',
				'Oops, You Misstyped Your E-mail Address, Please Type Valid E-mail Address.'
			);

			flash_message(
				'add/lead',
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
				'add/lead',
				empty($email_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, E-mail Address Already Exists,<br>Please Login With `$email_exists` Or Try With Another E-mail Address."
			);

			$mobile_exists = $this->UsersModel->first(['mobile' => $this->input->post('mobile')]);
			is_null($mobile_exists) or is_array($mobile_exists) and $mobile_exists = $mobile_exists['mobile'];

			flash_message(
				'add/lead',
				empty($mobile_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Mobile Already Exists,<br>Please Login With `$mobile_exists` Or Try With Another Mobile."
			);

			$username = explode('@', str_clean($this->input->post('email'), ['@', '.', '-', '_']))[0];
			$username_exists = $this->UsersModel->first(['username' => $username]);
			is_null($username_exists) or is_array($username_exists) and $username = increment_string($username, '_', 1);

			$this->agent->is_browser() and $device_type = 'web';
			$this->agent->is_mobile()  and $device_type = 'mobile';

			$user = $this->UsersModel->save([
				'username'      => $username,
				'slug'          => $username,
				'first_name'    => str_clean($this->input->post('firstName')),
				'last_name'     => str_clean($this->input->post('lastName')),
				'email'         => str_clean($this->input->post('email'), ['@', '.', '-', '_']),
				'mobile'        => str_clean($this->input->post('mobile')),
				'user_type'     => 'SUBSCRIBER',
				'requirement'   => $this->input->post('requirement'),
				'comment'       => $this->input->post('comment'),
				'lead_from'     => $this->input->post('leadFrom'),
				'followup_date' => $this->input->post('followDate'),
				'parent_id'     => $_SESSION['USER_ID'],
				'created_by'    => $_SESSION['USER_ID'],
				'modified_by'   => $_SESSION['USER_ID'],
				'status'        => '0',

				'user_ip'           => $this->input->ip_address(),
				'browser'           => $this->agent->browser(),
				'browser_version'   => $this->agent->version(),
				'device_type'       => $device_type,
				'os'                => $this->agent->platform(),
				'mobile_device'     => $this->agent->mobile(),
				'last_login_device' => $this->agent->agent_string()
			]);

			flash_message(
				'add/lead',
				$user,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/leads',
				$user,
				'success',
				"User Created Successfully"
			);
		}

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('leads/add');
		$this->load->view('template/footer');
	}


	public function list_leads()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('lead_list') or show_404();

		$userData = json_decode(json_encode([
			'type' => 'leads'
		]));
		$users = $this->UsersModel->all(
			['conditions' => "`user_type` = 'SUBSCRIBER' AND `status` != '3' AND `status` = '11' OR `status` = '12' OR `status` = '13' OR `status` = '0' ORDER BY `is_pinned` DESC, `id` DESC"]
		);
		empty($users) or is_array($users) and $userData = json_decode(json_encode([
			'type' => 'leads',
			'data' => $users
		]));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('leads/list', compact('userData'));
		$this->load->view('template/footer');
	}


	public function list_customers()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('lead_list') or show_404();

		$userData = json_decode(json_encode([
			'type' => 'Customers'
		]));
		$users = $this->UsersModel->all(
			['conditions' => "`user_type` = 'SUBSCRIBER' AND `status` = '1' ORDER BY `is_pinned` DESC, `id` DESC"]
		);
		empty($users) or is_array($users) and $userData = json_decode(json_encode([
			'type' => 'Customers',
			'data' => $users
		]));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('leads/customers', compact('userData'));
		$this->load->view('template/footer');
	}


	public function list_scraped()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('lead_list') or show_404();

		$userData = json_decode(json_encode([
			'type' => 'Scraped'
		]));
		$users = $this->UsersModel->all(
			['conditions' => "`user_type` = 'SUBSCRIBER' AND `status` != '3' AND `status` = '14' OR `status` = '15' ORDER BY `is_pinned` DESC, `id` DESC"]
		);
		empty($users) or is_array($users) and $userData = json_decode(json_encode([
			'type' => 'Scraped',
			'data' => $users
		]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('leads/scraped', compact('userData'));
		$this->load->view('template/footer');
	}


	public function list_contactus()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('lead_list') or show_404();

		$userData = json_decode(json_encode([
			'type' => 'Contact Us'
		]));
		$users = $this->UsersModel->all(
			['conditions' => "`user_type` = 'SUBSCRIBER' AND `status` != '3' AND `status` = '16' ORDER BY `is_pinned` DESC, `id` DESC"]
		);
		empty($users) or is_array($users) and $userData = json_decode(json_encode([
			'type' => 'Contact Us',
			'data' => $users
		]));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('leads/contactus', compact('userData'));
		$this->load->view('template/footer');
	}


	public function edit_lead($lead_slug = null)
	{
		empty($lead_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('lead_edit') or show_404();

		if ($this->input->post('editLeads')) {

			flash_message(
				'edit/lead/' . $lead_slug,
				$this->input->post('firstName')
					and $this->input->post('lastName')
					and $this->input->post('email')
					and $this->input->post('mobile')
					and $this->input->post('requirement')
					and $this->input->post('status'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			flash_message(
				'edit/lead/' . $lead_slug,
				filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
				'unsuccess',
				'Something Went Wrong',
				'Oops, You Misstyped Your E-mail Address, Please Type Valid E-mail Address.'
			);

			flash_message(
				'edit/lead/' . $lead_slug,
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
				),
				'slug!=' => $lead_slug
			]);
			is_null($email_exists) or is_array($email_exists) and $email_exists = $email_exists['email'];

			flash_message(
				'edit/lead/' . $lead_slug,
				empty($email_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, E-mail Address Already Exists,<br>Please Login With `$email_exists` Or Try With Another E-mail Address."
			);

			$mobile_exists = $this->UsersModel->first([
				'mobile' => str_clean($this->input->post('mobile')),
				'slug!=' => $lead_slug
			]);
			is_null($mobile_exists) or is_array($mobile_exists) and $mobile_exists = $mobile_exists['mobile'];

			flash_message(
				'edit/lead/' . $lead_slug,
				empty($mobile_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, Mobile Already Exists,<br>Please Login With `$mobile_exists` Or Try With Another Mobile."
			);

			$username = explode('@', str_clean($this->input->post('email'), ['@', '.', '-', '_']))[0];
			$username_exists = $this->UsersModel->first([
				'username' => $username,
				'slug!=' => $lead_slug
			]);
			is_null($username_exists) or is_array($username_exists) and $username = increment_string($username, '_', 1);

			$this->agent->is_browser() and $device_type = 'web';
			$this->agent->is_mobile()  and $device_type = 'mobile';
			isset($_POST['pin']) and $_POST['pin'] === 'on' and $pin = '1' or $pin = '';

			$user = $this->UsersModel->updateTable([
				'username'      => $username,
				'slug'          => $username,
				'first_name'    => str_clean($this->input->post('firstName')),
				'last_name'     => str_clean($this->input->post('lastName')),
				'email'         => str_clean($this->input->post('email'), ['@', '.', '-', '_']),
				'mobile'        => str_clean($this->input->post('mobile')),
				'user_type'     => 'SUBSCRIBER',
				'requirement'   => str_clean($this->input->post('requirement'), [',', '.', ' ', '-', '_']),
				'comment'       => $this->input->post('comment'),
				'lead_from'     => $this->input->post('leadFrom'),
				'followup_date' => $this->input->post('followDate'),
				'modified_by'   => $_SESSION['USER_ID'],
				'status'        => $this->input->post('status'),
				'is_pinned'     => $pin,

				'user_ip'           => $this->input->ip_address(),
				'browser'           => $this->agent->browser(),
				'browser_version'   => $this->agent->version(),
				'device_type'       => $device_type,
				'os'                => $this->agent->platform(),
				'mobile_device'     => $this->agent->mobile(),
				'last_login_device' => $this->agent->agent_string()
			], ['slug' => $lead_slug]);

			flash_message(
				'edit/lead/' . $lead_slug,
				$user,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/leads',
				$user,
				'success',
				"Lead Updated Successfully"
			);
		}

		$leadData = '';
		$lead = $this->UsersModel->first([
			'conditions' => [
				'slug'     => $lead_slug,
				'status!=' => '3',
			]
		]);
		empty($lead) or is_array($lead) and $leadData = json_decode(json_encode($lead));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('leads/edit', compact('leadData'));
		$this->load->view('template/footer');
	}


	public function delete_lead($lead_slug = null)
	{
		empty($lead_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('lead_delete') or show_404();
		$user = $this->UsersModel->updateTable([
			'status' => '3',
		], ['slug' => $lead_slug]);

		flash_message(
			'list/leads',
			$user,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/leads',
			$user,
			'success',
			"Lead Deleted Successfully"
		);
	}
}

/* End of file  Lead.php */
