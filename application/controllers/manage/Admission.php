<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admission extends Admin_Controller
{

	private $__queryStatus = FALSE;
	private $__table = "comm_users";
	private $__cattTbl = "comm_user_detail";
	private $__id = NULL;
	private $__encId = NULL;
	protected $_config = array();
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;
	private $__currentUrl = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('manage/AdmissionModel', 'user/UserModel'));
		$this->load->library('Ajax_pagination');
		$this->load->config('cms_config');

		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		$this->perPage = 10;

		$this->_config = array(
			'upload_path'   => "./uploads/files/",
			'allowed_types' => "PDF|pdf|jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "26214400", // Can be set to particular file size , here it is 25 MB( 1024*1024*25 )
		);

		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['USER_UPMID']);
		if (in_array($this->__LogedPrivId, $this->__allowChkStatus)) {
			$this->__allowStatus = 1;
		}
	} //end constructor

	public function index()
	{
		//load the view
		addmin_css(array('plugins/select2/select2.css', 'plugins/select2/select2-bootstrap.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js'));

		//$this->data['CategoryList'] = $this->AdmissionModel->GenerateDDList($this->__cattTbl,'cat_id','cat_title_en','--SELECT CATEGORY--',array('cat_status'=>1));
		$this->front_view('admin/admission/index', $this->data);
	} //end index function

	public function updatestatus()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->__id =  $this->input->post('id');
			$DATAINPUT = array('application_status' => 1);
			$id = encrypt_decrypt('encrypt', $this->__id);

			$this->__queryStatus = $this->AdmissionModel->updatedata($this->__table, $DATAINPUT, array('user_id' => $this->__id));
			//Email Configuration
			$emailMessage = "<h4>Approved!</h4> ";
			$emailMessage .= '<p>Your Application has been approved.</p>';
			$emailMessage .= '<p></p>';
			$emailMessage .= '<p><b>Regards,</b></p>';
			$emailMessage .= '<p>Admin Epco</p>';

			$EmailDetails = array(
				'email_to' => cleanQuery(trim($this->input->post('email', TRUE))),
				'subject' => 'Response Admission Registration',
				'message' => $emailMessage,
				'email_from' => 'Epco'
			);

			$msg = "";
			if ($this->__queryStatus == TRUE) {
				$getEmailInfo = $this->sendEmail($EmailDetails); //core/MY_Controller/Email Function
				if ($getEmailInfo['status'] != TRUE) {
					$msg .= " and " . $getEmailInfo['message'];
				}
				$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Approve request save successfully' . $msg));
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
			}

			redirect('manage/Admission/view/' .	$id . '/');
		}
	}
	public function updaterejstatus()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->__id =  $this->input->post('id');
			$reject_region = $this->input->post('reject_region');
			$DATAINPUT = array('application_status' => 2, 'reject_region' => $reject_region);
			$this->__queryStatus = $this->AdmissionModel->updatedata($this->__table, $DATAINPUT, array('user_id' => $this->__id));
			$id = encrypt_decrypt('encrypt', $this->__id);
			$emailMessage = "<h4>Rejected!</h4> ";
			$emailMessage .= '<p>Your Application has been Rejected.</p>';
			$emailMessage .= '<p>' . $reject_region . '</p>';
			$emailMessage .= '<p><b>Regards,</b></p>';
			$emailMessage .= '<p>Admin Epco</p>';

			$EmailDetails = array(
				'email_to' => cleanQuery(trim($this->input->post('email', TRUE))),
				'subject' => 'Response Admission Registration',
				'message' => $emailMessage,
				'email_from' => 'Epco'
			);

			$msg = "";
			if ($this->__queryStatus == TRUE) {
				$getEmailInfo = $this->sendEmail($EmailDetails); //core/MY_Controller/Email Function
				if ($getEmailInfo['status'] != TRUE) {
					$msg .= " and " . $getEmailInfo['message'];
				}
				$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Rejected successfully' . $msg));
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
			}


			redirect('manage/Admission/view/' .	$id . '/');
		}
	}

	public function ajaxPaginationData()
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$conditions = array();
			$UserLogId =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);

			//calc offset number
			$page = $this->input->post('page');
			if (!$page) {
				$offset = 0;
			} else {
				$offset = $page;
			}
			//set conditions for search
			$title  = $this->input->post('sTitle', TRUE);
			if (trim($title) != "") {
				$conditions['search']['title'] = $title;
			}
			$filter = array('um.user_step' => 1);
			//  $filter = array();
			//this is not for super admin and administrator
			if (!in_array($this->__LogedPrivId, $this->__allowChkStatus)) {
				$filter['um.added_by'] = $UserLogId;
			}
			/* if($cat_id!=0 && is_numeric($cat_id)){
            $filter['um.cat_id'] = $cat_id;
        } */
			//$orderBy = array('um.order_preference'=>'asc');
			$orderBy = array();
			$conditions['table'] = $this->__table;
			//total rows count 
			$totalRec = $this->AdmissionModel->get_filtered_data($conditions, $filter);
			//pagination configuration
			$config['target']      = '#ajaxdata';
			$config['base_url']    = base_url() . "manage/Admission/ajaxPaginationData";
			$config['total_rows']  = $totalRec;
			$config['uri_segment'] = 4;
			$config['per_page']    = $this->perPage;
			$config['link_func']   = 'searchFilter';
			$this->ajax_pagination->initialize($config);
			//set start and limit
			$conditions['start'] = $offset;
			$conditions['limit'] = $this->perPage;
			//get posts data
			$this->data['DataList'] = $this->AdmissionModel->make_datatable($conditions, $filter, $orderBy);
			$this->data['PageNo'] = $offset;
			//load the view
			$this->load->view('admin/admission/ajaxpaginationadmission', $this->data, false);
		} else {
			show_404();
		}
	} //ajaxPaginationData

	public function add()
	{
		$this->load->library('form_validation');
		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));

		addmin_css(array('plugins/select2/select2.css', 'plugins/select2/select2-bootstrap.css', '/plugins/bootstrap-datepicker/css/datepicker.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js', '/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));

		$this->data['CategoryList'] = $this->AdmissionModel->GenerateDDList($this->__cattTbl, 'cat_id', 'cat_title_en', '--SELECT CATEGORY--', array('cat_status' => 1));

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			/****Validation Rules start****/
			$this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');
			$this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
			$this->form_validation->set_rules('category', 'Category', 'trim|is_natural_no_zero');
			$this->form_validation->set_rules('archive_date', 'Archive Date', 'required|trim|check_date');
			$this->form_validation->set_rules('is_alert', 'Is Alert', 'trim|required|in_list[0,1]');
			if ($this->__allowStatus == 1) {
				$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
				$this->__status = (int)cleanQuery($this->input->post('status'));
			}

			if (empty($_FILES['attachment']['name'])) {
				$this->form_validation->set_rules('attachment', 'Attachment', 'required');
			}
			/****Validation Rules End****/

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => validation_errors()));
				redirect('manage/Admission/add/');
			} else {

				$s_order = (int)$this->AdmissionModel->getmax($this->__table, 'order_preference');
				$UserLogId =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);

				$this->__currentUrl = current_url();
				$attachmentName = $this->_uploadFile();
				$DATAINPUT = array(
					'cat_id' 	   => (int)cleanQuery(trim($this->input->post('category', TRUE))),
					'title_hi'     => cleanQuery(trim($this->input->post('title_hi', TRUE))),
					'title_en' 	   => cleanQuery(trim($this->input->post('title_en', TRUE))),
					'attachment'   => $attachmentName,
					'archive_exp_date' => date_convert(trim($this->input->post('archive_date', TRUE))),
					'added_date'   => date('Y-m-d h:i:s'),
					'added_by'     => $UserLogId,
					'is_alert'        => (int)cleanQuery(trim($this->input->post('is_alert', TRUE))),
					'status'       => $this->__status,
					'order_preference' => $s_order + 1
				);

				$this->__queryStatus = $this->AdmissionModel->insertdata($this->__table, $DATAINPUT);
				if ($this->__queryStatus == TRUE) {
					$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Data successfully submitted'));
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
				}
			} //end validation

		} //end check post method

		$this->data['optstatus'] = $this->__allowStatus;
		$this->front_view('admin/admission/add', $this->data);
	} //end add function

	public function edit()
	{

		$this->load->library('form_validation');
		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));

		addmin_css(array('plugins/select2/select2.css', 'plugins/select2/select2-bootstrap.css', '/plugins/bootstrap-datepicker/css/datepicker.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js', '/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));

		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt', $this->__encId);

		if ($this->__id == NULL) {
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt', $this->__encId);
		}

		if (($this->__id == NULL || $this->__id == FALSE ||  $this->__id == "")) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry!'));
			redirect('manage/Admission/');
		}

		if ($this->isExists($this->__table, array('id' => $this->__id)) == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry Data not found!'));
			redirect('manage/Admission/');
		}

		$this->data['DataList'] = $this->AdmissionModel->getSingleList($this->__table, array('id' => $this->__id));
		$this->data['CategoryList'] = $this->AdmissionModel->GenerateDDList($this->__cattTbl, 'cat_id', 'cat_title_en', '--SELECT CATEGORY--', array('cat_status' => 1));

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$this->form_validation->set_rules('category', 'Category', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('title_hi', 'Title (Hindi)', 'trim|required|min_length[2]|max_length[255]');
			$this->form_validation->set_rules('title_en', 'Title (English)', 'trim|required|min_length[2]|max_length[255]');
			$this->form_validation->set_rules('archive_date', 'Archive Date', 'required|trim|check_date');
			$this->form_validation->set_rules('is_alert', 'Is Alert', 'trim|required|in_list[0,1]');
			if ($this->__allowStatus == 1) {
				$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]');
				$this->__status = (int)cleanQuery($this->input->post('status'));
			} else {
				$this->__status = (int)$this->data['DataList']->status;
			}

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => validation_errors()));
				redirect('manage/Admission/edit/' . $this->__encId . '/');
			} else {
				$UserLogId  =  encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['SERIALNO']);
				$this->__id = encrypt_decrypt('decrypt', $this->input->post('id'));

				//This function create bottom of class for upload file
				$this->__currentUrl = 'manage/Hospital/edit/' . $this->__encId . '/';
				$attachmentName = $this->_uploadFile($this->data['DataList']->attachment);
				$DATAINPUT = array(
					'cat_id' 	   => (int)cleanQuery(trim($this->input->post('category', TRUE))),
					'title_hi'     => cleanQuery(trim($this->input->post('title_hi', TRUE))),
					'title_en' 	   => cleanQuery(trim($this->input->post('title_en', TRUE))),
					'attachment'   => $attachmentName,
					'archive_exp_date' => date_convert(trim($this->input->post('archive_date', TRUE))),
					'status'       => $this->__status,
					'is_alert'     => (int)cleanQuery(trim($this->input->post('is_alert', TRUE))),
					'edit_date'    => date('Y-m-d h:i:s'),
					'edit_by'      => $UserLogId
				);

				$this->__queryStatus = $this->AdmissionModel->updatedata($this->__table, $DATAINPUT, array('id' => $this->__id));

				if ($this->__queryStatus == TRUE) {
					$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Data successfully submitted'));
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
				}
				redirect('manage/Admission/edit/' . $this->__encId . '/');
			} //end validation
		} //end check post method		

		$this->data['optstatus'] = $this->__allowStatus;
		$this->front_view('admin/admission/edit', $this->data);
	} //end edit function

	public function view()
	{


		addmin_css(array('plugins/bootstrap-fileinput/bootstrap-fileinput.css'));

		addmin_css(array('plugins/select2/select2.css', 'plugins/select2/select2-bootstrap.css', '/plugins/bootstrap-datepicker/css/datepicker.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js', '/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'));

		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt', $this->__encId);

		if ($this->__id == NULL) {
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt', $this->__encId);
		}

		if (($this->__id == NULL || $this->__id == FALSE ||  $this->__id == "")) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry!'));
			redirect('manage/Admission/');
		}

		if ($this->isExists($this->__table, array('user_id' => $this->__id)) == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry Data not found!'));
			redirect('manage/Admission/');
		}

		$this->data['DataList'] = $this->AdmissionModel->getSingleList($this->__table, array('user_id' => $this->__id));

		$filter = array('um.user_id' =>	$this->__id);

		$this->data['userDataList'] = $this->UserModel->getSingleList($filter);
		$this->data['DistrictList'] = $this->UserModel->GenerateDDList('comm_district', 'DistrictCensusCode', 'district_name', '--SELECT DISTRICT--', array('enabled' => 1));
		if ($this->data['userDataList']->user_step == 0) {
			$this->front_view('user/login/register_complete', $this->data);
		} else {
			$this->data['userInfo'] = $this->UserModel->getAllUserInfo($this->__table, $filter);

			//echo"<pre>";print_r($this->data['userInfo'] );exit;	
			$user_id_wise_qual_info = $this->data['userInfo']->user_id;
			if (!empty($this->data['userInfo'])) {
				$this->data['userQualificationInfo'] = $this->UserModel->getUserQualificationInfo('user_qualification', array('fk_user_id' => $user_id_wise_qual_info));
			}
			$this->front_view('admin/admission/view', $this->data);
		}
	}

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
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry!'));
			redirect('manage/Admission');
		}

		if ($this->isExists($this->__table, array('id' => $this->__id)) == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry Data not found!'));
			redirect('manage/Admission');
		}

		$DATAINPUT = array('is_delete' => 1, 'edit_by' => $UserLogId, 'edit_date' => date('Y-m-d h:i:s'));
		$this->__queryStatus = $this->AdmissionModel->updatedata($this->__table, $DATAINPUT, array('id' => $this->__id));

		if ($this->__queryStatus == TRUE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'data successfull deleted!'));
		} else {
			$this->session->set_flashdata('AppMessage', array('class' => 'info', 'message' => 'Sorry can not be deleted!'));
		}

		redirect('manage/Admission');
	} //end delete function

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
				redirect($this->__currentUrl);
			}
		} else {
			$FILE_NAME = $preUploadedFile;
		}

		return $FILE_NAME;
	} //end uploadFile function

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
			$this->__queryStatus = $this->AdmissionModel->update_sort_order($update_id, $update_order, $this->__table);
		} //end check validation

		if ($this->__queryStatus == TRUE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'order successfull updated!'));
		} else {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry try again later !'));
		}

		redirect('manage/Admission');
	} //end updatesrtorder function

	public function recycle()
	{
		//load the view
		$this->front_view('admin/admission/recycle', $this->data);
	} //end index function

	public function ajaxPaginationRecycle()
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$conditions = array();

			//calc offset number
			$page = $this->input->post('page');
			if (!$page) {
				$offset = 0;
			} else {
				$offset = $page;
			}

			//set conditions for search
			$title  = $this->input->post('sTitle', TRUE);
			$status = $this->input->post('sStatus', TRUE);
			$sortBy = $this->input->post('sortBy', TRUE);

			if (trim($title) != "") {
				$conditions['search']['title'] = $title;
			}
			if (trim($status) != "") {
				$conditions['search']['status'] = (int)$status;
			}

			if (!empty($sortBy)) {
				$conditions['search']['sortBy'] = $sortBy;
			}

			$filter = array('um.is_delete' => 1);
			$orderBy = array('um.order_preference' => 'asc');
			$conditions['table'] = $this->__table;

			//total rows count
			$totalRec = count($this->AdmissionModel->getRows($conditions, $filter));

			//pagination configuration
			$config['target']      = '#ajaxdata';
			$config['base_url']    = base_url() . "manage/Admission/ajaxPaginationRecycle";
			$config['total_rows']  = $totalRec;
			$config['uri_segment'] = 4;
			$config['per_page']    = $this->perPage;
			$config['link_func']   = 'searchFilter';
			$this->ajax_pagination->initialize($config);

			//set start and limit
			$conditions['start'] = $offset;
			$conditions['limit'] = $this->perPage;

			//get posts data
			$this->data['DataList'] = $this->AdmissionModel->getRows($conditions, $filter, $orderBy);
			$this->data['PageNo'] = $offset;

			//load the view
			$this->load->view('admin/admission/ajaxpaginationAdmissionRecycle', $this->data, false);
		} else {
			show_404();
		}
	} //ajaxPaginationRecycle

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
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry!'));
			redirect('manage/Admission/recycle');
		}

		if ($this->isExists($this->__table, array('id' => $this->__id)) == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry Data not found!'));
			redirect('manage/Admission/recycle');
		}

		$this->form_validation->set_data(array('action_id' => $del_no));
		$this->form_validation->set_rules('action_id', 'Action Id', 'trim|required|in_list[0,1]');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => validation_errors()));
			redirect('manage/Admission/recycle');
		} else {

			$data = array('is_delete' => 0, 'edit_by' => $UserLogId, 'edit_date' => date('Y-m-d h:i:s'));
			$filter = array('id' => $this->__id);

			if ($del_no == 0) {
				if ($this->AdmissionModel->updatedata($this->__table, $data, $filter) == TRUE) {
					$this->session->set_flashdata('AppMessage', array(
						'class' => 'success',
						'message' => 'data successfull restore!'
					));
				} else {
					$this->session->set_flashdata('AppMessage', array(
						'class' => 'info',
						'message' => 'Sorry can not be restore!'
					));
				}
			} else {

				$Query = $this->AdmissionModel->getSingleList($this->__table, $filter);

				if ($this->AdmissionModel->deletedata($this->__table, $filter) == TRUE) {

					$Image = $Query->attachment;
					if (trim($Image) != '') {
						if (is_file('./uploads/files/' . $Image)) {
							unlink('./uploads/files/' . $Image);
						} else {
							$this->session->set_flashdata('AppMessage', array(
								'class' => 'warning',
								'message' => 'Sorry File does not exist!'
							));
						}
					}

					$this->session->set_flashdata('AppMessage', array(
						'class' => 'success',
						'message' => 'data successfull deleted!'
					));
				} else {
					$this->session->set_flashdata('AppMessage', array(
						'class' => 'info',
						'message' => 'Sorry can not be deleted!'
					));
				}
			} //end check delete action id

		} //end check validation

		redirect('manage/Admission/recycle');
	} //end recycle_delete

}//end Admission class