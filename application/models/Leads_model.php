<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/* ===== Documentation =====
Name: leads_model
Role: Model
Description: Controls the DB processes of leads from admin panel
Controller: leads
Author: Sylvester Nmakwe
Date Created: 10th January, 2023
*/




class Leads_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'leads';
        $this->primary_cols = array('id');
    }



    /* =========== All leads ============== */
    public function get_leads($limit)
    { //get all leads
        $this->db->order_by('date_added', 'DESC');
        $this->db->limit($limit);
        return $this->db->get_where('leads')->result();
    }


    public function get_leads_list($limit, $offset)
    {
        $this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
        $this->db->order_by("date_added", "desc"); //order by date DESC so that the dates appear chronologically
        $query = $this->db->get_where('leads');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function get_leads_details_by_id($id)
    { //get leads details by id
        return $this->db->get_where('leads', array('id' => $id))->row();
    }


    public function count_leads()
    {
        return $this->db->get_where('leads')->num_rows();
    }


    public function add_lead_to_db()
    {
        // Prepare data for insertion
        $data = extractKeys($this->input->post(), $this->getColumns());
        $post = $this->input->post(NULL, TRUE); // With XSS filtering

        $data = [
            'fullname'        => $post['fullname'],
            'email'           => $post['email'],
            'phone'           => $post['phone'],
            'ebook_requested' => $post['ebook_requested'] // <-- You missed this line
        ];

        return $this->db->insert('leads', $data);
    }


    public function delete_leads($id)
    { // delete the database record
        return $this->db->delete('leads', ['id' => $id]);
    }


    public function bulk_actions_leads($selected_rows)
    {
        $bulk_action_type = $this->input->post('bulk_action_type', TRUE);

        if (is_array($selected_rows)) {
            foreach ($selected_rows as $id) {
                switch ($bulk_action_type) {
                    case 'delete':
                        $this->delete_leads($id);
                        break;
                }
            }

            // Set the flash message using count of the selected rows
            $action_message = match ($bulk_action_type) {
                'delete' => 'leads deleted successfully.',
                default => 'action completed successfully.'
            };

            $this->session->set_flashdata('status_msg', count($selected_rows) . " " . $action_message);
        } else {
            $this->session->set_flashdata('status_msg_error', 'No leads selected for bulk action.');
        }
    }
}
