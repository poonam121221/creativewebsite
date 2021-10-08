<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tender extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_tender";
	private $__id = NULL;
	private $__encId = NULL;
	protected $_config = array();
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	private $__currentUrl = "";
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/TenderModel');		
		$this->load->library('Ajax_pagination');
		$this->load->config('cms_config');
		
		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		$this->perPage = 10;
		
		$this->_config = array(
			'upload_path'   => "./uploads/files/",
			'allowed_types' => "PDF|pdf|jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "26214400", // Can be set to particular file size , here it is 25 MB
		);
		
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus) || in_array($this->__LogedPrivId,array(1,2))){
			$this->__allowStatus = 1;
		}
	}//end constructor
	
	public function index(){  

        $this->front_view('admin/tender/index',$this->data);	  	
	}//end index function
	
	public function ajaxPaginationData(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
        $conditions = array();
		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $title  = $this->input->post('sTitle',TRUE);
        $status = $this->input->post('sStatus',TRUE);
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        if(trim($status)!=""){
            $conditions['search']['status'] = (int)$status;
        }        
        
        $filter  = array('um.is_delete'=>0);
     	
		//this is not for super admin and administrator
		if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['um.added_by'] = $UserLogId; 
		}
		
		$orderBy = array('id'=>'desc');
        
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->TenderModel->getRows($conditions,$filter));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."manage/Tender/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->TenderModel->getRows($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('admin/tender/ajaxpaginationtender', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
	public function add(){
		
		$this->load->library('form_validation');
		
		addmin_css(array('/plugins/bootstrap-datepicker/css/datepicker.css'));
		add_admin_footer_js(array('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));
		 $this->load->library(array('form_validation','Ckeditorsetup'));
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		 
		 /****Validation Rules start****/
		 $this->form_validation->set_rules('nit_no', 'NIT NO.', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
     	 $this->form_validation->set_rules('remark_hi', 'Remark', 'trim');
		  $this->form_validation->set_rules('remark_en', 'Remark', 'trim');
// 		 $this->form_validation->set_rules('description_hi', 'Description Hindi', 'trim|min_length[2]');
	//	 $this->form_validation->set_rules('description_en', 'Description English', 'trim|min_length[2]');
//		 $this->form_validation->set_rules('applylink', 'Apply Link', 'trim|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('archive_date', 'Archive Date', 'required|trim|check_date');		
 		 $this->form_validation->set_rules('issue_date', 'Issue Date', 'required|trim|check_date');	
	     $this->form_validation->set_rules('is_alert', 'Is Alert', 'trim|required|in_list[0,1]');	
  		 //$this->form_validation->set_rules('last_date', 'Last Date', 'required|trim|check_date');		

		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }
		/* if(empty($_FILES['attachment']['name'])){
    		$this->form_validation->set_rules('attachment', 'Attachment', 'required');
		 }
		 
		  if(empty($_FILES['corrigendum']['name'])){
    		//$this->form_validation->set_rules('corrigendum', 'Corrigendum', 'required');
		 }*/
		 /****Validation Rules End****/	 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Tender/add/');
         }else{
				
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$result =  $this->TenderModel->getSingleList($this->__table);
         		
         		$this->__currentUrl = current_url();
         		$attachmentName1 = $this->_uploadFile("",'attachment1');
				$attachmentName2 = $this->_uploadFile("",'attachment2');
				$attachmentName3 = $this->_uploadFile("",'attachment3');
				$attachmentName4 = $this->_uploadFile("",'attachment4');
				$attachmentName5 = $this->_uploadFile("",'attachment5');
				
				$corrigendumName1 = $this->_uploadFile("",'corrigendum1');
				$corrigendumName2 = $this->_uploadFile("",'corrigendum2');
				$corrigendumName3 = $this->_uploadFile("",'corrigendum3');
				$corrigendumName4 = $this->_uploadFile("",'corrigendum4');
				$corrigendumName5 = $this->_uploadFile("",'corrigendum5');
				
         	    $DATAINPUT = array(
					'nit_no'     => cleanQuery(trim($this->input->post('nit_no',TRUE))),
         	    	'title_hi'     => cleanQuery(trim($this->input->post('title_hi',TRUE))),
         	    	'title_en' 	   => cleanQuery(trim($this->input->post('title_en',TRUE))),  
					'remark_hi' 	   => cleanQuery(trim($this->input->post('remark_hi',TRUE))),    
					'remark_en' 	   => cleanQuery(trim($this->input->post('remark_en',TRUE))),  
					//'description_hi'  => checkaddslashes(trim($this->input->post('description_hi',FALSE))),
					//'description_en'  => checkaddslashes(trim($this->input->post('description_en',FALSE))), 	
					'applylink'  => checkaddslashes(trim($this->input->post('applylink',FALSE))), 	    	
         	    	'attachment1'   => $attachmentName1,
					'attachment2'   => $attachmentName2,
					'attachment3'   => $attachmentName3,
					'attachment4'   => $attachmentName4,
					'attachment5'   => $attachmentName5,
									  
					'corrigendum1'   => $corrigendumName1,  
					'corrigendum2'   => $corrigendumName2,  
					'corrigendum3'   => $corrigendumName3,  
					'corrigendum4'   => $corrigendumName4,  
					'corrigendum5'   => $corrigendumName5,  
					'is_alert'        => (int)cleanQuery(trim($this->input->post('is_alert',TRUE))),
																									
         	    	'archive_exp_date' => date_convert(trim($this->input->post('archive_date',TRUE))),     	    	
					'issue_date' => date_convert(trim($this->input->post('issue_date',TRUE))),     	    	
					//'last_date' => date_convert(trim($this->input->post('last_date',TRUE))),     	    	
         	    	'added_date'   => date('Y-m-d h:i:s'),
         	    	'added_by'     => $UserLogId,
         	    	'status'       => $this->__status, 
         	    	);
				
				$this->__queryStatus = $this->TenderModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/tender/add',$this->data);
	}//end add function
	
	public function edit(){
		
		addmin_css(array('/plugins/bootstrap-datepicker/css/datepicker.css'));
		add_admin_footer_js(array('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));
		 $this->load->library(array('form_validation','Ckeditorsetup'));
		$this->load->library('form_validation');
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Tender/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
		
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Tender/');
		}
		
		$this->data['DataList'] = $this->TenderModel->getSingleList($this->__table,array('id'=>$this->__id));
		
		
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			 $this->form_validation->set_rules('nit_no', 'NIT NO.', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
		  $this->form_validation->set_rules('remark_hi', 'Remark', 'trim');
		  $this->form_validation->set_rules('remark_en', 'Remark', 'trim');
       $this->form_validation->set_rules('is_alert', 'Is Alert', 'trim|required|in_list[0,1]');	
// 		 $this->form_validation->set_rules('description_hi', 'Description Hindi', 'trim|min_length[2]');
//		 $this->form_validation->set_rules('description_en', 'Description English', 'trim|min_length[2]');
// 		 $this->form_validation->set_rules('applylink', 'Apply Link', 'trim|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('archive_date', 'Archive Date', 'required|trim|check_date');		
 		 $this->form_validation->set_rules('issue_date', 'Issue Date', 'required|trim|check_date');		
  	//	 $this->form_validation->set_rules('last_date', 'Last Date', 'required|trim|check_date');			 
		  if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		  }else{
		   	$this->__status = (int)$this->data['DataList']->status;
		  }
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Tender/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		
         		//This function create bottom of class for upload file
         		//$this->__currentUrl = 'manage/Policy/edit/'.$this->__encId.'/';
         		$attachmentName1 = $this->_uploadFile($this->data['DataList']->attachment1,'attachment1');
				$attachmentName2 = $this->_uploadFile($this->data['DataList']->attachment2,'attachment2');
				$attachmentName3 = $this->_uploadFile($this->data['DataList']->attachment3,'attachment3');
				$attachmentName4 = $this->_uploadFile($this->data['DataList']->attachment4,'attachment4');
				$attachmentName5 = $this->_uploadFile($this->data['DataList']->attachment5,'attachment5');
				
				$corrigendumName1 = $this->_uploadFile($this->data['DataList']->corrigendum1,'corrigendum1');
				$corrigendumName2 = $this->_uploadFile($this->data['DataList']->corrigendum2,'corrigendum2');
				$corrigendumName3 = $this->_uploadFile($this->data['DataList']->corrigendum3,'corrigendum3');
				$corrigendumName4 = $this->_uploadFile($this->data['DataList']->corrigendum4,'corrigendum4');
				$corrigendumName5 = $this->_uploadFile($this->data['DataList']->corrigendum5,'corrigendum5');
				
         	  $DATAINPUT = array(
					'nit_no'     => cleanQuery(trim($this->input->post('nit_no',TRUE))),
         	    	'title_hi'     => cleanQuery(trim($this->input->post('title_hi',TRUE))),
         	    	'title_en' 	   => cleanQuery(trim($this->input->post('title_en',TRUE))),
					'remark_hi' 	   => cleanQuery(trim($this->input->post('remark_hi',TRUE))),    
					'remark_en' 	   => cleanQuery(trim($this->input->post('remark_en',TRUE))),    
					//'description_hi'  => checkaddslashes(trim($this->input->post('description_hi',FALSE))),
					//'description_en'  => checkaddslashes(trim($this->input->post('description_en',FALSE))), 	   
					'applylink'  => checkaddslashes(trim($this->input->post('applylink',FALSE))), 	    	 	
         	    	'attachment1'   => $attachmentName1,  
					'attachment2'   => $attachmentName2,  
					'attachment3'   => $attachmentName3,  
					'attachment4'   => $attachmentName4,  
					'attachment5'   => $attachmentName5,  
					'corrigendum1'  => $corrigendumName1,
					'corrigendum2'  => $corrigendumName2,
					'corrigendum3'  => $corrigendumName3,					
					'corrigendum4'  => $corrigendumName4,
					'corrigendum5'  => $corrigendumName5,  
					'is_alert'        => (int)cleanQuery(trim($this->input->post('is_alert',TRUE))),
         	    	'archive_exp_date' => date_convert(trim($this->input->post('archive_date',TRUE))),     	    	
					'issue_date' => date_convert(trim($this->input->post('issue_date',TRUE))),     	    	
					//'last_date' => date_convert(trim($this->input->post('last_date',TRUE))),       	    	
         	    	'edit_date'   => date('Y-m-d h:i:s'),
         	    	'edit_by'     => $UserLogId,
         	    	'status'       => $this->__status, 
         	    	);
				
				$this->__queryStatus = $this->TenderModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Tender/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/tender/edit',$this->data);
	}//end edit function
	
	public function delete(){
		
		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Tender/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Tender/');
		}
		
		$DATAINPUT = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$this->__queryStatus = $this->TenderModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
		
		if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry can not be deleted!'));
		}
		
		redirect('manage/Tender/');
		
	}//end delete function
	
	protected function _uploadFile($preUploadedFile="",$filename){
		$this->load->library('upload', $this->_config);
		$this->upload->initialize($this->_config);
		
		$FILE_NAME = "";
		$FULL_PATH = "";
	
		if(isset($_FILES[$filename]['name'])==TRUE && trim($_FILES[$filename]['name'])!=""){
	
			if($this->upload->do_upload($filename)){

			$data = $this->upload->data();
			$FILE_NAME = $data['file_name'];
			$FULL_PATH = $data['full_path'];
			if(trim($preUploadedFile)!="" && trim($preUploadedFile)!=NULL){
				@unlink("./uploads/files/".trim($preUploadedFile));
			}
			
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>$this->upload->display_errors()));
				redirect($this->__currentUrl);
			}
		}else{
			$FILE_NAME = $preUploadedFile;
		}

		return $FILE_NAME;	
	}//end uploadFile function
	
	public function updatesrtorder(){
		
	  $this->load->library('form_validation');

	  $update_id = $this->uri->segment(5, NULL);
	  $update_order = $this->uri->segment(7, 0);
	  $update_cat_name = $this->uri->segment(8, NULL);
	  $update_cat_id = $this->uri->segment(9, 0);
	  
	  if(!is_null($update_id)){
	  	$update_id = encrypt_decrypt('decrypt',$update_id);
	  }
      
      $this->form_validation->set_data(array(
        'order_id'     =>  $update_id,
        'order_number' => $update_order,
        'cat_id' => $update_cat_id,
	  ));
	  	  	
	  $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required|is_natural_no_zero');
	  $this->form_validation->set_rules('order_number', 'Order Number', 'trim|required|is_natural_no_zero');
	  $this->form_validation->set_rules('cat_id', 'Category', 'trim|required|is_natural_no_zero');
	  	 
	  	 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
         }else{        	
			$this->__queryStatus = $this->TenderModel->update_cat_sort_order($update_id,$update_order,$this->__table,'id','cat_id',$update_cat_id);
		 }//end check validation
		 
		 if($this->__queryStatus==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'order successfull updated!'));
		 }else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry try again later !'));
		 }
		 
		 redirect('manage/Tender');

	}//end updatesrtorder function
	
	public function recycle(){  
		$this->data['CategoryList'] = $this->TenderModel->GenerateDDList($this->__catTable,'cat_id','cat_title_en','--SELECT CATEGORY--',array('cat_status'=>1));
        $this->front_view('admin/tender/recycle',$this->data);	  	
	}//end index function
	
	public function ajaxPaginationRecycle(){
		
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
        $status = $this->input->post('sStatus',TRUE);
        $sortBy = $this->input->post('sortBy',TRUE);
        $cat_id = (int)$this->input->post('sCatId',TRUE);
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        if(trim($status)!=""){
            $conditions['search']['status'] = (int)$status;
        }        
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        $filter  = array('um.is_delete'=>1);
        if($cat_id!=0){
			$filter['up.cat_id'] = $cat_id;
		}
		
		$orderBy = array('um.title_en'=>'asc');
        
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->TenderModel->getRows($conditions,$filter));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url()."manage/Tender/ajaxPaginationData";
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->TenderModel->getRows($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('admin/tender/ajaxpaginationrulesrecycle', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationRecycle
	
	public function recycle_delete(){
		
		$this->load->library('form_validation');
		$del_no = 0;
		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		$del_no = (int)$this->uri->segment(5,0);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			 redirect('manage/Tender/recycle');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			 redirect('manage/Tender/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Tender/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->TenderModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
			
			$Query = $this->TenderModel->getSingleList($this->__table,$filter);
			
			if($this->TenderModel->deletedata($this->__table,$filter)==TRUE){	
			
			  $Image = $Query->attachment ;
			   if(trim($Image)!=''){	
			    	if(is_file('./uploads/files/'.$Image)){
					  unlink('./uploads/files/'.$Image);						
					}else{
					  $this->session->set_flashdata('AppMessage',array('class'=>'warning',
					  'message'=>'Sorry File does not exist!'));						
					}
			    }
					
			   $this->session->set_flashdata('AppMessage',array('class'=>'success',
			   'message'=>'data successfull deleted!'));
			}else{
			   $this->session->set_flashdata('AppMessage',array('class'=>'info',
			  'message'=>'Sorry can not be deleted!'));
			}
		 	
		 }//end check delete action id
			
		}//end check validation
		
		redirect('manage/Tender/recycle');
	}//end
	
}//end Tender class