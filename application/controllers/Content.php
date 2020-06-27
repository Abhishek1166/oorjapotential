<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Category Pages & Queries */
class Content extends CI_Controller
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
        $this->load->model([
            'CategoriesModel',
            'UsersModel',
            'ProductsModel',
            'CourseContentModel',
            'ContentModel'
        ]);
    }


    /** Load Default Index To Show 404 Error
     *
     * @return void */
    public function index()
    {
        return show_404();
    }


    /** Add Category */
    public function add_content()
    {

        //die;
        flash_message(
            'dashboard/login',
            is_login(),
            'unsuccess',
            'Please Login Then Try Again'
        );

        // user_can('content_add') or show_404();

        if ($this->input->post('addContent')) {

            flash_message(
                'add/content',
                $this->input->post('title')
                    and $this->input->post('course_id'),
                $this->input->post('yt_url'),

                'unsuccess',
                'Something Went Wrong',
                'Look like Form Not Fill Properly, Please Fill & Try Again.'
            );


            /* Upload Images */
            $form_images = upload(['uploads/content' => 'dp_image']);

            isset($form_images['dp_image']) and $dp_image = $form_images['dp_image'][0] or $dp_image = "";

            $content = $this->ContentModel->save([
                'title'         => $this->input->post('title'),
                'course_id'     => $this->input->post('course_id'),
                'yt_url'        => $this->input->post('yt_url'),
                'dp_image'      => $dp_image,
                'created_on'    => $_SESSION['USER_ID'],
                'status'        => true,
            ]);


            $content = $this->CourseContentModel->save([
                'content_id'    => $content,
                'course_id'     => $this->input->post('course_id'),

            ]);

            flash_message(
                'add/content',
                $content,
                'unsuccess',
                "Something Went Wrong"
            );

            flash_message(
                'list/content',
                $content,
                'success',
                "Category Created Successfully"
            );
        }
        /* to get product name */

        $product = json_decode(json_encode($this->ProductsModel->all([
            'feilds' => ['id', 'title'],
            'conditions' => [
                'status!=' => 3,
                'post_type' => 'product'
            ]
        ])));
        // echo $this->db->last_query();
        // die();


        /* to get product name  end */

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('content/add', compact('product'));
        $this->load->view('template/footer');
    }


    /** Load Category List Page */
    public function list_content()
    {
        flash_message(
            'dashboard/login',
            is_login(),
            'unsuccess',
            'Please Login Then Try Again'
        );

        //user_can('content_list') or show_404();
        $contentData = json_decode(json_encode([
            'type' => 'content'
        ]));

        $content = $this->ContentModel->all([
            'conditions' => [
                'status!=' => '3',
            ],
            'order' => [
                'by' => 'id',
                'type' => 'DESC'
            ]



        ]);

        empty($content) or is_array($content) and $contentData = json_decode(json_encode([
            'type' => 'content',
            'data' => $content
        ]));
        // echo $this->db->last_query();
        // die();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('content/list', compact('contentData'));
        $this->load->view('template/footer');
    }
}

    /* End of file Category.php */
