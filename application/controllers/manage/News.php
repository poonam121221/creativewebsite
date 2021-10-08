<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_news";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;

	public function __construct(){
		parent::__construct();
		$this->load->model('manage/NewsModel');
		$this->load->library('Ajax_pagination');
		$this->load->config('cms_config');
		
		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		$this->perPage = 10;
		
		$this->_config = array(
			'upload_path'   => "./uploads/files/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "52428800", // Can be set to particular file size , here it is 50 MB
		);
		
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$this->__allowStatus = 1;
		}
	}//end constructor

	public function index(){
	    $this->front_view('admin/news/index',$this->data);
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
                
        $filter = array('um.is_delete'=> 0);
        //this is not for super admin and administrator
		if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['um.added_by'] = $UserLogId; 
		}
        
        $orderBy = array('um.order_preference'=>'asc');
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->NewsModel->getRows($conditions,$filter));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("manage/News/ajaxPaginationData");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->NewsModel->getRows($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
        //load the view
        $this->load->view('admin/news/ajaxpaginationnews', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData

	public function add(){
		
	  addmin_css(array('/plugins/bootstrap-datepicker/css/datepicker.css'));
	  add_admin_footer_js(array('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));
		
	 $this->load->library(array('form_validation','Ckeditorsetup'));
	 	 
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			
		 $this->form_validation->set_rules('title_hi', 'Title Hindi', 'required|trim|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('description_hi', 'Description Hindi', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('title_en', 'Title English', 'required|trim|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('description_en', 'Description English', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('archive_date', 'Archive Date', 'required|trim|check_date');
		 $this->form_validation->set_rules('is_alert', 'Is Alert', 'trim|required|in_list[0,1]');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }		 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
         }else{
         	    
           $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);	
           $attachmentInfo = $this->_uploadFile();    
         	    
           $DATAINPUT = array(	
			'title_hi'        => cleanQuery(trim($this->input->post('title_hi',TRUE))),
			'description_hi'  => checkaddslashes(trim($this->input->post('description_hi',FALSE))),
			'title_en'        => cleanQuery(trim($this->input->post('title_en',TRUE))),
			'description_en'  => checkaddslashes(trim($this->input->post('description_en',FALSE))),
			'attachment'      => $attachmentInfo['FILE_NAME'],
			'archive_exp_date'=> date_convert(trim($this->input->post('archive_date',TRUE))),
			'status'     	  => $this->__status,
			'is_alert'        => (int)cleanQuery(trim($this->input->post('is_alert',TRUE))),
			'added_date'      => date('Y-m-d h:i:s'),
         	'added_by'        => $UserLogId,
         	'type'			  => (int)cleanQuery(trim($this->input->post('type',TRUE))),
		   );
				
			$this->__queryStatus = $this->NewsModel->insertdata($this->__table,$DATAINPUT);
			if($this->__queryStatus==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/news/add',$this->data);
		
	}//end add function

	public function edit(){
		
		addmin_css(array('/plugins/bootstrap-datepicker/css/datepicker.css'));
	    add_admin_footer_js(array('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));
		
		$this->load->library(array('form_validation','Ckeditorsetup'));
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/News/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/News/');
		}		
		
		$this->data['DataList'] = $this->NewsModel->getSingleList($this->__table,array('id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
						 	
		 $this->form_validation->set_rules('title_hi', 'Title Hindi', 'required|trim|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('description_hi', 'Description Hindi', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('title_en', 'Title English', 'required|trim|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('description_en', 'Description English', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('archive_date', 'Archive Date', 'required|trim|check_date');
		 $this->form_validation->set_rules('is_alert', 'Is Alert', 'trim|required|in_list[0,1]');
		 $this->form_validation->set_rules('type', 'News Type', 'trim|required|in_list[0,1]');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }else{
		   	$this->__status = (int)$this->data['DataList']->status;
		 }
		 
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/News/edit/'.$this->__encId.'/');
         }else{
         	
         	$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         	$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	
         	if($_FILES["attachment"]["name"]!=""){
         		$attachmentInfo = $this->_uploadFile($this->data['DataList']->attachment);
	         	if($attachmentInfo['IS_UPLOAD']){
	         		$FILE_NAME = trim($attachmentInfo['FILE_NAME']);
	         	}else{
				  redirect('manage/News/edit/'.$this->__encId.'/');
			     }//end do upload
		     }else{
			 	$FILE_NAME=trim($this->data['DataList']->attachment);
			 }
		     //end check file name 
         	
         	$DATAINPUT = array(	
			'title_hi'        => cleanQuery(trim($this->input->post('title_hi',TRUE))),
			'description_hi'  => checkaddslashes(trim($this->input->post('description_hi',FALSE))),
			'title_en'        => cleanQuery(trim($this->input->post('title_en',TRUE))),
			'description_en'  => checkaddslashes(trim($this->input->post('description_en',FALSE))),
			'attachment'      => $FILE_NAME,
			'archive_exp_date'=> date_convert(trim($this->input->post('archive_date',TRUE))),
			'status '         => $this->__status,
			'is_alert'        => (int)cleanQuery(trim($this->input->post('is_alert',TRUE))),
         	'edit_date'       => date('Y-m-d h:i:s'),
         	'edit_by'         => $UserLogId,
         	'type'			  => (int)cleanQuery(trim($this->input->post('type',TRUE))),
		   );
				
		 	$this->__queryStatus = $this->NewsModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/News/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/news/edit',$this->data);
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
			redirect('manage/News');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/News');
		}
		
		$DATAINPUT = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$this->__queryStatus = $this->NewsModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
		
		if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry can not be deleted!'));
		}
		
		redirect('manage/News');
		
	}//end delete function
	
	protected function _uploadFile($preUploadedFile=""){
		$this->load->library('upload', $this->_config);
		$this->upload->initialize($this->_config);
		
		$FILE_NAME = "";
		$FULL_PATH = "";
		$IS_UPLOAD = FALSE;
				
		if(isset($_FILES['attachment']['name'])==TRUE && trim($_FILES['attachment']['name'])!=""){
	
			if($this->upload->do_upload('attachment')){

			$data = $this->upload->data();
			$FILE_NAME = $data['file_name'];
			$FULL_PATH = $data['full_path'];
			$IS_UPLOAD = TRUE;
			
			if(trim($preUploadedFile)!="" && trim($preUploadedFile)!=NULL){
				@unlink("./uploads/files/".trim($preUploadedFile));
			}
			
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>$this->upload->display_errors()));
			}
		}else{
			$FILE_NAME = $preUploadedFile;
		}

		return array('IS_UPLOAD'=>$IS_UPLOAD,'FILE_NAME'=>$FILE_NAME);	
	}//end uploadFile function
	
	public function updatesrtorder(){
		
	  $this->load->library('form_validation');	  
	  $update_id = $this->uri->segment(5, NULL);
	  $update_order = $this->uri->segment(7, 0);	  
	  if(!is_null($update_id)){
	  	$update_id = encrypt_decrypt('decrypt',$update_id);
	  }      
      $this->form_validation->set_data(array(
        'order_id'     =>  $update_id,
        'order_number' => $update_order,
	  ));
	  	  	
	  $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required|is_natural_no_zero');
	  $this->form_validation->set_rules('order_number', 'Order Number', 'trim|required|is_natural_no_zero');
	  	 
	  	 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
         }else{        	
			$this->__queryStatus = $this->NewsModel->update_sort_order($update_id,$update_order,$this->__table);
		 }//end check validation		 
		 if($this->__queryStatus==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'order successfull updated!'));
		 }else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry try again later !'));
		 }		 
		 redirect('manage/News/');

	}//end updatesrtorder function
	
	public function recycle(){
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$filter = array('n.is_delete'=>1);
		$order = array('n.order_preference'=>'asc');
		
		$this->data['DataList'] = $this->NewsModel->getAllList($this->__table,$filter,$order);
	    $this->front_view('admin/news/recycle',$this->data);
	}//end recycle function
	
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
			 redirect('manage/News/recycle');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			 redirect('manage/News/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/News/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->NewsModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
			$Query = $this->NewsModel->getSingleList($this->__table,$filter);
			
			if($this->NewsModel->deletedata($this->__table,$filter)==TRUE){
				
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
		
		redirect('manage/News/recycle');
	}//end recycle_delete
	
}// end news class