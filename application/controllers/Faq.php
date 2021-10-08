<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class Faq extends Frontend_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_faq";
        private $__catTbl = "comm_faq_category";
        private $__feedback = "comm_feedback";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('front/FaqModel');
		$this->load->library('Ajax_pagination');
		$this->perPage = 100;
	}//end constructor

	public function index(){	
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('faq'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
                $this->data['LastUpdatedDate'] = getLastUpdatedModule($this->__table);
		$this->front_view('public/faq/index',$this->data);
	}//end index function
	
	public function ajaxPaginationData(){
            if(checkLanguage("english")){
                $str = 'cat_title_en';
            }else{
                $str = 'cat_title_hi';
            }
	$this->data['CategoryList'] = $this->FaqModel->GenerateDDList($this->__catTbl,'cat_id',$str,'',array('cat_status'=>1,'is_delete'=>0));
	  		
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
        
        $filter = array('faq.status'=>1,'faq.is_delete'=>0);
        $orderBy = array('order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
                
        //total rows count
        $totalRec = count($this->FaqModel->ajax_search_by_title($conditions,$filter,$orderBy));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."Faq/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 3;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->FaqModel->ajax_search_by_title($conditions,$filter,$orderBy);
       // echo "<pre>";print_r($this->data['DataList']);die;
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('public/faq/ajax_faq', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
    
    public function answer(){
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

        $filter = array('status'=>1,'is_delete'=>0,'id'=>$this->__id);
        $this->data['DataList'] = $this->FaqModel->getSingleList($this->__table,$filter);

        $this->front_view('public/faq/answer',$this->data);
    }
    public function askQuestion(){
        $this->load->library('form_validation');
		$this->breadcrumbs->push($this->lang->line('askquestion'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
	  if ($this->input->server('REQUEST_METHOD') == 'POST'){
	  	
	  	$this->form_validation->set_rules('uname', 'Name', 'trim|required|max_length[100]|alpha_numeric_spaces');
	  	$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');		
	  	$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|exact_length[10]|is_natural');
	  	$this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[255]|alpha_numeric_spaces');
	  	$this->form_validation->set_rules('message', 'Question', 'trim|required|max_length[500]');		
		$this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
		
		if ($this->form_validation->run() == FALSE){
          $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
          redirect('Faq/askQuestion');
        }else{
        	
        $DATAINPUT =array(
         'feedback_name'    => cleanQuery(trim(ucwords($this->input->post('uname',TRUE)))),
         'feedback_email'   => cleanQuery(trim($this->input->post('email',TRUE))),
         'feedback_mobile'  => cleanQuery(trim($this->input->post('mobile',TRUE))),
         'feedback_subject' => cleanQuery(trim($this->input->post('subject',TRUE))),
         'feedback_message' => strip_tags(cleanQuery(trim($this->input->post('message',TRUE))),"<strong>"),
         'feedback_date'    => date('Y-m-d h:i:s'),
         'feedback_status'  => 1,
         'feedback_type'  => 2,
       );
        	
        	$this->__queryStatus = $this->FaqModel->insertdata($this->__feedback,$DATAINPUT);
				
			//Email Configuration
			$emailMessage = "";
			$emailMessage .='<p>Thanks '.cleanQuery(trim($this->input->post('uname',TRUE))).',</p>';	
			$emailMessage .='<p>We received your feedback message.</p>';
                        $emailMessage .='<p>We\'ll get back to you soon!!</p>';				
                        $emailMessage .='<p><b>Regards,</b></p>';
                        $emailMessage .='<p>Admin Ayushman Bharat</p>';
				
			$EmailDetails = array(
				'email_to'=>cleanQuery(trim($this->input->post('email',TRUE))),
				'subject'=>'Ask Question',
				'message'=>$emailMessage,
				'email_from'=>'Admin Ayushman Bharat'
			);
				
			$msg = "";
			if($this->__queryStatus==TRUE){
				$getEmailInfo = $this->sendEmail($EmailDetails);//core/MY_Controller/Email Function
				if($getEmailInfo['status']!=TRUE){
                                    $msg .= " and ".$getEmailInfo['message'];
                                }
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted'.$msg));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
			redirect('Faq/askQuestion');
         	
        }//end validation
	  	
	  }
	$this->front_view('public/faq/askquestion',$this->data);	
	
    }
	
}//end class home