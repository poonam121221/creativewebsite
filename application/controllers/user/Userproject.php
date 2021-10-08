<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page header
//add_footer_js(array('')); //add dynamic js in page footer

class Userproject extends Company_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_project";
	private $__projectInterestTbl = "comm_project_interest";
	private $__milestoneTbl = "comm_milestone";
	private $__projctDocTbl = "comm_project_document";
	private $__docTypeTbl = "comm_project_doc_type";
	private $__implPartnerOtherTbl = "comm_impl_partner_other";
	private $__notificationTbl = "comm_notification";
	private $__id = NULL;
	private $__encId = NULL;
	private $__status = 0;
	private $__currentUrl = "";
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('manage/ProjectModel','user/UserProjectInterestModel','manage/ProjectdocumentModel'));
		$this->perPage = 10;
	}//end constructor
	
	public function index(){ 
	  //Create dynamic Breadcrumbs
	 $this->breadcrumbs->push($this->lang->line('project'), '/');
	 $this->breadcrumbs->unshift($this->lang->line('dashboard'), '/');
	 
	 $this->data['interest_status_rec'] = 0;
     $this->front_view('user/project/index',$this->data);
	}//end index function
	
	public function assigned_project(){ 
	  //Create dynamic Breadcrumbs
	 $this->breadcrumbs->push($this->lang->line('project'), '/');
	 $this->breadcrumbs->unshift($this->lang->line('dashboard'), '/');
	 
	 $this->data['interest_status_rec'] = 1;	 
     $this->front_view('user/project/index',$this->data);
	}//end assigned_project function
	
	public function ajaxProject(){
	
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
        
        //set conditions for search
        $project_title  = cleanQuery($this->input->post('sTitle',TRUE));
        $intrest_status = (int)$this->input->post('sStatus',TRUE);
        $project_category = (int)$this->input->post('sCategory',TRUE);
        
        if(trim($project_title)!=""){
            $conditions['search']['title'] = $project_title;
        }
                
        $filter = array('cpi.added_by'=>$user_id);
		
		if(isset($intrest_status) && trim($intrest_status)!=0){
		  $filter['cpi.interest_status'] = (int)$intrest_status; 
		}        

        if(trim($project_category)!=0){
            $filter['cpc.project_cat_id'] = $project_category; 
        }
                
        $orderBy = array();
        $conditions['user_id'] = $user_id;
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = $this->UserProjectInterestModel->get_filtered_data($conditions,$filter);
        
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
       $this->data['DataList']=$this->UserProjectInterestModel->make_datatable($conditions,$filter,$orderBy);
       $this->data['PageNo'] = $offset;
       $this->data['IntrestStatus'] = $intrest_status;
        
        //load the view
        $this->load->view('user/project/ajax_project', $this->data, false);
        
        }else{
        	show_404();	
		}
	}//end project

	public function show_interest(){
	  $this->load->library('form_validation');
	  
	  if ($this->input->server('REQUEST_METHOD') == 'POST'){
	  	
	  $project_enc_id = "";
	  $project_id = 0;
	  $user_id = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
	  $user_name = $this->session->userdata['AUTH_LOCAL_USER']['USER_NAME'];
	  $user_type = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE']);
	  $user_email = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_EMAIL']);
	  $user_mobile = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_MOBILE']);
	  $user_type_name = strtolower(getUserType($user_type));
	  
	  $project_enc_id = trim($this->input->post('pid',TRUE));
	  $project_id = (int)encrypt_decrypt('decrypt',$project_enc_id);
	  $impl_partner_id = (int)trim($this->input->post('impl_partner',TRUE));
	  
	  $impl_first_name = "";
	  $impl_last_name = "";
	  $impl_email = "";
	  $impl_mobile_no = "";
	  
	  if($project_id==0){
	  	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Project id is not valid.'));
	  	redirect('project');
	  }	
	  
	  $interest_filter = array('fk_project_id'=>$project_id,'added_by'=>$user_id);
	  $count_user_interest = (int)$this->ProjectModel->record_count($this->__projectInterestTbl,$interest_filter);
	  
	  if($count_user_interest>0){
	  	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'you have already shown interest in this project!'));
	  	redirect('project/details/'.$project_enc_id);
	  }
	  
	  $this->form_validation->set_rules('impl_partner', 'Implementing Partner', 'trim|is_natural');	
	  if($impl_partner_id==99999){
	  	$this->form_validation->set_rules('impl_fname', 'First Name', 'trim|required|max_length[60]');
	  	$this->form_validation->set_rules('impl_lname', 'Last Name', 'trim|required|max_length[60]');
	  	$this->form_validation->set_rules('impl_email', 'Email', 'trim|required|max_length[60]');
	  	$this->form_validation->set_rules('impl_mob', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]');
	  }
	  $this->form_validation->set_rules('message', 'Message', 'trim|max_length[1000]');		
	  $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
	  
	  if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
        redirect('project/details/'.$project_enc_id);
      }else{
      	
      	$IMPLEMENTPARTNER = array();
      	$DATAINPUT =array(
          'fk_project_id'  =>(int)$project_id,
          'fk_impl_partner_id' => (int)$impl_partner_id,
          'message' => strip_tags(cleanQuery(trim($this->input->post('message',TRUE))),"<strong>"),
          'added_by'   => (int)$user_id,
          'added_date' => date('Y-m-d'),
          'interest_status' => 0,
        );
        
        if($impl_partner_id==99999){
		 	
		 	$impl_first_name = cleanQuery(trim($this->input->post('impl_fname',TRUE)));
	        $impl_last_name = cleanQuery(trim($this->input->post('impl_lname',TRUE)));
	        $impl_email = cleanQuery(trim($this->input->post('impl_email',TRUE)));
	        $impl_mobile_no = cleanQuery(trim($this->input->post('impl_mob',TRUE)));
	        
	        $IMPLEMENTPARTNER = array(
	         'first_name'=>$impl_first_name,
	         'last_name'=>$impl_last_name,
	         'email'=>$impl_email,
	         'mobile'=>$impl_mobile_no,
	         'fk_user_id'=>(int)$user_id,
	         'fk_project_id'=>(int)$project_id,
	         'added_date' => date('Y-m-d'),
	         'status'=>0
	        );		 	
		 }//end check other implementing partner or not
        
        $filter = array('project_id'=>(int)$project_id);
        $project_info = $this->ProjectModel->getRow($this->__table,$filter);
        $projectTitle = $project_info->project_title;
        	
        $queryoutput = $this->UserProjectInterestModel->InsertUserInstInfo($DATAINPUT,$IMPLEMENTPARTNER);
        
       if($queryoutput['status']>0){
       	 
       	 $activity =$user_name." shown interest in ".$projectTitle." project. User type is ".$user_type_name.'.';
		 $logActivity = array();		 	
		 $logActivity['log_uid']=(int)$user_id;
		 $logActivity['log_activity']=$activity;
		 $logActivity['tbl_name']=$this->__table;
		 $logActivity['column_id']=(int)$queryoutput['pi_id'];		 	
		 $logActivity['fk_project_id']=(int)$project_id;		 	
		 $this->ProjectModel->projectLog($logActivity);
		 
		 if($impl_partner_id==99999){
		 	
		 $activity = "Other Implemented User is added in ".$projectTitle.' project. by '.$user_name.'. User type is '.$user_type_name.'.';
		 $logActivity = array();		 	
		 $logActivity['log_uid']=(int)$user_id;
		 $logActivity['log_activity']=$activity;
		 $logActivity['tbl_name']=$this->__table;
		 $logActivity['column_id']=(int)$queryoutput['oi_id'];		 	
		 $logActivity['fk_project_id']=(int)$project_id;
		 $this->ProjectModel->projectLog($logActivity);
		 
		 }//end check other implementing user
		 
		 $notification_parm = array(
		   'project_id'=>$project_id,
		   'project_name'=>$projectTitle,
		   'user_id'=>$user_id,
		   'user_name'=>$user_name,
		   'user_email'=>$user_email,
		   'user_mobile'=>$user_mobile,
		   'user_type_name'=>$user_type_name,
		   'impl_id'=>$impl_partner_id,
		   'impl_email'=>$impl_email
		 );
		 
		 $this->__notificationShowInterest($notification_parm);
       	
         $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted.'));
	   }else{
		 $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
	   }
      }//end check validation
	 
	 }else{
	 	redirect('/');
	 }//end check post method	
		
	  redirect('project/details/'.$project_enc_id);
	}//end show_interest function
	
	public function document_view(){
	 add_css(array('webroot/plugins/data-tables/DT_bootstrap.css'));
	 add_footer_js(array('webroot/plugins/data-tables/jquery.dataTables.min.js','webroot/plugins/data-tables/DT_bootstrap.js'));
	 
	 //Create dynamic Breadcrumbs
	 $this->breadcrumbs->push($this->lang->line('project_document'), '/');
	 $this->breadcrumbs->unshift($this->lang->line('dashboard'), '/');
	 
	 $project_enc_id = $this->uri->segment(3, NULL);		
	 $project_id = (int)encrypt_decrypt('decrypt',$project_enc_id);
	 $user_id = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
		
	  if($project_id==0){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Invalid project information!'));
		redirect('project-assigned');
	 }
		
	 $ProjectRec = $this->ProjectModel->getSingleList($this->__table,array("project_id"=>$project_id));
	 $this->data['ProjectRecord']=$ProjectRec;
		
	 if($ProjectRec==FALSE){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
		redirect('project-assigned');
	 }
	 
	 $interest_filter = array('interest_status'=>1,'fk_project_id'=>$project_id,'added_by !='=>$user_id);
	 $count_user_interest = (int)$this->ProjectdocumentModel->record_count($this->__projectInterestTbl,$interest_filter);
	 //print_r($this->ProjectdocumentModel->db->last_query());exit();
	  
	  if($count_user_interest>0){
	  	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'You can not view document of other user assigned project!'));
	  	redirect('project-request');
	  }
	 
	 /** @CategoryList **/
	 $this->data['DocumentTypeList'] = $this->ProjectdocumentModel->GenerateDDList($this->__docTypeTbl,'doc_type_id','doc_type_title','--SELECT DOCUMENT TYPE--',array('is_delete'=>0),array('doc_type_title'=>'ASC'));
	 
	 $filter = array('pd.project_id'=>$project_id);        
	 $order = array('pd.order_preference'=>'ASC');
     $this->data['DataList'] = $this->ProjectdocumentModel->getAllUserDocument($this->__projctDocTbl,$filter,$order);   
     //load the view
     $this->data['project_enc_id'] =$project_enc_id;

     $this->front_view('user/project/project_document',$this->data);		
	}//end document_view function
	
	public function add_document(){
		$this->load->library('form_validation');
				
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		
		 $project_id = 0;
		 $project_enc_id = trim($this->input->post('pid',TRUE));		 
		 $project_id = (int)encrypt_decrypt('decrypt',$project_enc_id);
		 
		 $user_id = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
	  	 $user_name = $this->session->userdata['AUTH_LOCAL_USER']['USER_NAME'];
	  	 $user_type = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE']);
	  	 $user_email = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_EMAIL']);
	  	 $user_mobile = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_MOBILE']);
	  	 $user_type_name = strtolower(getUserType($user_type));

		 if($project_id==0){
		 	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>"Invalid information."));
		 	redirect('project-assigned');
		 }
		 
		 $ProjectRec = $this->ProjectModel->getSingleList($this->__table,array("project_id"=>$project_id));
	     $this->data['ProjectRecord']=$ProjectRec;
	     $projectTitle = $ProjectRec->project_title;
		
	     if($ProjectRec==FALSE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
		  redirect('project-assigned');
	     }
		 
		 /****Validation Rules start****/
		 $this->form_validation->set_rules('doc_title','Document Title','trim|required|min_length[2]|max_length[255]|callback_document_unique['.$project_id.']');
		 $this->form_validation->set_rules('document_type','Document Type','trim|required|is_natural');
		 if(empty($_FILES['attachment']['name'])){
    		$this->form_validation->set_rules('attachment', 'Attachment', 'required');
		 }
		 /****Validation Rules End****/	 
		
		 if($this->form_validation->run() == FALSE){
             $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
             redirect('project/document/'.$project_enc_id.'/');
         }else{
				
         $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
         $this->__currentUrl = base_url('project/document/'.$project_enc_id.'/');
         		
         $attachmentName = $this->_uploadFile();
         $project_doc_title= cleanQuery(trim($this->input->post('doc_title',TRUE)));
         
         $DATAINPUT = array(
           'project_id' =>(int)$project_id,
           'doc_type_id' =>(int)trim($this->input->post('document_type',TRUE)),
           'project_doc_title'=>$project_doc_title,
           'project_doc_attachment' => $attachmentName,
           'added_date' => date('Y-m-d h:i:s'),
           'added_by'   => $UserLogId,
           'user_panel_type'   => (int)2,
           'project_doc_status'=> $this->__status 
         );
				
		 $insertedId = 0;
		 $insertedId = $this->ProjectdocumentModel->insertsql($this->__projctDocTbl,$DATAINPUT);
		 if($insertedId>0){
		 	
		 	$activity ="New Project ".$project_doc_title." document successfully added by User.Project name is ".$ProjectRec->project_title;
		 	$logActivity = array();		 	
		 	$logActivity['log_uid']=(int)$UserLogId;
		 	$logActivity['log_activity']=$activity;
		 	$logActivity['tbl_name']=$this->__projctDocTbl;
		 	$logActivity['column_id']=(int)$insertedId;		 	
		 	$this->ProjectdocumentModel->projectLog($logActivity);
		 	
		 	$notification_parm = array(
		   		'project_id'=>$project_id,
		   		'project_name'=>$projectTitle,
		   		'user_id'=>$user_id,
		   		'user_name'=>$user_name,
		   		'user_email'=>$user_email,
		   		'user_mobile'=>$user_mobile,
		   		'user_type_name'=>$user_type_name
			);
		 
		 $this->__notificationAddDocument($notification_parm);		 	
		 $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted'));
		 
		 }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
		 }
                
         }//end validation
         
	  	 redirect('project/document/'.$project_enc_id.'/');
	  	 }//end check post method
	  	
	  	show_404();	
	  	 
	}//end function add_document
	
	public function milestone_view(){
		
	 add_css(array('webroot/plugins/data-tables/DT_bootstrap.css'));
	 add_footer_js(array('webroot/plugins/data-tables/jquery.dataTables.min.js','webroot/plugins/data-tables/DT_bootstrap.js'));
	 
	 //Create dynamic Breadcrumbs
	 $this->breadcrumbs->push($this->lang->line('project_milestone'), '/');
	 $this->breadcrumbs->unshift($this->lang->line('dashboard'), '/');
	 
	 $user_id =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
	 $actual_start_date = "";
	 $actual_end_date = "";
		
	 $project_enc_id = $this->uri->segment(3, NULL);		
	 $project_id = encrypt_decrypt('decrypt',$project_enc_id);
	  
	 if($project_id==NULL && isset($project_id)==TRUE){
	    $project_enc_id = $this->input->post('pid');
	    $project_id = encrypt_decrypt('decrypt',$project_enc_id);
	 }
		
	 if(is_null($project_id)==TRUE){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Invalid project information!'));
		redirect('project-assigned');
	 }
	 
	 $interest_filter = array('interest_status'=>1,'fk_project_id'=>$project_id,'added_by !='=>$user_id);
	 $count_user_interest = (int)$this->ProjectModel->record_count($this->__projectInterestTbl,$interest_filter);
	  
	  if($count_user_interest>0){
	  	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'You can not view milestone of other user assigned project!'));
	  	redirect('project-request');
	  }
	 
	  /** @DataList of project **/
	 $projectInfo = $this->ProjectModel->getSingleList($this->__table,array('project_id'=>(int)$project_id));
	 $milestoneInfo = $this->ProjectModel->getAllList($this->__milestoneTbl,array('project_id'=>(int)$project_id));

	 $this->data['project_enc_id'] = $project_enc_id;	  
     $this->data['project_info'] = $projectInfo;	  
     $this->data['DataList'] = $milestoneInfo;	
     $this->front_view('user/project/project_milestone',$this->data);
	}//end milestone_view function

	public function milestone_status(){
	  $this->load->library('form_validation');
				
	  if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	  
	  $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
	  $user_name = $this->session->userdata['AUTH_LOCAL_USER']['USER_NAME'];
	  $user_type = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE']);
	  $user_email = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_EMAIL']);
	  $user_mobile = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_LOCAL_USER']['USER_MOBILE']);
	  $user_type_name = strtolower(getUserType($user_type));	  
	  
	  $project_enc_id = cleanQuery($this->input->post('project_id'));
	  $project_id = (int)encrypt_decrypt('decrypt',$project_enc_id);
	  $this->__encId = cleanQuery($this->input->post('milestone_id'));
	  $this->__id = (int)encrypt_decrypt('decrypt',$this->__encId);
	  $old_status = "";
	  $new_status = "";
	  
	  $ProMilestoneRec = $this->ProjectModel->getSingleMilestone($this->__milestoneTbl,array("m.milestone_id"=>$this->__id));
	  $projectTitle = $ProMilestoneRec->project_title;
	  $old_status = MilestoneStatus($ProMilestoneRec->milestone_status,TRUE);
	  
	  if($ProMilestoneRec==FALSE){
	  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Invalid milestone information.'));
      redirect('project-assigned');
	  }
	    
	  $this->form_validation->set_rules('milestone_comment','Milestone Status Comment','trim|min_length[2]|max_length[255]');
	  $this->form_validation->set_rules('status', 'Milestone Status', 'trim|in_list[0,1,2]',array('in_list' => "Selected %s is not given in our list. "));
		
	  if ($this->form_validation->run() == FALSE){
           $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
           redirect('project/milestone/'.$project_enc_id.'/');
      }else{
        	
           $DATAINPUT = array(
             'edit_date' => date('Y-m-d h:i:s'),
             'edit_by' => $UserLogId,
             'user_panel_type' => (int)2,
             'milestone_status'=> (int)cleanQuery($this->input->post('status',TRUE)), 
             'milestone_comment'=> cleanQuery($this->input->post('milestone_comment'))
           ); 
           $filter = array('milestone_id'=>$this->__id,'project_id'=>$project_id);
           $this->__queryStatus = $this->ProjectModel->updatedata($this->__milestoneTbl,$DATAINPUT,$filter,'',FALSE);
		   	
		   if($this->__queryStatus==TRUE){
		   	  $new_status = MilestoneStatus($this->__status,TRUE);
				
			  $activity ="Status of ".$ProMilestoneRec->milestone_title." milestone of ".$projectTitle." project successfully updated by user. Status name is ".$new_status.".";
			  
			  $logActivity = array();		 	
			  $logActivity['log_uid']=(int)$UserLogId;
			  $logActivity['log_activity']=$activity;
			  $logActivity['tbl_name']=$this->__milestoneTbl;
			  $logActivity['column_id']=$this->__id;		 	
		      $this->ProjectModel->projectLog($logActivity);
		      
		      $notification_parm = array(
		   		'project_id'=>$project_id,
		   		'project_name'=>$projectTitle,
		   		'user_id'=>$UserLogId,
		   		'user_name'=>$user_name,
		   		'user_email'=>$user_email,
		   		'user_mobile'=>$user_mobile,
		   		'user_type_name'=>$user_type_name,
		   		'old_status'=>$old_status,
		   		'new_status'=>$new_status
			  );
		 
		      $this->__notificationMilestoneStatus($notification_parm);
				
			  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Status successfully updated.'));
			}else{
			  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));	
			}
           redirect('project/milestone/'.$project_enc_id.'/');
                     
        }
		
	  }else{
	  	show_404();	
	  }//end check post method  
	  
	}//end milestone_status function
	
	public function information(){
	
	 //Create dynamic Breadcrumbs
	 $this->breadcrumbs->push($this->lang->line('project_milestone'), '/');
	 $this->breadcrumbs->unshift($this->lang->line('dashboard'), '/');
	 
	 $this->__encId = $this->uri->segment(3, NULL);		
	 $this->__id = encrypt_decrypt('decrypt',$this->__encId);
	  
	 if($this->__id==NULL && isset($this->__id)==TRUE){
	    $this->__encId = $this->input->post('pid');
	    $this->__id = encrypt_decrypt('decrypt',$this->__encId);
	 }
		
	 if(is_null($this->__id)==TRUE){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Invalid project information!'));
		redirect('project-assigned');
	 }
	 
	 if($this->isExists($this->__table,array('project_id'=>$this->__id))==FALSE){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
		redirect('project-assigned');
	 }
	 
	 $filter = array('project_status > '=>0,'project_id'=>$this->__id);
	 $this->data['DataList'] = $this->ProjectModel->getProjectDetails($this->__table,$filter);
	 
	 $this->data['project_enc_id'] = $this->__encId;
	 $this->front_view('user/project/project_information',$this->data);
	}//end information function
	
	protected function _uploadFile($preUploadedFile=""){
	
		if(isset($_FILES['attachment']['name'])==TRUE && trim($_FILES['attachment']['name'])!=""){
			
		$fileInfo = getFileInfo(trim($_FILES['attachment']['name']));
		$NEW_IMAGE = $fileInfo['filename'].round(microtime(true)).mt_rand().'.'.$fileInfo['extension'];
		
		$config1 = array(
			'upload_path'   => "./uploads/project/",
			'allowed_types' => "PDF|pdf|doc|docx|xls|xlsx",
			'file_name'     => $NEW_IMAGE,
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "204800",//200 KB( 1024*200 )
		);
		$this->load->library('upload', $config1);
		$this->upload->initialize($config1);
		
		$FILE_NAME = "";
		$FULL_PATH = "";
	
			if($this->upload->do_upload('attachment')){

			$data = $this->upload->data();
			$FILE_NAME = $data['file_name'];
			$FULL_PATH = $data['full_path'];
			if(trim($preUploadedFile)!="" && trim($preUploadedFile)!=NULL){
				@unlink("./uploads/project/".trim($preUploadedFile));
			}
			
			}else{
			    $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>$this->upload->display_errors()));
				redirect($this->__currentUrl);
			}
		}else{
			$FILE_NAME = $preUploadedFile;
		}

		return $FILE_NAME;	
	}//end uploadFile function
	
	public function document_unique($value, $params){
		
		list($project_id) = explode(".", $params);
	  	$sql = "SELECT COUNT(1) as count_rec FROM ".$this->__projctDocTbl." WHERE project_id =? AND project_doc_title =?";
	  	$filter = array((int)$project_id,$value);
		$query = $this->ProjectdocumentModel->db->query($sql, $filter);
		$rec = $query->row()->count_rec;
	  	
	  	if($rec>0){
	  	   $this->form_validation->set_message('document_unique', 'The {field} should be unique.');
		  return FALSE;
		}else{
		  return TRUE;
		}
		
	}//end document_unique function
	
	private function __notificationShowInterest($info=array()){
		
	$this->load->model('user/NotificationModel');
	$this->load->helper('emailtemplate');
	
	if(count($info)>0){

	$project_id = $info['project_id'];
	$project_name = $info['project_name'];
	$user_id = $info['user_id'];
	$user_name = $info['user_name'];
	$user_email = $info['user_email'];
	$user_mobile = $info['user_mobile'];
	$user_type_name = $info['user_type_name'];
	$implement_partner_id = NULL;
	$implement_partner_email = "";
	
	if($info['project_id']!=99999){
	 $implement_partner_id = $info['impl_id'];
	}else{
	 $implement_partner_email = $info['impl_email'];
	}
	
	 /***** Filter for SMS/Notification Template *****/
	 
	 $notifyMsgFilter = array('project_name'=>$project_name,'user_name'=>$user_name,
	 'user_email'=>$user_email,'user_mobile'=>$user_mobile,'is_sms_notification'=>1);//for sms templete
	 
	 $notifyMsgFilter['msgUserType']=1;//for admin
	 $notifyMsgAdminFilter = $notifyMsgFilter;

	 $notifyMsgFilter['msgUserType']=2;//for implementing partner
	 $notifyMsgImplFilter = $notifyMsgFilter;//for sms templete
	 
	 $notifyMsgFilter['msgUserType']=3;//for company or Individual user
	 $notifyMsgUserFilter = $notifyMsgFilter;//for sms templete
	 
	 $adminSmsAdminTemplate =  userShowIntrestToProject($notifyMsgAdminFilter);//called from emailtemplete helper
	 $implPartnerSmsTemplate =  userShowIntrestToProject($notifyMsgImplFilter);//called from emailtemplete helper
	 //$userSmsTemplate =  userShowIntrestToProject($notifyMsgUserFilter);//called from emailtemplete helper
	 
	 /***** Filter for Email Template *****/
	 
	 $notifyMsgAdminFilter['is_sms_notification']=0;//for email templete
	 $notifyMsgImplFilter['is_sms_notification']=0;//for email templete
	 $notifyMsgUserFilter['is_sms_notification']=0;//for email templete
	 
	 $adminEmailTemplate =  userShowIntrestToProject($notifyMsgAdminFilter);//called from emailtemplete helper
	 $ImplPartnerEmailTemplate =  userShowIntrestToProject($notifyMsgImplFilter);//called from emailtemplete helper
	 $userEmailTemplate =  userShowIntrestToProject($notifyMsgUserFilter);//called from emailtemplete helper
	 
	 $input_parameter = array($project_id,NULL,$implement_partner_id);
	 $result = $this->NotificationModel->getNotifyEmailList($input_parameter);//call procedure for email & mobile list 
	 //[id],[user_name],[email],[mobile],[user_panel_type] => 1 [user_type]=>1 
	 //user_panel_type 1 = admin and 2 = user
	 $DATAINPUT = array();
	 
	 $adminEmail = "";
	 $adminMobile = "";
	 $userEmail = "";
	 $userMobile = "";
	 $i = 0;
	 $notificationKey = NotificationKey(); //application helper
	 
	 if($result){	 
	 	
	 	foreach($result as $row){
	 		$notemsg = "";
	 		if($row['user_panel_type']==1){
				$notemsg = $adminSmsAdminTemplate;
				$adminEmail .= $row['email'].',';
				$adminMobile .= $row['mobile'].',';
			}else{
				$notemsg = $implPartnerSmsTemplate;
				$userEmail .= $row['email'].',';
				$userMobile .= $row['mobile'].',';
			}
	 		
			$DATAINPUT[$i]['sender_user_panel'] = 2;
			$DATAINPUT[$i]['sender_id'] = $user_id;
			$DATAINPUT[$i]['recipent_user_panel'] = $row['user_panel_type'];
			$DATAINPUT[$i]['recipent_id'] = $row['id'];
			$DATAINPUT[$i]['notification_key'] = $notificationKey;
			$DATAINPUT[$i]['notification_msg'] = $notemsg;
			$DATAINPUT[$i]['created_date'] = date('Y-m-d h:i:s');
			
			$i++;
		}
		
		$adminEmail  = rtrim($adminEmail, ',');	 
		$adminMobile = rtrim($adminMobile, ',');	 
		$userEmail   = rtrim($userEmail, ',');	 
		$userMobile  = rtrim($userMobile, ',');	 
		
		if($info['project_id']==99999){
			$userEmail .= $userEmail.','.$implement_partner_email;
		}		
	 }
	 
	 $logStatus = 'Project interest related notification send to admin and implemented partner';
	 $this->__status = $this->NotificationModel->insertNotificationData($user_id,$DATAINPUT,$logStatus);
	 
	 $EmailAdminDetails = array(
			'email_to_bcc'=>$adminEmail,
			'subject'=>'CSR Project Interest',
			'message'=>$adminEmailTemplate,
			'email_from'=>'CSR Team'
	 );
	 
	 $EmailImplDetails = array(
			'email_to_bcc'=>$userEmail,
			'subject'=>'CSR Project Interest',
			'message'=>$ImplPartnerEmailTemplate,
			'email_from'=>'CSR Team'
	 );
	 
	 //$user_email is Loged user email
	 $EmailUserDetails = array(
			'email_to'=>$user_email,
			'subject'=>'CSR Project Interest',
			'message'=>$userEmailTemplate,
			'email_from'=>'CSR Team'
	 );
			
	 $getEmailInfo1 = $this->sendEmail($EmailAdminDetails);//called from core/MY_Controller
	 $getEmailInfo2 = $this->sendEmail($EmailImplDetails);//called from core/MY_Controller
	 $getEmailInfo2 = $this->sendEmail($EmailUserDetails);//called from core/MY_Controller
	 	
	 }//end check $info array()	  	
		
	}//end __notificationShowInterest
	
	private function __notificationAddDocument($info=array()){
		
	$this->load->model('user/NotificationModel');
	$this->load->helper('emailtemplate');
	
	if(count($info)>0){

	 $project_id = $info['project_id'];
	 $project_name = $info['project_name'];
	 $user_id = $info['user_id'];
	 $user_name = $info['user_name'];
	 $user_email = $info['user_email'];
	 $user_mobile = $info['user_mobile'];
	 $user_type_name = $info['user_type_name'];
	
	 /********* Filter for SMS/Notification Template *********/
	
	 $notifyMsgFilter = array('project_name'=>$project_name,'user_name'=>$user_name,'is_sms_notification'=>1);//for sms templete
	 
	 $notifyMsgFilter['msgUserType']=1;//for admin
	 $notifyMsgAdminFilter = $notifyMsgFilter;

	 $notifyMsgFilter['msgUserType']=2;//for implementing partner
	 $notifyMsgImplFilter = $notifyMsgFilter;//for sms templete
	 
	 $notifyMsgFilter['msgUserType']=3;//for company or Individual user
	 $notifyMsgUserFilter = $notifyMsgFilter;//for sms templete
	 
	 $adminSmsAdminTemplate = userNewDocumentNotification($notifyMsgAdminFilter);//called from emailtemplete helper
	 $implPartnerSmsTemplate = userNewDocumentNotification($notifyMsgImplFilter);//called from emailtemplete helper
	 
	 $input_parameter = array($project_id,1,NULL);
	 $result = $this->NotificationModel->getNotifyEmailList($input_parameter);//call procedure for email & mobile list 
	 //[id],[user_name],[email],[mobile],[user_panel_type] => 1 [user_type]=>1 
	 //user_panel_type 1 = admin and 2 = user
	 $DATAINPUT = array();
	 
	 $adminEmail = "";
	 $adminMobile = "";
	 $userEmail = "";
	 $userMobile = "";
	 $i = 0;
	 $notificationKey = NotificationKey(); //application helper
	 
	 if($result){	 
	 	
	 	foreach($result as $row){
	 		$notemsg = "";
	 		if($row['user_panel_type']==1){
				$notemsg = $adminSmsAdminTemplate;
				$adminEmail .= $row['email'].',';
				$adminMobile .= $row['mobile'].',';
				
				$DATAINPUT[$i]['sender_user_panel'] = 2;
				$DATAINPUT[$i]['sender_id'] = $user_id;
				$DATAINPUT[$i]['recipent_user_panel'] = $row['user_panel_type'];
				$DATAINPUT[$i]['recipent_id'] = $row['id'];
				$DATAINPUT[$i]['notification_key'] = $notificationKey;
				$DATAINPUT[$i]['notification_msg'] = $notemsg;
				$DATAINPUT[$i]['created_date'] = date('Y-m-d h:i:s');
				
			}else if($row['user_panel_type']==2 && $row['user_type']==3){//for Implementing Partner only
				$notemsg = $implPartnerSmsTemplate;
				$userEmail .= $row['email'].',';
				$userMobile .= $row['mobile'].',';
				
				$DATAINPUT[$i]['sender_user_panel'] = 2;
				$DATAINPUT[$i]['sender_id'] = $user_id;
				$DATAINPUT[$i]['recipent_user_panel'] = $row['user_panel_type'];
				$DATAINPUT[$i]['recipent_id'] = $row['id'];
				$DATAINPUT[$i]['notification_key'] = $notificationKey;
				$DATAINPUT[$i]['notification_msg'] = $notemsg;
				$DATAINPUT[$i]['created_date'] = date('Y-m-d h:i:s');
			}
			
			$i++;
		}
		
		$adminEmail  = rtrim($adminEmail, ',');	 
		$adminMobile = rtrim($adminMobile, ',');	 
		$userEmail   = rtrim($userEmail, ',');	 
		$userMobile  = rtrim($userMobile, ',');	 
	
	 }
	 
	 $logStatus = 'Project document related notification send to admin and implemented partner';
	 $this->__status = $this->NotificationModel->insertNotificationData($user_id,$DATAINPUT,$logStatus);
	 	
	 }//end check $info array()	  	
		
	}//end __notificationAddDocument
	
	private function __notificationMilestoneStatus($info=array()){
		
	$this->load->model('user/NotificationModel');
	$this->load->helper('emailtemplate');
	
	if(count($info)>0){

	 $project_id = $info['project_id'];
	 $project_name = $info['project_name'];
	 $user_id = $info['user_id'];
	 $user_name = $info['user_name'];
	 $user_email = $info['user_email'];
	 $user_mobile = $info['user_mobile'];
	 $user_type_name = $info['user_type_name'];
	 $old_status = $info['old_status'];
	 $new_status = $info['new_status'];
	
	 /********* Filter for SMS/Notification Template *********/
	
	 $notifyMsgFilter = array('project_name'=>$project_name,'user_name'=>$user_name,'is_sms_notification'=>1,
	 'old_status'=>$old_status,'new_status'=>$new_status);//for sms templete
	 
	 $adminSmsAdminTemplate = milestoneStatusNotification($notifyMsgFilter);//called from emailtemplete helper
	 $implPartnerSmsTemplate = milestoneStatusNotification($notifyMsgFilter);//called from emailtemplete helper
	 
	 $input_parameter = array($project_id,1,NULL);
	 $result = $this->NotificationModel->getNotifyEmailList($input_parameter);//call procedure for email & mobile list 
	 //[id],[user_name],[email],[mobile],[user_panel_type] => 1 [user_type]=>1 
	 //user_panel_type 1 = admin and 2 = user
	 $DATAINPUT = array();
	 
	 $adminEmail = "";
	 $adminMobile = "";
	 $userEmail = "";
	 $userMobile = "";
	 $i = 0;
	 $notificationKey = NotificationKey(); //application helper
	 
	 if($result){	 
	 	
	 	foreach($result as $row){
	 		$notemsg = "";
	 		if($row['user_panel_type']==1){
				$notemsg = $adminSmsAdminTemplate;
				$adminEmail .= $row['email'].',';
				$adminMobile .= $row['mobile'].',';
				
				$DATAINPUT[$i]['sender_user_panel'] = 2;
				$DATAINPUT[$i]['sender_id'] = $user_id;
				$DATAINPUT[$i]['recipent_user_panel'] = $row['user_panel_type'];
				$DATAINPUT[$i]['recipent_id'] = $row['id'];
				$DATAINPUT[$i]['notification_key'] = $notificationKey;
				$DATAINPUT[$i]['notification_msg'] = $notemsg;
				$DATAINPUT[$i]['created_date'] = date('Y-m-d h:i:s');
				
			}else if($row['user_panel_type']==2 && $row['user_type']==3){//for Implementing Partner only
				$notemsg = $implPartnerSmsTemplate;
				$userEmail .= $row['email'].',';
				$userMobile .= $row['mobile'].',';
				
				$DATAINPUT[$i]['sender_user_panel'] = 2;
				$DATAINPUT[$i]['sender_id'] = $user_id;
				$DATAINPUT[$i]['recipent_user_panel'] = $row['user_panel_type'];
				$DATAINPUT[$i]['recipent_id'] = $row['id'];
				$DATAINPUT[$i]['notification_key'] = $notificationKey;
				$DATAINPUT[$i]['notification_msg'] = $notemsg;
				$DATAINPUT[$i]['created_date'] = date('Y-m-d h:i:s');
			}
			
			$i++;
		}
		
		$adminEmail  = rtrim($adminEmail, ',');	 
		$adminMobile = rtrim($adminMobile, ',');	 
		$userEmail   = rtrim($userEmail, ',');	 
		$userMobile  = rtrim($userMobile, ',');	 	
	 }
	 
	 $logStatus = 'Project milestone related notification send to admin and implemented partner';
	 $this->__status = $this->NotificationModel->insertNotificationData($user_id,$DATAINPUT,$logStatus);
	 	
	 }//end check $info array()	  	
		
	}//end __notificationMilestoneStatus
	
}//end Userproject class