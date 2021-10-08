<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_users";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = array(3);
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;

	public function __construct(){
		parent::__construct();
		$this->load->model('manage/MemberModel');
		$this->load->library('Ajax_pagination');
		$this->load->helper(array('emailtemplate'));
		$this->perPage = 10;
		
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus) || in_array($this->__LogedPrivId,array(1,2))){
			$this->__allowStatus = 1;
		}
	}//end constructor

	public function index(){
		$chapter_enc_id = $this->uri->segment(4, 0);
		$this->data['chapter_id'] = $chapter_enc_id;		
		
	    $this->front_view('admin/member/index',$this->data);
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
        $email   = cleanQuery($this->input->post('email',TRUE));
        $fomp_id = cleanQuery($this->input->post('fomp_id',TRUE));
        $chapter_enc_id = cleanQuery($this->input->post('chapter_id',TRUE));
        $chapter_id = (int)encrypt_decrypt('decrypt',$chapter_enc_id);
        $status  = cleanQuery($this->input->post('sStatus',TRUE));
        
        //if(trim($name)!=""){
            ///$conditions['search']['title'] = $name;
        //}
        $filter = array();
        
        if(trim($status)!="" && is_numeric($status)==TRUE){
        	if($status==3){
				$filter['u.user_step'] = 1;
				$conditions['search']['status'] = 0;
			}else{
				$filter['u.user_step'] = 2;
				$conditions['search']['status'] = (int)$status;
			}
            
        }
        
        if($chapter_id!=0){
           $filter['u.chapter_id'] = $chapter_id;
        }
        
        if(trim($email)!=""){
            $filter['u.user_email'] = $email;
        }
        
        if(trim($fomp_id)!=""){
            $filter['u.fomp_id'] = $fomp_id;
        }
        
        $orderBy = array('u.add_date'=>'DESC','u.user_fname'=>'ASC');
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec1 = $this->MemberModel->getAjaxRowsCount($conditions,$filter);
        $totalRec  = (isset($totalRec1))?$totalRec1->total_row:0;
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."manage/Member/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->MemberModel->getAjaxRows($conditions,$filter,$orderBy);
        $this->data['PageNo']   = $offset;
        
        //load the view
        $this->load->view('admin/member/ajaxpaginationmember', $this->data, false);
        
        }else{
        	//show_404();	
		}
    }//ajaxPaginationData

	public function edit(){
				
		$this->load->library(array('form_validation'));
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Member/');
		}
		
		if($this->isExists($this->__table,array('user_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry, data not found!'));
			redirect('manage/Member/');
		}		
		
		$this->data['DataList'] = $this->MemberModel->getSingleList($this->__table,array('u.user_id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
		  if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		  }else{
		   	$this->__status = (int)$this->data['DataList']->status;
		  }				 	
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Member/edit/'.$this->__encId.'/');
         }else{
         	
         	$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         	$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	
         	$DATAINPUT = array('user_status'=> $this->__status);
         	$filter = array('user_id'=>$this->__id);
				
		 	$this->__queryStatus = $this->MemberModel->updatedata($this->__table,$DATAINPUT,$filter);
		 	
		 	$name   = cleanQuery($this->data['DataList']->user_fname);
		 	$email  = cleanQuery($this->data['DataList']->user_email);
		 	$fompid = cleanQuery($this->data['DataList']->fomp_id);
		 	$status = $this->__status;
				
				if($this->__queryStatus==TRUE){
					
					$emailstatus = $this->_sendEmailMemberStatus($name,$email,$fompid,$status);
                                        $emailMsg ="";
					if($emailstatus['status']==FALSE){
						$emailMsg = $emailstatus['message'];
					}
					
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Changes saved successfully! '.$emailMsg));
					
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Member/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/member/edit',$this->data);
	}//end edit function
	
	public function member_view(){
				
		$fomp_encId = $this->uri->segment(4, NULL);
		$fomp_id = encrypt_decrypt('decrypt',$fomp_encId);
		
		if(($fomp_encId == NULL || $fomp_encId ==FALSE ||  $fomp_encId == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Member/');
		}
		
		if($this->isExists($this->__table,array('fomp_id'=>$fomp_id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry, data not found!'));
			redirect('manage/Member/');
		}		
		
		$this->data['DataList'] = $this->MemberModel->getSingleList($this->__table,array('u.fomp_id'=>$fomp_id));
		
	  	$this->front_view('admin/member/memberview',$this->data);
	}//end member_view function
	
	protected function _sendEmailMemberStatus($name="",$email="",$fompid="",$status=""){
		//Emai Configuration
		$account_status = "";
		if($status==1){
			$account_status = "activated";
			$account_message = "We are glad to inform you that your FoMP registration is activated.";
		}else{
			$account_status = "deactivated";
			$account_message = "Your account has been disabled by Admin. Please contact Admin for more details.";
		}
		
		$emailData['member_name'] = $name;
		$emailData['account_message'] = $account_message;
		$emailData['fompid'] = $fompid;
		$emailData['status'] = $status;
		$emailData['link'] = base_url('member/');
					
		$emailMessage = memberRegComplete($emailData); //emailtemplate helper			
						
		$EmailDetails = array(
		 'email_to'=>$email,
		 'subject' =>'Your FoMP account is '.$account_status,
		 'message' =>$emailMessage,
		 'email_from'=>""
		);
			
		$getEmailInfo = $this->sendEmail($EmailDetails);
		return $getEmailInfo;
	}
			
	public function memberreport(){
		$this->load->library(array('form_validation'));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			$fompid = cleanQuery(trim($this->input->post('fomp_id',TRUE)));
			$email  = cleanQuery(trim($this->input->post('email',TRUE)));
			$status = cleanQuery(trim($this->input->post('status',TRUE)));
			$chapter_enc_id = cleanQuery($this->input->post('chapter_id',TRUE));
            $chapter_id = (int)encrypt_decrypt('decrypt',$chapter_enc_id);
            	
            $filter  = array();
            if(trim($fompid)!=""){
				$filter['u.fomp_id'] = $fompid;
			}
			if(trim($email)!=""){
				$filter['u.user_email'] = $email;
			}
			if($chapter_id!=0){
              $filter['u.chapter_id'] = $chapter_id;
            }
			if(trim($status)!=""){
				if($status==3){
				 $filter['u.user_step'] = 1;
				 $filter['u.user_status'] =0;				 
			    }else{
			     $filter['u.user_step'] = 2;
				 $filter['u.user_status'] = (int)$status;
				}				
			}
			            
            $orderBy = array('u.add_date'=>'DESC','u.user_fname'=>'ASC');

         	$this->data['DataList'] = $this->MemberModel->getAllList($this->__table,$filter,$orderBy);
			$this->load->view('admin/member/memberreport',$this->data);
		}else{
			show_404();
		}//end chekc post method		
		
	}//end memberReport function		
			
}// end Member class