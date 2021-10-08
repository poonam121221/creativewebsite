<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MessageModel extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}//end constructor
	
	function getSingleList($table, $filter=array(),$order=array()){
		
		if(trim($table) !="" && trim($table) !=null && count($filter)>0){
			
			$column = "id,attachment";
			if(checkLanguage("english")){
				$column .= ",title_en as title, designation_en as designation, heading_en as heading, message_en as message";
			}else{
				$column .= ",title_hi as title, designation_hi as designation, heading_hi as heading, message_hi as message";
			}
			
			$this->db->select($column);
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
	
	
	
}//end class