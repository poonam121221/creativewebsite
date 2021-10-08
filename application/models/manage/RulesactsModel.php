<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RulesactsModel extends MY_Model {

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
			$this->db->select('ra.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
			$this->db->from($table.' ra');
			$this->db->join('comm_admin cm', 'cm.admin_id = ra.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = ra.edit_by','left');
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
	
	function getRows($params = array(),$filter=array(),$orderBy=array()){
		if(array_key_exists("table",$params)){
			
			if(checkLanguage("english")){
			 $col_name = ',up.cat_title_en as cat_title, um.title_en as title';
			}else{
			 $col_name = ',up.cat_title_hi as cat_title, um.title_hi as title';
			}
			
	        $this->db->select('um.*, up.cat_title_en, up.cat_title_hi, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name'.$col_name);
	        $this->db->from($params['table'].' um');
	        $this->db->join('comm_rules_acts_category up', 'up.cat_id = um.cat_id','left');
			$this->db->join('comm_admin cm', 'cm.admin_id = um.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = um.edit_by','left');
	       
	        //filter data by searched keywords
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('um.title_hi',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('um.title_en',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['status']) && trim($params['search']['status'])!=""){
	        $this->db->where('um.status', $params['search']['status']);
	        }
	        
	        if(count($filter)>0){
				$this->db->where($filter);
			}	
	        
	        //sort data by ascending or desceding order
	        if(isset($params['search']['sortBy']) && trim($params['search']['sortBy'])!=""){
	            $this->db->order_by('up.cat_title_en',$params['search']['sortBy']);
	        }else{
	            $this->db->order_by('up.cat_title_en','asc');
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