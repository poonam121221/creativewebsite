<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeModel extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}//end constructor
	
	function getSingleList($table, $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter);
			
			if(count($order)>0){
				foreach($order as $col=>$val){
					$val = (trim($val)!="")?$val:"desc";
					$this->db->order_by($col,$val);
				}				
			}
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	function getAllList($table, $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('*');
			$this->db->from($table);
			if(count($filter)>0){
				$this->db->where($filter);
			}
			if(count($order)>0){
				foreach($order as $col=>$val){
					$val = (trim($val)!="")?$val:"desc";
					$this->db->order_by($col,$val);
				}				
			}
			
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		
	}// end getAllList function
	
	function getVal($table,$value,$filter=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select($value);
			$this->db->from($table);
			$this->db->where($filter);
			
			$query = $this->db->get();
			//echo $this->db->last-query();
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getVal function
	
	function getHomeData($filter=array(),$group_amount=array(),$order=array()){	
		
	 $this->db->select('count(p.project_id) as project_total ,IF(SUM(p.project_estmtd_budget) > 0, SUM(p.project_estmtd_budget), 0) as budget_total');
	 $this->db->from('comm_project p');
	 
	 if(count($filter)>0){
		$this->db->where($filter);
	 }
	 
	 if(count($group_amount)>0){
	  $this->db->group_start();
	  $this->db->where($group_amount);
	  $this->db->group_end();		
	 }
	 
	 if(count($order)>0){
		foreach($order as $col=>$val){
		 $val = (trim($val)!="")?$val:"desc";
		 $this->db->order_by($col,$val);
		}				
	 }
			
	 $query = $this->db->get();
	 //print_r($this->db->last_query());
	 if($query->num_rows()>0){
		return $query->row_array();
	 }	
	 	
	 return FALSE;
		
	}// end getHomeData function
	
    public function getHomeDatagraph($filter=array(),$group_amount=array(),$group_by=array(),$order=array()){
				
	 $this->db->select('pc.project_category_name,IF(SUM(p.project_estmtd_budget) > 0, SUM(p.project_estmtd_budget), 0) as budget_total');
	 $this->db->from('comm_project p');
	 $this->db->join('comm_project_category pc','pc.pc_id = p.project_cat_id','left');
	 
	 if(count($filter)>0){
		$this->db->where($filter);
	 }
	 
	 if(count($group_amount)>0){
	  $this->db->group_start();
	  $this->db->where($group_amount);
	  $this->db->group_end();		
	 }
	 
	 if(count($group_by)>0){
		$this->db->group_by($group_by);
	 }
	 
	 if(count($order)>0){
		foreach($order as $col=>$val){
		 $val = (trim($val)!="")?$val:"desc";
		 $this->db->order_by($col,$val);
		}				
	 }
			
	 $query = $this->db->get();
	 //print_r($this->db->last_query());
	 if($query->num_rows()>0){
		return $query->result_array();
	 }	
	 	
	 return FALSE;
	
	}// end getHomeDatagraph function
	
	public function getHomeDataMap($filter=array(),$group_amount=array(),$group_by=array(),$order=array()){
				
	 $this->db->select('cd.district_name,cd.district_code,cd.DistrictCensusCode, count(p.project_id) as total_project, IF(SUM(p.project_estmtd_budget) > 0, SUM(p.project_estmtd_budget), 0) as total_budget');
	 $this->db->from('comm_project p');
	 $this->db->join('comm_district cd','cd.district_code = p.district_code','right');
	 
	 if(count($filter)>0){
		$this->db->where($filter);
	 }
	 
	 if(count($group_amount)>0){
	  $this->db->group_start();
	  $this->db->where($group_amount);
	  $this->db->group_end();		
	 }
	 
	 if(count($group_by)>0){
		$this->db->group_by($group_by);
	 }
	 
	 if(count($order)>0){
		foreach($order as $col=>$val){
		 $val = (trim($val)!="")?$val:"desc";
		 $this->db->order_by($col,$val);
		}				
	 }
			
	 $query = $this->db->get();
	 //print_r($this->db->last_query());
	 if($query->num_rows()>0){
		return $query->result_array();
	 }	
	 	
	 return FALSE;
	
	}// end getHomeDatagraph function
	
}//end class