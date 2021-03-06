<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GallerycategoryModel extends MY_Model {
	
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
			$this->db->select('cpgc.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
	        $this->db->from($table.' cpgc');
			$this->db->join('comm_admin cm', 'cm.admin_id = cpgc.added_by','left');
			$this->db->join('comm_admin cm1', 'cm1.admin_id = cpgc.edit_by','left');
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
				$column = ",um.title_en as title";
			}else{
				$column = ",um.title_hi as title";
			}				
			
			$this->db->select('um.cat_id,attachment'.$column);
	        $this->db->from($params['table'].' um');
			$this->db->join($params['category_table'].' cpgc', 'cpgc.cat_id = um.cat_id','left');

	        // $this->db->select('cpgc.*'.$column.',(SELECT attachment FROM '.$params['table'].' as cp WHERE status=1 and is_delete=0 and cat_id =cpgc.cat_id ORDER BY order_preference asc LIMIT 1) as  attachment');
	        // $this->db->from($params['category_table'].' cpgc');
	        
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
	
}//end GallerycategoryModel class