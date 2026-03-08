<?php
defined('BASEPATH') or die('Direct access not allowed');


/* ===== Documentation =====
Name: Admin_leads
Role: Controller
Description: Controls access to leads pages and functions in admin panel
Models: leads_model, leads_model_ajax
Author: Sylvester Esso Nmakwe
Date Created: 25th July, 2023
*/



class Admin_leads extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->admin_restricted(); //allow only logged in users to access this class
        $this->load->model('leads_model');
        $this->admin_details = $this->common_model->get_admin_details($this->session->email);
    }



    public function index()
    {
        $inner_page_title = 'leads (' . $this->leads_model->count_leads() . ')';
        $this->admin_header('leads', $inner_page_title);
        $data['total_records'] = $this->leads_model->count_leads();
        $this->load->view('admin/leads/all_leads', $data);
        $this->admin_footer();
    }


    public function leads_ajax()
    {
        $this->load->model('ajax/leads/leads_model_ajax', 'current_model');
        $list = $this->current_model->get_records();
        $data = array();
        foreach ($list as $y) {

            $row = array();
            $row[] = checkbox_bulk_action($y->id);
            $row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
            $row[] = $y->fullname;
            $row[] = $y->email;
            $row[] = $y->phone;
            $row[] = $y->ebook_requested;
            $row[] = x_date($y->date_added);
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->current_model->count_all_records(),
            "recordsFiltered" => $this->current_model->count_filtered_records(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function delete_leads($id)
    {
        //check leads exists
        $this->check_data_exists($id, 'id', 'leads', 'admin');
        $this->leads_model->delete_leads($id);
        $this->session->set_flashdata('status_msg', 'leads deleted successfully.');
        redirect($this->agent->referrer());
    }


    public function bulk_actions_leads()
    {
        $this->form_validation->set_rules('check_bulk_action', 'Bulk Select', 'trim');
        $selected_rows = $this->input->post('check_bulk_action', TRUE);

        // Check if selected_rows is an array before counting
        if (is_array($selected_rows)) {
            $selected_rows_count = count($selected_rows);
        } else {
            $selected_rows_count = 0;
        }

        if ($this->form_validation->run()) {
            if ($selected_rows_count > 0) {
                $this->leads_model->bulk_actions_leads($selected_rows);
            } else {
                $this->session->set_flashdata('status_msg_error', 'No item selected.');
            }
        } else {
            $this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
        }
        redirect($this->agent->referrer());
    }
}
