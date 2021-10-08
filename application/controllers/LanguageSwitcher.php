<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageSwitcher extends Frontend_Controller {
	
	public function __construct(){
		parent::__construct();
	}//end constructor

	function switchLang($language = "") {   
        
        $language = ($language != "") ? $language : "hindi";
        $this->session->set_userdata('site_lang', $language);
        if ($language=="hindi"||$language =="english" ){}else {
        //    redirect('Errors'); 
        } 
        var_dump(parse_url(base_url()));
      //  print_r($_SERVER);die;
        //print_r(base_url().''.$_SERVER['REDIRECT_QUERY_STRING']);     
        
        
        redirect($_SERVER['HTTP_REFERER']);        
    }//end switchLang
		
}//end class LanguageSwitcher