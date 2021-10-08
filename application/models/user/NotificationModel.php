<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NotificationModel extends MY_Model {

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
	  	$this->db->select('cn.*,(CASE cn.recipent_user_panel WHEN 1 THEN CONCAT(ca.admin_fname," ",ca.admin_lname) WHEN 2 THEN CONCAT(cu.user_fname," ",cu.user_lname) ELSE "" END) as recipent_name');
	  	//',(CASE cn.sender_user_panel WHEN 1 THEN CONCAT(ca1.admin_fname," ",ca1.admin_lname) WHEN 2 THEN CONCAT(cu1.user_fname," ",cu1.user_lname) ELSE "" END) as sender_name'
	  }
	  
	  $this->db->from($params['notificationTbl'].' cn');
	  $this->db->join($params['userTbl'].' cu','cu.user_id = cn.recipent_id','left');
	  $this->db->join($params['adminTbl'].' ca','ca.admin_id = cn.recipent_id','left');
	  
	  //$this->db->join($params['userTbl'].' cu1','cu1.user_id = cn.sender_id','left');
	  //$this->db->join($params['adminTbl'].' ca1','ca1.admin_id = cn.sender_id','left');	  

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
	
	public function getNotifyEmailList($inputParameter=array(),$outputParameter=array()){
	  /**
	  * 
	  * @var1 project_id_p int
	  * @var2 inst_user_only_p int //defalut NULL OR 0 AND 1 for Intrested company or Implementing partner in project
	  * @var3 group_user_id_p VARCHAR //comma sepreted front user
	  * call pro_get_email_list(2,0,NULL);
	  * call pro_get_email_list(2,NULL,NULL);
	  * call pro_get_email_list(2,NULL,'2,3'); @var3 for Company/Individual, Implementing Partner 
	  * 
	  */
	  if(count($inputParameter)==3){
		$data = $this->CIProcedure('pro_get_email_list',$inputParameter);
		//call this function if you have a output parameter in procedure
		//$ProcedureMessage = $this->getOutData(); 

		if(isset($data) && count($data)>0){
		  return $data;
		}
		
	    return array();			
	  }else{
	   return array();
	  }//end check variable empty or not	
	  
	}//end getNotifyEmailList
	
	public function insertNotificationData($userId=0,$notifiaction=array(),$logStatus=""){
		
	if($userId!=0 && count($notifiaction)>0){
	  	
	  	$this->db->trans_begin();
	  		    
	  	$query_status1 = $this->db->insert_batch('comm_notification',$notifiaction);
		//$queryString1 = $this->db->last_query();	
		$queryString1 = "";	
		
		if($this->db->trans_status() === FALSE){
		   $this->db->trans_rollback();
		   return FALSE;
		}else{
		   $this->db->trans_commit();
		   
		   $this->_createLog($query_status1,$logStatus,TRUE,$userId,'user');
		   
		   return TRUE;
		}
		
	  }else{
	  	   return FALSE;
	  }//end count fiter and record		
		
	}
	//end insertNotificationData function
	
}//end class NotificationModel