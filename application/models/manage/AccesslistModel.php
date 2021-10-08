<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccesslistModel extends MY_Model {

	public function __construct(){
		parent::__construct();
	}//end constructor
		
	function getSingleList($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select('ac.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name,REPLACE(TRIM(m.controller_name),"manage/","")as controller_name');
			$this->db->from($table.' ac');
			$this->db->join('comm_admin cm', 'cm.admin_id = ac.added_by','left');
			$this->db->join('menus m', 'm.id = ac.menu_id','left');
			$this->db->where($filter);
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	function getAllList($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('ac.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name,REPLACE(TRIM(m.controller_name),"manage/","")as controller_name');
			$this->db->from($table.' ac');
			$this->db->join('comm_admin cm', 'cm.admin_id = ac.added_by','left');
			$this->db->join('menus m', 'm.id = ac.menu_id','left');
			if(count($filter)>0){
				$this->db->where($filter);
			} 
			$query = $this->db->get();
						
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return FALSE;
		
	}// end getAllList function
	
	function checkAccessList($filter=array()){
		if(count($filter)==3){
			$sql = "SELECT ac.* FROM comm_auth_controller_function ac LEFT JOIN menus m on m.id = ac.menu_id WHERE lower(m.controller_name) = ? and FIND_IN_SET(?,lower(ac.auth_function_name)) and ac.status = ?";
		$query = $this->db->query($sql, $filter);
		
		    return $query->row();
		}else{
			return FALSE;
		}
		
	}//end checkAccessList function
	
}//end class