<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends Frontend_Controller {
	
	public function __construct(){
		parent::__construct();
	}//end constructor

	public function index(){		
		$this->front_view('errors/html/error_404_custom',$this->data);
	}//end index function
	
	public function error_401(){	
		$this->front_view('errors/html/error_401',$this->data);
	}//end index function
	
	public function error_403(){	
		$this->front_view('errors/html/error_403',$this->data);
	}//end index function
	
	public function error_404(){	
		$this->front_view('errors/html/error_404_custom',$this->data);
	}//end index function
	
	public function error_500(){	
		$this->front_view('errors/html/error_500',$this->data);
	}//end index function
	
	public function error_503(){	
		$this->front_view('errors/html/error_503',$this->data);
	}//end index function
	
}//end class Errors