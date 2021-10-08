<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userprivilege extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "user_previlege_master";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/PrevilegeModel');
	}//end constructor
	
	public function index(){
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$filter= array();
		$this->data['DataList'] = $this->PrevilegeModel->getAllList($this->__table,$filter);
	  	$this->front_view('admin/privilege/index',$this->data);
	  	
	}//end index function
	
	public function add(){
		
		addmin_css(array('plugins/jqtree/jquery.tree.min.css'));
		add_admin_footer_js(array('plugins/jqtree/jquery.tree.min.js'));
		$this->data['menus'] = $this->PrevilegeModel->getAllList('menus',array(),'s_order ASC');
		
		$InjectionError = 0;
		$UpmPrv ="";

		$this->load->library('form_validation');
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			
		 $this->form_validation->set_rules('uname','User Privilege Name', 'trim|required|max_length[50]|is_unique[user_previlege_master.upm_name]');
		 $this->form_validation->set_rules('upm_dese','Privilege Description', 'trim|required|max_length[350]');
		 
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
         }else{
         	
         	if (isset($_POST["ids"]) && count($_POST["ids"]) > 0 ){
		  	    $UpmPrv = implode(",", $_POST["ids"]);
		  	    
		  	    foreach($_POST["ids"] as $key){
					if(!is_numeric($key)){
						$InjectionError++;
					}
				}
				
				if($InjectionError>0){
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry some thing wrong!'));
				    redirect('manage/Userprivilege/');
				}
		  	    
		  	}//check valid id or not 
		  	
		  	    $UpmPrv = (substr($UpmPrv,strlen($UpmPrv)-1,1)==",")? substr($UpmPrv,0,strlen($UpmPrv)-1):$UpmPrv;
		  	    if(trim($UpmPrv)==""){
					$UpmPrv = "1";
				}
         	
         	    $DATAINPUT = array('upm_name' => cleanQuery(trim(ucwords($this->input->post('uname',TRUE)))),
         	    					'upm_description'=>cleanQuery(trim($this->input->post('upm_dese',TRUE))),
         	    					'upm_range'=>$UpmPrv,
         	    					'isdelete'=>0);
				
				$this->__queryStatus = $this->PrevilegeModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         }//end validation
         
		}//end check post method
		
	  	$this->front_view('admin/privilege/add',$this->data);
	}//end add function
	
	public function edit(){
		
		addmin_css(array('plugins/jqtree/jquery.tree.min.css'));
		add_admin_footer_js(array('plugins/jqtree/jquery.tree.min.js'));
		$this->data['menus'] = $this->PrevilegeModel->getAllList('menus',array(),'s_order ASC');
		
		$InjectionError = 0;
		
		$this->load->library('form_validation');
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Userprivilege/');
		}
		
		if($this->isExists($this->__table,array('upm_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Userprivilege/');
		}
		
		$this->data['PrivilegeData'] = $this->PrevilegeModel->getSingleList($this->__table,array('upm_id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			 $this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
			 
			 $this->form_validation->set_rules('uname', 'User Privilege Name', 'trim|required|max_length[50]|check_unique['.$this->__table.'.upm_name.upm_id.'.$this->__id.']');
			 $this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[1]|in_list[0,1]');
			 $this->form_validation->set_rules('upm_dese','Privilege Description', 'trim|required|max_length[350]');
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Userprivilege/edit/'.$this->__encId.'/');
         }else{
         	
         		if (isset($_POST["ids"]) && count($_POST["ids"]) > 0 ){
		  	    $UpmPrv = implode(",", $_POST["ids"]);
		  	    
		  	    foreach($_POST["ids"] as $key){
					if(!is_numeric($key)){
						$InjectionError++;
					}
				}
				
				if($InjectionError>0){
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry some thing wrong!'));
				    redirect('manage/Userprivilege/edit/'.$this->__encId.'/');
				}
		  	    
		  		}

				$UpmPrv = (substr($UpmPrv,strlen($UpmPrv)-1,1)==",")? substr($UpmPrv,0,strlen($UpmPrv)-1):$UpmPrv;
         	    $DATAINPUT = array('upm_name' => cleanQuery(trim(ucwords($this->input->post('uname',TRUE)))),
         	    				   'upm_description'=>cleanQuery(trim($this->input->post('upm_dese',TRUE))),
         	    				   'upm_range'=>$UpmPrv,
         	    				   'isdelete'=>cleanQuery($this->input->post('status')));
				
				$this->__queryStatus = $this->PrevilegeModel->updatedata($this->__table,$DATAINPUT,array('upm_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Userprivilege/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
	  	$this->front_view('admin/privilege/edit',$this->data);
	}//end edit function
	
}//end Dashboard class