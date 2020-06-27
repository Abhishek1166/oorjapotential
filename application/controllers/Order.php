<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Order Pages & Queries */
class Order extends CI_Controller
{

	/** Payment Status Values
	 *
	 * @var array */
	protected $Payment = [
		'0' => 'unpaid',
		'1' => 'paid',
		'2' => 'refund'
	];

	/** Delivery Status Values
	 *
	 * @var array */
	protected $Delivery = [
		'0' => 'new',
		'1' => 'delivered',
		'2' => 'in process',
		'3' => 'cancel',
		'4' => 'return'
	];

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

		$this->load->helper('string');
		$this->load->model([
			'CategoriesModel',
			'FiltersModel',
			'Filter_ValuesModel',
			'OrdersModel',
			'ProductsModel',
			'Filter_Product_Category_RelationsModel',
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

	/** Add Order */
	public function add_order()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('order_add') or show_404();

		if ($this->input->post('addOrder')) {

			flash_message(
				'add/order',
				$this->input->post('product'),
				is_array($this->input->post('product'))
					and $this->input->post('user')
					and $this->input->post('paymentMode')
					and $this->input->post('remark'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);
			is($_POST['product'], 'array')
				and $products = $this->input->post('product');

			$order_group_id = random_string('nozero', 8);
			$last = $this->OrdersModel->first(['order_group_id' => 'ODR' . $order_group_id]);
			is($last, 'array') and $order_group_id = random_string('nozero', 8);

			if (is($products, 'array'))
				foreach ($products as $value) {
					$product = json_decode(json_encode($this->ProductsModel->first([
						'conditions' => [
							'id'        => $value,
							'post_type' => 'product'
						],
						'fields' => ['id', 'sell_price']
					])));

					$price      = (int) $product->sell_price;
					$product_id = $product->id;

					$this->agent->is_mobile()   and $device_type = 'mobile';
					$this->agent->is_browser()  and $device_type = 'web';
					!$this->agent->is_browser() and !$this->agent->is_mobile() and $device_type = 'rest';

					$order_id = $this->OrdersModel->save([
						'order_group_id'   => 'ODR' . $order_group_id,
						'user_id'          => str_clean($this->input->post('user')),
						'product_id'       => $product_id,
						'product_quantity' => '1',
						'total_amount'     => $price,
						'total_paid'       => $price,
						'remark'           => str_clean($this->input->post('remark'), [' ', ', ', '-', '_', '.', "'"]),
						'payment_mode'     => str_clean($this->input->post('paymentMode')),
						'payment_status'   => true,
						'delivery_status'  => '0',
						'status'           => true,
						'transaction_id'   => random_string('md5', 20),
						'transaction_msg'  => 'backend',
						'user_ip'          => $this->input->ip_address(),
						'browser'          => $this->agent->browser(),
						'browser_version'  => $this->agent->version(),
						'device_type'      => $device_type,
						'os'               => $this->agent->platform(),
						'mobile_device'    => $this->agent->mobile(),
						'created_by'       => $_SESSION['USER_ID'],
						'modified_by'      => $_SESSION['USER_ID'],
					]);
				}

			flash_message(
				'list/orders',
				$order_id,
				'unsuccess',
				'Something Went Wrong'
			);

			flash_message(
				'list/orders',
				$order_id,
				'success',
				'Order Added Successfully'
			);
		}

		$products = $this->ProductsModel->all([
			'feilds'     => ['id', 'title'],
			'conditions' => [
				'status!='  => 3,
				'post_type' => 'product'
			],
			'datatype' => 'json'
		]);

		$users = $this->UsersModel->all([
			'feilds'     => ['id', 'first_name', 'last_name'],
			'conditions' => [
				'status'    => true,
				'user_type' => 'SUBSCRIBER'
			],
			'datatype' => 'json'
		]);

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('order/add', compact('products', 'users'));
		$this->load->view('template/footer');
	}


	/** Load Order List Page */
	public function list_orders()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('order_list') or show_404();
		$orderData = json_decode(json_encode([
			'type' => 'Orders'
		]));
		$order = $this->OrdersModel->all([
			'fields'     => ['orders.*', 'users.first_name', 'users.last_name'],
			'conditions' => "orders.status != '3' GROUP BY orders.order_group_id",
			'join'       => [
				'tableName' => 'users',
				'condition' => 'users.id = orders.user_id'
			],
			'order'      => [
				'by'   => 'orders.id',
				'type' => 'DESC'
			],
			'datatype' => 'json'
		]);
		$price = 0;
		if (is($order, 'array'))
			foreach ($order as $key => $value) {
				$products = $this->OrdersModel->all([
					'conditions' => ['order_group_id' => $value->order_group_id],
					'datatype'   => 'json'
				]);
				if (is($products, 'array'))
					foreach ($products as $keys => $product) {

						// Payment Status
						$order[$key]->payment_status = ucwords($this->Payment[$product->payment_status]);

						// Delivery Status
						$order[$key]->delivery_status = ucwords($this->Delivery[$product->delivery_status]);

						// Total Order Price
						$price += $product->total_paid;

						// Created By
						$user = $this->UsersModel->first($product->created_by);
						is($user, 'array') and $order[$key]->created_by = ucwords($user['first_name'] . ' ' . $user['last_name']);
					}
				$order[$key]->price = $price;
			}

		is($order, 'array')
			and $orderData = json_decode(json_encode([
				'type' => 'Orders',
				'data' => $order
			]));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('order/list', compact('orderData'));
		$this->load->view('template/footer');
	}


	/** Edit Order */
	public function edit_order($order_no)
	{
		empty($order_no) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('order_edit') or show_404();

		if ($this->input->post('editOrder')) {

			flash_message(
				'edit/order/' . $order_no,
				$this->input->post('product'),
				is_array($this->input->post('product'))
					and $this->input->post('user')
					and $this->input->post('paymentMode')
					and $this->input->post('paymentStatus')
					and $this->input->post('status')
					and $this->input->post('remark'),
				'unsuccess',
				'Something Went Wrong',
				'Look like Form Not Fill Properly, Please Fill & Try Again.'
			);
			is($_POST['product'], 'array')
				and $products = $this->input->post('product');

			$order_group_id = $order_no;

			if (is($products, 'array'))
				foreach ($products as $value) {
					$product = json_decode(json_encode($this->ProductsModel->first([
						'conditions' => [
							'id'        => $value,
							'post_type' => 'product'
						],
						'fields' => ['id', 'sell_price']
					])));

					$price      = (int) $product->sell_price;
					$product_id = $product->id;

					$this->agent->is_mobile()   and $device_type = 'mobile';
					$this->agent->is_browser()  and $device_type = 'web';
					!$this->agent->is_browser() and !$this->agent->is_mobile() and $device_type = 'rest';

					$this->OrdersModel->destroy(['order_group_id' => $order_no]);

					$order_id = $this->OrdersModel->save([
						'order_group_id'   => $order_group_id,
						'user_id'          => str_clean($this->input->post('user')),
						'product_id'       => $product_id,
						'product_quantity' => '1',
						'total_amount'     => $price,
						'total_paid'       => $price,
						'remark'           => str_clean($this->input->post('remark'), [' ', ', ', '-', '_', '.', "'"]),
						'payment_mode'     => str_clean($this->input->post('paymentMode')),
						'payment_status'   => $this->input->post('paymentStatus'),
						'delivery_status'  => $this->input->post('status'),
						'status'           => true,
						'transaction_id'   => random_string('md5', 20),
						'transaction_msg'  => 'backend',
						'user_ip'          => $this->input->ip_address(),
						'browser'          => $this->agent->browser(),
						'browser_version'  => $this->agent->version(),
						'device_type'      => $device_type,
						'os'               => $this->agent->platform(),
						'mobile_device'    => $this->agent->mobile(),
						'created_by'       => $_SESSION['USER_ID'],
						'modified_by'      => $_SESSION['USER_ID'],
					]);
				}

			flash_message(
				'list/orders',
				$order_id,
				'unsuccess',
				'Something Went Wrong'
			);

			flash_message(
				'list/orders',
				$order_id,
				'success',
				'Order Added Successfully'
			);
		}

		$orders = $this->OrdersModel->all([
			'conditions' => [
				'status!='       => '3',
				'order_group_id' => $order_no
			],
			'datatype' => 'json'
		]);

		$products = $this->ProductsModel->all([
			'feilds'     => ['id', 'title'],
			'conditions' => [
				'status!='  => 3,
				'post_type' => 'product'
			],
			'datatype' => 'json'
		]);

		$users = $this->UsersModel->all([
			'feilds'     => ['id', 'first_name', 'last_name'],
			'conditions' => [
				'status'    => true,
				'user_type' => 'SUBSCRIBER'
			],
			'datatype' => 'json'
		]);

		$payments = $this->Payment;
		$delivery = $this->Delivery;

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('order/edit', compact('orders', 'products', 'users', 'payments', 'delivery'));
		$this->load->view('template/footer');
	}


	/** Delete Order */
	public function delete_order($order_no = null)
	{
		empty($order_no) and show_404();

		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('order_delete') or show_404();
		$order = $this->OrdersModel->updateTable([
			'status' => '3',
		], ['order_group_id' => $order_no]);
		flash_message(
			'list/orders',
			$order,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/orders',
			$order,
			'success',
			"Order Deleted Successfully"
		);
	}
}

    /* End of file  Order.php */
