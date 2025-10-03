<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Events_model_ajax extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('events_model');
    }

    var $table = 'events';
    var $column_order = array(null, 'type', 'caption', 'description', 'snippet', 'slug', 'date', 'venue', 'featured_image', 'featured_image_thumb', 'published', 'date_added'); //set column field database for datatable orderable
    var $column_search = array('type', 'caption', 'description', 'snippet', 'slug', 'date', 'venue', 'featured_image', 'featured_image_thumb', 'published', 'date_added'); //set column field database for datatable searchable 
    var $order = array('date' => 'desc');


    private function the_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing 
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    function get_records()
    {
        $this->the_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


    function count_filtered_records()
    {
        $this->the_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_all_records()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    public function actions($id)
    {
        $this->events_model->get_event_details_by_id($id);
        $y = $this->events_model->get_event_details_by_id($id);

        if ($y->published == 0) {

            $publish_action = '<p><a type="button" href="' . base_url('admin_events/publish_event/' . $y->id) . '" class="btn btn-default btn-sm btn-block action-btn clickable"> <i class="fa fa-check" style="color: green"></i> &nbsp; Publish Event </a></p>';
            
            
        } else {
            
            $publish_action = '<p><a type="button" href="' . base_url('admin_events/unpublish_event/' . $y->id) . '" class="btn btn-default btn-sm btn-block action-btn clickable"> <i class="fa fa-eye-slash" style="color: red"></i> &nbsp; Unpublish Event </a></p>';
        }

        return ' ' . $publish_action . '

		<p><a type="button" href="' . base_url('admin-update-event/' . $y->id) . '" class="btn btn-default btn-sm btn-block action-btn clickable"> <i class="fa fa-edit" style="color: green"></i> &nbsp; Update Event </a></p>

		<p><a type="button" href="#" class="btn btn-default btn-sm btn-block action-btn clickable" data-toggle="modal" data-target="#delete' . $y->id . '"> <i class="fa fa-trash" style="color: red"></i> &nbsp; Delete </a></p>';
    }


    public function options($id)
    {

        return '<div class="text-center"><a type="button" href="#" class="btn btn-primary btn-sm modal-toggle-btn clickable" data-toggle="modal" data-target="#options' . $id . '" title="Options"> <i class="fa fa-navicon"></i> </a></div>';
    }


    public function modal_options($id)
    {
        $y = $this->events_model->get_event_details_by_id($id);
        return '<div class="modal fade" id="options' . $y->id . '" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content modal-width">
					<div class="modal-header">
						<div class="pull-right">
							<button class="btn btn-danger btn-sm modal_close_btn" data-dismiss="modal" class="close" title="Close"> &times;</button>
						</div>
						<h4 class="modal-title">Actions: ' . $y->caption . '</h4>
					</div><!--/.modal-header-->
					<div class="modal-body">'
                        . $this->actions($id) .
                    '</div>
				</div>
			</div>
		</div>
        
        <div class="modal fade" id="clear_events" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="pull-right">
                            <button class="btn btn-danger btn-sm modal_close_btn" data-dismiss="modal" class="close" title="Close"> &times;</button>
                        </div>
                        <h4 class="modal-title">Clear Events</h4>
                    </div><!--/.modal-header-->
                    <div class="modal-body">
                        Are you sure you want to clear all events? This action will delete all the records. <br />
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-sm btn-danger" role="button" href="' . base_url('admin_events/clear_events') . '"> Yes, Clear All </a>
                        <button data-dismiss="modal" class="btn btn-sm"> No, Cancel </button>
                    </div>
                </div>
            </div>
        </div>';
    }


    public function modals($id)
    {
        $y = $this->events_model->get_event_details_by_id($id);
        $modal_delete_confirm = modal_delete_confirm($id, $y->caption, 'events', 'admin_events/delete_event');
        return     $this->modal_options($id) .
            $modal_delete_confirm;
    }
}
