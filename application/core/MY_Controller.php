<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller
{
	public $data = array();	
	function __construct(){
		parent::__construct();
		$this->load->config('cms_config');
		$this->load->library(array('Breadcrumbs'));		
		$this->data['errors'] = array();
		$this->data['site_name_hi']  = $this->config->item('site_name_hi');
		$this->data['site_name_en']  = $this->config->item('site_name_en');
		$this->data['site_sub_name_hi']  = $this->config->item('site_sub_name_hi');
		$this->data['site_sub_name_en']  = $this->config->item('site_sub_name_en');
		$this->data['copy_right_en']    = $this->config->item('copy_right_en');
		$this->data['copy_right_hi']    = $this->config->item('copy_right_hi');
		$this->data['developed_by_en']    = $this->config->item('developed_by_en');
		$this->data['developed_by_hi']    = $this->config->item('developed_by_hi');
		$this->data['meta_title']    = $this->config->item('meta_title');
		$this->data['meta_keyword']  = $this->config->item('meta_keyword');
		$this->data['meta_desc']     = $this->config->item('meta_desc');
	}
	
	protected function isExists($table="",$condition=array()){
		if(trim($table)!="" && count($condition)>0)
		$query = $this->db->get_where(trim($table), $condition);
		$row = $query->row();	
		if($query-> num_rows() > 0){
			return TRUE;
		}else{
		    return FALSE;
		}
	}//end isExists function
	
	protected function emailAdminConfig(){
		
		$config = array();  
		$config['protocol']    = 'smtp';  
		$config['smtp_host']   = 'email.gov.in';  
		$config['smtp_user']   = 'institute.epco@mp.gov.in';  
		$config['smtp_pass']   = 'Eies@epco21';  
		$config['smtp_port']   = 465;  
		$config['smtp_crypto'] = 'ssl';
		$config['mailtype']    = 'html';
		$config['charset']     = 'utf-8';
		$config['email_from']  = 'Admin EPCO';//cusotm field for send name in form field of email		
		return $config;		
	}
	
	protected function emailAdminConfig1(){
		
		$config = array();  
		$config['protocol']    = 'smtp';  
		$config['smtp_host']   = 'smtp.gmail.com';  
		$config['smtp_user']   = 'nhmmpgov@gmail.com';  
		$config['smtp_pass']   = 'nhm@123456';  
		$config['smtp_port']   = 465;  
		$config['smtp_crypto'] = 'ssl';
		$config['mailtype']    = 'html';
		$config['charset']     = 'utf-8';
		$config['email_from']  = 'Admin EPCO';//cusotm field for send name in form field of email		
		return $config;		
	}
	
	/**
	* @Create Date 05-07-2017
	* @Function sendEmail
	* @param array('email_to'=>'','subject'=>'','message'=>'','email_from'=>'')
	* @return array() with status = boolean and message = String
	**/
	
	public function sendEmail($emaiConfig=array()){		
	 if(count($emaiConfig)>0 && isset($emaiConfig['email_to'])==TRUE && trim($emaiConfig['email_to'])!=""){
		return $this->_send_phpmailer_email($emaiConfig);			
	 }//End Email Check
	 
	  return array('status'=>FALSE,'message'=> 'Email is required field !');
	}//end function sendEmail
	
	protected function _send_codeigniter_email($emaiConfig=array()){
		  $this->load->library('email');
		  try { 		  				
			$EmailConfigInfo = $this->emailAdminConfig();						
			$ToEmail     = $emaiConfig['email_to'];
			$subject     = $emaiConfig['subject'];
			$message     = $emaiConfig['message'];
			
			if(isset($emaiConfig['email_from'])==TRUE && trim($emaiConfig['email_from'])!=""){
				$EmailConfigInfo['email_from'] = $emaiConfig['email_from'];
			}			
 
			$this->email->initialize($this->emailAdminConfig());				
			$this->email->set_newline("\r\n");  
			$this->email->from($EmailConfigInfo['smtp_user'], $EmailConfigInfo['email_from']);
			$this->email->to($ToEmail); 
			$this->email->subject($subject);
			$this->email->message($message);	

				if($this->email->send()){
					return array('status'=>TRUE,'message'=>'Email Successfully sent !!');
				}else{
					//show_error($this->email->print_debugger());
					//exit();
					return array('status'=>FALSE,'message'=> "Sorry, Error in your Email");
				}
			
			  } catch (Exception $e) {
				  //alert the user.
				  //var_dump($e->getMessage());
               return array('status'=>FALSE,'message'=> "Sorry, something went wrong. Please contact Administrator. ".$e->getMessage());
			  }//end catch
			
	}//end function sendEmail
	
	protected function _send_phpmailer_email($emaiConfig=array()) {
	
	  require_once APPPATH."/third_party/PHPMailer/PHPMailerAutoload.php";
	 		
	  try{
	  	
	  	$objMail = new PHPMailer;
	  	$ToCCEmail   = "";
	  	$ToBCCEmail   = "";
	  	
	  	$EmailConfigInfo = $this->emailAdminConfig();						
		$ToEmail     = $emaiConfig['email_to'];		
		$subject     = $emaiConfig['subject'];
		$message     = $emaiConfig['message'];
		
		if(empty($ToEmail)){
			$ToEmail = $EmailConfigInfo['smtp_user'];//requested email is not found
		}
		
		if(isset($emaiConfig['email_to_cc'])){
		  $ToCCEmail   = $emaiConfig['email_to_cc'];
		}
		if(isset($emaiConfig['email_to_bcc'])){
		  $ToBCCEmail  = $emaiConfig['email_to_bcc'];
		}
			
		if(isset($emaiConfig['email_from'])==TRUE && trim($emaiConfig['email_from'])!=""){
			$EmailConfigInfo['email_from'] = $emaiConfig['email_from'];
		}

        $objMail->isSMTP();
	    $objMail->Host = $EmailConfigInfo['smtp_host'];
	    $objMail->SMTPAuth = true; 
	    $objMail->Username = $EmailConfigInfo['smtp_user'];
	    $objMail->Password = $EmailConfigInfo['smtp_pass'];
	    $objMail->SMTPSecure = $EmailConfigInfo['smtp_crypto'];
	    $objMail->Port = $EmailConfigInfo['smtp_port'];
	    $objMail->isHTML(true);
	    $objMail->Subject = $subject;
        $objMail->Body = $message;
      
        $objMail->setFrom($EmailConfigInfo['smtp_user'], $EmailConfigInfo['email_from']);
		
		$toEmailAddresses = explode(',', $ToEmail);
		foreach ($toEmailAddresses as $emailTo) {
		 $objMail->addAddress($emailTo);// Add a recipient and Name is optional
		}

	     //$objMail->addReplyTo('test@mp.gov.in',
	    if(trim($ToCCEmail)!=""){
			$objMail->addCC($ToCCEmail);
		}
		if(trim($ToBCCEmail)!=""){
		  $toBccemailAddresses = explode(',', $ToBCCEmail);
		  foreach ($toBccemailAddresses as $emailBcc) {
		    $objMail->addBCC($emailBcc);// Add a recipient and Name is optional
		  }
		}   
	    
	    //$objMail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
	    //$objMail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
		
 	    if(!$objMail->send()) {
			show_error($objMail->ErrorInfo);
			exit();
			return array('status'=>FALSE,'message'=> "Sorry, error in your email");
	    }else {
			return array('status'=>TRUE,'message'=>'Email sent successfully !!');
	    } 
	  	
	  }catch (Exception $e) {
		 //alert the user.
		 var_dump($e->getMessage());
		 return array('status'=>FALSE,'message'=> "Sorry, something went wrong. Please contact with FoMP Administrator");
	 }//end catch
      
  }//end send_phpmailer_email	
	
  protected function post_to_url($url, $data) {
	   $fields = '';
	   foreach($data as $key => $value) { 
		  $fields .= $key . '=' . $value . '&'; 
	   }
	   rtrim($fields, '&');
	   $post = curl_init();
	   curl_setopt($post, CURLOPT_URL, $url);
	   curl_setopt($post, CURLOPT_POST, count($data));
	   curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
	   curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
	
	   $result = curl_exec($post);
	   curl_close($post);
	   $result_status = explode(',',$result,1);
	   $status = ($result_status[0]==402)?TRUE:FALSE;

	   return $status;
	}
	
	protected function smsapi($umobile, $content,$service_type=0,$bulkmobno=""){
	
	/**
	* @var username => your assigned username(for example:  "username" => "XXXX")
	* @var password => your password(for example:  "password" => "XXXX")
	* @var senderid => your senderID(for example:  "senderid" => "XXXX")
	* *Note*  for single sms enter  "singlemsg" , for bulk  enter "bulkmsg"
	* @var smsservicetype => your smsservicetype(for example:  "senderid" => "singlemsg"/"bulkmsg")
	* @var mobileno => xxxxxxxxxx //only one mobile number
	* @var bulkmobno => xxxxxxxxxx 
	* *Note* enter the mobile numbers separated by commas, in case of bulk sms otherwise leave it blank
	* @var content=>XXXXXXXX XXXXX //type the message
	**/
	 $service_type = (int)$service_type;
	 
	 $data = array(
		   "username" => 'DITMP-TRIFAC',
		   "password" => 'mptrifac@123',
		   "senderid" => 'TRIFAC',
		   "smsservicetype" => ($service_type==0)?"singlemsg":"bulkmsg",
		   "mobileno" =>(float)$umobile,
		   "bulkmobno" => $bulkmobno,
		   "content"  => $content
	 );	
	 return $this->post_to_url("http://msdgweb.mgov.gov.in/esms/sendsmsrequest", $data);
	}//end smsapi function
	
	protected function _native_json_curl($data=array(),$url="",$method="POST"){
	
	try{
		
	$data_string = json_encode($data);
	
    $ch = curl_init($url);                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);                                                                    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER,
     array('Content-Type: application/json','Content-Length: ' . strlen($data_string))
    );  
                                                                  
    $result = curl_exec($ch);
    curl_close($ch);
 
    return json_decode($result);
    
    }catch (Exception $e) {
	 //alert the user.
	 //var_dump($e->getMessage());
	 //exit;
	 return false;
	 }//end catch
   }
	
}//end class My_Controller
