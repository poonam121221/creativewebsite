<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class PhotoGallery extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_photo_gallery";
	private $__catTbl = "comm_photo_gallery_category";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('manage/GalleryModel','manage/GallerycategoryModel'));
		$this->load->library('Ajax_pagination');
		$this->perPage = 12;
	}//end constructor

	public function index(){
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('photo_gallery_category'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		if(checkLanguage("english")){
			$cat_title = "cat_title_en";
			$ddl_select_name = '--Select Category--';
		}else{
			$cat_title = "cat_title_hi";
			$ddl_select_name = '--श्रेणी का चयन करें--';
		}
		$filter = array('is_delete'=>0,'cat_status'=>1);
		
		$this->data['CategoryList'] = $this->GallerycategoryModel->GenerateDDList($this->__catTbl,'cat_id',$cat_title,$ddl_select_name,$filter);
		
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/photo_gallery/index',$this->data);
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
        
        $orderBy = array('cpgc.cat_title_en'=>'asc');              
        $conditions['table'] = $this->__table;
        $conditions['category_table'] = $this->__catTbl;
        
        //total rows count
        $totalRec = count($this->GallerycategoryModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."PhotoGallery/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->GallerycategoryModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/photo_gallery/ajax_photo', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
	public function galleryByCategory(){
		
		//Create dynamic Breadcrumbs
                add_css(array('assets/css/lightbox.min.css'));
                add_js(array('assets/js/lightbox-plus-jquery.min.js'));
		$this->breadcrumbs->push($this->lang->line('photo_gallery'), '/photo-gallery');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/'); 
		
		$this->__encId = $this->uri->segment(2, NULL);
		$this->__id = (int)encrypt_decrypt('decrypt',$this->__encId);
		
		if(checkLanguage("english")){
			$cat_title = "cat_title_en";
			$ddl_select_name = '--Select Category--';
		}else{
			$cat_title = "cat_title_hi";
			$ddl_select_name = '--श्रेणी का चयन करें--';
		}
		
		$filter = array('is_delete'=>0,'cat_status'=>1);
		if($this->__id==NULL || $this->__id==0){
			$filter['cat_id'] = $this->__id;
		}
		
		$this->data['CategoryList'] = $this->GallerycategoryModel->GenerateDDList($this->__catTbl,'cat_id',$cat_title,$ddl_select_name,$filter);
		$this->data['DataList'] = (object)array('cat_id'=>$this->__id);
		//echo "<pre>";                print_r($this->data['DataList']);die;
                $this->front_view('public/photo_gallery/gallery_view',$this->data);
	}//emd galleryByCategory
	
	public function ajaxPaginationGallery(){
		
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
        
        $filter  = array('cp.status'=>1,'cp.is_delete'=>0);
        if(trim($cat_id)!="" && is_numeric($cat_id)){
            $filter['cp.cat_id'] = $cat_id;
        }
        
        $orderBy = array('cp.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->GalleryModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."PhotoGallery/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->GalleryModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        //echo "<pre>";        print_r($this->data['DataList']);die;
        //load the view
        $this->load->view('public/photo_gallery/ajax_photo_view', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
}//end class home