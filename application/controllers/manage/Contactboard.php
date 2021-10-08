<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactboard extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_contact";
	private $__categoryTbl = "comm_contact_category";
	private $__designationTbl = "comm_contact_designation";
	private $__locationTbl = "comm_location";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('manage/ContactModel','manage/ContactdesignationModel'));
		$this->load->config('cms_config');
		$this->__allowChkStatus =  $this->config->item('allow_access_status');	
		$this->_config = array(
			'upload_path'   => "./uploads/files/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "307200", // Can be set to particular file size , here it is 300 kb (1024*300)
		);
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$this->__allowStatus = 1;
		}
	}//end constructor

	public function index(){

        $this->load->helper('text');
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));		
		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);		
		$order = array('cd.type'=>'asc','cd.order_preference'=>'asc');
        $filter = array('cd.is_delete'=>0);
        //this is not for super admin and administrator
		if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['cd.added_by'] = $UserLogId; 
		}
		$this->data['DataList'] = $this->ContactModel->getAllList($this->__table,$filter,$order);		
	  	$this->front_view('admin/contact_board/index',$this->data);	  	
	}//end index function
	
	public function add(){
		
		$this->load->library('form_validation');	
		addmin_css(array('plugins/bootstrap-datepicker/css/datepicker.css'));
		add_admin_footer_js(array('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));		
		$this->data['CategoryList'] = $this->ContactModel->GenerateDDList($this->__categoryTbl,'cat_id','category_en','--SELECT CATEGORY--',array('cat_status'=>1));
		$this->data['LocationList'] = $this->ContactModel->GenerateDDList($this->__locationTbl,'id','location_name_en','--SELECT LOCATION--',array('status'=>1));

		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			
		 	/****Validation Rules start****/
		 	
			$this->form_validation->set_rules('type', 'Type', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('location', 'Location', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('d_id', 'Designation', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('email_address', 'Email Address', 'trim|valid_emails|max_length[100]');
			$this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
			$this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|max_length[100]');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|max_length[255]');
			$this->form_validation->set_rules('res_phone_number', 'Residence Phone No.', 'trim|max_length[100]');
			$this->form_validation->set_rules('attachment', '', 'callback_file_check');
			if($this->__allowStatus==1){
			 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
			 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
			}
		 
		 	if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Contactboard/add/');
        	}else{
					$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
					
					$attachmentInfo = $this->_uploadFile();
					
					    $DATAINPUT = array(
					    'type' 	             => (int)cleanQuery(trim($this->input->post('type',TRUE))),
					    'cat_id' 	         => (int)cleanQuery(trim($this->input->post('category',TRUE))),
					    'd_id' 	             => (int)cleanQuery(trim($this->input->post('d_id',TRUE))),
						'location' 	             => (int)cleanQuery(trim($this->input->post('location',TRUE))),
		         	    'title_hi'           => cleanQuery(trim($this->input->post('title_hi',TRUE))),
		         	    'title_en'           => cleanQuery(trim($this->input->post('title_en',TRUE))),	         	     
		         	    'email_address'      => cleanQuery(trim($this->input->post('email_address',TRUE))),      	     
		         	    'contact_number'     => cleanQuery(trim($this->input->post('contact_number',TRUE))),    	     
		         	    'phone_number'       => cleanQuery(trim($this->input->post('phone_number',TRUE))),        	     
		         	    'res_phone_number'   => cleanQuery(trim($this->input->post('res_phone_number',TRUE))),     	     
		         	    'attachment'         => $attachmentInfo['FILE_NAME'],
		         	    'added_date'         => date('Y-m-d h:i:s'),
	         	    	'added_by'           => $UserLogId,
	         	    	'status'	   	     => $this->__status
		         	    );
										
	         	    $this->__queryStatus = $this->ContactModel->insertdata($this->__table,$DATAINPUT);
					
					if($this->__queryStatus==TRUE){
						$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
					}else{
						
						$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
					}        	   
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/contact_board/add',$this->data);
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
			redirect('manage/Contactboard/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Contactboard/');
		}
		
		$this->data['DataList'] = $this->ContactModel->getSingleList($this->__table,array('id'=>$this->__id));
		
		$this->data['CategoryList'] = $this->ContactModel->GenerateDDList('comm_contact_category','cat_id','category_en','--SELECT CATEGORY--',array('cat_status'=>1));
		$this->data['LocationList'] = $this->ContactModel->GenerateDDList($this->__locationTbl,'id','location_name_en','--SELECT LOCATION--',array('status'=>1));
		
		
		
		$fk_cat_id = (isset($this->data['DataList']) && is_object($this->data['DataList'])) ? $this->data['DataList']->cat_id : "";
		
		$this->data['DesignationList'] = $this->__fillDesignation($fk_cat_id);
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
		/****Validation Rules start****/
		 $this->form_validation->set_rules('type', 'Type', 'trim|required|is_natural_no_zero');
		 $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
		  $this->form_validation->set_rules('location', 'Location', 'trim|required|is_natural_no_zero');
		 $this->form_validation->set_rules('d_id', 'Designation', 'trim|required|is_natural_no_zero');
		 $this->form_validation->set_rules('email_address', 'Email Address', 'trim|valid_emails|max_length[100]');
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|max_length[100]');
		 $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|max_length[255]');
		 $this->form_validation->set_rules('res_phone_number', 'Residence Phone No.', 'trim|max_length[100]');
		 $this->form_validation->set_rules('attachment', '', 'callback_file_check');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }else{
		 		$this->__status = (int)$this->data['DataList']->status;
		 }
					
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Contactboard/edit/'.$this->__encId.'/');
         }else{
         	
         	if($_FILES["attachment"]["name"]!=""){
         		$attachmentInfo = $this->_uploadFile($this->data['DataList']->attachment);
	         	if($attachmentInfo['IS_UPLOAD']){
	         		$FILE_NAME = trim($attachmentInfo['FILE_NAME']);
	         	}else{
				  redirect('manage/Contactboard/edit/'.$this->__encId.'/');
			     }//end do upload
		     }else{
			 	$FILE_NAME=trim($this->data['DataList']->attachment);
			 }
		     //end check file name 
         	
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		
         	    $DATAINPUT = array(
         	    'type' 	             => (int)cleanQuery(trim($this->input->post('type',TRUE))),
				'cat_id' 	         => (int)cleanQuery(trim($this->input->post('category',TRUE))),
				'd_id' 	             => (int)cleanQuery(trim($this->input->post('d_id',TRUE))),
				'location' 	             => (int)cleanQuery(trim($this->input->post('location',TRUE))),
		        'title_hi'           => cleanQuery(trim($this->input->post('title_hi',TRUE))),
		        'title_en'           => cleanQuery(trim($this->input->post('title_en',TRUE))),		         	     
		        'email_address'      => cleanQuery(trim($this->input->post('email_address',TRUE))),		         	     
		        'contact_number'     => cleanQuery(trim($this->input->post('contact_number',TRUE))),         	     
		        'phone_number'       => cleanQuery(trim($this->input->post('phone_number',TRUE))),		         	     
		        'res_phone_number'   => cleanQuery(trim($this->input->post('res_phone_number',TRUE))),         	     
         	    'attachment'         => (isset($FILE_NAME) && trim($FILE_NAME)!="")?$FILE_NAME:"",   
         	    'status'	         => $this->__status,
         	    'edit_date'          => date('Y-m-d h:i:s'),
         	    'edit_by'            => $UserLogId,
         	    );
				
				$this->__queryStatus = $this->ContactModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
					
				}
                redirect('manage/Contactboard/edit/'.$this->__encId.'/');
              }//end validation
         
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/contact_board/edit',$this->data);
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
			redirect('manage/Contactboard/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Contactboard/');
		}
				
		$data  = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('id'=>$this->__id);
		
		if($this->ContactModel->updatedata($this->__table,$data,$filter)==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry can not be deleted!'));
		}
		
		redirect('manage/Contactboard/');
		
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
	
	/*
     * file value and type check during validation
     */
    public function file_check($val=array()){
        $allowed_mime_type_arr = array('image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['attachment']['name']);
        if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only jpg,png file.');
                return false;
            }
        }
    }//end file check
    
    private function __fillDesignation($id=""){
		
		$str = array(''=>'--Select Designation--');
		
		if(trim($id)!=""){
			$filter = array('ccc.cat_status'=>1,'cd.status'=>1,'cd.cat_id'=>$id);
			$rec =  $this->ContactdesignationModel->getAllList($this->__designationTbl,$filter);
			
			if(count($rec)>0){
			  foreach($rec as $row){
			  	$str[$row['d_id']] = $row['designation_en'];
			  }//end foreach			
			}//end count			
		}//end if	
		
		return $str;
		
	}//end __fillDesignation
	
	public function updatesrtorder(){
		
	  $this->load->library('form_validation');

	  $update_id = $this->uri->segment(5, NULL);
	  $update_order = $this->uri->segment(7, 0);
	  $update_type_name = $this->uri->segment(8, NULL);
	  $update_type_id = $this->uri->segment(9, 0);
	  
	  if(!is_null($update_id)){
	  	$update_id = encrypt_decrypt('decrypt',$update_id);
	  }
      
      $this->form_validation->set_data(array(
        'order_id'     =>  $update_id,
        'order_number' => $update_order,
        'type' => $update_type_id,
	  ));
	  	  	
	  $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required|is_natural_no_zero');
	  $this->form_validation->set_rules('order_number', 'Order Number', 'trim|required|is_natural_no_zero');
	  $this->form_validation->set_rules('type', 'Type', 'trim|required|is_natural_no_zero');
	  	 
	  	 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
         }else{        	
			$this->__queryStatus = $this->ContactModel->update_cat_sort_order($update_id,$update_order,$this->__table,'id','type',$update_type_id);
		 }//end check validation
		 
		 if($this->__queryStatus==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'order successfull updated!'));
		 }else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry try again later !'));
		 }
		 
		 redirect('manage/Contactboard');

	}//end updatesrtorder function
	
	public function recycle(){
        $this->load->helper('text');
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		
		$order = array('cd.type'=>'asc','cd.order_preference'=>'asc');
        $filter = array('cd.is_delete'=>1);
		$this->data['DataList'] = $this->ContactModel->getAllList($this->__table,$filter,$order);
		
	  	$this->front_view('admin/contact_board/recycle',$this->data);
	  	
	}//end recycle function
	
	public function recycle_delete(){
		
		$this->load->library('form_validation');
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
			 redirect('manage/Contactboard/recycle');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			 redirect('manage/Contactboard/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Contactboard/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->ContactModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
			$Query = $this->ContactModel->getSingleList($this->__table,$filter);
			
			if($this->ContactModel->deletedata($this->__table,$filter)==TRUE){
				
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
		
		redirect('manage/Contactboard/recycle');
	}//end
	
}//end Contactboard class
