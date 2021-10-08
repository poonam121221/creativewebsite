<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page header
//add_footer_js(array('')); //add dynamic js in page footer

class Communication extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_communication";
	private $__projectInterestTbl = "comm_project_interest";
	private $__userprevilege = "user_previlege_master";
	private $__querytype = "comm_query_type";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('manage/ProjectModel','manage/CommunicationModel'));		
		$this->perPage = 10;
	}//end constructor
	
	public function index(){ 
	  //Create dynamic Breadcrumbs
	
	 $this->front_view('admin/communication/inbox',$this->data);
	}//end index function
	
	public function ajaxInbox(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
		$this->load->library('Ajax_pagination');	
		$this->perPage = 10;
			
        $conditions = array();
        $user_id = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_USER']['SERIALNO']);
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
		$type  = cleanQuery($this->input->post('type',TRUE));
        //set conditions for search				

		$user_type = encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
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
        $this->load->view('admin/communication/ajax_inbox', $this->data, false);
		}elseif($type == 2)
		{
		$this->load->view('admin/communication/ajax_sent', $this->data, false); 
		}
        
        }else{
        	show_404();	
		}
	}//end ajax inbox
	
	
	public function sent(){   
	  //Create dynamic Breadcrumbs
     $this->front_view('admin/communication/sent',$this->data);
	}//end index function
	
	public function add(){
			
	 //Create dynamic Breadcrumbs
	 //$this->breadcrumbs->push($this->lang->line('company_registration'), '/');
	 //$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');

	 $this->load->library('form_validation');	

	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
	 	$user_id = encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']); 
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
	   'comm_sender_type'=> 2,
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
           
       redirect('manage/communication');
      }//end chech validation
	 	
	 }//end check post method
	 
$this->data['UserTypeList'] = $this->CommunicationModel->GenerateDDList($this->__userprevilege,'upm_id','upm_name',"---SELECT USER TYPE ---",array('isdelete'=>0),array('upm_id'=>'ASC')); 

$this->data['UserTypeList'][11] = 'Company';
$this->data['UserTypeList'][12] = 'Individual User';
$this->data['UserTypeList'][13] = 'Implementation Partner';	

$user_type = encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);

unset($this->data['UserTypeList'][$user_type]);
unset($this->data['UserTypeList'][1]);
//unset($this->data['UserTypeList'][5]);
//unset($this->data['UserTypeList'][6]);

$this->data['QueryList'] = $this->CommunicationModel->GenerateDDList($this->__querytype,'query_id','query_name',"---SELECT QUERY TYPE---",array('isdelete'=>0),array('query_id'=>'ASC'));  
	 
$this->front_view('admin/communication/add_communication',$this->data);
	 
	
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
				redirect('manage/communication/add');
			}
		}else{
			$FILE_NAME = $preUploadedFile;
		}

		return $FILE_NAME;	
	}//end uploadFile function
	public function view(){
		
	 $this->__encId = $this->uri->segment(4, NULL); 
     $this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
	 if($this->__id==NULL){
	   $this->__encId = $this->input->post('id');
	   $this->__id = encrypt_decrypt('decrypt',$this->__encId);
	 }
		
	 if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
	   $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry invalid id!'));
	   redirect('manage/communication');
	 }
	 $filter = array('comm_id'=>$this->__id); 		
	 $this->data['Data']=$this->CommunicationModel->getCommunication($this->__table,$filter); 
	 $this->front_view('admin/communication/view',$this->data);
		}	
	public function update(){
		
	  $this->__encId = $this->uri->segment(4, NULL); 
     $this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
	 if($this->__id==NULL){
	   $this->__encId = $this->input->post('id');
	   $this->__id = encrypt_decrypt('decrypt',$this->__encId);
	 }	
	 if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
	   $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry invalid id!'));
	   redirect('manage/communication');
	 }
	 $filter = array('comm_id'=>$this->__id); 		
	 $this->data['Data']=$this->CommunicationModel->getCommunication($this->__table,$filter); 
	 
	 $filter = array('comm_parent_id'=>$this->__id);
	 $this->data['ReplyData']=$this->CommunicationModel->getCommunication($this->__table,$filter); 
	 
	// if( $this->data['Data']->comm_message_replay != ''){  redirect('user/communication');  }
	  $this->load->library('form_validation');	

	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
		 
	 $user_type = encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']); 
	 $user_id = encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);   
	    $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
	 	$this->form_validation->set_rules('remark', 'Remark', 'trim|required'); 
	 		 	
	 if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
      }else{   
       if(in_array($user_type,array(11,12,13))){$reply_type = 1;}else{$reply_type = 2;}     
      $remark  = cleanQuery(trim($this->input->post('remark',TRUE))); 
	  if(cleanQuery($_FILES['attachment']['name'])){ 
      $attachment = $this->_uploadFile('attachment');//communication attachment 
	  }else{
		  $attachment  = ""; 
		  }
      $COMMUNICATION = array(	
	   'comm_sender_type'=> 2,
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
           
       redirect('manage/communication');
      }//end chech validation
	 	
	 }//end check post method
	 
	 
	 $this->front_view('admin/communication/update',$this->data);
		}	
}//end Userproject class