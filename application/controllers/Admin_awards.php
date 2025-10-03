<?php
defined('BASEPATH') or die('Direct access not allowed');


/* ===== Documentation ===== 
Name: Admin_awards
Role: Controller
Description: Controls access to awards pages and functions in admin panel
Models: Awards_model, Awards_model_ajax
Author: Sylvester Esso Nmakwe
Date Created: 25th July, 2023
*/



class Admin_awards extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->admin_restricted(); //allow only logged in users to access this class
        $this->load->model('awards_model');
        $this->admin_details = $this->common_model->get_admin_details($this->session->email);
    }



    public function index()
    {
        $inner_page_title = 'Awards (' . $this->awards_model->count_awards() . ')';
        $this->admin_header('Awards', $inner_page_title);
        $data['total_records'] = $this->awards_model->count_published_awards();
        $data['total_published'] = $this->awards_model->count_published_awards();
        $data['total_unpublished'] = $this->awards_model->count_unpublished_awards();
        $this->load->view('admin/awards/all_awards', $data);
        $this->admin_footer();
    }


    public function awards_ajax()
    {
        $this->load->model('ajax/awards/awards_model_ajax', 'current_model');
        $list = $this->current_model->get_records();
        $data = array();
        foreach ($list as $y) {
            $award_img_src = base_url('assets/uploads/awards/' . $y->award_photo);
            $awards_photo = user_avatar_table($y->award_photo, $award_img_src, user_avatar);

            $status = ($y->published == 0) ? '<span class="text-danger"><b>Inactive</b></span>' : '<span class="text-success"><b>Active</b></span>';

            $row = array();
            $row[] = checkbox_bulk_action($y->id);
            $row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
            $row[] = $awards_photo;
            $row[] = $y->title;
            $row[] = $y->description;
            $row[] = $status;
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


    public function add_award($error = array('error' => ''))
    {
        $this->admin_header('Admin', 'Add awards');
        $this->load->view('admin//awards/add_award', $error);
        $this->admin_footer();
    }


    public function add_award_ajax()
    {
        // Validation rules 
        $rules = [
            ['field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'],
            ['field' => 'description', 'label' => 'Designation', 'rules' => 'trim|required'],

        ];
        $this->form_validation->set_rules($rules);

        // Custom callback rule for the featured image
        if (empty($_FILES['awards_photo']['name'])) {
            $this->form_validation->set_rules('awards_photo', 'Awards Photo', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->add_award();
            return;
        }

        //  You can also override any other setting here, like max_size.
        $upload_path = [
            'upload_path' => './assets/uploads/awards/'
        ];

        $upload_errors = [];
        $awards_photo = '';

        // 2. Upload Featured Image using the helper
        $awards_image_result = upload_single_image('awards_photo', $upload_path);
        if ($awards_image_result['status']) {
            $awards_photo = $awards_image_result['filename'];
        } else {
            $upload_errors[] = '<p>Awards Photo Error: ' . $awards_image_result['error'] . '</p>';
        }

        // Check for any upload errors
        if (!empty($upload_errors)) {
            // Implode all collected error messages for display
            $this->session->set_flashdata('status_msg_error', implode('', $upload_errors));
            $this->add_award();
            return;
        }

        // On success, call the model and redirect
        $this->awards_model->add_award_to_db($awards_photo);
        $this->session->set_flashdata('status_msg', 'Award added and published successfully.');
        redirect('admin-awards');
    }


    public function update_award($id)
    {
        // Check if the awards exists
        $this->check_data_exists($id, 'id', 'awards', 'admin');
        $awards_details = $this->awards_model->get_award_details($id);
        $data['page_title'] = 'Edit awards: ' . $awards_details->title;
        $data['awards_details'] = $awards_details;
        $this->admin_header('Admin', $data['page_title']);
        $this->load->view('admin/awards/update_award', $data);
        $this->admin_footer();
    }


    public function update_award_ajax($id)
    {
        // Fetch existing awards data first. We need this to get old filenames.
        $old_award_data = $this->awards_model->get_award_details($id);
        if (!$old_award_data) {
            $this->session->set_flashdata('status_msg_error', 'Awards not found.');
            redirect('admin-awards');
            return;
        }

        // Validation rules (files are NOT required for an edit)
        $rules = [
            ['field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'],
            ['field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'],

        ];
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $this->update_award($id); // Reload form with validation errors
            return;
        }

        // If no new image is uploaded, these values will be preserved.
        $awards_photo = $old_award_data->awards_photo;
        $upload_errors = '';

        // Upload config
        $config = [
            'upload_path'      => './assets/uploads/awards/',
            'allowed_types'    => 'jpg|jpeg|png',
            'max_size'         => 5024,
            'encrypt_name'     => TRUE,
        ];
        $this->load->library('upload', $config);

        // Handle NEW featured image upload
        if (!empty($_FILES['awards_photo']['name'])) {
            if ($this->upload->do_upload('awards_photo')) {
                // Delete the old image file
                if (!empty($old_award_data->awards_photo) && file_exists($config['upload_path'] . $old_award_data->awards_photo)) {
                    unlink($config['upload_path'] . $old_award_data->awards_photo);
                }
                // Set the new image name
                $awards_photo = $this->upload->data('file_name');
            } else {
                $upload_errors .= '<p>Awards Photo Error: ' . $this->upload->display_errors('', '') . '</p>';
            }
        }

        // Check for upload errors before proceeding
        if (!empty($upload_errors)) {
            $this->session->set_flashdata('status_msg_error', $upload_errors);
            $this->update_award($id);
            return;
        }

        // 7. On success, call the model to UPDATE the DB and redirect
        $this->awards_model->update_award_in_db($id, $awards_photo);
        $this->session->set_flashdata('status_msg', 'Award updated successfully.');
        redirect('admin-awards');
    }


    public function publish_award($id)
    {
        //check awards exists
        $this->check_data_exists($id, 'id', 'awards', 'admin');
        $this->awards_model->publish_award($id);
        $this->session->set_flashdata('status_msg', 'Awards published successfully.');
        redirect($this->agent->referrer());
    }


    public function unpublish_award($id)
    {
        //check awards exists
        $this->check_data_exists($id, 'id', 'awards', 'admin');
        $this->awards_model->unpublish_award($id);
        $this->session->set_flashdata('status_msg', 'Awards unpublished successfully.');
        redirect($this->agent->referrer());
    }


    public function delete_award($id)
    {
        //check awards exists
        $this->check_data_exists($id, 'id', 'awards', 'admin');
        $this->awards_model->delete_award($id);
        $this->session->set_flashdata('status_msg', 'Awards deleted successfully.');
        redirect($this->agent->referrer());
    }


    public function clear_awards()
    {
        $this->awards_model->clear_award();
        $this->session->set_flashdata('status_msg', 'All awards cleared successfully.');
        redirect($this->agent->referrer());
    }


    public function bulk_actions_awards()
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
                $this->awards_model->bulk_actions_awards($selected_rows);
            } else {
                $this->session->set_flashdata('status_msg_error', 'No item selected.');
            }
        } else {
            $this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
        }
        redirect($this->agent->referrer());
    }
}
