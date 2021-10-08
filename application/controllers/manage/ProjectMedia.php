<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProjectMedia extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = 'comm_project_media';
	private $__proTable = 'comm_project';
	private $__id = NULL;
	private $__encId = NULL;
		private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;

	public function __construct(){
		parent::__construct();
		$this->load->model('manage/ProjectMediaModel');
		$this->load->library('form_validation');
		$this->checkAuthUser();
	}//end constructor

	public function index(){
		addmin_css(array('plugins/data-tables/DT_bootstrap.css','plugins/fancybox/source/jquery.fancybox.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js','plugins/data-tables/DT_bootstrap.js','plugins/fancybox/source/jquery.fancybox.pack.js'));

		$DATA['Result'] = $this->ProjectMediaModel->getAllList($this->__table);

		$this->front_view('admin/projectmedia/index',$DATA);
	}//end show function
	
	public function add(){
		//this function is used for add dynamic css in admin template footer section
        addmin_css(array('plugins/dropzone/css/dropzone.css'));
        add_admin_footer_js(array('plugins/dropzone/dropzone.min.js'));
        $this->data['ProjectList'] = $this->ProjectMediaModel->GenerateDDList($this->__proTable,'id','title_en','',array('status'=>1,'is_delete'=>0));
	    $this->front_view('admin/projectmedia/add');
	}//end index function

	public function insertpic(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
			
		$tempFile = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		$uptype   = $_FILES['file']['type'];
		$upsize   = $_FILES['file']['size'];

		$config = array(
			'upload_path'   => "./uploads/projectmedia/",
			'allowed_types' => "jpg|jpeg|JPG|JPEG|png|pdf|doc|docx|xls|xlsx",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "10485760", // Can be set to particular file size , here it is 10 MB (1024*1024*10)
		);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$this->form_validation->set_rules('project_id', 'Project', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>validation_errors()));
                echo 'error';
					
        }else{

			if($this->upload->do_upload('file')){

				$data = $this->upload->data();
				$FILE_NAME = $data['file_name'];
				$FULL_PATH = $data['full_path'];				
				
				$DATAINPUT = array(
					'id'		  => NULL,
					'project_id'  => (int)cleanQuery(trim($this->input->post('project_id',TRUE))), 
					'attachment'  => $data['file_name'],
					'added_date'  => date('Y-m-d H:i:s'),
					'added_by'    => $UserLogId,
				);

				if($this->ProjectMediaModel->insertdata($this->__table,$DATAINPUT)){	

					echo json_encode(array("link"=>base_url('uploads/projectmedia/').html_escape($data['file_name']),"removelink"=>base_url('manage/projectmedia/delete/'.encrypt_decrypt('encrypt',$this->db->insert_id()))));
				}else{
					echo 'Sorry Please Try again.';
					@unlink("./uploads/projectmedia/".$fileName);
				}
			}else{
				echo $this->upload->display_errors();
			}
	}
      }else{
      	redirect('ProjectMedia/add');
      }//end post method		
      //echo $fileName;
	}//end insertpic function

	public function delete($id=NULL){
			
			$this->__encId = $id;
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);

			 if(!is_numeric($this->__id)){
			 	redirect('manage/ProjectMedia');
			 }

			 if(trim($this->__id)=='' || $this->__id==FALSE){
			 	redirect('manage/ProjectMedia');
			 }

			 $Query = $this->ProjectMediaModel->getSingleList($this->__table,array("id"=>$this->__id));
			 if(count($Query)>0){

			 	$Image = $Query->attachment;

			    $this->__id = array('id'=>$this->__id);				

		        if($this->ProjectMediaModel->deletedata($this->__table,$this->__id)==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
					@unlink("./uploads/projectmedia/".$Image);
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
			 }else{
			 	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			 	redirect('manage/ProjectMedia');
			 }
	       redirect('manage/ProjectMedia');
	}//end delete function


}// end page class
?>