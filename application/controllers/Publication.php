<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Publication extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_publications";
    private $__cattable = "comm_publications_category";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/PublicationModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){

		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('publication'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');		
		$this->front_view('public/publication/index',$this->data);
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
        $category_id  = '';
        if ($this->input->post('category_id',TRUE)) {
            $category_id  = encrypt_decrypt('decrypt',cleanQuery($this->input->post('category_id',TRUE)));
            $filter  = array('status'=>1,'is_delete'=>0,'cat_id'=> $category_id );
                     //count archive recored
        $archive_filter =array('status'=>1,'is_delete'=>1,'cat_id'=> $category_id);
        } else {
                     //count archive recored
            $archive_filter =array('status'=>1,'is_delete'=>1);
            $filter  = array('status'=>1,'is_delete'=>0 );
        }
            
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        
        $orderBy = array('order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->PublicationModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Publication/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $this->data['category_id'] = $category_id ;
        
        //get posts data
        $this->data['DataList'] = $this->PublicationModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
		
		$this->data['archive_count'] = $this->PublicationModel->record_count($this->__table,$archive_filter);
        
        //load the view
        $this->load->view('public/publication/ajax_publication', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
    
    public function archive(){
		
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('publication_archived'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');		
					
		$this->front_view('public/publication/archive',$this->data);
		
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
        $category_id  = "";
         if ($this->input->post('category_id',TRUE)) {
            $category_id  = cleanQuery($this->input->post('category_id',TRUE));
            $filter  = array('status'=>1,'is_delete'=>1,'cat_id'=> $category_id );
                     //count archive recored
        } else {
                     //count archive recored
            $filter =array('status'=>1,'is_delete'=>1);
        }
        $orderBy = array('order_preference'=>'asc','title_en'=>'asc');              
        $conditions['table'] = $this->__table;        
        //total rows count
        $totalRec = count($this->PublicationModel->ajax_search_by_title($conditions,$filter,$orderBy));        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Publication/ajaxArchive";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
         $this->data['category_id'] = $category_id ;
        $this->ajax_pagination->initialize($config);        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;        
        //get posts data
        $this->data['DataList'] = $this->PublicationModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;        
        //load the view
        $this->load->view('public/publication/ajax_publication_archive', $this->data, false);        
        }else{
        	show_404();	
		}
    }//ajaxArchive

  // Get all the publication of $category_id
    public function getArcByCategory($category_id) {
        //Create dynamic Breadcrumbs
        $categoryDetails = $this->PublicationModel->getCategeoryDetails($category_id);
        if (count($categoryDetails)>0) {
            $this->breadcrumbs->push($this->lang->line('publication'), '/');
            $this->breadcrumbs->push($categoryDetails->title, '/');
        } else {
            $this->breadcrumbs->push($this->lang->line('publication'), '/');
        }
        $this->data['title'] =$this->lang->line('publication_archived').' '. $categoryDetails->title ;
        $this->data['category_id'] = $category_id;
        $this->breadcrumbs->unshift($this->lang->line('home_page'), '/');       
        $this->front_view('public/publication/archive',$this->data);      
    }


    // Get all the publication of $category_id
    public function getPublicationByCategory($category_id) {
        //Create dynamic Breadcrumbs
        $cat_id = encrypt_decrypt('decrypt',$category_id);
        if(($cat_id == NULL || $cat_id ==FALSE ||  $cat_id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('/');
		}		
		if($this->isExists($this->__cattable,array('cat_id'=>$cat_id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('/');
		}        
        $categoryDetails = $this->PublicationModel->getCategeoryDetails($cat_id);
        if (count($categoryDetails)>0) {
            $this->breadcrumbs->push($this->lang->line('publication'), '/');
            $this->breadcrumbs->push($categoryDetails->title, '/');
        } else {
            $this->breadcrumbs->push($this->lang->line('publication'), '/');
        }
        $this->data['title'] = $categoryDetails->title ;
        $this->data['category_id'] = $category_id;
        $this->breadcrumbs->unshift($this->lang->line('home_page'), '/');       
        $this->front_view('public/publication/categorylist',$this->data);      
    } 
}//end class home