<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallerymaster extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_photo_gallery";
	private $__catTbl = "comm_photo_gallery_category";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	private $__currentUrl = "";
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/GalleryModel');
		$this->load->library('Ajax_pagination');
		$this->load->config('cms_config');
		
		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		$this->perPage = 5;
		
		$this->_config = array(
			'upload_path'   => "./uploads/gallery/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "2097152", // Can be set to particular file size , here it is 2 MB (1024*1024*2)
		);
		
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$this->__allowStatus = 1;
		}
	}//end constructor
	
	public function index(){
		$this->data['CategoryList'] = $this->GalleryModel->GenerateDDList($this->__catTbl,'cat_id','cat_title_en','--SELECT CATEGORY--',array('cat_status'=>1,'is_delete'=>0));
	  	$this->front_view('admin/gallery/index',$this->data);
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
        $cat_id  = (int)$this->input->post('c_id',TRUE);
        $title  = $this->input->post('sTitle',TRUE);
        $status = $this->input->post('sStatus',TRUE);
        
        if(trim($title)!=""){
            $conditions['search']['title'] = $title;
        }
        if(trim($status)!=""){
            $conditions['search']['status'] = (int)$status;
        }
        $filter  = array('cp.is_delete'=>0);
        if($cat_id!=0 && is_numeric($cat_id)){
            $filter['cp.cat_id'] = $cat_id;
        }
        
        if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['cp.added_by'] = $UserLogId; 
		}
        
        $orderBy = array('cp.order_preference'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = count($this->GalleryModel->ajax_search_by_title($conditions,$filter,$orderBy,TRUE));
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("Faq/ajaxPaginationData");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->GalleryModel->ajax_search_by_title($conditions,$filter,$orderBy,TRUE);
        $this->data['PageNo']   = $offset;
        
        //load the view
        $this->load->view('admin/gallery/ajax_paginationgallery', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
	
	public function add(){
		
		$this->load->library('form_validation');
		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));
			
		$this->data['CategoryList'] = $this->GalleryModel->GenerateDDList($this->__catTbl,'cat_id','cat_title_en','--SELECT CATEGORY--',array('cat_status'=>1,'is_delete'=>0));
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			
		 /****Validation Rules start****/
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }
		 if(isset($_FILES["attachment"]["name"]) && $_FILES["attachment"]["name"]==""){
		  	$this->form_validation->set_rules('attachment', 'Image', 'required|callback_file_check');
		 }
		 
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Gallerymaster/add/');
         }else{
         			$s_order = (int)$this->GalleryModel->getmax($this->__table,'order_preference');
					$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
					
					$this->__currentUrl = current_url();
					$attachmentInfo = $this->_uploadFile();
					if($attachmentInfo['IS_UPLOAD']){
					
					    $DATAINPUT = array(
		         	    'title_hi'         => cleanQuery(trim($this->input->post('title_hi',TRUE))),
		         	    'title_en'         => cleanQuery(trim($this->input->post('title_en',TRUE))),
		         	    'cat_id' 	       => (int)cleanQuery(trim($this->input->post('category',TRUE))), 
		         	    'attachment'       => $attachmentInfo['FILE_NAME'],
		         	    'added_date'       => date('Y-m-d h:i:s'),
	         	    	'added_by'         => $UserLogId,
	         	    	'status'	   	   => $this->__status,
	         	    	'order_preference' => $s_order+1
		         	    );
										
	         	    	$this->__queryStatus = $this->GalleryModel->insertdata($this->__table,$DATAINPUT);
	         	    	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Try again later!'));
	         	    }
					
					if($this->__queryStatus==TRUE){
						$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
					}else{
						$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
					}        	   
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/gallery/add',$this->data);
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
			redirect('manage/Gallerymaster/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Gallerymaster/');
		}
		
		$this->data['CategoryList'] = $this->GalleryModel->GenerateDDList($this->__catTbl,'cat_id','cat_title_en','--SELECT CATEGORY--',array('cat_status'=>1,'is_delete'=>0));
		$this->data['DataList'] = $this->GalleryModel->getSingleList($this->__table,array('id'=>$this->__id));
	
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
		/****Validation Rules start****/
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }else{
		   	$this->__status = (int)$this->data['DataList']->status;
		 }
					
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Gallerymaster/edit/'.$this->__encId.'/');
         }else{
         	
         	 $this->__currentUrl = 'manage/Gallerymaster/edit/'.$this->__encId.'/';
         	
         	 if($_FILES["attachment"]["name"]!=""){
         		$attachmentInfo = $this->_uploadFile($this->data['DataList']->attachment);
	         	if($attachmentInfo['IS_UPLOAD']){
	         		$FILE_NAME = trim($attachmentInfo['FILE_NAME']);
	         	}else{
				  redirect('manage/Gallerymaster/edit/'.$this->__encId.'/');
			     }//end do upload
		     }else{
			 	$FILE_NAME=trim($this->data['DataList']->attachment);
			 }
		     //end check file name 
         	
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		
         	    $DATAINPUT = array(
         	    'title_hi' 	 => cleanQuery(trim($this->input->post('title_hi',TRUE))),
         	    'title_en' 	 => cleanQuery(trim($this->input->post('title_en',TRUE))),
         	    'attachment' => (isset($FILE_NAME) && trim($FILE_NAME)!="")?$FILE_NAME:"",
         	    'cat_id' 	 => (int)cleanQuery(trim($this->input->post('category',TRUE))),   
         	    'status'	 => $this->__status,
         	    'edit_date'  => date('Y-m-d h:i:s'),
         	    'edit_by'    => $UserLogId,
         	    );
				
				$this->__queryStatus = $this->GalleryModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
					
				}
                redirect('manage/Gallerymaster/edit/'.$this->__encId.'/');
              }//end validation
         
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/gallery/edit',$this->data);
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
			redirect('manage/Gallerymaster/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Gallerymaster/');
		}
				
		$data  = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('id'=>$this->__id);
		
		if($this->GalleryModel->updatedata($this->__table,$data,$filter)==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		}
		
		redirect('manage/Gallerymaster/');
		
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
				@unlink("./uploads/gallery/".trim($preUploadedFile));
			}
			
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>$this->upload->display_errors()));
				redirect($this->__currentUrl);
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
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }//end file check
    
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
			$this->__queryStatus = $this->GalleryModel->update_sort_order($update_id,$update_order,$this->__table);
		 }//end check validation
		 
		 if($this->__queryStatus==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'order successfull updated!'));
		 }else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry try again later !'));
		 }
		 
		 redirect('manage/Gallerymaster');

	}//end updatesrtorder function
	
	public function recycle(){
        $this->load->helper('text');
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$order = array('cp.order_preference'=>'asc');
        $filter = array('cp.is_delete'=>1);
		$this->data['DataList'] = $this->GalleryModel->getAllList($this->__table,$filter,$order);
		
	  	$this->front_view('admin/gallery/recycle',$this->data);
	  	
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
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			 redirect('manage/Gallerymaster/recycle');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			 redirect('manage/Gallerymaster/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Gallerymaster/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->GalleryModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
			$Query = $this->GalleryModel->getSingleList($this->__table,$filter);
			
			if($this->GalleryModel->deletedata($this->__table,$filter)==TRUE){
				
			   $Image = $Query->attachment ;
			   if(trim($Image)!=''){	
			    	if(is_file('./uploads/gallery/'.$Image)){
					  unlink('./uploads/gallery/'.$Image);						
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
		
		redirect('manage/Gallerymaster/recycle');
	}//end
	
}//end Gallery class