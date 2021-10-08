<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Message extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_messages";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/MessageModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){
            $this->breadcrumbs->push($this->lang->line('message'), '/');
            $this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		$this->__encId = $this->uri->segment(2, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('/');
		}		
		
		$filter = array('status'=>1,'is_delete'=>0,'is_archive'=>0,'id'=>$this->__id);
		$this->data['DataList'] = $this->MessageModel->getSingleList($this->__table,$filter);
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/message/index',$this->data);
	}//end index function
	
	public function view(){
             $this->breadcrumbs->push($this->lang->line('message'), '/');
            $this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		$this->__encId = $this->uri->segment(3, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('/');
		}		
		
		$filter = array('status'=>1,'is_delete'=>0,'id'=>$this->__id);
		$this->data['DataList'] = $this->MessageModel->getSingleList($this->__table,$filter);
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/message/index',$this->data);
		
	}//end about function
	
		
	
		
	
}//end class home