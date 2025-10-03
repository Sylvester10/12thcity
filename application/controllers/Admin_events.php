<?php
defined('BASEPATH') or die('Direct access not allowed');


/* ===== Documentation ===== 
Name: Admin_events
Role: Controller
Description: Controls access to events pages and functions in admin panel
Models: Events_model, Events_model_ajax
Author: Sylvester Esso Nmakwe
Date Created: 25th July, 2023
*/



class Admin_events extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->admin_restricted(); //allow only logged in users to access this class
        $this->load->model('events_model');
        $this->admin_details = $this->common_model->get_admin_details($this->session->email);
    }



    public function index()
    {
        $inner_page_title = 'Events (' . $this->events_model->count_published_events() . ')';
        $this->admin_header('Events', $inner_page_title);
        $data['total_records'] = $this->events_model->count_published_events();
        $data['total_published'] = $this->events_model->count_published_events();
        $data['total_unpublished'] = $this->events_model->count_unpublished_events();
        $this->load->view('admin/events/upcoming_events', $data);
        $this->admin_footer();
    }


    public function events_ajax()
    {
        $this->load->model('ajax/events/events_model_ajax', 'current_model');
        $list = $this->current_model->get_records();
        $data = array();
        foreach ($list as $y) {
            $feature_img_src = base_url('assets/uploads/events/' . $y->event_image);
            $event_image = user_avatar_table($y->event_image, $feature_img_src, user_avatar);

            $published = ($y->published == 0) ? '<span class="text-danger"><b>Unpublished</b></span>' : '<span class="text-success"><b>Published</b></span>';

            $event_date = ($y->date == null) ? '' : x_date_full($y->date);

            $row = array();
            $row[] = checkbox_bulk_action($y->id);
            $row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
            $row[] = $event_image;
            $row[] = ucfirst($y->type);
            $row[] = $y->caption;
            $row[] = $event_date;
            $row[] = $y->venue;
            $row[] = $y->views;
            $row[] = $published;
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


    public function add_event($error = array('error' => ''))
    {
        $this->admin_header('Admin', 'Add Event');
        $this->load->view('admin//events/add_event', $error);
        $this->admin_footer();
    }


    public function add_event_ajax()
    {
        // 1. Validation rules remain the same
        $rules = [
            ['field' => 'type', 'label' => 'Type', 'rules' => 'trim|required'],
            ['field' => 'caption', 'label' => 'Caption', 'rules' => 'trim|required'],
            ['field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'],
            ['field' => 'date', 'label' => 'Event Date', 'rules' => 'trim'],
            ['field' => 'venue', 'label' => 'Venue', 'rules' => 'trim'],
        ];
        $this->form_validation->set_rules($rules);

        // Custom callback rule for the featured image
        if (empty($_FILES['event_image']['name'])) {
            $this->form_validation->set_rules('event_image', 'Event Feature Image', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->add_event();
            return;
        }

        //    You can also override any other setting here, like max_size.
        // $custom_config = [
        //     'upload_path' => './assets/uploads/special_events/'
        // ];

        $upload_errors = [];
        $event_image_name = '';
        $other_images_names = [];

        // 2. Upload Featured Image using the helper
        $featured_image_result = upload_single_image('event_image');
        if ($featured_image_result['status']) {
            $event_image_name = $featured_image_result['filename'];
        } else {
            $upload_errors[] = '<p>Featured Image Error: ' . $featured_image_result['error'] . '</p>';
        }

        // 3. Upload Other Images using the helper
        $other_images_result = upload_multiple_images('other_images');
        if (!empty($other_images_result['errors'])) {
            // array_merge combines the errors from both uploads
            $upload_errors = array_merge($upload_errors, $other_images_result['errors']);
        }
        $other_images_names = $other_images_result['uploaded_files'];


        // 4. Check for any upload errors
        if (!empty($upload_errors)) {
            // Implode all collected error messages for display
            $this->session->set_flashdata('status_msg_error', implode('', $upload_errors));
            $this->add_event();
            return;
        }

        // 5. On success, call the model and redirect
        $this->events_model->add_event_to_db($event_image_name, implode(',', $other_images_names));
        $this->session->set_flashdata('status_msg', 'Event added and published successfully.');
        redirect('admin-events');
    }


    public function update_event($id)
    {
        // Check if the event exists
        $this->check_data_exists($id, 'id', 'events', 'admin');
        $event_details = $this->events_model->get_event_details($id);
        $data['page_title'] = 'Edit Event: ' . $event_details->caption;
        $data['event_details'] = $event_details;
        $this->admin_header('Admin', $data['page_title']);
        $this->load->view('admin/events/update_event', $data);
        $this->admin_footer();
    }


    public function update_event_ajax($id)
    {
        // Fetch existing event data first. We need this to get old filenames.
        $old_event_data = $this->events_model->get_event_details($id);
        if (!$old_event_data) {
            $this->session->set_flashdata('status_msg_error', 'Event not found.');
            redirect('admin-events');
            return;
        }

        // Validation rules (files are NOT required for an edit)
        $rules = [
            ['field' => 'type', 'label' => 'Type', 'rules' => 'trim'],
            ['field' => 'caption', 'label' => 'Caption', 'rules' => 'trim'],
            ['field' => 'description', 'label' => 'Description', 'rules' => 'trim'],
            ['field' => 'date', 'label' => 'Event Date', 'rules' => 'trim'],
            ['field' => 'venue', 'label' => 'Venue', 'rules' => 'trim'],
        ];
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $this->update_event($id); // Reload form with validation errors
            return;
        }

        // If no new image is uploaded, these values will be preserved.
        $event_image_name = $old_event_data->event_image;
        $other_images_names_str = $old_event_data->other_images;
        $upload_errors = '';

        // Upload config
        $config = [
            'upload_path'      => './assets/uploads/events/',
            'allowed_types'    => 'jpg|jpeg|png',
            'max_size'         => 5024,
            'encrypt_name'     => TRUE,
        ];
        $this->load->library('upload', $config);

        // Handle NEW featured image upload
        if (!empty($_FILES['event_image']['name'])) {
            if ($this->upload->do_upload('event_image')) {
                // Delete the old image file
                if (!empty($old_event_data->event_image) && file_exists($config['upload_path'] . $old_event_data->event_image)) {
                    unlink($config['upload_path'] . $old_event_data->event_image);
                }
                // Set the new image name
                $event_image_name = $this->upload->data('file_name');
            } else {
                $upload_errors .= '<p>Featured Image Error: ' . $this->upload->display_errors('', '') . '</p>';
            }
        }

        // Handle NEW "other images" upload
        if (!empty($_FILES['other_images']['name']) && count(array_filter($_FILES['other_images']['name'])) > 0) {
            // First, delete all old "other" images
            $old_other_images = explode(',', $old_event_data->other_images);
            foreach ($old_other_images as $old_img) {
                if (!empty($old_img) && file_exists($config['upload_path'] . trim($old_img))) {
                    unlink($config['upload_path'] . trim($old_img));
                }
            }

            $new_other_images = [];
            $files = $_FILES['other_images'];
            foreach ($files['name'] as $key => $image_name) {
                // Re-structure the $_FILES array for each image
                $_FILES['other_image']['name']    = $files['name'][$key];
                $_FILES['other_image']['type']    = $files['type'][$key];
                $_FILES['other_image']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['other_image']['error']   = $files['error'][$key];
                $_FILES['other_image']['size']    = $files['size'][$key];

                if ($this->upload->do_upload('other_image')) {
                    $new_other_images[] = $this->upload->data('file_name');
                } else {
                    $upload_errors .= '<p>Additional Image (' . $image_name . ') Error: ' . $this->upload->display_errors('', '') . '</p>';
                }
            }
            // Update the string for the database
            $other_images_names_str = implode(',', $new_other_images);
        }

        // Check for upload errors before proceeding
        if (!empty($upload_errors)) {
            $this->session->set_flashdata('status_msg_error', $upload_errors);
            $this->update_event($id);
            return;
        }

        // 7. On success, call the model to UPDATE the DB and redirect
        $this->events_model->update_event_in_db($id, $event_image_name, $other_images_names_str);
        $this->session->set_flashdata('status_msg', 'Event updated successfully.');
        redirect('admin-events');
    }


    public function publish_event($id)
    {
        //check event exists
        $this->check_data_exists($id, 'id', 'events', 'admin');
        $this->events_model->publish_event($id);
        $this->session->set_flashdata('status_msg', 'Event published successfully.');
        redirect($this->agent->referrer());
    }


    public function unpublish_event($id)
    {
        //check event exists
        $this->check_data_exists($id, 'id', 'events', 'admin');
        $this->events_model->unpublish_event($id);
        $this->session->set_flashdata('status_msg', 'Event unpublished successfully.');
        redirect($this->agent->referrer());
    }


    public function delete_event($id)
    {
        //check event exists
        $this->check_data_exists($id, 'id', 'events', 'admin');
        $this->events_model->delete_event($id);
        $this->session->set_flashdata('status_msg', 'Event deleted successfully.');
        redirect($this->agent->referrer());
    }


    public function clear_events()
    {
        $this->events_model->clear_events();
        $this->session->set_flashdata('status_msg', 'All Events cleared successfully.');
        redirect($this->agent->referrer());
    }


    public function bulk_actions_events()
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
                $this->events_model->bulk_actions_events($selected_rows);
            } else {
                $this->session->set_flashdata('status_msg_error', 'No item selected.');
            }
        } else {
            $this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
        }
        redirect($this->agent->referrer());
    }
}
