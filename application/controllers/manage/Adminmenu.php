<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminmenu extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "menus";
	private $__id = NULL;
	private $__encId = NULL;
	private $__lastInsId = 0;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/MenuModel');
		$this->load->library('form_validation');
		$this->checkAuthUser();
	}//end constructor

	public function index(){
		addmin_css(array('plugins/nestable/nestable.css'));
		add_admin_footer_js(array('plugins/nestable/jquery.nestable.js'));
		$this->data['Record'] = $this->MenuModel->getAllList($this->__table,array(),array('s_order'=>'asc'));	
	    $this->front_view('admin/menu/index',$this->data);
	}//end index function

	public function add_update(){
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 			
			$link = $this->input->post('slink');
			$this->__id = (int)$this->input->post('id');			
			$this->form_validation->set_rules('menu_name', 'Menu Name','trim|required|min_length[2]|max_length[40]');
			$this->form_validation->set_rules('controller_name', 'Controller Name','trim|required|max_length[50]|regex_match[/^[a-zA-Z0-9\/\#]*$/]',array('regex_match' => 'Please enter character and hash (#) symbol only in %s.'));
			$this->form_validation->set_rules('icon_class', 'Icon Class','trim|required|min_length[2]|max_length[40]|regex_match[/^[a-zA-Z0-9\-\s]*$/]',array('regex_match' => 'Please enter character, number, space and (-) symbol only in %s.'));
			$this->form_validation->set_rules('action_name', 'Action Name','trim|max_length[50]|regex_match[/^[a-zA-Z0-9\/]*$/]',array('regex_match' => 'Please enter character ,number and symbol only in %s.'));
		if ($this->form_validation->run() == FALSE){
			echo json_encode(array('status'=>FALSE,'message'=>validation_errors()));
        }else{	        
        	$menu_name 		 = checkaddslashes(ucwords(cleanQuery(trim($this->input->post('menu_name',TRUE)))));
        	$controller_name = cleanQuery(trim($this->input->post('controller_name',TRUE)));
        	$icon_class 	 = cleanQuery(trim($this->input->post('icon_class',TRUE)));
        	$action_name 	 = cleanQuery(trim($this->input->post('action_name',TRUE)));
        	if(trim($action_name)==""){ $action_name = NULL;}         
			if($this->__id!=0 && $this->__id!=NULL){
				$DATAINPUT = array(
        				'menu_name'=>$menu_name,
        				'controller_name'=>$controller_name,
        				'icon_class'=>$icon_class,
        				'action'=>$action_name
        				);				
				$this->__queryStatus = $this->MenuModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$arr['type'] = 'edit';
					$arr['menu_name'] = stripslashes2($menu_name);
					$arr['controller_name'] = $controller_name;
					$arr['icon_class'] = $icon_class;
					$arr['action_name'] = $action_name;
					$arr['id'] = $this->__id;
					echo json_encode(array('status'=>TRUE,'message'=>'Data successfully updated !','atr'=>$arr));
				}else{
					echo json_encode(array('status'=>FALSE,'message'=>'Sorry Please try again latter.'));
				}
			}else{				
			
				$max_order = $this->MenuModel->getmax($this->__table,'s_order');				
				$DATAINPUT = array(
        				'menu_name'=>$menu_name,
        				'controller_name'=>$controller_name,
        				'icon_class'=>$icon_class,
        				'action'=>$action_name,
        				'p_menu_id'=>0,
        				'class_id'=>'title',
        				's_order'=>$max_order+1
        				);
				
				$this->__queryStatus = $this->MenuModel->insertdata($this->__table,$DATAINPUT);
				$this->__lastInsId = $this->db->insert_id();				
				
				if($this->__queryStatus==TRUE){
					$html = "";
					$html .= '<li class="dd-item dd3-item" data-id="'.$this->__lastInsId.'" >';
					$html .= '<div class="dd-handle dd3-handle"></div>';
					$html .= '<div class="dd3-content"><span id="label_show'.$this->__lastInsId.'">'.$menu_name.'</span>';
					$html .= '<span class="span-right">/<span id="link_show'.$this->__lastInsId.'">'.$controller_name.'</span>&nbsp;';
					$html .= '<a class="edit-button modify_'.$this->__lastInsId.'" id="'.$this->__lastInsId.'" menu_name="'.$menu_name.'" controller_name="'.$controller_name.'" icon_class="'.$icon_class.'" action_name="'.$action_name.'" >';
					$html .= '<i class="fa fa-pencil"></i></a>';
					$html .= '<a class="del-button" id="'.$this->__lastInsId.'"><i class="fa fa-trash-o"></i></a>';
					$html .= '</span></div>';
					$arr['menu'] = $html;
	                $arr['type'] = 'add';
					
					echo json_encode(array('status'=>TRUE,'message'=>'Data successfully submited !','atr'=>$arr));
				}else{
					echo json_encode(array('status'=>FALSE,'message'=>'Sorry Please try again latter.'));
				}
				
			}
		}//end validation else part
			
		}else{
			echo json_encode(array('status'=>FALSE,'message'=>'Invalid method used.'));
			show_404();
		}//end post method
	}//end add function
	
	public function updateAll(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			$data = json_decode($this->input->post('data'));
			$readbleArray = parseJsonArray($data);			
			if($this->MenuModel->menuUpdateAll($this->__table,$readbleArray)){
				echo "true";
			}else{
				echo "false";
			}			
		}else{
			show_404();
		}//end post method
		
	}//end updateAll function
	
	public function delete(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			$id = $this->input->post('id');
			
			if($this->isExists($this->__table,array('id'=>$id))==FALSE){
				echo json_encode(array('status'=>FALSE,'message'=>'Sorry record not found !'));
			}else{
				$this->data['Record'] = $this->MenuModel->getAllList($this->__table);	
				
				$ids = $id.getChildNode($this->data['Record'],$id);
				$ids = explode(',',$ids);
				
				$this->MenuModel->menuDelete($this->__table,$ids);
				echo json_encode(array('status'=>TRUE,'message'=>'Record successfully deleted.'));
			}			
			
		}else{
			echo json_encode(array('status'=>FALSE,'message'=>'Invalid method used.'));
			show_404();
		}
	}//end delete function

}// end page class