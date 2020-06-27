<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Category Pages & Queries */
class Slider extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model(['SlidersModel', 'UsersModel']);
    }


    /** Load Default Index To Show 404 Error
     *
     * @return void */
    public function index()
    {
        return show_404();
    }


    /** Load Category List Page */
    public function list_sliders()
    {
        $sliderData = json_decode(json_encode([
            'type' => 'Sliders'
        ]));
        $slider = $this->SlidersModel->all([
            'conditions' => [
                'status!=' => '3',
            ],
            'order' => [
                'by' => 'id',
                'type' => 'DESC'
            ]
        ]);

        if (!empty($slider)) foreach ($slider as $key => $val) {

            $user = $this->UsersModel->first($val['created_by']);

            empty($user) and $slider[$key]['created_by'] = '' or $slider[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);


            //     if (!empty($val['parent_id'])) {
            //         $user = $this->UsersModel->first($val['created_by']);
            //         $cats = $this->SlidersModel->first($val['parent_id']);

            //         empty($user) and $slider[$key]['created_by'] = '' or $slider[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
            //         empty($cats) and $slider[$key]['parent_id'] = 'Self' or $slider[$key]['parent_id'] = ucwords($cats['title']);
            //     } else {
            //         $user = $this->UsersModel->first($val['created_by']);

            //         empty($user) and $slider[$key]['created_by'] = '' or $slider[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
            //         $slider[$key]['parent_id'] = 'Self';
            //     }
        }

        empty($slider) or is_array($slider) and $sliderData = json_decode(json_encode([
            'type' => 'Sliders',
            'data' => $slider
        ]));
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('slider/list', compact('sliderData'));
        $this->load->view('template/footer');
    }


    /** Add Category */
    public function add_slider()
    {
        if ($this->input->post('addSlider')) {
            $title              = $_REQUEST['title'];
            $description        = $_REQUEST['description'];
            $rederect_link      = $_REQUEST['rederect_link'];

            // flash_message(
            //     'add/slider',
            //     $this->input->post('sliderImg'),
            //     'unsuccess',
            //     'Something Went Wrong',
            //     'Look like Form Not Fill Properly, Please Fill & Try Again.'
            // );

            // $slider_exists = $this->SlidersModel->first([
            //     'title' => str_clean(
            //         $this->input->post('title'),
            //         [' ', '-', '_']
            //     )
            // ]);
            // is_null($slider_exists) or is_array($slider_exists) and $slider_exists = $slider_exists['title'];

            // flash_message(
            //     'add/slider',
            //     empty($slider_exists),
            //     'unsuccess',
            //     'Something Went Wrong',
            //     "Oops, Category Already Exists,<br>Please Try With Another Category Name."
            // );

            // $slug = str_clean($this->input->post('title'), ['-', '_']);
            // $slug_exists = $this->SlidersModel->first(['slug' => $slug]);
            // is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

            /* Upload Images */
            $form_images = upload(['uploads/slider' => 'sliderImg']);

            /* Check Document Image Uploaded */
            // flash_message(
            //     'add/slider',
            //     isset($form_images['sliderImg']),
            //     'unsuccess',
            //     'Something Went Wrong',
            //     "Please Upload Category Image & Try Again."
            // );

            isset($form_images['sliderImg']) and $slider_image = $form_images['sliderImg'][0] or $slider_image = "";

            $slider = $this->SlidersModel->save([
                'image'             => $slider_image,
                'created_by'        => $_SESSION['USER_ID'],
                'modified_by'       => $_SESSION['USER_ID'],
                'status'            => true,
                'title'             => $title,
                'description'       => $description,
                'redirect_link'     => $rederect_link
            ]);

            flash_message(
                'add/slider',
                $slider,
                'unsuccess',
                "Something Went Wrong"
            );

            flash_message(
                'list/sliders',
                $slider,
                'success',
                "Category Slider Successfully"
            );
        }

        $slides = json_decode(json_encode($this->SlidersModel->all([

            'conditions' => ['status' => true]
        ])));
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('slider/add', compact('slides'));
        $this->load->view('template/footer');
    }


    /** Add Category */
    public function edit_slider($id)
    {


        if ($this->input->post('editSlider')) {

            // flash_message(
            //     'edit/slider/' . $id,
            //     $this->input->post('title')c
            //         and $this->input->post('cat'),
            //     'unsuccess',
            //     'Something Went Wrong',
            //     'Look like Form Not Fill Properly, Please Fill & Try Again.'
            // );

            // $category_exists = $this->SlidersModel->first([
            //     'title' => str_clean(
            //         $this->input->post('title'),
            //         [' ', '-', '_']
            //     ),
            //     'slug !=' => $id
            // ]);
            // is_null($category_exists) or is_array($category_exists) and $category_exists = $category_exists['title'];

            // flash_message(
            //     'edit/category/' . $id,
            //     empty($category_exists),
            //     'unsuccess',
            //     'Something Went Wrong',
            //     "Oops, Category Already Exists,<br>Please Try With Another Category Name."
            // );

            // $slug = str_clean($this->input->post('title'), ['-', '_']);
            // $slug_exists = $this->SlidersModel->first(['slug' => $slug, 'id !=' => $category_exists['id']]);
            // is_null($slug_exists) or is_array($slug_exists) and $slug = increment_string($slug, '-', 1);

            /* Upload Images */
            $form_images = upload(['uploads/slider' => 'sliderImg']);

            isset($form_images['sliderImg']) and $slider_image = $form_images['sliderImg'][0] or $slider_image = $this->input->post('oldsliderImg');

            $slider = $this->SlidersModel->updateTable([
                'image'       => $slider_image,
                'modified_by' => $_SESSION['USER_ID'],
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'redirect_link' => $this->input->post('rederect_link'),
                'status'      => true,
            ], ['id' => $id]);

            flash_message(
                'edit/slider/' . $id,
                $slider,
                'unsuccess',
                "Something Went Wrong"
            );

            flash_message(
                'list/sliders',
                $slider,
                'success',
                "Slider Updated Successfully"
            );
        }

        $sliderData = '';
        $slider = $this->SlidersModel->first([
            'conditions' => [
                'id'     => $id,
                'status!=' => '3',
            ]
        ]);
        empty($slider) or is_array($slider) and $sliderData = json_decode(json_encode($slider));

        $slides = json_decode(json_encode($this->SlidersModel->all([
            'feilds' => ['id'],
            'conditions' => ['status' => true]
        ])));
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('slider/edit', compact('slides', 'sliderData'));
        $this->load->view('template/footer');
    }


    public function delete_slider($id)
    {

        $slider = $this->SlidersModel->updateTable([
            'status' => '3',
        ], ['id' => $id]);
        flash_message(
            'list/sliders',
            $slider,
            'unsuccess',
            "Something Went Wrong"
        );

        flash_message(
            'list/sliders',
            $slider,
            'success',
            "Slider Deleted Successfully"
        );
    }
}

    /* End of file  Product.php */
