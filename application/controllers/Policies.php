<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Policies extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_policies";
	private $__PolicyCatTbl = "comm_policies_category";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/PolicyModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 12;
	}//end constructor

	public function index(){
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('policies'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		add_css(array('/assets/fancybox-master/dist/jquery.fancybox.min.css'));
		add_footer_js(array('/assets/fancybox-master/dist/jquery.fancybox.min.js'));
		
		if(checkLanguage("english")){		
		        $option = array(''=>'--Select Category--');
		        $dyColName = "policies_category_title_en";
		}else{
				$option = array(''=>'--श्रेणी का चयन करें--');
				$dyColName = "policies_category_title_hi";
	    }	
	    		
		$this->data['CategoryList'] = $this->PolicyModel->GenerateDDList($this->__PolicyCatTbl,'policies_category_id',$dyColName,$option,array('cat_status'=>1,'is_delete'=>0));
		
		$this->front_view('public/policies/index',$this->data);
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
        $cat_id  = (int)$this->input->post('c_id',TRUE);
        
        $filter  = array('cp.status'=>1,'cp.is_delete'=>0);
        if(trim($cat_id)!="" && is_numeric($cat_id)){
            $filter['cp.cat_id'] = $cat_id;
        }
        
        $orderBy = array('cp.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->PolicyModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Policy/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->PolicyModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/policies/ajax_policy', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
}//end class home