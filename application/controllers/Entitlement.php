<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Entitlement extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_entitlement";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/EntitlementModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('check_entitlement'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$filter = array('status'=>1,'is_delete'=>0);
		$orderBy = array('order_preference'=>'asc');
		$this->data['DataList'] = $this->EntitlementModel->getSingleList($this->__table,$filter,$orderBy);
		
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/entitlement/index',$this->data);
		
		//$this->fullcalender();
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
		$this->breadcrumbs->push($this->lang->line('check_entitlement'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$filter = array('status'=>1,'is_delete'=>0,'id'=>$this->__id);
		$this->data['DataList'] = $this->EntitlementModel->getSingleList($this->__table,$filter);
		
		$this->front_view('public/entitlement/view',$this->data);
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
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        
        $filter  = array('status'=>1,'is_delete'=>0);
        $orderBy = array('order_preference'=>'asc','title_en'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = $this->EntitlementModel->get_filtered_data($conditions,$filter,$orderBy);
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("Entitlement/ajaxPaginationData");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->EntitlementModel->make_datatable($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/entitlement/ajax_entitlement', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
}//end class Entitlement