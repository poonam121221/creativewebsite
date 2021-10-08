<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class EventMedia extends Admin_Controller
{

	private $__queryStatus = FALSE;
	private $__table = 'comm_events_media';
	private $__proTable = 'comm_events';
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('manage/EventMediaModel');
		$this->load->library('form_validation');
		$this->checkAuthUser();
	} //end constructor

	public function index()
	{
		addmin_css(array('plugins/data-tables/DT_bootstrap.css', 'plugins/fancybox/source/jquery.fancybox.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js', 'plugins/data-tables/DT_bootstrap.js', 'plugins/fancybox/source/jquery.fancybox.pack.js'));

		$DATA['Result'] = $this->EventMediaModel->getAllList($this->__table);

		$this->front_view('admin/eventmedia/index', $DATA);
	} //end show function

	public function add()
	{
		//this function is used for add dynamic css in admin template footer section
		addmin_css(array('plugins/dropzone/css/dropzone.css'));
		add_admin_footer_js(array('plugins/dropzone/dropzone.min.js'));
		$this->data['EventList'] = $this->EventMediaModel->GenerateDDList($this->__proTable, 'id', 'title_en', '--SELECT EVENT--', array('status' => 1, 'is_delete' => 0));
		$this->front_view('admin/eventmedia/add');
	} //end index function

	public function insertpic()
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$UserLogId =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);
			$this->form_validation->set_rules('event_id', 'Event', 'trim|required|is_natural_no_zero');
		 if(isset($_FILES["file"]["name"]) && $_FILES["file"]["name"]==""){
		  	$this->form_validation->set_rules('file', 'Attachment', 'required');
		 }
			if (!isset($_FILES)) {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Please Upload Image'));
				redirect('manage/EventMedia/add');
			} else {
				$tempFile = $_FILES['file']['tmp_name'];
				$fileName = $_FILES['file']['name'];
				$uptype   = $_FILES['file']['type'];
				$upsize   = $_FILES['file']['size'];

				$config = array(
					'upload_path'   => "./uploads/eventmedia/",
					'allowed_types' => "jpg|jpeg|JPG|JPEG|png|pdf|doc|docx|xls|xlsx",
					'remove_spaces' => TRUE,
					'encrypt_name'  => FALSE,
					'overwrite'     => FALSE,
					'max_size'      => "10485760", // Can be set to particular file size , here it is 10 MB (1024*1024*10)
				);

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
			}


			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
			} else {

				if ($this->upload->do_upload('file')) {
					$data = $this->upload->data();
					$FILE_NAME = $data['file_name'];
					$FULL_PATH = $data['full_path'];
					$DATAINPUT = array(
						'id'		  => NULL,
						'event_id'  => (int)cleanQuery(trim($this->input->post('event_id', TRUE))),
						'attachment'  => $data['file_name'],
						'added_date'  => date('Y-m-d H:i:s'),
						'added_by'    => $UserLogId,
					);
					if ($this->EventMediaModel->insertdata($this->__table, $DATAINPUT)) {
						echo json_encode(array("link" => base_url('uploads/eventmedia/') . html_escape($data['file_name']), "removelink" => base_url('manage/eventmedia/delete/' . encrypt_decrypt('encrypt', $this->db->insert_id()))));
					} else {
						echo 'Sorry Please Try again.';
						@unlink("./uploads/eventmedia/" . $fileName);
					}
				} else {
					echo $this->upload->display_errors();
				}
			}
		} else {
		} //end post method		
		//echo $fileName;

		redirect('manage/EventMedia/add');
	} //end insertpic function

	public function delete($id = NULL)
	{

		$this->__encId = $id;
		$this->__id = encrypt_decrypt('decrypt', $this->__encId);

		if (!is_numeric($this->__id)) {
			redirect('manage/EventMedia');
		}

		if (trim($this->__id) == '' || $this->__id == FALSE) {
			redirect('manage/EventMedia');
		}

		$Query = $this->EventMediaModel->getSingleList($this->__table, array("id" => $this->__id));
		if (count($Query) > 0) {

			$Image = $Query->attachment;

			$this->__id = array('id' => $this->__id);

			if ($this->EventMediaModel->deletedata($this->__table, $this->__id) == TRUE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Data successfully submited'));
				@unlink("./uploads/eventmedia/" . $Image);
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
			}
		} else {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
			redirect('manage/EventMedia');
		}
		redirect('manage/EventMedia');
	} //end delete function


}// end page class
