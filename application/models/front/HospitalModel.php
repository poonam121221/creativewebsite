<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HospitalModel extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}//end constructor
	
	function getSingleList($table="", $filter=array()){
		
	  if(trim($table) !="" && trim($table) !=null && count($filter)>0){
		
		$column = "";
		if(checkLanguage("english")){
		 $column = "title_en as title,address_en as address,description_en as description,up.cat_title_en as cat_title";
		}else{
		 $column = "title_hi as title,address_hi as address,description_hi as description,up.cat_title_hi as cat_title";
		}
		
	  	$this->db->select('um.id,um.cat_id,um.web_url,um.attachment,um.added_date,'.$column);
		$this->db->from($table.' um');
		$this->db->join('comm_hospital_category up', 'up.cat_id = um.cat_id','left');
		$this->db->where($filter);
		$query = $this->db->get();
		
		if($query->num_rows()>0){
		    return $query->row();
	    }
			
		}//end check condition		
		return array();
		
	}// end getSingleList function
	
	public function make_query($params = array(),$filter=array(),$orderBy=array(),$count_only=0){
	  
	  if($count_only==1){
	  	$this->db->select('count(1) as total_row');
	  }else{
	  	$column = "";
		if(checkLanguage("english")){
		 $column = "title_en as title,address_en as address,description_en as description,up.cat_title_en as cat_title";
		}else{
		 $column = "title_hi as title,address_hi as address,description_hi as description,up.cat_title_hi as cat_title";
		}
	  	$this->db->select('um.id,um.cat_id,um.web_url,um.attachment,um.added_date,'.$column);
	  }
	  
	  $this->db->from($params['table'].' um');
	  $this->db->join('comm_hospital_category up', 'up.cat_id = um.cat_id','left');
	       
	  //filter data by searched keywords
	  if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	     $this->db->like('um.title_hi',trim($params['search']['title']));
	     $this->db->or_like('um.title_en',trim($params['search']['title']));
	  }

	  if(isset($params['search']['sub_cat']) && count($params['search']['sub_cat'])>0){
	     $this->db->where_in('up.cat_id', $params['search']['sub_cat']);
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
	
}//end class HospitalModel