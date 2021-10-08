<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MemberModel extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}//end constructor
	
	public function getSingleList($table="",$filter=array()){
		
		if(count($filter)>0){
			$this->db->select('u.*,c.sortname,c.country_name,c.phonecode,c.state_name,c.city_name,cc.country_name as country_issue_name,prc.country_name as pr_country_issue_name,mp.contact_id, mp.contact_name, mp.contact_father_or_husband, mp.contact_aadhaar, mp.contact_email,ep.edu_pro_id, ep.degree, ep.institute_name, ep.additional_certificates,ep.area_of_interest, ep.profile_summary, ep.work_experience, ep.current_organization, ep.designation, ep.expert_area,chp.chapter_name,(CASE WHEN (chp.fomp_id=u.fomp_id) THEN 1 ELSE 0 END) AS is_chairman');
			
			$this->db->from($table.' u');
			$this->db->join('v_country_state_city c', 'c.cid = u.city_id','left');
			$this->db->join('comm_countries cc', 'cc.id = u.country_issue_id','left');
			$this->db->join('comm_countries prc', 'prc.id = u.pr_country_issue_id','left');
			$this->db->join('fomp_mp_contacts mp', 'mp.user_id = u.user_id','left');
			$this->db->join('fomp_education_profession ep', 'ep.user_id = u.user_id','left');
			$this->db->join('comm_chapter chp', 'chp.chapter_id = u.chapter_id','left');
			$this->db->where($filter);
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	public function getRecord($table="",$filter=array()){
		
		if(count($filter)>0 && trim($table)!=""){
			$this->db->from($table);
			$this->db->where($filter);
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	public function getAllList($table="", $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('u.*,c.sortname,c.country_name,c.phonecode,c.state_name,c.city_name,cc.country_name as country_issue_name,prc.country_name as pr_country_issue_name,mp.contact_id, mp.contact_name, mp.contact_father_or_husband, mp.contact_aadhaar, mp.contact_email,ep.edu_pro_id, ep.degree, ep.institute_name, ep.additional_certificates,ep.area_of_interest, ep.profile_summary, ep.work_experience, ep.current_organization, ep.designation, ep.expert_area,chp.chapter_name,(CASE WHEN (chp.fomp_id=u.fomp_id) THEN 1 ELSE 0 END) AS is_chairman');
			
			$this->db->from($table.' u');
			$this->db->join('v_country_state_city c', 'c.cid = u.city_id','left');
			$this->db->join('comm_countries cc', 'cc.id = u.country_issue_id','left');
			$this->db->join('comm_countries prc', 'prc.id = u.pr_country_issue_id','left');
			$this->db->join('fomp_mp_contacts mp', 'mp.user_id = u.user_id','left');
			$this->db->join('fomp_education_profession ep', 'ep.user_id = u.user_id','left');
			$this->db->join('comm_chapter chp', 'chp.chapter_id = u.chapter_id','left');
			if(count($filter)>0){
				$this->db->where($filter);
			}
			if(count($order)>0){
			  foreach($order as $key=>$val){
			  	 $this->db->order_by($key,$val);
			  }				
			}
			
			$query = $this->db->get();
			//print_r($this->db->last_query());
	        //exit();
	        
			if($query->num_rows()>0){
				
				return $query->result_array();
			}
			
		}//end check condition		
		return array();
		
	}// end getAllList function
	
	public function getAjaxRowsCount($params = array(), $filter=array()){
		if(array_key_exists("table",$params)){
			
	        $this->db->select('count(1) as total_row');
	        $this->db->from($params['table'].' u');
	       
	        //filter data by searched keywords
	        /*
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('u.title_hi',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('u.title_en',trim($params['search']['title']));
	        }
	        */
	        
	        if(isset($params['search']['status']) && trim($params['search']['status'])!=""){
	        $this->db->where('u.user_status', $params['search']['status']);
	        }
	        
	        if(count($filter)>0){
				$this->db->where($filter);
			}

	        //set start and limit
	        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
	            $this->db->limit($params['limit'],$params['start']);
	        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
	            $this->db->limit($params['limit']);
	        }
	        //get records
	        $query = $this->db->get();
	        //print_r($this->db->last_query());
	        //exit();
	        return $query->row();
	      }else{
		  	return FALSE;
		  }
    }
	
	public function getAjaxRows($params = array(), $filter=array(),$orderBy=array()){
		if(array_key_exists("table",$params)){
			
	        $this->db->select('u.*,c.sortname,c.country_name,c.phonecode,c.state_name,c.city_name,chp.chapter_name,(CASE WHEN (chp.fomp_id=u.fomp_id) THEN 1 ELSE 0 END) AS is_chairman');
	        $this->db->from($params['table'].' u');
	        $this->db->join('v_country_state_city c', 'c.cid = u.city_id','left');
	        $this->db->join('comm_chapter chp', 'chp.chapter_id = u.chapter_id','left');
	       
	        //filter data by searched keywords
	        /*
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->like('u.title_hi',trim($params['search']['title']));
	        }
	        
	        if(isset($params['search']['title']) && trim($params['search']['title'])!=""){
	            $this->db->or_like('u.title_en',trim($params['search']['title']));
	        }
	        */
	        
	        if(isset($params['search']['status']) && trim($params['search']['status'])!=""){
	        $this->db->where('u.user_status', $params['search']['status']);
	        }
	        
	        if(count($filter)>0){
				$this->db->where($filter);
			}
	        
	        //sort data by ascending or desceding order
	        
	        if(count($orderBy)>0){
			  foreach($orderBy as $key=>$val){
			  	 $this->db->order_by($key,$val);
			  }				
			}
	        //set start and limit
	        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
	            $this->db->limit($params['limit'],$params['start']);
	        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
	            $this->db->limit($params['limit']);
	        }
	        //get records
	        $query = $this->db->get();
	        //print_r($this->db->last_query());
	        //exit();
	        //return fetched data
	        return ($query->num_rows() > 0)?$query->result_array():array();
	      }else{
		  	return array();
		  }
    }
    //end getAjaxRows fucntion
    	
}//end MemberModel class