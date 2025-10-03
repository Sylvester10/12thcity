<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation ===== 
Name: brochures_model
Role: Model
Description: Controls the DB processes of brochures from admin panel
Controller: brochures
Author: Sylvester Nmakwe
Date Created: 10th January, 2023
*/




class brochures_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('profile_model');
    }




    public function get_brochure_details($id)
    {
        return $this->db->get_where('brochures', array('id' => $id))->row();
    }


    public function get_recent_published_brochures($limit)
    { //recent blog for homepage and sidebar
        $this->db->order_by('date_created', 'DESC');
        $this->db->limit($limit);
        return $this->db->get_where('brochures', array('published' => 'true'))->result();
    }


    public function get_published_upcoming_brochures($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date_created", "ASC"); //order by date_unix ASC so that the dates appear chronologically
        $date_unix_today = date('Ymd');
        $where = array(
            'published' => 'true',
            'date_created >=' => $date_unix_today, //ensure brochure date is not in the past
        );
        $this->db->where($where);
        $query = $this->db->get('brochures');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function count_upcoming_brochures()
    {
        $date_unix_today = date('Ymd');
        $where = array(
            'date_unix >=' => $date_unix_today, //ensure brochure date is not in the past
        );
        $this->db->where($where);
        return $this->db->get('brochures')->num_rows();
    }


    /* =========== All brochures ============== */
    public function get_brochures($limit)
    { //get all brochures
        $this->db->order_by('date_created', 'DESC');
        $this->db->limit($limit);
        return $this->db->get_where('brochures')->result();
    }


    public function get_brochures_list($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date_created", "DESC"); //order by date_created DESC so that the dates appear chronologically
        $query = $this->db->get_where('brochures');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function get_published_brochures_list($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date_created", "DESC"); //order by date_unix ASC so that the dates appear chronologically
        $query = $this->db->get_where('brochures');
        $where = array(
            'published' => 'true', //Ensure brochure has been published
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


    public function count_brochures()
    {
        return $this->db->get_where('brochures')->num_rows();
    }


    public function count_published_brochures()
    {
        return $this->db->get_where('brochures', array('published' => 'true'))->num_rows();
    }


    public function count_unpublished_brochures()
    {
        return $this->db->get_where('brochures', array('published' => 'false'))->num_rows();
    }


    /* ========== Admin Actions: brochures ============= */
    public function add_brochure($featured_image, $thumbnail, $brochure_file)
    {

        $title = ucwords($this->input->post('title', TRUE));
        $location = ucwords($this->input->post('location', TRUE));
        $description = nl2br(ucfirst($this->input->post('description', TRUE)));
        $snippet = mb_strimwidth(strip_tags($description), 0, 150, "...");

        $data = array(
            'title' => $title,
            'location' => $location,
            'description' => $description,
            'snippet' => $snippet,
            'featured_image' => $featured_image,
            'featured_image_thumb' => $thumbnail,
            'brochure_file' => $brochure_file,
            'published' => 'true',
        );
        return $this->db->insert('brochures', $data);
    }


    public function edit_brochure($id, $featured_image, $thumbnail, $brochure_file)
    {

        $title = ucwords($this->input->post('title', TRUE));
        $location = ucwords($this->input->post('location', TRUE));
        $description = nl2br(ucfirst($this->input->post('description', TRUE)));
        $snippet = mb_strimwidth(strip_tags($description), 0, 150, "...");

        $data = array(
            'title' => $title,
            'location' => $location,
            'description' => $description,
            'snippet' => $snippet,
            'featured_image' => $featured_image,
            'featured_image_thumb' => $thumbnail,
            'brochure_file' => $brochure_file,
            'published' => 'true',
        );
        $this->db->where('id', $id);
        return $this->db->update('brochures', $data);
    }


    public function publish_brochure($id)
    {
        $data = array(
            'published' => 'true',
        );
        $this->db->where('id', $id);
        return $this->db->update('brochures', $data);
    }


    public function unpublish_brochure($id)
    {
        $data = array(
            'published' => 'false',
        );
        $this->db->where('id', $id);
        return $this->db->update('brochures', $data);
    }


    public function delete_brochure_featured_images($id)
    {
        $y = $this->get_brochure_details($id);
        $featured_images = $y->featured_image;
        $featured_images_thumb = $y->featured_image_thumb;
        $folder = "./assets/uploads/brochures/";

        $this->delete_file($featured_images, $folder);
        $this->delete_file($featured_images_thumb, $folder);
    }


    public function delete_brochure_brochure($id)
    {
        $y = $this->get_brochure_details($id);
        $brochure = $y->brochure_file;
        $folder = "./assets/uploads/brochures/";

        $this->delete_file($brochure, $folder);
    }


    public function delete_file($files, $folder)
    {
        if (is_string($files)) {
            $files = explode(',', $files);
            foreach ($files as $file) {
                $file = trim($file);
                $file = $folder . $file;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            return true;
        } else {
            return false;
        }
    }


    public function delete_brochure($id)
    {
        $y = $this->get_brochure_details($id);
        //$this->delete_brochures_featured_image($id); //remove image files from server
        return $this->db->delete('brochures', array('id' => $id));
    }


    public function clear_brochures()
    {
        return $this->db->truncate('brochures');
    }


    public function bulk_actions_brochures()
    {
        $selected_rows = count($this->input->post('check_bulk_action', TRUE));
        $bulk_action_type = $this->input->post('bulk_action_type', TRUE);
        $row_id = $this->input->post('check_bulk_action', TRUE);
        $brochures = ($selected_rows == 1) ? 'brochure' : 'brochures';
        foreach ($row_id as $id) {
            switch ($bulk_action_type) {
                case 'publish':
                    $this->publish_brochure($id);
                    $this->session->set_flashdata('status_msg', "{$selected_rows} {$brochures} published successfully.");
                    break;
                case 'unpublish':
                    $this->unpublish_brochure($id);
                    $this->session->set_flashdata('status_msg', "{$selected_rows} {$brochures} unpublished successfully.");
                    break;
                case 'delete':
                    $this->delete_brochure($id);
                    $this->session->set_flashdata('status_msg', "{$selected_rows} {$brochures} deleted successfully.");
                    break;
            }
        }
    }
}
