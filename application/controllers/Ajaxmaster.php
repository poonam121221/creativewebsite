<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxmaster extends CI_Controller{
	
	private $__result = array();
	private $__table = "";
	private $__id = NULL;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/DashboardModel');
		//$this->load->helper('security');
	}//end constructor
	
	public function index(){
		redirect('/');
	}
	
	public function getModuleList(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	  	
	  		$this->__table = "comm_menu_modules";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  		$html ="<option value=''>--select--</option>";
	  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('module_id,module_name');
			  $this->DashboardModel->db->order_by('module_url','asc');	
			  $this->__result = $this->DashboardModel->db->get_where($this->__table)->result();
			  
			  foreach($this->__result as $row){
			  	$html .="<option value='".html_escape($row->module_id)."'>".html_escape(stripslashes2(ucwords($row->module_name)))."</option>";
			  }//end foreach
				
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getModuleList function
	
	public function getPageList(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	  	
	  		$this->__table = "comm_pages";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  		$html ="<option value=''>--select--</option>";
	  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('page_id,page_url');
			  $filter = array('page_status'=>1,'is_delete'=>0);	
			  $this->DashboardModel->db->order_by('page_url','asc');
			  $this->__result = $this->DashboardModel->db->get_where($this->__table,$filter)->result();
			  
			  foreach($this->__result as $row){
			  	$html .="<option value='".html_escape($row->page_id)."'>".html_escape($row->page_url)."</option>";
			  }//end foreach
				
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getModuleList function
	
	public function getContactDesignationList(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  		$this->__table = "comm_contact_designation";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  		$html = "";
	  			  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('cd.d_id, cd.designation_en');	
			  $this->DashboardModel->db->join('comm_contact_category ccc', 'ccc.cat_id = cd.cat_id','left');
			  
			  $filter = array('cd.status'=>1,'ccc.cat_status'=>1,'cd.cat_id'=>$this->__id);
			  
			  $this->__result = $this->DashboardModel->db->get_where($this->__table.' cd',$filter)->result();
			  $html .="<option value=''>-- SELECT DESIGNATION --</option>";

			  //print_r($this->db->last_query());
			  
			  if(count($this->__result)>0){			  	
			  	foreach($this->__result as $row){
			  	  $html .="<option value='".html_escape($row->d_id)."'>".html_escape($row->designation_en)."</option>";
			    }//end foreach
			  }//end check array count
			  
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getModuleList function
	
	public function getAuthFunctionList(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	  	
	  	 $this->__table = "comm_auth_controller_function";
	  	 $this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  	 $html ="<option value=''>--select--</option>";
	  		
	  	 if($this->__id!=0){
			  
		  $this->DashboardModel->db->select('menu_id,auth_function_name');	
		  $rec = $this->DashboardModel->db->get_where($this->__table,array('menu_id'=>$this->__id))->row();
			  
			  if(isset($rec) && is_object($rec)){
				$function_acl = $rec->auth_function_name;	
			  	$acl_array = explode(',',$function_acl);
			  	  	 
			  	foreach($acl_array as $val){
			      echo '<label>'.$val;
			      echo '&nbsp;<input type="checkbox" name="function_name[]" value="'.$val.'"/>';
			      echo '</label>&nbsp;';   	
			    }//end foreach			 
			  }	
		  }//end check id
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getAuthFunctionList function
	
	public function checkUsername(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	  	
	  		$this->__table = "comm_users";
	  		$username = strtoupper(cleanQuery(trim($this->input->post('uname'))));
	  		
	  		$this->DashboardModel->db->select('count(1) as count_reg');	
		    $rec = $this->DashboardModel->db->get_where($this->__table,array('UPPER(user_username)'=>$username))->row();
	  		
	  		if(isset($rec) && is_object($rec) && $rec->count_reg>0){
				echo "false";
			}else{
				echo "true";
			}	  		
	  		
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end checkUsername function
	
	public function checkUserEmail(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	  	
	  		$this->__table = "comm_users";
	  		$user_email = strtolower(cleanQuery(trim($this->input->post('email_id'))));
	  		
	  		$this->DashboardModel->db->select('count(1) as count_email');	
		    $rec = $this->DashboardModel->db->get_where($this->__table,array('LOWER(user_email)'=>$user_email))->row();
	  		
	  		if(isset($rec) && is_object($rec) && $rec->count_email > 0){
				echo "false";
			}else{
				echo "true";
			}	  		
	  		
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end checkUserEmail function
	
	public function checkUserMobile(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
	  	
	  		$this->__table = "comm_users";
	  		$user_mobile = cleanQuery(trim($this->input->post('mobile_number')));
	  		
	  		$this->DashboardModel->db->select('count(1) as count_mobile');	
		    $rec = $this->DashboardModel->db->get_where($this->__table,array('user_mobile'=>(float)$user_mobile))->row();
		    //print_r($this->db->last_query());

	  		if(isset($rec) && is_object($rec) && $rec->count_mobile > 0){
				echo "false";
			}else{
				echo "true";
			}	  		
	  		
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end checkChapterMobile function
	
	public function getDivisionByState(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  		$this->__table = "comm_division";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  		$html = "";
	  			  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('divisionCode, divisionNameEn');			  
			  $filter = array('sid'=>$this->__id);
			  
			  $this->__result = $this->DashboardModel->db->order_by('divisionNameEn', 'ASC')->get_where($this->__table,$filter)->result();
			 
			  $html .="<option value=''>-- SELECT DIVISION --</option>";
			  
			  if(count($this->__result)>0){			  	
			  	foreach($this->__result as $row){
			  	  $html .="<option value='".html_escape($row->divisionCode)."'>";
			  	  $html .=html_escape($row->divisionNameEn);
			  	  $html .="</option>";
			    }//end foreach
			    
			  }//end check array count
			  
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getDivisionByState function

	public function getDistrictByState(){
	  	
	 if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  $this->__table = "comm_district";
	  $this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  			  		
	  if($this->__id!=0){
			  
		$this->DashboardModel->db->select('district_code, district_name');			  
		$filter = array('stateId'=>$this->__id);
		$html = "";
			  
		$this->__result = $this->DashboardModel->db->order_by('district_name', 'ASC')->get_where($this->__table,$filter)->result();
		$html .="<option value=''>-- SELECT DISTRICT --</option>";
			  
		if(count($this->__result)>0){			  	
		 foreach($this->__result as $row){
			$html .="<option value='".html_escape($row->district_code)."'>";
			$html .=html_escape($row->district_name);
			$html .="</option>";
		 }//end foreach
		}//end check array count
			  			  
		}//end check id
			echo $html;
	  }else{
	  	show_404();	
	  }//end check post method
	  	
	}//end getDistrictByState function
	
	public function getDistrictByDivsion(){
	  	
	 if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  $this->__table = "comm_district";
	  $this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  			  		
	  if($this->__id!=0){
			  
		$this->DashboardModel->db->select('district_code, district_name');			  
		$filter = array('division_code'=>$this->__id);
		$html = "";
			  
		$this->__result = $this->DashboardModel->db->order_by('district_name', 'ASC')->get_where($this->__table,$filter)->result();
		$html .="<option value=''>-- SELECT DISTRICT --</option>";
			  
		if(count($this->__result)>0){			  	
		 foreach($this->__result as $row){
			$html .="<option value='".html_escape($row->district_code)."'>";
			$html .=html_escape($row->district_name);
			$html .="</option>";
		 }//end foreach
		}//end check array count
			  			  
		}//end check id
			echo $html;
	  }else{
	  	show_404();	
	  }//end check post method
	  	
	}//end getDistrictByDivsion function
	
	public function getBlockByDistrict(){
	  	
	  if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  	$this->__table = "comm_block";
	  	$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  	$html = "";
	  			  		
	  	if($this->__id!=0){
			  
		 $this->DashboardModel->db->select('blockLGDCode, block_name');			  
		 $filter = array('district_code'=>$this->__id,'enabled'=>1);
			  
		 $this->__result = $this->DashboardModel->db->order_by('block_name', 'ASC')->get_where($this->__table,$filter)->result();
		 $html .="<option value=''>-- SELECT BLOCK --</option>";
			  
		 if(count($this->__result)>0){			  	
		  foreach($this->__result as $row){
			$html .="<option value='".html_escape($row->blockLGDCode)."'>";
			$html .=html_escape($row->block_name);
			$html .="</option>";
		  }//end foreach
	    }//end check array count
			  
	 }//end check id
		echo $html;
	 }else{
	  	show_404();	
	 }//end check post method
	  	
	}//end getBlockByDistrict function
	
	public function getGrampanchayatByDistrict(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  		$this->__table = "comm_gram_panchayat";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  		$html = "";
	  			  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('gp_code, gp_name');			  
			  $filter = array('district_code'=>$this->__id,'enabled'=>1);
			  
			  $this->__result = $this->DashboardModel->db->order_by('gp_name', 'ASC')->get_where($this->__table,$filter)->result();

			  $html .="<option value=''>-- SELECT GRAM PANCHAYAT --</option>";
			  
			  if(count($this->__result)>0){			  	
			  	foreach($this->__result as $row){
			  	  $html .="<option value='".html_escape($row->gp_code)."'>";
			  	  $html .=html_escape($row->gp_name);
			  	  $html .="</option>";
			    }//end foreach
			  }//end check array count
			  			  
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	}
	//end getGrampanchayatByDistrict function
	
	public function getGrampanchayatByBlock(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  		$this->__table = "comm_gram_panchayat";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  		$html = "";
	  			  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('gp_code, gp_name');			  
			  $filter = array('block_code'=>$this->__id,'enabled'=>1);
			  
			  $this->__result = $this->DashboardModel->db->order_by('gp_name', 'ASC')->get_where($this->__table,$filter)->result();
			  $html .="<option value=''>-- SELECT GRAM PANCHAYAT --</option>";
			  
			  if(count($this->__result)>0){			  	
			  	foreach($this->__result as $row){
			  	  $html .="<option value='".html_escape($row->gp_code)."'>";
			  	  $html .=html_escape($row->gp_name);
			  	  $html .="</option>";
			    }//end foreach
			  }//end check array count
			  			  
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getGrampanchayatByBlock function
	
	public function getVillageByDistrict(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  		$this->__table = "comm_village";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  			  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('villagecode_census, village_name');			  
			  $filter = array('district_code'=>$this->__id,'enabled'=>1,'villagecode_census IS NOT NULL'=>NULL);
			  $html = "";
			  
			  $this->__result = $this->DashboardModel->db->order_by('village_name', 'ASC')->get_where($this->__table,$filter)->result();
			  $html .="<option value=''>-- SELECT VILLAGE --</option>";
			  
			  if(count($this->__result)>0){			  	
			  	foreach($this->__result as $row){
			  	  $html .="<option value='".html_escape($row->villagecode_census)."'>";
			  	  $html .=html_escape($row->village_name);
			  	  $html .="</option>";
			    }//end foreach
			  }//end check array count
			  			  
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getVillageByDistrict function
	
	public function getVillageByBlock(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  		$this->__table = "comm_village";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  		$html = "";
	  			  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('villagecode_census, village_name');
			  $filter = array('block_code'=>$this->__id,'enabled'=>1,'villagecode_census IS NOT NULL'=>NULL);
			  
			  $this->__result = $this->DashboardModel->db->order_by('village_name', 'ASC')->get_where($this->__table,$filter)->result();
			  //print_r($this->DashboardModel->db->last_query());
			  //exit();
			  $html .="<option value=''>-- SELECT VILLAGE --</option>";
			  
			  if(count($this->__result)>0){			  	
			  	foreach($this->__result as $row){
			  	  $html .="<option value='".html_escape($row->villagecode_census)."'>";
			  	  $html .=html_escape($row->village_name);
			  	  $html .="</option>";
			    }//end foreach
			  }//end check array count
			  			  
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getVillageByGrampanchayat function
	
	public function getVillageByGrampanchayat(){
	  	
	  	if ($this->input->server('REQUEST_METHOD') === 'POST'){  
	  	
	  		$this->__table = "comm_village";
	  		$this->__id = (int)cleanQuery(trim($this->input->post('id')));
	  		$html = "";
	  			  		
	  		if($this->__id!=0){
			  
			  $this->DashboardModel->db->select('villagecode_census, village_name');			  
			  $filter = array('gp_code'=>$this->__id,'enabled'=>1,'villagecode_census IS NOT NULL'=>NULL);
			  
			  $this->__result = $this->DashboardModel->db->order_by('village_name', 'ASC')->get_where($this->__table,$filter)->result();
			  $html .="<option value=''>-- SELECT VILLAGE --</option>";
			  
			  if(count($this->__result)>0){			  	
			  	foreach($this->__result as $row){
			  	  $html .="<option value='".html_escape($row->villagecode_census)."'>";
			  	  $html .=$row->village_name;
			  	  $html .="</option>";
			    }//end foreach
			  }//end check array count
			  			  
			}//end check id
			echo $html;
	  	}else{
	  		show_404();	
	  	}//end check post method
	  	
	}//end getVillageByGrampanchayat function
	
}//end Ajaxmaster class