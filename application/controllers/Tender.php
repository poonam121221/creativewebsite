<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Tender extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_tender";

	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/TenderModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){
		//Create dynamic Breadcrumbs
		
		$this->breadcrumbs->push($this->lang->line('tender'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
				
		$this->front_view('public/tender/index',$this->data);
	}//end index function
	
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
        
        $filter  = array('um.status'=>1,'um.is_delete'=>0,'DATE(archive_exp_date) >= '=>date('Y-m-d'));
        $orderBy = array('um.id'=>'desc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->TenderModel->getRows($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Tender/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->TenderModel->getRows($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //count archive record
        $archive_filter =array('status'=>1,'is_delete'=>0,'DATE(archive_exp_date) <='=>date('Y-m-d'));	
		$this->data['archive_count'] = $this->TenderModel->record_count($this->__table,$archive_filter);

        //load the view
        $this->load->view('public/tender/ajax_tender', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
    
    public function archive(){
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('tender_archived'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$this->front_view('public/tender/archive',$this->data);
		
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
        
        $filter  = array('status'=>1,'DATE(archive_exp_date) <='=>date('Y-m-d'),'is_delete'=>0);
        $orderBy = array();
              
        $conditions['table'] = $this->__table;
        		
        //total rows count
        $totalRec = count($this->TenderModel->getRows($conditions,$filter,$orderBy));

        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Circular/ajaxArchive";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->TenderModel->getRows($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/tender/ajax_tender_archive', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
	
}//end class ActsRules