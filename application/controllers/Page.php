<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load FrontEnd Pages */
class Page extends CI_Controller
{
	public function __construct()
	{




		parent::__construct();
		//Do your magic here
		$this->load->model([
			'UsersModel',
			'ProductsModel',
			'SettingsModel',
			'Filter_ValuesModel',
			'FiltersModel',
			'RegisterModel',
			'SlidersModel',
			'ContentModel',
			'CategoriesModel',
			'TestimonialsModel',
			'Filter_Product_Category_RelationsModel',
			'PostsModel',
			'GalleryModel'
		]);
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	/** View FrontEnd Pages
	 *
	 * @param string $Pages
	 * @return void */
	public function view($Pages = 'home', $data)
	{
		$path = APPPATH . '../public' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $Pages . '.php';

		$slider = [];
		$site   = [];
		$city   = [];

		file_exists($path)
			and $site = $this->SettingsModel->get_header_option() or show_404();
		file_exists($path)
			and $slider = get_data_from('sliders');
		show_debug($slider);
		$nav_post = get_data_from('posts');

		file_exists($path)
			and $city = $this->ProductsModel->all([
				'fields'     => ['distinct(extra_field_1) as city'],
				'conditions' => [
					'status'    => true,
					'post_type' => 'property'
				],
				'order' => [
					'by'   => 'city',
					'type' => 'asc'
				],
				'datatype' => 'json'
			])
			or $city = '';
		show_debug($city);

		file_exists($path) and $this->load->view('pages/components/header', compact(
			'site',
			'slider',
			'city',
			'nav_post'
		));
		file_exists($path) and $this->load->view('pages/' . $Pages, compact('data'));
		file_exists($path) and $this->load->view('pages/components/footer');
	}


	/** Load Home Page Data
	 *
	 * @return mixed */

	function home()
	{



		$data['Blogs']    	= get_data_from('posts');
		$data['facility']    	=
			$this->PostsModel->all([
				'conditions' => [
					'post_type' => 'service',
					'status' => '1',
				],
				'datatype'   => 'json',
				'paging' => ['page' => 1, 'limit' => 6]
			]);

		/* for products */

		$data['products']    	=
			$this->ProductsModel->all([
				'conditions' => [
					'post_type' => 'product',
					'status' => '1',
				],
				'datatype'   => 'json',
				'paging' => ['page' => 1, 'limit' => 8]
			]);
		/* orpducts end */

		/* for testimonials */
		$data['testimonials']    	=
			$this->TestimonialsModel->all([
				'conditions' => [

					'status' => '1',
				],
				'datatype'   => 'json',
				'paging' => ['page' => 1, 'limit' => 6]
			]);
			/* testimonials end */
			/* debug */

			/* echo '<pre>';
		print_r($data);
		die();
		echo '</pre>' */;

		return $this->view('home', $data);
	}
	/* HOME END */

	/* SERVICE START */
	public function service($slug)
	{
		$data['service'] 	= $this->PostsModel->first([
			'feilds'     => ['image', 'description', 'title'],
			'conditions' => [
				'slug' => $slug
			],
		]);

		/* debug code */
		/* echo '<pre>';
		print_r($data);
		echo '</pre>'; */
		/* echo $this->db->last_query();
		die(); */
		/* debug code */

		return $this->view('service', $data);
	}

	/* SERVICE END */

	/* Shop Start */

	public function shop($id)
	{

		// if ($this->input->post('submit')) {

		// die('sdfsdf');

		// print_r($this->input->post('Mobile'));
		// die();

		// $order = $this->BookOrderModel->save([
		// 	'first_name'      => $this->input->post('Firstname'),
		// 	'last_name'          => $this->input->post('Lastname'),
		// 	'email'         => $this->input->post('Email'),
		// 	'mobile'     => $this->input->post('Mobile'),
		// 	'status' => true,
		// 	'category_id' => $this->input->post('Category_id'),
		// 	'product_id' => $this->input->post('Product_id'),
		// 	'price' => $this->input->post('Price')



		// ]);
		// 	$msg = "Thank you for your enquiry our executive will contact you soon";
		// 	$msg2 = "You have recived a enquiry from  " . $this->input->post('Firstname') . " Mobile No." . $this->input->post('Mobile');
		// 	shootMsg($msg, $this->input->post('Mobile'));
		// 	shootMsg($msg2, $this->SettingsModel->get_option('site_mobile'));
		// }


		// $data['Products'] 	= $this->ProductsModel->all([
		// 	'conditions' => [
		// 		'post_type' => 'product',
		// 		'status' => '1',
		// 	],
		// 	'datatype'   => 'json',
		// 	'paging' => ['page' => 1, 'limit' => 6]
		// ]);


		$data['single_product'] = $this->ProductsModel->first([
			'feilds'     => ['id', 'title', 'regular_price', 'sell_price', 'image', 'srt_description', 'description', 'category_id'],
			'conditions' => [
				'id' => $id,
				'status' => '1',
				'post_type' => 'product'
			]

		]);

		// echo $this->db->last_query();
		// die();
		return $this->view('shop', $data);
	}

	/* Shop End */



	/* COURSE START */
	public function course($slug, $page = 1)
	{
		$data['category'] = $this->CategoriesModel->all([
			'feilds' => ['id'],
			'conditions' => [
				'status!=' => '3'
			]

		]);





		$limit = 3;
		$data['content'] = $this->ContentModel->all([
			'feilds' => ['id', 'yt_url', 'dp_image'],
			'conditions' => [

				'status' => '1',
				// 'category_id' => $data['category']['id'],
			],
			'datatype'   => 'json',
			'paging' => ['page' => $page, 'limit' => $limit]
		]);

		/* debug */
		// echo $this->db->last_query();
		// die();
		/* debug */
		$total_produuct = $this->ProductsModel->count([
			'conditions' => [
				'post_type' => 'product',
				'status' => '1',

			]
		]);

		// _ddd($data);

		$total_page = round($total_produuct / $limit);
		$data['total_page'] = $total_page;
		$data['page'] = $page;

		return $this->view('course', $data);
		// return $this->load->view('pages/course', $data);
	}
	/* COURSE END */

	/* register start */
	public function register()
	{

		if ($this->input->post('submit')) {

			// die('sdfsdf');

			print_r($this->input->post('phone'));
			die();

			$register = $this->RegisterModel->save([
				'firstname'      => $this->input->post('firstname'),
				'lastname'       => $this->input->post('lastname'),
				'username'       => $this->input->post('username'),
				'password'   	 => $this->input->post('password'),
				'address'        => $this->input->post('address'),
				'email'          => $this->input->post('email'),
				'status'         => true,
				'phone'          => $this->input->post('phone')

			]);

			// echo $this->db->last_query();
			// die();
		}


		return $this->view('register', $register);
	}


	/*register end  */




	/** Load Search & Filter Property Data
	 * @param string $search */
	function search(string $search = null)
	{
		is($_POST['cat']) or $_POST['cat']  = '2';
		is($_POST['city']) or $_POST['city'] = 'kota';

		if (is($search) and !is_null($search) and is($_POST['city']) and is($_POST['cat'])) {
			show_debug($_POST); // Show Post Request

			$title       = $this->input->post('title');
			$cat         = $this->input->post('cat');
			$city        = $this->input->post('city');
			$old_filters = $this->input->post('filter');

			// Manage Old Filters
			is($old_filters, 'array')
				and $filters = 'value_id IN(' . implode(',', $old_filters) . ') and'
				or $filters = '';

			/** Get Properties Ids
			 * @var array  Property's ID*/
			$properties = $this->Filter_Product_Category_RelationsModel->all([
				'fields'     => ['distinct(product_id)'],
				'conditions' => "$filters category_id = $cat",
				'datatype'   => 'json'
			]);


			if (is($properties, 'array'))
				foreach ($properties as $key => $value) {
					$properties[$key] = $value->product_id;
				}
			is($properties, 'array') and $product = implode(',', $properties);

			// Get Property Details
			is($properties, 'array') and $data['properties'] = $this->ProductsModel->all([
				'conditions' => "`id` IN($product) AND `extra_field_1` = '$city' AND `title` LIKE '%$title%' AND `status` = '1'",
				'datatype'   => 'json'
			]);

			// Add Addition Details of Property
			is($properties, 'array') and $data['properties'] = get_properties_details($data['properties']);

			/** Get Filters
			 * @var array */
			$filters = $this->FiltersModel->all([
				'fields'     => ['id', 'filter_title', 'slug'],
				'conditions' => [
					'status'    => true,
					'post_type' => 'property'
				],
				'datatype' => 'json'
			]);
			if (is($filters, 'array'))
				foreach ($filters as $key => $filter) {
					$filter_values = $this->Filter_ValuesModel->all([
						'fields'     => ['id', 'filter_value_title'],
						'conditions' => [
							'filter_key_id' => $filter->id,
							'status'        => true
						],
						'datatype' => 'json'
					]);

					if (is($filter_values, 'array'))
						foreach ($filter_values as $value) {
							$data['filters'][$filter->slug][] = $value;
						}
				}

			$data['selected_filters'] = $old_filters;

			show_debug($data['filters']);
			show_debug($data['selected_filters']);
			return $this->view('product-list', $data);
		}
		return redirect(SITE_URL);
	}


	/** Load Search & Filter Property Data
	 * @param string $search */
	function hot_deals(string $search = null)
	{
		is($search) and $search === 'hot-deals' and $hotDeals = "AND on_deal = '1'" or $hotDeals = '';
		is($search) and $search === 'hot-deals' and $_POST['cat'] = '2';
		is($search) and $search === 'hot-deals' and $_POST['city'] = 'kota';
		is($search) and $search === 'hot-deals' and $_POST['search'] = 'sfgsdfs';

		if (is($search) and !is_null($search) and is($_POST['city']) and is($_POST['cat'])) {
			show_debug($_POST);

			$title       = $this->input->post('title');
			$cat         = $this->input->post('cat');
			$old_filters = $this->input->post('filter');
			$city        = $this->input->post('city');

			is($old_filters, 'array')
				and $filters = 'value_id IN(' . implode(',', $old_filters) . ') and'
				or $filters = '';

			$properties = $this->Filter_Product_Category_RelationsModel->all([
				'fields'     => ['distinct(product_id)'],
				'conditions' => "$filters category_id = $cat",
				'datatype'   => 'json'
			]);

			if (is($properties, 'array'))
				foreach ($properties as $key => $value) {
					$properties[$key] = $value->product_id;
				}
			is($properties, 'array') and $product = implode(',', $properties);

			is($properties, 'array') and $data['properties'] = $this->ProductsModel->all([
				'conditions' => "`id` IN($product) AND `extra_field_1` = '$city' $hotDeals AND `title` LIKE '%$title%' AND `status` = '1'",
				'datatype'   => 'json'
			]);

			is($properties, 'array') and $data['properties'] = get_properties_details($data['properties']);

			$filters = $this->FiltersModel->all([
				'fields'     => ['id', 'filter_title', 'slug'],
				'conditions' => [
					'status'    => true,
					'post_type' => 'property'
				],
				'datatype' => 'json'
			]);
			if (is($filters, 'array'))
				foreach ($filters as $key => $filter) {
					$filter_values = $this->Filter_ValuesModel->all([
						'fields'     => ['id', 'filter_value_title'],
						'conditions' => [
							'filter_key_id' => $filter->id,
							'status'        => true
						],
						'datatype' => 'json'
					]);

					if (is($filter_values, 'array'))
						foreach ($filter_values as $value) {
							$data['filters'][$filter->slug][] = $value;
						}
				}
			show_debug($data['filters']);
			$data['selected_filters'] = $old_filters;
			show_debug($data['selected_filters']);
			return $this->view('hot_deals', $data);
		}
		return redirect(SITE_URL);
	}


	/** Load Search & Filter Property Data
	 * @param string $search */
	function project(string $search = null)
	{
		is($search) and $_POST['filter'] = [$search];
		is($search) and $_POST['cat'] = '2';
		is($search) and $_POST['city'] = 'kota';
		is($search) and $_POST['search'] = 'sfgsdfs';

		if (is($search) and !is_null($search) and is($_POST['city']) and is($_POST['cat'])) {
			show_debug($_POST);

			$title       = $this->input->post('title');
			$cat         = $this->input->post('cat');
			$old_filters = $this->input->post('filter');
			$city        = $this->input->post('city');

			is($old_filters, 'array')
				and $filters = 'value_id IN(' . implode(',', $old_filters) . ') and'
				or $filters = '';

			$properties = $this->Filter_Product_Category_RelationsModel->all([
				'fields'     => ['distinct(product_id)'],
				'conditions' => "$filters category_id = $cat",
				'datatype'   => 'json'
			]);

			if (is($properties, 'array'))
				foreach ($properties as $key => $value) {
					$properties[$key] = $value->product_id;
				}
			is($properties, 'array') and $product = implode(',', $properties);

			is($properties, 'array') and $data['properties'] = $this->ProductsModel->all([
				'conditions' => "`id` IN($product) AND `extra_field_1` = '$city' AND `title` LIKE '%$title%' AND `status` = '1'",
				'datatype'   => 'json'
			]);

			is($properties, 'array') and $data['properties'] = get_properties_details($data['properties']);

			$filters = $this->FiltersModel->all([
				'fields'     => ['id', 'filter_title', 'slug'],
				'conditions' => [
					'status'    => true,
					'post_type' => 'property'
				],
				'datatype' => 'json'
			]);
			if (is($filters, 'array'))
				foreach ($filters as $key => $filter) {
					$filter_values = $this->Filter_ValuesModel->all([
						'fields'     => ['id', 'filter_value_title'],
						'conditions' => [
							'filter_key_id' => $filter->id,
							'status'        => true
						],
						'datatype' => 'json'
					]);

					if (is($filter_values, 'array'))
						foreach ($filter_values as $value) {
							$data['filters'][$filter->slug][] = $value;
						}
				}
			show_debug($data['filters']);
			$data['selected_filters'] = $old_filters;
			show_debug($data['selected_filters']);
			return $this->view('hot_deals', $data);
		}
		return redirect(SITE_URL);
	}


	/** Load About Us Data */
	function about_us()
	{

		$data['testimonial'] = get_data_from('testimonials');
		$this->view('about', $data);
	}


	/** Load Contact Us Data & Send Mail with Save Lead */
	function contact_us()
	{
		if ($this->input->post('submit')) {

			flash_message(
				'contact',
				$this->input->post('name')
					and $this->input->post('email')
					and $this->input->post('subject')
					and $this->input->post('msg'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			flash_message(
				'contact',
				filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
				'unsuccess',
				'Something Went Wrong',
				'Oops, You Misstyped Your E-mail Address, Please Type Valid E-mail Address.'
			);

			// $email_exists = $this->UsersModel->first([
			// 	'email' => str_clean(
			// 		$this->input->post('email'),
			// 		['@', '.', '-', '_']
			// 	)
			// ]);
			// is_null($email_exists) or is_array($email_exists) and $email_exists = $email_exists['email'];

			// flash_message(
			// 	'contact',
			// 	empty($email_exists),
			// 	'unsuccess',
			// 	'Something Went Wrong',
			// 	"Oops, E-mail Address Already Exists,<br>Please Login With `$email_exists` Or Try With Another E-mail Address."
			// );

			$username = explode('@', str_clean($this->input->post('email'), ['@', '.', '-', '_']))[0];
			$username_exists = $this->UsersModel->first(['username' => $username]);
			is_null($username_exists) or is_array($username_exists) and $username = increment_string($username, '_', 1);

			$this->agent->is_browser() and $device_type = 'web';
			$this->agent->is_mobile()  and $device_type = 'mobile';

			$user = $this->UsersModel->save([
				'username'      => $username,
				'slug'          => $username,
				'first_name'    => str_clean($this->input->post('name')),
				'email'         => str_clean($this->input->post('email'), ['@', '.', '-', '_']),
				'user_type'     => 'SUBSCRIBER',
				'requirement'   => str_clean($this->input->post('subject'), [' ', ',', '-', '_', '.']),
				'comment'       => str_clean($this->input->post('msg'), [' ', ',', '-', '_', '.']),
				'lead_from'     => 'contact',
				'status'        => '16',

				'user_ip'           => $this->input->ip_address(),
				'browser'           => $this->agent->browser(),
				'browser_version'   => $this->agent->version(),
				'device_type'       => $device_type,
				'os'                => $this->agent->platform(),
				'mobile_device'     => $this->agent->mobile(),
				'last_login_device' => $this->agent->agent_string()
			]);

			flash_message(
				'contact',
				$user,
				'unsuccess',
				"Something Went Wrong"
			);

			sendMail(
				$this->input->post('email'),
				'Thanks For Your Request',
				'Hey ' . ucwords($this->input->post('name')) . ', Thanks for Your Request, We will working it on asap. Team ' . ucwords($this->SettingsModel->get_option('site_name'))
				// TODO -  str_replace('{{username}}', ucwords($this->input->post('name')), $this->SettingsModel->get_option('contact_us_mail_response'))
			);

			sendMail(
				$this->SettingsModel->get_option('site_mail'),
				'Your Have New Enquiry',
				'Hey, You Have Inquiry, Please Check in Dashboard and working it on asap. Team ' . ucwords($this->SettingsModel->get_option('site_name'))
				// TODO -  str_replace('{{username}}', ucwords($this->input->post('name')), $this->SettingsModel->get_option('contact_us_mail_response'))
			);

			shootMsg('Hey, You Have Inquiry, Please Check in Dashboard and working it on asap. Team ' . ucwords($this->SettingsModel->get_option('site_name')), $this->SettingsModel->get_option('site_mobile'));

			flash_message(
				'contact',
				$user,
				'success',
				"We will Get Your Request",
				'We will working it on asap.'
			);
		}

		$data = [
			'site_name'    => $this->SettingsModel->get_option('site_name'),
			'site_mobile'  => $this->SettingsModel->get_option('site_mobile'),
			'site_mail'    => $this->SettingsModel->get_option('site_mail'),
			'site_address' => $this->SettingsModel->get_option('site_address'),
			'site_map'     => $this->SettingsModel->get_option('site_map'),
		];

		$this->view('contact', $data);
	}


	/** Load Contact Us Data & Send Mail with Save Lead */
	function get_call()
	{
		if ($this->input->post('submit')) {

			flash_message(
				'contact',
				$this->input->post('name')
					and $this->input->post('email')
					and $this->input->post('mobile'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);

			flash_message(
				'contact',
				filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
				'unsuccess',
				'Something Went Wrong',
				'Oops, You Misstyped Your E-mail Address, Please Type Valid E-mail Address.'
			);

			// $email_exists = $this->UsersModel->first([
			// 	'email' => str_clean(
			// 		$this->input->post('email'),
			// 		['@', '.', '-', '_']
			// 	)
			// ]);
			// is_null($email_exists) or is_array($email_exists) and $email_exists = $email_exists['email'];

			// flash_message(
			// 	'contact',
			// 	empty($email_exists),
			// 	'unsuccess',
			// 	'Something Went Wrong',
			// 	"Oops, E-mail Address Already Exists,<br>Please Login With `$email_exists` Or Try With Another E-mail Address."
			// );

			$username = explode('@', str_clean($this->input->post('email'), ['@', '.', '-', '_']))[0];
			$username_exists = $this->UsersModel->first(['username' => $username]);
			is_null($username_exists) or is_array($username_exists) and $username = increment_string($username, '_', 1);

			$this->agent->is_browser() and $device_type = 'web';
			$this->agent->is_mobile()  and $device_type = 'mobile';

			$user = $this->UsersModel->save([
				'username'      => $username,
				'slug'          => $username,
				'first_name'    => str_clean($this->input->post('name')),
				'mobile'        => str_clean($this->input->post('mobile')),
				'email'         => str_clean($this->input->post('email'), ['@', '.', '-', '_']),
				'user_type'     => 'SUBSCRIBER',
				'requirement'   => 'Get Call Back',
				'lead_from'     => 'Get A CallBack Popup',
				'status'        => '16',

				'user_ip'           => $this->input->ip_address(),
				'browser'           => $this->agent->browser(),
				'browser_version'   => $this->agent->version(),
				'device_type'       => $device_type,
				'os'                => $this->agent->platform(),
				'mobile_device'     => $this->agent->mobile(),
				'last_login_device' => $this->agent->agent_string()
			]);

			flash_message(
				'contact',
				$user,
				'unsuccess',
				"Something Went Wrong"
			);

			sendMail(
				$this->input->post('email'),
				'Thanks For Your Request',
				'Hey ' . ucwords($this->input->post('name')) . ', Thanks for Your Request, We will working it on asap. Team ' . ucwords($this->SettingsModel->get_option('site_name'))
				// TODO -  str_replace('{{username}}', ucwords($this->input->post('name')), $this->SettingsModel->get_option('contact_us_mail_response'))
			);

			sendMail(
				$this->SettingsModel->get_option('site_mail'),
				'Your Have New Enquiry',
				'Hey, You Have Inquiry, Please Check in Dashboard and working it on asap. Team ' . ucwords($this->SettingsModel->get_option('site_name'))
				// TODO -  str_replace('{{username}}', ucwords($this->input->post('name')), $this->SettingsModel->get_option('contact_us_mail_response'))
			);

			shootMsg('Hey ' . ucwords($this->input->post('name')) . ', Thanks for Your Request, We will working it on asap. Team ' . ucwords($this->SettingsModel->get_option('site_name')), $this->input->post('mobile'));

			shootMsg('Hey, You Have Inquiry, Please Check in Dashboard and working it on asap. Team ' . ucwords($this->SettingsModel->get_option('site_name')), $this->SettingsModel->get_option('site_mobile'));

			flash_message(
				'contact',
				$user,
				'success',
				"We will Get Your Request",
				'We will working it on asap.'
			);
		}
		redirect(SITE_URL);
	}


	function gallery()
	{
		$data['gallery'] = $this->GalleryModel->all([
			'fields'     => ['DISTINCT(img_group)'],
			'conditions' => ['status' => true],
			'datatype'   => 'json'
		]);

		foreach ($data['gallery'] as $key => $value) {
			$data['gallery'][$key]->count = $this->GalleryModel->count([
				'conditions' => [
					'img_group' => $value->img_group
				],
				'status' => true
			]);
		}
		show_debug($data['gallery']);
		$this->view('gallery', $data);
	}

	function galleryView($imgGroup = null)
	{
		$data['gallery'] = $this->GalleryModel->all([
			'conditions' => [
				'img_group' => str_replace('-', ' ', $imgGroup),
				'status'    => true
			],
			'datatype' => 'json'
		]);
		$this->view('galleryview', $data);
	}


	function property($slug = null)
	{
		is($slug) or show_404();
		$data['SingleProperty'] = json_decode(json_encode($this->ProductsModel->first(['slug' => $slug])));

		// Get Project Filter ID
		$project = $this->db->get_where("filters", ['slug' => 'projects'])->first_row();
		is($project, 'json') and $project_id = $project->id;

		// Get Location Filter ID
		$location = $this->db->get_where("filters", ['slug' => 'locality'])->first_row();
		is($location, 'json') and $location_id = $location->id;


		// Get Project & Property Relation
		is($project_id) and $project_relation = $this->db->get_where("filter_product_category_relations", [
			'key_id'     => $project_id,
			'product_id' => $data['SingleProperty']->id
		])->first_row();
		is($project_relation, 'json') and $project_value_id = $project_relation->value_id;

		// Get Project Name
		is($project_value_id) and $project = $this->db->get_where("filter_values", ['id' => $project_value_id])->first_row();
		is($project, 'json') and $project_name = $project->filter_value_title;

		// Send with Data
		is($project_name) and $data['SingleProperty']->project = $project_name;

		// Get Location Relation
		is($location_id) and $location_relation = $this->db->get_where("filter_product_category_relations", [
			'key_id'     => $location_id,
			'product_id' => $data['SingleProperty']->id
		])->first_row();
		is($location_relation, 'json') and $location_value_id = $location_relation->value_id;

		// Get Location Name
		is($location_value_id) and $locationss = $this->db->get_where("filter_values", ['id' => $location_value_id])->first_row();
		is($locationss, 'json') and $location_name = $locationss->filter_value_title;

		// Send with Data
		is($location_name) and $data['SingleProperty']->location = $location_name;

		//city
		is($data['SingleProperty']->extra_field_1) and $data['SingleProperty']->city = $data['SingleProperty']->extra_field_1;

		// Get Image
		strpos($data['SingleProperty']->image, '@') and $img = explode('@', $data['SingleProperty']->image) and is_array($img) and $data['SingleProperty']->image = $img or $data['SingleProperty']->image = $data['SingleProperty']->image;

		is($data['SingleProperty']) and $product_id = $data['SingleProperty']->id;

		is($data['SingleProperty']) and $query = $this->db->query("SELECT f.filter_title as filter, v.filter_value_title AS title FROM `filter_product_category_relations` relation INNER JOIN `filters` f ON relation.key_id = f.id INNER JOIN `filter_values` v ON relation.value_id = v.id WHERE relation.product_id = $product_id");
		is($query) and $data['filters'] = $query->result();
		show_debug($data);
		$this->view('view-details', $data);
	}

	function blogs()
	{
		$data['Blogs'] = get_data_from('posts');
		show_debug($data['Blogs']);
		$this->view('blog', $data);
	}

	function blog(string $slug = null)
	{
		$data['value'] = json_decode(json_encode($this->PostsModel->first(['slug' => $slug])));
		$this->view('single-blog', $data['value']);
	}

	function privacy()
	{
		$this->view('privacy', '');
	}

	function disclaimer()
	{
		$this->view('disclaimer', '');
	}

	function thirdparty()
	{
		$this->view('thirdparty', '');
	}
}

/* End of file  Pages.php */
