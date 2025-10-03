<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===Project_model
Role: Model
Description: Controls the DB processes of Project from admin panel
Controller: Project
Author: Sylvester Nmakwe
Date Created: 10th January, 2023
*/




class Projects_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'projects';
		$this->load->model('common_model');
		$this->primary_cols = array('id');
	}




	//get all project
	public function get_projects()
	{
		$this->db->order_by('date_added', 'DESC');
		return $this->db->get_where('projects')->result();
	}


	public function get_project_details_by_slug($slug)
	{
		return $this->db->get_where('projects', array('slug' => $slug))->row();
	}


	//recent projects for project page with limit
	public function get_project_limit($limit)
	{
		$this->db->order_by('date_added', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('projects', array('published' => 1))->result();
	}


	//get all for homepage
	public function get_project_list($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_added", "DESC"); //order by date_created DESC so that the dates appear chronologically
		$query = $this->db->get_where('projects');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function get_project_details_by_id($id)
	{ //get project info by id
		return $this->db->get_where('projects', array('id' => $id))->row();
	}


	public function get_project()
	{ //get all project
		$this->db->order_by('date_added', 'DESC');
		return $this->db->get_where('projects')->result();
	}


	public function get_published_project()
	{ //get all published project
		return $this->db->get_where('projects', array('published' => 1))->result();
	}


	public function get_published_project_in_abuja()
	{ //get published projects list in abuja
		$this->db->where("state", "abuja");
		$this->db->where("published", 1);
		$query = $this->db->get_where('projects');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function get_published_project_in_ph()
	{ //get published projects list in ph
		$this->db->where("state", "ph");
		$this->db->where("published", 1);
		$query = $this->db->get_where('projects');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	//get project list in lugbe
	public function get_project_list_in_lugbe($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->where("lga", "lugbe");
		$this->db->order_by("date_added", "DESC"); //order by date_created DESC so that the dates appear chronologically
		$query = $this->db->get_where('projects');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	//get project list in guzape
	public function get_project_list_in_guzape($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->where("lga", "guzape");
		$this->db->where("published", "true");
		$this->db->order_by("date_added", "DESC"); //order by date_created DESC so that the dates appear chronologically
		$query = $this->db->get_where('projects');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	//get project list in mbora
	public function get_project_list_in_mbora($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->where("lga", "mbora");
		$this->db->where("published", "true");
		$this->db->order_by("date_added", "DESC"); //order by date_created DESC so that the dates appear chronologically
		$query = $this->db->get_where('projects');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	//get project list in kuje
	public function get_project_list_in_kuje($limit, $offset)
	{
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->where("lga", "kuje");
		$this->db->where("published", "true");
		$this->db->order_by("date_added", "DESC"); //order by date_created DESC so that the dates appear chronologically
		$query = $this->db->get_where('projects');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	//get project details by id
	public function get_project_details($id)
	{
		return $this->db->get_where('projects', array('id' => $id))->row();
	}


	//get all available project
	public function get_available_project()
	{
		$this->db->where('availability', 1);
		return $this->db->get_where('projects')->result();
	}


	//get all published project in idu
	public function get_published_project_in_idu()
	{
		$this->db->where(array('lga' => 'idu', 'published' => 1));
		return $this->db->get_where('projects')->result();
	}


	//get all published project in lugbe
	public function get_published_project_in_lugbe()
	{
		$this->db->where(array('lga' => 'lugbe', 'published' => 1));
		return $this->db->get_where('projects')->result();
	}


	//get all published project in guzape
	public function get_published_project_in_guzape()
	{
		$this->db->where(array('lga' => 'guzape', 'published' => 1));
		return $this->db->get_where('projects')->result();
	}


	//get all published project in mbora
	public function get_published_project_in_mbora()
	{
		$this->db->where(array('lga' => 'mbora', 'published' => 1));
		return $this->db->get_where('projects')->result();
	}


	//get all published project in kuje
	public function get_published_project_in_kuje()
	{
		$this->db->where(array('lga' => 'kuje', 'published' => 1));
		return $this->db->get_where('projects')->result();
	}


	//count all projects
	public function count_projects()
	{
		return $this->db->get_where('projects')->num_rows();
	}


	//count all projects in idu
	public function count_projects_in_idu()
	{
		return $this->db->get_where('projects', array('lga' => 'idu'))->num_rows();
	}

	public function count_published_projects_in_idu()
	{
		return $this->db->get_where('projects', array('lga' => 'idu', 'published' => 1))->num_rows();
	}


	//count all projects in lugbe
	public function count_projects_in_lugbe()
	{
		return $this->db->get_where('projects', array('lga' => 'lugbe'))->num_rows();
	}

	public function count_published_projects_in_lugbe()
	{
		return $this->db->get_where('projects', array('lga' => 'lugbe', 'published' => 1))->num_rows();
	}


	//count all projects in guzape
	public function count_projects_in_guzape()
	{
		return $this->db->get_where('projects', array('lga' => 'guzape'))->num_rows();
	}


	public function count_published_projects_in_guzape()
	{
		return $this->db->get_where('projects', array('lga' => 'guzape', 'published' => 1))->num_rows();
	}


	//count all projects in mbora
	public function count_projects_in_mbora()
	{
		return $this->db->get_where('projects', array('lga' => 'mbora'))->num_rows();
	}


	public function count_published_projects_in_mbora()
	{
		return $this->db->get_where('projects', array('lga' => 'mbora', 'published' => 1))->num_rows();
	}


	//count all projects in kuje
	public function count_projects_in_kuje()
	{
		return $this->db->get_where('projects', array('lga' => 'kuje'))->num_rows();
	}

	public function count_published_projects_in_kuje()
	{
		return $this->db->get_where('projects', array('lga' => 'kuje', 'published' => 1))->num_rows();
	}




	//count published projects
	public function count_published_project()
	{
		return $this->db->get_where('projects', array('published' => 1))->num_rows();
	}


	//add project
	public function add_project_to_db($featured_image, $other_images)
	{
		// Prepare data for insertion
		$data = extractKeys($this->input->post(), $this->getColumns());
		$post = $this->input->post(NULL, TRUE); // Keep XSS filtering

		$title = $post['title'];

		$data = [
			'title'          => $title,
			'description'    => $post['description'],
			'state'          => $post['state'],
			'location'       => $post['location'],
			'address'        => $post['address'],
			'livingrooms'    => $post['livingrooms'],
			'bedrooms'       => $post['bedrooms'],
			'bathrooms'      => $post['bathrooms'],
			'size'           => $post['size'],
			'parking'        => $post['parking'],
			'elevator'       => $post['elevator'],
			'wifi'           => $post['wifi'],
			'amenities'      => ucwords(implode(", ", $post['amenities'])),
			'video'          => $post['video'],
			'featured_image' => $featured_image,
			'other_images'   => $other_images,
			'slug'           => url_title($title, 'dash', true),
			'published'      => 1,
		];

		return $this->db->insert('projects', $data);
	}


	//edit project
	public function update_project_in_db($id, $featured_image, $other_images)
	{
		// Prepare data for insertion
		$data = extractKeys($this->input->post(), $this->getColumns());
		$post = $this->input->post(NULL, TRUE); // Keep XSS filtering

		$title = $post['title'];

		$data = [
			'title'          => $title,
			'description'    => $post['description'],
			'state'          => $post['state'],
			'location'       => $post['location'],
			'address'        => $post['address'],
			'livingrooms'    => $post['livingrooms'],
			'bedrooms'       => $post['bedrooms'],
			'bathrooms'      => $post['bathrooms'],
			'size'           => $post['size'],
			'parking'        => $post['parking'],
			'elevator'       => $post['elevator'],
			'wifi'           => $post['wifi'],
			'amenities'      => implode(',', $post['amenities']),
			'video'          => $post['video'],
			'featured_image' => $featured_image,
			'other_images'   => $other_images,
			'slug'           => url_title($title, 'dash', true),
			'published'      => 1,
		];

		// Perform the update
		$this->db->where('id', $id);
		return $this->db->update('projects', $data);
	}


	//publish project
	public function publish_project($id)
	{
		$data = array(
			'published' => 1,
		);
		$this->db->where('id', $id);
		return $this->db->update('projects', $data);
	}


	//unpublish project
	public function unpublish_project($id)
	{
		$data = array(
			'published' => 0,
		);
		$this->db->where('id', $id);
		return $this->db->update('projects', $data);
	}


	public function delete_project($id)
	{
		// Get the project details first to find the filenames
		$project = $this->get_project_details($id);

		// Make sure the project exists before trying to delete files
		if ($project) {
			$upload_path = './assets/uploads/projects/'; // Define path

			// Delete the single featured image if it exists
			if (!empty($project->project_image) && file_exists($upload_path . $project->project_image)) {
				unlink($upload_path . $project->project_image);
			}

			// 4. Delete all other images
			if (!empty($project->other_images)) {
				// Convert the comma-separated string into an array of filenames
				$other_images = explode(',', $project->other_images);

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
		return $this->db->delete('projects', ['id' => $id]);
	}


	public function bulk_actions_projects($selected_rows)
	{
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);

		if (is_array($selected_rows)) {
			foreach ($selected_rows as $id) {
				switch ($bulk_action_type) {
					case 'publish':
						$this->publish_project($id);
						break;
					case 'unpublish':
						$this->unpublish_project($id);
						break;
					case 'delete':
						$this->delete_project($id);
						break;
				}
			}

			// Set the flash message using count of the selected rows
			$action_message = match ($bulk_action_type) {
				'publish' => 'Projects published successfully.',
				'unpublish' => 'Projects unpublished successfully.',
				'delete' => 'Projects deleted successfully.',
				default => 'Action completed successfully.'
			};

			$this->session->set_flashdata('status_msg', count($selected_rows) . " " . $action_message);
		} else {
			$this->session->set_flashdata('status_msg_error', 'No Project selected for bulk action.');
		}
	}
}
