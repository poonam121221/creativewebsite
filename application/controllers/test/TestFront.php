<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class TestFront extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_pages";
    private $__tableFeedback = "comm_test";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('test/TestModel');

		$this->load->helper('text');
	}//end constructor

	public function index(){
		$filter = array('page_url'=>'test','page_status'=>1,'is_delete'=>0);
		$this->data['DataList'] = $this->TestModel->getSingleList($this->__table,$filter);

		$this->data['testList'] = $this->TestModel->getAllList($this->__tableFeedback);
		
		if(isset($this->data['DataList']) && $this->data['DataList']!=FALSE){
			if(trim($this->data['DataList']->meta_title)!=""){
				$this->data['meta_title'] = cleanQuery($this->data['DataList']->meta_title);
			}			
			if(trim($this->data['DataList']->meta_keyword)!=""){
				$this->data['meta_keyword'] = $this->data['DataList']->meta_keyword;
			}			
			if(trim($this->data['DataList']->meta_desc)!=""){
				$this->data['meta_desc'] = $this->data['DataList']->meta_desc;
			}				
		}//end check record		
		
		$this->breadcrumbs->push($this->lang->line('test'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$this->data['LastUpdatedDate'] = getLastUpdatedPage('contact');
		$this->front_view('public/test',$this->data);
	}//end index function
	

}//end class home