<?php
class MY_Form_validation extends CI_Form_validation {
	
	/**
	* This is custom Form validation  library
	* 
	* @return true or false and set validation message
	*/
	
	protected $CI = NULL;

    public function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
    }
    
    public function check_unique($value, $params){
    	
    	//$CI = get_instance();
    	
		list($table, $field, $id_name, $current_id) = explode(".", $params);
		
		if($current_id==FALSE || $current_id==NULL || trim($current_id)==''){
			
			$query = $this->CI->db->get_where($table, array($field => $value), 1, 0);
	        if ($query->num_rows() === 0) {
	            return TRUE;
	        }
			$this->CI->form_validation->set_message('check_unique', "Sorry, that %s is already being used.");
	        return FALSE;
		}else{			
			$this->CI->db->select();
			$this->CI->db->from($table);
			$this->CI->db->where($field, $value);
			$this->CI->db->limit(1);
			$query = $this->CI->db->get();

		    if ($query->row() && $query->row()->$id_name != $current_id)
		    {
		      $this->CI->form_validation->set_message('check_unique', "Sorry, that %s is already being used.");	
		       return FALSE;
		    }
		   return TRUE; 
		}
	}//end check_unique function
	
	public function check_date($str){
        if (!preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/',$str)){
            $this->CI->form_validation->set_message('check_date', ' %s should be valid date.(DD-MM-YYYY)');
            return FALSE;
       }else{
       	 return TRUE; 
       }
    }//end check_date (YYYY-MM-DD)
    
    public function check_date_time($str){
        if (!preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4} ([0-1][0-9]|[2][0-3]):([0-5][0-9])$/',$str)){
            $this->CI->form_validation->set_message('check_date', ' %s should be valid date.(DD-MM-YYYY HH:MM)');
            return FALSE;
       }else{
       	 return TRUE; 
       }
    }//end check_date_time (YYYY-MM-DD HH:MM)
    
    public function date_greater_than_equal($value,$params){
    	if(isset($this->_field_data[$params], $this->_field_data[$params]['postdata'])){
			$start_date = date_convert($this->_field_data[$params]['postdata'],'Y-m-d h:i');
			$end_date   = date_convert($value,'Y-m-d h:i');	
			if($end_date>=$start_date){
				return TRUE;
			}else{
				$this->CI->form_validation->set_message('date_greater_than_equal', '%s should be greater than or equal to start date !');
				return FALSE;
			}		
		}else{
			$this->CI->form_validation->set_message('date_greater_than_equal', 'Please pass valid field in %s !');
			return FALSE;
		}
   
    }//end date_greater_than_equal
    
    public function date_greater_than($value,$params){
    	if(isset($this->_field_data[$params], $this->_field_data[$params]['postdata'])){
			$start_date = date_convert($this->_field_data[$params]['postdata'],'Y-m-d h:i:s');
			$end_date   = date_convert($value,'Y-m-d h:i');	
			
			if($end_date>$start_date){
				return TRUE;
			}else{
				$this->CI->form_validation->set_message('date_greater_than', '%s should be greater than start date !');
				return FALSE;
			}
						
		}else{
			$this->CI->form_validation->set_message('date_greater_than', '%s should be greater than start date !');
			return FALSE;
		}
   
    }//end date_greater_than
    
    public function check_captcha($str){
		
		if(trim($str)==trim($this->CI->session->userdata('word'))){
			return TRUE;
		}else{
			$this->CI->form_validation->set_message('check_captcha', 'Security code does not match!');
			return FALSE;
		}
	}//end check_captcha function
	
	public function valid_pass_pattern($value) {
		
	    if (!preg_match_all('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[0-9a-zA-Z!@#$%^&*?~]{6,}$/', $value)){
	    	$this->form_validation->set_message('valid_pass_pattern','');
	    	$this->CI->form_validation->set_message('valid_pass_pattern', 'Minimum length of %s should be 6 with 1 capital letter, 1 small letter , 1 number and optional following special characters !@#$%^&*?~');
			return FALSE;
		}
	    return TRUE;

   }//end valid_pass_pattern function
	
    public function alpha_underscore($str){
        if (!preg_match('/^[a-zA-Z_]*$/',$str)){
            $this->CI->form_validation->set_message('alpha_underscore', 'Please enter Albhabet and Underscore only in %s');
            return FALSE;
       }else{
       	 return TRUE; 
       }
    }//end alpha_underscore
    
    public function alphanum_underscore($str){
        if (!preg_match('/^[a-zA-Z0-9_]*$/',$str)){
            $this->CI->form_validation->set_message('alphanum_underscore', 'Please enter Albhabet, Number and Underscore only in %s');
            return FALSE;
       }else{
       	 return TRUE; 
       }
    }//end alphanum_underscore
    
    public function alphanum_hyphen_underscore($str){
        if (!preg_match('/^[a-zA-Z0-9-_]*$/',$str)){
            $this->CI->form_validation->set_message('alphanum_hyphen_underscore', 'Please enter character, number, hyphen and underscore in %s field');
            return FALSE;
       }else{
       	 return TRUE; 
       }
    }//end alphanum_underscore
	
    public function valid_country($val){
  	
  	$CI = get_instance();
  	$country_id = (int)$val;
  	$coutryTbl = "comm_countries";
  	$filter = array();
  	
  	if($country_id!=0){
  		
  	  $filter = array('id'=>$country_id);
  	  $CI->db->select('count(1) as total_country');
  	  $CI->db->from($coutryTbl);
      $CI->db->where($filter);
      $query = $CI->db->get();
      
	  if ($query->num_rows()>0 && $query->row()->total_country==1) {
	   return TRUE;
	  }else{
	   $CI->form_validation->set_message('valid_country', 'This country ID does not exist.');
	   return FALSE;
	  }
	
	}else{
		$CI->form_validation->set_message('valid_country', 'Country ID should be valid.');
		return FALSE;
	}
	
  }//end valid_country
  
    public function valid_state($val,$params=array()){
  	
  	list($country_id) = explode("||", $params);
	$country_id = (int)$country_id;
  	$state_id = (int)$val;
  	
  	$coutryTbl = "comm_countries";
  	$stateTbl  = "comm_states";
  	$filter = array();
  	
  	if($state_id==9999){
		return TRUE;
	}else if($country_id!=0 && $state_id!=0){
  		
  	  $filter = array('c.id'=>$country_id,'s.sid'=>$state_id);
  	  $this->CI->db->select('count(1) as total');
  	  $this->CI->db->from($stateTbl.' s');
  	  $this->CI->db->join($coutryTbl.' c', 's.country_id = c.id');
      $this->CI->db->where($filter);
      $query = $this->CI->db->get();
      
	  if($query->num_rows()>0 && $query->row()->total==1){
	   return TRUE;
	  }else{
	   $this->CI->form_validation->set_message('valid_state', 'Given state ID and country ID combination is invalid.');
	   return FALSE;
	  }
	
	}else{
		$this->CI->form_validation->set_message('valid_state', 'Country ID and state ID should be valid.');
		return FALSE;
	}
	
  }//end valid_state
  
    public function valid_city($val,$params=array()){
  	
  	list($country_id,$state_id) = explode("||", $params);
	$country_id = (int)$country_id;
  	$state_id   = (int)$state_id;
  	$city_id    = (int)$val;
  	
  	$table = "v_country_state_city";
  	$filter = array();
  	
  	if($city_id==99999){
		return TRUE;
	}else{
	
		$filter = array('id'=>$country_id,'sid'=>$state_id,'cid'=>$city_id);
	  	$this->CI->db->select('count(1) as total');
	  	$this->CI->db->from($table);
	    $this->CI->db->where($filter);
	    $query = $this->CI->db->get();
		
		if($query->num_rows()>0 && $query->row()->total==1){
		   return TRUE;
		}else{
		   $this->CI->form_validation->set_message('valid_city', 'Given city ID, state ID and country ID combination is invalid.');
		   return FALSE;
		}
		
	}
	
  }//end valid_city
  
}//end MY_Form_validation class


/**
*Sample password checking regular expresion  
* 
Minimum eight characters, at least one letter and one number:

"^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
Minimum eight characters, at least one letter, one number and one special character:

"^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$"
Minimum eight characters, at least one uppercase letter, one lowercase letter and one number:

"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:

"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}"
Minimum eight and maximum 10 characters, at least one uppercase letter, one lowercase letter, one number and one special character:

"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}"

//Password length should be 6 with 1 captal latter, 1 small latter , 1 number and 1 special character(!@#$%^&*?~)
'/^.*(?=.{6,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*?~]).*$/'
**/