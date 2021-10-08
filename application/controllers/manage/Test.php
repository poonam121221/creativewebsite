Test<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends Admin_Controller{
    
    private $__queryStatus = FALSE;
    private $__table = "comm_settings";
    private $__id = NULL;
    private $__encId = NULL;
    
    public function __construct(){

        parent::__construct();
        $this->load->model('manage/SettingsModel');
    }//end constructor
    
    public function index(){
        addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
        add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js'));
        $this->data['DataList'] = $this->SettingsModel->getAllList($this->__table);     
        $this->front_view('admin/settings/index',$this->data);
        
    }//end index function
    
    public function add(){
        
        addmin_css(array('/plugins/bootstrap-datepicker/css/datepicker.css'));
        add_admin_footer_js('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');
        
        $this->load->library('form_validation');
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
        
        $countRec  = $this->SettingsModel->record_count($this->__table);
        if($countRec!=0){
            $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record allready exist. You can only update this record.'));
            redirect('manage/Settings/');
        }
         
         $this->form_validation->set_rules('last_updated_on', 'Last Updated On', 'trim|required|check_date');        
        
         if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Settings/add/');
         }else{
                $UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
                $DATAINPUT = array(
                    'last_updated_on' => date_convert(trim($this->input->post('last_updated_on',TRUE))),            
                    'edit_date'   => date('Y-m-d h:i:s'),
                    'edit_by'     => $UserLogId,
                    );
                
                $this->__queryStatus = $this->SettingsModel->insertdata($this->__table,$DATAINPUT);
                if($this->__queryStatus==TRUE){
                    $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
                }else{
                    $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
                }
                
         }//end validation
         
        }//end check post method
        
        $this->front_view('admin/settings/add',$this->data);
    }//end add function
    
    public function edit(){
        
        addmin_css(array('/plugins/bootstrap-datepicker/css/datepicker.css'));
        add_admin_footer_js('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');
        
        $this->load->library('form_validation');
        
        $this->__encId = $this->uri->segment(4, NULL);
        $this->__id = encrypt_decrypt('decrypt',$this->__encId);
        
        if($this->__id==NULL){
            $this->__encId = $this->input->post('id');
            $this->__id = encrypt_decrypt('decrypt',$this->__encId);
        }
        
        if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
            $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
            redirect('manage/Settings/');
        }
        
        if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
            $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
            redirect('manage/Settings/');
        }
        
        $this->data['DataList'] = $this->SettingsModel->getSingleList($this->__table,array('id'=>$this->__id));
        
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            
        $this->form_validation->set_rules('last_updated_on', 'Last Updated On', 'trim|required|check_date');
            
        if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Settings/edit/'.$this->__encId.'/');
        }else{
                $UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
                $this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
                $DATAINPUT = array(
                        'last_updated_on' =>date_convert(trim($this->input->post('last_updated_on',TRUE))),
                        'edit_date'    => date('Y-m-d h:i:s'),
                        'edit_by'      => $UserLogId,
                        );
                $ACTIVITY_MSG = "Update website setting";
                
                $this->__queryStatus = $this->SettingsModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id),$ACTIVITY_MSG);
                
                if($this->__queryStatus==TRUE){
                    $this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
                }else{
                    $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
                }
                redirect('manage/Settings/edit/'.$this->__encId.'/');
        }//end validation
        }//end check post method        
        
        $this->front_view('admin/settings/edit',$this->data);
    }//end edit function
        
        public function remove(){
            
            $this->data['DataList'] = glob("./uploads/*");
                if ($this->input->server('REQUEST_METHOD') === 'POST'){
                    $str = $this->input->post('path',TRUE);
                    $str = $this->data['DataList'][$str];
                    $this->deleteAll($str);
                }
            $this->front_view('admin/settings/clear',$this->data);
        }
        private function deleteAll($str) {
            //It it's a file.
            if (is_file($str)) {
                //Attempt to delete it.
                return unlink($str);
            }
            //If it's a directory.
            elseif (is_dir($str)) {
                //Get a list of the files in this directory.
                $scan = glob(rtrim($str,'/').'/*');
                //Loop through the list of files.
                //echo "<pre>";                print_r($scan);die;
                foreach($scan as $index=>$path) {
                    //Call our recursive function.
                    $this->deleteAll($path);
                }
                //Remove the directory itself.
                //return @rmdir($str);
            }
        }
    
}//end Dashboard class