<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_feedback";
	private $__id = NULL;
	private $__encId = NULL;
	protected $_config = array();
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/FeedbackModel');
		$this->load->helper('text');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}//end constructor
	
	public function index(){    
        //load the view
        $this->front_view('admin/feedback/index',$this->data);
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
        
        //set conditions for search
        $title  = $this->input->post('sTitle',TRUE);
        $status = "";
        $sortBy = "";
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        if(trim($status)!=""){
            $conditions['search']['status'] = (int)$status;
        }
        
        
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = $this->FeedbackModel->getRowsCount($conditions);
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."manage/Feedback/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->FeedbackModel->getRows($conditions);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('admin/feedback/ajaxpaginationfeedback', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
}//end Feedback class