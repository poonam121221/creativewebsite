<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projectcategorymaster extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_project_category";
	private $__tblProject = "comm_photo_gallery";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/ProjectcategoryModel');
		$this->load->config('cms_config');
		
		$this->_config = array(
			'upload_path'   => "./uploads/project/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "2097152", // Can be set to particular file size , here it is 2 MB (1024*1024*2)
		);
		
		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$this->__allowStatus = 1;
		}
	}//end constructor
	
	public function index(){

		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		
		$filter = array('cpgc.is_delete'=>0);
		//this is not for super admin and administrator
	   	if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['cpgc.added_by'] = $UserLogId; 
		}
		$orderBy = array('cpgc.order_preference'=>'asc');
		 		
		$this->data['DataList'] = $this->ProjectcategoryModel->getAllList($this->__table,$filter,$orderBy);	

	  	$this->front_view('admin/project_category/index',$this->data);
	  	
	}//end index function
	
	public function add(){
		
		$this->load->library('form_validation');
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		 
		 $this->form_validation->set_rules('cat_title_hi', 'Category Title (Hindi)', 'trim|required|min_length[2]|max_length[100]|is_unique['.$this->__table.'.cat_title_hi]');	
		 $this->form_validation->set_rules('cat_title_en', 'Category Title (English)', 'trim|required|min_length[2]|max_length[100]|is_unique['.$this->__table.'.cat_title_en]');
		 
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }	 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Projectcategorymaster/add/');
         }else{
			$s_order = (int)$this->ProjectcategoryModel->getmax($this->__table,'order_preference');
           $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		    $attachmentName = $this->_uploadFile();	
           $DATAINPUT = array(
         	  'cat_title_hi' => cleanQuery(trim($this->input->post('cat_title_hi',TRUE))),
         	  'cat_title_en' => cleanQuery(trim($this->input->post('cat_title_en',TRUE))),
			  'attachment'       => $attachmentName,
         	  'added_date'   => date('Y-m-d h:i:s'),
         	  'added_by'     => $UserLogId,
		  	  'order_preference' => $s_order+1,
         	  'cat_status'   => $this->__status
         	);
				
			$this->__queryStatus = $this->ProjectcategoryModel->insertdata($this->__table,$DATAINPUT);
			if($this->__queryStatus==TRUE){
			 $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
			}else{
			 $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/project_category/add',$this->data);
	}//end add function
	
	public function edit(){
		
		$this->load->library('form_validation');
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Projectcategorymaster/');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Projectcategorymaster/');
		}
		
		$this->data['DataList'] = $this->ProjectcategoryModel->getSingleList($this->__table,array('cat_id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			 $this->form_validation->set_rules('cat_title_hi', 'Category Title (Hindi)', 'trim|required|min_length[2]|max_length[100]|check_unique['.$this->__table.'.cat_title_hi.cat_id.'.$this->__id.']');
			 $this->form_validation->set_rules('cat_title_en', 'Category Title (English)', 'trim|required|min_length[2]|max_length[100]|check_unique['.$this->__table.'.cat_title_en.cat_id.'.$this->__id.']');
			 
		 if($this->__allowStatus==1){
		 $this->form_validation->set_rules('status','Status','trim|required|in_list[0,1]');
		 $this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }else{
		 $this->__status = (int)$this->data['DataList']->cat_status;
		 }
			
		 if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
            redirect('manage/Projectcategorymaster/edit/'.$this->__encId.'/');
         }else{
         	$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
			$attachmentName = $this->_uploadFile($this->data['DataList']->attachment);
			
         	$DATAINPUT = array(
         	  'cat_title_hi' => cleanQuery(trim($this->input->post('cat_title_hi',TRUE))),
         	  'cat_title_en' => cleanQuery(trim($this->input->post('cat_title_en',TRUE))),
			  'attachment'       => $attachmentName,
         	  'cat_status'   => $this->__status,
         	  'edit_date'    => date('Y-m-d h:i:s'),
         	  'edit_by'      => $UserLogId,
         	);
				
				$this->__queryStatus = $this->ProjectcategoryModel->updatedata($this->__table,$DATAINPUT,array('cat_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Projectcategorymaster/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/project_category/edit',$this->data);
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
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Projectcategorymaster/');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Projectcategorymaster/');
		}
		
		$data = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('cat_id'=>$this->__id);
		$count_record = 0;
		
		$count_record = $this->ProjectcategoryModel->record_count($this->__tblProject,$filter);
		if($count_record==0){
		  if($this->ProjectcategoryModel->updatedata($this->__table,$data,$filter)==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		  }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		  }
		}else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'info',
		  'message'=>'Sorry you can not be delete this category before delete this record, delete first child record.'));
		}//end check count record
		
		redirect('manage/Projectcategorymaster/');
		
	}//end delete function
	
	public function recycle(){

		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$filter = array('cpgc.is_delete'=>1);
		$this->data['DataList'] = $this->ProjectcategoryModel->getAllList($this->__table,$filter);		
	  	$this->front_view('admin/project_category/recycle',$this->data);
	  	
	}//end recycle function
	
	public function recycle_delete(){
		
		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		
		$this->load->library('form_validation');
		$count_record = 0;
		$del_no = 0;
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		$del_no = (int)$this->uri->segment(5,0);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Projectcategorymaster/recycle');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Projectcategorymaster/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
            redirect('manage/Projectcategorymaster/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('cat_id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->ProjectcategoryModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
		 	$count_record = $this->ProjectcategoryModel->record_count($this->__tblProject,$filter);
		 	if($count_record==0){
				if($this->ProjectcategoryModel->deletedata($this->__table,array('cat_id'=>$this->__id))==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success',
					'message'=>'data successfull deleted!'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'info',
					'message'=>'Record can not be deleted, try again!'));
				}
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry you can not be delete this category before delete this record, delete first child record.'));
			}//end check count record
		 	
		 }//end check delete action id
			
		}//end check validation
		
		redirect('manage/Projectcategorymaster/recycle');
	}//end recycle_delete function

	protected function _uploadFile($preUploadedFile=""){
		
		
		$this->load->library('upload', $this->_config);
		$this->upload->initialize($this->_config);
		
		$FILE_NAME = "";
		$FULL_PATH = "";
	
		if(isset($_FILES['attachment']['name'])==TRUE && trim($_FILES['attachment']['name'])!=""){
	
			if($this->upload->do_upload('attachment')){

			$data = $this->upload->data();
			$FILE_NAME = $data['file_name'];
			$FULL_PATH = $data['full_path'];
			if(trim($preUploadedFile)!="" && trim($preUploadedFile)!=NULL){
				@unlink("./uploads/project/".trim($preUploadedFile));
			}
			
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>$this->upload->display_errors()));
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

			$this->__queryStatus = $this->ProjectcategoryModel->update_sort_order($update_id,$update_order,$this->__table,'cat_id');

		}//end check validation
		 
		 if($this->__queryStatus==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'order successfull updated!'));
		 }else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry try again later !'));
		 }
		 
		 redirect('manage/Projectcategorymaster');

	}//end updatesrtorder function
}//end Projectcategorymaster class