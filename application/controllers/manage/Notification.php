<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page header
//add_footer_js(array('')); //add dynamic js in page footer

class Notification extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_notification";
	private $__adminTbl = "comm_admin";
	private $__userTbl = "comm_users";
	private $__id = NULL;
	private $__encId = NULL;
	private $__status = 0;
	private $__currentUrl = "";
	private $__userPanelType = 1;//1=admin panel
	private $__loggedUserId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('user/NotificationModel'));
		$this->perPage = 10;
		$this->__loggedUserId = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_USER']['SERIALNO']);
	}//end constructor
	
	public function index(){
		
	 $UserName = $this->session->userdata['AUTH_USER']['USER_NAME'];
	 $DATAINPUT = array('read_date'=>date('Y-m-d'),'is_unread'=>1);
	 $filter = array('recipent_id'=>$this->__loggedUserId);
	 $logActivity = $UserName." have read notification.";
	 $this->__queryStatus = $this->NotificationModel->updatedata($this->__table,$DATAINPUT,$filter,$logActivity,TRUE,$this->__loggedUserId); 	 
	 
     $this->front_view('admin/notification/index',$this->data);
	}//end index function
	
	public function ajaxNotification(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
		$this->load->library('Ajax_pagination');	
		$this->perPage = 10;
			
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
                
        $filter = array(
         'cn.is_delete'=>0,
         'cn.recipent_id'=>$this->__loggedUserId,
         'cn.recipent_user_panel'=>$this->__userPanelType
        );       
                
        $orderBy = array('created_date'=>'DESC');
        $conditions['notificationTbl'] = $this->__table;
        $conditions['adminTbl'] = $this->__adminTbl;
        $conditions['userTbl'] = $this->__userTbl;
        $conditions['userPanel'] = $this->__userPanelType;
        
        //total rows count
        $totalRec = $this->NotificationModel->get_filtered_data($conditions,$filter);
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("manage/Notification/ajaxNotification");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
       //get posts data
       $this->data['DataList']=$this->NotificationModel->make_datatable($conditions,$filter,$orderBy);
       $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('admin/notification/ajax_notification', $this->data, false);
        
        }else{
        	show_404();	
		}
	}//end project
	
}//end Notification class