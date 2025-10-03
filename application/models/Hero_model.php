<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation ===== 
Name: hero_model
Role: Model
Description: Controls the DB processes of hero from admin panel
Controller: hero
Author: Sylvester Nmakwe
Date Created: 10th January, 2023
*/




class Hero_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'hero';
        $this->load->model('common_model');
        $this->primary_cols = array('id');
    }




    public function get_hero_details($id)
    {
        return $this->db->get_where('hero', array('id' => $id))->row();
    }


    public function get_hero_details_by_slug($slug)
    {
        return $this->db->get_where('hero', array('slug' => $slug))->row();
    }


    public function get_recent_published_hero($limit)
    { //recent blog for homepage and sidebar
        $this->db->order_by('date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get_where('hero', array('published' => 1))->result();
    }


    public function get_published_upcoming_hero($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date", "ASC"); //order by date_unix ASC so that the dates appear chronologically
        $date_unix_today = date('Ymd');
        $where = array(
            'published' => 1,
            'date >=' => $date_unix_today, //ensure hero date is not in the past
        );
        $this->db->where($where);
        $query = $this->db->get('hero');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function count_upcoming_hero()
    {
        $date_unix_today = date('Ymd');
        $where = array(
            'date_unix >=' => $date_unix_today, //ensure hero date is not in the past
        );
        $this->db->where($where);
        return $this->db->get('hero')->num_rows();
    }


    public function count_published_upcoming_hero()
    {
        $where = array(
            'published' => 1,
        );
        $this->db->where($where);
        return $this->db->get('hero')->num_rows();
    }


    public function count_unpublished_upcoming_hero()
    {
        $date_unix_today = date('Ymd');
        $where = array(
            'published' => 0,
            'date_unix >=' => $date_unix_today, //ensure hero date is not in the past
        );
        $this->db->where($where);
        return $this->db->get('hero')->num_rows();
    }



    /* =========== All hero ============== */
    public function get_hero($limit)
    { //get all hero
        $this->db->order_by('date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get_where('hero')->result();
    }


    public function get_hero_list($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date", "asc"); //order by date DESC so that the dates appear chronologically
        $query = $this->db->get_where('hero');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function get_published_hero_list($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date", "DESC"); //order by date_unix ASC so that the dates appear chronologically
        $query = $this->db->get_where('hero');
        $where = array(
            'published' => 1, //Ensure hero has been published
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


    public function get_hero_details_by_id($id)
    { //get traveller details by id
        return $this->db->get_where('hero', array('id' => $id))->row();
    }


    public function count_hero()
    {
        return $this->db->get_where('hero')->num_rows();
    }


    public function count_published_hero()
    {
        return $this->db->get_where('hero', array('published' => 1))->num_rows();
    }


    public function count_unpublished_hero()
    {
        return $this->db->get_where('hero', array('published' => 0))->num_rows();
    }


    public function add_hero_to_db($first_hero_image, $second_hero_image)
    {
        // collect other posted fields if needed
        $data = extractKeys($this->input->post(), $this->getColumns());

        // merge images into data
        $data['first_image']  = $first_hero_image;
        $data['second_image'] = $second_hero_image;

        return $this->db->insert('hero', $data);
    }


    public function increment_views($id)
    {
        $this->db->set('views', 'COALESCE(views,0) + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('hero');

        return $this->db->affected_rows(); // Optional check
    }


    public function publish_hero($id)
    {
        $data = array(
            'published' => 1,
        );
        $this->db->where('id', $id);
        return $this->db->update('hero', $data);
    }


    public function unpublish_hero($id)
    {
        $data = array(
            'published' => 0,
        );
        $this->db->where('id', $id);
        return $this->db->update('hero', $data);
    }


    public function delete_hero($id)
    {
        // Get the hero details first to find the filenames
        $hero = $this->get_hero_details($id);

        // Make sure the hero exists before trying to delete files
        if ($hero) {
            $upload_path = './assets/uploads/hero/'; // Define path

            // Delete the single featured image if it exists
            if (!empty($hero->hero_image) && file_exists($upload_path . $hero->hero_image)) {
                unlink($upload_path . $hero->hero_image);
            }

            // 4. Delete all other images
            if (!empty($hero->other_images)) {
                // Convert the comma-separated string into an array of filenames
                $other_images = explode(',', $hero->other_images);

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
        return $this->db->delete('hero', ['id' => $id]);
    }


    public function clear_hero()
    {
        // Get all hero from the database
        $all_hero = $this->db->get('hero')->result();

        // Loop through every hero to delete its files
        foreach ($all_hero as $hero) {
            $upload_path = './assets/uploads/hero/'; // Define path

            // Delete the hero image
            if (!empty($hero->hero_image) && file_exists($upload_path . $hero->hero_image)) {
                unlink($upload_path . $hero->hero_image);
            }

            // Delete all other images
            if (!empty($hero->other_images)) {
                $other_images = explode(',', $hero->other_images);
                foreach ($other_images as $image) {
                    $image_path = $upload_path . trim($image);
                    if (!empty($image) && file_exists($image_path)) {
                        unlink($image_path);
                    }
                }
            }
        }

        // After all files are gone, truncate the table
        return $this->db->truncate('hero');
    }


    public function bulk_actions_hero($selected_rows)
    {
        $bulk_action_type = $this->input->post('bulk_action_type', TRUE);

        if (is_array($selected_rows)) {
            foreach ($selected_rows as $id) {
                switch ($bulk_action_type) {
                    case 'publish':
                        $this->publish_hero($id);
                        break;
                    case 'unpublish':
                        $this->unpublish_hero($id);
                        break;
                    case 'delete':
                        $this->delete_hero($id);
                        break;
                }
            }

            // Set the flash message using count of the selected rows
            $action_message = match ($bulk_action_type) {
                'publish' => 'hero published successfully.',
                'unpublish' => 'hero unpublished successfully.',
                'delete' => 'hero deleted successfully.',
                default => 'action completed successfully.'
            };

            $this->session->set_flashdata('status_msg', count($selected_rows) . " " . $action_message);
        } else {
            $this->session->set_flashdata('status_msg_error', 'No hero selected for bulk action.');
        }
    }
}
