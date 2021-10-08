<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Importantwebsite extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_important_website";
	private $__id = NULL;
	private $__encId = NULL;
	protected $_config = array();
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/ImportantwebsiteModel');
		$this->load->config('cms_config');
		
		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		
		$this->_config = array(
			'upload_path'   => "./uploads/impweb/",
			'allowed_types' => "jpg|png|PNG|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "102400", // Can be set to particular file size , here it is 100 KB
		);
		
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$this->__allowStatus = 1;
		}
	}//end constructor
	
	public function index(){  
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		
        //get the posts data
        $order = array('iw.order_preference'=>'asc');
        $filter = array('iw.is_delete'=>0);
        //this is not for super admin and administrator
		if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['iw.added_by'] = $UserLogId; 
		}
        
        $this->data['DataList'] = $this->ImportantwebsiteModel->getAllList($this->__table,$filter,$order);
           
        //load the view
        $this->front_view('admin/importantwebsite/index',$this->data);
	  	
	}//end index function
	
	public function add(){
		
		$this->load->library('form_validation');
		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));	
				
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		 
		 /****Validation Rules start****/
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');		     $this->form_validation->set_rules('url', 'URL', 'trim|required|valid_url|max_length[100]');
		 $this->form_validation->set_rules('is_slide', 'Is Display Image', 'trim|required|in_list[0,1]');
		 if(empty($_FILES['attachment']['name'])){
    		$this->form_validation->set_rules('attachment', 'Attachment', 'max_length[200]');
		 }
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }else{
		   	$this->__status = (int)$this->data['DataList']->status;
		 }
		 
		 /****Validation Rules End****/	 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Importantwebsite/add/');
         }else{
				
				$s_order = (int)$this->ImportantwebsiteModel->getmax($this->__table,'order_preference');
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$redirectUrl = 'manage/Importantwebsite/edit/'.$this->__encId.'/';
         		$attachmentName = $this->_uploadFile("",$redirectUrl);
         		
         	    $DATAINPUT = array(
         	    	'title_hi'         => cleanQuery(trim($this->input->post('title_hi',TRUE))),
         	    	'title_en' 	       => cleanQuery(trim($this->input->post('title_en',TRUE))),  	    	
         	    	'url'	 	       => cleanQuery(trim($this->input->post('url',TRUE))), 
         	    	'attachment'       => $attachmentName, 	    	
         	    	'added_date'       => date('Y-m-d h:i:s'),
         	    	'added_by'         => $UserLogId,
         	    	'status'       	   => $this->__status,
         	    	'is_slide'         => (int)cleanQuery($this->input->post('is_slide',TRUE)), 
         	    	'order_preference' => $s_order+1
         	    	);
				
				$this->__queryStatus = $this->ImportantwebsiteModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/importantwebsite/add',$this->data);
	}//end add function
	
	public function edit(){
		
		$this->load->library('form_validation');
		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Importantwebsite/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Importantwebsite/');
		}
		
		$this->data['DataList'] = $this->ImportantwebsiteModel->getSingleList($this->__table,array('id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
		  $this->form_validation->set_rules('title_hi','Title (Hindi)','trim|required|min_length[2]|max_length[255]');
		  $this->form_validation->set_rules('title_en','Title (English)','trim|required|min_length[2]|max_length[255]');
		  $this->form_validation->set_rules('url', 'URL', 'trim|required|valid_url|max_length[100]');
		  $this->form_validation->set_rules('is_slide', 'Is Display Image', 'trim|required|in_list[0,1]');
		  if(empty($_FILES['attachment']['name'])){
    		   $this->form_validation->set_rules('attachment', 'Attachment', 'max_length[200]');
		  }
		  if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		  }
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Importantwebsite/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		$redirectUrl = 'manage/Importantwebsite/edit/'.$this->__encId.'/';
         		$attachmentName = $this->_uploadFile($this->data['DataList']->attachment,$redirectUrl);
         		
         	    $DATAINPUT = array(
	         	    	'title_hi'     => cleanQuery(trim($this->input->post('title_hi',TRUE))),
	         	    	'title_en' 	   => cleanQuery(trim($this->input->post('title_en',TRUE))),   
	         	    	'url'	 	   => cleanQuery(trim($this->input->post('url',TRUE))),
	         	    	'attachment'   => $attachmentName, 	    	
	         	    	'status'       => $this->__status,
	         	    	'is_slide'     => (int)cleanQuery($this->input->post('is_slide',TRUE)),
         	    		'edit_date'    => date('Y-m-d h:i:s'),
         	    		'edit_by'      => $UserLogId
         	    		);
				
				$this->__queryStatus = $this->ImportantwebsiteModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Importantwebsite/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/importantwebsite/edit',$this->data);
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
			redirect('manage/Importantwebsite');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Importantwebsite');
		}
		
		$DATAINPUT = array('is_delete'=>1,'edit_by'=>$UserLogId);
		$this->__queryStatus = $this->ImportantwebsiteModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
		
		if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		}
		
		redirect('manage/Importantwebsite');
		
	}//end delete function
	
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
			$this->__queryStatus = $this->ImportantwebsiteModel->update_sort_order($update_id,$update_order,$this->__table);
		 }//end check validation
		 
		 if($this->__queryStatus==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'order successfull updated!'));
		 }else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry try again later !'));
		 }
		 
		 redirect('manage/Importantwebsite/');

	}//end updatesrtorder function
	
	public function recycle(){  
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
        //get the posts data
        $order = array('iw.order_preference'=>'asc');
        $filter = array('iw.is_delete'=>1);
        $this->data['DataList'] = $this->ImportantwebsiteModel->getAllList($this->__table,$filter,$order);
           
        //load the view
        $this->front_view('admin/importantwebsite/recycle',$this->data);
	  	
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
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			 redirect('manage/Importantwebsite/recycle');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			 redirect('manage/Importantwebsite/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Importantwebsite/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId);
		$filter = array('id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->ImportantwebsiteModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
			
			if($this->ImportantwebsiteModel->deletedata($this->__table,$filter)==TRUE){
			   $Query = $this->ImportantwebsiteModel->getSingleList($this->__table,$filter);
			   $Image = $Query->attachment ;
			   if(trim($Image)!=''){	
			    	if(is_file('./uploads/impweb/'.$Image)){
					  unlink('./uploads/impweb/'.$Image);						
					}else{
					  $this->session->set_flashdata('AppMessage',array('class'=>'warning',
					  'message'=>'Sorry File does not exist!'));						
					}
			    }			
			   $this->session->set_flashdata('AppMessage',array('class'=>'success',
			   'message'=>'data successfull deleted!'));
			}else{
			   $this->session->set_flashdata('AppMessage',array('class'=>'info',
			  'message'=>'Record can not be deleted, try again!'));
			}
		 	
		 }//end check delete action id
			
		}//end check validation
		
		redirect('manage/Importantwebsite/recycle');
	}//end recycle_delete
	
	protected function _uploadFile($preUploadedFile="",$redirecturl=""){
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
				@unlink("./uploads/impweb/".trim($preUploadedFile));
			}
			
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>$this->upload->display_errors()));
				redirect($redirecturl);
			}
		}else{
			$FILE_NAME = $preUploadedFile;
		}

		return $FILE_NAME;	
	}//end uploadFile function
	
}//end Importantwebsite class