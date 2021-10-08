<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authlocaluser extends MY_Controller
{

	private $__queryStatus = FALSE;
	private $__table = "comm_users";
	private $__SpecialSymbol = ""; //!@#$%^&*?~
	private $__id = NULL;
	private $__encId = NULL;
	private $__adminEmail = NULL;
	const ATMPTVAL  = 3;
	const ATMPTMINUTE  = 10;
	public $data = array();
	private $__applicationName = "EPCO";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('security', 'emailtemplate'));
		$this->load->model(array('user/UserModel'));

		$this->data['site_name_hi']  = $this->config->item('site_name_hi');
		$this->data['site_name_en']  = $this->config->item('site_name_en');
		$this->data['copy_right']    = $this->config->item('copy_right');
		$this->data['meta_title']    = $this->config->item('meta_title');
		$this->data['meta_keyword']  = $this->config->item('meta_keyword');
		$this->data['meta_desc']     = $this->config->item('meta_desc');
		$this->_config = array(
			'upload_path'   => "./uploads/admision/",
			'allowed_types' => "jpg|png|jpeg|JPG|JPEG",
			'remove_spaces' => TRUE,
			'encrypt_name'  => FALSE,
			'overwrite'     => FALSE,
			'max_size'      => "2097152", // Can be set to particular file size , here it is 2 MB (1024*1024*2)
		);
	} //end constructor

	public function index()
	{
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('registration_status'), '/');
		$this->breadcrumbs->unshift($this->lang->line('home_page'), '/');

		$this->front_view('user/login/index', $this->data);
		$this->session->unset_userdata('AUTH_LOCAL_USER');
	} //end index function

	public function checkLogin()
	{

		$this->load->library('form_validation');

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('captcha', 'Security code', 'trim|required|check_captcha');
			//$this->form_validation->set_rules('user_type', 'Status', 'trim|required|in_list[1,2,3]');	
			$this->form_validation->set_rules('user_name', 'Username', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('user_ps', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				//$userType  = (int)$this->input->post('user_type',true);
				$username  = cleanQuery($this->input->post('user_name', true));
				$pass      = cleanQuery($this->input->post('user_ps', true));
				$validKey  = cleanQuery($this->input->post('valid', true));
				$LonigInfo = $this->__verifyUserAuth($username, $pass, $validKey);

				if ($LonigInfo['LOGIN_STATUS'] == TRUE) {

					$this->session->set_flashdata('AppMessage', array('class' => 'info', 'message' => $LonigInfo['MESSAGE']));
					redirect('/register');
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => $LonigInfo['MESSAGE']));
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
				redirect('login');
			}
		} else {
			redirect('login');
			//show_404();
		} //end check post method

	} //end checkLogin function

	private function __verifyUserAuth($username, $pass, $validKey)
	{

		$userinfo = array();
		if (trim($validKey) != "") {
			$getdata = $this->UserModel->login($username, $pass, $validKey, 1, self::ATMPTVAL, self::ATMPTMINUTE);
		} else {
			$getdata = array('AUTH_ERROR_MESSAGE' => 'Invalid login details.');
		}

		if (isset($getdata['IS_AUTH_USER']) && strtolower($getdata['IS_AUTH_USER']) == "valid") {

			$user_fullname = trim($getdata["USERDATA"]->user_fname . " " . $getdata["USERDATA"]->user_lname);

			$userinfo = array(
				'AUTH_LOCAL_USER' => array(
					'SERIALNO'   => encrypt_decrypt("encrypt", $getdata["USERDATA"]->user_id),
					'USER_NAME'  => $user_fullname,
					'USER_EMAIL' => encrypt_decrypt("encrypt", $getdata["USERDATA"]->user_email),
					'USER_MOBILE' => encrypt_decrypt("encrypt", html_escape($getdata["USERDATA"]->user_mobile)),
					//  'USER_TYPE'  => $getdata["USERDATA"]->user_type,
					'IS_LOGED_IN' => TRUE
				)
			);

			$this->__id = $getdata["USERDATA"]->user_id;
			$DATAINPUT = array("user_last_login" => date('Y-m-d h:i:s'));
			$FILTER = array('user_id' => $this->__id,'application_status !='=>2);
			$LOG_MSG = "Member logged in successfully!!";

			$this->session->set_userdata($userinfo);
			$this->__queryStatus = $this->UserModel->updatedata($this->__table, $DATAINPUT, $FILTER, $LOG_MSG);

			return array('LOGIN_STATUS' => TRUE, 'MESSAGE' => "Your most welcome !!");
		} else {
			return array('LOGIN_STATUS' => FALSE, 'MESSAGE' => $getdata['AUTH_ERROR_MESSAGE']);
		}
	} //end verifyUser function

	public function forgot_password()
	{

		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('login'), '/');
		$this->breadcrumbs->unshift($this->lang->line('forgot_password'), '/');

		$this->load->library('form_validation');

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('captcha', 'Security code', 'trim|required|check_captcha');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]');

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
				redirect('user/forgot-password');
			} else {

				$email  = cleanQuery(trim($this->input->post('email', TRUE)));
				$filter = array('user_email' => $email, 'user_status' => 1,'application_status !='=>2);

				$result = $this->UserModel->getRecord($this->__table, $filter);

				if (isset($result) && $result != FALSE && trim($result->user_email) != "") {

					$verify_code = randomUniqueId(10);
					$name        = $result->user_fname;
					$this->__id  = $result->user_id;

					$DATAINPUT = array('user_pass_verify_code'	=> $verify_code, 'exp_verify_date' => date('Y-m-d H:i:s'));
					$ACTIVE_STATUS = "Generate verification for password of " . $name;

					$this->__queryStatus = $this->UserModel->updatedata($this->__table, $DATAINPUT, array('user_id' => $this->__id), $ACTIVE_STATUS);
					if ($this->__queryStatus == TRUE) {

						$emailData['name'] = $name;
						$emailData['link'] = base_url('user/reset-password/') . md5($email) . '/' . md5($verify_code);
						//Emai Configuration				
						$emailMessage = memberForgotPassword($emailData); //emailtemplate helper			

						$EmailDetails = array(
							'email_to' => $email,
							'subject' => 'Reset password for EPCO user Login',
							'message' => $emailMessage,
							'email_from' => $this->__applicationName
						);

						$getEmailInfo = $this->sendEmail($EmailDetails);

						if ($getEmailInfo['status'] == TRUE) {
							$this->session->set_flashdata('AppMessage', array('class' => 'info', 'message' => 'Successfully sent reset password link to your Registered Email Address !'));
							redirect('user/forgot-password');
						}
					} //end check query Status
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Either Email Address is not found in our records or your account is not activated. Please try again later!'));
					redirect('user/forgot-password');
				} //end check result

			} //end validation

			redirect('user/forgot-password');
		} //end check post method

		$this->front_view('user/login/forgot_password', $this->data);
	} //end forgot_password function

	public function reset_password()
	{

		$this->load->library('form_validation');
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('login'), '/');
		$this->breadcrumbs->unshift($this->lang->line('reset_password'), '/');

		$email 	  	 =  $this->uri->segment(3, "");
		$verify_code =  $this->uri->segment(4, "");

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$email = trim(cleanQuery($this->input->post('key')));
			$verify_code = trim(cleanQuery($this->input->post('token')));
		}

		if ($email == "" || $verify_code == "") {
			$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => 'Invalid Option.'));
			redirect('login');
		} else {

			$this->data['key'] = $email;
			$this->data['token'] = $verify_code;

			$filter = array($email, $verify_code, 1, date('Y-m-d H:i:s'), 30);  //allow only 30 minute       	
			$result = $this->UserModel->getForgotRecord($filter);

			//print_r($this->db->last_query());

			if ($result == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => 'Either key or token is invalid or your reset password time is left.'));
				redirect('user/forgot-password');
			}
		} //end check email and verify_code

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('new_pass', 'Password', 'trim|required|min_length[6]|max_length[20]|valid_pass_pattern');
			$this->form_validation->set_rules('con_pass', 'Confirm Password', 'trim|required|max_length[20]|matches[new_pass]');
			$this->form_validation->set_rules('captcha', 'Security code', 'trim|required|check_captcha');

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => validation_errors()));
				redirect('user/reset-password/' . $email . '/' . $verify_code);
			} else {

				$name        = trim($result->user_fname . " " . $result->user_lname);
				$this->__id  = $result->user_id;
				$password    = cleanQuery(trim($this->input->post('new_pass', TRUE)));
				$DATAINPUT   = array('user_pass_verify_code' => '', 'user_password' => hash('sha256', $password));
				$FILTER      = array('user_id' => $this->__id, 'user_status' => 1,'application_status !='=>2);
				$ACTIVE_STATUS = "Reset password of " . $name;

				$this->__queryStatus = $this->UserModel->updatedata($this->__table, $DATAINPUT, $FILTER, $ACTIVE_STATUS, $this->__id, TRUE, 'user');
				if ($this->__queryStatus == TRUE) {
					$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Your password reset successfully'));
					redirect('login');
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Sorry plese try again later !'));
					redirect('user/reset-password/' . $email . '/' . $verify_code);
				}
			} //end validation else part

		} //end check post method

		$this->front_view('user/login/reset_password', $this->data);
	} //end reset_password fucntion

	public function verify_email()
	{
		$this->load->library('form_validation');

		$email 	  =  trim(cleanQuery($this->uri->segment(3, "")));
		$verify_code =  trim(cleanQuery($this->uri->segment(4, "")));

		if ($email != "" && $verify_code != "") {
			$filter = array('md5(user_email)' => $email, 'md5(email_verify_code)' => $verify_code,'application_status !='=>2);
			$rec = $this->UserModel->getRecord($this->__table, $filter);

			if ($rec != FALSE && count($rec) > 0) {

				$this->__id = $rec->user_id;
				$this->__encId = encrypt_decrypt('encrypt', $rec->user_id);

				if ($rec->email_verify_status == 1) {
					$this->session->set_flashdata(
						'AppMessage',
						array('class' => 'success', 'message' => 'Your email is already verified.')
					);
					redirect('login');
				}

				$DATAINPUT = array(
					'email_verify_status' => 1,
					'email_verify_code' => '',
					'email_verification_date' => date('Y-m-d H:i:s')
				);
				$filter = array('user_id' => $rec->user_id);
				$logActivity = $rec->user_name . ", your email is verified.";

				$this->__queryStatus = $this->UserModel->updatedata($this->__table, $DATAINPUT, $filter, $logActivity, TRUE, $rec->user_id, 'user');

				if ($this->__queryStatus == TRUE) {
					$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Your email successfully verified.'));
					redirect('login');
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
				}
				redirect('login');
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Invalid email verification information !'));
				redirect('login');
			}
		} else {
			redirect('login');
		}
	} //end verify_email

	public function resend_email()
	{

		$this->load->library('form_validation');
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('login'), '/');
		$this->breadcrumbs->unshift($this->lang->line('resend_email'), '/');

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('captcha', 'Security code', 'trim|required|check_captcha');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
				redirect('user/resend-email');
			} else {
				$email  = cleanQuery(trim($this->input->post('email', TRUE)));
				$filter = array('user_email' => $email,'application_status !='=>2);
				$result = $this->UserModel->getRecord($this->__table, $filter);
				if (isset($result) && $result != FALSE) {
					$verify_code = randomUniqueId(10);
					$fname        = $result->user_fname;
					$lname        = $result->user_lname;
					$this->__id  = $result->user_id;
					$fullname = trim($fname . " " . $lname);
					if ($result->email_verify_status == 1) {
						$this->session->set_flashdata(
							'AppMessage',
							array('class' => 'danger', 'message' => 'Your email verification status is already activated.')
						);
						redirect('user/resend-email');
					} else {
						$DATAINPUT = array(
							'email_verify_code' => $verify_code,
							'edit_date' => date('Y-m-d H:i:s')
						);
						$LOG_STATUS = $fullname . " your email verification code is regenerated.";
						$filter = array('user_id' => $this->__id);
						$this->__queryStatus = $this->UserModel->updatedata($this->__table, $DATAINPUT, $filter, $LOG_STATUS);
						if ($this->__queryStatus == TRUE) {

							$EmailStatus = $this->_sendEmailForVerification($fullname, $email, $verify_code);
							if ($EmailStatus) {
								$this->session->set_flashdata(
									'AppMessage',
									array('class' => 'info', 'message' => 'Your email verification code is regenerated.')
								);
							} else {
								$this->session->set_flashdata(
									'AppMessage',
									array('class' => 'info', 'message' => 'Sorry try again later.')
								);
							}
							redirect('user/resend-email');
						} else {
							$this->session->set_flashdata(
								'AppMessage',
								array('class' => 'danger', 'message' => 'Sorry try again later.')
							);
							redirect('user/resend-email');
						}
					} //end check status		
				} //end check result		
			} //end validation		
		} //end check post method
		$this->front_view('user/login/resend_email', $this->data);
	} //end resend_email

	public function loadcaptcha()
	{
		echo reload_captcha(22);
	} //end loadcaptcha function

	public function loadcaptcha1()
	{
		echo reload_captcha(22);
	} //end loadcaptcha function

	public function logout()
	{
		$this->session->unset_userdata('AUTH_LOCAL_USER');
		$this->session->sess_destroy();
		redirect('login/');
	} //end signout function

	public function checkAuthLog()
	{
		$project_enc_id = $this->uri->segment(2, NULL);
		$project_id = encrypt_decrypt('decrypt', $project_enc_id);
		if (is_null($project_id) == TRUE) {
			redirect('/');
		}
		if ($this->session->has_userdata('AUTH_LOCAL_USER') == FALSE) {
			$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Please login first before show interest in project.'));
			redirect('login');
		} else {
			//check this user type is company or not
			$user_name = $this->session->userdata['AUTH_LOCAL_USER']['USER_NAME'];
			if ($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE'] == 3) {
				$this->session->set_flashdata('AppMessage', array('class' => 'info', 'message' => 'Please login as a Company or Individual.'));
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Welcome ' . $user_name . ',now you can show internet in project.'));
			}
			redirect('project/details/' . $project_enc_id);
		}
	} //end checkAuthLog function

	protected function _sendEmailForVerification($name = "", $email = "", $verify_code = "")
	{
		//Emai Configuration
		$link = base_url('user/verify-email/' . md5($email) . '/' . md5($verify_code));
		$emailData['member_name'] = $name;
		$emailData['link'] = $link;
		$emailMessage = memberEmailVerification($emailData);
		$EmailDetails = array(
			'email_to' => $email,
			'subject' => 'Email verification',
			'message' => $emailMessage,
			'email_from' => $this->__applicationName
		);
		$getEmailInfo = $this->sendEmail($EmailDetails);
		return $getEmailInfo['status'];
	}

	public function front_view($view, $data = array())
	{
		$this->load->view('element/inc_head', $this->data);
		$this->load->view('element/inc_nav', $data);
		$this->load->view($view, $data);
		$this->load->view('element/inc_footer', $data);
	} //end front_view function
	public function register()
	{
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('register'), '/');
		$this->breadcrumbs->unshift('<i class="fa fa-home"></i>', '/');
		$session_mail = '';
		$filter = array('status' => 1);
		//$this->data['DepartmentList'] = $this->UserModel->getDepartmentList($this->__departments,$filter);
		if (!empty($this->session->userdata['AUTH_LOCAL_USER'])) {
			$session_mail = encrypt_decrypt("decrypt", $this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
			$filter = array('um.user_id' => $session_mail,'application_status !='=>2);
			$this->data['userDataList'] = $this->UserModel->getSingleList($filter);	
			$this->data['DistrictList'] = $this->UserModel->GenerateDDList('comm_district', 'DistrictCensusCode', 'district_name', '--SELECT DISTRICT--', array('enabled' => 1));
			if (!isset($this->data['userDataList']->user_step)) {
				redirect('login');
			}
			if ($this->data['userDataList']->user_step == 0) {
				$this->front_view('user/login/register_complete', $this->data);
			} else {				
				$this->data['userInfo'] = $this->UserModel->getAllUserInfo($this->__table, $filter);
				//echo"<pre>";print_r($this->data['userInfo'] );exit;	
				$user_id_wise_qual_info = $this->data['userInfo']->user_id;
				if (!empty($this->data['userInfo'])) {
					$this->data['userQualificationInfo'] = $this->UserModel->getUserQualificationInfo('user_qualification', array('fk_user_id' => $user_id_wise_qual_info));
				}
				$this->front_view('user/login/register_view', $this->data);
			}
			//	echo"<pre>";print_r($this->data['userDataList'] );exit;	
		} else {
			
			$this->front_view('user/login/register', $this->data);
		}
		//$this->front_view('user/login/register',$this->data);
	} //end index function

	public function add_user()
	{
		$this->load->library('form_validation');
		$session_mail = '';
		$session_mail = encrypt_decrypt("decrypt", $this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($session_mail == '') {
				$this->form_validation->set_rules('emailid', 'Email', 'trim|required|max_length[60]|valid_email|is_unique[' . $this->__table . '.user_email]');
				$this->form_validation->set_rules('passwrd', 'User Password', 'trim|required|min_length[8]|max_length[20]|valid_pass_pattern');
				$this->form_validation->set_rules('mobileno', 'Mobile', 'trim|required|exact_length[10]|is_natural|is_unique[' . $this->__table . '.user_mobile]');
				$this->form_validation->set_rules('NameoftheCandidate', 'Name of the Candidate', 'trim|required|max_length[200]');
				$this->form_validation->set_rules('passwrd', 'Password', 'trim|required|max_length[20]');
				$this->form_validation->set_rules('phtoid', 'Photo ID', 'trim|required|max_length[20]');
				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
					redirect('register');
				}
			}
			$email  = cleanQuery(trim($this->input->post('emailid', TRUE)));
			$password  = cleanQuery(trim($this->input->post('passwrd', TRUE)));
			$Name  = cleanQuery(trim($this->input->post('NameoftheCandidate', TRUE)));
			$Mobile  = cleanQuery(trim($this->input->post('mobileno', TRUE)));
			$DOB  = cleanQuery(trim($this->input->post('dob', TRUE)));
			$phtoid  = cleanQuery(trim($this->input->post('phtoid', TRUE)));
			$name_of_organization  = cleanQuery(trim($this->input->post('name_of_organization', TRUE)));
			$contact_detail_employer  = cleanQuery(trim($this->input->post('contact_detail_employer', TRUE)));
			$desig_of_candidate  = cleanQuery(trim($this->input->post('desig_of_candidate', TRUE)));
			$cand_date_of_joining  = cleanQuery(trim($this->input->post('cand_date_of_joining', TRUE)));
			$verify_code = randomUniqueId(10);
			$filter = array('user_id' => $session_mail);
			$result = $this->UserModel->getRecord($this->__table, $filter);
			if (isset($result) && $result != FALSE) {
				$this->session->set_flashdata(
					'AppMessage',
					array('class' => 'danger', 'message' => 'Your email is already in used.')
				);
				redirect('login');
			} //end check result
			else {
				$filter_new = array('user_mobile' => $Mobile);
				$result = $this->UserModel->getRecord($this->__table, $filter_new);
				if (isset($result) && $result != FALSE) {
					$this->session->set_flashdata(
						'AppMessage',
						array('class' => 'danger', 'message' => 'Your mobile number is already in used.')
					);
					redirect('login');
				}
				$NameArr = explode(" ", $Name);
				$FName = $NameArr[0];
				$LName = "";
				if (count($NameArr) > 1) {
					unset($NameArr[0]);
					$LName = implode(" ", $NameArr);
				}
				$fullname = trim($FName . " " . $LName);
				if ($session_mail != '') {
					$this->form_validation->set_rules('enrollno', 'Enrollment Number', 'trim|required');
					$this->form_validation->set_rules('fathername', 'Father Name', 'trim|required');
					$this->form_validation->set_rules('mothername', 'Mother Name', 'trim|required');
					$this->form_validation->set_rules('cor_address', 'Address for Correspondence', 'trim|required');
					$this->form_validation->set_rules('gender', 'Gender', 'trim|required|in_list[1,2]');
					$this->form_validation->set_rules('category', 'Category', 'trim|required|in_list[1,2,3,4]');
					$this->form_validation->set_rules('state', 'State', 'trim|required');
					$this->form_validation->set_rules('city', 'City', 'trim|required');
					$this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required');
					$this->form_validation->set_rules('landline', 'Landline', 'trim');
					if ($this->form_validation->run() == FALSE) {
						$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
						redirect('register');
					}
					$userDataRet = $this->UserModel->getSingleList(array('user_status' => 1));
					$user_id_pk  = $userDataRet->user_id;
					$qualification   = cleanQuery(($this->input->post('qualification[]', TRUE)));
					$passing_year   = date("yy-m-d",strtotime($this->input->post('passing_year[]', TRUE)));
					$board   = cleanQuery(($this->input->post('board[]', TRUE)));
					$total_mark   = cleanQuery(($this->input->post('total_mark[]', TRUE)));
					$out_of_total_mark  = cleanQuery(($this->input->post('out_of_total_mark[]', TRUE)));
					$age   = cleanQuery(($this->input->post('age[]', TRUE)));
					$subject   = cleanQuery(($this->input->post('subject[]', TRUE)));
					$enrollno   = cleanQuery(($this->input->post('enrollno', TRUE)));
					$enrollno   = cleanQuery(($this->input->post('enrollno', TRUE)));
					$fathername   = cleanQuery(($this->input->post('fathername', TRUE)));
					$mothername   = cleanQuery(($this->input->post('mothername', TRUE)));
					$gender   = cleanQuery(($this->input->post('gender', TRUE)));
					$category   = cleanQuery(($this->input->post('category', TRUE)));
					$cor_address   = cleanQuery(($this->input->post('cor_address', TRUE)));
					$state   = cleanQuery(($this->input->post('state', TRUE)));
					$city   = cleanQuery(($this->input->post('city', TRUE)));
					$pin_code   = cleanQuery(($this->input->post('pin_code', TRUE)));
					$landline   = cleanQuery(($this->input->post('landline', TRUE)));
					$agree   = cleanQuery(($this->input->post('agree', TRUE)));

					/* For Loop Start */
					for ($i = 0; $i < count($qualification); $i++) {
						$USERINPUT[$i] = array(
							'fk_user_id' => $user_id_pk,
							'qualification_id' => $qualification[$i],
							'passing_year' => $passing_year[$i],
							'board' => $board[$i],
							'total_mark' => $total_mark[$i],
							'out_of_total_mark'=> $out_of_total_mark[$i],
							'age' => $age[$i],
							'subject' => $subject[$i]
						);
					}
					/* For Loop End */
					$queryStatus = $this->db->insert_batch('user_qualification', $USERINPUT);
					if (isset($_FILES)) {
						$attachmentName = $this->_uploadFile();
					} else {
						$attachmentName = "";
					}
					//$attachmentName = $this->_uploadFile();	
					//print_r($attachmentName);exit;				
					/* Update Detail Data */
					$USERDETAILUPDATE = array(
						'enrolment_number' => $enrollno,
						'father_name' => $fathername,
						'mother_name' => $mothername,
						'gender' => $gender,
						'category' => $category,
						'correspond_address' => $cor_address,
						'city' => $city,
						'state' => $state,
						'pin_code' => $pin_code,
						'landline' => $landline,
						'user_image' => $attachmentName,
						'agree_check' => 1,
						'name_of_organization' => $name_of_organization,
						'contact_detail_employer' => $contact_detail_employer,
						'desig_of_candidate' => $desig_of_candidate,
						'date_of_joining' => $cand_date_of_joining,
					);
					$USERTABLEUPDATE = array(
						'user_step' => 1,
					);
					/*  End Update Detail Data */

					if ($queryStatus == TRUE) {

						
					
						$emailMessage = "";
						$emailMessage .= '<p>Thanks ' . cleanQuery(trim($this->input->post('NameoftheCandidate', TRUE))) . ',</p>';
						$emailMessage .= '<p>Your PGDEM Registration Successfully completed .</p>';
						$emailMessage .= '<p>We\'ll get back to you soon with you LMS Crdentials !!</p>';
						$emailMessage .= '<p><b>Regards,</b></p>';
						$emailMessage .= '<p>Admin EPCO</p>';
		
						$EmailDetails = array(
							'email_to' => cleanQuery(trim($this->input->post('emailid', TRUE))),
							'subject' => 'PGDEM Registration ',
							'message' => $emailMessage,
							'email_from' => 'Admin EPCO'
						);			
		
						$msg = "";							
						$getEmailInfo = $this->sendEmail($EmailDetails); //core/MY_Controller/Email Function					if ($getEmailInfo['status'] != TRUE) {
						

						$queryUpdateStatus = $this->UserModel->updatedata('comm_user_detail', $USERDETAILUPDATE, array('fk_user_id' => $user_id_pk));
						$queryUserStepStatus = $this->UserModel->updatedata('comm_users', $USERTABLEUPDATE, array('user_id' => $user_id_pk));
						// echo $this->db->last_query();exit;
						if ($queryUpdateStatus == TRUE) {
									

							redirect('registerview');
						}
					}
				} else {

					$USERINPUT = array(
						'user_fname' => $FName,
						'user_lname' => $LName,
						'user_email' => $email,
						'user_mobile' => $Mobile,
						'username' => $email,
						'user_password' => hash('sha256', $password),
						'user_status' => 1,
						'email_verify_status' => 0,
						'add_date' => date('Y-m-d h:i:s'),
						'email_verify_code' => $verify_code,
					);

					$USERDETAILINPUT = array(
						'DOB' => $DOB,
						'user_photo_id' => $phtoid,
						'name_of_organization' => $phtoid,
						'contact_detail_employer' => $phtoid,
						'desig_of_candidate' => $phtoid,
						'date_of_joining' => $phtoid,
					);
					$this->__queryStatus = $this->UserModel->insertUserdata($USERINPUT, $USERDETAILINPUT);
				}
				//$this->__queryStatus = $this->UserModel->insertIndividualData($USERINPUT,$INDIVIDUALUSERINPUT);

				if ($this->__queryStatus == TRUE) {
						$EmailStatus = $this->_sendEmailForVerification($fullname,$email,$verify_code);	
					$link = base_url('user/verify-email/' . md5($email) . '/' . md5($verify_code));
					$this->session->set_flashdata('AppMessage', array('class' => 'success', 'message' => 'Successfully registered'));
					redirect('login');
				} else {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
					redirect('register');
				}
			} //end check post method	
		}
	} //end resend_email

	public function updateuser()
	{
		$this->load->library('form_validation');
		$session_mail = '';
		$session_mail = encrypt_decrypt("decrypt", $this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if($session_mail) {
				$this->form_validation->set_rules('enrollno', 'Enrollment Number', 'trim|required');
				$this->form_validation->set_rules('fathername', 'Father Name', 'trim|required');
				$this->form_validation->set_rules('mothername', 'Mother Name', 'trim|required');
				$this->form_validation->set_rules('cor_address', 'Address for Correspondence', 'trim|required');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|required|in_list[1,2]');
				$this->form_validation->set_rules('category', 'Category', 'trim|required|in_list[1,2,3,4]');
				$this->form_validation->set_rules('state', 'State', 'trim|required');
				$this->form_validation->set_rules('city', 'City', 'trim|required');
				$this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required');
				$this->form_validation->set_rules('landline', 'Landline', 'trim');
				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => validation_errors()));
					redirect('register');
				}

				$email  = cleanQuery(trim($this->input->post('emailid', TRUE)));
				$password  = cleanQuery(trim($this->input->post('passwrd', TRUE)));
				$Name  = cleanQuery(trim($this->input->post('NameoftheCandidate', TRUE)));
				$Mobile  = cleanQuery(trim($this->input->post('mobileno', TRUE)));
				$DOB  = cleanQuery(trim($this->input->post('dob', TRUE)));
				$phtoid  = cleanQuery(trim($this->input->post('phtoid', TRUE)));
				$name_of_organization  = cleanQuery(trim($this->input->post('name_of_organization', TRUE)));
				$contact_detail_employer  = cleanQuery(trim($this->input->post('contact_detail_employer', TRUE)));
				$desig_of_candidate  = cleanQuery(trim($this->input->post('desig_of_candidate', TRUE)));
				$cand_date_of_joining  = cleanQuery(trim($this->input->post('cand_date_of_joining', TRUE)));



				$userDataRet    = $this->UserModel->getSingleList(array('user_status' => 1,'user_id'=> $session_mail));
				$user_id_pk     = $userDataRet->user_id;
				$qualification  = cleanQuery(($this->input->post('qualification[]', TRUE)));
				$passing_year   = cleanQuery(($this->input->post('passing_year[]', TRUE)));
				$board          = cleanQuery(($this->input->post('board[]', TRUE)));
				$total_mark     = cleanQuery(($this->input->post('total_mark[]', TRUE)));
				$out_of_total_mark = cleanQuery(($this->input->post('out_of_total_mark[]', TRUE)));
				$age            = cleanQuery(($this->input->post('age[]', TRUE)));
				$subject        = cleanQuery(($this->input->post('subject[]', TRUE)));
				$enrollno       = cleanQuery(($this->input->post('enrollno', TRUE)));
				$fathername     = cleanQuery(($this->input->post('fathername', TRUE)));
				$mothername     = cleanQuery(($this->input->post('mothername', TRUE)));
				$gender         = cleanQuery(($this->input->post('gender', TRUE)));
				$category       = cleanQuery(($this->input->post('category', TRUE)));
				$cor_address    = cleanQuery(($this->input->post('cor_address', TRUE)));
				$state          = cleanQuery(($this->input->post('state', TRUE)));
				$city           = cleanQuery(($this->input->post('city', TRUE)));
				$pin_code       = cleanQuery(($this->input->post('pin_code', TRUE)));
				$landline       = cleanQuery(($this->input->post('landline', TRUE)));
				$agree          = cleanQuery(($this->input->post('agree', TRUE)));
				/* For Loop Start */
				for ($i = 0; $i < count($qualification); $i++) {
					$USERINPUT[$i] = array(
						'fk_user_id'       => $user_id_pk,
						'qualification_id' => $qualification[$i],
						'passing_year'     => $passing_year[$i],
						'board'            => $board[$i],
						'total_mark'       => $total_mark[$i],
						'out_of_total_mark' => $out_of_total_mark[$i],
						'age'              => $age[$i],
						'subject'          => $subject[$i]
					);
				}
				/* For Loop End */
				$queryStatus = $this->db->insert_batch('user_qualification', $USERINPUT);
				if (isset($_FILES)) {
					$attachmentName = $this->_uploadFile();
				} else {
					$attachmentName = "";
				}
				$attachmentName = $this->_uploadFile();	
				//print_r($attachmentName);exit;				
				/* Update Detail Data */
				$USERDETAILUPDATE = array(
					'enrolment_number'   => $enrollno,
					'father_name'        => $fathername,
					'mother_name'        => $mothername,
					'gender'             => $gender,
					'category'           => $category,
					'correspond_address' => $cor_address,
					'city' 				=> $city,
					'state' 			=> $state,
					'pin_code' 			=> $pin_code,
					'landline' 			=> $landline,
					'user_image' 		=> $attachmentName,
					'agree_check' 		=> 1,
					'name_of_organization' 	  => $name_of_organization,
					'contact_detail_employer' => $contact_detail_employer,
					'desig_of_candidate'      => $desig_of_candidate,
					'date_of_joining'        => $cand_date_of_joining,
				);
				$USERTABLEUPDATE = array(
					'user_step' => 1,
				);
				/*  End Update Detail Data */
				if ($queryStatus == TRUE) {
					$queryUpdateStatus = $this->UserModel->updatedata('comm_user_detail', $USERDETAILUPDATE, array('fk_user_id' => $user_id_pk));
					$queryUserStepStatus = $this->UserModel->updatedata('comm_users', $USERTABLEUPDATE, array('user_id' => $user_id_pk));
					// echo $this->db->last_query();exit;
					if ($queryUpdateStatus == TRUE) {


						//Email Configuration
						$emailMessage = "";
						$emailMessage .= '<p>Thanks ' .$this->session->userdata['AUTH_LOCAL_USER']['USER_NAME'] . ',</p>';
						$emailMessage .= '<p>Your PGDEM Registration Successfully completed .</p>';
						$emailMessage .= '<p>We\'ll get back to you soon with you LMS Crdentials !!</p>';
						$emailMessage .= '<p><b>Regards,</b></p>';
						$emailMessage .= '<p>Admin EPCO</p>';
		
						$EmailDetails = array(
							'email_to' => encrypt_decrypt("decrypt", $this->session->userdata['AUTH_LOCAL_USER']['USER_EMAIL']),
							'subject' => 'PGDEM Registration ',
							'message' => $emailMessage,
							'email_from' => 'Admin EPCO'
						);


				$msg = "";
				
					$getEmailInfo = $this->sendEmail($EmailDetails); //core/MY_Controller/Email Function					if ($getEmailInfo['status'] != TRUE) {
						$msg .= " and " . $getEmailInfo['message'];

						

						redirect('register');
					}
					
				}
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'danger', 'message' => 'Try again later!'));
				redirect('register');
			}
		}
	}

	public function registerview()
	{
		//Create dynamic Breadcrumbs
		$this->breadcrumbs->push($this->lang->line('registration_status'), '/');
		$this->breadcrumbs->unshift('<i class="fa fa-home"></i>', '/');
		$session_mail = '';
		$session_mail = encrypt_decrypt("decrypt", $this->session->userdata['AUTH_LOCAL_USER']['SERIALNO']);
		$filter = array('um.user_id' => $session_mail);
		//print_r($filter);
		$this->data['userDataList'] = $this->UserModel->getSingleList($filter);
		$this->data['DistrictList'] = $this->UserModel->GenerateDDList('comm_district', 'DistrictCensusCode', 'district_name', '--SELECT DISTRICT--', array('enabled' => 1));
		$this->data['userInfo'] = $this->UserModel->getAllUserInfo($this->__table, $filter);
		$user_id_wise_qual_info = $this->data['userInfo']->user_id;
		if (!empty($this->data['userInfo'])) {
			
			$this->data['userQualificationInfo'] = $this->UserModel->getUserQualificationInfo('user_qualification', array('fk_user_id' => $user_id_wise_qual_info));
		}

		if( $this->data['userInfo']->user_step==1){
		//	redirect('register');
		}
		
		$this->front_view('user/login/register_complete', $this->data);
	} //end signout function

	protected function _uploadFile($preUploadedFile = "")
	{
		//echo"<pre>";print_r($_FILES);exit;

		$this->_config['file_name'] = date("Y-m-d_His").'_UserProfile';
		$this->load->library('upload', $this->_config);
		$this->upload->initialize($this->_config);
		$FILE_NAME = "";
		$FULL_PATH = "";
		if (isset($_FILES['file']['name']) == TRUE && trim($_FILES['file']['name']) != "") {
			if ($this->upload->do_upload('file')) {
				$data = $this->upload->data();
				$FILE_NAME = $data['file_name'];
				$FULL_PATH = $data['full_path'];
				if (trim($preUploadedFile) != "" && trim($preUploadedFile) != NULL) {
					@unlink("./uploads/admision/" . trim($preUploadedFile));
				}
			} else {
				$this->session->set_flashdata('AppMessage', array('class' => 'warning', 'message' => $this->upload->display_errors()));
			}
		} else {
			$FILE_NAME = $preUploadedFile;
		}
		return $FILE_NAME;
	} //end uploadFile function

}// end User class