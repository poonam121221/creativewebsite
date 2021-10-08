<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_admin";
	private $__tblview = "";
	private $__id = NULL;
	private $__encId = NULL;
	private $__SpecialSymbol = ""; //!@#$%^&*?~
	private $__thumImgW = 138;
	private $__thumImgH = 177;
	private $__applicationName = "Epco Portal";

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('security','emailtemplate'));
		$this->load->model('manage/UserModel');
		
		$this->_config = array(
			'upload_path'   => "./uploads/files/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG|PNG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_filename_increment' => 50000,
			'max_size'      => "1048576", // Can be set to particular file size , here it is 1 MB (1024*1024)
		);
	}//end constructor
	
	public function index(){
		addmin_css(array('plugins/data-tables/DT_bootstrap.css','plugins/select2/select2.css','plugins/select2/select2-bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js','plugins/select2/select2.min.js'));
		//Fill Dropdown List
	    $this->__fillDropDown();
	  	$this->front_view('admin/user/index',$this->data);
	}//end index function
	
	//This function is used for datatable ajax function
	public function view(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
		$sesUpmID =	encrypt_decrypt('decrypt',$this->session->userdata['AUTH_USER']['USER_UPMID']);
		//$sesUserID = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_USER']['SERIALNO']);
			
		$column_order = array(null,'ca.admin_fname','ca.admin_designation','ca.admin_email','ca.admin_mobile',null,null);
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
        if(isset($sesUpmID) && $sesUpmID!=1){
			$filter['ca.admin_upm_id !='] = 1; //do not show supper admin information to other user
		}
        
        $order = array();
        if(isset($order_field) && trim($order_field)!=""){
			$order[$order_field] = $dir;
		}else{
			$order['ca.admin_upm_id'] = 'asc';
		}
        
        $fetchData = $this->UserModel->make_datatables($this->__table,$conditions,$filter,$order);
        $totalData = count($fetchData);
        $totalFiltered = $this->UserModel->get_filtered_data($this->__table,$conditions,$filter,$order);
        
        $data = array();
        $no = 0;
        if(count($fetchData)>0)
        {
         foreach($fetchData as $row){	
           $no++;
           $enc_id = encrypt_decrypt('encrypt',$row->admin_id);
           $nestedData = array();
            	
           $nestedData[] = $no;               
           $nestedData[] = $row->admin_fname." ".$row->admin_lname;
           $nestedData[] = $row->admin_designation;
           $nestedData[] = $row->admin_email;
           $nestedData[] = $row->admin_mobile;
           $nestedData[] = $row->upm_name;
           //$nestedData[] = getModifierName($row->admin_name,$row->edited_name);
           $nestedData[] = getModifiedDate($row->admin_add_date,$row->admin_edit_date);
           $nestedData[] = DisplayStatus(html_escape($row->admin_status));
           $nestedData[] = '<a href="'.base_url('manage/User/edit/'.$enc_id.'/').'" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>';
                
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
	
	public function profile(){
		
		addmin_css(array('plugins/jcrop/css/jquery.Jcrop.min.css','css/pages/image-crop.css'));
		add_admin_footer_js(array('plugins/jcrop/js/jquery.Jcrop.min.js'));
		
		$this->__encId =  $this->session->userdata['AUTH_USER']['SERIALNO'];
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);     
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/User/');
		}
		
		if($this->isExists($this->__table,array('admin_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/User/');
		}
		    		
		$this->data['DataList'] = $this->UserModel->getSingleList(array('um.admin_id'=>$this->__id,'admin_status'=>1));
	  	$this->front_view('admin/user/profile',$this->data);
	}//end profile function
	
	public function updateProfile(){
		$this->load->library('form_validation');
		
		$this->__encId = $this->session->userdata['AUTH_USER']['SERIALNO'];
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
	if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
		redirect('manage/User/profile/');
	}
		
	if ($this->input->server('REQUEST_METHOD') == 'POST'){
		 
	  $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');
	  $this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[60]|alpha_numeric_spaces');
	  $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|max_length[60]|alpha_numeric_spaces');
	  $this->form_validation->set_rules('mob', 'Mobile', 'trim|required|exact_length[10]|is_natural|check_unique['.$this->__table.'.admin_mobile.admin_id.'.$this->__id.']');
	  $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[60]|valid_email|check_unique['.$this->__table.'.admin_email.admin_id.'.$this->__id.']');
			
    if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
        redirect('manage/User/profile/');
    }else{
    	
      $fname = strtolower(cleanQuery(trim($this->input->post('fname',TRUE))));
      $lname = strtolower(cleanQuery(trim($this->input->post('lname',TRUE))));
      $email = cleanQuery(trim($this->input->post('email',TRUE)));
      $mobile = cleanQuery(trim($this->input->post('mob',TRUE)));
      $fullname = $fname." ".$lname;
      
      $DATAINPUT = array(
      'admin_fname' => $fname,
      'admin_lname' => $lname,
      'admin_email' => $email,
      'admin_mobile'=> $mobile,
      'admin_edit_by'=>$this->__id,
      'admin_edit_date'=>date('Y-m-d h:i:s')
      );
      $activeLog = "Profile of ".$fullname." is updated successfully.";
      
      $this->__queryStatus = $this->UserModel->updatedata($this->__table,$DATAINPUT,array('admin_id'=>$this->__id),$activeLog,TRUE,$this->__id);
				
	  if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Profile successfully updated.'));
	  }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
	  }
            redirect('manage/User/profile/');
   }//end validation
  }//end check post method
		
	$this->front_view('admin/user/profile',$this->data);
  }//end updateProfile
	
	public function add(){

	//Fill Dropdown List
	$this->__fillDropDown();
	
	$this->load->library('form_validation');
	addmin_css(array('plugins/select2/select2.css','plugins/select2/select2-bootstrap.css'));
	add_admin_footer_js(array('plugins/select2/select2.min.js'));
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		 
		 $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha'); 	
		 $this->form_validation->set_rules('pid', 'Privilege Name', 'trim|required|integer');	
		 $this->form_validation->set_rules('uname', 'User Name', 'trim|required|min_length[6]|max_length[20]|alphanum_underscore|is_unique['.$this->__table.'.admin_username]');
		 $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[60]|valid_email|is_unique['.$this->__table.'.admin_email]');
		 $this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[60]|alpha_numeric_spaces');
		 $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|max_length[60]|alpha_numeric_spaces');
		 $this->form_validation->set_rules('designation', 'Desgination', 'trim|required|max_length[100]|alpha_numeric_spaces');
		 $this->form_validation->set_rules('mob', 'Mobile', 'trim|required|exact_length[10]|is_natural|is_unique['.$this->__table.'.admin_mobile]');
		
		 if ($this->form_validation->run() == FALSE){
         $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
         }else{
         	
         	$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	
         	$fname = strtolower(cleanQuery(trim($this->input->post('fname',TRUE))));
         	$lname = strtolower(cleanQuery(trim($this->input->post('lname',TRUE))));
         	$designation = strtolower(cleanQuery(trim($this->input->post('designation',TRUE))));
         	$mobile = cleanQuery(trim($this->input->post('mob',TRUE)));
         	$fullname = $fname." ".$lname;
         		
         	$generatedPass = passwordGenerator($this->__SpecialSymbol);
         	$DATAINPUT = array(
         	 'admin_fname'   	=> $fname,
         	 'admin_lname'   	=> $lname,
         	 'admin_designation'=> $designation,
         	 'admin_username'	=> cleanQuery(trim($this->input->post('uname',TRUE))),
         	 'admin_password'	=> hash('sha256',$generatedPass),
         	 'admin_email'   	=> cleanQuery(trim($this->input->post('email',TRUE))),
     		 'admin_upm_id' 	=> cleanQuery(trim($this->input->post('pid',TRUE))),
     		 'admin_mobile'  	=> $mobile,
     		 'admin_add_date'   => date('Y-m-d h:i:s'),
         	 'admin_added_by'   => $UserLogId,
     		 'admin_status '    => 1
         	);
         	$activeLog = "Account of ".$fullname." is created successfully.";
				
		    $this->__queryStatus = $this->UserModel->insertdata($this->__table,$DATAINPUT,$activeLog,TRUE,$UserLogId);
				
			//Emai Configuration
			$emailInput = array(
				  'name'=>$fullname,
				  'designation'=>$designation,
				  'mobile'=>$mobile,
				  'message'=>'created',
				  'username'=>cleanQuery(trim($this->input->post('uname',TRUE))),
				  'password'=>$generatedPass,
				  'link'=>base_url('manage/')
			   );
						
			$emailMessage = "";			
			$emailMessage .=adminAccountCreation($emailInput);
				
			$EmailDetails = array(
				'email_to'=>cleanQuery(trim($this->input->post('email',TRUE))),
				'subject'=>'Your EPCO application account created successfully',
				'message'=>$emailMessage,
				'email_from'=>$this->__applicationName
			);
							    
			$msg = "";
			if($this->__queryStatus==TRUE){
				$getEmailInfo = $this->sendEmail($EmailDetails);//core/MY_Controller/Email Function
					
				$msg .= " and ".$getEmailInfo['message'];
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted. '.$msg));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
            redirect('manage/User/add/');
         }//end validation
         
		}//end check post method
	
	$this->front_view('admin/user/add',$this->data);
	
	}//end add function
	
	public function edit(){
		
		$this->load->library('form_validation');
		addmin_css(array('plugins/select2/select2.css','plugins/select2/select2-bootstrap.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js'));
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/User/');
		}
		
		if($this->isExists($this->__table,array('admin_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/User/');
		}
		
		$this->__fillDropDown();
		
		$this->data['DataList'] = $this->UserModel->getSingleList(array('um.admin_id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
		 
		 $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');	
		 $this->form_validation->set_rules('pid', 'Privilege Name', 'trim|required|integer');
		 $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[60]|valid_email|check_unique['.$this->__table.'.admin_email.admin_id.'.$this->__id.']');
		 $this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[60]|alpha_numeric_spaces');
		 $this->form_validation->set_rules('lname', 'Laste Name', 'trim|required|max_length[60]|alpha_numeric_spaces');
		 $this->form_validation->set_rules('designation', 'Desgination', 'trim|required|max_length[100]|alpha_numeric_spaces');
		 $this->form_validation->set_rules('mob', 'Mobile', 'trim|required|exact_length[10]|is_natural|check_unique['.$this->__table.'.admin_mobile.admin_id.'.$this->__id.']');
		 $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[1,0]');
		 $this->form_validation->set_rules('password_resend', 'Resend Password', 'trim|in_list[1,0]');
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                //redirect('manage/User/edit/'.$this->__encId.'/');
         }else{
         	
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		
         		$fname = strtolower(cleanQuery(trim($this->input->post('fname',TRUE))));
         		$lname = strtolower(cleanQuery(trim($this->input->post('lname',TRUE))));
         		$designation = strtolower(cleanQuery(trim($this->input->post('designation',TRUE))));
         		$mobile = cleanQuery(trim($this->input->post('mob',TRUE)));
         		$fullname = $fname." ".$lname;
         		
         		$user_password = cleanQuery($this->data['DataList']->admin_password);
         		if($this->input->post('password_resend',TRUE)==1){
					$user_password = passwordGenerator($this->__SpecialSymbol);
				}
         		
         		$DATAINPUT = array(
         	    	'admin_fname'   	=> $fname,
         	    	'admin_lname'   	=> $lname,
         	    	'admin_designation' => $designation,
         	    	'admin_email' 		=> cleanQuery(trim($this->input->post('email',TRUE))),
     				'admin_upm_id' 		=> cleanQuery(trim($this->input->post('pid',TRUE))),
     				'admin_mobile'  	=> $mobile,
     				'admin_status'  	=> cleanQuery(trim($this->input->post('status',TRUE))),
     				'admin_edit_date'   => date('Y-m-d h:i:s'),
         	    	'admin_edit_by'     => $UserLogId,
         	    	'admin_password'    => hash('sha256',$user_password)
         	    );
         	    $activeLog = "Account of ".$fullname." is updated successfully.";
         	    				
				$this->__queryStatus = $this->UserModel->updatedata($this->__table,$DATAINPUT,array('admin_id'=>$this->__id),$activeLog,TRUE,$UserLogId);
				
			  if($this->__queryStatus==TRUE){
					
				$msg = "";
				if($this->input->post('password_resend',TRUE)==1){
				//Emai Configuration
				$emailInput = array(
				  'name'=>$fullname,
				  'designation'=>$designation,
				  'mobile'=>$mobile,
				  'message'=>'updated',
				  'username'=>$this->data['DataList']->admin_username,
				  'password'=>$user_password,
				  'link'=>base_url('manage/')
				);
						
				$emailMessage = "";			
				$emailMessage .=adminAccountCreation($emailInput);
						
				$EmailDetails = array(
					'email_to'=>cleanQuery(trim($this->input->post('email',TRUE))),
					'subject'=>'Your EPCO application account updated successfully',
					'message'=>$emailMessage,
					'email_from'=>$this->__applicationName
				);
						
				$getEmailInfo = $this->sendEmail($EmailDetails);
				$msg .= " and ".$getEmailInfo['message'];
				}
										
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted. '.$msg));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/User/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method
		
	  	$this->front_view('admin/user/edit',$this->data);
	}//end edit function

	public function changePass(){
		$this->load->library('form_validation');
		
		$this->__encId = $this->session->userdata['AUTH_USER']['SERIALNO'];
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
	if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
		$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
		redirect('manage/User/changePass/');
	}
		
	if ($this->input->server('REQUEST_METHOD') == 'POST'){
		 
		 $this->form_validation->set_rules('captcha','Security code','trim|required|check_captcha');	
		 $this->form_validation->set_rules('upass', 'Current Password', 'trim|required|max_length[20]');
		 $this->form_validation->set_rules('new_pass', 'User Password', 'trim|required|min_length[6]|max_length[20]|valid_pass_pattern');
		 $this->form_validation->set_rules('con_pass', 'Confirm Password', 'trim|required|max_length[20]|matches[new_pass]');
			
    if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
        redirect('manage/User/changePass/');
    }else{
         	
    if($this->isExists($this->__table,array('admin_id'=>$this->__id,'admin_password'=>hash('sha256',$this->input->post('upass',TRUE))))==FALSE){ 
      $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Invalid Current password!'));
	  redirect('manage/User/changePass/');
    }
      
      $DATAINPUT = array(
      'admin_password' => hash('sha256',cleanQuery(trim($this->input->post('new_pass',TRUE)))),
      'admin_edit_by'  =>$this->__id,
      'admin_edit_date'=>date('Y-m-d h:i:s')
      );
      $this->__queryStatus = $this->UserModel->updatedata($this->__table,$DATAINPUT,array('admin_id'=>$this->__id));
				
	  if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Password successfully change.'));
	  }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
	  }
            redirect('manage/User/changepass/');
   }//end validation
  }//end check post method
		
	$this->front_view('admin/user/changepass',$this->data);
  }//end changePass
    
   //this function used for check current password for user
    public function validUser($pass){
   		
   		$this->__id =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
   		$userRec = $this->UserModel->getUserInfo($this->__table,array("admin_id"=>$this->__id));
   		if($userRec==FALSE){
				$this->form_validation->set_message('validUser', 'The {field} password is not valid.');
				return FALSE;
		}else{
			if($userRec->admin_password==hash('sha256',$pass)){
				return TRUE;
			}else{
				$this->form_validation->set_message('validUser', 'The {field} password is not valid.');
				return FALSE;
			}
		}//end check recorod from database 
   }
	
	private function __fillDropDown(){
	 if($this->session->userdata['AUTH_USER']['USER_ROLE']=="SUPPER ADMIN"){
		$this->data['PrivilegeList'] = $this->UserModel->GenerateDDList('user_previlege_master','upm_id','upm_name','--SELECT PRIVILEGE--',array('isdelete'=>0));
	 }else{
		$this->data['PrivilegeList'] = $this->UserModel->GenerateDDList('user_previlege_master','upm_id','upm_name','--SELECT PRIVILEGE--',array('isdelete'=>0,'upm_id!='=>1));
	 }
	 
	}//END __fillDropDown FUNCTION
	
	public function update_photo(){
		
	  $this->load->library('form_validation');				
	  if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		
	  $this->__id = encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		
	  if($this->isExists($this->__table,array('admin_id'=>$this->__id))==FALSE){
	   $this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record not found!'));
		redirect('manage/User/');
	  }
				
	  $this->data['DataList'] = $this->UserModel->getSingleList(array('um.admin_id'=>$this->__id));
	  
	  $this->form_validation->set_rules('x1', 'x1 value', 'trim|required|numeric');	
	  $this->form_validation->set_rules('y1', 'y1 value', 'trim|required|numeric');	
	  $this->form_validation->set_rules('x2', 'x2 value', 'trim|required|numeric');	
	  $this->form_validation->set_rules('y2', 'y2 value', 'trim|required|numeric');
	  	
	  if(empty($_FILES['image_file']['name'])){
    	$this->form_validation->set_rules('image_file', 'Profile Image', 'required');
	  }
		 
	  if ($this->form_validation->run() == FALSE){
         $this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>validation_errors()));
         redirect('manage/User/profile/');
      }else{
         	
         	$img_x1 = $this->input->post('x1',TRUE);
		    $img_y1 = $this->input->post('y1',TRUE);
		    $img_x2 = $this->input->post('x2',TRUE);
		    $img_y2 = $this->input->post('y2',TRUE);
         	
         	$attachmentName = $this->_uploadFile($this->data['DataList']->admin_image,$img_x1,$img_y1);   
         	
         	if($attachmentName==FALSE){
				redirect('manage/User/profile');
			}
         	      	
         	$DATAINPUT = array(
         	   'admin_image' => $attachmentName,
         	);
				
			$this->__queryStatus = $this->UserModel->updatedata($this->__table,$DATAINPUT,array('admin_id'=>$this->__id));
			
			if($this->__queryStatus==TRUE){
			  $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted. '));
		    }else{
			  $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}			
         	
       }//end check validation		 
		
	  }//end check post method
		
	  redirect('manage/User/profile');
		
	}//end update_photo function
	
	protected function _uploadFile($preUploadedFile="",$img_x1,$img_y1){

		$this->load->library('upload', $this->_config);
		$this->upload->initialize($this->_config);
				
		$FILE_NAME = "";
		$FULL_PATH = "";
	
		if(isset($_FILES['image_file']['name'])==TRUE && trim($_FILES['image_file']['name'])!=""){
			
			if($this->upload->do_upload('image_file')){
				
				$upload_data = $this->upload->data();
				$FILE_NAME = $upload_data['file_name'];
				$FULL_PATH = $upload_data['full_path'];
				$fileInfo = getFileInfo($upload_data['file_name']);
				
				$NEW_IMAGE = $fileInfo['filename'].'_thumb'.'.'.$fileInfo['extension'];
				
				if(trim($preUploadedFile)!="" && trim($preUploadedFile)!=NULL){
					@unlink("./uploads/files/".trim($preUploadedFile));
				}
				
				if($this->create_thumb_gallery($upload_data, $FULL_PATH, $upload_data['file_path'].$NEW_IMAGE,$img_x1,$img_y1)){				
					if(trim($FILE_NAME)!="" && trim($FILE_NAME)!=NULL){
						@unlink("./uploads/files/".trim($FILE_NAME));
					}
					return $NEW_IMAGE;
				}else{
					return FALSE;
				}
				 //Creating Thumbnail for Gallery which keeps the original
										
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>$this->upload->display_errors()));
				return FALSE;
			}
		}else{
			return $preUploadedFile;
		}
			
	}//end uploadFile function
	
	public function create_thumb_gallery($upload_data, $source_img, $new_img, $img_x1,$img_y1){
		
	//Copy Image Configuration
	$config['image_library'] = 'gd2';
	$config['source_image'] = $source_img;
	$config['new_image'] = $new_img;
	$config['quality'] = '100%';
	$config['x_axis'] = $img_x1;
	$config['y_axis'] = $img_y1;
	$config['width'] = $this->__thumImgW;
	$config['height'] = $this->__thumImgH;
	$config['maintain_ratio'] = FALSE;

	$this->load->library('image_lib');
	$this->image_lib->initialize($config);

	if ( ! $this->image_lib->crop() )
	{
		$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>$this->upload->display_errors()));
		return false;
	}
	return true;
	}

}// end User class