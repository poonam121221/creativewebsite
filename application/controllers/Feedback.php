<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Feedback extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_feedback";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/ModulesModel');
		$this->load->helper('text');
	}//end constructor

	public function index(){	
	    //Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('feedback'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');	
		
		$this->front_view('public/feedbackview',$this->data);
	}//end index function
	
	public function add(){
		
	  $this->load->library('form_validation');
		
	  if ($this->input->server('REQUEST_METHOD') == 'POST'){
	  	
	  	$this->form_validation->set_rules('uname', 'Name', 'trim|required|max_length[100]|alpha_numeric_spaces');
	  	$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');		
	  	$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|exact_length[10]|is_natural');
	  	$this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[255]|alpha_numeric_spaces');
	  	$this->form_validation->set_rules('message', 'Message', 'trim|required|max_length[500]');		
		$this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
		
		if ($this->form_validation->run() == FALSE){
          $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
          redirect('feedback');
        }else{
        	
        $DATAINPUT =array(
         'feedback_name'    => cleanQuery(trim(ucwords($this->input->post('uname',TRUE)))),
         'feedback_email'   => cleanQuery(trim($this->input->post('email',TRUE))),
         'feedback_mobile'  => cleanQuery(trim($this->input->post('mobile',TRUE))),
         'feedback_subject' => cleanQuery(trim($this->input->post('subject',TRUE))),
         'feedback_message' => strip_tags(cleanQuery(trim($this->input->post('message',TRUE))),"<strong>"),
         'feedback_date'    => date('Y-m-d h:i:s'),
         'feedback_status'  => 1,
       );
        	
        	$this->__queryStatus = $this->ModulesModel->insertdata($this->__table,$DATAINPUT);
				
			//Email Configuration
			$emailMessage = "";
			$emailMessage .='<p>Thanks '.cleanQuery(trim($this->input->post('uname',TRUE))).',</p>';	
			$emailMessage .='<p>We received your feedback message.</p>';
                        $emailMessage .='<p>We\'ll get back to you soon!!</p>';				
                        $emailMessage .='<p><b>Regards,</b></p>';
                        $emailMessage .='<p>Admin Epco</p>';
				
			$EmailDetails = array(
				'email_to'=>cleanQuery(trim($this->input->post('email',TRUE))),
				'subject'=>'Feedback Message',
				'message'=>$emailMessage,
				'email_from'=>'Epco'
			);
				
			$msg = "";
			if($this->__queryStatus==TRUE){
				$getEmailInfo = $this->sendEmail($EmailDetails);//core/MY_Controller/Email Function
				if($getEmailInfo['status']!=TRUE){
                                    $msg .= " and ".$getEmailInfo['message'];
                                }
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted'.$msg));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
			redirect('feedback');
         	
        }//end validation
	  	
	  }else{
	  	show_404();
	  }
		
	}//add function
		
}//end class home