<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SocialModel extends MY_Model {

	public function displaydata(){
		$this->db->select('*');
		$this->db->from('comm_social');
		$query = $this->db->get();

		if($query-> num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function updateRec($id, $link){

		$count = count($id);
		for($i=0; $i<$count; $i++){
		$this->db->query("UPDATE comm_social SET link = ? WHERE id = ? ",array($link[$i],$id[$i]));
		}
		return TRUE;
	}
}