<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation ===== 
Name: Affiliates_model
Role: Model
Description: Controls the DB processes of Affiliates from admin panel
Controller: Affiliates
Author: Sylvester Nmakwe
Date Created: 10th January, 2023
*/




class Affiliates_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'affiliates';
		$this->load->model('common_model');
		$this->primary_cols = array('id');
	}



	//get all affiliates
	public function get_affiliates()
	{
		$this->db->order_by('date_added', 'DESC');
		return $this->db->get_where('affiliates')->result();
	}


	//get affiliates details by id
	public function get_affiliates_details($id)
	{
		return $this->db->get_where('affiliates', array('id' => $id))->row();
	}


	//count all affiliates
	public function count_affiliates()
	{
		return $this->db->get_where('affiliates')->num_rows();
	}


	//Add affiliate
	public function add_affiliate_to_db($passport_file_name)
	{
		// Prepare data for insertion
		$data = extractKeys($this->input->post(), $this->getColumns());
		$post = $this->input->post(NULL, TRUE); // Keep XSS filtering

		$data = array(
			'email'               => $post['email'],
			'name'                => $post['name'],
			'gender'              => $post['gender'],
			'state'               => $post['state'],
			'nationality'         => $post['nationality'],
			'phone'               => $post['phone'],
			'other_phone'         => $post['other_phone'],
			'address'             => $post['address'],
			'applicant_type'      => $post['applicant_type'],
			'passport'            => $passport_file_name,
			'id_card'             => $post['id_card'],
			'id_number'           => $post['id_number'],
			'cac'                 => $post['cac'],
			'bank_name'           => $post['bank_name'],
			'account_number'      => $post['account_number'],
			'account_name'        => $post['account_name'],
			'referrer_name'       => $post['referrer_name'],
			'referrer_relationship' => $post['referrer_relationship'],
			'referrer_phone'      => $post['referrer_phone'],
			'signature'           => $post['signature'],
		);

		//Send email to Admin
		send_email_notification($this, 'onyekaesso10@gmail.com', 'New Affiliate Message', $data, 'affiliate_notification_email');

		$this->db->insert('affiliates', $data);
		return;
	}


	//delete affiliates
	public function delete_affiliates($id)
	{
		$y = $this->common_model->get_affiliates_details_by_id($id);
		return $this->db->delete('affiliates', array('id' => $id));
	}


	public function bulk_actions_affiliates()
	{
		$selected_rows = count($this->input->post('check_bulk_action', TRUE));
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);
		$row_id = $this->input->post('check_bulk_action', TRUE);
		foreach ($row_id as $id) {
			switch ($bulk_action_type) {
				case 'delete':
					$this->delete_affiliates($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} affiliates(s) deleted successfully.");
			}
		}
	}
}
