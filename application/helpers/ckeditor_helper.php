<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');


function editor($path,$width) {
    //Loading Library For Ckeditor
    $CI =& get_instance();
    $CI->load->library('ckeditor');
    $CI->load->library('ckFinder');
    //configure base path of ckeditor folder 
    $CI->ckeditor->basePath = base_url().'js/ckeditor/';
    $CI->ckeditor-> config['toolbar'] = 'Full';
    $CI->ckeditor->config['language'] = 'en';
    $CI->ckeditor-> config['width'] = $width;
    //configure ckfinder with ckeditor config 
    $CI->ckfinder->SetupCKEditor($this->ckeditor,$path); 
}
		 
}//end form_ckeditor