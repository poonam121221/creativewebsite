<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommunicationModel extends MY_Model {

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
	  
	  $type  = cleanQuery($this->input->post('type',TRUE));
	  //$user_type = encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
	 	$user_id = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);

	  
	
		   if($type == 1){
			     if($count_only==1)
				 {
				  	$this->db->select('count(1) as total_row');
			     }
				 else
				 {
				   $this->db->select(	
				   'c.*,(CASE c.comm_sender_type WHEN 1 THEN CONCAT(u.user_fname, " ", u.user_lname) WHEN 2 THEN CONCAT(a.admin_fname, " ", a.admin_lname) ELSE " "END) as 
				   from_name ,query_name
					');   
				$this->db->from('comm_communication c');
				$this->db->join('comm_query_type qt','qt.query_id = c.comm_query_type','left');
				$this->db->join('comm_users u','u.user_id = c.comm_sender_id','left');
				$this->db->join('comm_admin a','a.admin_id = c.comm_sender_id','left');
				//$this->db->join('user_previlege_master upm','upm.upm_id = c.comm_user_type','left');	  
				$this->db->where('comm_receiver_id = '.$user_id);
				//$this->db->or_where('(comm_message_replay != " ")');
				$this->db->order_by('comm_id','desc');
			   }
		   }
		   elseif($type == 2){
			   
			     if($count_only==1)
				 {
				  	$this->db->select('count(1) as total_row');
			     }
				 else
				 {
				   $this->db->select(	
				   'c.*,(CASE c.comm_receiver_type WHEN 1 THEN CONCAT(u.user_fname, " ", u.user_lname) WHEN 2 THEN CONCAT(a.admin_fname, " ", a.admin_lname) ELSE " "END) as 
				   to_name ,query_name
					');   
				$this->db->from('comm_communication c');
				$this->db->join('comm_query_type qt','qt.query_id = c.comm_query_type','left');
				$this->db->join('comm_users u','u.user_id = c.comm_receiver_id','left');
				$this->db->join('comm_admin a','a.admin_id = c.comm_receiver_id','left');
				//$this->db->join('user_previlege_master upm','upm.upm_id = c.comm_user_type','left');	  
				$this->db->where('comm_sender_id = '.$user_id);
				$this->db->order_by('comm_id','desc');
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
            //	print_r($this->db->last_query());     
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
	
   public function insertCommunicationData($communication = array()){
	if(count($communication)>0){
	  	$this->db->trans_begin();
	  	$query_status1 = $this->db->insert('comm_communication',$communication);
	  	$queryString1 = $this->db->insert_string('comm_communication',$communication);
	  	$communicationId = $this->db->insert_id();
		//print_r($this->db->last_query());
		if($this->db->trans_status() === FALSE){
		   $this->db->trans_rollback(); 
		   return FALSE;
		}else{
		   $this->db->trans_commit(); 
		   $this->_createLog($queryString1,$communication.' communication record successfully inserted.',TRUE,$communicationId);
		   return TRUE;
		}
	  }else{
	  	   return FALSE;
	  }//end insertCommunicationData function	
   }	
   public function getCommunication($table, $filter=array()){
		
	  if(trim($table) !="" && trim($table) !=null && count($filter)>0){
		$this->db->select('c.*,query_name,(CASE c.comm_sender_type WHEN 1 THEN CONCAT(u1.user_fname, " ", u1.user_lname) WHEN 2 THEN CONCAT(a1.admin_fname, " ", a1.admin_lname) ELSE " "END) as sender_name,(CASE c.comm_receiver_type WHEN 1 THEN CONCAT(u2.user_fname, " ", u2.user_lname) WHEN 2 THEN CONCAT(a2.admin_fname, " ", a2.admin_lname) ELSE " "END) as 
				   receiver_name '); 
	     $this->db->from('comm_communication c');
	//	$this->db->join('user_previlege_master upm','upm.upm_id = c.comm_user_type','left');
	  	$this->db->join('comm_query_type qt','qt.query_id = c.comm_query_type','left');
	  	$this->db->join('comm_users u1','u1.user_id = c.comm_sender_id','left');
		$this->db->join('comm_admin a1','a1.admin_id = c.comm_sender_id','left');
	  	$this->db->join('comm_users u2','u2.user_id = c.comm_receiver_id','left');
		$this->db->join('comm_admin a2','a2.admin_id = c.comm_receiver_id','left');
		$this->db->where($filter); 
		$this->db->limit(1);
		$query = $this->db->get();
			
		if($query->num_rows()>0){
		  return $query->row();
		}
			
		}//end check condition		
		return FALSE;
		
	}// end getRow function
	
	public function updateCommunicationData($communication = array(),$filter = array()){
	if(count($communication)>0){
	  	$this->db->trans_begin();
	  	$query_status1 = $this->db->update('comm_communication',$communication,$filter);
	  	$queryString3 = $this->db->update_string('comm_communication',$communication);
	  	$updatedId = (int)$filter['comm_id'];
		print_r($this->db->last_query());
		if($this->db->trans_status() === FALSE){
		   $this->db->trans_rollback(); 
		   return FALSE;
		}else{
		   $this->db->trans_commit(); 
		   $this->_createLog($updatedId,$communication.' communication record successfully updated.',TRUE,$updatedId);
		   return TRUE;
		}
	  }else{
	  	   return FALSE;
	  }//end insertCommunicationData function	
   }	
  function getVal($table,$value,$filter=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select($value);
			$this->db->from($table);
			$this->db->where($filter);
			
			$query = $this->db->get();
			//echo $this->db->last-query();
			if($query->num_rows()>0){
			    return $query->row();
		    }
		}//end check condition		
		return FALSE;
		
	}// end getVal function 
}//end class CommunicationModel