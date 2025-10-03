<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation ===== 
Name: staff_model
Role: Model
Description: Controls the DB processes of staff from admin panel
Controller: staff
Author: Sylvester Nmakwe
Date Created: 10th January, 2023
*/




class Staff_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'staff';
		$this->load->model('common_model');
		$this->primary_cols = array('id');
	}




	public function get_staff_details($id)
	{
		return $this->db->get_where('staff', array('id' => $id))->row();
	}

	public function get_staff_details_by_slug($slug)
	{
		return $this->db->get_where('staff', array('slug' => $slug))->row();
	}


	public function get_recent_published_staff($limit)
	{ //recent blog for homepage and sidebar
		$this->db->order_by('date_joined', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('staff', array('published' => 1))->result();
	}



	/* =========== All staff ============== */
	public function get_staff($limit)
	{ //get all staff
		$this->db->order_by('date_joined', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('staff')->result();
	}


	public function get_staff_list($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_joined", "desc"); //order by date DESC so that the dates appear chronologically
		$query = $this->db->get_where('staff');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function get_published_staff($limit)
	{ //get all staff
		$this->db->where('published', 1);
		$this->db->order_by('order_number', 'ASC');
		$this->db->limit($limit);
		return $this->db->get_where('staff')->result();
	}

	public function get_published_staff_in_abuja($limit)
	{ //get all staff
		$this->db->where('published', 1);
		$this->db->where('state', 'abuja');
		$this->db->order_by('order_number', 'ASC');
		$this->db->limit($limit);
		return $this->db->get_where('staff')->result();
	}

	public function get_published_staff_in_ph($limit)
	{ //get all staff
		$this->db->where('published', 1);
		$this->db->where('state', 'portharcourt');
		$this->db->order_by('order_number', 'ASC');
		$this->db->limit($limit);
		return $this->db->get_where('staff')->result();
	}


	public function get_published_staff_list($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_joined", "DESC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('staff');
		$where = array(
			'published' => 1, //Ensure staff has been published
		);
		$this->db->where($where);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function get_staff_details_by_id($id)
	{ //get staff details by id
		return $this->db->get_where('staff', array('id' => $id))->row();
	}


	public function count_staff()
	{
		return $this->db->get_where('staff')->num_rows();
	}


	public function count_published_staff()
	{
		return $this->db->get_where('staff', array('published' => 1))->num_rows();
	}


	public function count_unpublished_staff()
	{
		return $this->db->get_where('staff', array('published' => 0))->num_rows();
	}


	public function add_staff_to_db($staff_photo)
	{
		// Prepare data for insertion
		$data = extractKeys($this->input->post(), $this->getColumns());
		$post = $this->input->post(NULL, TRUE); // With XSS filtering

		$data = [
			'order_number'        => $post['order_number'],
			'name'        => $post['name'],
			'email'       => $post['email'],
			'state'       => $post['state'],
			// 'phone'       => $post['phone'],
			// 'dob'         => $post['dob'],
			// 'date_joined' => $post['date_joined'],
			'sex'         => $post['sex'],
			// 'address'     => $post['address'],
			'designation' => $post['designation'],
			// 'facebook'    => $post['facebook'],
			// 'twitter'     => $post['twitter'],
			// 'instagram'   => $post['instagram'],
			// 'linkedin'    => $post['linkedin'],
			'staff_photo' => $staff_photo,
		];

		return $this->db->insert('staff', $data);
	}


	public function update_staff_in_db($id, $staff_photo)
	{
		$post = $this->input->post(NULL, TRUE); // With XSS filtering

		$data = [
			'order_number'        => $post['order_number'],
			'name'        => $post['name'],
			'email'       => $post['email'],
			'state'       => $post['state'],
			// 'phone'       => $post['phone'],
			// 'dob'         => $post['dob'],
			// 'date_joined' => $post['date_joined'],
			'sex'         => $post['sex'],
			// 'address'     => $post['address'],
			'designation' => $post['designation'],
			// 'facebook'    => $post['facebook'],
			// 'twitter'     => $post['twitter'],
			// 'instagram'   => $post['instagram'],
			// 'linkedin'    => $post['linkedin'],
			'staff_photo' => $staff_photo,
		];

		// Perform the update
		$this->db->where('id', $id);
		return $this->db->update('staff', $data);
	}


	public function publish_staff($id)
	{
		$data = array(
			'published' => 1,
		);
		$this->db->where('id', $id);
		return $this->db->update('staff', $data);
	}


	public function unpublish_staff($id)
	{
		$data = array(
			'published' => 0,
		);
		$this->db->where('id', $id);
		return $this->db->update('staff', $data);
	}


	public function delete_staff($id)
	{
		// Get the staff details first to find the filenames
		$staff = $this->get_staff_details($id);

		// Make sure the staff exists before trying to delete files
		if ($staff) {
			$upload_path = './assets/uploads/staff/'; // Define path

			// Delete the single featured image if it exists
			if (!empty($staff->staff_image) && file_exists($upload_path . $staff->staff_image)) {
				unlink($upload_path . $staff->staff_image);
			}

			// 4. Delete all other images
			if (!empty($staff->other_images)) {
				// Convert the comma-separated string into an array of filenames
				$other_images = explode(',', $staff->other_images);

				foreach ($other_images as $image) {
					// Trim whitespace and check if the file exists before unlinking
					$image_path = $upload_path . trim($image);
					if (!empty($image) && file_exists($image_path)) {
						unlink($image_path);
					}
				}
			}
		}

		// delete the database record
		return $this->db->delete('staff', ['id' => $id]);
	}


	public function bulk_actions_staff($selected_rows)
	{
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);

		if (is_array($selected_rows)) {
			foreach ($selected_rows as $id) {
				switch ($bulk_action_type) {
					case 'publish':
						$this->publish_staff($id);
						break;
					case 'unpublish':
						$this->unpublish_staff($id);
						break;
					case 'delete':
						$this->delete_staff($id);
						break;
				}
			}

			// Set the flash message using count of the selected rows
			$action_message = match ($bulk_action_type) {
				'publish' => 'Staff published successfully.',
				'unpublish' => 'Staff unpublished successfully.',
				'delete' => 'Staff deleted successfully.',
				default => 'action completed successfully.'
			};

			$this->session->set_flashdata('status_msg', count($selected_rows) . " " . $action_message);
		} else {
			$this->session->set_flashdata('status_msg_error', 'No Staff selected for bulk action.');
		}
	}
}
