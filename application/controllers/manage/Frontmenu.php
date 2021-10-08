<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontmenu extends Admin_Controller{
	
	private $__queryStatus = FALSE;
	private $__table = "comm_menu";
	private $__table2 = "comm_menu_type";
	private $__table3 = "comm_pages";
	private $__table4 = "comm_menu_modules";
	private $__id = NULL;
	private $__encId = NULL;
	private $__menuname = "";
	
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/FrontmenuModel');
	}//end constructor
	
	public function index(){  
		addmin_css(array('plugins/nestable/nestable.css'));
		add_admin_footer_js(array('plugins/nestable/jquery.nestable.js'));     
        //load the view
		$this->__menuname ="Front Menu";
        $this->front_view('admin/frontmenu/index',$this->data);
	  	
	}//end index function

	public function middleMenu(){  
		addmin_css(array('plugins/nestable/nestable.css'));
		add_admin_footer_js(array('plugins/nestable/jquery.nestable.js'));     
        //load the view
		$this->__menuname ="Middle Menu";
        $this->front_view('admin/frontmenu/middlemenu',$this->data);
	  	
	}//end index function
	
	public function bottomMenu(){  
		addmin_css(array('plugins/nestable/nestable.css'));
		add_admin_footer_js(array('plugins/nestable/jquery.nestable.js'));     
        //load the view
        $this->front_view('admin/frontmenu/footermenu',$this->data);
	  	
	}//end index function
	
	public function add(){
		
		$this->load->library(array('form_validation','Ckeditorsetup'));
		
		addmin_css(array('plugins/select2/select2.css','plugins/select2/select2-bootstrap.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js'));
		
		$this->data['LocationList'] = $this->FrontmenuModel->GenerateDDList($this->__table2,'menu_type_id','menu_type_title',NULL);
		$this->data['PageModuleList'] = $this->FrontmenuModel->GenerateDDList($this->__table3,'page_id','page_url','--select--',array('page_status'=>1,'is_delete'=>0),array('page_url'=>'asc'));
				
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
		 
		 /****Validation Rules start****/
		 $this->form_validation->set_rules('menu_type_id', 'Menu Location','trim|required|in_list[1,2,3]');	
		 $this->form_validation->set_rules('page_module_link', 'Menu Type','trim|required|in_list[1,2,3,4]');	 	
		 $this->form_validation->set_rules('title_hi','Menu Title (Hindi)','trim|required|max_length[150]'); 
		 $this->form_validation->set_rules('title_en','Menu Title (English)','trim|required|max_length[150]'); 	
		 $this->form_validation->set_rules('tab_same_new', 'URL Open In','trim|required|in_list[1,2]');	
		 $this->form_validation->set_rules('icon_class','Icon Class','trim|max_length[40]'); 	 
		 
		 $menu_type = $this->input->post('page_module_link',TRUE);//It can be Page or Module or Link
		 $location  = $this->input->post('menu_type_id',TRUE);//It can be Top Menu or Footer Menu
         		
         $page_id = 0;
         $module_id =0;
         $custom_url="";
         $html_design ="";
         		
         if(in_array($menu_type,array(1,2))){
         	$this->form_validation->set_rules('page_module_id', 'Menu Type','trim|required|is_natural_no_zero');
			if($menu_type==1){
				$page_id   = (isset($_POST['page_module_id']))? $this->input->post('page_module_id',TRUE):0;
			}else{
				$module_id = (isset($_POST['page_module_id'])) ? $this->input->post('page_module_id',TRUE):0;
			}
		}else if(in_array($menu_type,array(3))){
			$this->form_validation->set_rules('page_url', 'URL', 'trim|required|max_length[255]');
			$custom_url = (isset($_POST['page_url'])) ? trim($this->input->post('page_url',TRUE)):"";
		}else if(in_array($menu_type,array(4))){
			$this->form_validation->set_rules('html_block', 'URL', 'trim|required');
			$html_design = (isset($_POST['html_block'])) ? trim($this->input->post('html_block',TRUE)):"";
		}  
		 
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Frontmenu/add/');
         }else{
				
				$s_order = (int)$this->FrontmenuModel->getmax($this->__table,'menu_order','',array('type_id'=>$location));
         		$UserLogId =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']); 
         		$mega_menu = (isset($_POST['mega_menu']))?(int)$this->input->post('mega_menu',TRUE):0;

         	    $DATAINPUT = array(
         	    	'type_id'  			=> (int)$location,   	
         	    	'page_module_link'  => (int)$menu_type,   	
         	    	'page_id'   		=> (int)$page_id,   	
         	    	'module_id'   		=> (int)$module_id,   	
         	    	'custom_url'   		=> $custom_url,  
         	    	'html_block'   		=> $html_design, 	
         	    	'title_hi'     		=> $this->input->post('title_hi',TRUE),   	
         	    	'title_en'     		=> cleanQuery($this->input->post('title_en',TRUE)),   	
         	    	'icon_class'        => cleanQuery($this->input->post('icon_class',TRUE)),   	
         	    	'tab_same_new'      => cleanQuery($this->input->post('tab_same_new',TRUE)),
         	    	'mega_menu'  	    => $mega_menu,   	
         	    	'added_date'   		=> date('Y-m-d h:i:s'),
         	    	'added_by'     		=> $UserLogId,
         	    	'menu_order'		=> $s_order+1
         	    	);
         	    					
				$this->__queryStatus = $this->FrontmenuModel->insertdata($this->__table,$DATAINPUT);
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                
         }//end validation
         
		}//end check post method
		
	  	$this->front_view('admin/frontmenu/add',$this->data);
	}//end add function
	
	public function edit(){
		
		$this->load->library(array('form_validation','Ckeditorsetup'));
		
		addmin_css(array('plugins/select2/select2.css','plugins/select2/select2-bootstrap.css'));
		add_admin_footer_js(array('plugins/select2/select2.min.js'));
		
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Frontmenu/');
		}
		
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Record not found!'));
			redirect('manage/Frontmenu/');
		}
		
		$this->data['DataList'] = $this->FrontmenuModel->getSingleList($this->__table,array('id'=>$this->__id));
		
		$this->data['LocationList'] = $this->FrontmenuModel->GenerateDDList($this->__table2,'menu_type_id','menu_type_title',NULL);
		
		if($this->data['DataList']->page_module_link==1){
			$this->data['PageModuleList'] = $this->FrontmenuModel->GenerateDDList($this->__table3,'page_id','page_url','--select--',array('page_status'=>1,'is_delete'=>0),array('page_url'=>'asc'));
		}else{
			$this->data['PageModuleList'] = $this->FrontmenuModel->GenerateDDList($this->__table4,'module_id','module_name','--select--',array(),array('module_url'=>'asc'));
		}
		
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
		 $this->form_validation->set_rules('menu_type_id', 'Menu Location','trim|required|in_list[1,2,3]');	
		 $this->form_validation->set_rules('page_module_link', 'Menu Type','trim|required|in_list[1,2,3,4]');	
		 $this->form_validation->set_rules('title_hi','Menu Title (Hindi)','trim|required|max_length[150]'); 
		 $this->form_validation->set_rules('title_en','Menu Title (English)','trim|required|max_length[150]'); 	
		 $this->form_validation->set_rules('icon_class','Icon Class','trim|max_length[40]'); 	
		 $this->form_validation->set_rules('tab_same_new', 'URL Open In','trim|required|in_list[1,2]');
		 
		 $menu_type = $this->input->post('page_module_link',TRUE);
         		
         $page_id = 0;
         $module_id =0;
         $custom_url ="";
         $html_design ="";
         		
         if(in_array($menu_type,array(1,2))){
         	$this->form_validation->set_rules('page_module_id', 'Menu Type','trim|required|is_natural_no_zero');
			if($menu_type==1){
				$page_id   = (isset($_POST['page_module_id']))? $this->input->post('page_module_id',TRUE):0;
			}else{
				$module_id = (isset($_POST['page_module_id'])) ? $this->input->post('page_module_id',TRUE):0;
			}
		}else if(in_array($menu_type,array(3))){
			$this->form_validation->set_rules('page_url', 'URL', 'trim|required|max_length[255]');
			$custom_url = (isset($_POST['page_url'])) ? trim($this->input->post('page_url',TRUE)):"";
		}else if(in_array($menu_type,array(4))){
			$this->form_validation->set_rules('html_block', 'Html Design', 'trim|required');
			$html_design = (isset($_POST['html_block'])) ? trim($this->input->post('html_block',TRUE)):"";
		}
			
		 if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('AppMessage',array('class'=>'warning','message'=>validation_errors()));
                redirect('manage/Frontmenu/edit/'.$this->__encId.'/');
         }else{
         		$UserLogId  =  encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
         		$this->__id = encrypt_decrypt('decrypt',$this->input->post('id'));
         		$mega_menu = (isset($_POST['mega_menu']))?(int)$this->input->post('mega_menu',TRUE):0;
         		
         		$DATAINPUT = array(
         	    	'type_id'  			=> (int)$this->input->post('menu_type_id',TRUE),   	
         	    	'page_module_link'  => (int)$menu_type,   	
         	    	'page_id'   		=> (int)$page_id,   	
         	    	'module_id'   		=> (int)$module_id,   	
         	    	'custom_url'   		=> $custom_url,   	
         	    	'html_block'   		=> $html_design,   	
         	    	'title_hi'     		=> $this->input->post('title_hi',TRUE),   	
         	    	'title_en'     		=> cleanQuery($this->input->post('title_en',TRUE)), 
         	    	'icon_class'        => cleanQuery($this->input->post('icon_class',TRUE)),
         	    	'mega_menu'  	    => $mega_menu,
         	    	'tab_same_new'      => cleanQuery($this->input->post('tab_same_new',TRUE)),   	
         	    	'edit_date'    		=> date('Y-m-d h:i:s'),
         	    	'edit_by'      		=> $UserLogId
         	    	);
				
				$this->__queryStatus = $this->FrontmenuModel->updatedata($this->__table,$DATAINPUT,array('id'=>$this->__id));
				
				if($this->__queryStatus==TRUE){
					$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully submited'));
				}else{
					$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Try again later!'));
				}
                redirect('manage/Frontmenu/edit/'.$this->__encId.'/');
         }//end validation
		}//end check post method		
		
	  	$this->front_view('admin/frontmenu/edit',$this->data);
	}//end edit function
	
	public function updateAll(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){ 
			$data = json_decode($this->input->post('data'));
			$readbleArray = parseJsonArray($data);
			
			if($this->FrontmenuModel->menuUpdateAll($this->__table,$readbleArray)){
				echo "true";
			}else{
				echo "false";
			}
			
		}else{
			show_404();
		}//end post method
		
	}//end updateAll function
	
	public function delete(){
		 
		$this->__encId = $this->uri->segment(4, NULL);
		$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		
		if($this->__id==NULL){
			$this->__encId = $this->input->post('id');
			$this->__id = encrypt_decrypt('decrypt',$this->__encId);
		}
		
		if(($this->__id == NULL || $this->__id ==FALSE ||  $this->__id == "")){
			$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Something went wrong, try again!'));
			redirect('manage/Frontmenu/');
		}

		$menu_type = 1;
		$gettype= $this->FrontmenuModel->getSingleList($this->__table,array('id'=>$this->__id));
			
		if($this->isExists($this->__table,array('id'=>$this->__id))==FALSE){
			$this->session->set_flashdata('AppMessage',array('class'=>'info','message'=>'Sorry record not found.'));
		}else{
			$this->data['Record'] = $this->FrontmenuModel->getAllList($this->__table);
			
			$ids = $this->__id.getChildNode($this->data['Record'],$this->__id,'parent_id');
			$ids = explode(',',$ids);
			$this->__queryStatus = $this->FrontmenuModel->menuDelete($this->__table,$ids);
			if($this->__queryStatus){
				$this->session->set_flashdata('AppMessage',array('class'=>'success','message'=>'Data successfully deleted.'));
			}else{
				$this->session->set_flashdata('AppMessage',array('class'=>'danger','message'=>'Sorry try again latter.'));
			}
		}//end check data is exist or not			
		if($gettype->type_id==3)
			redirect('manage/Frontmenu/middleMenu');
		if($gettype->type_id==2)	
			redirect('manage/Frontmenu/footermenu');
		else
			redirect('manage/Frontmenu/');
	}//end delete function
	
}//end Dashboard class