<?php
defined('BASEPATH') or die('Direct access not allowed');


/* ===== Documentation ===== 
Name: Admin
Role: Controller
Description: Controls access to pages who's models are listed below and functions in admin panel
Model: Admin_model, Projects_model, Staff_model, Newsletter_model, Events_model, Testimonial_model
Author: Sylvester Esso Nmakwe
Date Created: 25th July, 2023
*/



class Admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->load->model('admin_model');
		$this->load->model('projects_model');
		$this->load->model('staff_model');
		$this->load->model('newsletter_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email);
	}



	/* ====== Dashboard ====== */
	public function index()
	{ //admin dashboard, routed as dashboard
		$this->admin_header('Admin', 'Dashboard');
		$data['total_projects'] = $this->projects_model->count_projects();
		$data['total_newsletter'] = $this->newsletter_model->count_newsletter_subscribers();
		$data['total_staff'] = $this->staff_model->count_staff();
		$this->load->view('admin/dashboard/dashboard', $data);
		$this->admin_footer();
	}
}
