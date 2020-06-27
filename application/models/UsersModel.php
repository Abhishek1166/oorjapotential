<?php defined('BASEPATH') or exit('No direct script access allowed');

class UsersModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
		$this->tableName = 'users';
	}

	public function get_childs($user_id = null)
	{
		$childID = $user_id;
		// $last = $this->first([
		// 	'fields' => ['MAX(id)'],
		// 	'conditions' => ['status!=' => 3],
		// ]);

		// $totalParent = $this->all([
		// 	'fields' => ['DISTINCT(parent_id)'],
		// 	'conditions' => ['status!=' => 3]
		// ]);

		// foreach ($totalParent as $totalParent) {
		// 	$totalParent[] = $totalParent;
		// }


		// for ($i = 0; $i < $last['MAX(id)']; $i++) {
		// 	$parents = $this->all([
		// 		'fields'     => ['id', 'parent_id'],
		// 		'conditions' => "`parent_id` = '$user_id' OR `id` = '$user_id' AND `status` != '3'",
		// 		'datatype'   => 'json'
		// 	]);
		// 	// echo $this->db->last_query();
		// 	foreach ($parents as $value) {
		// 		if ($value->parent_id == $user_id and in_array($user_id, $totalParent)) {
		// 			$data[$value->id] = $value;
		// 			$childID .= "," . $value->id;
		// 		} else {
		// 			echo '<br>', $value->id;
		// 		}
		// 	}
		// 	$user_id = $user_id + 1;
		// }

		do {
			$users = $this->all([
				'fields'     => ['id', 'parent_id'],
				'conditions' => "`parent_id` = '$user_id' OR `id` = '$user_id' AND `status` != '3'"
			]);
			// echo '<br>', $this->db->last_query(), '<br>';
			// die;
			$totals = [$user_id];
			foreach ($users as $value) {
				if (
					in_array($value['parent_id'], $totals)
					and $value['parent_id'] == $user_id
				) {
					$data[$value['id']] = $value;
					$childID .= "," . $value['id'];
					$totals = explode(',', $childID);
				}
				// var_dump($totals);
			}
			// $query =
			$user_id = $user_id + 1;
			// echo '<br>';
		} while (is($users, 'array'));

		return $childID;
	}
}

/* End of file UsersModel.php */
