<?php
defined('BASEPATH') or exit('No direct script access allowed');


/* ===== Documentation ===== 
Name: Home
Role: Controller
Description: Controls access to messages, property, events, affiliates, locations, projects and testimonial pages and functions in admin panel
Models: Message_model, properties_model, Events_model, Affiliates_model, Locations_model, Projects_model, Common_model, Testimonial_model
Author: Sylvester Esso Nmakwe
Date Created: 125th July, 2025
*/



class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('message_model');
		$this->load->model('events_model');
		$this->load->model('gallery_model');
		$this->load->model('affiliates_model');
		$this->load->model('staff_model');
		$this->load->model('projects_model');
		$this->load->model('awards_model');
		$this->load->model('common_model');
	}


	public function index()
	{

		$data['schema'] = $this->get_schema();

		$this->website_header('12th City Real Estate Developers', $data);
		// $data['brochures'] = $this->brochures_model->get_recent_published_brochures(5);
		$data['events'] = $this->events_model->get_events(4);
		$data['projects'] = $this->common_model->get_published_project(5);
		$this->load->view('website/home', $data);
		$this->website_footer($data);
	}


	public function inquiry_ajax()
	{
		$rules = [
			['field' => 'type', 'label' => 'Inquiry Type', 'rules' => 'trim|required'],
			['field' => 'iAmA', 'label' => 'I am a', 'rules' => 'trim|required'],
			['field' => 'firstName', 'label' => 'First Name', 'rules' => 'trim|required'],
			['field' => 'lastName', 'label' => 'Last Name', 'rules' => 'trim|required'],
			['field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email|required'],
			['field' => 'location', 'label' => 'Location', 'rules' => 'trim|required'],
			['field' => 'property', 'label' => 'Property', 'rules' => 'trim|required'],
			['field' => 'price', 'label' => 'Max Price', 'rules' => 'trim|numeric'],
			['field' => 'size', 'label' => 'Minimum Size', 'rules' => 'trim|is_natural|required'],
			['field' => 'bedNum', 'label' => 'Number of Beds', 'rules' => 'trim|is_natural|required'],
			['field' => 'bathNum', 'label' => 'Number of Baths', 'rules' => 'trim|is_natural|required'],
		];
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$res = ['status' => false, 'msg' => validation_errors()];
			echo json_encode($res);
			return;
		}

		$this->message_model->send_inquiry_to_email();
		$res = ['status' => true, 'msg' => 'Inquiry sent! We will be in touch.'];
		echo json_encode($res);
	}


	public function about()
	{
		$this->website_header('About us');
		$this->load->view('website/about');
		$this->website_footer();
	}


	public function awards()
	{
		$this->website_header('Awards & Recognition');
		$config = array();
		$config = array();
		$per_page = 5;
		$uri_segment = 2; // FIX: Change this from 3 to 2

		$config["base_url"] = base_url('awards');
		$config["total_rows"] = $this->awards_model->count_published_awards();
		$config["per_page"] = $per_page;
		$config["uri_segment"] = $uri_segment;

		// --- Styling Config ---
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="next-page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev-page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		// --- Link Text Config ---
		$config['next_link'] = 'Next <i class="fas fa-arrow-right ms-2"></i>';
		$config['prev_link'] = '<i class="fas fa-arrow-left me-2"></i> Previous';
		$config['first_link'] = 'First'; // FIX: Add this line
		$config['last_link'] = 'Last';   // FIX: Add this line

		$this->pagination->initialize($config);

		$page = $this->uri->segment($uri_segment) ? $this->uri->segment($uri_segment) : 0;
		$data["awards"] = $this->awards_model->get_award_list($per_page, $page);

		// You no longer need to explode the links. Just pass the raw string.
		$data["links"] = $this->pagination->create_links();

		// No need to count again, just use the value from the config
		$data['total_records'] = $config["total_rows"];
		$this->load->view('website/awards', $data);
		$this->website_footer();
	}


	public function projects()
	{
		$this->website_header('Projects in Abuja');
		$data['projects'] = $this->projects_model->get_published_project_in_abuja();
		$this->load->view('website/projects', $data);
		$this->website_footer();
	}

	public function projects_ph()
	{
		$this->website_header('Projects in Portharcourt');
		$data['projects'] = $this->projects_model->get_published_project_in_ph();
		$this->load->view('website/projects_ph', $data);
		$this->website_footer();
	}


	public function project_details($slug)
	{
		//check event exists
		$this->check_data_exists($slug, 'slug', 'projects', 'project-details');
		$project_details = $this->projects_model->get_project_details_by_slug($slug);
		$this->website_header('' . $project_details->title . '');
		$data['projects'] = $this->common_model->get_published_project(5);
		$data['project_details'] = $this->projects_model->get_project_details_by_slug($slug);
		$this->load->view('website/project_details', $data);
		$this->website_footer();
	}


	public function events()
	{
		$this->website_header('News & Insights');
		$config = array();
		$config = array();
		$per_page = 5;
		$uri_segment = 2; // FIX: Change this from 3 to 2

		$config["base_url"] = base_url('events');
		$config["total_rows"] = $this->events_model->count_published_events();
		$config["per_page"] = $per_page;
		$config["uri_segment"] = $uri_segment;

		// --- Styling Config ---
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="next-page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev-page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		// --- Link Text Config ---
		$config['next_link'] = 'Next <i class="fas fa-arrow-right ms-2"></i>';
		$config['prev_link'] = '<i class="fas fa-arrow-left me-2"></i> Previous';
		$config['first_link'] = 'First'; // FIX: Add this line
		$config['last_link'] = 'Last';   // FIX: Add this line

		$this->pagination->initialize($config);

		$page = $this->uri->segment($uri_segment) ? $this->uri->segment($uri_segment) : 0;
		$data["events"] = $this->events_model->get_events_list($per_page, $page);

		// You no longer need to explode the links. Just pass the raw string.
		$data["links"] = $this->pagination->create_links();

		// No need to count again, just use the value from the config
		$data['total_records'] = $config["total_rows"];

		$this->load->view('website/events', $data);
		$this->website_footer();
	}


	public function event_details($slug)
	{
		//check event exists
		$this->check_data_exists($slug, 'slug', 'events', 'events-details');
		$event_details = $this->events_model->get_event_details_by_slug($slug);
		if (!$event_details) {
			show_404();
		}
		// Increment view count
		$this->events_model->increment_views($event_details->id);
		$event_details->views = (int)$event_details->views + 1; // reflect increment immediately
		$this->website_header('' . $event_details->caption . '');
		$data['recent_events'] = $this->events_model->get_recent_published_events(3);
		$data['event_details'] = $this->events_model->get_event_details_by_slug($slug);
		$this->load->view('website/event_details', $data);
		$this->website_footer();
	}


	public function gallery()
	{
		$this->website_header('Our Gallery');
		$config = array();
		$config = array();
		$per_page = 16;
		$uri_segment = 2; // FIX: Change this from 3 to 2

		$config["base_url"] = base_url('gallery');
		$config["total_rows"] = $this->gallery_model->count_published_images();
		$config["per_page"] = $per_page;
		$config["uri_segment"] = $uri_segment;

		// --- Styling Config ---
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="next-page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev-page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		// --- Link Text Config ---
		$config['next_link'] = 'Next <i class="far fa-arrow-right ms-2"></i>';
		$config['prev_link'] = '<i class="far fa-arrow-left me-2"></i> Previous';
		$config['first_link'] = 'First'; // FIX: Add this line
		$config['last_link'] = 'Last';   // FIX: Add this line

		$this->pagination->initialize($config);

		$page = $this->uri->segment($uri_segment) ? $this->uri->segment($uri_segment) : 0;
		$data["images"] = $this->gallery_model->get_published_images($per_page, $page);

		// You no longer need to explode the links. Just pass the raw string.
		$data["links"] = $this->pagination->create_links();

		// No need to count again, just use the value from the config
		$data['total_records'] = $config["total_rows"];

		$this->load->view('website/gallery', $data);
		$this->website_footer();
	}


	public function affiliate()
	{
		$this->website_header('Affiliate Plans');
		$this->load->view('website/affiliate');
		$this->website_footer();
	}


	public function affiliate_ajax()
	{
		$rules = [
			['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'],
			['field' => 'name', 'label' => 'Full Name / Company Name', 'rules' => 'trim|required'],
			['field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'],
			['field' => 'state', 'label' => 'State of Origin', 'rules' => 'trim|required'],
			['field' => 'nationality', 'label' => 'Nationality', 'rules' => 'trim|required'],
			[
				'field' => 'phone',
				'label' => 'WhatsApp',
				'rules' => 'trim|required|is_natural',
				'errors' => ['is_natural' => 'Please enter numbers only in the WhatsApp field']
			],
			['field' => 'other_phone', 'label' => 'Other Phone', 'rules' => 'trim|is_natural'],
			['field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'],
			['field' => 'applicant_type', 'label' => 'Type of Applicant', 'rules' => 'trim|required'],
			['field' => 'id_card', 'label' => 'Means of Identification', 'rules' => 'trim|required'],
			['field' => 'id_number', 'label' => 'ID Number', 'rules' => 'trim|required'],
			['field' => 'cac', 'label' => 'CAC Registration Number', 'rules' => 'trim'],
			['field' => 'bank_name', 'label' => 'Bank Name', 'rules' => 'trim|required'],
			['field' => 'account_number', 'label' => 'Account Number', 'rules' => 'trim|required|is_natural'],
			['field' => 'account_name', 'label' => 'Account Name', 'rules' => 'trim|required'],
			['field' => 'referrer_name', 'label' => 'Referrer Name', 'rules' => 'trim|required'],
			['field' => 'referrer_relationship', 'label' => 'Referrer Relationship', 'rules' => 'trim|required'],
			['field' => 'referrer_phone', 'label' => 'Referrer Phone', 'rules' => 'trim|required|is_natural'],
			['field' => 'consent', 'label' => 'Consent', 'rules' => 'trim|required'],
			['field' => 'signature', 'label' => 'Signature', 'rules' => 'trim|required'],
		];

		$this->form_validation->set_rules($rules);

		// Run validation ONLY on the POST data first.
		if ($this->form_validation->run() == FALSE) {
			$res = ['status' => false, 'msg' => validation_errors()];
			echo json_encode($res);
			return;
		}

		// Check for the file upload separately.
		if (empty($_FILES['passport']['name'])) {
			$res = ['status' => false, 'msg' => 'The Passport field is required.'];
			echo json_encode($res);
			return; // Stop execution if the file is missing
		}

		// You can also override any other setting here, like max_size.
		$upload_path = [
			'upload_path' => './assets/uploads/affiliate/'
		];

		// Call the upload helper and handle the result directly.
		$passport_image_result = upload_single_image('passport', $upload_path);

		if ($passport_image_result['status']) {
			// Get the filename and call the model
			$passport_file_name = $passport_image_result['filename'];
			$this->affiliates_model->add_affiliate_to_db($passport_file_name);
			$res = ['status' => true, 'msg' => 'Application submitted successfully! We will be in touch.'];
			echo json_encode($res);
		} else {
			// The file was present but invalid (e.g., wrong type, too large)
			$error_msg = 'Passport Upload Error: ' . $passport_image_result['error'];
			$res = ['status' => false, 'msg' => $error_msg];
			echo json_encode($res);
		}
	}


	public function staff()
	{
		$this->website_header('Our Abuja Staff');
		$data['staff'] = $this->staff_model->get_published_staff(10);
		$this->load->view('website/staff', $data);
		$this->website_footer();
	}

	public function staff_ph()
	{
		$this->website_header('Our Portharcourt Staff');
		$data['staff'] = $this->staff_model->get_published_staff(10);
		$this->load->view('website/staff', $data);
		$this->website_footer();
	}


	public function contact()
	{
		$this->website_header('Contact us');
		$this->load->view('website/contact');
		$this->website_footer();
	}


	public function contact_ajax()
	{
		$rules = [
			['field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'],
			['field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email|required'],
			['field' => 'phone', 'label' => 'Phone', 'rules' => 'trim|is_natural|required', array('is_natural' => 'Please enter numbers only in the phone field')],
			['field' => 'message', 'label' => 'Message', 'rules' => 'trim|required'],
		];
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$res = ['status' => false, 'msg' => validation_errors()];
			echo json_encode($res);
			return;
		}

		$this->message_model->contact_us(); //insert the data into db
		$res = ['status' => true, 'msg' => 'Message sent!'];
		echo json_encode($res);
	}


	public function newsletter_ajax()
	{
		$rules = [
			['field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email|required']
		];
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$res = ['status' => false, 'msg' => validation_errors()];
			echo json_encode($res);
			return;
		}

		$this->message_model->send_newsletter_email_to_db(); //insert the data into db
		$res = ['status' => true, 'msg' => 'You are now subscribed.'];
		echo json_encode($res);
	}


	public function terms()
	{
		$this->website_header('Terms & Conditions');
		$this->load->view('website/terms');
		$this->website_footer();
	}


	public function policy()
	{
		$this->website_header('Privacy Policy');
		$this->load->view('website/policy');
		$this->website_footer();
	}


	public function coming_soon()
	{
		$this->load->view('coming_soon');
	}


	public function check()
	{
		$this->load->view('website/check');
		// var_dump(production_url('assets/general/logo/colored_logo.png'));
	}
}
