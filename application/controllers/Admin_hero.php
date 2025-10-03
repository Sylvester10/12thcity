<?php
defined('BASEPATH') or die('Direct access not allowed');

/* ===== Documentation ===== 
Name: Admin_hero
Role: Controller
Description: Controls access to hero pages and functions in admin panel
Models: hero_model
Author: Sylvester Esso Nmakwe
Date Created: 25th July, 2023
*/

class Admin_hero extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->admin_restricted(); //allow only logged in users to access this class
        $this->load->model('hero_model');
        $this->admin_details = $this->common_model->get_admin_details($this->session->email);
    }

    public function index()
    {
        $inner_page_title = 'Hero';
        $this->admin_header('Admin - ', $inner_page_title);
        $this->load->view('admin/hero/add_hero');
        $this->admin_footer();
    }

    public function add_hero_ajax()
    {
        // validate file inputs
        if (empty($_FILES['first_image']['name'])) {
            $this->form_validation->set_rules('first_image', 'Hero Image One', 'required');
        }

        if (empty($_FILES['second_image']['name'])) {
            $this->form_validation->set_rules('second_image', 'Hero Image Two', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('status_msg_error', validation_errors());
            redirect($this->agent->referrer());
            return;
        }

        $upload_path = [
            'upload_path' => './assets/uploads/hero/'
        ];

        $upload_errors = [];
        $first_hero_image = '';
        $second_hero_image = '';

        // Upload Hero Image 1
        $first_result = upload_single_image('first_image', $upload_path);
        if ($first_result['status']) {
            $first_hero_image = $first_result['filename'];
        } else {
            $upload_errors[] = '<p>First Image Error: ' . $first_result['error'] . '</p>';
        }

        // Upload Hero Image 2
        $second_result = upload_single_image('second_image', $upload_path);
        if ($second_result['status']) {
            $second_hero_image = $second_result['filename'];
        } else {
            $upload_errors[] = '<p>Second Image Error: ' . $second_result['error'] . '</p>';
        }

        // Check for upload errors
        if (!empty($upload_errors)) {
            $this->session->set_flashdata('status_msg_error', implode('', $upload_errors));
            redirect($this->agent->referrer());
            return;
        }

        // Save to DB
        $this->hero_model->add_hero_to_db($first_hero_image, $second_hero_image);
        $this->session->set_flashdata('status_msg', 'Hero added and published successfully.');
        redirect($this->agent->referrer());
    }
}
