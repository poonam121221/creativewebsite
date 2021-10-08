<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Home extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_pages";
	private $__comMsgTbl = "comm_messages";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/HomeModel');
		$this->load->helper('text');
	}//end constructor

	public function index(){
           
		$filter = array('is_default'=>1,'page_status'=>1,'is_delete'=>0);
        $this->data['header_message'] = getMessageBoard(array(),array(),2);
		$this->data['DataList'] = $this->HomeModel->getSingleList($this->__table,$filter);
		$condition = array('page_status'=>1,'is_delete'=>0,'page_url'=>'quick-links');
        
		//$this->data['quickLinks'] = $this->HomeModel->getSingleList($this->__table,$condition);
                $this->data['quickLinks'] = $this->quick_links();
		//echo "<pre>";print_r($this->data['quickLinks']);die;
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
	  $this->front_view('homeview',$this->data);
	}//end index function
	
	public function about(){
		
		$filter = array('page_status'=>1,'is_delete'=>0,'page_url'=>'about-us');
		$this->data['DataList'] = $this->HomeModel->getSingleList($this->__table,$filter);

		
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
		
		$this->front_view('about_us',$this->data);
	}//end about function
	
	//this function is used for message board
	public function view_message(){
		$this->__encId = $this->uri->segment(3, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('/');
		}
		
		if($this->isExists($this->__comMsgTbl,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('/');
		}
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('view_message'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$filter = array('id'=>$this->__id,'status'=>1);
		$this->data['DataList'] = $this->HomeModel->getSingleList($this->__comMsgTbl,$filter);
		$this->front_view('public/messageboardview',$this->data);
	}//end view_message
	
	/*********************************Application Related funcation**************************************/
	
	public function loadcaptcha(){
		echo reload_captcha(22);
	}//end loadcaptcha function
	
	public function captcha_check($str){
		if(trim($str)==trim($this->session->userdata('word'))){
			return TRUE;
		}else{
			$this->form_validation->set_message('captcha_check', 'The %s field dose not matched !!');
			return FALSE;
		}
	}//end captcha_check function
        
        function quick_links(){
            
            $return = array(
                '0'=>array(
                        'url'=>'',
                        'class'=>'mdi mdi-account-box-outline',
                        'title_hi'=>'अध्यक्ष के बारे में',
                        'title_en'=>'About the chairman'
                        ),
                '1'=>array(
                        'url'=>base_url('rti'),
                        'class'=>'mdi mdi-information-outline',
                        'title_hi'=>'सूचना का अधिकार',
                        'title_en'=>'RTI'
                        ),
                '2'=>array(
                        'url'=>'',
                        'class'=>'mdi mdi-library-books',
                        'title_hi'=>'निविदा',
                        'title_en'=>'Tender'
                        ),
                '3'=>array(
                        'url'=>'',
                        'class'=>'mdi mdi-trophy-variant-outline',
                        'title_hi'=>'पुरस्कार',
                        'title_en'=>'Awards'
                        ),
                '4'=>array(
                        'url'=>'',
                        'class'=>'mdi mdi-internet-explorer',
                        'title_hi'=>'ऑनलाइन सॉफ्टवेयर',
                        'title_en'=>'Online softwares'
                        ),
                '5'=>array(
                        'url'=>'',
                        'class'=>'mdi mdi-book-variant',
                        'title_hi'=>'निर्देशिका',
                        'title_en'=>'Directory'
                        ),
                '6'=>array(
                        'url'=>'',
                        'class'=>'mdi mdi-view-list',
                        'title_hi'=>'स्थानांतरण आदेश',
                        'title_en'=>'Transfer Orders'
                        ),
                 '7'=>array(
                        'url'=>'',
                        'class'=>'mdi mdi-email-open-outline',
                        'title_hi'=>'ईमेल',
                        'title_en'=>'Email Addresses'
                        )
               
                );
            return $return;
        }
	
}//end class home 