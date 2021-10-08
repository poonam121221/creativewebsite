<?php
class Frontend_Controller extends MY_Controller {
	function __construct(){
		parent::__construct();
                
	}
	
	public function front_view($view,$data=array()){
		$this->load->view('element/inc_head',$this->data);
        $this->load->view('element/inc_header',$this->data);
		$this->load->view($view,$data);
		$this->load->view('element/inc_footer',$data);
	}//end front_view function
	
	/*
	public function checkAuthentication(){
		$this->checkAuthUser();
	}//end checkAuthentication function
	
    protected function checkAuthUser(){   	
		$Logged_in = $this->session->userdata('AUTH_REG_USER');
		if(!isset($Logged_in) || $Logged_in['IS_LOGED_IN']!=TRUE){
			$this->session->unset_userdata('IS_LOGED_IN');
			$this->session->sess_destroy();
			redirect('sign-in');
			return FALSE;
		}else{
			return TRUE;
		}
	}//end checkAuthUser
	*/
	
	public function logout(){
		$this->session->unset_userdata('AUTH_LOCAL_USER');
		redirect('sign-in');
	}//end logout function
	
	
}//end Forntend _Controller