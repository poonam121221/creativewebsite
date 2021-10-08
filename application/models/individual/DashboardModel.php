<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardModel extends MY_Model {
	
   public function __construct(){
		parent::__construct();
   }//end constructor

   public function getSingleList($table="",$filter=array()){
		
		if(count($filter)>0){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			$this->db->limit(1);
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function	
	
   public function getAllList($table="", $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('*');
			$this->db->from($table);
			if(count($filter)>0){
				$this->db->where($filter);
			}
			if(count($order)>0){
				$this->db->order_by($order);
			}
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		
	}// end getAllList function
	
}//end class DashboardModel