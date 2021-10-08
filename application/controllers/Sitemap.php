<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Sitemap extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_menu";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
	}//end constructor

	public function index(){
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('sitemap'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/sitemap/index',$this->data);
	}//end index function
	
}//end class home