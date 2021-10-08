<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_policies";
	private $__catTbl = "comm_policies_category";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	private $__currentUrl = "";
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/PolicyModel');
		$this->load->config('cms_config');
		
		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		
		$this->_config = array(
			'upload_path'   => "./uploads/policy/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG|pdf|PDF",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "15728640", // Can be set to particular file size , here it is 15 MB (1024*1024*15)
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
	  	$this->front_view('admin/policy/index',$this->data);
	  	
	}//end index function
	
	public function view(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
			
		$column_order = array(null,'cpgc.policies_category_title_en', 'cp.title_hi','cp.title_hi',null,null,null,null,null);
		$conditions = array();
		$limit = (int)$this->input->post('length');
        $start = (int)$this->input->post('start');
        $order_field = (isset($_POST['order']))?cleanQuery($column_order[$_POST['order']['0']['column']]):"";
        $search_field = cleanQuery($_POST['search']['value']);
        $dir = (isset($_POST['order']))?cleanQuery($_POST['order']['0']['dir']):"";
        
        if(trim($search_field)!="" && !empty($search_field)){
            $conditions['search']['title'] = $search_field;
        }
        
        $filter = array();
        //this is not for super admin and administrator
		if(!in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['cp.added_by'] = $UserLogId; 
		}
        $order = array();
        if(isset($order_field) && trim($order_field)!=""){
			$order[$order_field] = $dir;
		}else{
			$order['cp.order_preference'] = 'asc';
		}
        
        $policyData = $this->PolicyModel->make_datatables($this->__table,$conditions,$filter,$order);        
        $totalData = count($policyData);
        $totalFiltered = $this->PolicyModel->get_filtered_data($this->__table,$conditions,$filter,$order);
        
        $data = array();
        $no = 1;
        if(count($policyData)>0)
        {
            foreach($policyData as $row)
            {	
            	$no++;
            	$enc_id = encrypt_decrypt('encrypt',$row->id);
            	$sOrderUrl = "'".base_url("manage/Policy/updatesrtorder/sid/").$enc_id.'/sorder/'."'+this.value+''";
            	$nestedData = array();
            	$uploadedFile ="";
            	if(trim($row->attachment)!=""){
					$uploadedFile = '<a target="_blank" href="'.base_url('uploads/policy/'.$row->attachment).'"<i class="fa fa-download"></i></a>';
				}
            	
                $nestedData[] = '<input class="text-center" name="order_pref[]" type="text" size="1" style="width:25px;" onChange="location.replace('.$sOrderUrl.');"  value="'.$row->order_preference.'" />';               
                $nestedData[] = $row->policies_category_title_en;
                $nestedData[] = $row->title_hi;
                $nestedData[] = $row->title_en;
                $nestedData[] = $uploadedFile;
                $nestedData[] = getModifierName($row->admin_name,$row->edited_name);
                $nestedData[] = getModifiedDate($row->added_date,$row->edit_date);
                $nestedData[] = PublishStatus(html_escape($row->status));
                $nestedData[] = '<a href="'.base_url('manage/Policy/edit/'.$enc_id.'/').'" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>
	    <a href="'.base_url('manage/Policy/delete/'.$enc_id.'/').'" class="btn default btn-xs red tooltips" onclick="return confirm("Are you sure to delete record?"); " data-placement="top" data-original-title="Delete">
	    <i class="fa fa-trash-o"></i></a>';
                
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => (int)$this->input->post('draw'), 
                    "recordsTotal"    => (int)$totalData,  
                    "recordsFiltered" => (int)$totalFiltered, 
                    "data"            => $data,
                    );
    
        echo json_encode($json_data); 
        }else{
        	show_404();	
		}
        
	}//end view function
	
	public function add(){
		
		$this->load->library('form_validation');
		
		addmin_css(array('plugins/select2/select2.css','plugins/select2/select2-bootstrap.css','/plugins/bootstrap-datepicker/css/datepicker.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js','/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));
				
		$this->data['CategoryList'] = $this->PolicyModel->GenerateDDList($this->__catTbl,'policies_category_id','policies_category_title_en','--SELECT CATEGORY--',array('cat_status'=>1));
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		
		 /****Validation Rules start****/
		 $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[100]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[100]');
		 $this->form_validation->set_rules('archive_date', 'Archive Date', 'required|trim|check_date');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }
		 
		 if(isset($_FILES['attachment']['name'])==TRUE && trim($_FILES['attachment']['name'])==""){
		   $this->form_validation->set_rules('attachment', 'Attachment', 'required|max_length[100]');
		 }
		 
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Policy/add/');
         }else{
					$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
					
					$this->__currentUrl = current_url();
					$attachmentInfo = $this->_uploadFile();

					if($attachmentInfo['IS_UPLOAD']){
					
					    $DATAINPUT = array(
					    'cat_id' 	       => (int)cleanQuery(trim($this->input->post('category',TRUE))),
		         	    'title_hi'         => cleanQuery(trim($this->input->post('title_hi',TRUE))),
		         	    'title_en'         => cleanQuery(trim($this->input->post('title_en',TRUE))),	         	     
		         	    'attachment'       => $attachmentInfo['FILE_NAME'],
		         	    'archive_exp_date' => date_convert(trim($this->input->post('archive_date',TRUE))),
		         	    'added_date'       => date('Y-m-d h:i:s'),
	         	    	'added_by'         => $UserLogId,
	         	    	'status'	   	   => $this->__status,
		         	    );
		         	    										
	         	    	$this->__queryStatus = $this->PolicyModel->insertdata($this->__table,$DATAINPUT);

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
	  	$this->front_view('admin/policy/add',$this->data);
	}//end add function
	
	public function edit(){
		
		$this->load->library('form_validation');	
		addmin_css(array('plugins/select2/select2.css','plugins/select2/select2-bootstrap.css','/plugins/bootstrap-datepicker/css/datepicker.css',));
		add_admin_footer_js(array('plugins/select2/select2.min.js','/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Policy/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Policy/');
		}
		
		$this->data['CategoryList'] = $this->PolicyModel->GenerateDDList($this->__catTbl,'policies_category_id','policies_category_title_en','--SELECT CATEGORY--',array('cat_status'=>1));
		$this->data['DataList'] = $this->PolicyModel->getSingleList($this->__table,array('id'=>$this->__id));
	
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
		/****Validation Rules start****/
		 $this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
		 $this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');	
		 $this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('archive_date', 'Archive Date', 'required|trim|check_date');		   
		 if(isset($_FILES['attachment']['name'])==TRUE && trim($_FILES['attachment']['name'])==""){
		   $this->form_validation->set_rules('attachment', 'Attachment', 'max_length[100]');
		 }
		 
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }else{
		   	$this->__status = (int)$this->data['DataList']->status;
		 }
					
		 if ($this->form_validation->run() == FALSE){
           $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
           redirect('manage/Policy/edit/'.$this->__encId.'/');
         }else{
         	
         	if($_FILES["attachment"]["name"]!=""){
         		
         		$this->__currentUrl = 'manage/Policy/edit/'.$this->__encId.'/';         		
         		$attachmentInfo = $this->_uploadFile($this->data['DataList']->attachment);
	         	if($attachmentInfo['IS_UPLOAD']){
	         		$FILE_NAME = trim($attachmentInfo['FILE_NAME']);
	         	}else{
				  redirect('manage/Policy/edit/'.$this->__encId.'/');
			     }//end do upload
		     }else{
			 	$FILE_NAME = trim($this->data['DataList']->attachment);
			 }
		     //end check file name 
         	
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		
         	    $DATAINPUT = array(
         	    'cat_id' 	       => (int)cleanQuery(trim($this->input->post('category',TRUE))),
         	    'title_hi' 	       => cleanQuery(trim($this->input->post('title_hi',TRUE))),
         	    'title_en' 	       => cleanQuery(trim($this->input->post('title_en',TRUE))),
         	    'attachment'       => (isset($FILE_NAME) && trim($FILE_NAME)!="")?$FILE_NAME:"",         	     
         	    'archive_exp_date' => date_convert(trim($this->input->post('archive_date',TRUE))),  
         	    'status'	       => $this->__status,
         	    'edit_date'        => date('Y-m-d h:i:s'),
         	    'edit_by'          => $UserLogId,
         	    );
				
			$this->__queryStatus = $this->PolicyModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
			if($this->__queryStatus==TRUE){
			  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
			}else{
			  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));	
			}
             redirect('manage/Policy/edit/'.$this->__encId.'/');
           }//end validation
         
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/policy/edit',$this->data);
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
			redirect('manage/Policy/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Policy/');
		}
				
		$DATAINPUT = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		if($this->PolicyModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id))==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry can not be deleted!'));
		}
		
		redirect('manage/Policy/');
		
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
				@unlink("./uploads/policy/".trim($preUploadedFile));
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
			$this->__queryStatus = $this->PolicyModel->update_sort_order($update_id,$update_order,$this->__table);
		 }//end check validation
		 
		 if($this->__queryStatus==TRUE){
		  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'order successfull updated!'));
		 }else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry try again later !'));
		 }
		 
		 redirect('manage/Policy');

	}//end updatesrtorder function
	
	public function recycle(){
        $this->load->helper('text');
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		
		$filter = array('cp.is_delete'=>1);
		$order = array('cp.order_preference'=>'asc');
		$this->data['DataList'] = $this->PolicyModel->getAllList($this->__table,$filter,$order);
		
	  	$this->front_view('admin/policy/recycle',$this->data);
	  	
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
			 redirect('manage/Policy/recycle');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			 redirect('manage/Policy/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Policy/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->PolicyModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
			$Query = $this->PolicyModel->getSingleList($this->__table,$filter);
			
			if($this->PolicyModel->deletedata($this->__table,$filter)==TRUE){
				
			   $Image = $Query->attachment ;
			   if(trim($Image)!=''){	
			    	if(is_file('./uploads/policy/'.$Image)){
					  unlink('./uploads/policy/'.$Image);						
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
		
		redirect('manage/Policy/recycle');
	}//end recycle_delete
	
}//end Policy class