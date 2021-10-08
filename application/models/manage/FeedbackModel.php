<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FeedbackModel extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}//end constructor
	
	public function getSingleList($table, $filter=array()){
		
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
	
	public function getAllList($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('*');
			$this->db->from($table);
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
	
	public function getRows($params = array()){
		if(array_key_exists("table",$params)){
			
	        $this->db->select('*');
	        $this->db->from($params['table']);
	       
	        //filter data by searched keywords
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('feedback_name',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('feedback_email',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['status']) && trim($params['search']['status'])!=""){
	        $this->db->where('feedback_status', $params['search']['status']);
	        }
	        
	        //sort data by ascending or desceding order
	        if(isset($params['search']['sortBy']) && trim($params['search']['sortBy'])!=""){
	            $this->db->order_by('feedback_id',$params['search']['sortBy']);
	        }else{
	            $this->db->order_by('feedback_date','desc');
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
	
	public function getRowsCount($params = array()){
		if(array_key_exists("table",$params)){
			
	        $this->db->select('count(1) as total_row');
	        $this->db->from($params['table']);
	       
	        //filter data by searched keywords
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('feedback_name',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('feedback_email',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['status']) && trim($params['search']['status'])!=""){
	        $this->db->where('feedback_status', $params['search']['status']);
	        }
	        
	        $this->db->limit(1);
	        //get records
	        $query = $this->db->get();
	        //print_r($this->db->last_query());
	        //exit();
	        //return fetched data
	        return ($query->num_rows() > 0)?$query->row()->total_row:0;
	      }else{
		  	return 0;
		  }
    }//end getRows fucntion
	
}//end class