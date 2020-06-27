<?php defined('BASEPATH') or exit('No direct script access allowed');

class TestimonialsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->database();
        $this->tableName = 'testimonials';
    }
}

/* End of file TestimonialsModel.php */
