<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Messageboard extends Admin_Controller
{

	private $__queryStatus = FALSE;
	private $__table = "comm_messages";
	private $__id = NULL;
	private $__encId = NULL;
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('manage/MessageboardModel');
		$this->load->config('cms_config');

		$this->__allowChkStatus =  $this->config->item('allow_access_status');

		$this->_config = array(
			'upload_path'   => "./uploads/files/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "2097152", // Can be set to particular file size , here it is 2 MB
		);

		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['USER_UPMID']);
		if (in_array($this->__LogedPrivId, $this->__allowChkStatus)) {
			$this->__allowStatus = 1;
		}
	} //end constructor

	public function index()
	{
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js', 'plugins/data-tables/DT_bootstrap.js'));
		$UserLogId =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);

		//get the posts data
		$filter = array('mb.is_delete' => 0);
		//this is not for super admin and administrator
		if (!in_array($this->__LogedPrivId, $this->__allowChkStatus)) {
			$filter['mb.added_by'] = $UserLogId;
		}

		$this->data['DataList'] = $this->MessageboardModel->getAllList($this->__table, $filter);
		//load the view
		$this->front_view('admin/message_board/index', $this->data);
	} //end index function

	public function add()
	{

		$this->load->library('form_validation');
		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			/****Validation Rules start****/
			$this->form_validation->set_rules('title_hi', 'Name (Hindi)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('title_en', 'Name (English)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('heading_hi', 'Heading (Hindi)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('heading_en', 'Heading (English)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('designation_hi', 'Designation (Hindi)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('designation_en', 'Designation (English)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('message_hi', 'Message (Hindi)', 'trim|min_length[2]|max_length[250]');
			$this->form_validation->set_rules('message_en', 'Message (English)', 'trim|min_length[2]|max_length[250]');
			$this->form_validation->set_rules('flag', 'Flag', 'trim|required|in_list[0,1]');
			if ($this->__allowStatus == 1) {
				$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
				$this->__status = (int)cleanQuery($this->input->post('status'));
			}
			/****Validation Rules End****/

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => validation_errors()));
				redirect('manage/Messageboard/add/');
			} else {

				$UserLogId =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);
				$result =  $this->MessageboardModel->getSingleList($this->__table);

				$attachmentName = $this->_uploadFile();
				$DATAINPUT = array(
					'title_hi'       => cleanQuery(trim($this->input->post('title_hi', TRUE))),
					'title_en' 	     => cleanQuery(trim($this->input->post('title_en', TRUE))),
					'heading_hi'       => cleanQuery(trim($this->input->post('heading_hi', TRUE))),
					'heading_en' 	 => cleanQuery(trim($this->input->post('heading_en', TRUE))),
					'designation_hi' => cleanQuery(trim($this->input->post('designation_hi', TRUE))),
					'designation_en' => cleanQuery(trim($this->input->post('designation_en', TRUE))),
					'message_hi' 	 => cleanQuery(trim($this->input->post('message_hi', TRUE))),
					'message_en' 	 => cleanQuery(trim($this->input->post('message_en', TRUE))),
					'attachment'     => $attachmentName,
					'added_date'     => date('Y-m-d h:i:s'),
					'added_by'       => $UserLogId,
					'status'         => $this->__status,
					'flag'         => (int)cleanQuery(trim($this->input->post('flag', TRUE))),
				);

				$this->__queryStatus = $this->MessageboardModel->insertdata($this->__table, $DATAINPUT);
				if ($this->__queryStatus == TRUE) {
					$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Data successfully submitted'));
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
				}
			} //end validation

		} //end check post method

		$this->data['optstatus'] = $this->__allowStatus;
		$this->front_view('admin/message_board/add', $this->data);
	} //end add function

	public function edit()
	{
		$this->load->library('form_validation');
		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt', $this->__encId);
		if ($this->__id == NULL) {
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt', $this->__encId);
		}
		if (($this->__id == NULL || $this->__id == FALSE ||  $this->__id == "")) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Something went wrong, try again!'));
			redirect('manage/Messageboard/');
		}
		if ($this->isExists($this->__table, array('id' => $this->__id)) == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Record not found!'));
			redirect('manage/Messageboard/');
		}
		$this->data['DataList'] = $this->MessageboardModel->getSingleList($this->__table, array('id' => $this->__id));
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('title_hi', 'Name (Hindi)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('title_en', 'Name (English)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('heading_hi', 'Heading (Hindi)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('heading_en', 'Heading (English)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('designation_hi', 'Designation (Hindi)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('designation_en', 'Designation (English)', 'trim|required|min_length[2]|max_length[100]');
			$this->form_validation->set_rules('message_hi', 'Message (Hindi)', 'trim|min_length[2]|max_length[250]');
			$this->form_validation->set_rules('message_en', 'Message (English)', 'trim|min_length[2]|max_length[250]');
			$this->form_validation->set_rules('flag', 'Flag', 'trim|required|in_list[0,1]');
			if ($this->__allowStatus == 1) {
				$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
				$this->__status = (int)cleanQuery($this->input->post('status'));
			} else {
				$this->__status = (int)$this->data['DataList']->status;
			}
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => validation_errors()));
				redirect('manage/Messageboard/edit/' . $this->__encId . '/');
			} else {
				$UserLogId  =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);
				$this->__id = encrypt_decrypt('decrypt', $this->input->post('id'));
				//This function create bottom of class for upload file
				$attachmentName = $this->_uploadFile($this->data['DataList']->attachment);
				$DATAINPUT = array(
					'title_hi'       => cleanQuery(trim($this->input->post('title_hi', TRUE))),
					'title_en' 	     => cleanQuery(trim($this->input->post('title_en', TRUE))),
					'heading_hi'       => cleanQuery(trim($this->input->post('heading_hi', TRUE))),
					'heading_en' 	 => cleanQuery(trim($this->input->post('heading_en', TRUE))),
					'designation_hi' => cleanQuery(trim($this->input->post('designation_hi', TRUE))),
					'designation_en' => cleanQuery(trim($this->input->post('designation_en', TRUE))),
					'message_hi' 	 => cleanQuery(trim($this->input->post('message_hi', TRUE))),
					'message_en' 	 => cleanQuery(trim($this->input->post('message_en', TRUE))),
					'attachment'     => $attachmentName,
					'status'         => $this->__status,
					'flag'         => (int)cleanQuery(trim($this->input->post('flag', TRUE))),
					'edit_date'      => date('Y-m-d h:i:s'),
					'edit_by'        => $UserLogId
				);

				$this->__queryStatus = $this->MessageboardModel->updatedata($this->__table, $DATAINPUT, array('id' => $this->__id));

				if ($this->__queryStatus == TRUE) {
					$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Data successfully submitted'));
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
				}
				redirect('manage/Messageboard/edit/' . $this->__encId . '/');
			} //end validation
		} //end check post method	

		$this->data['optstatus'] = $this->__allowStatus;
		$this->front_view('admin/message_board/edit', $this->data);
	} //end edit function

	public function delete()
	{
		$UserLogId  =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt', $this->__encId);
		if ($this->__id == NULL) {
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt', $this->__encId);
		}
		if (($this->__id == NULL || $this->__id == FALSE ||  $this->__id == "")) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Something went wrong, try again!'));
			redirect('manage/Messageboard');
		}
		if ($this->isExists($this->__table, array('id' => $this->__id)) == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Data not found!'));
			redirect('manage/Messageboard');
		}
		$DATAINPUT = array('is_delete' => 1, 'edit_by' => $UserLogId, 'edit_date' => date('Y-m-d h:i:s'));
		$this->__queryStatus = $this->MessageboardModel->updatedata($this->__table, $DATAINPUT, array('id' => $this->__id));
		if ($this->__queryStatus == TRUE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Data successfully deleted!'));
		} else {
			$this->session->set_flashdata('AppMessage', array('class' => 'info', 'message' => 'This can not be deleted!'));
		}
		redirect('manage/Messageboard');
	} //end delete function

	public function updatesrtorder()
	{
		$this->load->library('form_validation');
		$update_id = $this->uri->segment(5, NULL);
		$update_order = $this->uri->segment(7, 0);
		if (!is_null($update_id)) {
			$update_id = encrypt_decrypt('decrypt', $update_id);
		}
		$this->form_validation->set_data(array(
			'order_id'     =>  $update_id,
			'order_number' => $update_order,
		));
		$this->form_validation->set_rules('order_id', 'Order Id', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('order_number', 'Order Number', 'trim|required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => validation_errors()));
		} else {
			$this->__queryStatus = $this->MessageboardModel->update_sort_order($update_id, $update_order, $this->__table);
		} //end check validation		 
		if ($this->__queryStatus == TRUE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'order successfull updated!'));
		} else {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry try again later !'));
		}
		redirect('manage/Messageboard/');
	} //end updatesrtorder function

	protected function _uploadFile($preUploadedFile = "")
	{
		$this->load->library('upload', $this->_config);
		$this->upload->initialize($this->_config);
		$FILE_NAME = "";
		$FULL_PATH = "";

		if (isset($_FILES['attachment']['name']) == TRUE && trim($_FILES['attachment']['name']) != "") {

			if ($this->upload->do_upload('attachment')) {
				$data = $this->upload->data();
				$FILE_NAME = $data['file_name'];
				$FULL_PATH = $data['full_path'];
				if (trim($preUploadedFile) != "" && trim($preUploadedFile) != NULL) {
					@unlink("./uploads/files/" . trim($preUploadedFile));
				}
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => $this->upload->display_errors()));
			}
		} else {
			$FILE_NAME = $preUploadedFile;
		}
		return $FILE_NAME;
	} //end uploadFile function

	public function recycle()
	{
		addmin_css(array('plugins/data-tables/DT_bootstrap.css'));
		add_admin_footer_js(array('plugins/data-tables/jquery.dataTables.min.js', 'plugins/data-tables/DT_bootstrap.js'));
		$filter = array('mb.is_delete' => 1);
		$this->data['DataList'] = $this->MessageboardModel->getAllList($this->__table, $filter);
		$this->front_view('admin/message_board/recycle', $this->data);
	} //end recycle function

	public function recycle_delete()
	{
		$this->load->library('form_validation');
		$del_no = 0;
		$UserLogId  =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt', $this->__encId);
		$del_no = (int)$this->uri->segment(5, 0);
		if ($this->__id == NULL) {
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt', $this->__encId);
		}
		if (($this->__id == NULL || $this->__id == FALSE ||  $this->__id == "")) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Something went wrong, try again!'));
			redirect('manage/Messageboard/recycle');
		}
		if ($this->isExists($this->__table, array('id' => $this->__id)) == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Data not found!'));
			redirect('manage/Messageboard/recycle');
		}
		$this->form_validation->set_data(array('action_id' => $del_no));
		$this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => validation_errors()));
			redirect('manage/Messageboard/recycle');
		} else {
			$data = array('is_delete' => 0, 'edit_by' => $UserLogId, 'edit_date' => date('Y-m-d h:i:s'));
			$filter = array('id' => $this->__id);
			if ($del_no == 0) {
				if ($this->MessageboardModel->updatedata($this->__table, $data, $filter) == TRUE) {
					$this->session->set_flashdata('AppMessage', array(
						'class' => 'success',
						'message' => 'Data successfully restored!'
					));
				} else {
					$this->session->set_flashdata('AppMessage', array(
						'class' => 'info',
						'message' => 'This can not be restored!'
					));
				}
			} else {
				$Query = $this->MessageboardModel->getSingleList($this->__table, $filter);
				if ($this->MessageboardModel->deletedata($this->__table, $filter) == TRUE) {
					$Image = $Query->attachment;
					if (trim($Image) != '') {
						if (is_file('./uploads/files/' . $Image)) {
							unlink('./uploads/files/' . $Image);
						} else {
							$this->session->set_flashdata('AppMessage', array(
								'class' => 'warning',
								'message' => 'File does not exist!'
							));
						}
					}
					$this->session->set_flashdata('AppMessage', array(
						'class' => 'success',
						'message' => 'Data successfully deleted!'
					));
				} else {
					$this->session->set_flashdata('AppMessage', array(
						'class' => 'info',
						'message' => 'This can not be deleted!'
					));
				}
			} //end check delete action id
		} //end check validation
		redirect('manage/Messageboard/recycle');
	} //end recycle_delete

}//end Messageboard class