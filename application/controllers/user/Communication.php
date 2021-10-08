<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page header
//add_footer_js(array('')); //add dynamic js in page footer

class Communication extends Company_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_communication";
	private $__projectInterestTbl = "comm_project_interest";
	private $__userprevilege = "user_previlege_master";
	private $__querytype = "comm_query_type";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('manage/ProjectModel','user/CommunicationModel'));		
		$this->perPage = 10;
	}//end constructor
	
	public function index(){ 
	  //Create dynamic Breadcrumbs
     $this->front_view('user/communication/inbox',$this->data);
	}//end index function
	
	public function ajaxInbox(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
		$this->load->library('Ajax_pagination');	
		$this->perPage = 10;
			
        $conditions = array();
        $user_id = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
		$type  = cleanQuery($this->input->post('type',TRUE));
        //set conditions for search
       /* $project_title  = cleanQuery($this->input->post('sTitle',TRUE));
        $status = (int)$this->input->post('sStatus',TRUE);
        $project_category = (int)$this->input->post('sCategory',TRUE);
        
        if(trim($project_title)!=""){
            $conditions['search']['title'] = $project_title;
        }
                
        $filter = array('cpi.added_by'=>$user_id);
		
		if(isset($status) && trim($status)!=0){
		  $filter['cpi.interest_status'] = (int)$status; 
		}        

        if(trim($project_category)!=0){
            $filter['cpc.project_cat_id'] = $project_category; 
        }
                */
				
		if($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE'] == 1){$user_type = 11;}
		elseif($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE'] == 2){$user_type = 12;}
		elseif($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE'] == 3){$user_type = 13;}		
        $orderBy = array();
		if($type == 1)
		{
        $filter = array('comm_user_id'=>$user_id,'comm_user_type'=>$user_type); 
		}elseif($type == 2)
		{
        $filter = array('comm_added_by'=>$user_id,'comm_user_type !='=>$user_type); 
		}

        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = $this->CommunicationModel->get_filtered_data($conditions,$filter);
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("user/Userproject/ajaxProject");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
       //get posts data
       $this->data['DataList']=$this->CommunicationModel->make_datatable($conditions,$filter,$orderBy);
       $this->data['PageNo'] = $offset;
        
        //load the view
        
		if($type == 1)
		{
        $this->load->view('user/communication/ajax_inbox', $this->data, false);
		}elseif($type == 2)
		{
		$this->load->view('user/communication/ajax_sent', $this->data, false); 
		}
        
        }else{
        	show_404();	
		}
	}//end ajax inbox
	
	
	public function sent(){   
	  //Create dynamic Breadcrumbs
     $this->front_view('user/communication/sent',$this->data);
	}//end index function
	
	public function add(){
			
	 //Create dynamic Breadcrumbs
	 //$this->breadcrumbs->push($this->lang->line('company_registration'), '/');
	 //$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');

	 $this->load->library('form_validation');	

	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
	 	$user_id = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
	    $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
	 	$this->form_validation->set_rules('user_type', 'User Type', 'trim|required|min_length[1]|max_length[2]|in_list[1,2,3,4,5,6,7,8,9,10,11,12,13]'); 
	 	$this->form_validation->set_rules('user', 'User', 'trim|required|min_length[1]|max_length[2]'); 
	 	$this->form_validation->set_rules('query_type', 'Query Type', 'trim|required|min_length[1]|max_length[2]|in_list[1,2,3,4,]'); 
	 	$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
	 	$this->form_validation->set_rules('remark', 'Remark', 'trim|required'); 
	 		 	
	 if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
      }else{   
           
      $user_type = cleanQuery(trim($this->input->post('user_type',TRUE))); 
	  if(in_array($user_type,array(11,12,13))){$reply_type = 1;}else{$reply_type = 2;}
      $user  = cleanQuery(trim($this->input->post('user',TRUE))); 
      $query_type = cleanQuery(trim($this->input->post('query_type',TRUE)));	   
      $subject  = cleanQuery(trim($this->input->post('subject',TRUE))); 	
      $remark  = cleanQuery(trim($this->input->post('remark',TRUE))); 
	  if(cleanQuery($_FILES['attachment']['name'])){ 
      $attachment = $this->_uploadFile('attachment');//communication attachment 
	  }else{
		  $attachment  = ""; 
		  }
     $COMMUNICATION = array(	
	   'comm_sender_type'=> 1,
	   'comm_receiver_type' =>$reply_type,
	   'comm_receiver_id'=> $user,
	   'comm_query_type'=> $query_type,
	   'comm_subject'=> $subject,			
	   'comm_message'=> $remark,			
	   'comm_sender_id'=> $user_id,
	   'comm_attachmnet'=> $attachment,
	   'comm_add_date'=> date('Y-m-d h:i:s'),
	  );
 
	  $this->__queryStatus = $this->CommunicationModel->insertCommunicationData($COMMUNICATION);

	  if($this->__queryStatus==TRUE){
	   
		 $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted.'));
	  }else{
	    $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
	  }
           
       redirect('user/communication');
      }//end chech validation
	 	
	 }//end check post method
	 
$this->data['UserTypeList'] = $this->CommunicationModel->GenerateDDList($this->__userprevilege,'upm_id','upm_name',"---SELECT USER TYPE ---",array('isdelete'=>0),array('upm_id'=>'ASC')); 


if($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE'] != 2){$this->data['UserTypeList'][12] = 'Individual User';} 
if($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE'] != 3){$this->data['UserTypeList'][13] = 'Implementation Partner';unset($this->data['UserTypeList'][12]);}	
if($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE'] != 1){$this->data['UserTypeList'][11] = 'Company'; }
unset($this->data['UserTypeList'][1]);
unset($this->data['UserTypeList'][5]);
unset($this->data['UserTypeList'][6]);

$this->data['QueryList'] = $this->CommunicationModel->GenerateDDList($this->__querytype,'query_id','query_name',"---SELECT QUERY TYPE---",array('isdelete'=>0),array('query_id'=>'ASC'));  
	 
$this->front_view('user/communication/add_communication',$this->data);
	 
	
		}
	public function _uploadFile($initialname="",$preUploadedFile=""){
		
		if(trim($initialname)!="" && isset($_FILES[$initialname]['name'])==TRUE && trim($_FILES[$initialname]['name'])!=""){
		
		$fileInfo = getFileInfo(trim($_FILES[$initialname]['name']));
		$NEW_IMAGE = $fileInfo['filename'].round(microtime(true)).mt_rand().'.'.$fileInfo['extension'];
		
		$this->_config = array(
			'upload_path'   => "./uploads/communication/",
			'allowed_types' => "PDF|pdf",
			'file_name'     => $NEW_IMAGE,
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'=> "1048576", //Can be set to particular file size , here it is 1 MB (1024*1024*1)
		);
		
		$this->load->library('upload', $this->_config);
		$this->upload->initialize($this->_config);
		
		$FILE_NAME = "";
		$FULL_PATH = "";
	
			if($this->upload->do_upload($initialname)){

			 $data = $this->upload->data();
			 $FILE_NAME = $data['file_name'];
			 $FULL_PATH = $data['full_path'];
			 if(trim($preUploadedFile)!="" && trim($preUploadedFile)!=NULL){
				@unlink("./uploads/communication/".trim($preUploadedFile));
			 }
			
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>$this->upload->display_errors()." File name ".$initialname));
				redirect('user/communication/add');
			}
		}else{
			$FILE_NAME = $preUploadedFile;
		}

		return $FILE_NAME;	
	}//end uploadFile function
	public function view(){
		
	 $this->__encId = $this->uri->segment(3, NULL); 
     $this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
	 if($this->__id==NULL){
	   $this->__encId = $this->input->post('id');
	   $this->__id = encrypt_decrypt('decrypt',$this->__encId);
	 }
		
	 if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
	   $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry invalid id!'));
	   redirect('user/communication');
	 }
	 $filter = array('comm_id'=>$this->__id); 		
	 $this->data['Data']=$this->CommunicationModel->getCommunication($this->__table,$filter); 
	 $this->front_view('user/communication/view',$this->data);
		}	
	public function update(){
		
	  $this->__encId = $this->uri->segment(3, NULL); 
     $this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
	 if($this->__id==NULL){
	   $this->__encId = $this->input->post('id');
	   $this->__id = encrypt_decrypt('decrypt',$this->__encId);
	 }	
	 if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
	   $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry invalid id!'));
	   redirect('user/communication');
	 }
	 $filter = array('comm_id'=>$this->__id); 		
	 $this->data['Data']=$this->CommunicationModel->getCommunication($this->__table,$filter); 
	 $filter = array('comm_parent_id'=>$this->__id);
	 $this->data['ReplyData']=$this->CommunicationModel->getCommunication($this->__table,$filter); 
	/* echo '<pre>';
	 print_r($this->data);
	 die();*/   
	// if( $this->data['Data']->comm_message_replay != ''){  redirect('user/communication');  }
	  $this->load->library('form_validation');	

	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
	 	$user_id = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
	    $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
	 	$this->form_validation->set_rules('remark', 'Remark', 'trim|required'); 
	 		 	
	 if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
      }else{   
       
      $remark  = cleanQuery(trim($this->input->post('remark',TRUE))); 
	  if(cleanQuery($_FILES['attachment']['name'])){ 
      $attachment = $this->_uploadFile('attachment');//communication attachment 
	  }else{
		  $attachment  = ""; 
		  }
       $COMMUNICATION = array(	
	   'comm_sender_type'=> 1,
	   'comm_receiver_type' =>$this->data['Data']->comm_sender_type,
	   'comm_receiver_id'=> $this->data['Data']->comm_sender_id,
	   'comm_query_type'=> $this->data['Data']->comm_query_type,
	   'comm_subject'=> $this->data['Data']->comm_subject,			
	   'comm_message'=> $remark,			
	   'comm_sender_id'=> $user_id,
	   'comm_attachmnet'=> $attachment,
	   'comm_parent_id'=>$this->__id, 
	   'comm_add_date'=> date('Y-m-d h:i:s'),
	  );
 		$filter = array('comm_id'=>$this->__id); 		
	  $this->__queryStatus = $this->CommunicationModel->insertCommunicationData($COMMUNICATION,$filter);  
		
	  if($this->__queryStatus==TRUE){
	   
		 $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted.'));
	  }else{
	    $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
	  }
           
       redirect('user/communication');
      }//end chech validation
	 	
	 }//end check post method
	 
	 
	 $this->front_view('user/communication/update',$this->data);
		}	
}//end Userproject class