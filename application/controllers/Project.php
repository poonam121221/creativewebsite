<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Project extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_project";
	private $__catTbl = "comm_project_category";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
		$this->load->model(array('manage/ProjectModel','manage/ProjectcategoryModel','manage/ProjectMediaModel'));
	//	$this->load->model('front/ProjectModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 12;
	}//end constructor

	public function index(){

		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('project_category'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		if(checkLanguage("english")){
			$cat_title = "cat_title_en";
			$ddl_select_name = '--Select Category--';
		}else{
			$cat_title = "cat_title_hi";
			$ddl_select_name = '--श्रेणी का चयन करें--';
		}
		$filter = array('is_delete'=>0,'cat_status'=>1);
		
		$this->data['CategoryList'] = $this->ProjectcategoryModel->GenerateDDList($this->__catTbl,'cat_id',$cat_title,$ddl_select_name,$filter);
		
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/project/index',$this->data);
	}//end index function
	
	public function ajaxPaginationData(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        $category_id = (int)cleanQuery($this->input->post('c_id',TRUE));
        //set conditions for search
        
        $filter  = array('cpgc.cat_status'=>1,'cpgc.is_delete'=>0);
        if($category_id!=0){
		  $filter['cat_id']=$category_id;
		}       
        
        $orderBy = array('cpgc.order_preference'=>'asc');              
        $conditions['table'] = $this->__table;
        $conditions['category_table'] = $this->__catTbl;
        
        //total rows count
        $totalRec = count($this->ProjectcategoryModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Project/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->ProjectcategoryModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/project/ajax_project', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
	public function projectByCategory(){

		
		//Create dynamic Breadcrumbs
                add_css(array('assets/css/lightbox.min.css'));
                add_js(array('assets/js/lightbox-plus-jquery.min.js'));
		$this->breadcrumbs->push($this->lang->line('project_category'), '/project');
		$this->breadcrumbs->push($this->lang->line('project'), '/project');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/'); 
		
		$this->__encId = $this->uri->segment(2, NULL);
		$this->__id = (int)encrypt_decrypt('decrypt',$this->__encId);
		
		if(checkLanguage("english")){
			$cat_title = "cat_title_en";
			$ddl_select_name = '--Select Status--';
			$this->data['ProjectSList'] = array(''=>'--SELECT STATUS--','1'=>'Completed','2'=>'In progress');
		}else{
			$cat_title = "cat_title_hi";
			$this->data['ProjectSList'] = array(''=>'--स्थिति का चयन करें--','1'=>'पूर्ण','2'=>'अपूर्ण');
		}
		
		$filter = array('is_delete'=>0,'cat_status'=>1);
		if($this->__id==NULL || $this->__id==0){
			$filter['cat_id'] = $this->__id;
		}
		
		//$this->data['ProjectSList'] = $this->ProjectcategoryModel->GenerateDDList($this->__catTbl,'cat_id',$cat_title,$ddl_select_name,$filter);
		
		$this->data['DataList'] = (object)array('cat_id'=>$this->__id);
		//echo "<pre>";                print_r($this->data['DataList']);die;
                $this->front_view('public/project/project_view',$this->data);
	}//emd galleryByCategory
	
	public function ajaxPaginationProject(){


		if ($this->input->server('REQUEST_METHOD') === 'POST'){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $cat_id  = $this->input->post('c_id',TRUE);
		$project_status  = $this->input->post('project_status',TRUE);
        
        $filter  = array('cp.status'=>1,'cp.is_delete'=>0);
        if(trim($cat_id)!="" && is_numeric($cat_id)){
            $filter['cp.cat_id'] = $cat_id;
        }
		if(trim($project_status)!="" && is_numeric($project_status)){
            $filter['cp.project_status'] = $project_status;
        }
        
        $orderBy = array('cp.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->ProjectModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Project/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->ProjectModel->ajax_search_by_title($conditions,$filter,$orderBy);
		#echo $this->db->last_query();
		//	print_r($this->data['DataList']);die();

        $this->data['PageNo'] = $offset;
        //echo "<pre>";        print_r($this->data['DataList']);die;
        //load the view
        $this->load->view('public/project/ajax_project_view', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
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
		$this->breadcrumbs->push($this->lang->line('project_category'), '/project');
	//		$this->breadcrumbs->push($this->lang->line('project'), '/project-view/'.$this->__encId);
		$this->breadcrumbs->push($this->lang->line('project_details'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/'); 
		

		
		$filter = array('cp.status'=>1,'cp.is_delete'=>0,'id'=>$this->__id);
		$this->data['DataList'] = $this->ProjectModel->getSingleList($this->__table,$filter);

		$this->data['mediaList'] = $this->ProjectMediaModel->getAllList('comm_project_media',array("project_id"=> $this->__id));
		
		$this->front_view('public/project/view',$this->data);
	}//end about function
	
}//end class home