<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Testimonial extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_testimonials";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
            
		parent::__construct();
		$this->load->model('front/TestimonialModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){
		
		//Create dynamic Breadcrumbs
		
		$this->breadcrumbs->push($this->lang->line('project'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$filter = array('status'=>1,'is_delete'=>0,'is_archive'=>0);
		$orderBy = array('order_preference'=>'asc');
		$this->data['DataList'] = $this->testimonialModel->getSingleList($this->__table,$filter,$orderBy);
		
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/testimonial/index',$this->data);
		
		//$this->fullcalender();
	}//end index function
	
	public function view($id){
		
        $this->__id = $this->uri->segment(2, NULL);
		

		
		$filter = array('status'=>1,'is_delete'=>0,'id'=>$this->__id);

		$this->data['DataList'] = $this->TestimonialModel->getSingleList($this->__table,$filter);

		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);


                //Create dynamic Breadcrumbs
        $this->breadcrumbs->push($this->data['DataList']->title, '/');
        $this->breadcrumbs->push($this->lang->line('testimonial'), '/');
        $this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		$this->front_view('public/testimonial/view',$this->data);
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
        
        $filter  = array('status'=>1,'is_delete'=>0,'is_archive'=>0);
        $orderBy = array('order_preference'=>'asc','title_en'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->testimonialModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("testimonial/ajaxPaginationData");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->testimonialModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/testimonial/ajax_testimonial', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
    
    public function fullcalender(){
        $this->breadcrumbs->push($this->lang->line('testimonial_activity'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
    	add_footer_js(array('assets/js/fullcalender/moment.min.js','assets/js/fullcalender/fullcalendar.min.js','assets/js/fullcalender/locale-all.js'));
    	add_css(array('assets/js/fullcalender/fullcalendar.min.css'));
		$this->front_view('public/testimonial/calendar',$this->data);
	}//end fullcalendar function
	
	public function get_testimonial(){
	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
     // Our Start and End Dates
     $start = $this->input->post("start",TRUE);
     $end = $this->input->post("end",TRUE);

     $startdt = new DateTime('now'); // setup a local datetime
     $startdt->setTimestamp($start); // Set the date based on timestamp
     $start_format = $startdt->format('Y-m-d H:i:s');

     $enddt = new DateTime('now'); // setup a local datetime
     $enddt->setTimestamp($end); // Set the date based on timestamp
     $end_format = $enddt->format('Y-m-d H:i:s');

     $testimonial = $this->testimonialModel->get_testimonial($start_format, $end_format);

     $data_testimonial = array();

     foreach($testimonial->result() as $row) {

         $data_testimonial[] = array(
             "id" => $row->id,
             "title" => $row->title,
             "description" => $row->description,
             "end" => $row->event_end_date,
             "start" => $row->event_start_date,
             "url" => base_url('testimonial/view/').encrypt_decrypt('encrypt',$row->id).'/'
         );
     }

     echo json_encode(array("testimonial" => $data_testimonial));
     exit();
     
     }else{
        	show_404();	
	 }
   }//end get_event function 	
   
   	public function projectByCategory(){
		
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
		
		$this->data['CategoryList'] = $this->testimonialModel->GenerateDDList($this->__catTbl,'cat_id',$cat_title,$ddl_select_name,$filter);
		$this->data['DataList'] = (object)array('cat_id'=>$this->__id);
		//echo "<pre>";                print_r($this->data['DataList']);die;
                $this->front_view('public/event/project_view',$this->data);
	}//emd eventByCategory
	
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
        
        $filter  = array('cp.status'=>1,'cp.is_delete'=>0);
        if(trim($cat_id)!="" && is_numeric($cat_id)){
            $filter['cp.cat_id'] = $cat_id;
        }
        
        $orderBy = array('cp.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->testimonialModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."testimonial/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->testimonialModel->ajax_search_by_title($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        //echo "<pre>";        print_r($this->data['DataList']);die;
        //load the view
        $this->load->view('public/event/ajax_project_view', $this->data, false); 
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
}//end class home