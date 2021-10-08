<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ConsultancyModel extends MY_Model
{

	public function __construct()
	{
		parent::__construct();
	} //end constructor

	function getSingleList($table, $filter = array())
	{

		if (trim($table) != "" && trim($table) != null && count($filter) > 0) {
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->row();
			}
		} //end check condition		
		return array();
	} // end getSingleList function

	function getAllList($table = "", $filter = array(), $orderBy = array())
	{

		if (trim($table) != "" && trim($table) != null) {
			$this->db->select('*');
			$this->db->from($table);
			if (count($filter) > 0) {
				$this->db->where($filter);
			}
			if (count($orderBy) > 0) {
				foreach ($orderBy as $key => $val) {
					$this->db->order_by($key, $val);
				}
			}
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		} //end check condition		
		return array();
	} // end getAllList function

	public function make_query($params = array(), $filter = array(), $orderBy = array(), $count_only = 0)
	{

		if ($count_only == 1) {
			$this->db->select('count(1) as total_row');
		} else {
			$this->db->select('um.*,st.state_name');
		}

		$this->db->from($params['table'] . ' um');
		$this->db->join('comm_state st', 'st.state_id = um.state','left');
	

		//filter data by searched keywords
		if (isset($params['search']['title']) && trim($params['search']['title']) != "") {
			$this->db->group_start() ;
			$this->db->like('um.consultancy_name', trim($params['search']['title']));
			$this->db->or_like('um.contact_name',trim($params['search']['title']));
			$this->db->or_like('um.emailid',trim($params['search']['title']));
			$this->db->group_end();
		}

		if (count($filter) > 0) {
			$this->db->where($filter);
		}


		if (count($orderBy) > 0) {
			foreach ($orderBy as $key => $val) {
				$this->db->order_by($key, $val);
			}
		}
	} //end make_query function

	public function make_datatable($params = array(), $filter = array(), $orderBy = array())
	{

		$this->make_query($params, $filter, $orderBy);
		//set start and limit
		if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
			$this->db->limit($params['limit'], $params['start']);
		} elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
			$this->db->limit($params['limit']);
		}
		$query = $this->db->get();
		//print_r($this->db->last_query());
		//exit;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return array();
	} //end make_datatables function  

	public function get_filtered_data($params = array(), $filter = array(), $orderBy = array())
	{
		$count_only = 1;
		$this->make_query($params, $filter, $orderBy, $count_only);
		$query = $this->db->get();
		//print_r($this->db->last_query());
		return ($query->num_rows() > 0) ? $query->row()->total_row : 0;
	} //end get_filtered_data function

}//end class Circular