<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_pages";
	private $__id = NULL;
	private $__encId = NULL;

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form'));
		$this->load->model('manage/PageModel');
		$this->checkAuthUser();

		$this->_config = array(
			'upload_path'   => "./uploads/pages/",
			'allowed_types' => "PDF|pdf|jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "26214400", // Can be set to particular file size , here it is 25 MB
		);


	}//end constructor

	public function index(){
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$this->data['PageList'] = $this->PageModel->getAllList($this->__table);
	    $this->front_view('admin/page/index',$this->data);
	}//end index function

	public function add(){
		
	 $this->load->library(array('form_validation','Ckeditorsetup'));
	 
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			
			 $this->form_validation->set_rules('page_url', 'Page Slug', 'required|trim|min_length[2]|max_length[100]|is_unique['.$this->__table.'.page_url]');
			 $this->form_validation->set_rules('page_title_hi', 'Title Hindi', 'required|trim|min_length[2]|max_length[255]|is_unique['.$this->__table.'.page_title_hi]');
			 $this->form_validation->set_rules('page_description_hi', 'Description Hindi', 'required|trim|min_length[2]');
			 $this->form_validation->set_rules('page_title_en', 'Title English', 'required|trim|min_length[2]|max_length[255]|is_unique['.$this->__table.'.page_title_en]');
			 $this->form_validation->set_rules('page_description_en', 'Description English', 'required|trim|min_length[2]');
			 $this->form_validation->set_rules('meta_keyword', 'SEO Keyword', 'trim|max_length[200]');
			 $this->form_validation->set_rules('meta_desc', 'SEO Description', 'trim|max_length[200]');
			 $this->form_validation->set_rules('meta_title', 'SEO Title', 'trim|max_length[200]');
			 $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
			
			 if ($this->form_validation->run() == FALSE){
	                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
	         }else{
	           $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);	 
	           
	           $attachmentName = $this->_uploadFile();	     
	         	    
	           $DATAINPUT = array(	
					'page_title_hi'        => cleanQuery(trim($this->input->post('page_title_hi',TRUE))),
					'page_description_hi'  => trim($this->input->post('page_description_hi',FALSE)),
					'page_title_en'        => cleanQuery(trim($this->input->post('page_title_en',TRUE))),
					'page_description_en'  => trim($this->input->post('page_description_en',FALSE)),
					'meta_title'    	   => cleanQuery(trim($this->input->post('meta_title',TRUE))),
					'page_url'    	       => seoUrl(cleanQuery(trim($this->input->post('page_url',TRUE)))),
					'meta_keyword' 		   => cleanQuery(trim($this->input->post('meta_keyword',TRUE))),
					'meta_desc'    		   => cleanQuery(trim($this->input->post('meta_desc',TRUE))),
					'page_status '     	   => (int)cleanQuery(trim($this->input->post('status',TRUE))),
					'page_added_date'      => date('Y-m-d h:i:s'),
					'attachment'      	   => $attachmentName,    
		         	'page_added_by'        => $UserLogId,
			   );
					
				$this->__queryStatus = $this->PageModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$msg ='Data successfully submited.';
						if(!$this->PageModel->cache_routes($this->__table)){
							$msg .= "Unable to write the route file in cache/route.php";
						}
						
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>$msg));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         	}//end validation
         
		}//end check post method
		
	  	$this->front_view('admin/page/add',$this->data);
		
	}//end add function

	public function edit(){
		
		$this->load->library(array('form_validation','Ckeditorsetup'));
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Page/');
		}
		
		if($this->isExists($this->__table,array('page_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Page/');
		}		
		
		$this->data['DataList'] = $this->PageModel->getSingleList($this->__table,array('page_id'=>$this->__id));



		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
						 	
		 $this->form_validation->set_rules('page_url', 'Title Hindi', 'required|trim|min_length[2]|max_length[255]|check_unique['.$this->__table.'.page_url.page_id.'.$this->__id.']');
		 $this->form_validation->set_rules('page_title_hi', 'Title Hindi', 'required|trim|min_length[2]|max_length[255]|check_unique['.$this->__table.'.page_title_hi.page_id.'.$this->__id.']');
		 $this->form_validation->set_rules('page_description_hi', 'Description Hindi', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('page_title_en', 'Title English', 'required|trim|min_length[2]|max_length[255]|check_unique['.$this->__table.'.page_title_en.page_id.'.$this->__id.']');
		 $this->form_validation->set_rules('page_description_en', 'Description English', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('meta_keyword', 'SEO Keyword', 'trim|max_length[200]');
		 $this->form_validation->set_rules('meta_desc', 'SEO Description', 'trim|max_length[200]');
		 $this->form_validation->set_rules('meta_title', 'SEO Title', 'trim|max_length[200]');
		 $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Page/edit/'.$this->__encId.'/');
         }else{
         	
         	$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         	$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);

         	//This function create bottom of class for upload file
          	$attachmentName = $this->_uploadFile($this->data['DataList']->attachment);

         	
         	$DATAINPUT = array(	
			'page_title_hi'        => cleanQuery(trim($this->input->post('page_title_hi',TRUE))),
			'page_description_hi'  => checkaddslashes(trim($this->input->post('page_description_hi',FALSE))),
			'page_title_en'        => cleanQuery(trim($this->input->post('page_title_en',TRUE))),
			'page_description_en'  => checkaddslashes(trim($this->input->post('page_description_en',FALSE))),
			'page_url'    	       => seoUrl(cleanQuery(trim($this->input->post('page_url',TRUE)))),
			'meta_title'    	   => cleanQuery(trim($this->input->post('meta_title',TRUE))),
			'meta_keyword' 		   => cleanQuery(trim($this->input->post('meta_keyword',TRUE))),
			'meta_desc'    		   => cleanQuery(trim($this->input->post('meta_desc',TRUE))),
			'page_status '         => (int)cleanQuery(trim($this->input->post('status',TRUE))),
         	'page_edit_date'       => date('Y-m-d h:i:s'),
         	'attachment'      	   => $attachmentName,
         	'page_edit_by'         => $UserLogId,
		   );
				
		 	$this->__queryStatus = $this->PageModel->updatedata($this->__table,$DATAINPUT,array('page_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					
					$msg ='Data successfully updated.';
					if(!$this->PageModel->cache_routes($this->__table)){
						$msg .= "Unable to write the route file in cache/route.php";
					}
					
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>$msg));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Page/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
	  	$this->front_view('admin/page/edit',$this->data);
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
			redirect('manage/Page/');
		}
		
		if($this->isExists($this->__table,array('page_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Page/');
		}
		
		$DATAINPUT= array('is_delete'=>1);
		
		if($this->PageModel->updatedata($this->__table,$DATAINPUT,array('page_id'=>$this->__id))==TRUE){
			$msg ='Data successfully deleted.';
				if(!$this->PageModel->cache_routes($this->__table)){
					$msg .= "Unable to write the route file in cache/route.php";
				}
					
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>$msg));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		}
		
		redirect('manage/Page/');
		
	}//end delete function
	
	public function page_default(){
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Page/');
		}
		
		if($this->isExists($this->__table,array('page_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Page/');
		}
		
		$DATAINPUT= array('is_default'=>1);
		$this->__queryStatus = $this->PageModel->updatedata($this->__table,$DATAINPUT,array('page_id'=>$this->__id));
		$this->PageModel->updatedata($this->__table,array('is_default'=>0),array('page_id!='=>$this->__id));
		
		if($this->__queryStatus){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull update!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry !'));
		}		
		redirect('manage/Page/');
		
	}//end page_default function

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
					@unlink("./uploads/pages/".trim($preUploadedFile));
				}			
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>$this->upload->display_errors()));
			}
		}else{
			$FILE_NAME = $preUploadedFile;
		}



		return $FILE_NAME;	
	}//end uploadFile function

}// end page class