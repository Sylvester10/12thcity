<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation ===== 
Name: Award_model
Role: Model
Description: Controls the DB processes of awards from admin panel
Controller: Awards
Author: Sylvester Nmakwe
Date Created: 10th January, 2023
*/




class Awards_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'awards';
        $this->load->model('common_model');
        $this->primary_cols = array('id');
    }




    public function get_award_details($id)
    {
        return $this->db->get_where('awards', array('id' => $id))->row();
    }

    public function get_award_details_by_slug($slug)
    {
        return $this->db->get_where('awards', array('slug' => $slug))->row();
    }


    public function get_recent_published_awards($limit)
    { //recent blog for homepage and sidebar
        $this->db->order_by('date_added', 'DESC');
        $this->db->limit($limit);
        return $this->db->get_where('awards', array('published' => 1))->result();
    }



    /* =========== All awards ============== */
    public function get_awards($limit)
    { //get all awards
        $this->db->order_by('date_added', 'DESC');
        $this->db->limit($limit);
        return $this->db->get_where('awards')->result();
    }


    public function get_award_list($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date_added", "desc"); //order by date DESC so that the dates appear chronologically
        $query = $this->db->get_where('awards');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_published_awards($limit)
    { //get all awards
        $this->db->where('published', 1);
        $this->db->order_by('date_added', 'DESC');
        $this->db->limit($limit);
        return $this->db->get_where('awards')->result();
    }


    public function get_published_award_list($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date_added", "DESC"); //order by date_unix ASC so that the dates appear chronologically
        $query = $this->db->get_where('awards');
        $where = array(
            'published' => 1, //Ensure awards has been published
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


    public function get_award_details_by_id($id)
    { //get awards details by id
        return $this->db->get_where('awards', array('id' => $id))->row();
    }


    public function count_awards()
    {
        return $this->db->get_where('awards')->num_rows();
    }


    public function count_published_awards()
    {
        return $this->db->get_where('awards', array('published' => 1))->num_rows();
    }


    public function count_unpublished_awards()
    {
        return $this->db->get_where('awards', array('published' => 0))->num_rows();
    }


    public function add_award_to_db($award_photo)
    {
        // Prepare data for insertion
        $data = extractKeys($this->input->post(), $this->getColumns());
        $post = $this->input->post(NULL, TRUE); // With XSS filtering
        $description = $post['description']; // Store as is

        $data = [
            'title'        => $post['title'],
            'description' => $description,
            'award_photo' => $award_photo,
        ];

        return $this->db->insert('awards', $data);
    }


    public function update_award_in_db($id, $award_photo)
    {
        $post = $this->input->post(NULL, TRUE); // With XSS filtering
        $description = $post['description']; // Store as is

        $data = [
            'title'        => $post['title'],
            'description' => $description,
            'award_photo' => $award_photo,
        ];

        // Perform the update
        $this->db->where('id', $id);
        return $this->db->update('awards', $data);
    }


    public function publish_award($id)
    {
        $data = array(
            'published' => 1,
        );
        $this->db->where('id', $id);
        return $this->db->update('awards', $data);
    }


    public function unpublish_award($id)
    {
        $data = array(
            'published' => 0,
        );
        $this->db->where('id', $id);
        return $this->db->update('awards', $data);
    }


    public function delete_award($id)
    {
        // Get the awards details first to find the filenames
        $awards = $this->get_award_details($id);

        // Make sure the awards exists before trying to delete files
        if ($awards) {
            $upload_path = './assets/uploads/awards/'; // Define path

            // Delete the single featured image if it exists
            if (!empty($awards->award_photo) && file_exists($upload_path . $awards->award_photo)) {
                unlink($upload_path . $awards->award_photo);
            }
        }

        // delete the database record
        return $this->db->delete('awards', ['id' => $id]);
    }


    public function bulk_actions_awards($selected_rows)
    {
        $bulk_action_type = $this->input->post('bulk_action_type', TRUE);

        if (is_array($selected_rows)) {
            foreach ($selected_rows as $id) {
                switch ($bulk_action_type) {
                    case 'publish':
                        $this->publish_award($id);
                        break;
                    case 'unpublish':
                        $this->unpublish_award($id);
                        break;
                    case 'delete':
                        $this->delete_award($id);
                        break;
                }
            }

            // Set the flash message using count of the selected rows
            $action_message = match ($bulk_action_type) {
                'publish' => 'Awards published successfully.',
                'unpublish' => 'Awards unpublished successfully.',
                'delete' => 'Awards deleted successfully.',
                default => 'action completed successfully.'
            };

            $this->session->set_flashdata('status_msg', count($selected_rows) . " " . $action_message);
        } else {
            $this->session->set_flashdata('status_msg_error', 'No awards selected for bulk action.');
        }
    }
}
