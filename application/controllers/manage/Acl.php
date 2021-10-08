<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//This class is used for define specific Controller and Name 

class Acl extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__menuTbl = "menu_list"; //view
	private $__table = "comm_auth_controller_function";
	private $__tblAccess = "comm_auth_acl";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('manage/AccesslistModel','manage/AclModel'));
	}//end constructor
	
	public function index(){
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));		
		$this->data['DataList'] = $this->AclModel->getAllList($this->__tblAccess,array('ac.status'=>1),array('ac.auth_id'=>'asc'));
	  	$this->front_view('admin/acl/index',$this->data);
	}//end index function
	
	public function add(){
		
	$this->load->library(array('form_validation'));
	
	$auth_function = "";
	$auth_function_empty = TRUE;
	
	$this->data['PrivilegeList'] = $this->AclModel->GenerateDDList('user_previlege_master','upm_id','upm_name','--SELECT PRIVILEGE--',array('isdelete'=>0,'upm_id!='=>1));
	
	$this->data['ControllerList'] = $this->AclModel->GenerateDDList($this->__table,'menu_id','controller_title','--SELECT CONTROLLER--',array('status'=>1),array('controller_title'=>'asc'));
	 
    if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	
	$this->form_validation->set_rules('pid', 'Privilege Name', 'required|trim|is_natural_no_zero');
	$this->form_validation->set_rules('menu_id', 'Controller Name', 'required|trim|is_natural_no_zero');
	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
	
	if(isset($_POST['function_name']) && count($_POST['function_name'])>0){
		$this->form_validation->set_rules('function_name[]', 'Function Name', 'trim|max_length[255]|regex_match[/^[a-zA-Z,_\-\s]+$/]',array('regex_match' => 'Please enter valid %s.'));
		$auth_function_empty = FALSE;
	}
	
	$pid = (int)cleanQuery(trim($this->input->post('pid',TRUE)));
	$menu_id = (int)cleanQuery(trim($this->input->post('menu_id',TRUE)));
	
	if($this->__chk_unique_record($pid,$menu_id)==FALSE){
	   $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>"Privilege Name and Controller should be unique !"));
       redirect('manage/Acl/add');
	}	
		
		 if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
            redirect('manage/Acl/add');
         }else{
         	    
           $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
           
           if($auth_function_empty==FALSE){
           	$auth_function = cleanQuery($this->input->post('function_name',TRUE));
           	$auth_function = implode(",",$auth_function);	   
           }
           
           $DATAINPUT = array(	
			'priviledge_id' => $pid,
			'menu_id'       => $menu_id,
			'auth_function' => $auth_function,
			'status'        => (int)cleanQuery(trim($this->input->post('status',TRUE))),
         	'added_date'    => date('Y-m-d h:i:s'),
         	'added_by'      => $UserLogId,
		   );
				
			$this->__queryStatus = $this->AclModel->insertdata($this->__tblAccess,$DATAINPUT);
			if($this->__queryStatus==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
                
         }//end validation
         
		}//end check post method
		
	  	$this->front_view('admin/acl/add',$this->data);
		
	}//end add function
	
	public function edit(){
		
		$this->load->library('form_validation');
		
		$auth_function = "";
		$auth_function_empty = FALSE;
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Acl/');
		} 
		
		if($this->isExists($this->__tblAccess,array('auth_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Acl/');
		}		
		
		$this->data['UserPrivilegeList'] = $this->AclModel->getSingleList($this->__tblAccess,array('ac.auth_id'=>$this->__id));
		
		$this->data['DataList'] = $this->AccesslistModel->getSingleList($this->__table,array('ac.menu_id'=>$this->data['UserPrivilegeList']->menu_id));
		
		$this->data['PrivilegeList'] = $this->AclModel->GenerateDDList('user_previlege_master','upm_id','upm_name','--SELECT PRIVILEGE--',array('isdelete'=>0,'upm_id!='=>1));
		
		$filter2 =array('menu_id'=>$this->data['UserPrivilegeList']->menu_id,'status'=>1);
		$orderBy = array('controller_title'=>'asc');
		$this->data['ControllerList'] = $this->AclModel->GenerateDDList($this->__table,'menu_id','controller_title','',$filter2,$orderBy);
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
		
		$this->form_validation->set_rules('pid', 'Privilege Name', 'required|trim|is_natural_no_zero');	
		$this->form_validation->set_rules('menu_id', 'Controller Name', 'required|trim|is_natural_no_zero');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
		
		if(isset($_POST['function_name']) && count($_POST['function_name'])>0){

		  $this->form_validation->set_rules('function_name[]', 'Function Name', 'trim|max_length[255]|regex_match[/^[a-zA-Z,_\-\s]+$/]',array('regex_match' => 'Please enter valid %s.'));
		  $auth_function_empty = FALSE;
		  
		}//end check function name	
		
		$pid = (int)cleanQuery(trim($this->input->post('pid',TRUE)));
		$menu_id = (int)cleanQuery(trim($this->input->post('menu_id',TRUE)));
		
		if($this->__chk_unique_record($pid,$menu_id,$this->__id)==FALSE){
		   $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>"Privilege Name and Controller should be unique !"));
	       redirect('manage/Acl/edit/'.$this->__encId.'/');
		} 
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
                redirect('manage/Acl/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		
         		if($auth_function_empty==FALSE){
					$auth_function = cleanQuery($this->input->post('function_name',TRUE));
         			$auth_function = implode(",",$auth_function);
				}
         		
         		
         	    $DATAINPUT = array(	
				  'priviledge_id' => (int)cleanQuery(trim($this->input->post('pid',TRUE))),
				  'menu_id'		  => (int)cleanQuery(trim($this->input->post('menu_id',TRUE))),
				  'auth_function' => $auth_function,
				  'status'        => (int)cleanQuery(trim($this->input->post('status',TRUE))),
         	      'edit_date'     => date('Y-m-d h:i:s'),
         	      'edit_by'       => $UserLogId,
         	    );
				
		$this->__queryStatus = $this->AclModel->updatedata($this->__tblAccess,$DATAINPUT,array('auth_id'=>$this->__id));
				
		if($this->__queryStatus==TRUE){
		 $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
		}else{
		 $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
		}
            redirect('manage/Acl/edit/'.$this->__encId.'/');
      }//end validation
	 }//end check post method		
		
	  	$this->front_view('admin/acl/edit',$this->data);
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
			redirect('manage/Acl');
		}
		
		if($this->isExists($this->__tblAccess,array('auth_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Acl');
		}
		
		$this->__queryStatus = $this->AclModel->deletedata($this->__tblAccess,array('auth_id'=>$this->__id));
		
		if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		}
		
		redirect('manage/Acl');
		
	}//end delete function
	
	private function __chk_unique_record($pid=0,$controller_id=0,$id=0){
		
		$filter = array('priviledge_id'=>$pid,'menu_id'=>$controller_id);
		
		if($id!="" && $id !=0){
			$filter['auth_id !='] = (int)$id;
		}
		
		if($this->AclModel->check_unique_acl($this->__tblAccess,$filter)==0){
			return TRUE;
		}
		return FALSE;
	}//chk_unique_record
	
}//end Acl class