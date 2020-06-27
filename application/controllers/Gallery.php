<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Category Pages & Queries */
class Gallery extends CI_Controller
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
		$this->load->model('GalleryModel');
	}


	/** Load Default Index To Show 404 Error
	 *
	 * @return void */
	public function index()
	{
		return show_404();
	}


	/** Add Gallery */
	public function add_gallery()
	{
		flash_message(
			'dashboard/login',
			is_login(),
			'unsuccess',
			'Please Login Then Try Again'
		);

		user_can('gallery_add') or show_404();

		if ($this->input->post('addGallery')) {

			$img_group = $this->input->post('img_group');

			/* Upload Images */
			$form_images = upload(['uploads/gallery' => 'galleryImg']);

			flash_message(
				'add/gallery',
				is($form_images['galleryImg'][0]),
				'unsuccess',
				'Something Went Wrong',
				'Please Upload Atleast One Image.'
			);

			isset($form_images['galleryImg']) or $gallery_image = "";

			if (is_array($form_images['galleryImg']))
				foreach ($form_images['galleryImg'] as $val) {
					$gallery = $this->GalleryModel->save([
						'image'       => $val,
						'img_group'   => $this->input->post('img_group'),
						'status'      => true,
						'created_by'  => $_SESSION['USER_ID'],
						'modified_by' => $_SESSION['USER_ID'],
					]);
				}

			flash_message(
				'add/gallery',
				$gallery,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/galleries',
				$gallery,
				'success',
				"Gallery Created Successfully"
			);
		}

		$gal = json_decode(json_encode($this->GalleryModel->all([
			'conditions' => ['status!=' => '3'],
			'fields' => ['DISTINCT(img_group)']
		])));

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('gallery/add', compact('gal'));
		$this->load->view('template/footer');
	}


	/** Load Category List Page */
	public function list_galleries()
	{
		$galleryData = json_decode(json_encode([
			'type' => 'Gallery'
		]));
		$gallery = $this->GalleryModel->all([
			'fields'     => ['gallery.*', 'users.first_name', 'users.last_name'],
			'conditions' => [
				'gallery.status!=' => '3',
			],
			'join' => [
				'tableName' => 'users',
				'condition' => 'gallery.created_by = users.id'
			],
			'order' => [
				'by'   => 'gallery.id',
				'type' => 'DESC'
			]
		]);

		is($gallery, 'array') and $galleryData = json_decode(json_encode([
			'type' => 'Gallery',
			'data' => $gallery
		]));
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('gallery/list', compact('galleryData'));
		$this->load->view('template/footer');
	}



	/** Add Category */
	public function edit_gallery($id)
	{


		if ($this->input->post('editGallery')) {

			/* Upload Images */
			$form_images = upload(['uploads/gallery' => 'galleryImg']);

			isset($form_images['galleryImg']) and $gallery_image = $form_images['galleryImg'][0] or $gallery_image = $this->input->post('oldgalleryImg');

			$gallery = $this->GalleryModel->updateTable([
				'image'       => $gallery_image,
				'img_group' => $this->input->post('img_group'),
				'modified_by' => $_SESSION['USER_ID'],
				'status'      => true,
			], ['id' => $id]);

			flash_message(
				'edit/gallery/' . $id,
				$gallery,
				'unsuccess',
				"Something Went Wrong"
			);

			flash_message(
				'list/galleries',
				$gallery,
				'success',
				"Gallery Updated Successfully"
			);
		}

		$galleryData = '';
		$gallery = $this->GalleryModel->first([
			'conditions' => [
				'id'     => $id,
				'status!=' => '3',
			]
		]);

		empty($gallery) or is_array($gallery) and $galleryData = json_decode(json_encode($gallery));

		$gal = json_decode(json_encode($this->GalleryModel->all([
			'conditions' => ['status!=' => '3'],
			'fields' => ['DISTINCT(img_group)']
		])));

		// die($this->db->last_query());

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('gallery/edit', compact('gal', 'galleryData'));
		$this->load->view('template/footer');
	}


	public function delete_gallery($id)
	{

		$gallery = $this->GalleryModel->updateTable([
			'status' => '3',
		], ['id' => $id]);
		flash_message(
			'list/galleries',
			$gallery,
			'unsuccess',
			"Something Went Wrong"
		);

		flash_message(
			'list/galleries',
			$gallery,
			'success',
			"Gallery Image Deleted Successfully"
		);
	}
}

    /* End of file  Product.php */
