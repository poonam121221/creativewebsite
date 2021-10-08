<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menumodule extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_menu_modules";
	private $__id = NULL;
	private $__encId = NULL;
	protected $_config = array();
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/MenumoduleModel');
	}//end constructor
	
	public function index(){  
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
        //get the posts data
        $this->data['DataList'] = $this->MenumoduleModel->getAllList($this->__table);        
        //load the view
        $this->front_view('admin/menumodule/index',$this->data);	  	
	}//end index function
	
	public function add(){
		
		$this->load->library('form_validation');
				
		if ($this->input->server('REQUEST_METHOD') === 'POST') { 		 
		 /****Validation Rules start****/	
			 $this->form_validation->set_rules('module_name', 'Module Name', 'trim|required|min_length[2]|max_length[255]');		 
			 $this->form_validation->set_rules('module_url', 'URL', 'trim|required|valid_url|max_length[100]');
			 /****Validation Rules End****/	 		
			if ($this->form_validation->run() == FALSE) {
	                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
	                redirect('manage/Menumodule/add/');
	        } else {				
	         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);         		
	         	    $DATAINPUT = array(
	         	    	'module_name'  => checkaddslashes(trim($this->input->post('module_name',TRUE))),  	    	
	         	    	'module_url'   => cleanQuery(trim($this->input->post('module_url',TRUE))),  	    	
	         	    	'added_date'   => date('Y-m-d h:i:s'),
	         	    	'added_by'     => $UserLogId,
	         	    	);
	         	    					
					$this->__queryStatus = $this->MenumoduleModel->insertdata($this->__table,$DATAINPUT);
					if($this->__queryStatus==TRUE){
						$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
					}else{
						$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
					}
	                
	        }//end validation
         
		}//end check post method
		
	  	$this->front_view('admin/menumodule/add',$this->data);
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
			redirect('manage/Menumodule/');
		}
		
		if($this->isExists($this->__table,array('module_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Menumodule/');
		}
		
		$this->data['DataList'] = $this->MenumoduleModel->getSingleList($this->__table,array('module_id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			 $this->form_validation->set_rules('module_name', 'Module Name', 'trim|required|min_length[2]|max_length[255]');
			 $this->form_validation->set_rules('module_url', 'Module Url', 'trim|required|max_length[100]');
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Menumodule/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		
         	    $DATAINPUT = array(
	         	    	'module_name'  => checkaddslashes(trim($this->input->post('module_name',TRUE))),   
	         	    	'module_url'   => cleanQuery(trim($this->input->post('module_url',TRUE))), 
         	    		'edit_date'    => date('Y-m-d h:i:s'),
         	    		'edit_by'      => $UserLogId
         	    		);
				
				$this->__queryStatus = $this->MenumoduleModel->updatedata($this->__table,$DATAINPUT,array('module_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Menumodule/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
	  	$this->front_view('admin/menumodule/edit',$this->data);
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
			redirect('manage/Menumodule/');
		}
		
		if($this->isExists($this->__table,array('module_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Menumodule/');
		}

		$this->__queryStatus = $this->MenumoduleModel->deletedata($this->__table,array('module_id'=>$this->__id));
		
		if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Record can not be deleted, try again!'));
		}
		
		redirect('manage/Menumodule/');
		
	}//end delete function
	
}//end Dashboard class