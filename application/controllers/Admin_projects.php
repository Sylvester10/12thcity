<?php
defined('BASEPATH') or die('Direct access not allowed');


/* ===== Documentation ===== 
Name: Home
Role: Controller
Description: Controls access to Projects pages and functions in admin panel
Models: Projects_model
Author: Sylvester Esso Nmakwe
Date Created: 23th July, 2025
*/



class Admin_projects extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->load->model('projects_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->email);
	}



	/* ========== All projects ========== */
	public function index()
	{
		$inner_page_title = 'Projects (' . count($this->projects_model->get_projects()) . ')';
		$this->admin_header('Admin', $inner_page_title);
		$this->load->view('admin/projects/all_projects');
		$this->admin_footer();
	}


	public function projects_ajax()
	{
		$this->load->model('ajax/projects/projects_model_ajax', 'current_model');
		$list = $this->current_model->get_records();
		$data = array();
		foreach ($list as $y) {
			$image_src = base_url('assets/uploads/projects/' . $y->featured_image);
			$avatar = user_avatar_table($y->featured_image, $image_src, user_avatar);

			$published = ($y->published == 1) ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>';
			$amenities = explode('| ' . ' ', $y->amenities);

			$row = array();
			$row[] = checkbox_bulk_action($y->id);
			$row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
			$row[] = $avatar;
			$row[] = $y->title;
			$row[] = $y->description;
			$row[] = $y->state;
			$row[] = $y->location;
			$row[] = $y->address;
			$row[] = $amenities;
			$row[] = $y->video;
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


	/* ========== New project ========== */
	public function add_project($error = array('error' => ''))
	{
		$this->admin_header('Admin', 'Add Project');
		$this->load->view('admin/projects/add_project', $error);
		$this->admin_footer();
	}


	/* ========== Add project ========== */
	public function add_project_ajax()
	{

		$rules = [
			['field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'],
			['field' => 'description', 'label' => 'Description', 'rules' => 'trim|required'],
			['field' => 'state', 'label' => 'State', 'rules' => 'trim|required'],
			['field' => 'location', 'label' => 'Location', 'rules' => 'trim|required'],
			['field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'],
			['field' => 'livingrooms', 'label' => 'Living Rooms', 'rules' => 'trim|required'],
			['field' => 'bedrooms', 'label' => 'Bedrooms', 'rules' => 'trim|required'],
			['field' => 'bathrooms', 'label' => 'Bathrooms', 'rules' => 'trim|required'],
			['field' => 'size', 'label' => 'Size', 'rules' => 'trim|required'],
			['field' => 'parking', 'label' => 'Parking', 'rules' => 'trim|required'],
			['field' => 'elevator', 'label' => 'Elevator', 'rules' => 'trim|required'],
			['field' => 'wifi', 'label' => 'Wifi', 'rules' => 'trim|required'],
			['field' => 'amenities[]', 'label' => 'Amenities', 'rules' => 'required'],
			['field' => 'video', 'label' => 'Video', 'rules' => 'trim|valid_url|regex_match[/^https:\/\/(www\.)?youtube\.com\/embed\/[a-zA-Z0-9_-]+$/i]'],
		];

		$this->form_validation->set_rules($rules);

		// Custom callback rule for the featured image
		if (empty($_FILES['featured_image']['name'])) {
			$this->form_validation->set_rules('featured_image', 'Project Feature Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->add_project();
			return;
		}

		// You can also override any other setting here, like max_size.
		$upload_path = [
			'upload_path' => './assets/uploads/projects/'
		];

		$upload_errors = [];
		$featured_image_name = '';
		$other_images_names = [];

		// 2. Upload Featured Image using the helper
		$featured_image_result = upload_single_image('featured_image', $upload_path);
		if ($featured_image_result['status']) {
			$featured_image_name = $featured_image_result['filename'];
		} else {
			$upload_errors[] = '<p>Featured Image Error: ' . $featured_image_result['error'] . '</p>';
		}

		// Upload Other Images using the helper
		$other_images_result = upload_multiple_images('other_images', $upload_path);
		if (!empty($other_images_result['errors'])) {
			// array_merge combines the errors from both uploads
			$upload_errors = array_merge($upload_errors, $other_images_result['errors']);
		}
		$other_images_names = $other_images_result['uploaded_files'];


		// Check for any upload errors
		if (!empty($upload_errors)) {
			// Implode all collected error messages for display
			$this->session->set_flashdata('status_msg_error', implode('', $upload_errors));
			$this->add_project();
			return;
		}

		// On success, call the model and redirect
		$this->projects_model->add_project_to_db($featured_image_name, implode(',', $other_images_names));
		$this->session->set_flashdata('status_msg', 'Project added and published successfully.');
		redirect('admin-projects');
	}


	/* ========== Edit project ========== */
	public function update_project($id, $error = array('error' => ''))
	{
		//check staff exists
		$this->check_data_exists($id, 'id', 'projects', 'admin');
		$project_details = $this->projects_model->get_project_details_by_id($id);
		$page_title = 'Edit Project: '  . $project_details->title;
		$this->admin_header('Admin', $page_title);
		$data['y'] = $this->projects_model->get_project_details_by_id($id);
		$data['upload_error'] = $error;
		$this->load->view('admin/projects/update_project', $data);
		$this->admin_footer();
	}


	public function update_project_ajax($id)
	{

		// Fetch existing project data first. We need this to get old filenames.
		$old_project_data = $this->projects_model->get_project_details($id);
		if (!$old_project_data) {
			$this->session->set_flashdata('status_msg_error', 'Project not found.');
			redirect('admin-projects');
			return;
		}

		// Validation rules (files are NOT required for an edit)
		$rules = [
			['field' => 'title', 'label' => 'Title', 'rules' => 'trim'],
			['field' => 'description', 'label' => 'Description', 'rules' => 'trim'],
			['field' => 'state', 'label' => 'State', 'rules' => 'trim'],
			['field' => 'location', 'label' => 'Location', 'rules' => 'trim'],
			['field' => 'address', 'label' => 'Address', 'rules' => 'trim'],
			['field' => 'livingrooms', 'label' => 'Living Rooms', 'rules' => 'trim'],
			['field' => 'bedrooms', 'label' => 'Bedrooms', 'rules' => 'trim'],
			['field' => 'bathrooms', 'label' => 'Bathrooms', 'rules' => 'trim'],
			['field' => 'size', 'label' => 'Size', 'rules' => 'trim'],
			['field' => 'parking', 'label' => 'Parking', 'rules' => 'trim'],
			['field' => 'elevator', 'label' => 'Elevator', 'rules' => 'trim'],
			['field' => 'wifi', 'label' => 'Wifi', 'rules' => 'trim'],
			['field' => 'amenities[]', 'label' => 'Amenities', 'rules' => ''],
			['field' => 'video', 'label' => 'Video', 'rules' => 'trim|valid_url|regex_match[/^https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]+$/]'],
		];
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->update_project($id); // Reload form with validation errors
			return;
		}

		// If no new image is uploaded, these values will be preserved.
		$featured_image_name = $old_project_data->featured_image;
		$other_images_names_str = $old_project_data->other_images;
		$upload_errors = '';

		// Upload config
		$config = [
			'upload_path'      => './assets/uploads/projects/',
			'allowed_types'    => 'jpg|jpeg|png',
			'max_size'         => 5024,
			'encrypt_name'     => TRUE,
		];
		$this->load->library('upload', $config);

		// Handle NEW featured image upload
		if (!empty($_FILES['featured_image']['name'])) {
			if ($this->upload->do_upload('featured_image')) {
				// Delete the old image file
				if (!empty($old_project_data->featured_image) && file_exists($config['upload_path'] . $old_project_data->featured_image)) {
					unlink($config['upload_path'] . $old_project_data->featured_image);
				}
				// Set the new image name
				$featured_image_name = $this->upload->data('file_name');
			} else {
				$upload_errors .= '<p>Featured Image Error: ' . $this->upload->display_errors('', '') . '</p>';
			}
		}

		// Handle NEW "other images" upload
		if (!empty($_FILES['other_images']['name']) && count(array_filter($_FILES['other_images']['name'])) > 0) {
			// First, delete all old "other" images
			$old_other_images = explode(',', $old_project_data->other_images);
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
			$this->update_project($id);
			return;
		}

		// 7. On success, call the model to UPDATE the DB and redirect
		$this->projects_model->update_project_in_db($id, $featured_image_name, $other_images_names_str);
		$this->session->set_flashdata('status_msg', 'Project updated successfully.');
		redirect('admin-projects');
	}


	public function publish_project($id)
	{
		$this->projects_model->publish_project($id);
		$this->session->set_flashdata('status_msg', 'Project published successfully.');
		redirect($this->agent->referrer());
	}


	public function unpublish_project($id)
	{
		$this->projects_model->unpublish_project($id);
		$this->session->set_flashdata('status_msg', 'Project unpublished successfully.');
		redirect($this->agent->referrer());
	}


	public function delete_project($id)
	{
		$this->check_data_exists($id, 'id', 'projects', 'admin');
		$this->projects_model->delete_project($id);
		$this->session->set_flashdata('status_msg', 'Project deleted successfully.');
		redirect($this->agent->referrer());
	}


	public function clear_projects()
	{
		$this->projects_model->clear_projects();
		$this->session->set_flashdata('status_msg', 'All projects cleared successfully.');
		redirect($this->agent->referrer());
	}


	public function bulk_actions_projects()
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
				$this->projects_model->bulk_actions_projects($selected_rows);
			} else {
				$this->session->set_flashdata('status_msg_error', 'No item selected.');
			}
		} else {
			$this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
		}
		redirect($this->agent->referrer());
	}
}
