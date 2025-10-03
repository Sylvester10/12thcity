<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation ===== 
Name: Message_model
Role: Model
Description: Controls the DB processes of Message from admin panel
Controller: Message
Author: Sylvester Esso Nmakwe
Date Created: 23th 	July, 2025
*/




class Message_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'contact_messages';
		$this->primary_cols = array('id');
	}



	public function contact_us()
	{

		$post = $this->input->post(NULL, TRUE); // Keep XSS filtering

		$data = array(
			'name' => $post['name'],
			'email' => $post['email'],
			'phone' => $post['phone'],
			'message' => nl2br($post['message']),
		);

		//Send email to Admin
		send_email_notification($this, 'onyekaesso10@gmail.com', 'New Contact Message', $data, 'contact_notification_email');
		return;
	}

	public function send_inquiry_to_email()
	{
		$post = $this->input->post(NULL, TRUE); // Keep XSS filtering

		$data = array(
			'type'       => $post['type'],
			'iAmA'       => $post['iAmA'],
			'firstName'  => $post['firstName'],
			'lastName'   => $post['lastName'],
			'email'      => $post['email'],
			'location'   => $post['location'],
			'property'   => $post['property'],
			'price'      => $post['price'],
			'size'       => $post['size'],
			'bedNum'     => $post['bedNum'],
			'bathNum'    => $post['bathNum'],
		);

		//Send email to Admin
		send_email_notification($this, 'onyekaesso10@gmail.com', 'New Inquiry Message', $data, 'inquiry_notification_email');
		return;
	}


	public function send_newsletter_email_to_db()
	{
		$post = $this->input->post(NULL, TRUE); // Keep XSS filtering

		$data = array(
			'email' => $post['email']
		);

		return $this->db->insert('newsletter_subscribers', $data);
	}


	public function send_email()
	{

		$email = strtolower($this->input->post('email', TRUE));
		$subject = ucfirst($this->input->post('subject', TRUE));
		$data['message'] = nl2br(ucfirst($this->input->post('message', TRUE)));

		// email user
		send_email_notification($this, $email, $subject, $data, 'admin_general_notification_email');
	}


	public function send_bulk_email($mail_list)
	{
		// Extract email addresses from the objects
		$emails = array_map(function ($user) {
			return $user->email;
		}, $mail_list);

		$subject = ucwords($this->input->post('subject', TRUE));
		$data['message'] = nl2br(ucfirst($this->input->post('message', TRUE)));

		// Send emails using the extracted email list
		return send_bulk_email_notification($this, $emails, $subject, $data, 'admin_general_notification_email');
	}

}
