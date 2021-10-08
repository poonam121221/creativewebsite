<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EntitlementModel extends MY_Model {

	public function __construct(){
	   parent::__construct();
	}  	
	
	function getSingleList($table, $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			
			$column = "";
			if(checkLanguage("english")){
				$column = ",title_en as title, description_en as description";
			}else{
				$column = ",title_hi as title, description_hi as description";
			}
			
			$this->db->select('*'.$column);
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
			$column = "";
			if(checkLanguage("english")){
				$column = ",title_en as title, description_en as description";
			}else{
				$column = ",title_hi as title, description_hi as description";
			}				
			
			$this->db->select('*'.$column);
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
    
    public function make_query($params = array(),$filter=array(),$orderBy=array(),$count_only=0){
	  
	  
	  $column = "";
	  if(checkLanguage("english")){
		$column = ",title_en as title, description_en as description";
	  }else{
		$column = ",title_hi as title, description_hi as description";
	  }
	  
	  if($count_only==1){
	  	 $this->db->select('count(1) as total_row');
	  }else{
	  	 $this->db->select('*'.$column);
	  }
        
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
	  
	}//end make_query function
	
	public function make_datatable($params = array(),$filter=array(),$orderBy=array()){ 
 
       $this->make_query($params,$filter,$orderBy);  
       //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } 
       $query = $this->db->get();  
       //print_r($this->db->last_query());
       //exit;
       if($query->num_rows()>0){
	   	return $query->result();  
	   }
       return array();  
    }//end make_datatables function  
    
    public function get_filtered_data($params = array(),$filter=array(),$orderBy=array()){  
   	   $count_only = 1;
       $this->make_query($params,$filter,$orderBy,$count_only);  
       $query = $this->db->get();
       //print_r($this->db->last_query());
       return ($query->num_rows() > 0)?$query->row()->total_row:0;  
    }//end get_filtered_data function 	

}//end EntitlementModel class