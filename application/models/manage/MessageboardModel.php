<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MessageboardModel extends MY_Model {

	public function __construct(){
	   parent::__construct();
	}  	
	
	function getSingleList($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select('*');
			$this->db->from($table);
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
		
			$this->db->select('mb.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
			$this->db->from($table.' mb');
			$this->db->join('comm_admin cm', 'cm.admin_id = mb.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = mb.edit_by','left');
			if(count($filter)>0){
				$this->db->where($filter);
			} 
			$this->db->order_by('mb.order_preference','asc');
			$query = $this->db->get();      
		
			if($query->num_rows()>0){	//print_r($this->db->last_query());
				return $query->result_array();
				
			}
		}//end check condition		
		return array();
		
	}// end getAllList function
			

}//end class