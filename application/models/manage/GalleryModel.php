<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GalleryModel extends MY_Model {
	
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
			$this->db->select('cp.*, cpgc.cat_title_en, cpgc.cat_title_hi, concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name');
	        $this->db->from($table.' cp');
	        $this->db->join('comm_photo_gallery_category cpgc', 'cpgc.cat_id = cp.cat_id','left');
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
	
	function getPhotoGalleryList($table, $filter=array(),$orderBy=array()){
		
		if(trim($table) !="" && trim($table) !=null){
	        $this->db->from($table);
			if(count($filter)>0){
				$this->db->where($filter);
			}
			
			if(count($orderBy)>0){
			  foreach($orderBy as $key=>$val){
			  	 $this->db->order_by($key,$val);
			  }				
			} 
			
			$query = $this->db->get();
			
			//print_r($this->db->last_query());
	        //exit();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		 
	}// end getPhotoGalleryList function
	
	function ajax_search_by_title($params = array(),$filter=array(),$orderBy=array(),$adminRec=FALSE){

		if(array_key_exists("table",$params)){
			
			$adminColumn = "";
			$column = "";
			if(checkLanguage("english")){
				$column = ",cp.title_en as title";
			}else{
				$column = ",cp.title_hi as title";
			}
			if($adminRec==TRUE){
				$adminColumn = ',concat(cm.admin_fname," ",cm.admin_lname) as admin_name, concat(cm1.admin_fname," ",cm1.admin_lname) as edited_name';
				$this->db->join('comm_admin cm', 'cm.admin_id = cp.added_by','left');
			    $this->db->join('comm_admin cm1', 'cm1.admin_id = cp.edit_by','left');
			}
				
			
	        $this->db->select('cp.*'.$column.', cpgc.cat_title_en, cpgc.cat_title_hi'.$adminColumn);
	        $this->db->from($params['table'].' cp');
	        $this->db->join('comm_photo_gallery_category cpgc', 'cpgc.cat_id = cp.cat_id','left');
	         if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('cp.title_hi',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('cp.title_en',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['status']) && trim($params['search']['status'])!=""){
	        $this->db->where('cp.status', $params['search']['status']);
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
	        //exit();
	        //return fetched data
	        return ($query->num_rows() > 0)?$query->result():array();
	      }else{
		  	return array();
		  }

	}//end ajaxsearchtitle function
	
}//end class