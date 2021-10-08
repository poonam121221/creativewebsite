<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Page extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_pages";
	private $__id = NULL;
	private $__encId = NULL;
	private $__pageUrl = "homeview";
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/PageModel');
		$this->load->helper('text');
		$this->load->library('Ajax_pagination');
		$this->perPage = 5;
                
	}//end constructor

	public function index(){
		
		add_css(array('/assets/fancybox-master/dist/jquery.fancybox.min.css'));
		add_footer_js(array('/assets/js/newsticker.js','/assets/fancybox-master/dist/jquery.fancybox.min.js'));
		
		$filter = array('is_default'=>1,'page_status'=>1,'is_delete'=>0);
		$this->data['DataList'] = $this->PageModel->getSingleList($this->__table,$filter);
		
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
	
	public function content(){
            
		$this->__pageUrl = $this->uri->segment(1,"undefinded");	
		
		$filter = array('page_status'=>1,'is_delete'=>0,'page_url'=>$this->__pageUrl);
		$this->data['DataList'] = $this->PageModel->getSingleList($this->__table,$filter);
		
		//Create dynamic Breadcrumbs
		$bc_title = $this->lang->line('page'); 
		if(isset($this->data['DataList']) && count($this->data['DataList'])>0){
			$bc_title = stripslashes2(html_entity_decode($this->data['DataList']->title));
		}
		
		$this->breadcrumbs->push($bc_title, '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
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
		
		$this->data['LastUpdatedDate'] = getLastUpdatedPage($this->__pageUrl);
		
		$this->front_view('public/pageview',$this->data);
	}//end index function
	
	public function search(){
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('search'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$s_text = "";
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){	
                    
			$s_text = cleanQuery($this->input->post('page_search',TRUE));
			$valid_token = cleanQuery($this->input->post('valid_token',TRUE));
                        
			/*if($_SESSION['request_token']!== trim($valid_token)){
				//print_r("form = ".$valid_token);
				//echo "<br/>";
				//print_r("sess = ".$_SESSION['request_token']);
				//exit;
				redirect('/');
			}*/
			
			if($this->session->has_userdata('post_data') && trim($s_text) !=""){			
		      $this->session->unset_userdata('post_data');
		    }
			$this->session->set_userdata('post_data', $s_text);
			redirect('search');	// redirect this method to It Self for Preventing form resubmit		
		}//end check post method
		
		$this->front_view('public/pagesearchview',$this->data);
	}//end search function
	
	public function ajaxPaginationData(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
        $conditions = array();
        
        //calc offset number
        $page = (int)$this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        $title  = "";
        //set conditions for search
        if($this->session->has_userdata('post_data')){
		    $title = $this->session->userdata('post_data');
		}
		
		$filter  = array('page_status'=>1,'is_delete'=>0);
        $orderBy = array('page_title_en'=>'asc');
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }else{
			$filter['page_id'] = 0;
		}
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->PageModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Page/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->PageModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        $this->data['TotalRecord'] = $totalRec;
        
        //load the view
        $this->load->view('public/ajax_page', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
	public function search_details(){
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('search'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$this->__encId = $this->uri->segment(2, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('/');
		}
		
		if($this->isExists($this->__table,array('page_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('/');
		}
		
		$filter = array('page_status'=>1,'is_delete'=>0,'page_id'=>$this->__id);
		$this->data['DataList'] = $this->PageModel->getAllList($this->__table,$filter);
		$this->front_view('public/pagedetailsview',$this->data);
	}
	
}//end class home