<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = 'comm_media';
	private $__id = NULL;
	private $__encId = NULL;

	public function __construct(){
		parent::__construct();
		$this->load->model('manage/MediaModel');
		$this->load->library('form_validation');
		$this->checkAuthUser();
	}//end constructor

	public function index(){
		addmin_css(array('plugins/data-tables/DT_bootstrap.css','plugins/fancybox/source/jquery.fancybox.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js',
		'plugins/data-tables/DT_bootstrap.js','plugins/fancybox/source/jquery.fancybox.pack.js'));
		$DATA['Result'] = $this->MediaModel->getAllList($this->__table);
		$this->front_view('admin/media/index',$DATA);
	}//end show function
	
	public function add(){
		//this function is used for add dynamic css in admin template footer section
        addmin_css(array('plugins/dropzone/css/dropzone.css'));
        add_admin_footer_js(array('plugins/dropzone/dropzone.min.js'));
	    $this->front_view('admin/media/add');
	}//end index function

	public function insertpic(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
			
		$tempFile = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		$uptype   = $_FILES['file']['type'];
		$upsize   = $_FILES['file']['size'];

		$config = array(
			'upload_path'   => "./uploads/media/",
			'allowed_types' => "jpg|jpeg|JPG|JPEG|png|pdf|doc|docx|xls|xlsx|mp4",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "10485760", // Can be set to particular file size , here it is 10 MB (1024*1024*10)
		);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('file')){
			$data = $this->upload->data();
			$FILE_NAME = $data['file_name'];
			$FULL_PATH = $data['full_path'];			
			$DATAINPUT = array(
				'id'		  => NULL,
				'attachment'  => $data['file_name'],
				'added_date'  => date('Y-m-d H:i:s'),
				'added_by'    => $UserLogId,
			);
			if($this->MediaModel->insertdata($this->__table,$DATAINPUT)){				
				echo 'Data Succesfully Updated';
			}else{
				echo 'Sorry Please Try again.';
				@unlink("./uploads/media/".$fileName);
			}
		}else{
			echo $this->upload->display_errors();
		}
      }else{
      	redirect('Media/add');
      }//end post method		
      //echo $fileName;
	}//end insertpic function

	public function delete($id=NULL){			
			$this->__encId = $id;
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
			 if(!is_numeric($this->__id)){
			 	redirect('manage/Media');
			 }
			 if(trim($this->__id)=='' || $this->__id==FALSE){
			 	redirect('manage/Media');
			 }
			 $Query = $this->MediaModel->getSingleList($this->__table,array("id"=>$this->__id));
			 if(count($Query)>0){
			 	$Image = $Query->attachment;
			    $this->__id = array('id'=>$this->__id);
		        if($this->MediaModel->deletedata($this->__table,$this->__id)==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
					@unlink("./uploads/media/".$Image);
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
			 }else{
			 	$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
			 	redirect('manage/Media');
			 }
	       redirect('manage/Media');
	}//end delete function
}// end page class
?>