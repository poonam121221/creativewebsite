<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactcategoryModel extends MY_Model {

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
			$this->db->select('cd.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
			$this->db->from($table.' cd');
			$this->db->join('comm_admin cm', 'cm.admin_id = cd.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = cd.edit_by','left');
			if(count($filter)>0){
				$this->db->where($filter);
			} 
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		
	}// end getAllList function
	
	public function countCategoryRecord($id){
		$sql   = "SELECT COUNT(1) as count_rc, (SELECT COUNT(1) FROM comm_contact WHERE cat_id = ?) as count_cat FROM comm_contact_designation WHERE cat_id = ?";
		$query = $this->db->query($sql, array($id, $id));
		$row = $query->row();
		
		if($row->count_rc ==0 && $row->count_cat ==0){
			return TRUE;	
		}else{
			return FALSE;
		}
		
	}//end countCategoryRecord			

}//end class