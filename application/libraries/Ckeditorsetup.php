<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ckeditorsetup {
	
  private $ci;
	
  public function __construct(){
  	
  	$this->ci = & get_instance();
  	
  	$path = SITE_ABS_PATH.'webroot/ckfinder';
    $width = '100%';
    $height = '280px';
    $this->editor($path, $width,$height);
  }//end construct
	
  function editor($path,$width,$height) {
    //Loading Library For Ckeditor
    $this->ci->load->library('CKEditor');
    $this->ci->load->library('CKFinder');
    //configure base path of ckeditor folder 
    $this->ci->ckeditor->basePath = base_url().'webroot/ckeditor/';
    $this->ci->ckeditor->config['toolbar'] = 'Full';
    $this->ci->ckeditor->config['language'] = 'en';
    $this->ci->ckeditor->config['width'] = $width;
    $this->ci->ckeditor->config['height'] = $height;
    //configure ckfinder with ckeditor config 
    $this->ci->ckfinder->SetupCKEditor($this->ci->ckeditor,$path); 
  }//end editor function
  
}//end Ckeditorsetup class