<?php
defined('BASEPATH') or die('Direct access not allowed');


/* ===== Documentation ===== 
Name: Home
Role: Controller
Description: Controls access to Gallery pages and functions in admin panel
Models: Gallery_model
Author: Sylvester Esso Nmakwe
Date Created: 26th July, 2025
*/



class Admin_gallery extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->admin_restricted(); //allow only logged in users to access this class
        $this->load->model('gallery_model');
        $this->admin_detail = $this->common_model->get_admin_details($this->session->admin_email);
    }


    public function index()
    {
        $total_gallery = $this->gallery_model->count_images();
        $inner_page_title = 'Gallery (' . $total_gallery . ')';
        $this->admin_header('Admin', $inner_page_title);
        //config for pagination
        $config = array();
        $per_page = 12; //number of items to be displayed per page
        $uri_segment = 2; //pagination segment id: gallery/pagination_id
        $config["base_url"] = base_url('admin_gallery');
        $config["total_rows"] = $total_gallery;
        $config["per_page"] = $per_page;
        $config["uri_segment"] = $uri_segment;
        $config['cur_tag_open'] = '<a class="pagination-active-page" href="#!">'; //disable click event of current link
        $config['cur_tag_close'] = '</a>';
        $config['first_link'] = 'First';
        $config['next_link'] = '&raquo;'; // >>
        $config['prev_link'] = '&laquo;'; // <<
        $config['last_link'] = 'Last';
        $config['display_pages'] = TRUE; //show pagination link digits
        $config['num_links'] = 3; //number of digit links
        $this->pagination->initialize($config);
        $page = $this->uri->segment($uri_segment) ? $this->uri->segment($uri_segment) : 0;
        $data["gallery"] = $this->gallery_model->get_images($config["per_page"], $page);
        $data["total_records"] = $config["total_rows"];
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
        $data['total_records'] = $this->gallery_model->count_images();
        $data['total_published'] = $this->gallery_model->count_published_images();
        $data['total_unpublished'] = $this->gallery_model->count_unpublished_images();
        $this->load->view('admin/gallery/all_gallery', $data);
        $this->admin_footer();
    }


    /* ========== Admin Actions: gallery ============= */
    public function upload_gallery_ajax()
    {
        if (!empty($_FILES)) {

            // Config for file uploads
            $config['upload_path'] = 'assets/uploads/gallery'; // Path to save the files
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG'; // Extensions which are allowed
            $config['max_size'] = 1024 * 5; // Filesize cannot exceed 5MB
            $config['file_ext_tolower'] = TRUE; // Force file extension to lower case
            $config['remove_spaces'] = TRUE; // Replace space in file names with underscores to avoid break
            $config['detect_mime'] = TRUE; // Detect type of file to avoid code injection

            $this->load->library('upload', $config);

            // File upload
            if ($this->upload->do_upload('file')) {
                // Get data about the file
                $upload_data = $this->upload->data();

                // Generate a random name for the uploaded file
                $file_name = uniqid() . $upload_data['file_ext'];

                // Rename the uploaded file with the random name
                $new_file_path = $config['upload_path'] . '/' . $file_name;
                rename($upload_data['full_path'], $new_file_path);

                // Call the upload_gallery function with the new file name
                $this->gallery_model->upload_gallery_images($file_name);
            }
        }
    }



    public function update_gallery()
    {
        $this->session->set_flashdata('status_msg', 'Gallery updated successfully.');
        redirect($this->agent->referrer());
    }


    public function publish_image($id)
    {
        //check gallery exists
        $this->check_data_exists($id, 'id', 'galleries', 'gallery');
        $this->gallery_model->publish_image($id);
        $this->session->set_flashdata('status_msg', 'Image published successfully.');
        redirect($this->agent->referrer());
    }


    public function unpublish_image($id)
    {
        //check gallery exists
        $this->check_data_exists($id, 'id', 'galleries', 'gallery');
        $this->gallery_model->unpublish_image($id);
        $this->session->set_flashdata('status_msg', 'Image unpublished successfully.');
        redirect($this->agent->referrer());
    }


    public function delete_image($image)
    {
        //check gallery exists
        $this->check_data_exists($image, 'id', 'galleries', 'gallery');
        $this->gallery_model->delete_image($image);
        $this->session->set_flashdata('status_msg', 'Image deleted successfully.');
        redirect($this->agent->referrer());
    }


    public function bulk_actions_gallery()
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
                $this->gallery_model->bulk_actions_gallery($selected_rows);
            } else {
                $this->session->set_flashdata('status_msg_error', 'No item selected.');
            }
        } else {
            $this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
        }
        redirect($this->agent->referrer());
    }
}
