<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* $this->router->fetch_class(); //for get current class name
	* $this->router->fetch_method() //for get current function name
	**/

class Admin_Controller extends MY_Controller {
	
	private $__accessTbl = "comm_auth_controller_function";
	private $__controllerName = NULL;
	private $__functionName = NULL;
	private $__allowController = "dashboard";
	
	function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'Admin Panel';
		$this->load->model(array('manage/AccesslistModel','manage/AclModel'));
		
		$this->__controllerName = strtolower($this->router->fetch_class());
	    $this->__functionName   = strtolower($this->router->fetch_method());
		
		$this->checkAuthentication();
		if($this->checkAuthentication()==TRUE){
			//$this->_checkAuthorization($this->__controllerName,$this->__functionName);
		}		
	}//end constructor
	
	public function checkAuthentication(){
		return $this->checkAuthUser();
	}//end checkAuthentication function
	
    protected function checkAuthUser(){   	
		$Logged_in = $this->session->userdata('AUTH_USER');
		if(!isset($Logged_in) || $Logged_in['IS_LOGED_IN']!=TRUE){
			$this->session->unset_userdata('IS_LOGED_IN');
			$this->session->sess_destroy();
			redirect('manage/');
			return FALSE;
		}else{
			return TRUE;
		}
	}//end checkAuthUser
	
	protected function _checkAuthorization($authCtrl="",$authFunction="",$redirect_function="index"){
		
		if(trim($authCtrl)!="" && trim($authFunction!="" && trim($authCtrl)!=strtolower($this->__allowController))){
			
		 $UserPrivilegeId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		 
		 $ProcedureMessage = array();
		 $inputparameter = array((int)$UserPrivilegeId,'manage',$authCtrl,strtolower($this->__allowController),strtolower($authFunction),strtolower($redirect_function),1);
		 $outParameter   = array('acl_count','redirect_count');
		 $this->AccesslistModel->CIProcedure('check_auth_pro',$inputparameter,$outParameter);
		 $ProcedureMessage = $this->AccesslistModel->getOutData();
		 	 	
		if($UserPrivilegeId!=1){
						
			if(count($ProcedureMessage)>0 && $ProcedureMessage[0]['@acl_count'] == 0){
				
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>"You are not authorized for this module !! "));
				
				if(count($ProcedureMessage)>0 && $ProcedureMessage[0]['@redirect_count']!=0){
					redirect('manage/'.$authCtrl.'/'.$redirect_function);
				}else{
					redirect('manage/'.$this->__allowController);
				}
			}
		}
			
		}//end check current controller and function is not empty
		return TRUE;
		
	}//end checkAuthorization function
	
	public function front_view($view,$data=array())	{
			$this->load->view('admin/element/inc_header',$this->data);
		    $this->load->view('admin/element/inc_top',$data);
		    $this->load->view('admin/element/inc_sidebar',$data);
			$this->load->view($view,$data);
			$this->load->view('admin/element/inc_footer',$data);
	}//end front_view function 
			
}//end Admin Controller