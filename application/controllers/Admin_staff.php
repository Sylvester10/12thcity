<?php
defined('BASEPATH') or die('Direct access not allowed');


/* ===== Documentation ===== 
Name: Admin_staff
Role: Controller
Description: Controls access to staff pages and functions in admin panel
Models: Staff_model, Staff_model_ajax
Author: Sylvester Esso Nmakwe
Date Created: 25th July, 2023
*/



class Admin_staff extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->admin_restricted(); //allow only logged in users to access this class
        $this->load->model('staff_model');
        $this->admin_details = $this->common_model->get_admin_details($this->session->email);
    }



    public function index()
    {
        $inner_page_title = 'Staff (' . $this->staff_model->count_staff() . ')';
        $this->admin_header('Staff', $inner_page_title);
        $data['total_records'] = $this->staff_model->count_published_staff();
        $data['total_published'] = $this->staff_model->count_published_staff();
        $data['total_unpublished'] = $this->staff_model->count_unpublished_staff();
        $this->load->view('admin/staff/all_staff', $data);
        $this->admin_footer();
    }


    public function staff_ajax()
    {
        $this->load->model('ajax/staff/staff_model_ajax', 'current_model');
        $list = $this->current_model->get_records();
        $data = array();
        foreach ($list as $y) {
            $staff_img_src = base_url('assets/uploads/staff/' . $y->staff_photo);
            $staff_photo = user_avatar_table($y->staff_photo, $staff_img_src, user_avatar);

            // $socials = '';

            // if (!empty($y->facebook)) {
            //     $socials .= '<i class="fa-brands fa-facebook"></i> ' . $y->facebook . '<br />';
            // }
            // if (!empty($y->twitter)) {
            //     $socials .= '<i class="fa-brands fa-twitter"></i> ' . $y->twitter . '<br />';
            // }
            // if (!empty($y->instagram)) {
            //     $socials .= '<i class="fa-brands fa-instagram"></i> ' . $y->instagram . '<br />';
            // }
            // if (!empty($y->linkedin)) {
            //     $socials .= '<i class="fa-brands fa-linkedin"></i> ' . $y->linkedin . '<br />';
            // }

            $status = ($y->published == 0) ? '<span class="text-danger"><b>Inactive</b></span>' : '<span class="text-success"><b>Active</b></span>';

            $row = array();
            $row[] = checkbox_bulk_action($y->id);
            $row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
            $row[] = $staff_photo;
            $row[] = $y->name;
            $row[] = $y->sex;
            $row[] = $y->email;
            $row[] = ucfirst($y->email);
            $row[] = $y->order_number;
            // $row[] = $y->designation;
            // $row[] = $socials;
            // $row[] = x_date($y->dob);
            $row[] = $status;
            // $row[] = x_date($y->date_joined);
            $row[] = x_date($y->date_added);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->current_model->count_all_records(),
            "recordsFiltered" => $this->current_model->count_filtered_records(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function add_staff($error = array('error' => ''))
    {
        $this->admin_header('Admin', 'Add Staff');
        $this->load->view('admin//staff/add_staff', $error);
        $this->admin_footer();
    }


    public function add_staff_ajax()
    {
        // Validation rules 
        $rules = [
            ['field' => 'order_number', 'label' => 'Order Number', 'rules' => 'trim|required'],
            ['field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'],
            ['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'],
            // [
            //     'field' => 'phone',
            //     'label' => 'Mobile Number',
            //     'rules' => 'trim|required|is_natural',
            //     'errors' => ['is_natural' => 'Please enter numbers only for Mobile Number']
            // ],
            // ['field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|required'],
            // ['field' => 'date_joined', 'label' => 'Date Joined', 'rules' => 'trim|required'],
            ['field' => 'sex', 'label' => 'Sex', 'rules' => 'trim|required'],
            // ['field' => 'address', 'label' => 'Residential Address', 'rules' => 'trim|required'],
            ['field' => 'designation', 'label' => 'Designation', 'rules' => 'trim|required'],
            // ['field' => 'facebook', 'label' => 'Facebook Handle', 'rules' => 'trim|valid_url'],
            // ['field' => 'twitter', 'label' => 'Twitter Handle', 'rules' => 'trim|valid_url'],
            // ['field' => 'instagram', 'label' => 'Instagram Handle', 'rules' => 'trim|valid_url'],
            // ['field' => 'linkedin', 'label' => 'LinkedIn Handle', 'rules' => 'trim|valid_url'],

        ];
        $this->form_validation->set_rules($rules);

        // Custom callback rule for the featured image
        if (empty($_FILES['staff_photo']['name'])) {
            $this->form_validation->set_rules('staff_photo', 'Staff Photo', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->add_staff();
            return;
        }

        //  You can also override any other setting here, like max_size.
        $upload_path = [
            'upload_path' => './assets/uploads/staff/'
        ];

        $upload_errors = [];
        $staff_photo = '';

        // 2. Upload Featured Image using the helper
        $staff_image_result = upload_single_image('staff_photo', $upload_path);
        if ($staff_image_result['status']) {
            $staff_photo = $staff_image_result['filename'];
        } else {
            $upload_errors[] = '<p>Staff Photo Error: ' . $staff_image_result['error'] . '</p>';
        }

        // Check for any upload errors
        if (!empty($upload_errors)) {
            // Implode all collected error messages for display
            $this->session->set_flashdata('status_msg_error', implode('', $upload_errors));
            $this->add_staff();
            return;
        }

        // On success, call the model and redirect
        $this->staff_model->add_staff_to_db($staff_photo);
        $this->session->set_flashdata('status_msg', 'Staff added and published successfully.');
        redirect('admin-staff');
    }


    public function update_staff($id)
    {
        // Check if the staff exists
        $this->check_data_exists($id, 'id', 'staff', 'admin');
        $staff_details = $this->staff_model->get_staff_details($id);
        $data['page_title'] = 'Edit staff: ' . $staff_details->name;
        $data['staff_details'] = $staff_details;
        $this->admin_header('Admin', $data['page_title']);
        $this->load->view('admin/staff/update_staff', $data);
        $this->admin_footer();
    }


    public function update_staff_ajax($id)
    {
        // Fetch existing staff data first. We need this to get old filenames.
        $old_staff_data = $this->staff_model->get_staff_details($id);
        if (!$old_staff_data) {
            $this->session->set_flashdata('status_msg_error', 'Staff not found.');
            redirect('admin-staff');
            return;
        }

        // Validation rules (files are NOT required for an edit)
        $rules = [
            ['field' => 'order_number', 'label' => 'Order Number', 'rules' => 'trim|required'],
            ['field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'],
            ['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'],
            // [
            //     'field' => 'phone',
            //     'label' => 'Mobile Number',
            //     'rules' => 'trim|required|is_natural',
            //     'errors' => ['is_natural' => 'Please enter numbers only for Mobile Number']
            // ],
            // ['field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|required'],
            // ['field' => 'date_joined', 'label' => 'Date Joined', 'rules' => 'trim|required'],
            ['field' => 'sex', 'label' => 'Sex', 'rules' => 'trim|required'],
            // ['field' => 'address', 'label' => 'Residential Address', 'rules' => 'trim|required'],
            ['field' => 'designation', 'label' => 'Designation', 'rules' => 'trim|required'],
            // ['field' => 'facebook', 'label' => 'Facebook Handle', 'rules' => 'trim|valid_url'],
            // ['field' => 'twitter', 'label' => 'Twitter Handle', 'rules' => 'trim|valid_url'],
            // ['field' => 'instagram', 'label' => 'Instagram Handle', 'rules' => 'trim|valid_url'],
            // ['field' => 'linkedin', 'label' => 'LinkedIn Handle', 'rules' => 'trim|valid_url'],

        ];
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $this->update_staff($id); // Reload form with validation errors
            return;
        }

        // If no new image is uploaded, these values will be preserved.
        $staff_photo = $old_staff_data->staff_photo;
        $upload_errors = '';

        // Upload config
        $config = [
            'upload_path'      => './assets/uploads/staff/',
            'allowed_types'    => 'jpg|jpeg|png',
            'max_size'         => 5024,
            'encrypt_name'     => TRUE,
        ];
        $this->load->library('upload', $config);

        // Handle NEW featured image upload
        if (!empty($_FILES['staff_photo']['name'])) {
            if ($this->upload->do_upload('staff_photo')) {
                // Delete the old image file
                if (!empty($old_staff_data->staff_photo) && file_exists($config['upload_path'] . $old_staff_data->staff_photo)) {
                    unlink($config['upload_path'] . $old_staff_data->staff_photo);
                }
                // Set the new image name
                $staff_photo = $this->upload->data('file_name');
            } else {
                $upload_errors .= '<p>Staff Photo Error: ' . $this->upload->display_errors('', '') . '</p>';
            }
        }

        // Check for upload errors before proceeding
        if (!empty($upload_errors)) {
            $this->session->set_flashdata('status_msg_error', $upload_errors);
            $this->update_staff($id);
            return;
        }

        // 7. On success, call the model to UPDATE the DB and redirect
        $this->staff_model->update_staff_in_db($id, $staff_photo);
        $this->session->set_flashdata('status_msg', 'Staff updated successfully.');
        redirect('admin-staff');
    }


    public function publish_staff($id)
    {
        //check staff exists
        $this->check_data_exists($id, 'id', 'staff', 'admin');
        $this->staff_model->publish_staff($id);
        $this->session->set_flashdata('status_msg', 'Staff published successfully.');
        redirect($this->agent->referrer());
    }


    public function unpublish_staff($id)
    {
        //check staff exists
        $this->check_data_exists($id, 'id', 'staff', 'admin');
        $this->staff_model->unpublish_staff($id);
        $this->session->set_flashdata('status_msg', 'Staff unpublished successfully.');
        redirect($this->agent->referrer());
    }


    public function delete_staff($id)
    {
        //check staff exists
        $this->check_data_exists($id, 'id', 'staff', 'admin');
        $this->staff_model->delete_staff($id);
        $this->session->set_flashdata('status_msg', 'Staff deleted successfully.');
        redirect($this->agent->referrer());
    }


    public function clear_staff()
    {
        $this->staff_model->clear_staff();
        $this->session->set_flashdata('status_msg', 'All Staff cleared successfully.');
        redirect($this->agent->referrer());
    }


    public function bulk_actions_staff()
    {
        $this->form_validation->set_rules('check_bulk_action', 'Bulk Select', 'trim');
        $selected_rows = $this->input->post('check_bulk_action', TRUE);

        // Check if selected_rows is an array before counting
        if (is_array($selected_rows)) {
            $selected_rows_count = count($selected_rows);
        } else {
            $selected_rows_count = 0;
        }

        if ($this->form_validation->run()) {
            if ($selected_rows_count > 0) {
                $this->staff_model->bulk_actions_staff($selected_rows);
            } else {
                $this->session->set_flashdata('status_msg_error', 'No item selected.');
            }
        } else {
            $this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
        }
        redirect($this->agent->referrer());
    }
}
