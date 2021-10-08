<?php
$config['webhost_name'] = 'http://bhabha-coe.mapit.gov.in/'; 
$config['site_name_hi'] = 'पर्यावरण नियोजन एवं समन्वय संगठन';
$config['site_name_en'] = 'The Environmental Planning & Coordination Organisations';
$config['site_sub_name_hi'] = 'मध्‍यप्रदेश';
$config['site_sub_name_en'] = 'Madhya Pradesh';
$config['meta_title'] = 'The Environmental Planning & Coordination Organisation';
$config['meta_keyword'] = '';
$config['meta_desc'] = '';
$config['copy_right_en'] = 'Copyright © '.date('Y').' . All Rights Reserved.';
$config['copy_right_hi']='Copyright © '.date('Y').' . All Rights Reserved.';
$config['developed_by_en'] = "Designed & developed by Center of Excellence (CoE)";
$config['developed_by_hi'] = "Designed & developed by Center of Excellence (CoE) MAP IT";
$config['maintenance_mode'] = FALSE;//Make it TRUE when you want your site to be offline
$config['maintenance_mode_date'] = '2018/04/12';//Make it TRUE when you want your site to be offline EX. (2018/01/30)

$config['allow_access_status'] = array(1,2,3);


$csrf_false_list = array(
	'media'=>'index',
        'Adminmenu'=>'index',
        'Frontmenu'=>'add',
        'Ajaxmaster'=>'index',
        'Page'=>'ajaxPaginationData',
        'search'=>'index',
        'Rti'=>'index',
        'PhotoGallery'=>'index',
        'ImportantLinks'=>'index',
        'ImportantWebsites'=>'index',
        'NewsDetails'=>'index',
        'NoticeBoard'=>'index',
        'Whoswho'=>'index',
        'RulesActs'=>'index',
        'Download'=>'index'
    );
	
$test_uri = strtolower($_SERVER['REQUEST_URI']);
foreach($csrf_false_list as $key=>$val){
	
	if(stripos($test_uri,strtolower($key))!=FALSE && stripos($test_uri,strtolower($val))!=FALSE){
		$config['csrf_protection'] = FALSE;
		break;
	}else if(stripos($test_uri,strtolower($key))!=FALSE){
		//This check for only index function of Controller
		$config['csrf_protection'] = FALSE;
		break;
	}else{	    
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$config['csrf_protection'] = FALSE;	
		}else{
			$config['csrf_protection'] = TRUE;
		}
	}
}//end foreach for Unprotect crsf token for ajax page or some specific page
?>
