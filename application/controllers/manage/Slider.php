<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_sliders";
	private $__id = NULL;
	private $__encId = NULL;
	private $__catId = NULL;
	private $__catEncId = NULL;
	private $__currentUrl = "";
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/SliderModel');
		
		$this->_config = array(
			'upload_path'   => "./uploads/slider/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			//'max_width'     => '788',
			//'max_height'     => '381',
			//'min_width'     => '788',
			//'min_height'     => '381',
			'max_size'      => "512000", // Can be set to particular file size , here it is 500 KB (1024*500)
		);
	}//end constructor
	
	public function index(){  
		addmin_css(array('plugins/data-tables/DT_bootstrap.css','plugins/bootstrap-fileinput/bootstrap-fileinput.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
        //get the posts data
        $location = $this->uri->segment(4, 1);
        $this->data['DataList'] = $this->SliderModel->getAllList($this->__table,array('sl.is_delete'=>0,'sl.cat_id'=>$location));        
        //load the view
        $this->front_view('admin/slider/index',$this->data);
	  	
	}//end topslider function
	
	public function add(){
		
		$this->load->library('form_validation');
		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));
				
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		
		$this->__catEncId = $this->input->post('cid',TRUE);
		
		if($this->__catEncId!="" || $this->__catEncId!=NULL){
		  $this->__catId = encrypt_decrypt('decrypt',$this->__catEncId);
		  
		  if($this->__catId==""){
		  	$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>'Invalid Category Id.'));
			redirect('manage/Slider/');
		  }
		  
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>'Invalid Category Id.'));
			redirect('manage/Slider/');
		}
		 
		 /****Validation Rules start****/
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');		 	 
		 $this->form_validation->set_rules('url', 'URL', 'trim|valid_url|max_length[255]');
		 $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
		 if(empty($_FILES['attachment']['name'])){
    		$this->form_validation->set_rules('attachment', 'Attachment', 'required');
		 }
		 /****Validation Rules End****/	 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Slider/add/');
         }else{
				
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$result =  $this->SliderModel->getSingleList($this->__table);
         		
         		$this->__currentUrl = current_url();
         		$attachmentName = $this->_uploadFile();
         	    $DATAINPUT = array(
         	    	'cat_id'	   => (int)$this->__catId,
         	    	'title_hi'     => cleanQuery(trim($this->input->post('title_hi',TRUE))),
         	    	'title_en' 	   => cleanQuery(trim($this->input->post('title_en',TRUE))),
         	    	'attachment'   => $attachmentName,    
         	    	'desc_url'	   => cleanQuery(trim($this->input->post('url',TRUE))),
         	    	'added_date'   => date('Y-m-d h:i:s'),
         	    	'added_by'     => $UserLogId,
         	    	'status'       => (int)cleanQuery($this->input->post('status',TRUE)), 
         	    	);
				
				$this->__queryStatus = $this->SliderModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         }//end validation
         
         redirect('manage/Slider/add/cid/'.$this->__catEncId.'/');
         
		}//end check post method
		
	  	$this->front_view('admin/slider/add',$this->data);
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
			redirect('manage/Slider/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Slider/');
		}
		
		$this->data['DataList'] = $this->SliderModel->getSingleList($this->__table,array('id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			$this->__catEncId = $this->input->post('cid',TRUE);
			if($this->__catEncId!="" || $this->__catEncId!=NULL){
			  $this->__catId = encrypt_decrypt('decrypt',$this->__catEncId);
			  
			  if($this->__catId==""){
			  	$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>'Invalid Category Id.'));
				redirect('manage/Slider/');
			  }
			  
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>'Invalid Category Id.'));
				redirect('manage/Slider/');
			}
			
	  $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');
	  $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
	  $this->form_validation->set_rules('url', 'URL', 'trim|valid_url|max_length[255]');
	  $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
			
	if ($this->form_validation->run() == FALSE){
       $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
       redirect('manage/Slider/edit/'.$this->__encId.'/');
    }else{
       $UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
       $this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		
       $this->__currentUrl = 'manage/Slider/edit/'.$this->__encId.'/';  		
       //This function create bottom of class for upload file
       $attachmentName = $this->_uploadFile($this->data['DataList']->attachment);
       $DATAINPUT = array(
         'cat_id'	 => (int)$this->__catId,
	     'title_hi'  => cleanQuery(trim($this->input->post('title_hi',TRUE))),
	     'title_en'  => cleanQuery(trim($this->input->post('title_en',TRUE))),     	
	     'attachment'=> $attachmentName,
	     'desc_url'	 => cleanQuery(trim($this->input->post('url',TRUE))), 
         'status'    => (int)cleanQuery($this->input->post('status',TRUE)),
         'edit_date' => date('Y-m-d h:i:s'),
         'edit_by'   => $UserLogId
       );
				
	  $this->__queryStatus = $this->SliderModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
	  if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
	  }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
	  }
                redirect('manage/Slider/edit/'.$this->__encId.'/');
     }//end validation
    }//end check post method		
		
	 $this->front_view('admin/slider/edit',$this->data);
   }//end edit function
	
	public function delete(){
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Slider');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Slider');
		}
		
		$this->__queryStatus = $this->SliderModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
		
		$Query = $this->SliderModel->getSingleList($this->__table,array('id'=>$this->__id));		
		
		if($this->SliderModel->deletedata($this->__table,array('id'=>$this->__id))==TRUE){
			
			 	$Image = $Query->attachment ;
			    if(trim($Image)!=''){	
			    	if(is_file('./uploads/slider/'.$Image)){
						unlink('./uploads/slider/'.$Image);						
					}else{
						$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>'Sorry File does not exist!'));
						
					}
			    }
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		}
		
		redirect('manage/Slider');
		
	}//end delete function
	
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
				@unlink("./uploads/slider/".trim($preUploadedFile));
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
	
}//end Dashboard class