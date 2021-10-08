<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/DashboardModel');
	}//end constructor
	
	public function index(){
	  	$this->front_view('admin/dashboard/index',$this->data);
	}//end index function
	
}//end Dashboard class