<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserProjectInterestModel extends MY_Model {

	public function __construct(){
	   parent::__construct();
	}  
	
	public function getRow($table, $filter=array()){
		
	  if(trim($table) !="" && trim($table) !=null && count($filter)>0){
		$this->db->select('*');
	    $this->db->from($table);
		$this->db->where($filter); 
		$this->db->limit(1);
		$query = $this->db->get();
			
		if($query->num_rows()>0){
		  return $query->row();
		}
			
		}//end check condition		
		return FALSE;
		
	}// end getRow function
	
	public function getAllList($table, $filter=array(),$orderBy=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('*');
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
			
			if($query->num_rows()>0){
				return $query->result();
			}
		}//end check condition		
		return array();
		
	}//end getAllList
    
	public function make_query($params = array(),$filter=array(),$orderBy=array(),$count_only=0){
	  
	  if($count_only==1){
	  	$this->db->select('count(1) as total_row');
	  }else{
	  	$user_id = (float)$params['user_id'];
	  	$this->db->select('cp.project_id,cp.project_title,cpc.project_category_name,project_owner_name,CONCAT(cp.cnt_person_fname," ",cp.cnt_person_lname) as cnt_full_name,cp.cnt_person_email,cp.cnt_person_mobile,cp.project_estmtd_budget,cp.project_estmtd_duration,cp.actual_start_date,cp.actual_end_date,cpi.*,(SELECT COUNT(1) FROM comm_project_interest WHERE interest_status = 1 AND fk_project_id =cpi.fk_project_id AND added_by !='.$user_id.') as is_assign_other');
	  }
	  
	  $this->db->from('comm_project_interest cpi');
	  $this->db->join('comm_project cp','cp.project_id = cpi.fk_project_id','left');
	  $this->db->join('comm_project_category cpc','cpc.pc_id = cp.project_cat_id','left');
	       
	  //filter data by searched keywords
	  if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	     $this->db->like('p.project_title',trim($params['search']['title']));
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
    
     public function InsertUserInstInfo($instdetail=array(),$impldetail=array()){
		
	  $userIntrestdId = 0;	
	  $oterhImplId = 0;	
		
	  if(count($instdetail)>0){
	  	
	  	$this->db->trans_begin();
	  	
	  	$query_status1 = $this->db->insert('comm_project_interest',$instdetail);
	  	$userIntrestdId = $this->db->insert_id();	  	
		
		if(count($impldetail)>0){
		 $query_status2 = $this->db->insert('comm_impl_partner_other',$impldetail);
	  	 $oterhImplId = $this->db->insert_id();	
	  	 $filter =array('interest_id'=>$userIntrestdId,'added_by'=>(int)$impldetail['fk_user_id']);
		 $query_status3 = $this->db->update('comm_project_interest',array('fk_other_impl_id'=>$oterhImplId),$filter2);
	  	}  		  	
		
		if($this->db->trans_status() === FALSE){
		   $this->db->trans_rollback();
		   return FALSE;
		}else{
		   $this->db->trans_commit();		   
		   return array('status'=>TRUE,'pi_id'=>$userIntrestdId,'oi_id'=>$oterhImplId);
		}		
	  }else{
	  	  return array('status'=>FALSE,'pi_id'=>$userIntrestdId,'oi_id'=>$oterhImplId);
	  }//end count fiter and record		
		
	}//end InsertUserInstInfo function
	
}//end class ProjectInterestModel