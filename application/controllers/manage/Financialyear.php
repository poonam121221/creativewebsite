<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Financialyear extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_financial_year";
	private $__tblProject = "comm_project";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = array();
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/FinancialyearModel');
		
		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus) || in_array($this->__LogedPrivId,array(1,2))){
			$this->__allowStatus = 1;
		}
	}//end constructor
	
	public function index(){

		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		
		$filter = array('um.is_delete'=>0);
		//this is not for super admin and administrator
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$filter['um.added_by'] = $UserLogId; 
		}
		
		$this->data['DataList'] = $this->FinancialyearModel->getAllList($this->__table,$filter);		
	  	$this->front_view('admin/financial_year/index',$this->data);
	  	
	}//end index function
	
	public function add(){
		
		$this->load->library('form_validation');
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		 
		 $this->form_validation->set_rules('financial_year', 'Financial Year', 'trim|required|min_length[2]|max_length[40]|is_unique['.$this->__table.'.financial_year]|regex_match[/^[0-9]{4}-[0-9]{2}$/]',array("regex_match"=>"Please enter financial year in valid format (Ex. 2018-19)"));	
		 if($this->__allowStatus==1){
		 $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
		 $this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }		 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
                redirect('manage/Financialyear/add/');
         }else{
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	    $DATAINPUT = array(
         	    'financial_year'=>cleanQuery(trim($this->input->post('financial_year',TRUE))),
         	    'added_date'   => date('Y-m-d h:i:s'),
         	    'added_by'     => $UserLogId,
         	    'status'   => $this->__status
         	    );
				
				$this->__queryStatus = $this->FinancialyearModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/financial_year/add',$this->data);
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
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Financialyear/');
		}
		
		if($this->isExists($this->__table,array('f_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Financialyear/');
		}
		
		$this->data['DataList'] = $this->FinancialyearModel->getSingleList($this->__table,array('f_id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			 $this->form_validation->set_rules('financial_year', 'Financial Year', 'trim|required|min_length[2]|max_length[40]|check_unique['.$this->__table.'.financial_year.f_id.'.$this->__id.']|regex_match[/^[0-9]{4}-[0-9]{2}$/].")',array("regex_match"=>"Please enter financial year in valid format (Ex. 2018-19)"));
			 if($this->__allowStatus==1){
		 	   $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	   $this->__status = (int)cleanQuery($this->input->post('status'));	 
		     }else{
			   $this->__status = (int)$this->data['DataList']->status;
			 }
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Financialyear/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         	    $DATAINPUT = array(
         	      'financial_year'=>cleanQuery(trim($this->input->post('financial_year',TRUE))),
         	      'status'   => $this->__status,
         	      'edit_date'=> date('Y-m-d h:i:s'),
         	      'edit_by'  => $UserLogId,
         	     );
				
				$this->__queryStatus = $this->FinancialyearModel->updatedata($this->__table,$DATAINPUT,array('f_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submitted'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Financialyear/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/financial_year/edit',$this->data);
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
			redirect('manage/Financialyear/');
		}
		
		if($this->isExists($this->__table,array('f_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Financialyear/');
		}
		
		$data = array('is_delete'=>1,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('f_id'=>$this->__id);
		$count_record = 0;
		
		$count_record = $this->FinancialyearModel->record_count($this->__tblProject,array('project_cat_id'=>$this->__id));
		if($count_record==0){
		  if($this->FinancialyearModel->updatedata($this->__table,$data,$filter)==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully deleted!'));
		  }else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry try again later!'));
		  }
		}else{
		  $this->session->set_flashdata('AppMessage',array('class'=>'info',
		  'message'=>'Sorry you can not be delete this category. Delete first child record from the project table.'));
		}//end check count record
		
		redirect('manage/Financialyear/');
		
	}//end delete function
	
	public function recycle(){

		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
		$filter = array('um.is_delete'=>1);
		$this->data['DataList'] = $this->FinancialyearModel->getAllList($this->__table,$filter);		
	  	$this->front_view('admin/financial_year/recycle',$this->data);
	  	
	}//end recycle function
	
	public function recycle_delete(){
		
		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
		
		$this->load->library('form_validation');
		$count_record = 0;
		$del_no = 0;
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		$del_no = (int)$this->uri->segment(5,0);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/Financialyear/recycle');
		}
		
		if($this->isExists($this->__table,array('f_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/Financialyear/recycle');
		}
		
		$this->form_validation->set_data(array('action_id'=>$del_no));	  	  	
	    $this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
	  	 
	  	if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
            redirect('manage/Financialyear/recycle');
        }else{ 
        
        $data = array('is_delete'=>0,'edit_by'=>$UserLogId,'edit_date'=> date('Y-m-d h:i:s'));
		$filter = array('project_cat_id'=>$this->__id);
		
		 if($del_no==0){
		 	if($this->FinancialyearModel->updatedata($this->__table,$data,$filter)==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success',
				'message'=>'data successfull restore!'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info',
				'message'=>'Sorry can not be restore!'));
			}
		 }else{
		 	
		 	$count_record = $this->FinancialyearModel->record_count($this->__tblProject,$filter);
		 	if($count_record==0){
				if($this->FinancialyearModel->deletedata($this->__table,array('f_id'=>$this->__id))==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success',
					'message'=>'Data successfully deleted!'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'info',
					'message'=>'Sorry can not be deleted!'));
				}
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry you can not be delete this category. Delete first child record from project.'));
			}//end check count record
		 	
		 }//end check delete action id
			
		}//end check validation
		
		redirect('manage/Financialyear/recycle');
	}//end recycle_delete function
	
}//end Financialyear class