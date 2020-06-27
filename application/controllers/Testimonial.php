<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Category Pages & Queries */
class Testimonial extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        flash_message(
            'dashboard/login',
            is_login(),
            'unsuccess',
            'Please Login Then Try Again'
        );
        //Do your magic here
        $this->load->model(['TestimonialsModel', 'UsersModel']);
    }


    /** Load Default Index To Show 404 Error
     *
     * @return void */
    public function index()
    {
        return show_404();
    }


    /** Load Category List Page */
    public function list_testimonial()
    {

        flash_message(
            'dashboard/login',
            is_login(),
            'unsuccess',
            'Please Login Then Try Again'
        );

        user_can('testimonial_list') or show_404();

        $testimonialData = json_decode(json_encode([
            'type' => 'Testimonials'
        ]));
        $testimonial = $this->TestimonialsModel->all([
            'conditions' => [
                'status!=' => '3',
            ],
            'order' => [
                'by' => 'id',
                'type' => 'DESC'
            ]
        ]);

        if (!empty($testimonial)) foreach ($testimonial as $key => $val) {

            $user = $this->UsersModel->first($val['created_by']);

            empty($user) and $testimonial[$key]['created_by'] = '' or $testimonial[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
        }

        empty($testimonial) or is_array($testimonial) and $testimonialData = json_decode(json_encode([
            'type' => 'Testimonials',
            'data' => $testimonial
        ]));
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('testimonial/list', compact('testimonialData'));
        $this->load->view('template/footer');
    }


    /** Add Category */
    public function add_testimonial()
    {
        flash_message(
            'dashboard/login',
            is_login(),
            'unsuccess',
            'Please Login Then Try Again'
        );

        user_can('testimonial_add') or show_404();

        if ($this->input->post('addtestimonial')) {

            flash_message(
                'add/testimonial',
                $this->input->post('addtestimonial')
                    and $this->input->post('name')
                    and $this->input->post('rating')
                    and $this->input->post('comment'),
                'unsuccess',
                'Something Went Wrong',
                'Look like Form Not Fill Properly, Please Fill & Try Again.'
            );

            $form_images = upload(['uploads/testimonial' => 'testimonialImg']);

            /* Check Document Image Uploaded */
            flash_message(
                'add/testimonial',
                isset($form_images['testimonialImg']),
                'unsuccess',
                'Something Went Wrong',
                "Please Upload  Image & Try Again."
            );

            isset($form_images['testimonialImg']) and $testimonial_image = $form_images['testimonialImg'][0] or $testimonial_image = "";

            $testimonial = $this->TestimonialsModel->save([
                'image'                 => $testimonial_image,
                'created_by'            => $_SESSION['USER_ID'],
                'modified_by'           => $_SESSION['USER_ID'],
                'status'                => true,
                'name'                  => $this->input->post('name'),
                'comment'               => $this->input->post('comment'),
                'rating'                => $this->input->post('rating')
            ]);

            flash_message(
                'add/testimonial',
                $testimonial,
                'unsuccess',
                "Something Went Wrong"
            );

            flash_message(
                'list/testimonials',
                $testimonial,
                'success',
                "Testimonial Successfully Created"
            );
        }

        $slides = json_decode(json_encode($this->TestimonialsModel->all([

            'conditions' => ['status' => true]
        ])));
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('testimonial/add', compact('slides'));
        $this->load->view('template/footer');
    }


    /** Add Category */
    public function edit_testimonial($id)
    {
        flash_message(
            'dashboard/login',
            is_login(),
            'unsuccess',
            'Please Login Then Try Again'
        );

        user_can('testimonial_edit') or show_404();


        if ($this->input->post('edittestimonial')) {

            flash_message(
                'edit/testimonial/' . $id,
                $this->input->post('edittestimonial')
                    and $this->input->post('name')
                    and $this->input->post('rating')
                    and $this->input->post('comment'),
                'unsuccess',
                'Something Went Wrong',
                'Look like Form Not Fill Properly, Please Fill & Try Again.'
            );

            $form_images = upload(['uploads/testimonial' => 'testimonialImg']);


            isset($form_images['testimonialImg']) and $testimonial_image = $form_images['testimonialImg'][0] or $testimonial_image = $this->input->post('oldtestimonialImg');

            $testimonial = $this->TestimonialsModel->updateTable([
                'image'                 => $testimonial_image,
                'modified_by'           => $_SESSION['USER_ID'],
                'name'                  => $this->input->post('name'),
                'comment'               => $this->input->post('comment'),
                'rating'                => $this->input->post('rating'),
                'status'                => true,
            ], ['id' => $id]);

            flash_message(
                'edit/testimonial//.$id' . $id,
                $testimonial,
                'unsuccess',
                "Something Went Wrong"
            );

            flash_message(
                'list/testimonials',
                $testimonial,
                'success',
                "Testimonial Updated Successfully"
            );
        }

        $testimonialData = '';
        $testimonial = $this->TestimonialsModel->first([
            'conditions' => [
                'id'     => $id,
                'status!=' => '3',
            ]
        ]);
        empty($testimonial) or is_array($testimonial) and $testimonialData = json_decode(json_encode($testimonial));

        $slides = json_decode(json_encode($this->TestimonialsModel->all([
            'feilds' => ['id'],
            'conditions' => ['status' => true]
        ])));
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('testimonial/edit', compact('slides', 'testimonialData'));
        $this->load->view('template/footer');
    }


    public function delete_testimonial($id)
    {
        flash_message(
            'dashboard/login',
            is_login(),
            'unsuccess',
            'Please Login Then Try Again'
        );

        user_can('filter_add') or show_404();

        $testimonial = $this->TestimonialsModel->updateTable([
            'status' => '3',
        ], ['id' => $id]);
        flash_message(
            'list/testimonials',
            $testimonial,
            'unsuccess',
            "Something Went Wrong"
        );

        flash_message(
            'list/testimonials',
            $testimonial,
            'success',
            "testimonial Deleted Successfully"
        );
    }
}

    /* End of file  Product.php */
