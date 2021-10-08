<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NoticeboardModel extends MY_Model {

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
	
	function getAllList($table, $filter=array(),$orderBy=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('nb.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
			$this->db->from($table.' nb');
			$this->db->join('comm_admin cm', 'cm.admin_id = nb.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = nb.edit_by','left');
			if(count($filter)>0){
				$this->db->where($filter);
			} 
			if(count($orderBy)>0){
			  foreach($orderBy as $key=>$val){
			  	 $this->db->order_by($key,$val);
			  }				
			}
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		
	}// end getAllList function
	
	function getRows($params = array(), $filter=array(),$orderBy=array()){
		if(array_key_exists("table",$params)){
			
	        $this->db->select('nb.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
	        $this->db->from($params['table'].' nb');
			$this->db->join('comm_admin cm', 'cm.admin_id = nb.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = nb.edit_by','left');
	       
	        //filter data by searched keywords
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('nb.title_hi',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('nb.title_en',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['status']) && trim($params['search']['status'])!=""){
	        $this->db->where('nb.status', $params['search']['status']);
	        }
	        
	        if(count($filter)>0){
				$this->db->where($filter);
			}
	        
	        //sort data by ascending or desceding order
	        if(isset($params['search']['sortBy']) && trim($params['search']['sortBy'])!=""){
	            $this->db->order_by('nb.order_preference',$params['search']['sortBy']);
	        }else{
	            $this->db->order_by('nb.order_preference','asc');
	        }
	        
	        if(count($orderBy)>0){
			  foreach($orderBy as $key=>$val){
			  	 $this->db->order_by($key,$val);
			  }				
			}
	        //set start and limit
	        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
	            $this->db->limit($params['limit'],$params['start']);
	        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
	            $this->db->limit($params['limit']);
	        }
	        //get records
	        $query = $this->db->get();
	        //print_r($this->db->last_query());
	        //exit();
	        //return fetched data
	        return ($query->num_rows() > 0)?$query->result_array():array();
	      }else{
		  	return array();
		  }
    }//end getRows fucntion

}//end class