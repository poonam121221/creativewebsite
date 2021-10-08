<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicescategory extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_services_category";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/ServicesModel');
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
		$filter = array('s.is_delete'=>0);
		//this is not for super admin and administrator
		if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['ra.added_by'] = $UserLogId ; 
		}		
		$this->data['DataList'] = $this->ServicesModel->getAllCatgeoryList($this->__table,$filter);		
	  	$this->front_view('admin/services_category/index',$this->data);	  	
	}//end index function
	
	public function add(){
		
		$this->load->library('form_validation');
		$this->load->library(array('form_validation','Ckeditorsetup'));
		$this->data['CategoryList'] = $this->ServicesModel->GenerateDDList($this->__table,'cat_id','cat_title_en','--SELECT CATEGORY--',array('cat_status'=>1,'cat_id IN (1,2,3,4,5,6) AND 1 ='=>1));		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){		

			$this->form_validation->set_rules('cat_title_hi', 'Category Title (Hindi)', 'trim|required|min_length[2]|max_length[100]|is_unique['.$this->__table.'.cat_title_hi]');	
		 	$this->form_validation->set_rules('cat_title_en', 'Category Title (English)', 'trim|required|min_length[2]|max_length[100]|is_unique['.$this->__table.'.cat_title_en]');

		 	$this->form_validation->set_rules('cat_description_hi', 'Description Hindi', 'required|trim|min_length[2]');		
			$this->form_validation->set_rules('cat_description_en', 'Description English', 'required|trim|min_length[2]');		 
			if($this->__allowStatus==1){
			 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
			 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
			}		 
			
			if ($this->form_validation->run() == FALSE){
	            $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
	            redirect('manage/Servicescategory/add/');
	        }else{
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	    $DATAINPUT = array(
         	    	'parent_cat_id'       => (int)cleanQuery(trim($this->input->post('parent_cat_id',TRUE))),
         	    	'cat_title_hi' => cleanQuery(trim($this->input->post('cat_title_hi',TRUE))),
         	    	'cat_title_en' => cleanQuery(trim($this->input->post('cat_title_en',TRUE))),
         	    	'cat_description_hi' => checkaddslashes(trim($this->input->post('cat_description_hi',FALSE))),
         	    	'cat_description_en' => checkaddslashes(trim($this->input->post('cat_description_en',FALSE))),
         	    	'added_date'   => date('Y-m-d h:i:s'),
         	    	'added_by'     => $UserLogId,
         	    	'cat_status'   => $this->__status
         	    	);         	
				
				$this->__queryStatus = $this->ServicesModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}	                
	         }//end validation	         
			}//end check post method
		
			$this->data['optstatus'] = $this->__allowStatus;
	  		$this->front_view('admin/services_category/add',$this->data);
	}//end add function
	
	public function edit(){
		
		$this->load->library('form_validation');		
		$this->load->library(array('form_validation','Ckeditorsetup'));


		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Servicescategory/');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Servicescategory/');
		}
		
		$this->data['DataList'] = $this->ServicesModel->getSingleList($this->__table,array('cat_id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			 $this->form_validation->set_rules('cat_title_hi', 'Category Title (Hindi)', 'trim|required|min_length[2]|max_length[100]|check_unique['.$this->__table.'.cat_title_hi.cat_id.'.$this->__id.']');
			 $this->form_validation->set_rules('cat_title_en', 'Category Title (English)', 'trim|required|min_length[2]|max_length[100]|check_unique['.$this->__table.'.cat_title_en.cat_id.'.$this->__id.']');
			 if($this->__allowStatus==1){
			 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
			 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
			 }else{
		   	   $this->__status = (int)$this->data['DataList']->cat_status;
		     }
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Servicescategory/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         	    $DATAINPUT = array(
         	    		'cat_title_hi' => cleanQuery(trim($this->input->post('cat_title_hi',TRUE))),
         	    		'cat_title_en' => cleanQuery(trim($this->input->post('cat_title_en',TRUE))),
         	    		'cat_description_hi' => checkaddslashes(trim($this->input->post('cat_description_hi',FALSE))),
         	    		'cat_description_en' => checkaddslashes(trim($this->input->post('cat_description_en',FALSE))),
         	    		'cat_status'   => $this->__status,
         	    		'edit_date'    => date('Y-m-d h:i:s'),
         	    		'edit_by'      => $UserLogId,
         	    		);
				
				$this->__queryStatus = $this->ServicesModel->updatedata($this->__table,$DATAINPUT,array('cat_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Servicescategory/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		if($this->__id==1||$this->__id==2||$this->__id==3||$this->__id==4||$this->__id==5||$this->__id==6){}else{
			$this->data['CategoryList'] = $this->ServicesModel->GenerateDDList($this->__table,'cat_id','cat_title_en','--SELECT CATEGORY--',array('cat_status'=>1,'cat_id IN (1,2,3,4,5,6) AND 1 ='=>1));
		}
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/services_category/edit',$this->data);
	}//end edit function
	
	public function deleteOld(){
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Servicescategory/');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Servicescategory/');
		}
		
		if($this->ServicesModel->deletedata($this->__table,array('cat_id'=>$this->__id))==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry can not be deleted!'));
		}
		
		redirect('manage/Servicescategory/');
		
	}//end delete function
	
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
			redirect('manage/Servicescategory/');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Servicescategory/');
		}
		
		$data = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('cat_id'=>$this->__id);
		$count_record = 0;
		
		$count_record = $this->ServicesModel->record_count($this->__tblGallery,$filter);
		if($count_record==0){
		  if($this->ServicesModel->updatedata($this->__table,$data,$filter)==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		  }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry can not be deleted!'));
		  }
		}else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'info',
		  'message'=>'Sorry you can not be delete this category before delete this record, delete first child record.'));
		}//end check count record
		
		redirect('manage/Servicescategory/');
		
	}//end delete function
	
	public function recycle(){

		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$filter = array('um.is_delete'=>1);
		$this->data['DataList'] = $this->ServicesModel->getAllList($this->__table,$filter);		
	  	$this->front_view('admin/circular_category/recycle',$this->data);
	  	
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
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Servicescategory/recycle');
		}
		
		if($this->isExists($this->__table,array('cat_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Servicescategory/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
            redirect('manage/Servicescategory/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('cat_id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->ServicesModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
		 	$count_record = $this->ServicesModel->record_count($this->__tbleCircular,$filter);
		 	if($count_record==0){
				if($this->ServicesModel->deletedata($this->__table,array('cat_id'=>$this->__id))==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success',
					'message'=>'data successfull deleted!'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'info',
					'message'=>'Sorry can not be deleted!'));
				}
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry you can not be delete this category before delete this record, delete first child record.'));
			}//end check count record
		 	
		 }//end check delete action id
			
		}//end check validation
		
		redirect('manage/Servicescategory/recycle');
	}//end recycle_delete function
	
}//end Dashboard class