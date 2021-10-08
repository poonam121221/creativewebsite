<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Consultancy extends Admin_Controller
{

	private $__queryStatus = FALSE;
	private $__table = "comm_consultancy_firms";
	private $__projectTable = "comm_consultancy_project";
	private $__regdepartmentTable = "comm_consultancy_reg_department1";
	private $__id = NULL;
	private $__encId = NULL;
	protected $_config = array();
	private $__allowChkStatus = NULL;
	private $__allowStatus = 0;
	private $__status = 0;
	private $__LogedPrivId = 0;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('manage/ConsultancyModel');
		$this->load->library('Ajax_pagination');
		$this->load->config('cms_config');

		$this->__allowChkStatus =  $this->config->item('allow_access_status');
		$this->perPage = 10;


		$this->__LogedPrivId = (int)encrypt_decrypt("decrypt", $this->session->userdata['AUTH_USER']['USER_UPMID']);
		if (in_array($this->__LogedPrivId, $this->__allowChkStatus)) {
			$this->__allowStatus = 1;
		}
	} //end constructor

	public function index()
	{
		//load the view
		$this->data['StateList'] = $this->ConsultancyModel->GenerateDDList('comm_state', 'state_id', 'state_name', 'Select State', $filter = array());
		addmin_css(array('plugins/select2/select2.css', 'plugins/select2/select2-bootstrap.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js'));
		$this->front_view('admin/consultancy/index', $this->data);
	} //end index function

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
			$filter = array();
			$status = $this->input->post('sStatus', TRUE);
			if (trim($status) != "") {
				$filter = array('payment_status' => (int)$status);
			}
			$state_id = $this->input->post('state_id', TRUE);
			if ($state_id != "") {
				$filter = array('state' => (int)$state_id);
			}
			$conditions['table'] = $this->__table;
			//total rows count 
			$totalRec = $this->ConsultancyModel->get_filtered_data($conditions, $filter);
			//pagination configuration
			$config['target']      = '#ajaxdata';
			$config['base_url']    = base_url() . "manage/Consultancy/ajaxPaginationData";
			$config['total_rows']  = $totalRec;
			$config['uri_segment'] = 4;
			$config['per_page']    = $this->perPage;
			$config['link_func']   = 'searchFilter';
			$this->ajax_pagination->initialize($config);

			//set start and limit
			$conditions['start'] = $offset;
			$conditions['limit'] = $this->perPage;

			//get posts data
			$this->data['DataList'] = $this->ConsultancyModel->make_datatable($conditions, $filter);
			$this->data['PageNo'] = $offset;

			//load the view
			$this->load->view('admin/consultancy/ajaxpagination', $this->data, false);
		} else {
			show_404();
		}
	} //ajaxPaginationData



	public function view()
	{
		$this->data['AreaLIst'] = array(
			'Environmental Management plan',
			'City Development plan',
			'Sate of Environment (SOE)',
			'Environmental Impact and Risk Assessment',
			'Natural Resource Management',
			'Solid and Liquid Waste Treatment & Management',
			'Energy Conservation',
			'Forest and Wildlife Conservation',
			'Sustainable agriculture',
			'Conservation on Water Bodies (Rivers, Lakes, Wetlands etc.)',
			'Climate Change/Global Warming',
			'Eco-tourism /Sustainable Tourism',
			'Environmental planning and Monitoring ',
			'Ecology/Ecological Sanitation',
			'Environmental Health Hazards', 'Industries and Mining',
			'Environment Education, Training and Awareness',
			'Environmental Pollution',
			'Green and Clean Technology',
			'Environmental Chemistry/ Toxicology',
			'Environmental Informatics', 'Urban/Regional Planning',
			'Bio-technology',
			'Rural Environment', 'Water supply ',
			'Urban and Rural Development', 'GIS and Remote Sensing Application for environmental studies.',
			'Others please specify'

		);

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
			redirect('manage/Consultancy/');
		}

		if ($this->isExists($this->__table, array('id' => $this->__id)) == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry Data not found!'));
			redirect('manage/Consultancy/');
		}

		$this->data['DataList'] = $this->ConsultancyModel->getSingleList($this->__table, array('id' => $this->__id));
		$this->data['ProjectList'] = $this->ConsultancyModel->getAllList($this->__projectTable, array('consultancy_id' => $this->__id));
		$this->data['DepartmentList'] = $this->ConsultancyModel->getAllList($this->__regdepartmentTable, array('consultancy_id' => $this->__id));
		$this->data['StateList'] =  $this->ConsultancyModel->getSingleList('comm_state', array('state_id' => $this->data['DataList']->state));
		$this->data['optstatus'] = $this->__allowStatus;
		$this->front_view('admin/consultancy/view', $this->data);
	} //end edit function
	public function updatestatus()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->__id =  $this->input->post('id');
			$DATAINPUT = array('application_status' => 1);
			$id = encrypt_decrypt('encrypt', $this->__id);
			$this->__queryStatus = $this->ConsultancyModel->updatedata($this->__table, $DATAINPUT, array('id' => $this->__id));
			//Email Configuration
			$emailMessage = "<h4>Approved!</h4> ";
			$emailMessage .= '<p>Your Application has been approved.</p>';
			$emailMessage .= '<p></p>';
			$emailMessage .= '<p><b>Regards,</b></p>';
			$emailMessage .= '<p>Admin Epco</p>';
			$EmailDetails = array(
				'email_to' => cleanQuery(trim($this->input->post('email', TRUE))),
				'subject' => 'Response Consultancy Registration',
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
			redirect('manage/Consultancy/view/' .	$id . '/');
		}
	}
	public function updaterejstatus()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->__id =  $this->input->post('id');
			$reject_region = $this->input->post('reject_region');
			$DATAINPUT = array('application_status' => 2, 'reject_region' => $reject_region);
			$this->__queryStatus = $this->ConsultancyModel->updatedata($this->__table, $DATAINPUT, array('id' => $this->__id));
			$id = encrypt_decrypt('encrypt', $this->__id);
			$emailMessage = "<h4>Rejected!</h4> ";
			$emailMessage .= '<p>Your Application has been Rejected.</p>';
			$emailMessage .= '<p>'.$reject_region.'</p>';
			$emailMessage .= '<p><b>Regards,</b></p>';
			$emailMessage .= '<p>Admin Epco</p>';
			$EmailDetails = array(
				'email_to' => cleanQuery(trim($this->input->post('email', TRUE))),
				'subject' => 'Response Consultancy Registration',
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
			redirect('manage/Consultancy/view/' .	$id . '/');
		}
	}
}//end Consultancy class