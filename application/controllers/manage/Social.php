<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social extends Admin_Controller
{
	public function __construct(){

		parent::__construct();
		$this->load->model('manage/SocialModel');
		$this->load->library('form_validation');
		$this->checkAuthUser();

	}//end constructor

	public function index(){
		$data = array();
		$data['get_Record'] = $this->SocialModel->displaydata();
	    $this->front_view('admin/social/index',$data);
	}//end index function

	public function updateRecord(){

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$link = $this->input->post('slink');
			$id = $this->input->post('id');
			if($this->SocialModel->updateRec($id,$link)==TRUE){
				$this->session->set_flashdata('successUpdate','Data Succesfully Updated');
				redirect('manage/Social');
			}else{
				$this->session->set_flashdata('errorMsg','Sorry Please try again latter.');
			 	redirect('manage/Social');
			}

		}else{
			$this->session->set_flashdata('errorMsg','Sorry.');
			redirect('manage/Social');
		}
	}//end updateRecord function

}// end page class
?>