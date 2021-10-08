<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PageModel extends MY_Model {

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
			$this->db->select('p.*, concat(cm.admin_fname," ",cm.admin_lname) as admin_name');
			$this->db->from($table.' p');
			$this->db->join('comm_admin cm', 'cm.admin_id = p.page_added_by','left');
			if(count($filter)>0){
				$this->db->where($filter);
			} 
			$query = $this->db->get();
			
			if($query->num_rows()>0){
				return $query->result_array();
			}
		}//end check condition		
		return FALSE;
		
	}// end getAllList function
	
	//grab all of the routes from the database, and cache to a file
    public function cache_routes($table){
    	$this->load->helper('file');
    	$data = "<?php".PHP_EOL;
    	$data .="defined('BASEPATH') OR exit('No direct script access allowed');".PHP_EOL;
    	if(trim($table) !="" && trim($table) !=null){
	        $this->db->select("*");
	        $query = $this->db->get_where($table,array('is_delete'=>0,'page_status'=>1));
	 
	        foreach ($query->result() as $row)
	        {	        	
	            $data .= '$route["' . $row->page_url . '"] = "Page/content/'.$row->page_url.'/";'.PHP_EOL;
	        }
	     $data .="?>";
	     
	     return write_file(APPPATH .  "cache/routes.php", $data);
        }
    }//end cache_routes function			

}//end class