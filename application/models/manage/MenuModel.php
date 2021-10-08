<?php if ( ! defined('BASEPATH'
)) exit('No direct script access allowed');

class MenuModel extends MY_Model {

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
	
	function getAllList($table, $filter=array(),$orderBy=array()){
		
		if(trim($table) !="" && trim($table) !=null){
			$this->db->select('*');
			$this->db->from($table);
			if(count($filter)>0){
				$this->db->where($filter);
			}
			if(count($orderBy)>0){
				foreach($orderBy as $key=>$val){
					$this->db->order_by($key,$val);
				}
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
			  
			  $this->db->update($tbl,array('p_menu_id'=>$row['parentID'],'s_order'=>$i),array('id'=>$row['id']));
			}//end foreach loop
			
			$ParentId = array_unique($ParentId);
			$this->db->where(array('id!='=>1));			
			$this->db->update($tbl,array('class_id'=>NULL));
						
			$this->db->where_in('id', $ParentId);
			$this->db->update($tbl,array('class_id'=>'title'));	
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

}//end MenuModel Class