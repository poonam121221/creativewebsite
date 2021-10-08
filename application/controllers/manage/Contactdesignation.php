<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactdesignation extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_contact_designation";
	private $__tblContact = "comm_contact";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/ContactdesignationModel');
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
		
		$filter = array('cd.is_delete'=>0);
		//this is not for super admin and administrator
		if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['cd.added_by'] = $UserLogId; 
		}
		$order = array("cd.cat_id"=>"asc");
		$this->data['DataList'] = $this->ContactdesignationModel->getAllList($this->__table,$filter,$order);

	  	$this->front_view('admin/contact_designation/index',$this->data);
	  	
	}//end index function
	
	public function add(){
		
		$this->load->library('form_validation');
		
		$this->data['CategoryList'] = $this->ContactdesignationModel->GenerateDDList('comm_contact_category','cat_id','category_en','--SELECT CATEGORY--',array('cat_status'=>1));
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		 
		 $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural');
		// $this->form_validation->set_rules('designation_hi', 'Designation Title (Hindi)', 'trim|required|min_length[2]|max_length[100]|is_unique['.$this->__table.'.designation_hi]');	
		// $this->form_validation->set_rules('designation_en', 'Designation Title (English)', 'trim|required|min_length[2]|max_length[100]|is_unique['.$this->__table.'.designation_en]');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }		 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Contactdesignation/add/');
         }else{
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         $DATAINPUT = array(
         	'designation_hi' => cleanQuery(trim($this->input->post('designation_hi',TRUE))),
         	'designation_en' => cleanQuery(trim($this->input->post('designation_en',TRUE))),
         	'cat_id'         => cleanQuery(trim($this->input->post('category',TRUE))),
         	'added_by'=>$UserLogId,
            'added_date'=>date('Y-m-d'),
         	'status'         => $this->__status
         );
				
				$this->__queryStatus = $this->ContactdesignationModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/contact_designation/add',$this->data);
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
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Contactdesignation/');
		}
		
		if($this->isExists($this->__table,array('d_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Contactdesignation/');
		}
		
		$this->data['DataList'] = $this->ContactdesignationModel->getSingleList($this->__table,array('d_id'=>$this->__id));
		$this->data['CategoryList'] = $this->ContactdesignationModel->GenerateDDList('comm_contact_category','cat_id','category_en','--SELECT CATEGORY--',array('cat_status'=>1));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			 $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural');
			// $this->form_validation->set_rules('designation_hi', 'Designation Title (Hindi)', 'trim|required|min_length[2]|max_length[100]|check_unique['.$this->__table.'.designation_hi.d_id.'.$this->__id.']');
			 //$this->form_validation->set_rules('designation_en', 'Designation Title (English)', 'trim|required|min_length[2]|max_length[100]|check_unique['.$this->__table.'.designation_en.d_id.'.$this->__id.']');			 
			 if($this->__allowStatus==1){
		 	  $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	  $this->__status = (int)cleanQuery($this->input->post('status'));	 
		     }else{
			 		$this->__status = (int)$this->data['DataList']->status;
			 }
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Contactdesignation/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         $this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         $DATAINPUT = array(
          'designation_hi' => cleanQuery(trim($this->input->post('designation_hi',TRUE))),
          'designation_en' => cleanQuery(trim($this->input->post('designation_en',TRUE))),
          'cat_id'         => cleanQuery(trim($this->input->post('category',TRUE))),
          'edit_by'=>$UserLogId,
          'edit_date'=>date('Y-m-d'),
          'status'   	=> $this->__status,
         );
				
		$this->__queryStatus = $this->ContactdesignationModel->updatedata($this->__table,$DATAINPUT,array('d_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Contactdesignation/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/contact_designation/edit',$this->data);
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
			redirect('manage/Contactdesignation/');
		}
		
		if($this->isExists($this->__table,array('d_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Contactdesignation/');
		}
		
		$data = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('d_id'=>$this->__id);
		$count_record = 0;
		
		$count_record = $this->ContactdesignationModel->record_count($this->__tblContact,$filter);
		if($count_record==0){
		  if($this->ContactdesignationModel->updatedata($this->__table,$data,$filter)==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		  }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry can not be deleted!'));
		  }
		}else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'info',
		  'message'=>'Sorry you can not be delete this category before delete this record, delete first child record.'));
		}//end check count record
		
		redirect('manage/Contactdesignation/');
		
	}//end delete function
	
	public function recycle(){

		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$filter = array('cd.is_delete'=>1);
		$order = array("cd.cat_id"=>"asc");
		$this->data['DataList'] = $this->ContactdesignationModel->getAllList($this->__table,$filter,$order);
	  	$this->front_view('admin/contact_designation/recycle',$this->data);
	  	
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
			redirect('manage/Contactdesignation/recycle');
		}
		
		if($this->isExists($this->__table,array('d_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Contactdesignation/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
            redirect('manage/Contactdesignation/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('d_id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->ContactdesignationModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
		 	$count_record = $this->ContactdesignationModel->record_count($this->__tblContact,$filter);
		 	if($count_record==0){
				if($this->ContactdesignationModel->deletedata($this->__table,array('d_id'=>$this->__id))==TRUE){
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
		
		redirect('manage/Contactdesignation/recycle');
	}//end recycle_delete function
	
}//end Contactdesignation class