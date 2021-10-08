<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Financereport extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_financereport";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/ModulesModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){	
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('financereport'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');	
		
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
               
		$this->front_view('public/financereport/index',$this->data);
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
        
        $filter  = array('status'=>1,'is_delete'=>0,'DATE(archive_exp_date) >= '=>date('Y-m-d'));
        $orderBy = array('order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->ModulesModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Financereport/ajaxPaginationData";
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
        
        //count archive recored
        $archive_filter =array('status'=>1,'DATE(archive_exp_date) <='=>date('Y-m-d'),'is_delete'=>0);		
		$this->data['archive_count'] = $this->ModulesModel->record_count($this->__table,$archive_filter);
        
        //load the view
        $this->load->view('public/financereport/ajax_financereport', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
    
    public function archive(){
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('download_archived'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');	
					
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/financereport/archive',$this->data);
		
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
        
        $filter  = array('status'=>1,'is_delete'=>0,'DATE(archive_exp_date) <='=>date('Y-m-d'));
        $orderBy = array('title_en'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->ModulesModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Financereport/ajaxArchive";
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
        $this->load->view('public/financereport/ajax_finacaereport_archive', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxArchive
	
}//end class home