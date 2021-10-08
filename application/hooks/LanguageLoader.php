<?php

class LanguageLoader
{
    function initialize() {

        
        $ci =& get_instance();
        $ci->load->helper('language');
        if($ci->session->has_userdata('site_lang')==FALSE){            
			$ci->session->set_userdata('site_lang','english');
		}
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            if($siteLang=="hindi"||$siteLang=="english"){
                $ci->lang->load('message',$siteLang);
            } else {
                $ci->lang->load('message','english');
            }           
        } else {
            $ci->lang->load('message','english');
        }
    }
}