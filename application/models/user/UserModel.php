<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	} //end constructor

	private $id;
	private $server_password = NULL;

	public function login($username, $password, $validKey, $status, $logingAtmpt, $loginMinute)
	{
		$message = array('IS_AUTH_USER' => "invalid", 'USERDATA' => array());
		$this->session->unset_userdata('loginCount');
		$sql = "SELECT um.* FROM comm_users um WHERE  um.username = ? AND um.user_status = ? AND um.email_verify_status =? ";
		$query = $this->db->query($sql, array($username, $status, 1));
		if ($query->num_rows() == 0) {
			$message['IS_AUTH_USER'] = "invalid";
			$message['AUTH_ERROR_MESSAGE'] = "Either username or password is invalid or account is not activated.";
			return $message;
		}
		$row = $query->row();
		//$this->server_password = hash('sha256',hash('sha256',$validKey).$row->user_password);
		$this->server_password = $row->user_password;
		if ($query->num_rows() > 0 && $this->server_password == hash('sha256', $password)) {
			$chkLoginAtmpt = $this->db->get_where("comm_users", array('username' => $username, 'user_failed_login_attempts >= ' => $logingAtmpt, 'user_last_failed_login > ' => 'DATE_SUB(NOW(), INTERVAL ' . $loginMinute . ' MINUTE)'));

			if ($chkLoginAtmpt->num_rows() > 0) {
				$this->session->set_userdata(array('login_block_time' => time()));
				$message['IS_AUTH_USER'] = "invalid";
				$message['AUTH_ERROR_MESSAGE'] = "Your account has been locked! Please try after 10 minutes.";
				return $message;
			} else {
				if ($row->user_status == 1) {
					if ($this->session->has_userdata('loginCount') == TRUE) {
						$this->session->unset_userdata('loginCount');
					}
					$DATAINPUT = array(
						'user_failed_login_attempts' => 0, 'user_last_failed_login' => '',
						'user_last_login' => date('Y-m-d H:i:s')
					);
					$FILTER = array('username' => $username, 'user_status' => 1);
					$LOG_ACTIVITY = '';
					$IS_LOG_CREATE = FALSE;
					$this->updatedata("comm_users", $DATAINPUT, $FILTER, $LOG_ACTIVITY, $IS_LOG_CREATE);

					$message['IS_AUTH_USER'] = "valid";
					$message['USERDATA'] = $row;

					return $message;
				} else {
					$message['IS_AUTH_USER'] = "invalid";
					$message['AUTH_ERROR_MESSAGE'] = "Your Account has been disabled by administrator.";
					return $message;
				} //end check login status else
			} //end check login attempt else

		} else {

			if ($this->session->has_userdata('loginCount') == TRUE) {

				$_SESSION['loginCount']++; //YOU CAN ALSO USE THIS METHOD			  

				$DATAINPUT = array('user_failed_login_attempts' => $this->session->userdata('loginCount'), 'user_last_failed_login' => date('Y-m-d H:i:s'));
				$FILTER = array('username' => $username, 'user_status' => 1);
				$LOG_ACTIVITY = '';
				$IS_LOG_CREATE = FALSE;
				$this->updatedata("comm_users", $DATAINPUT, $FILTER, $LOG_ACTIVITY, $IS_LOG_CREATE);

				if ($this->session->userdata('loginCount') > 2) {
					$this->session->set_userdata(array('login_block_time' => time()));
					$message['IS_AUTH_USER'] = "invalid";
					$message['AUTH_ERROR_MESSAGE'] = "Your account has been locked! Please try after 10 minutes.";
					return $message;
				} else {
					$message['IS_AUTH_USER'] = "invalid";
					$message['AUTH_ERROR_MESSAGE'] = "Please enter valid username & password!!";
					return $message;
				}
			} else {

				$this->session->set_userdata(array('loginCount' => 1));

				$DATAINPUT = array('user_failed_login_attempts' => 1, 'user_last_failed_login' => date('Y-m-d H:i:s'));
				$LOG_ACTIVITY = '';
				$IS_LOG_CREATE = FALSE;
				$this->updatedata("comm_users", $DATAINPUT, array('username' => $username, 'user_status' => 1), $LOG_ACTIVITY, $IS_LOG_CREATE);

				$message['IS_AUTH_USER'] = "invalid";
				$message['AUTH_ERROR_MESSAGE'] = "Invalid login information !! ";
				return $message;
			} //end check loginCount session else part			

		}
	} // end login function

	public function getSingleList($filter = array(), $order = array())
	{
		if (count($filter) > 0) {
			$this->db->select('um.*,ud.*');
			$this->db->from('comm_users um');
			$this->db->join('comm_user_detail ud', 'ud.fk_user_id = um.user_id', 'left');
			$this->db->where($filter);
			if (count($order) > 0) {
				$this->db->order_by($order);
			}
			$query = $this->db->get();
			//print_r($this->db->last_query());
			// exit;
			if ($query->num_rows() > 0) {
				return $query->row();
			}
		} //end check condition		
		return FALSE;
	} // end getSingleList function

	public function getRecord($table = "", $filter = array())
	{
		if (trim($table) != "" && trim($table) != null && count($filter) > 0) {
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			}
		} //end check condition		
		return FALSE;
	} // end getSingleList function

	public function getForgotRecord($filter = array())
	{
		if (count($filter) > 0) {
			$sql = "SELECT * FROM comm_users WHERE MD5(user_email) = ? AND MD5(user_pass_verify_code) = ? AND user_status = ? AND TIMESTAMPDIFF(MINUTE,exp_verify_date,?)<=?";
			$query = $this->db->query($sql, $filter);
			if (count($query->row_array()) > 0) {
				return $query->row();
			}
		} //end check condition		
		return FALSE;
	} // end getSingleList function

	public function getAllList($table = "", $filter = array(), $order = array())
	{
		if (trim($table) != "" && trim($table) != null) {
			$this->db->select('um.*');
			$this->db->from('comm_users um');
			if (count($filter) > 0) {
				$this->db->where($filter);
			}
			if (count($order) > 0) {
				$this->db->order_by($order);
			}
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		} //end check condition		
		return array();
	} // end getAllList function

	public function getUserInfo($table, $filter = array())
	{
		if (trim($table) != "" && trim($table) != null && count($filter) > 0) {
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			$this->db->order_by('user_id', 'ASC');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			}
		} //end check condition		
		return FALSE;
	} // end getSingleList function
	/* User Data With User Detail */
	public function insertUserdata($user = array(), $USERDETAILINPUT = array())
	{
		if (count($user) > 0) {
			$this->db->trans_begin();
			$query_status1 = $this->db->insert('comm_users', $user);
			$userId = $this->db->insert_id();
			if (count($USERDETAILINPUT) > 0) {
				$USERDETAILINPUT['fk_user_id'] = $userId;
				$queryString2 = $this->db->insert('comm_user_detail', $USERDETAILINPUT);
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} else {
				$this->db->trans_commit();
				//  $this->_createLog(isset($queryString2)?$queryString2:$queryString1,'Individual user details successfully inserted.',TRUE,$userId,'user');
				return TRUE;
			}
		} else {
			return FALSE;
		} //end count fiter and record
	}
	/* End */


	public function getAllUserInfo($table = "", $filter = array(), $order = array())
	{
		if (trim($table) != "" && trim($table) != null) {
			$this->db->select('um.*,ud.*,dis.district_name as city');
			$this->db->from('comm_users um');
			$this->db->join('comm_user_detail ud', 'ud.fk_user_id = um.user_id', 'left');
			$this->db->join('comm_district dis', 'dis.DistrictCensusCode = ud.city', 'left');
			$this->db->join('user_qualification uq', 'uq.fk_user_id = um.user_id','left');
			if (count($filter) > 0) {
				$this->db->where($filter);
			}
			if (count($order) > 0) {
				$this->db->order_by($order);
			}
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->row();
			}
		} //end check condition		
		return array();
	} // end getAllList function
	public function getUserQualificationInfo($table = "", $filter = array(), $order = array())
	{

		if (trim($table) != "" && trim($table) != null) {
			$this->db->select('um.*,mq.title as title');
			$this->db->from('user_qualification um');
			$this->db->join('m_qualification mq', 'mq.id = um.qualification_id', 'left');
			if (count($filter) > 0) {
				$this->db->where($filter);
			}
			if (count($order) > 0) {
				$this->db->order_by($order);
			}
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		} //end check condition		
		return array();
	} // end getAllList function
}//end class UserModel