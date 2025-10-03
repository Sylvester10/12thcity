<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class Common_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}



	/* ===== Last Login ===== */
	public function update_last_login($user_id, $table)
	{
		$data = array(
			'last_login' => date('Y-m-d H:i:s'), //current timestamp	 
		);
		$this->db->where('id', $user_id);
		return $this->db->update($table, $data);
	}


	public function get_last_login_stats($period, $period_type, $table)
	{
		$period_type = strtoupper($period_type);
		$where = 	"last_login IS NOT NULL AND 
					last_login > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL {$period} {$period_type})";
		$this->db->where($where);
		$query = $this->db->get($table)->num_rows();
		return $query;
	}


	/* =================== Admins ====================== */
	public function get_admin_details($email)
	{ //get admin info by email
		return $this->db->get_where('admins', array('email' => $email))->row();
	}


	public function get_admin_details_by_id($id)
	{ //get admin info	id
		return $this->db->get_where('admins', array('id' => $id))->row();
	}


	public function get_admins()
	{ //get all admins
		return $this->db->get_where('admins')->result();
	}


	/* =================== Staff ====================== */
	public function get_staff_details($email)
	{ //get staff info by email
		return $this->db->get_where('staff', array('email' => $email))->row();
	}


	public function get_staff_details_by_id($id)
	{ //get staff info	id
		return $this->db->get_where('staff', array('id' => $id))->row();
	}


	public function get_staff()
	{ //get all staff
		return $this->db->get_where('staff')->result();
	}


	public function get_activated_staff()
	{ //get all active staff
		return $this->db->get_where('staff', array('active' => 1))->result();
	}


	/* =================== Events ====================== */
	public function get_events_details($email)
	{ //get event info by email
		return $this->db->get_where('events', array('email' => $email))->row();
	}


	public function get_events_details_by_id($id)
	{ //get event info by id
		return $this->db->get_where('events', array('id' => $id))->row();
	}


	public function get_event()
	{ //get all events
		$this->db->order_by('date_added', 'DESC');
		return $this->db->get_where('events')->result();
	}


	public function get_events($limit)
	{ //get all events with page limit
		$this->db->order_by('date_added', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('events')->result();
	}


	/* =================== Project ====================== */
	public function get_project_details_by_id($id)
	{ //get project info by id
		return $this->db->get_where('projects', array('id' => $id))->row();
	}

	public function get_project()
	{ //get all project
		$this->db->order_by('date_added', 'DESC');
		return $this->db->get_where('projects')->result();
	}

	public function get_projects($limit)
	{ //get all project with page limit
		$this->db->order_by('date_added', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('projects')->result();
	}

	public function get_published_project($limit)
	{ //get all published project
		$this->db->limit($limit);
		return $this->db->get_where('projects', array('published' => 1))->result();
	}



	/* =================== Affiliates ====================== */
	public function get_affiliates()
	{ //get all affiliates
		$this->db->order_by('date_added', 'DESC');
		return $this->db->get_where('affiliates')->result();
	}


	public function get_affiliates_details_by_id($id)
	{ //get affiliate info by id
		return $this->db->get_where('affiliates', array('id' => $id))->row();
	}


	/* =================== Newsletters Subscribers ====================== */
	public function get_newsletters_subscribers()
	{ //get all locations
		$this->db->order_by('date_added', 'DESC');
		return $this->db->get_where('newsletter_subscribers')->result();
	}


	public function get_newsletters_subscribers_details_by_id($id)
	{ //get location info by id
		return $this->db->get_where('newsletter_subscribers', array('id' => $id))->row();
	}


	/* =================== brochures ====================== */
	public function get_brochure_details($email)
	{ //get property info by email
		return $this->db->get_where('brochures', array('email' => $email))->row();
	}


	public function get_brochure_details_by_id($id)
	{ //get property info by id
		return $this->db->get_where('brochures', array('id' => $id))->row();
	}


	public function get_brochures()
	{ //get all property
		$this->db->order_by('date_created', 'DESC');
		return $this->db->get_where('brochures')->result();
	}
	

	public function get_brochure($limit)
	{ //get all property with page limit
		$this->db->order_by('date_created', 'DESC');
		$this->db->limit($limit);
		return $this->db->get_where('brochures')->result();
	}


	public function get_published_brochures()
	{ //get all published property
		return $this->db->get_where('brochures', array('published' => 1))->result();
	}
}
