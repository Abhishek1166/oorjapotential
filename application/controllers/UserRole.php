<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Role Pages & Queries */
class UserRole extends CI_Controller
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

		$this->load->model(['UsersModel', 'User_GroupsModel', 'User_ModulesModel', 'User_Group_PowersModel']);
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	/** Add Role */
	public function add_role()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('user-role_add') or show_404();
		if ($this->input->post('addRole')) {
			flash_message(
				'add/user-role',
				$this->input->post('roleTitle')
					and $this->input->post('powers'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$role_exists = $this->User_GroupsModel->first([
				'group_title' => str_clean(
					$this->input->post('roleTitle'),
					[' ', '-', '_']
				)
			]);

			is_null($role_exists)
				or is_array($role_exists)
				and $role_exists = $role_exists['group_title'];

			flash_message(
				'add/user-role',
				empty($role_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, User Group Role Already Exists,<br>Please Try With Another User Group Role Name."
			);

			$slug = str_clean($this->input->post('roleTitle'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->User_GroupsModel->first(['slug' => $slug]);
			is_null($slug_exists)
				or is_array($slug_exists)
				and $slug = increment_string($slug, '-', 1);

			$role_id = $this->User_GroupsModel->save([
				'slug'        => $slug,
				'group_title'  => str_clean($this->input->post('roleTitle'), [' ', '-', '_']),
				'created_by'  => $_SESSION['USER_ID'],
				'modified_by' => $_SESSION['USER_ID'],
				'status'      => true,
			]);

			if (@is($_POST['powers']) and is_array($_POST['powers']))
				foreach ($_POST['powers'] as $module => $values) {
					$module = explode(':', $module);
					$module_slug = $module[0];
					$module_id = $module[1];

					foreach ($values as $operation => $value) {
						$operation === 'create' and $action = $module_slug . '_add';
						$operation === 'read' 	and $action = $module_slug . '_list';
						$operation === 'update' and $action = $module_slug . '_edit';
						$operation === 'delete' and $action = $module_slug . '_delete';
						$operation !== 'create'
							and $operation !== 'read'
							and $operation !== 'update'
							and $operation !== 'delete'
							and $action = '';

						$power = $this->User_Group_PowersModel->save([
							'group_id'    => $role_id,
							'module_id'   => $module_id,
							'action_key'  => $action,
							'status'      => true,
							'created_by'  => $_SESSION['USER_ID'],
							'modified_by' => $_SESSION['USER_ID']
						]);
					}
				}
			flash_message(
				'add/user-role',
				$role_id and $power,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/roles',
				$role_id and $power,
				'success',
				"Role Created Successfully"
			);
		}

		$modules = $this->User_ModulesModel->all([
			'conditions' => [
				'status!=' => '3'
			],
			'order' => [
				'by' => 'module_title',
				'type' => 'ASC'
			],
			'datatype' => 'json'
		]);

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('role/add', compact('modules'));
		$this->load->view('template/footer');
	}


	/** Load Role List Page */
	public function list_roles()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('user-role_list') or show_404();
		$roleData = json_decode(json_encode([
			'type' => 'User Group Roles'
		]));

		$ids = $this->UsersModel->get_childs($_SESSION['USER_ID']);
		is($ids) and $role = $this->User_GroupsModel->all([
			'fields'     => [
				'user_groups.*',
				'parent.first_name',
				'parent.last_name'
			],
			'conditions' => "user_groups.status != 3 AND user_groups.created_by IN($ids)",
			'join'       => [
				'tableName' => 'users as parent',
				'condition' => 'user_groups.created_by = parent.id'
			],
			'order' => [
				'by'   => 'user_groups.id',
				'type' => 'DESC'
			],
			'datatype' => 'json'
		]);

		is($role) and is_array($role)
			and $roleData = json_decode(json_encode([
				'type' => 'User Group Roles',
				'data' => $role
			]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('role/list', compact('roleData'));
		$this->load->view('template/footer');
	}


	/** Edit Role */
	public function edit_role($role_slug = null)
	{
		empty($role_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('user-role_edit') or show_404();

		if ($this->input->post('editRole')) {
			flash_message(
				'edit/user-role/' . $role_slug,
				$this->input->post('roleTitle')
					and $this->input->post('powers'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			$role_exists = $this->User_GroupsModel->first([
				'group_title' => str_clean(
					$this->input->post('roleTitle'),
					[' ', '-', '_']
				),
				'slug!=' => $role_slug
			]);

			is_null($role_exists)
				or is_array($role_exists)
				and $role_exists = $role_exists['group_title'];

			flash_message(
				'edit/user-role/' . $role_slug,
				empty($role_exists),
				'unsuccess',
				'Something Went Wrong',
				"Oops, User Group Role Already Exists,<br>Please Try With Another User Group Role Name."
			);

			$slug = str_clean($this->input->post('roleTitle'), [' ', '-', '_'], 'slug');
			$slug_exists = $this->User_GroupsModel->first([
				'slug' => $slug,
				'id!=' => $this->input->post('role_id')
			]);
			is_null($slug_exists)
				or is_array($slug_exists)
				and $slug = increment_string($slug, '-', 1);

			$role_id = $this->User_GroupsModel->updateTable([
				'slug'        => $slug,
				'group_title'  => str_clean($this->input->post('roleTitle'), [' ', '-', '_']),
				'created_by'  => $_SESSION['USER_ID'],
				'modified_by' => $_SESSION['USER_ID'],
				'status'      => true,
			], $this->input->post('role_id'));

			is($_POST['powers'])
				and is_array($_POST['powers'])
				and $this->User_Group_PowersModel->destroy(['group_id' => $this->input->post('role_id')]);

			if (is($_POST['powers']) and is_array($_POST['powers']))
				foreach ($_POST['powers'] as $module => $values) {
					$module = explode(':', $module);
					$module_slug = $module[0];
					$module_id = $module[1];

					foreach ($values as $operation => $value) {
						$operation === 'create' and $action = $module_slug . '_add';
						$operation === 'read' 	and $action = $module_slug . '_list';
						$operation === 'update' and $action = $module_slug . '_edit';
						$operation === 'delete' and $action = $module_slug . '_delete';
						$operation !== 'create'
							and $operation !== 'read'
							and $operation !== 'update'
							and $operation !== 'delete'
							and $action = '';

						$power = $this->User_Group_PowersModel->save([
							'group_id'    => $this->input->post('role_id'),
							'module_id'   => $module_id,
							'action_key'  => $action,
							'status'      => true,
							'created_by'  => $_SESSION['USER_ID'],
							'modified_by' => $_SESSION['USER_ID']
						]);
					}
				}

			if ($_SESSION['USER_TYPE'] === 'ADMIN' and $this->input->post('role_id') === $_SESSION['USER_ROLE']) {
				unset($_SESSION['USER_POWER']);
				$powers = $this->User_Group_PowersModel->all([
					'conditions' => [
						'group_id' => $this->input->post('role_id'),
						'status!=' => '3'
					],
					'fields' => ['action_key']
				]);

				$power = [];
				if (isset($powers) and is_array($powers)) {
					foreach ($powers as $VALUE) {
						foreach ($VALUE as $val) {
							$power[] = $val;
						}
					}
					$this->session->set_userdata([
						'USER_POWER'    => $power
					]);
				}
			}

			flash_message(
				'edit/user-role/' . $role_slug,
				$role_id and $power,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/roles',
				$role_id and $power,
				'success',
				"User Group Role Updated Successfully"
			);
		}

		$roleData = '';
		$role = $this->User_GroupsModel->first([
			'conditions' => [
				'slug'     => $role_slug,
				'status!=' => '3',
			]
		]);

		empty($role) or is_array($role) and $roleData = json_decode(json_encode($role));
		$modules = $this->User_ModulesModel->all([
			'conditions' => [
				'status!=' => '3'
			],
			'order' => [
				'by' => 'module_title',
				'type' => 'ASC'
			],
			'datatype' => 'json'
		]);

		$powers = $this->User_Group_PowersModel->all([
			'conditions' => [
				'group_id' => $role['id'],
				'status!=' => '3'
			],
			'fields' => ['action_key']
		]);
		$power = [];
		if (isset($powers) and is_array($powers))
			foreach ($powers as $VALUE) {
				foreach ($VALUE as $val) {
					$power[] = $val;
				}
			}

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('role/edit', compact('roleData', 'modules', 'power'));
		$this->load->view('template/footer');
	}

	/** Delete Role */
	public function delete_role($role_slug = null)
	{
		empty($role_slug) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('user-role_delete') or show_404();
		$role = $this->User_GroupsModel->updateTable([
			'status' => '3',
		], ['slug' => $role_slug]);
		flash_message(
			'list/roles',
			$role,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/roles',
			$role,
			'success',
			"Role Deleted Successfully"
		);
	}
}

    /* End of file  UserRole.php */
