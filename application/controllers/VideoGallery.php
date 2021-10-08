<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class VideoGallery extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_video_gallery";
	private $__CatTable = "comm_video_gallery_category";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/VideogalleryModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 9;
	}//end constructor

	public function index(){

		 add_css(array('assets/css/lightbox.min.css'));
                add_js(array('assets/js/lightbox-plus-jquery.min.js'));
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('video_gallery'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		if(checkLanguage("english")){		
		        $option = '--Select Category--';
		        $dyColName = "cat_title_en";
		}else{
				$option = '--श्रेणी का चयन करें--';
				$dyColName = "cat_title_hi";
	    }	
	    		
		$this->data['CategoryList'] = $this->VideogalleryModel->GenerateDDList($this->__CatTable,'cat_id',$dyColName,$option,array('cat_status'=>1,'is_delete'=>0));
		
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/video_gallery/index',$this->data);
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
        $cat_id  = $this->input->post('c_id',TRUE);
        $title  = $this->input->post('sTitle',TRUE);
        if($cat_id!=0 && is_numeric($cat_id)){
            $filter['cp.cat_id'] = $cat_id;
        }
		if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        $filter  = array('cp.status'=>1);
        if(trim($cat_id)!="" && is_numeric($cat_id)){
            $filter['cp.cat_id'] = $cat_id;
        }
        
        $orderBy = array('cp.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        		
        //total rows count
        $totalRec = count($this->VideogalleryModel->ajax_search_by_title($conditions,$filter,$orderBy));

        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."VideoGallery/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->VideogalleryModel->ajax_search_by_title($conditions,$filter,$orderBy);

        $this->data['PageNo'] = $offset;

        
        //load the view
        $this->load->view('public/video_gallery/ajax_video', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
}//end class home