<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactModel extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}//end constructor
	
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
		return array();
		
	}// end getSingleList function
	
	function getAllList($table, $filter=array(),$orderBy=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('cd.*,cdc.designation_en, cdc.designation_hi,ccc.category_en,ccc.category_hi, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
	        $this->db->from($table.' cd');
	        $this->db->join('comm_contact_designation cdc', 'cdc.d_id = cd.d_id','left');
	        $this->db->join('comm_contact_category ccc', 'ccc.cat_id = cd.cat_id','left');
	        $this->db->join('comm_admin cm', 'cm.admin_id = cd.added_by','left');
	        $this->db->join('comm_admin cm1', 'cm1.admin_id = cd.edit_by','left');
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
	
	function ajax_search_by_title($params = array(),$filter=array(),$orderBy=array()){

		if(array_key_exists("table",$params)){
			
			$column = "";
			if(checkLanguage("english")){
				$column = ",cd.title_en as title, work_allocation_en as work_allocation, cdc.designation_en as designation, ccc.category_en as category,loc.location_name_en as location";
			}else{
				$column = ",cd.title_hi as title, work_allocation_hi as work_allocation, cdc.designation_hi as designation, ccc.category_hi as category,loc.location_name_hi as location";
			}	
			
	        $this->db->select('cd.*'.$column);
	        $this->db->from($params['table'].' cd');
	        $this->db->join('comm_contact_designation cdc', 'cdc.d_id = cd.d_id','left');
	        $this->db->join('comm_contact_category ccc', 'ccc.cat_id = cd.cat_id','left');
			$this->db->join('comm_location loc', 'loc.id = cd.location','left');
	        
	        //filter data by searched keywords
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('cd.title_hi',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('cd.title_en',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('cd.email_address',trim($params['search']['title']));
	        }
	        
			if(isset($params['search']['category']) && trim($params['search']['category'])!=""){
	        $this->db->where('cd.cat_id', $params['search']['category']);
	        }
			
			if(isset($params['search']['location']) && trim($params['search']['location'])!=""){
	        $this->db->where('cd.location', $params['search']['location']);
	        }
	        if(count($filter)>0){
				$this->db->where($filter);
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
	        // exit();
	        //return fetched data
	        return ($query->num_rows() > 0)?$query->result():array();
	      }else{
		  	return array();
		  }

	}//end ajaxsearchtitle function
	
}//end class