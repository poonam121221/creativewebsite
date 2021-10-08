<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//This class is used for define specific Controller and Name 

class Accesslist extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__menuTbl = "menu_list";
	private $__table = "comm_auth_controller_function";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('manage/AccesslistModel','manage/AclModel'));
	}//end constructor
	
	public function index(){
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));		
		$this->data['DataList'] = $this->AccesslistModel->getAllList($this->__table,array('status'=>1));
	  	$this->front_view('admin/accesslist/index',$this->data);
	}//end index function
	
	public function add(){
		
	$this->load->library(array('form_validation'));
	$this->data['ControllerList'] = $this->AccesslistModel->GenerateDDList($this->__menuTbl,'id','controller_name','--SELECT CONTROLLER--',array('is_active'=>1),array('controller_name'=>'asc'));
	 
    if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	
	$this->form_validation->set_rules('controller_title', 'Title', 'trim|required|max_length[100]');
	$this->form_validation->set_rules('menu_id', 'Controller Name', 'required|trim|is_natural_no_zero|is_unique['.$this->__table.'.menu_id]');
	$this->form_validation->set_rules('function_name[]', 'Function Name', 'required|trim|min_length[2]|max_length[255]|regex_match[/^[a-zA-Z,_\-]+$/]',array('regex_match' => 'Please enter valid %s.'));
	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
         }else{
         	    
           $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);	   
         	    
           $DATAINPUT = array(	
			'menu_id'            => (int)cleanQuery(trim($this->input->post('menu_id',TRUE))),
			'auth_function_name' => cleanQuery(trim($this->input->post('function_name',FALSE))),
			'controller_title'   => cleanQuery(trim($this->input->post('controller_title',TRUE))),
			'status'     	     => (int)cleanQuery(trim($this->input->post('status',TRUE))),
			'added_date'         => date('Y-m-d h:i:s'),
         	'added_by'           => $UserLogId,
		   );
				
			$this->__queryStatus = $this->AccesslistModel->insertdata($this->__table,$DATAINPUT);
			if($this->__queryStatus==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
                
         }//end validation
         
		}//end check post method
		
	  	$this->front_view('admin/accesslist/add',$this->data);
		
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
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Accesslist/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Accesslist/');
		}
		
		$this->data['DataList'] = $this->AccesslistModel->getSingleList($this->__table,array('ac.id'=>$this->__id));
		
		$this->data['ControllerList'] = $this->AccesslistModel->GenerateDDList($this->__menuTbl,'id','controller_name','--SELECT CONTROLLER--',array('is_active'=>1),array('controller_name'=>'asc'));
		
	if ($this->input->server('REQUEST_METHOD') == 'POST'){
		
	$this->form_validation->set_rules('controller_title', 'Title', 'trim|required|max_length[100]');	 $this->form_validation->set_rules('menu_id', 'Controller Name', 'required|trim|is_natural_no_zero|check_unique['.$this->__table.'.menu_id.id.'.$this->__id.']');
	$this->form_validation->set_rules('function_name[]', 'Function Name', 'required|trim|min_length[2]|max_length[255]|regex_match[/^[a-zA-Z,_\-]+$/]',array('regex_match' => 'Please enter valid %s.'));
	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	 
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Accesslist/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		
         	    $DATAINPUT = array(	
				  'menu_id'            => (int)cleanQuery(trim($this->input->post('menu_id',TRUE))),
				  'auth_function_name' => cleanQuery(trim($this->input->post('function_name',TRUE))),
				  'controller_title'   => cleanQuery(trim($this->input->post('controller_title',TRUE))),
				  'status'             => (int)cleanQuery(trim($this->input->post('status',TRUE))),
         	      'edit_date'          => date('Y-m-d h:i:s'),
         	      'edit_by'            => $UserLogId,
         	    );
				
		$this->__queryStatus = $this->AccesslistModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
		if($this->__queryStatus==TRUE){
		 $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
		}else{
		 $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
		}
            redirect('manage/Accesslist/edit/'.$this->__encId.'/');
      }//end validation
	 }//end check post method		
		
	  	$this->front_view('admin/accesslist/edit',$this->data);
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
			redirect('manage/Accesslist');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Accesslist');
		}
		
		$this->__queryStatus = $this->AccesslistModel->deletedata($this->__table,array('id'=>$this->__id));
		
		if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		}
		
		redirect('manage/Accesslist');
		
	}//end delete function
	
}//end Accesslist class