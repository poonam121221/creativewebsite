<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AclModel extends MY_Model {

	public function __construct(){
		parent::__construct();
	}//end constructor
	
	function checkAccess($ump_id, $controller_name, $function_name,$status=1){
		$sql = "SELECT COUNT(1) as count_rec FROM user_acl WHERE priviledge_id = ? and lower(controller_name) = ? and FIND_IN_SET(?,lower(auth_function)) and status = ?";
		$query = $this->db->query($sql, array($ump_id, $controller_name, $function_name, $status));
		
		return $query->row();
	}
	
	function check_unique_acl($table,$filter=array()){
		
			$this->db->select('count(1) as count_rec');
			$this->db->from($table);
			$this->db->where($filter);			
			$query = $this->db->get();
			
			return $query->row()->count_rec;
							
	}//end check_unique_acl function
		
	function getSingleList($table, $filter=array(),$orderBy=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select('ac.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name,m.controller_name,upm.upm_id,upm.upm_name');
			$this->db->from($table.' ac');
			$this->db->join('comm_admin cm', 'cm.admin_id = ac.added_by','left');
			$this->db->join('menu_list m', 'm.id = ac.menu_id','left');
			$this->db->join('user_previlege_master upm', 'upm.upm_id = ac.priviledge_id','left');
			$this->db->where($filter);
			$this->db->where('upm.isdelete', 0); 
			
			if(count($orderBy)>0){
			  foreach($orderBy as $key=>$val){
			  	 $this->db->order_by($key,$val);
			  }				
			}
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	function getAllList($table, $filter=array(),$orderBy=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('ac.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name,m.controller_name,cac.controller_title,upm.upm_id,upm.upm_name');
			$this->db->from($table.' ac');
			$this->db->join('comm_admin cm', 'cm.admin_id = ac.added_by','left');
			$this->db->join('menu_list m', 'm.id = ac.menu_id','left');
			$this->db->join('comm_auth_controller_function cac', 'cac.menu_id = ac.menu_id');
			$this->db->join('user_previlege_master upm', 'upm.upm_id = ac.priviledge_id');
			if(count($filter)>0){
				$this->db->where($filter);
			}
			
			if(count($orderBy)>0){
			  foreach($orderBy as $key=>$val){
			  	 $this->db->order_by($key,$val);
			  }				
			}
			
			$this->db->where('upm.isdelete', 0);  
			$query = $this->db->get();

			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return FALSE;
		
	}// end getAllList function
	
}//end class