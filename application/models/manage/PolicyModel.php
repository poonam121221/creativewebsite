<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PolicyModel extends MY_Model {
	
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
			$this->db->select('cp.*, cpgc.policies_category_title_en, cpgc.policies_category_title_hi, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
	        $this->db->from($table.' cp');
	        $this->db->join('comm_policies_category cpgc', 'cpgc.policies_category_id = cp.cat_id','left');
			$this->db->join('comm_admin cm', 'cm.admin_id = cp.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = cp.edit_by','left');
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
	
	function getAllCategoryList($table="", $filter=array(),$orderBy=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('ev.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
			$this->db->from($table.' ev');
			$this->db->join('comm_admin cm', 'cm.admin_id = ev.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = ev.edit_by','left');
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
		return FALSE;
		
	}// end getAllList function	
	
	function make_query($table="",$params = array(),$filter=array(),$orderBy=array(),$count_only=0){
	  if($count_only==1){
	  	$this->db->select('count(1) as total_row');
	  }else{
	    $this->db->select('cp.*, cpgc.policies_category_title_en, cpgc.policies_category_title_hi, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
	  }
	  $this->db->from('comm_policies cp');
	  $this->db->join('comm_policies_category cpgc', 'cpgc.policies_category_id = cp.cat_id','left');
	  $this->db->join('comm_admin cm', 'cm.admin_id = cp.added_by','left');
	  $this->db->join('comm_admin cm1', 'cm1.admin_id = cp.edit_by','left');
	  //filter data by searched keywords
	  if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	    $this->db->like('cp.title_hi',trim($params['search']['title']));
	    $this->db->or_like('cp.title_en',trim($params['search']['title']));
	    $this->db->or_like('cpgc.policies_category_title_hi',trim($params['search']['title']));
	    $this->db->or_like('cpgc.policies_category_title_en',trim($params['search']['title']));
	  }
	  
	  if(count($filter)>0){
		$this->db->where($filter);
	  }	
			
	  if(count($orderBy)>0){
	    foreach($orderBy as $key=>$val){
		  $this->db->order_by($key,$val);
		}				
	  }
	  
	}//end make_query function
	
	function make_datatables($table="",$params = array(),$filter=array(),$orderBy=array()){ 
 
           $this->make_query($table,$params,$filter,$orderBy);  
           if(isset($_POST["length"]) && $_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           //print_r($this->db->last_query());
           return $query->result();  
    }  
    
    function get_filtered_data($table="",$params = array(),$filter=array(),$orderBy=array()){  
       $count_only = 1;
       $this->make_query($table,$params,$filter,$orderBy,$count_only);  
       $query = $this->db->get();  
       return ($query->num_rows() > 0)?$query->row()->total_row:0;  
    } 
	
	function ajax_search_by_title($params = array(),$filter=array(),$orderBy=array()){

		if(array_key_exists("table",$params)){
			
			$column = "";
			if(checkLanguage("english")){
				$column = ",cp.title_en as title";
			}else{
				$column = ",cp.title_hi as title";
			}	
			
	        $this->db->select('cp.*'.$column.', cpgc.policies_category_title_en, cpgc.policies_category_title_hi');
	        $this->db->from($params['table'].' cp');
	        $this->db->join('comm_policies_category cpgc', 'cpgc.policies_category_id = cp.cat_id','left');
	        
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
	        //exit();
	        //return fetched data
	        return ($query->num_rows() > 0)?$query->result():array();
	      }else{
		  	return array();
		  }

	}//end ajaxsearchtitle function
	
}//end class