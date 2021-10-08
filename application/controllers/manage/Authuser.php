<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authuser extends MY_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_admin";
	private $__id = NULL;
	private $__encId = NULL;
	private $__SpecialSymbol = ""; //!@#$%^&*?~
	const ATMPTVAL  = 3;
	const ATMPTMINUTE  = 10;
	public $data = array();
	private $__applicationName = "EPCO";

	public function __construct(){
		parent::__construct();
		$this->load->helper('security');
		$this->load->model('manage/UserModel');
		
		$this->data['site_name_hi']  = $this->config->item('site_name_hi');
		$this->data['site_name_en']  = $this->config->item('site_name_en');
		$this->data['copy_right']    = $this->config->item('copy_right');
		$this->data['meta_title']    = $this->config->item('meta_title');
		$this->data['meta_keyword']  = $this->config->item('meta_keyword');
		$this->data['meta_desc']     = $this->config->item('meta_desc');
	}//end constructor
	
	public function index(){
	//	$password = hash('sha256',"12345678");
	//	echo $password; 
		$this->load->view('admin/login/applogin',$this->data);
		$this->session->unset_userdata('AUTH_USER');		
	}//end index function

	public function checkLogin(){
		
		$this->load->library('form_validation');
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		
		$this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required');
		$this->form_validation->set_rules('user_pass', 'Password', 'trim|required');		

		if ($this->form_validation->run() == TRUE){
			$uname     = cleanQuery($this->input->post('user_name',true));
			$pass      = cleanQuery($this->input->post('user_pass',true));
			$validKey  = cleanQuery($this->input->post('valid',true));
			$LonigInfo = $this->__verifyUserAuth($uname,$pass,$validKey);
									
			if($LonigInfo['LOGIN_STATUS'] == TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>$LonigInfo['MESSAGE']));
				redirect('manage/Dashboard');
			}else{					
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>$LonigInfo['MESSAGE']));
				redirect('manage');
			}
			
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
			redirect('manage');
		}	
		}else{
			redirect('manage');
			//show_404();
		}//end check post method
		
	}//end checkLogin function

	private function __verifyUserAuth($uname, $pass,$validKey){
		
		$userinfo = array();
		if(trim($validKey)!=""){
			$getdata = $this->UserModel->login($uname,$pass,$validKey,1,self::ATMPTVAL,self::ATMPTMINUTE);
		}else{
			$getdata = array('AUTH_ERROR_MESSAGE'=>'Invalid login details.');
		}	
		
		if(isset($getdata['IS_AUTH_USER']) && strtolower($getdata['IS_AUTH_USER'])=="valid"){

			$userinfo = array(
			'AUTH_USER'=>array(
			  'SERIALNO'=> encrypt_decrypt("encrypt",$getdata["USERDATA"]->admin_id),
			  'USER_NAME'=> ucwords($getdata["USERDATA"]->admin_fname." ".$getdata["USERDATA"]->admin_lname),
			  'USER_EMAIL'=> encrypt_decrypt("encrypt",$getdata["USERDATA"]->admin_email),
			  'USER_MOBILE'=> encrypt_decrypt("encrypt",html_escape($getdata["USERDATA"]->admin_mobile)),
			  'USER_UPMID'=> encrypt_decrypt("encrypt",$getdata["USERDATA"]->admin_upm_id),
			  'USER_DEPTID'=> encrypt_decrypt("encrypt",$getdata["USERDATA"]->admin_dept_id),
			  'USER_DISTID'=> encrypt_decrypt("encrypt",$getdata["USERDATA"]->admin_dist_id),
			  'USER_ROLE'=> strtoupper(html_escape($getdata["USERDATA"]->upm_name)),
			  'USER_DESIGNATION'=> ucwords(html_escape($getdata["USERDATA"]->admin_designation)),
	          'IS_LOGED_IN'=> TRUE
	         )	        
			);
			
			$this->__id = $getdata["USERDATA"]->admin_id;
			$DATAINPUT = array("admin_last_login"=>date('Y-m-d h:i:s'));
			$FILTER = array('admin_id'=>$this->__id);
			$LOG_MSG = "User Loing successfully";
			
			$this->session->set_userdata($userinfo);
			$this->__queryStatus = $this->UserModel->updatedata($this->__table,$DATAINPUT,$FILTER,$LOG_MSG);

			

			return array('LOGIN_STATUS'=>TRUE,'MESSAGE'=>"Welcome!!");
		}else{
			return array('LOGIN_STATUS'=>FALSE,'MESSAGE'=>$getdata['AUTH_ERROR_MESSAGE']);
		}

	}//end verifyUser function
	
	public function forgot_password(){
	  
	  $this->load->library('form_validation');
	  
	  if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	  	 
	  	 $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
	  	 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
            redirect('manage/forgot-pwd');
        }else{
         	
        $email  = cleanQuery(trim($this->input->post('email',TRUE)));
        $filter = array('admin_email'=>$email,'admin_status'=>1);
         	
        $result = $this->UserModel->getRecord($this->__table,$filter);
        
        if(isset($result) && $result!=FALSE && trim($result->admin_email)!=""){
         		
        $verify_code = randomUniqueId(10);
        $name        = $result->admin_fname." ".$result->admin_lname;
        $this->__id  = $result->admin_id;
			
		$DATAINPUT = array('admin_pass_verify_code'	=>$verify_code,'exp_verify_date'=>date('Y-m-d H:i:s'));	
		$ACTIVE_STATUS = "Generate verification for password of ".$name;
		
		$this->__queryStatus = $this->UserModel->updatedata($this->__table,$DATAINPUT,array('admin_id'=>$this->__id),$ACTIVE_STATUS);	
		if($this->__queryStatus==TRUE){
		
		//Emai Configuration				
		$emailMessage = "";			
		$emailMessage .='<p>Dear '.$name.'</p>';
		//$emailMessage .='<p>Your recently requested to reset your password for your '.$this->__applicationName.' application account.</p>';
		$emailMessage .='<p>Click the link below to reset it</p>';
		$emailMessage .='<p>'.base_url('manage/reset-password/').md5($email).'/'.md5($verify_code).'</p>';
		$emailMessage .='<p>If you did not request a password reset, please ignore this email. This password reset is only valid for the next 30 minutes.</p>';
		$emailMessage .='<b>Regards</b>';
		$emailMessage .='<p>'.$this->__applicationName.'</p>';
						
		$EmailDetails = array(
			'email_to'=>$email,
			'subject'=>'Forgot password',
			'message'=>$emailMessage,
			'email_from'=>$this->__applicationName
		);
						
		$getEmailInfo = $this->sendEmail($EmailDetails);

		 if($getEmailInfo['status']==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Successfully sent reset password link to your Registered Email Address !'));
			redirect('manage/forgot-pwd');
		 }
				
			}//end check query Status
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'The E-Mail Address is not found in our records, please try again later !'));
			redirect('manage/forgot-pwd');
		}//end check result
         	
        }//end validation
         
	  	redirect('manage/forgot-pwd');
	  	
	  }//end check post method
	  
	  $this->load->view('admin/login/forgot_password',$this->data);
		
	}//end forgot_password function
	
	public function reset_password(){
		
	$this->load->library('form_validation');
	
	$email 	  	 =  $this->uri->segment(3, "");
	$verify_code =  $this->uri->segment(4, "");
	
	if ($this->input->server('REQUEST_METHOD') === 'POST'){
		$email = trim(cleanQuery($this->input->post('key')));
		$verify_code = trim(cleanQuery($this->input->post('token')));
	}
		
	if($email=="" || $verify_code==""){
		$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>'Invalid Option.'));
		redirect('manage');
	}else{
		
		$this->data['key']=$email;
		$this->data['token']=$verify_code;		
		
		$filter = array($email,$verify_code,1,date('Y-m-d H:i:s'),720);  //allow only 720 minute       	
        $result = $this->UserModel->getForgotRecord($filter);
        
        //print_r($this->db->last_query());
        
        if($result==FALSE){
        	$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>'Either key or token is invalid or your reset password time is left.'));
			redirect('manage/forgot-pwd');
		}else{
			
		}

	}//end check email and verify_code
		
	if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	
		
		$this->form_validation->set_rules('new_pass', 'Password', 'trim|required|min_length[6]|max_length[20]|valid_pass_pattern');
		$this->form_validation->set_rules('con_pass', 'Confirm Password', 'trim|required|max_length[20]|matches[new_pass]');		
		$this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');

		  if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
			redirect('manage/reset-password/'.$email.'/'.$verify_code);
		  }else{
		  	
			$name        = $result->admin_fname." ".$result->admin_lname;
	        $this->__id  = $result->admin_id;
	        $password    = cleanQuery(trim($this->input->post('new_pass',TRUE)));
				
			$DATAINPUT = array('admin_pass_verify_code'	=>'','admin_password'=> hash('sha256',$password));	
			$FILTER    = array('admin_id'=>$this->__id,'admin_status'=>1);
			$ACTIVE_STATUS = "Reset password of ".$name;
			
			$this->__queryStatus = $this->UserModel->updatedata($this->__table,$DATAINPUT,$FILTER,$ACTIVE_STATUS);	
			if($this->__queryStatus==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Your password is reset successfully'));
				redirect('manage');
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry plese try again later !'));
				redirect('manage/reset-password/'.$email.'/'.$verify_code);
			}
						
		  }//end validation else part
		
	}//end check post method

	$this->load->view('admin/login/reset_password',$this->data);
		
	}//end reset_password fucntion
	
	public function loadcaptcha(){
		echo reload_captcha(22);
	}//end loadcaptcha function
	
	public function signout(){
		$this->session->unset_userdata('AUTH_USER');
		$this->session->sess_destroy();
		redirect('manage/');
	}//end signout function

}// end Admin_Controller class