<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class EmergencyContact extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_emergency_contact";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/EmergencyContactModel','EmergencyContact');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){
            $this->breadcrumbs->push($this->lang->line('emergency_contact'), '/');
            $this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
             if (checkLanguage("english")) {
                 $str = 'district_name';
             }else{
                 $str = 'district_name_h';
             }
              $district ='';
             if ($this->input->server('REQUEST_METHOD') === 'POST'){
   
                  $district  = cleanQuery($this->input->post('searchdistrict',TRUE));
             }
                $this->data['searchdistrict'] =  $district;
		$this->data['district']=$this->EmergencyContact->GenerateDDList('comm_district','district_name',$str,$this->lang->line('all_district'),array('enabled'=>1));
		//print_r( $this->data['searchdistrict']);die;
                $this->front_view('public/emergency_contact/index',$this->data);
	}//end index function
        public function view(){
		
		$this->__encId = $this->uri->segment(3, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('/');
		}		
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('news_details'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$filter = array('status'=>1,'is_delete'=>0,'is_archive'=>0,'id'=>$this->__id);
		$this->data['DataList'] = $this->ModulesModel->getSingleList($this->__table,$filter);
		
		$this->front_view('public/whats_new/view',$this->data);
	}//end about function
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
        
        //set conditions for search 
        $title  = cleanQuery($this->input->post('sTitle',TRUE));
        $district  = cleanQuery($this->input->post('selectDistrict',TRUE));
        
        
        if(trim($district)!="" && trim($district)!=$this->lang->line('all_district')  ){
            $conditions['search']['district'] = $district;
        }
        
        $filter  = array('contact_status'=>1);
        $orderBy = array('contact_id'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = $this->EmergencyContact->get_filtered_data($conditions,$filter,$orderBy);
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."EmergencyContact/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->EmergencyContact->make_datatable($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
       //echo "<pre>";       print_r( $this->data['DataList']);die;
        
        //load the view
        $this->load->view('public/emergency_contact/ajax_index', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
    
    public function archive(){
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('whats_new_archived'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
					
		$this->front_view('public/whats_new/archive',$this->data);
		
	}//end archive function
	
	public function ajaxArchive(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
        $conditions = array();
        
        //calc offset number
        $page = (int)$this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $title  = cleanQuery($this->input->post('sTitle',TRUE));
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        
        $filter  = array('status'=>1,'is_delete'=>0,'is_archive'=>1);
        $orderBy = array('order_preference'=>'asc','title_en'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->ModulesModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."WhatsNew/ajaxArchive";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->ModulesModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/whats_new/ajax_whats_new_archive', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxArchive
	
}//end class home