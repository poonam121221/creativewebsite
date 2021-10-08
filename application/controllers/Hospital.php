<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page header
//add_footer_js(array('')); //add dynamic js in page footer

class Hospital extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_hospital";
	private $__catTbl = "comm_hospital_category";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/HospitalModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor

	public function index(){	
	
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('hospital'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');		
		
		$ddl_select_name = "";
		if(checkLanguage("english")){
			$cat_title = "cat_title_en";
			$ddl_select_name = '--SELECT HOSPITAL TYPE--';
		}else{
			$cat_title = "cat_title_hi";
			$ddl_select_name = '--अस्पताल का प्रकार चुनें--';
		}
		
		$filter = array('is_delete'=>0,'cat_status'=>1);
		
		$cat_enc_id = cleanQuery($this->uri->segment(2, ""));
		$cat_id = "";
		
		if($cat_enc_id!=""){
			$cat_id = (int)encrypt_decrypt('decrypt',$cat_enc_id);
			$filter['cat_id']=(int)$cat_id;
			$ddl_select_name = "";
		}
		
		$this->data['CategoryList'] = $this->HospitalModel->GenerateDDList($this->__catTbl,'cat_id',$cat_title,$ddl_select_name,$filter);
		
		$this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->data['cid']= $cat_id;
		$this->front_view('public/hospital/index',$this->data);
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
        $category_id  = (int)cleanQuery($this->input->post('sCid',TRUE));
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        
        $filter  = array('um.status'=>1,'um.is_delete'=>0);
        if($category_id!=0){
			$filter['um.cat_id']=(int)$category_id;
		}
        $orderBy = array('um.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = $this->HospitalModel->get_filtered_data($conditions,$filter,$orderBy);
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Hospital/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->HospitalModel->make_datatable($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/hospital/ajax_hospital', $this->data, false);
        
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
		$this->breadcrumbs->push($this->lang->line('hospital_details'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		
		$filter = array('um.status'=>(int)1,'um.is_delete'=>(int)0,'um.id'=>(int)$this->__id);
		$this->data['DataList'] = $this->HospitalModel->getSingleList($this->__table,$filter);
		
		$this->front_view('public/hospital/view',$this->data);
	}//end about function
	
}//end class Hospital