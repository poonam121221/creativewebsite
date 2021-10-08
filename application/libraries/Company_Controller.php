<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* $this->router->fetch_class(); //for get current class name
	* $this->router->fetch_method() //for get current function name
	**/

class Company_Controller extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'Company Dashboard';
		$this->checkAuthentication();		
	}//end constructor
	
	public function checkAuthentication(){
		$this->checkAuthUser();
	}//end checkAuthentication function
	
    protected function checkAuthUser(){   	
	  $Logged_in = $this->session->userdata('AUTH_LOCAL_USER');
	  if(!isset($Logged_in) || $Logged_in['IS_LOGED_IN']!=TRUE){
		$this->session->unset_userdata('IS_LOGED_IN');
		$this->session->sess_destroy();
		redirect('/');
		return FALSE;
	  }else{
		return TRUE;
	  }
	}//end checkAuthUser
	
	public function front_view($view,$data=array()){
	  $this->load->view('element/inc_head',$this->data);
	  $this->load->view('element/inc_nav',$data);
	  $this->load->view($view,$data);
	  $this->load->view('element/inc_footer',$data);
	}//end front_view function
        		
}//end Company Controller