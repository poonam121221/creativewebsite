<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}//end constructor
	
	private $id;
	private $server_password=NULL;

	public function login($username,$password,$validKey,$status,$logingAtmpt, $loginMinute){
		
		$message = array('IS_AUTH_USER'=>"invalid",'USERDATA'=>array());

		$sql   = "SELECT um.*,up.upm_name FROM comm_admin um left join user_previlege_master up on um.admin_upm_id=up.upm_id WHERE um.admin_username = ? AND um.admin_status = ? ";
		$query = $this->db->query($sql, array($username, $status));
		$row = $query->row();
		
		if($this->session->has_userdata('loginCount')==TRUE){
		  $this->session->unset_userdata('loginCount');
		}
		
		$this->server_password =  hash('sha256',hash('sha256',$validKey).$row->admin_password);
	
		if($query->num_rows() > 0 && $this->server_password==$password){
			
			$chkLoginAtmpt = $this->db->get_where('comm_admin', array('admin_username' => $username,'admin_failed_login_attempts >= '=>$logingAtmpt,'admin_last_failed_login > '=>'DATE_SUB(NOW(), INTERVAL '.$loginMinute.' MINUTE)'));
			
			if($chkLoginAtmpt->num_rows()>0){
			  $this->session->set_userdata(array('login_block_time'=>time()));
			  $message['IS_AUTH_USER'] = "invalid";
			  $message['AUTH_ERROR_MESSAGE'] = "Your account has been locked! Please try after 10 minutes.";
			  return $message;
			}else{
			  if($row->admin_status==1){
					
				if($this->session->has_userdata('loginCount')==TRUE){
					$this->session->unset_userdata('loginCount');
				}
					
				   $DATAINPUT = array('admin_failed_login_attempts'=>0,'admin_last_failed_login'=>'',
				   'admin_last_login'=>date('Y-m-d H:i:s'));
				   $FILTER = array('admin_username'=>$username,'admin_status'=>1);
				   $LOG_ACTIVITY = '';
				   $IS_LOG_CREATE = FALSE;
				   $this->updatedata('comm_admin',$DATAINPUT,$FILTER,$LOG_ACTIVITY,$IS_LOG_CREATE);
					 	
				   $message['IS_AUTH_USER'] = "valid";
				   $message['USERDATA'] = $row;	
				   			
				   return $message;
					
				}else{
					$message['IS_AUTH_USER'] = "invalid";
					$message['AUTH_ERROR_MESSAGE'] = "Your Account has been disabled by administrator.";
					return $message;
				}//end check login status else
			}//end check login attempt else
			
		}else{
			
		 if($this->session->has_userdata('loginCount')==TRUE){
		 	
		 	  $_SESSION['loginCount']++; //YOU CAN ALSO USE THIS METHOD			  
					 
			  $DATAINPUT = array('admin_failed_login_attempts'=>$this->session->userdata('loginCount'),'admin_last_failed_login'=>date('Y-m-d H:i:s'));
			  $FILTER = array('admin_username'=>$username,'admin_status'=>1);
			  $LOG_ACTIVITY = '';
			  $IS_LOG_CREATE = FALSE;
			  $this->updatedata('comm_admin',$DATAINPUT,$FILTER,$LOG_ACTIVITY,$IS_LOG_CREATE);	
					 
			if($this->session->userdata('loginCount') > 2) {
			    $this->session->set_userdata(array('login_block_time'=>time())); 
			    $message['IS_AUTH_USER'] = "invalid";
				$message['AUTH_ERROR_MESSAGE'] = "Your account has been locked! Please try after 10 minutes.";
				return $message; 
			}else{ 
				$message['IS_AUTH_USER'] = "invalid";
				$message['AUTH_ERROR_MESSAGE'] = "Please enter valid username & password!!";	
				return $message; 	
			}
			
		  }
		  else {
		  	
			$this->session->set_userdata(array('loginCount'=>1));
			
			$DATAINPUT = array('admin_failed_login_attempts'=>1,'admin_last_failed_login'=>date('Y-m-d H:i:s'));
			$LOG_ACTIVITY = '';
			$IS_LOG_CREATE = FALSE;
			$this->updatedata('comm_admin',$DATAINPUT,array('admin_username'=>$username,'admin_status'=>1),$LOG_ACTIVITY,$IS_LOG_CREATE);
			
			$message['IS_AUTH_USER'] = "invalid";
		    $message['AUTH_ERROR_MESSAGE'] = "Invalid login information !! ";
			return $message;	
		 }//end check loginCount session else part			
		    
		}
	}// end login function
	
	public function getSingleList($filter=array(),$order=array()){
		
		if(count($filter)>0){
			$this->db->select('um.*,up.upm_name');
			$this->db->from('comm_admin um');
			$this->db->where($filter);
			if(count($order)>0){
				$this->db->order_by($order);
			}
			$this->db->join('user_previlege_master up', 'up.upm_id = um.admin_upm_id','left');
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	public function getRecord($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	public function getForgotRecord($filter=array()){
		
		if(count($filter)>0){
			$sql = "SELECT * FROM comm_admin WHERE MD5(admin_email) = ? AND MD5(admin_pass_verify_code) = ? AND admin_status = ? AND TIMESTAMPDIFF(MINUTE,exp_verify_date,?)<=?";
			$query = $this->db->query($sql, $filter);
			
			if(count($query->row_array())>0){
			    return $query->row_array();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	public function getAllList($table, $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('um.*,up.upm_name');
			$this->db->from('comm_admin um');
			if(count($filter)>0){
				$this->db->where($filter);
			}
			if(count($order)>0){
				$this->db->order_by($order);
			}
			
			$this->db->join('user_previlege_master up', 'up.upm_id = um.admin_upm_id','left');
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		
	}// end getAllList function
	
	public function getUserInfo($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			$this->db->order_by('admin_id', 'ASC');
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	public function make_query($table="",$params = array(),$filter=array(),$orderBy=array(),$count_only=0){
	  
	  if($count_only==1){
	  	 $this->db->select('count(1) as total_row');
	  }else{
	  	$this->db->select('ca.*,up.upm_name, concat(ca1.admin_fname," ",ca1.admin_lname) as admin_name, concat(ca2.admin_fname," ",ca2.admin_lname) as edited_name');
	  }
	  
	  $this->db->from('comm_admin ca');
	  $this->db->join('user_previlege_master up', 'up.upm_id = ca.admin_upm_id');
	  $this->db->join('comm_admin ca1', 'ca1.admin_id = ca.admin_added_by');
	  $this->db->join('comm_admin ca2', 'ca2.admin_id = ca.admin_edit_by','left');
	  //filter data by searched keywords
	  if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	  	$strSearch = explode(' ', $params['search']['title']);
	  	if(count($strSearch)>0){
			
		  foreach($strSearch as $searchVal){
		   $this->db->group_start();
		   $this->db->like('ca.admin_fname',trim($searchVal));
		   $this->db->or_like('ca.admin_lname',trim($searchVal));
		   $this->db->or_like('ca.admin_designation',trim($searchVal));
		   $this->db->or_like('ca.admin_email',trim($searchVal));
		   $this->db->or_like('ca.admin_mobile',trim($searchVal));
		   $this->db->group_end();
		  }//end foreach			
		}//end if count	    
	  }//end if isset $params
	  
	  if(count($filter)>0){
		$this->db->where($filter);
	  }	
			
	  if(count($orderBy)>0){
	    foreach($orderBy as $key=>$val){
		  $this->db->order_by($key,$val);
		}				
	  }
	  
	}//end make_query function
	
	public function make_datatables($table="",$params = array(),$filter=array(),$orderBy=array()){ 
 
           $this->make_query($table,$params,$filter,$orderBy);  
           if(isset($_POST["length"]) && $_POST["length"] != -1)  
           {  
              $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           //print_r($this->db->last_query());
           return $query->result();  
    }//end make_datatables function  
    
    public function get_filtered_data($table="",$params = array(),$filter=array(),$orderBy=array()){  
    	   $count_only = 1;
           $this->make_query($table,$params,$filter,$orderBy,$count_only);  
           $query = $this->db->get();
           return ($query->num_rows() > 0)?$query->row()->total_row:0;  
    }//end get_filtered_data function 
	
}//end UserModel class