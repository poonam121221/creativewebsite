<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IndividualModel extends MY_Model {
	
   public function __construct(){
		parent::__construct();
   }//end constructor
	
   private $id;
   private $server_password=NULL;

   public function getSingleList($table="",$filter=array(),$order=array()){
		
		if(count($filter)>0){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			if(count($order)>0){
				$this->db->order_by($order);
			}
			$this->db->limit(1);
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
   public function getIndividualDetails($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null){
		 $this->db->select('cu.*,(CASE cu.user_type WHEN 1 THEN "Company" WHEN 2 THEN "Individual User" WHEN 3 THEN "Implementation Partner" END) as user_type_name,cc.*,cs.state_name,(CASE cc.state_id WHEN 20 THEN dist.district_name ELSE other_district_name END) as district_name');
	     $this->db->from($table.' cu');
	     $this->db->join('comm_individual_user cc', 'cc.fk_user_id = cu.user_id');
	     $this->db->join('comm_state cs','cs.state_id = cc.state_id');
	     $this->db->join('comm_district dist','dist.district_code = cc.district_code','left');
	     
		 if(count($filter)>0){
			$this->db->where($filter);
		 }
		 
		 $this->db->limit(1);
		 $query = $this->db->get();
		 //print_r($this->db->last_query());
	     //exit();
			
		 if($query->num_rows()>0){
		   return $query->row();
		 }
		}//end check condition		
		return FALSE;
		
	}//end getCompanyDetails	
	
   public function getAllList($table="", $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('*');
			$this->db->from($table);
			if(count($filter)>0){
				$this->db->where($filter);
			}
			if(count($order)>0){
				$this->db->order_by($order);
			}
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		
	}// end getAllList function
	
   public function insertIndividualData($user=array(),$individual=array(),$fullname=""){
		
	if(count($user)>0 && count($individual)>0){
	  	
	  	$this->db->trans_begin();
	  	
	  	$query_status1 = $this->db->insert('comm_users',$user);
	  	$queryString1 = $this->db->insert_string('comm_users',$user);
	  	$userId = $this->db->insert_id();
		
		$individual['fk_user_id'] = $userId;
		$query_status2 = $this->db->insert('comm_individual_user',$individual);
		$queryString2 = $this->db->insert_string('comm_individual_user',$individual);	
		
		if($this->db->trans_status() === FALSE){
		   $this->db->trans_rollback();
		   return FALSE;
		}else{
		   $this->db->trans_commit();
		   
		   $this->_createLog($queryString1,'Individual user record successfully inserted. Name of user is '.$fullname,TRUE,$userId,'user');
		   $this->_createLog($queryString2,'Individual user details successfully inserted.',TRUE,$userId,'user');
		   
		   return TRUE;
		}
		
	  }else{
	  	   return FALSE;
	  }//end count fiter and record		
		
	}
	//end insertCompanyData function
	
	public function make_query($params = array(),$filter=array(),$orderBy=array(),$count_only=0){
	  
	  if($count_only==1){
	  	 $this->db->select('count(1) as total_row');
	  }else{
	  	$this->db->select('cu.*,(CASE cu.user_type WHEN 1 THEN "Company" WHEN 2 THEN "Individual User" WHEN 3 THEN "Implementation Partner" END) as user_type_name,cc.*, concat(ca2.admin_fname," ",ca2.admin_lname) as edited_name');
	  	//concat(ca1.admin_fname," ",ca1.admin_lname) as admin_name,
	  }
	  
	  $this->db->from($params['table'].' cu');
	  $this->db->join('comm_individual_user cc', 'cc.fk_user_id = cu.user_id');
	  //$this->db->join('comm_admin ca1', 'ca1.admin_id = cu.added_by','left');
	  $this->db->join('comm_admin ca2', 'ca2.admin_id = cu.edit_by','left');
	  
	  //filter data by searched keywords
	  if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	    $this->db->like("CONCAT(cu.user_fname,' ',cu.user_lname)",trim($params['search']['title']));
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
           return $query->result();  
    }//end make_datatables function 
    
    public function get_filtered_data($params = array(),$filter=array(),$orderBy=array()){  
    	   $count_only = 1;
           $this->make_query($params,$filter,$orderBy,$count_only);  
           $query = $this->db->get();
           //print_r($this->db->last_query());
           return ($query->num_rows() > 0)?$query->row()->total_row:0;  
    }//end get_filtered_data function 
	
}//end class CompanyModel