<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Individual extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_users";
	private $__indlTbl = "comm_individual_user";
	private $__id = NULL;
	private $__encId = NULL;
	protected $_config = array();
	private $__allowChkStatus =array();
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	private $__LogedDistId = 0;
	private $__LogedDeptId = 0;
	private $__currentUrl = "";
	private $__applicationName = "CSR Team";
	
	public function __construct(){
		parent::__construct();
		$this->load->model('individual/IndividualModel');
		$this->load->library('Ajax_pagination');
		
		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		$this->__allowChkStatus[] = 6;//add sub admin 4
		$this->perPage = 10;		
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		$this->__LogedDistId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_DISTID']);
		$this->__LogedDeptId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_DEPTID']);
		
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$this->__allowStatus = 1;
		}
	}//end constructor
	
	public function index(){		 	
      $this->front_view('admin/individual/index',$this->data);
	}//end index function
	
	public function ajaxPaginationData(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
        $conditions = array();
        $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $user_name  = cleanQuery($this->input->post('sTitle',TRUE));
        $user_email  = cleanQuery($this->input->post('sEmail',TRUE));
        $user_mobile  = cleanQuery($this->input->post('sMobile',TRUE));
        $status = cleanQuery($this->input->post('sStatus',TRUE));
        
        if(trim($user_name)!=""){
            $conditions['search']['title'] = $user_name;
        }
                        
        $filter = array('cu.user_type'=>2);

        if(isset($status) && trim($status)!=""){
		  $filter['cu.user_status'] = (int)$status; 
		} 
		if(isset($user_email) && trim($user_email)!=""){
		  $filter['cu.user_email'] = $user_email; 
		}
        if(isset($user_mobile) && trim($user_mobile)!=""){
		  $filter['cu.user_mobile'] = $user_mobile; 
		}
                
        $orderBy = array();
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = $this->IndividualModel->get_filtered_data($conditions,$filter);
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("manage/Individual/ajaxPaginationData");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList']=$this->IndividualModel->make_datatable($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        $this->data['AllowAccess'] = $this->__allowStatus;
        
        //load the view
        $this->load->view('admin/individual/ajaxpagination_individual', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
	public function show(){
		
	 $this->__encId = $this->uri->segment(4, NULL);
	 $this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
	 if($this->__id==NULL){
	  $this->__encId = $this->input->post('id');
	  $this->__id = encrypt_decrypt('decrypt',$this->__encId);
	 }
		
	 if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
		 $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
		 redirect('manage/Individual/');
	}
	
	//user_type 2= individual user
	$filter = array('user_id'=>$this->__id,'cu.user_type'=>2);
	$individualInfo = $this->IndividualModel->getIndividualDetails($this->__table,$filter);
	$this->data['DataList'] = $individualInfo;
		
	if($individualInfo==FALSE){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
		redirect('manage/Individual/');
	}	
		
	 $this->data['allowStatus'] = $this->__allowStatus;
	 $this->front_view('admin/individual/show',$this->data);
	}//end show function

	public function update_status(){
		
	 $this->load->library('form_validation');
	 
	 if($this->input->server('REQUEST_METHOD') == 'POST'){
	  $UserLogId=encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
	  
	  $this->__encId = $this->input->post('id');
	  $this->__id = (int)encrypt_decrypt('decrypt',$this->__encId);
	  
	  /** @DataList of project **/
	  $individualInfo = $this->IndividualModel->getSingleList($this->__table,array('user_id'=>$this->__id));

	  if(isset($individualInfo)==FALSE || count($individualInfo)==0){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
		redirect('manage/Individual/');
	  }else if($individualInfo->email_verify_status==0){
	  	$message = "Email account of this user is not verified after verification you can activate.";
	  	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>$message));
		redirect('manage/Individual/show/'.$this->__encId.'/');
	  }
	    
	    $this->form_validation->set_rules('p_comment','Comment','trim|required|min_length[2]|max_length[1000]');
	    $this->form_validation->set_rules('p_status', 'Status', 'trim|required|in_list[1,2]'); 
		if($this->__allowStatus==1){		 	
		 	$this->__status = (int)cleanQuery($this->input->post('p_status')); 
		}
		
		if($individualInfo->user_status==$this->__status){
		 $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Do not update same status again.'));
		 redirect('manage/Individual/show/'.$this->__encId.'/');
		}
	    
	    if ($this->form_validation->run() == FALSE){
           $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
           redirect('manage/Individual/show/'.$this->__encId.'/');
        }else{
        	
           $comment = cleanQuery($this->input->post('p_comment'));	
        	
           $DATAINPUT = array(
             'edit_date' => date('Y-m-d h:i:s'),
             'edit_by' => $UserLogId,
             'user_status'=> $this->__status,
             'comment'=> $comment
           );            
           
           $fullname = trim($individualInfo->user_fname." ".$individualInfo->user_lname);
           $username = $individualInfo->username;
           $email = $individualInfo->user_email;
           $mobile = $individualInfo->user_mobile;
           $user_type = $individualInfo->user_type;
           
           $activity ="Status of ".$fullname." has changed.User type is individual. Status Name is ".DisplayStatus($this->__status,TRUE).".";
           
           $emailVarificationMsg = "sorry, email is not valid or server error. Try again later.";
           
           $this->__queryStatus = $this->IndividualModel->updatedata($this->__table,$DATAINPUT,array('user_id'=>$this->__id),$activity, true,$UserLogId,'user');
				
			if($this->__queryStatus==TRUE){	
			
			 if($this->_sendEmailForStatus($fullname,$username,$email,$mobile,$user_type,$this->__status,$comment)){
		       $emailVarificationMsg = "Email successfully sent to ".$fullname.'.';
	         }
		     $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Status successfully changed. '.$emailVarificationMsg));	  				
			 
			}else{
			  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));	
			}
           redirect('manage/Individual/show/'.$this->__encId.'/');                     
        }
	 	
	 }else{
	 	show_404();
	 }//end check post method
	 
	}//end update_status function
	
	public function details(){
		
	 $this->__encId = $this->uri->segment(4, NULL);
	 $this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
	 if($this->__id==NULL){
	  $this->__encId = $this->input->post('id');
	  $this->__id = encrypt_decrypt('decrypt',$this->__encId);
	 }
		
	 if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
		 $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
		 redirect('manage/Individual/');
	}
	
	
	$filter = array('user_id'=>$this->__id,'cu.user_type'=>2);
	$individualInfo = $this->IndividualModel->getIndividualDetails($this->__table,$filter);
	$this->data['DataList'] = $individualInfo;
		
	if($individualInfo==FALSE){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
		redirect('manage/Individual/');
	}	
		
	 $this->front_view('admin/individual/view',$this->data);
	}//end show function
	
	protected function _sendEmailForStatus($name="",$username="",$email="",$mobile="",$user_type="",$status="",$comment=""){
		//Emai Configuration
		
		$this->load->helper('emailtemplate');
		
		$link = base_url('/login');	
		$user_type_name = getUserType($user_type);
		
		$emailData['full_name'] = $name; 
		$emailData['user_type_name'] = $user_type_name;
		$emailData['username'] = $username; 
		$emailData['email'] = $email; 
		$emailData['mobile'] = $mobile;  
		$emailData['status_name'] = ($status==1)?'Approved':'Rejected'; 
		$emailData['status'] = $status;
		$emailData['link'] = $link;
		$emailData['comment'] = $comment; 
					
		$emailMessage = userAccountCreation($emailData);
						
		$EmailDetails = array(
			'email_to'=>$email,
			'subject'=>'CSR '.$user_type_name.' Account Status',
			'message'=>$emailMessage,
			'email_from'=>$this->__applicationName
		);
			
		$getEmailInfo = $this->sendEmail($EmailDetails);
		return $getEmailInfo['status'];
	}
	
}//end Individual class