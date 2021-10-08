<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PublicationModel extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}//end constructor
	
	function getSingleList($table, $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			
			if(count($order)>0){
				foreach($order as $col=>$val){
					$val = (trim($val)!="")?$val:"desc";
					$this->db->order_by($col,$val);
				}				
			}
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	function getAllList($table, $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('*');
			$this->db->from($table);
			if(count($filter)>0){
				$this->db->where($filter);
			}
			if(count($order)>0){
				foreach($order as $col=>$val){
					$val = (trim($val)!="")?$val:"desc";
					$this->db->order_by($col,$val);
				}				
			}
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		
	}// end getAllList function


	public function getListByCategeoryId($table, $filter=array(),$order=array())
	{
		$column = "*,";
		if(checkLanguage("english")){
			$column .= ",title_en as title,description_en as description";
		}else{
			$column .= ",title_hi as title,description_hi as description";
		}				
			
		$this->db->select($column);
	    $this->db->from('comm_events');
	    //$this->db->where(array("event_end_date <="=> $end,"event_start_date >="=> $start));
	   // $this->db->where(array("event_end_date <="=> $end));
	    return $this->db->get();
		
	}// end getListByCategeoryId function

	public function getCategeoryDetails($categoryId)
	{

		if(checkLanguage("english")){
			$column = "cat_title_en as title";
		}else{
			$column = "cat_title_hi as title";
		}				
			
		$this->db->select($column);
	    $this->db->from('comm_publications_category');
	    $this->db->where("cat_id",$categoryId);

	    $query = $this->db->get();
			
		if($query->num_rows()>0){
			return $query->row();
		}

		return array();
		
	}// end getListByCategeoryId function

		function ajax_search_by_title($params = array(),$filter=array(),$orderBy=array()){

		if(array_key_exists("table",$params)){
			
			$column = "";
			if(checkLanguage("english")){
				$column = ",title_en as title";
			}else{
				$column = ",title_hi as title";
			}	
			
	        $this->db->select('*'.$column);
	        $this->db->from($params['table']);
	       
	        //filter data by searched keywords
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('title_hi',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('title_en',trim($params['search']['title']));
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