<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallerycategorymaster extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_photo_gallery_category";
	private $__tblGallery = "comm_photo_gallery";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/GallerycategoryModel');
		$this->load->config('cms_config');
		
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
		 		
		$this->data['DataList'] = $this->GallerycategoryModel->getAllList($this->__table,$filter);	

	  	$this->front_view('admin/gallery_category/index',$this->data);
	  	
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
                redirect('manage/Gallerycategorymaster/add/');
         }else{
           $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
           $DATAINPUT = array(
         	  'cat_title_hi' => cleanQuery(trim($this->input->post('cat_title_hi',TRUE))),
         	  'cat_title_en' => cleanQuery(trim($this->input->post('cat_title_en',TRUE))),
         	  'added_date'   => date('Y-m-d h:i:s'),
         	  'added_by'     => $UserLogId,
         	  'cat_status'   => $this->__status
         	);
				
			$this->__queryStatus = $this->GallerycategoryModel->insertdata($this->__table,$DATAINPUT);
			if($this->__queryStatus==TRUE){
			 $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
			}else{
			 $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/gallery_category/add',$this->data);
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
			redirect('manage/Gallerycategorymaster/');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Gallerycategorymaster/');
		}
		
		$this->data['DataList'] = $this->GallerycategoryModel->getSingleList($this->__table,array('cat_id'=>$this->__id));
		
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
            redirect('manage/Gallerycategorymaster/edit/'.$this->__encId.'/');
         }else{
         	$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         	$DATAINPUT = array(
         	  'cat_title_hi' => cleanQuery(trim($this->input->post('cat_title_hi',TRUE))),
         	  'cat_title_en' => cleanQuery(trim($this->input->post('cat_title_en',TRUE))),
         	  'cat_status'   => $this->__status,
         	  'edit_date'    => date('Y-m-d h:i:s'),
         	  'edit_by'      => $UserLogId,
         	);
				
				$this->__queryStatus = $this->GallerycategoryModel->updatedata($this->__table,$DATAINPUT,array('cat_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Gallerycategorymaster/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/gallery_category/edit',$this->data);
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
			redirect('manage/Gallerycategorymaster/');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Gallerycategorymaster/');
		}
		
		$data = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('cat_id'=>$this->__id);
		$count_record = 0;
		
		$count_record = $this->GallerycategoryModel->record_count($this->__tblGallery,$filter);
		if($count_record==0){
		  if($this->GallerycategoryModel->updatedata($this->__table,$data,$filter)==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		  }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		  }
		}else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'info',
		  'message'=>'Sorry you can not be delete this category before delete this record, delete first child record.'));
		}//end check count record
		
		redirect('manage/Gallerycategorymaster/');
		
	}//end delete function
	
	public function recycle(){

		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$filter = array('cpgc.is_delete'=>1);
		$this->data['DataList'] = $this->GallerycategoryModel->getAllList($this->__table,$filter);		
	  	$this->front_view('admin/gallery_category/recycle',$this->data);
	  	
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
			redirect('manage/Gallerycategorymaster/recycle');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Gallerycategorymaster/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
            redirect('manage/Gallerycategorymaster/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('cat_id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->GallerycategoryModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
		 	$count_record = $this->GallerycategoryModel->record_count($this->__tblGallery,$filter);
		 	if($count_record==0){
				if($this->GallerycategoryModel->deletedata($this->__table,array('cat_id'=>$this->__id))==TRUE){
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
		
		redirect('manage/Gallerycategorymaster/recycle');
	}//end recycle_delete function
	
}//end Gallerycategorymaster class