<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class RulesActs extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_rules_acts";
	private $__catTable = "comm_rules_acts_category";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/RulesactsModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){
		//Create dynamic Breadcrumbs
		$cat_name = $this->uri->segment(1, 'rules_acts');
		$resulte  = $this->RulesactsModel->getSingleList($this->__catTable,array('trim(lower(cat_title_en))'=>strtolower($cat_name)));
		$cat_name = (isset($resulte->cat_title_en))? strtolower($resulte->cat_title_en) : 'rules_acts';
		
		$this->data['dsp_title_name'] = $cat_name;
		
		if($resulte==FALSE){
			$this->data['cat_id'] = 0;
		}else{
			$this->data['cat_id'] = $resulte->cat_id;
		}
		
		$this->breadcrumbs->push($this->lang->line($cat_name), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
				
		$this->front_view('public/rules_acts/index',$this->data);
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
        $cat_id = (int)$this->input->post('cid',TRUE);	 
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        
        $filter  = array('um.status'=>1,'um.is_delete'=>0);
        if($cat_id!=0){
			$filter['up.cat_id'] = $cat_id;
		}
        
        $orderBy = array('up.cat_id'=>'asc','um.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->RulesactsModel->getRows($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."RulesActs/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->RulesactsModel->getRows($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //count archive record
        $archive_filter =array('status'=>1,'is_delete'=>0);	
		$this->data['archive_count'] = $this->RulesactsModel->record_count($this->__table,$archive_filter);
        
        //load the view
        $this->load->view('public/rules_acts/ajax_acts_rules', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
}//end class ActsRules