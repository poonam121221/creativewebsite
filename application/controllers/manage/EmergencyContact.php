<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer

class EmergencyContact extends Admin_Controller {
	
	private $__queryStatus = FALSE;
	private $__table = "comm_emergency_contact";
        private $__tableDistrict = "comm_district";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/EmergencyContactModel','EmergencyContact');
		$this->load->library('Ajax_pagination');
        $this->load->config('cms_config');		
		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		$this->perPage = 10;
                $this->__LogedPrivId = (int)encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['USER_UPMID']);
		if(in_array($this->__LogedPrivId,$this->__allowChkStatus)){
			$this->__allowStatus = 1;
		}
	}//end constructor

	public function index(){
             
		$this->data['district']=$this->EmergencyContact->GenerateDDList($this->__tableDistrict,'district_name','district_name',$this->lang->line('all_district'),array('enabled'=>1));
		//print_r( $this->data['searchdistrict']);die;
                $this->front_view('admin/emergency_contact/index',$this->data);
	}//end index function
         public function ajaxPaginationData(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
        $conditions = array();
         $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
        //calc offset number
        $page = (int)$this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search 
        $title  = cleanQuery($this->input->post('sTitle',TRUE));
        $status  = cleanQuery($this->input->post('sStatus',TRUE));
        $district  = cleanQuery($this->input->post('sDistrict',TRUE));
        
        
        if(trim($district)!=""){
            $conditions['search']['district'] = $district;
        }
         if(trim($status)!="" ){
            $conditions['search']['status'] = $status;
        }
        
        $filter  = array('contact_status'=>1);
        $orderBy = array('contact_id'=>'asc');
              
        $conditions['table'] = $this->__table;
        
        //total rows count
        $totalRec = $this->EmergencyContact->get_filtered_data($conditions,$filter,$orderBy);
        
        //pagination configuration
        $config['target']      = '#ajaxdata';
        $config['base_url']    = base_url("manage/EmergencyContact/ajaxPaginationData");
        $config['total_rows']  = $totalRec;
        $config['uri_segment'] = 4;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $this->data['DataList'] = $this->EmergencyContact->make_datatable($conditions,$filter,$orderBy);
        $this->data['PageNo'] = $offset;
        
       //echo "<pre>";       print_r( $this->data['DataList']);die;
        
        //load the view
        $this->load->view('admin/emergency_contact/ajaxpagination', $this->data, false);
        
        }else{
        	show_404();	
		}
    }//ajaxPaginationData
    
    public function add(){
		
	  addmin_css(array('/plugins/bootstrap-datepicker/css/datepicker.css'));
	  add_admin_footer_js(array('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));
        $this->data['district']=$this->EmergencyContact->GenerateDDList($this->__tableDistrict,'district_name','district_name',$this->lang->line('all_district'),array('enabled'=>1));
			
	 $this->load->library(array('form_validation','Ckeditorsetup'));
	 	 
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			
		 $this->form_validation->set_rules('contact_district', 'District', 'required|trim');
		 $this->form_validation->set_rules('contact_designation', 'Designation', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('contact_name', 'Contact Name', 'required|trim|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('contact_office_number', 'Office Number', 'required|trim|max_length[15]|is_natural_no_zero');
		 $this->form_validation->set_rules('contact_mobile_number', 'Mobile Number', 'trim|min_length[10]|is_natural_no_zero');
		 $this->form_validation->set_rules('contact_emailid', 'Email ID', 'trim|required|valid_emails');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }		 
		
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
         }else{
         	    
           $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);	
              
         	    
           $DATAINPUT = array(	
			'contact_district'        => cleanQuery(ucfirst(trim($this->input->post('contact_district',TRUE)))),
			'contact_designation'  => checkaddslashes(trim($this->input->post('contact_designation',FALSE))),
			'contact_name'        => cleanQuery(trim($this->input->post('contact_name',TRUE))),
			'contact_office_number'  => cleanQuery(trim($this->input->post('contact_office_number',FALSE))),
			'contact_mobile_number'      => cleanQuery(trim($this->input->post('contact_mobile_number',FALSE))),
			'contact_fax_number'=> cleanQuery(trim($this->input->post('contact_fax_number',TRUE))),
                        'contact_emailid'=> cleanQuery(trim($this->input->post('contact_emailid',TRUE))),
			'contact_status'     	  => $this->__status,
			'contact_add_date'      => date('Y-m-d h:i:s'),
                        'contact_added_by'        => $UserLogId,
		   );
				
			$this->__queryStatus = $this->EmergencyContact->insertdata($this->__table,$DATAINPUT);
			if($this->__queryStatus==TRUE){
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			}
                
         }//end validation
         
		}//end check post method
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/emergency_contact/add',$this->data);
		
	}//end add function

	public function edit(){
		
		addmin_css(array('/plugins/bootstrap-datepicker/css/datepicker.css'));
	    add_admin_footer_js(array('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));
		$this->data['district']=$this->EmergencyContact->GenerateDDList($this->__tableDistrict,'district_name','district_name',$this->lang->line('all_district'),array('enabled'=>1));
	
		$this->load->library(array('form_validation','Ckeditorsetup'));
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry!'));
			redirect('manage/EmergencyContact/');
		}
		
		if($this->isExists($this->__table,array('contact_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/EmergencyContact/');
		}		
		
		$this->data['DataList'] = $this->EmergencyContact->getSingleList($this->__table,array('contact_id'=>$this->__id));
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
						 	
		 $this->form_validation->set_rules('contact_district', 'District', 'required|trim');
		 $this->form_validation->set_rules('contact_designation', 'Designation', 'required|trim|min_length[2]');
		 $this->form_validation->set_rules('contact_name', 'Contact Name', 'required|trim|min_length[2]|max_length[255]');
		 $this->form_validation->set_rules('contact_office_number', 'Office Number', 'required|trim|max_length[15]|is_natural_no_zero');
		 $this->form_validation->set_rules('contact_mobile_number', 'Mobile Number', 'trim|min_length[10]|is_natural_no_zero');
		 $this->form_validation->set_rules('contact_emailid', 'Email ID', 'trim|required|valid_emails');
		 if($this->__allowStatus==1){
		 	$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');	
		 	$this->__status = (int)cleanQuery($this->input->post('status'));	 
		 }else{
		   	$this->__status = (int)$this->data['DataList']->status;
		 }
		 
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/EmergencyContact/edit/'.$this->__encId.'/');
         }else{
         	
         	$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         	$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         	
         	
         	
         	 $DATAINPUT = array(	
			'contact_district'        => cleanQuery(ucfirst(trim($this->input->post('contact_district',TRUE)))),
			'contact_designation'  => checkaddslashes(trim($this->input->post('contact_designation',FALSE))),
			'contact_name'        => cleanQuery(trim($this->input->post('contact_name',TRUE))),
			'contact_office_number'  => cleanQuery(trim($this->input->post('contact_office_number',FALSE))),
			'contact_mobile_number'      => cleanQuery(trim($this->input->post('contact_mobile_number',FALSE))),
			'contact_fax_number'=> cleanQuery(trim($this->input->post('contact_fax_number',TRUE))),
                        'contact_emailid'=> cleanQuery(trim($this->input->post('contact_emailid',TRUE))),
			'contact_status'     	  => $this->__status,
			'contact_edit_date'      => date('Y-m-d h:i:s'),
                        'contact_edited_by'        => $UserLogId,
		   );
				
		 	$this->__queryStatus = $this->EmergencyContact->updatedata($this->__table,$DATAINPUT,array('contact_id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/EmergencyContact/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
		$this->data['optstatus'] = $this->__allowStatus;
	  	$this->front_view('admin/emergency_contact/edit',$this->data);
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
			redirect('manage/EmergencyContact');
		}
		
		if($this->isExists($this->__table,array('contact_id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry Data not found!'));
			redirect('manage/EmergencyContact');
		}
		
		$DATAINPUT = array('is_delete'=>1,'contact_edited_by'=>$UserLogId,'contact_edit_date'=> date('Y-m-d h:i:s'));
		$this->__queryStatus = $this->EmergencyContact->updatedata($this->__table,$DATAINPUT,array('contact_id'=>$this->__id));
		
		if($this->__queryStatus==TRUE){
			$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'data successfull deleted!'));
		}else{
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry can not be deleted!'));
		}
		
		redirect('manage/EmergencyContact');
		
	}//end delete function
	
}//end class home