<?php
defined('BASEPATH') or exit('No direct script access allowed');
//add_css(array('')); 		//add dynamic css in page header
//add_js(array('')); 		//add dynamic js in page footer
//add_footer_js(array('')); //add dynamic js in page footer
class ProjectMonitoring extends Frontend_Controller
{
	private $__queryStatus = FALSE;
	private $__table = "comm_consultancy_firms";
	private $__projectTable = "comm_consultancy_project";
	private $__regdepartmentTable = "comm_consultancy_reg_department1";
	private $__id = NULL;
	private $__encId = NULL;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'text'));
		$this->load->model('front/ConsultancyModel');

		$this->_config = array(
			'upload_path'   => "./uploads/projects/",
			'allowed_types' => "PDF|pdf",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "15728640", // Can be set to particular file size , here it is 15 MB
		);
	} //end constructor

	public function index()
	{
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('project_monitering'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');
		$ddl_select_name = "";
		if (checkLanguage("english")) {
			$cat_title = "cat_title_en";
			$ddl_select_name = '--SELECT HOSPITAL TYPE--';
		} else {
			$cat_title = "cat_title_hi";
			$ddl_select_name = '--अस्पताल का प्रकार चुनें--';
		}
		$filter = array('enabled' => 1);
		$this->data['StateList'] = $this->ConsultancyModel->GenerateDDList('comm_state', 'state_id', 'state_name', 'Select State', $filter);
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
		$this->front_view('public/project_monitering/index', $this->data);
	} //end index function

	public function add()
	{
		$this->load->library('form_validation');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('consultancy_name', 'Consultancy Name', 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('contact_name', 'Contact Name', 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('phone_number', 'Phone nUmber', 'trim|required|max_length[100]|is_natural');
			$this->form_validation->set_rules('exp_year', $this->lang->line('total_exp'), 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('specialization', $this->lang->line('area_sep'), 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('tournover_year', $this->lang->line('annual_turnover'), 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('no_of_core_staff', $this->lang->line('no_of_staff'), 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('address', $this->lang->line('address_of_corres'), 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('city', $this->lang->line('city'), 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('state', $this->lang->line('state'), 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('pincode', $this->lang->line('pincode'), 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('emailid', $this->lang->line('email'), 'trim|required|max_length[100]|valid_email');
			$this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'trim|required|exact_length[10]|is_natural');
			$this->form_validation->set_rules('landline', $this->lang->line('landline'), 'trim|max_length[10]|alpha_numeric_spaces');
			$this->form_validation->set_rules('terms_condition', 'Declaration', 'trim|required|max_length[100]|alpha_numeric_spaces');
			$this->form_validation->set_rules('tnx_id', 'Transaction Id', 'trim|required|max_length[100]|alpha_numeric_spaces');
			if (empty($_FILES['profile_attachment']['name'])) {
				$this->form_validation->set_rules('profile_attachment', 'Profile', 'required');
			}
			if (empty($_FILES['work_attachment']['name'])) {
				$this->form_validation->set_rules('work_attachment', 'Work', 'required');
			}
			if (empty($_FILES['taxcertificate_attachment']['name'])) {
				$this->form_validation->set_rules('taxcertificate_attachment', 'Taxcertificate', 'required');
			}
			if (empty($_FILES['staff_attachment']['name'])) {
				$this->form_validation->set_rules('staff_attachment', 'Staff', 'required');
			}
			if (empty($_FILES['balencesheet_attachment']['name'])) {
				$this->form_validation->set_rules('balencesheet_attachment', 'Balencesheet', 'required');
			}
			if (empty($_FILES['article_attachment']['name'])) {
				$this->form_validation->set_rules('article_attachment', 'Article', 'required');
			}
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
				redirect('empanelment-consultancy');
			} else {
				$profile_attachment =  $this->_uploadFile('profile_attachment');
				$work_attachment =  $this->_uploadFile('work_attachment');
				$taxcertificate_attachment =  $this->_uploadFile('taxcertificate_attachment');
				$staff_attachment =  $this->_uploadFile('staff_attachment');
				$balencesheet_attachment =  $this->_uploadFile('balencesheet_attachment');
				$article_attachment =  $this->_uploadFile('article_attachment');

				$DATAINPUT = array(
					'consultancy_name' => cleanQuery(trim(ucwords($this->input->post('consultancy_name', TRUE)))),
					'contact_name' => cleanQuery(trim(ucwords($this->input->post('contact_name', TRUE)))),
					'phone_number' => cleanQuery(trim(ucwords($this->input->post('phone_number', TRUE)))),
					'exp_year' => cleanQuery(trim(ucwords($this->input->post('exp_year', TRUE)))),
					'specialization' => cleanQuery(trim(ucwords($this->input->post('specialization', TRUE)))),
					'tournover_year' => cleanQuery(trim(ucwords($this->input->post('tournover_year', TRUE)))),
					'no_of_core_staff' => cleanQuery(trim(ucwords($this->input->post('no_of_core_staff', TRUE)))),
					'address' => cleanQuery(trim(ucwords($this->input->post('address', TRUE)))),
					'city' => cleanQuery(trim(ucwords($this->input->post('city', TRUE)))),
					'state' => cleanQuery(trim(ucwords($this->input->post('state', TRUE)))),
					'pincode' => cleanQuery(trim(ucwords($this->input->post('pincode', TRUE)))),
					'emailid' => cleanQuery(trim(ucwords($this->input->post('emailid', TRUE)))),
					'mobile' => cleanQuery(trim(ucwords($this->input->post('mobile', TRUE)))),
					'landline' => cleanQuery(trim(ucwords($this->input->post('landline', TRUE)))),
					'terms_condition' => ($this->input->post('terms_condition', TRUE) == 1),
					'profile_attachment' =>  $profile_attachment,
					'work_attachment' =>  $work_attachment,
					'taxcertificate_attachment' =>  $taxcertificate_attachment,
					'staff_attachment' =>  $staff_attachment,
					'balencesheet_attachment' =>  $balencesheet_attachment,
					'article_attachment' =>  $article_attachment,
					'tnx_id' =>   cleanQuery(trim(ucwords($this->input->post('tnx_id', TRUE)))),
					'added_date'   => date('Y-m-d h:i:s')
				);

				$consultancy_id = "";
				$this->__queryStatus = $this->ConsultancyModel->insertdata($this->__table, $DATAINPUT);
				if (!empty($this->__queryStatus)) {
					$consultancy_id = $this->__queryStatus;
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
					redirect('empanelment-consultancy');
				}

				$project_title      = cleanQuery(($this->input->post('project_title[]', TRUE)));
				$area_of_project    = cleanQuery(($this->input->post('area_of_project[]', TRUE)));
				$assignment_details = cleanQuery(($this->input->post('assignment_details[]', TRUE)));
				$name_of_client      = cleanQuery(($this->input->post('name_of_cient[]', TRUE)));
				$project_cost       = cleanQuery(($this->input->post('project_cost[]', TRUE)));
				$year_of_execution  = cleanQuery(($this->input->post('year_of_execution[]', TRUE)));
				$duration_of_project = cleanQuery(($this->input->post('duration_of_project', TRUE)));
				$completion_status  = cleanQuery(($this->input->post('completion_status', TRUE)));
				$department_name    = cleanQuery(($this->input->post('department_name', TRUE)));
				$no_of_project_reg  = cleanQuery(($this->input->post('no_of_project_reg', TRUE)));
				$registration_year  = cleanQuery(($this->input->post('registration_year', TRUE)));

				//$consultancy_id = "";

				$PROJECT = array();
				$DEPARTMENT = array();
				/* For Loop Start */
				for ($i = 0; $i < count($project_title); $i++) {
					$PROJECT[$i] = array(
						'consultancy_id'     => $consultancy_id,
						'project_title'      => $project_title[$i],
						'area_of_project'    => $area_of_project[$i],
						'assignment_details' => $assignment_details[$i],
						'name_of_client '    => $name_of_client[$i],
						'project_cost'       => $project_cost[$i],
						'year_of_execution'  => $year_of_execution[$i],
						'duration_of_project' => $duration_of_project[$i],
						'completion_status'  => $completion_status[$i],
						'project_added_date'   => date('Y-m-d h:i:s')
					);
				}
				for ($i = 0; $i < count($department_name); $i++) {
					$DEPARTMENT[$i] = array(
						'consultancy_id'    => $consultancy_id,
						'department_name'   => $department_name[$i],
						'no_of_project_reg' => $no_of_project_reg[$i],
						'registration_year' => $registration_year[$i],
						'department_added_date'   => date('Y-m-d h:i:s')
					);
				}
				/* For Loop End */
				$queryStatus1 = $this->db->insert_batch($this->__projectTable, $PROJECT);
				$queryStatus2 = $this->db->insert_batch($this->__regdepartmentTable, $DEPARTMENT);
				//Email Configuration
				$emailMessage = "";
				$emailMessage .= '<p>Thanks ' . cleanQuery(trim($this->input->post('consultancy_name', TRUE))) . ',</p>';
				$emailMessage .= '<p>We have received your request for Consultancy Registration.</p>';
				$emailMessage .= '<p>We\'ll get back to you soon!!</p>';
				$emailMessage .= '<p><b>Regards,</b></p>';
				$emailMessage .= '<p>EPCO</p>';

				$EmailDetails = array(
					'email_to' => cleanQuery(trim($this->input->post('emailid', TRUE))),
					'subject' => 'Consultancy Registration',
					'message' => $emailMessage,
					'email_from' => 'Admin EPCO'
				);
				$msg = "";
				if (!empty($consultancy_id)) {
					$getEmailInfo = $this->sendEmail($EmailDetails); //core/MY_Controller/Email Function				
					if ($getEmailInfo['status'] != TRUE) {
						$msg .= " and " . $getEmailInfo['message'];
					}
					$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Data successfully submitted' . $msg));
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
				}
				redirect('empanelment-consultancy');
			} //end validation
		} else {
			show_404();
		}
	} //add function

	public function VerifyEmail()
	{
		$email = $this->input->post('emailid', TRUE);
		$filter = array('emailid' => $email);
		$result = $this->ConsultancyModel->getRecord($this->__table, $filter);
		if (empty($result)) {
			echo "true";
		} else {
			echo "false";
		}
		exit();
	}

	

	protected function _uploadFile($filename, $preUploadedFile = "")
	{
		
		$this->_config['file_name'] = date("Y-m-d_His").'_'.$filename;
		$this->load->library('upload', $this->_config);
		$this->upload->initialize($this->_config);
		$FILE_NAME = "";
		$FULL_PATH = "";
		if (isset($_FILES[$filename]['name']) == TRUE && trim($_FILES[$filename]['name']) != "") {
			if ($this->upload->do_upload($filename)) {
				$upload_data = $this->upload->data();
				$FILE_NAME = $upload_data['file_name'];
				$FULL_PATH = $upload_data['full_path'];
				$fileInfo = getFileInfo($upload_data['file_name']);
				$NEW_IMAGE = $fileInfo['filename'] . '.' . $fileInfo['extension'];
				if (trim($preUploadedFile) != "" && trim($preUploadedFile) != NULL) {
					@unlink("./uploads/projects/" . trim($preUploadedFile));
				}
				return $NEW_IMAGE;
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => $this->upload->display_errors()));
				return FALSE;
			}
		} else {
			return $preUploadedFile;
		}
	} //end uploadFile function
}//end class home