<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation ===== 
Name: Events_model
Role: Model
Description: Controls the DB processes of Events from admin panel
Controller: Events
Author: Sylvester Nmakwe
Date Created: 10th January, 2023
*/




class Events_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'events';
		$this->load->model('common_model');
		$this->primary_cols = array('id');
	}




	public function get_event_details($id)
	{
		return $this->db->get_where('events', array('id' => $id))->row();
	}

	
	public function get_event_details_by_slug($slug)
	{
		return $this->db->get_where('events', array('slug' => $slug))->row();
	}


	public function get_recent_published_events($limit)
	{ //recent blog for homepage and sidebar
		$this->db->order_by('date', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('events', array('published' => 1))->result();
	}


	public function get_published_upcoming_events($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "ASC"); //order by date_unix ASC so that the dates appear chronologically
		$date_unix_today = date('Ymd');
		$where = array(
			'published' => 1,
			'date >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where);
		$query = $this->db->get('events');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function count_upcoming_events()
	{
		$date_unix_today = date('Ymd');
		$where = array(
			'date_unix >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where);
		return $this->db->get('events')->num_rows();
	}


	public function count_published_upcoming_events()
	{
		$where = array(
			'published' => 1,
		);
		$this->db->where($where);
		return $this->db->get('events')->num_rows();
	}


	public function count_unpublished_upcoming_events()
	{
		$date_unix_today = date('Ymd');
		$where = array(
			'published' => 0,
			'date_unix >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where);
		return $this->db->get('events')->num_rows();
	}



	/* =========== All Events ============== */
	public function get_events($limit)
	{ //get all events
		$this->db->order_by('date', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('events')->result();
	}


	public function get_events_list($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "asc"); //order by date DESC so that the dates appear chronologically
		$query = $this->db->get_where('events');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function get_published_events_list($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "DESC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('events');
		$where = array(
			'published' => 1, //Ensure event has been published
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


	public function get_event_details_by_id($id)
	{ //get traveller details by id
		return $this->db->get_where('events', array('id' => $id))->row();
	}


	public function count_events()
	{
		return $this->db->get_where('events')->num_rows();
	}


	public function count_published_events()
	{
		return $this->db->get_where('events', array('published' => 1))->num_rows();
	}


	public function count_unpublished_events()
	{
		return $this->db->get_where('events', array('published' => 0))->num_rows();
	}


	public function add_event_to_db($event_image, $other_images)
	{
		// Prepare data for insertion
		$data = extractKeys($this->input->post(), $this->getColumns());
		$post = $this->input->post(NULL, TRUE); // Keep XSS filtering

		$caption = $post['caption']; // Store as is or use ucfirst()
		$description = $post['description']; // Store as is

		$data = [
			'type' => $post['type'],
			'caption' => $caption,
			'description' => $description,
			'slug' => url_title($caption, 'dash', true),
			'snippet' => mb_strimwidth(strip_tags($description), 0, 150, "..."),
			'date'          => $post['date'],
			'venue'         => $post['venue'],
			'event_image' => $event_image,
			'other_images' => $other_images,
			'published' => 1,
		];

		return $this->db->insert('events', $data);
	}


	public function update_event_in_db($id, $event_image, $other_images)
	{
		// Get POST data
		$post = $this->input->post(NULL, TRUE);

		$description = $post['description'];
		$caption = $post['caption'];
		$type = $post['type'];

		$data = [
			'type'       => $type,
			'caption'       => $caption,
			'description'   => $description,
			'slug'          => url_title($caption, 'dash', true),
			'snippet'       => mb_strimwidth(strip_tags($description), 0, 150, "..."),
			'date'          => $post['date'],
			'venue'         => $post['venue'],
			'event_image'   => $event_image,
			'other_images'  => $other_images,
		];

		// Perform the update
		$this->db->where('id', $id);
		return $this->db->update('events', $data);
	}


	public function increment_views($id)
	{
		$this->db->set('views', 'COALESCE(views,0) + 1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('events');

		return $this->db->affected_rows(); // Optional check
	}


	public function publish_event($id)
	{
		$data = array(
			'published' => 1,
		);
		$this->db->where('id', $id);
		return $this->db->update('events', $data);
	}


	public function unpublish_event($id)
	{
		$data = array(
			'published' => 0,
		);
		$this->db->where('id', $id);
		return $this->db->update('events', $data);
	}


	public function delete_event($id)
	{
		// Get the event details first to find the filenames
		$event = $this->get_event_details($id);

		// Make sure the event exists before trying to delete files
		if ($event) {
			$upload_path = './assets/uploads/events/'; // Define path

			// Delete the single featured image if it exists
			if (!empty($event->event_image) && file_exists($upload_path . $event->event_image)) {
				unlink($upload_path . $event->event_image);
			}

			// 4. Delete all other images
			if (!empty($event->other_images)) {
				// Convert the comma-separated string into an array of filenames
				$other_images = explode(',', $event->other_images);

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
		return $this->db->delete('events', ['id' => $id]);
	}


	public function clear_events()
	{
		// Get all events from the database
		$all_events = $this->db->get('events')->result();

		// Loop through every event to delete its files
		foreach ($all_events as $event) {
			$upload_path = './assets/uploads/events/'; // Define path

			// Delete the event image
			if (!empty($event->event_image) && file_exists($upload_path . $event->event_image)) {
				unlink($upload_path . $event->event_image);
			}

			// Delete all other images
			if (!empty($event->other_images)) {
				$other_images = explode(',', $event->other_images);
				foreach ($other_images as $image) {
					$image_path = $upload_path . trim($image);
					if (!empty($image) && file_exists($image_path)) {
						unlink($image_path);
					}
				}
			}
		}

		// After all files are gone, truncate the table
		return $this->db->truncate('events');
	}


	public function bulk_actions_events($selected_rows)
	{
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);

		if (is_array($selected_rows)) {
			foreach ($selected_rows as $id) {
				switch ($bulk_action_type) {
					case 'publish':
						$this->publish_event($id);
						break;
					case 'unpublish':
						$this->unpublish_event($id);
						break;
					case 'delete':
						$this->delete_event($id);
						break;
				}
			}

			// Set the flash message using count of the selected rows
			$action_message = match ($bulk_action_type) {
				'publish' => 'Events published successfully.',
				'unpublish' => 'Events unpublished successfully.',
				'delete' => 'Events deleted successfully.',
				default => 'action completed successfully.'
			};

			$this->session->set_flashdata('status_msg', count($selected_rows) . " " . $action_message);
		} else {
			$this->session->set_flashdata('status_msg_error', 'No Event selected for bulk action.');
		}
	}
}
