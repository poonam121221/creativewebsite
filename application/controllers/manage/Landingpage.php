<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landingpage extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_landing_page";
	private $__id = NULL;
	private $__encId = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/LandingpageModel');
	}//end constructor
	
	public function index(){

		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$this->data['DataList'] = $this->LandingpageModel->getAllList($this->__table);		
	  	$this->front_view('admin/landing_page/index',$this->data);
	  	
	}//end index function
	
	public function add(){
				
		$this->load->library(array('form_validation','Ckeditorsetup'));
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		
		$countRec  = $this->LandingpageModel->record_count($this->__table);
		if($countRec!=0){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record allready exist. You can only update this record.'));
			redirect('manage/Landingpage/');
		}
		 
		 $this->form_validation->set_rules('title_hi', 'Title Hindi', 'required|trim|min_length[2]|max_length[50]|is_unique['.$this->__table.'.title_hi]',array('is_unique'=>'%s is all ready exist, may be the entry code is deleted.'));
		 $this->form_validation->set_rules('description_hi', 'Description Hindi', 'required|trim|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('title_en', 'Title English', 'required|trim|min_length[2]|max_length[50]|is_unique['.$this->__table.'.title_en]',array('is_unique'=>'%s is all ready exist, may be the entry code is deleted.'));
		 $this->form_validation->set_rules('description_en', 'Description English', 'required|trim|min_length[2]|max_length[255]');	 
		 $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');		 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Landingpage/add/');
         }else{
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	    $DATAINPUT = array(
         	    	'title_hi'        => cleanQuery(trim($this->input->post('title_hi',TRUE))),
					'description_hi'  => checkaddslashes(trim($this->input->post('description_hi',FALSE))),
					'title_en'        => cleanQuery(trim($this->input->post('title_en',TRUE))),
					'description_en'  => checkaddslashes(trim($this->input->post('description_en',FALSE))),    	
         	    	'added_date'      => date('Y-m-d h:i:s'),
         	    	'added_by'        => $UserLogId,
         	    	'status'          => (int)cleanQuery($this->input->post('status',TRUE)), 
         	    	);
				
				$this->__queryStatus = $this->LandingpageModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         }//end validation
         
		}//end check post method
		
	  	$this->front_view('admin/landing_page/add',$this->data);
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
			redirect('manage/Landingpage/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Landingpage/');
		}
		
		$this->data['DataList'] = $this->LandingpageModel->getSingleList($this->__table,array('id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
		  $this->form_validation->set_rules('title_hi', 'Title Hindi', 'required|trim|min_length[2]|max_length[255]|check_unique['.$this->__table.'.title_hi.id.'.$this->__id.']');
		 $this->form_validation->set_rules('description_hi', 'Description Hindi', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('title_en', 'Title English', 'required|trim|min_length[2]|max_length[255]|check_unique['.$this->__table.'.title_en.id.'.$this->__id.']');
		 $this->form_validation->set_rules('description_en', 'Description English', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Landingpage/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         	    $DATAINPUT = array(
         	    		'title_hi'        => cleanQuery(trim($this->input->post('title_hi',TRUE))),
						'description_hi'  => checkaddslashes(trim($this->input->post('description_hi',FALSE))),
						'title_en'        => cleanQuery(trim($this->input->post('title_en',TRUE))),
						'description_en'  => checkaddslashes(trim($this->input->post('description_en',FALSE))),
         	    		'status'          => (int)cleanQuery($this->input->post('status',TRUE)),
         	    		'edit_date'       => date('Y-m-d h:i:s'),
         	    		'edit_by'         => $UserLogId
         	    		);
				$ACTIVITY_MSG = "Update Landing Page";
				
				$this->__queryStatus = $this->LandingpageModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id),$ACTIVITY_MSG);
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Landingpage/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
	  	$this->front_view('admin/landing_page/edit',$this->data);
	}//end edit function
	
}//end Dashboard class