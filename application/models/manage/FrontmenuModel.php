<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FrontmenuModel extends MY_Model {

	public function __construct(){
	   parent::__construct();
	}  	
	
	function getSingleList($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($filter); 
			$query = $this->db->get();
			
			if($query->num_rows()>0){
			    return $query->row();
		    }
			
		}//end check condition		
		return FALSE;
		
	}// end getSingleList function
	
	function getAllList($table, $filter=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('m.*,mt.menu_type_title, concat(cm.admin_fname," ",cm.admin_lname) as admin_name');
			$this->db->from($table.' m');
			$this->db->join('comm_admin cm', 'cm.admin_id = m.added_by','left');
			$this->db->join('comm_menu_type mt', 'mt.menu_type_id = m.type_id','left');
			if(count($filter)>0){
				$this->db->where($filter);
			} 
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return array();
		
	}// end getAllList function
	
	function menuDelete($table, $ids=array()) {
	   if(trim($table)!="" && count($ids)>0){
	   	$this->db->where_in('id', $ids);
	   	return $this->db->delete($table);
	   }
	   return FALSE;
	   		    
	}//end recursiveDelete function
	
	function menuUpdateAll($tbl="",$readbleArray=array()){
		
		$this->db->trans_begin();
		
		$ParentId = array();
		if(trim($tbl)!="" && count($readbleArray)>0){
			$i=0;
			foreach($readbleArray as $row){
			  $i++; 
			  if($row['parentID']==0 && $row['id']!=1){
			  	$ParentId[] = $row['id'];
			  }else{
			  	$ParentId[] = $row['parentID'];
			  }
			  
			  $this->db->update($tbl,array('parent_id'=>$row['parentID'],'menu_order'=>$i),array('id'=>$row['id']));
			}//end foreach loop
			
			//print_r($this->db->last_query());
	
		}//end if	
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}	
		
	}//menuUpdateAll details
			

}//end class