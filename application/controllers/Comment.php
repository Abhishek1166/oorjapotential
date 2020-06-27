<?php defined('BASEPATH') or exit('No direct script access allowed');
/** Load Category Pages & Queries */
class Comment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model(['CommentModel', 'UsersModel', 'PostsModel']);
    }


    /** Load Default Index To Show 404 Error
     *
     * @return void */
    public function index()
    {
        return show_404();
    }


    /** Load Category List Page */
    public function list_comment()
    {
        $commentData = json_decode(json_encode([
            'type' => 'comments'
        ]));
        $comment = $this->CommentModel->all([
            'conditions' => [
                'status!=' => '3',
            ],
            'order' => [
                'by' => 'id',
                'type' => 'DESC'
            ]
        ]);

        // if (!empty($comment)) foreach ($comment as $key => $val) {

        //     $user = $this->UsersModel->first($val['created_by']);

        //     empty($user) and $comment[$key]['created_by'] = '' or $comment[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);


        //     if (!empty($val['category_id'])) {
        //         $user = $this->UsersModel->first($val['created_by']);
        //         $cats = $this->CategoriesModel->first($val['category_id']);

        //         empty($user) and $comment[$key]['created_by'] = '' or $comment[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
        //         empty($cats) and $comment[$key]['category_id'] = 'Self' or $comment[$key]['category_id'] = ucwords($cats['title']);
        //     } else {
        //         $user = $this->UsersModel->first($val['created_by']);

        //         empty($user) and $comment[$key]['created_by'] = '' or $comment[$key]['created_by'] =  ucwords($user['first_name'] . ' ' . $user['last_name']);
        //         $comment[$key]['category_id'] = 'Self';
        //     }
        // }

        empty($comment) or is_array($comment) and $commentData = json_decode(json_encode([
            'type' => 'comments',
            'data' => $comment
        ]));


        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('comment/list', compact('commentData'));
        $this->load->view('template/footer');
    }


    /** Add Category */
    public function add_comment()
    {
        if ($this->input->post('addcomment')) {

            //die(var_dump(@is($_POST['postCheck'])));

            $title          = $this->input->post('title');
            $user_id        = $this->input->post('user_id');
            $post_id        = $this->input->post('post_id');
            $description    = $this->input->post('description');


            flash_message(
                'add/comment',
                $title
                    and $user_id
                    and $post_id
                    and $description,
                'unsuccess',
                'Something Went Wrong',
                'Look like Form Not Fill Properly, Please Fill & Try Again.'
            );

            $comment = $this->CommentModel->save([
                'created_by'                => $_SESSION['USER_ID'],
                'modified_by'               => $_SESSION['USER_ID'],
                'status'                    => true,
                'title'                     => $title,
                'description'               => $description,
                'user_id'                   => $user_id,
                'post_id'                   => $post_id,
            ]);
            // echo $this->db->last_query();
            // die;

            flash_message(
                'add/comment',
                $comment,
                'unsuccess',
                "Something Went Wrong"
            );

            flash_message(
                'list/comments',
                $comment,
                'success',
                "Comment Successfully Created"
            );
        }

        $users = json_decode(json_encode($this->UsersModel->all([
            'conditions' => ['status!=' => '3'],
            'fields' => ['id', 'first_name', 'last_name']
        ])));
        $blogTitle = json_decode(json_encode($this->PostsModel->all([
            'conditions' => ['status!=' => '3'],
            'fields' => ['id', 'title']
        ])));

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('comment/add', compact('users', 'blogTitle'));
        $this->load->view('template/footer');
    }


    /** Add Category */
    public function edit_comment($id = null)
    {
        if ($this->input->post('editcomment')) {

            $title          = $this->input->post('title');
            $user_id        = $this->input->post('user_id');
            $post_id        = $this->input->post('post_id');
            $description    = $this->input->post('description');

            flash_message(
                'edit/comment',
                $title
                    and $user_id
                    and $post_id
                    and $description,
                'unsuccess',
                'Something Went Wrong',
                'Look like Form Not Fill Properly, Please Fill & Try Again.'
            );



            /* Upload Images */


            $blog = $this->CommentModel->updateTable([
                'created_by'                => $_SESSION['USER_ID'],
                'modified_by'               => $_SESSION['USER_ID'],
                'status'                    => true,
                'title'                     => $title,
                'description'               => $description,
                'user_id'                   => $user_id,
                'post_id'                   => $post_id,
            ], ['id' => $id]);

            flash_message(
                'edit/comment/' . $id,
                $blog,
                'unsuccess',
                "Something Went Wrong"
            );

            flash_message(
                'list/comments',
                $blog,
                'success',
                "Comment Updated Successfully"
            );
        }

        $commentData = '';
        $comment = $this->CommentModel->first([
            'conditions' => [
                'id'     => $id,
                'status!=' => '3',
            ]
        ]);

        // die(var_dump($comment));
        empty($comment) or is_array($comment) and $commentData = json_decode(json_encode($comment));

        $users = json_decode(json_encode($this->UsersModel->all([
            'conditions' => ['status!=' => '3'],
            'fields' => ['id', 'first_name', 'last_name']
        ])));
        $blogTitle = json_decode(json_encode($this->CommentModel->all([
            'conditions' => ['status!=' => '3'],
            'fields' => ['id', 'title']
        ])));

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('comment/edit', compact('users', 'blogTitle', 'commentData'));
        $this->load->view('template/footer');
    }


    public function delete_comment($id)
    {

        $comment = $this->CommentModel->updateTable([
            'status' => '3',
        ], ['id' => $id]);
        flash_message(
            'list/comments',
            $comment,
            'unsuccess',
            "Something Went Wrong"
        );

        flash_message(
            'list/comments',
            $comment,
            'success',
            "Comment Deleted Successfully"
        );
    }
}

    /* End of file  Product.php */
