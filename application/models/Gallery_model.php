<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation ===== 
Name: Gallery_model
Role: Model
Description: Controls the DB processes of Gallery from admin panel
Controller: Admin_Gallery, Gallery
Author: Sylvester Nmakwe
Date Created: 26th July, 2025
*/




class Gallery_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'galleries';
		$this->load->model('common_model');
		$this->primary_cols = array('id');
	}



	public function get_images($limit)
	{ //get all gallery images
		$this->db->order_by('date_added', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('galleries')->result();
	}


	public function get_image_details($id)
	{
		return $this->db->get_where('galleries', array('id' => $id))->row();
	}


	public function get_gallery_images($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_added", "DESC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('galleries');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function get_published_images($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_added", "DESC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('galleries', array('published' => 1));
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function get_recent_published_images($limit)
	{ //recent images for gallery page 
		$this->db->order_by('date_added', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('galleries', array('published' => 1))->result();
	}


	public function count_images()
	{
		return $this->db->get_where('galleries')->num_rows();
	}


	public function count_published_images()
	{
		return $this->db->get_where('galleries', array('published' => 1))->num_rows();
	}


	public function count_unpublished_images()
	{
		return $this->db->get_where('galleries', array('published' => 0))->num_rows();
	}


	/* ========== Admin Actions: Galleries ============= */
	public function upload_gallery_images($image)
	{
		$data = array(
			'image' => $image,
		);
		return $this->db->insert('galleries', $data);
	}


	public function publish_image($id)
	{
		$data = array(
			'published' => 1,
		);
		$this->db->where('id', $id);
		return $this->db->update('galleries', $data);
	}


	public function unpublish_image($id)
	{
		$data = array(
			'published' => 0,
		);
		$this->db->where('id', $id);
		return $this->db->update('galleries', $data);
	}


	public function delete_image($id)
	{
		// Get the gallery details first to find the filenames
		$gallery = $this->get_image_details($id);

		// Make sure the gallery exists before trying to delete files
		if ($gallery) {
			$upload_path = './assets/uploads/gallery/'; // Define path

			// Delete the single featured image if it exists
			if (!empty($gallery->image) && file_exists($upload_path . $gallery->image)) {
				unlink($upload_path . $gallery->image);
			}
		}

		// delete the database record
		return $this->db->delete('galleries', ['id' => $id]);
	}


	public function bulk_actions_gallery($selected_rows)
	{
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);

		if (is_array($selected_rows)) {
			foreach ($selected_rows as $id) {
				switch ($bulk_action_type) {
					case 'publish':
						$this->publish_image($id);
						break;
					case 'unpublish':
						$this->unpublish_image($id);
						break;
					case 'delete':
						$this->delete_image($id);
						break;
				}
			}

			// Set the flash message using count of the selected rows
			$action_message = match ($bulk_action_type) {
				'publish' => 'Images published successfully.',
				'unpublish' => 'Images unpublished successfully.',
				'delete' => 'Images deleted successfully.',
				default => 'action completed successfully.'
			};

			$this->session->set_flashdata('status_msg', count($selected_rows) . " " . $action_message);
		} else {
			$this->session->set_flashdata('status_msg_error', 'No Image selected for bulk action.');
		}
	}
}
