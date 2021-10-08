<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Whoswho extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_contact";
	private $__designationTbl = "comm_contact_designation";
	private $__categoryTbl = "comm_contact_category";
	private $__locationTbl = "comm_location";
	private $__pageTbl = "comm_pages";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('manage/ContactModel','manage/ContactdesignationModel','front/PageModel'));
		$this->load->library('Ajax_pagination');
		$this->perPage = 20;
	}//end constructor

	public function index(){
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('whos_who'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
				
	   if(checkLanguage("english")){
			$cat_title = "category_en";
			$ddl_select_name = '--Select Category--';
		}else{
			$cat_title = "category_hi";
			$ddl_select_name = '--श्रेणी का चयन करें--';
		}
		$filter = array('is_delete'=>0,'cat_status'=>1);
		
		$this->data['CategoryList'] = $this->ContactModel->GenerateDDList($this->__categoryTbl,'cat_id',$cat_title,$ddl_select_name,$filter);
		
		
		if(checkLanguage("english")){
			$title = "location_name_en";
			$ddl_select_name = '--Select Location--';
		}else{
			$title = "location_name_hi";
			$ddl_select_name = '--स्थान का चयन करें--';
		}
		$filter = array('status'=>1);
		
		$this->data['LocationList'] = $this->ContactModel->GenerateDDList($this->__locationTbl,'id',$title,$ddl_select_name,$filter);
	    
	    $this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/whos_who/index',$this->data);
	}//end index function
	
	public function head_office(){	
		
		$filter = array('page_status'=>1,'is_delete'=>0,'page_url'=>'head-office-info');
		$this->data['PageList'] = $this->PageModel->getSingleList($this->__pageTbl,$filter);
		
		//Create dynamic Breadcrumbs
		$bc_title = $this->lang->line('page'); 
		if(isset($this->data['PageList']) && count($this->data['PageList'])>0){
			$bc_title = $this->data['PageList']->title;
		}
		
		$this->breadcrumbs->push($bc_title, '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		if(isset($this->data['PageList']) && $this->data['PageList']!=FALSE){
			if(trim($this->data['PageList']->meta_title)!=""){
				$this->data['meta_title'] = cleanQuery($this->data['PageList']->meta_title);
			}			
			if(trim($this->data['PageList']->meta_keyword)!=""){
				$this->data['meta_keyword'] = $this->data['PageList']->meta_keyword;
			}			
			if(trim($this->data['PageList']->meta_desc)!=""){
				$this->data['meta_desc'] = $this->data['PageList']->meta_desc;
			}				
		}//end check record
	
		$filter = array('cd.status'=>1);
		$orderBy = array('cd.status'=>1,'cd.cat_id'=>'asc','cd.d_id'=>'asc','cd.order_preference'=>'asc');
		$this->data['DataList'] = $this->ContactModel->getAllList($this->__table,$filter,$orderBy);
		
		$this->front_view('public/whos_who/headoffice',$this->data);
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
        $category = (int)$this->input->post('sCategory',TRUE);
		$location = (int)$this->input->post('sLocation',TRUE);
		
    
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        if($category!=0){
		  	$conditions['search']['category'] = $category;
		}
		if($location!=0){
		  	$conditions['search']['location'] = $location;
		}
        
		$filter  = array('cd.status'=>1,'cd.is_delete' => 0);
        $orderBy = array('cd.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->ContactModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("Whoswho/ajaxPaginationData");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->ContactModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/whos_who/ajax_whos_who', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData	
    
    private function __fillDesignation(){
    	
            if(checkLanguage("english")){		
		        $str = array(''=>'--Select Designation--');
		        $dyColName = "designation_en";
		    }else{
				$str = array(''=>'--पद का चयन करें--');
				$dyColName = "designation_hi";
			}

			$filter = array('ccc.cat_status'=>1,'ccc.is_delete'=>0,'cd.status'=>1,'cd.is_delete'=>0);
			$rec =  $this->ContactdesignationModel->getAllList($this->__designationTbl,$filter);
			
			if(count($rec)>0){
			  foreach($rec as $row){
			  	$str[$row['d_id']] = $row[$dyColName];
			  }//end foreach			
			}//end count			
		
		return $str;
		
	}//end __fillDesignation
	
}//end class home