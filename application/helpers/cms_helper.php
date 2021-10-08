<?php
//customFrontMenu function is used for front website menu
if ( ! function_exists('customFrontMenu')){
	//default get top menu record
	function customFrontMenu($location=1,$allmenu=FALSE,$p_id=0,$limit=0){		
		$ci = get_instance();
		$p_id = (int)$p_id;
		if($location!=1){
			if ($location!=2) {
				$location = 3;//for Middle menu
			} else {
				$location = 2;//for footer menu
			}			
		}
		
		if(checkLanguage("english")){
			$col_name  ='cm.title_en as menu_name,';
		}else{
			$col_name  ='cm.title_hi as menu_name,';
		}
		
		//do not remove cm.title_en it is used in admin panel
		$col_name .='cm.id, cm.type_id,cm.title_en,cm.mega_menu,cm.html_block, cm.page_module_link, cm.parent_id as p_menu_id, cm.tab_same_new, cm.menu_order,icon_class, ';
		$col_name .='(CASE cm.page_module_link '; 
		$col_name .='WHEN 1 THEN cp.page_url ';
		$col_name .='WHEN 2 THEN cmm.module_url ';
		$col_name .='WHEN 3 THEN cm.custom_url END) AS controller_name ';
		$col_name .=',(CASE cp.is_default WHEN 1 THEN "active" ELSE "" END) AS class_id ';
		$col_name .=',cp.is_delete,cp.page_status ';

		$ci->db->select($col_name);
	    $ci->db->from('comm_menu cm');
	    $ci->db->join('comm_menu_modules cmm', 'cmm.module_id = cm.module_id','left');
		$ci->db->join('comm_pages cp', 'cp.page_id = cm.page_id','left');
		if($allmenu==FALSE){
			$ci->db->where(array('cm.type_id'=>$location));
		}
		if($p_id>0){
			$ci->db->where(array('cm.parent_id'=>$p_id));
		}
		if($limit>0){
			$ci->db->limit($limit);
		}	
		
		$ci->db->order_by('cm.type_id,cm.menu_order asc');


		$query = $ci->db->get()->result_array();
		
		return $query;
		
	}//end function
	
}//end customFrontMenu menu

//buildFrontTopMenu function is used to create navbar html view
if ( ! function_exists('buildFrontTopMenu')){
function buildFrontTopMenu($parent, $menu) {

        $ci = get_instance();
	$html ="";
	static $i =0;
	
	if (isset($menu['parent_menus'][$parent])) {
		
		if($i == 0){
			//parent ul
			$html .= '<ul class="navbar-nav mx-auto">';
			$i++;
		}else{
			//child ul
			$html .='<ul class="dropdown-menu">';
		}


		foreach ($menu['parent_menus'][$parent] as $menu_id) {

			if($ci->uri->segment(1)==$menu['menus'][$menu_id]['controller_name']){
                                                $active ='active';
                                            }else{
                                                $active ='';
                                            }
            if ($menu['menus'][$menu_id]['icon_class']=="las la-home"){
            	$icon = ( $menu['menus'][$menu_id]['icon_class']  == "" ? '' : '<i class="'.$menu['menus'][$menu_id]['icon_class'].'"></i>');
            } else {
            	$icon = ( $menu['menus'][$menu_id]['icon_class']  == "" ? '' : '<span><i class="'.$menu['menus'][$menu_id]['icon_class'].'"></i></span>');
            }
            


			if (!isset($menu['parent_menus'][$menu_id])) {

				$html .= "";
					if(trim($menu['menus'][$menu_id]['class_id'])=="active"){


                        if($ci->router->fetch_class()=='Home'){
                             $html .= "<li class='nav-item' id='menu_".$menu['menus'][$menu_id]['id']."'>";
                        }else{
                             $html .= "<li class='nav-item' id='menu_".$menu['menus'][$menu_id]['id']."'>";
                        }
					   
					    if($menu['menus'][$menu_id]['tab_same_new']==1){
						  $html .= "<a  class='nav-link ' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".base_url()."'>".$icon;
						 
						}else{
						  $html .= "<a class='nav-link ' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						  
						}
						if($menu['menus'][$menu_id]['id']==1){}else{
							$html .= stripslashes2($menu['menus'][$menu_id]['menu_name']);
						}
						$html .= "</a>";
						$html .= "</li>";
					}
					else{

						
                                            
					    $html .= "<li id='menu_".$menu['menus'][$menu_id]['id']."' class='nav-item ".$active."' >";
					    if($menu['menus'][$menu_id]['page_module_link']==3 && $menu['menus'][$menu_id]['controller_name']=='#'){
							$html .= "<a class='nav-link ' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='javascript:void(0)'>".$icon;
                           
						}else if($menu['menus'][$menu_id]['page_module_link']==3 && $menu['menus'][$menu_id]['controller_name']!='#'){
							
							if($menu['menus'][$menu_id]['tab_same_new']==1){
								$html .= "<a  class='' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".$menu['menus'][$menu_id]['controller_name']."'>".$icon;
								
							}else{
								$html .= "<a  class='' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".$menu['menus'][$menu_id]['controller_name']."'>".$icon;
								
							}
							
						}else if($menu['menus'][$menu_id]['page_module_link']==4){
							$html .= "<div class='dropdown-menu-content'>";
							$html .= $menu['menus'][$menu_id]['html_block'];
							$html .="</div>";
						}else{
							if($menu['menus'][$menu_id]['tab_same_new']==1){
								$html .= "<a class='' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
								
							}else{
								$html .= "<a class='' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
								
							}
						}
						
						if($menu['menus'][$menu_id]['page_module_link']!=4){
							if($menu['menus'][$menu_id]['id']==1){}else{
						  		 $html .= stripslashes2($menu['menus'][$menu_id]['menu_name']);
							}
						}
						
						$html .= "</a>";
						$html .= "</li>";
					}
				
			}
			if (isset($menu['parent_menus'][$menu_id])) {
				
				if($menu['menus'][$menu_id]['p_menu_id']==0){
					if($menu['menus'][$menu_id]['mega_menu']==0){
						$switchParentClass = "dropdown";
					}else{
						$switchParentClass = "dropdown";
					}					
				}else{
					$switchParentClass = "dropdown-submenu";
					//$switchParentClass = "dropdown";
				}
				
				$html .= "<li class='".$switchParentClass."' id='menu_".$menu['menus'][$menu_id]['id']."'>";
				
				if($menu['menus'][$menu_id]['page_module_link']==3 && $menu['menus'][$menu_id]['controller_name']=='#'){
				   $html .= "<a class='dropdown-toggle ' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='javascript:void(0)'>".$icon;
				  
					
				}else if($menu['menus'][$menu_id]['page_module_link']==3 && $menu['menus'][$menu_id]['controller_name']!='#'){
							
					if($menu['menus'][$menu_id]['tab_same_new']==1){
						$html .= "<a class='dropdown-toggle ' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						
					}else{
						$html .= "<a class='dropdown-toggle ' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						
					}
							
				}else if($menu['menus'][$menu_id]['page_module_link']==4){
					$html .= "<div class='dropdown-menu-content'>";
							$html .= $menu['menus'][$menu_id]['html_block'];
							$html .="</div>";
				}else{
					if($menu['menus'][$menu_id]['tab_same_new']==1){
						$html .= "<a class='dropdown-toggle' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						
					}else{
						$html .= "<a class='dropdown-toggle' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						
					}					
				}
								
				$html .= stripslashes2($menu['menus'][$menu_id]['menu_name']);
				$html .= "</a>";
				$html .= buildFrontTopMenu($menu_id, $menu);
				$html .= "</li>";
			}
			$i++;
		}

		$html .= "</ul>";
	}
	return $html;
}
}//end check buildFrontTopMenu exists


//buildFrontTopMenu function is used to create navbar html view
if ( ! function_exists('buildSidebarMenu')){
function buildSidebarMenu() {

$parent=0;
	$menu = array('menus' => array(), 'parent_menus' => array());
               $menus = customFrontMenu(3);
               if (isset($menus) && !empty($menus)):
                  foreach ($menus as $menu1) {
                     $menu['menus'][$menu1['id']] = $menu1;
                     $menu['parent_menus'][$menu1['p_menu_id']][] = $menu1['id'];
                  }
              endif;


    $ci = get_instance();
	$html ="";
	static $i =0;
	
	if (isset($menu['parent_menus'][$parent])) {
		
		if($i == 0){
			//parent ul
			$html .= '<ul class="navbar-nav mx-auto">';
			$i++;
		}else{
			//child ul
			$html .='<ul class="dropdown-menu">';
		}


		foreach ($menu['parent_menus'][$parent] as $menu_id) {

			if($ci->uri->segment(1)==$menu['menus'][$menu_id]['controller_name']){
                                                $active ='active';
                                            }else{
                                                $active ='';
                                            }
            if ($menu['menus'][$menu_id]['icon_class']=="las la-home"){
            	$icon = ( $menu['menus'][$menu_id]['icon_class']  == "" ? '' : '<i class="'.$menu['menus'][$menu_id]['icon_class'].'"></i>');
            } else {
            	$icon = ( $menu['menus'][$menu_id]['icon_class']  == "" ? '' : '<span><i class="'.$menu['menus'][$menu_id]['icon_class'].'"></i></span>');
            }         


			if (!isset($menu['parent_menus'][$menu_id])) {

				$html .= "";
					if(trim($menu['menus'][$menu_id]['class_id'])=="active"){


                        if($ci->router->fetch_class()=='Home'){
                             $html .= "<li class='nav-item' id='menu_".$menu['menus'][$menu_id]['id']."'>";
                        }else{
                             $html .= "<li class='nav-item' id='menu_".$menu['menus'][$menu_id]['id']."'>";
                        }
					   
					    if($menu['menus'][$menu_id]['tab_same_new']==1){
						  $html .= "<a  class='nav-link ' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".base_url()."'>".$icon;
						 
						}else{
						  $html .= "<a class='nav-link ' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						  
						}
						if($menu['menus'][$menu_id]['id']==1){}else{
							$html .= stripslashes2($menu['menus'][$menu_id]['menu_name']);
						}
						$html .= "</a>";
						$html .= "</li>";
					}
					else{

						
                                            
					    $html .= "<li id='menu_".$menu['menus'][$menu_id]['id']."' class='nav-item ".$active."' >";
					    if($menu['menus'][$menu_id]['page_module_link']==3 && $menu['menus'][$menu_id]['controller_name']=='#'){
							$html .= "<a class='nav-link ' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='javascript:void(0)'>".$icon;
                           
						}else if($menu['menus'][$menu_id]['page_module_link']==3 && $menu['menus'][$menu_id]['controller_name']!='#'){
							
							if($menu['menus'][$menu_id]['tab_same_new']==1){
								$html .= "<a  class='' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".$menu['menus'][$menu_id]['controller_name']."'>".$icon;
								
							}else{
								$html .= "<a  class='' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".$menu['menus'][$menu_id]['controller_name']."'>".$icon;
								
							}
							
						}else if($menu['menus'][$menu_id]['page_module_link']==4){
							$html .= "<div class='dropdown-menu-content'>";
							$html .= $menu['menus'][$menu_id]['html_block'];
							$html .="</div>";
						}else{
							if($menu['menus'][$menu_id]['tab_same_new']==1){
								$html .= "<a class='' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
								
							}else{
								$html .= "<a class='' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
								
							}
						}
						
						if($menu['menus'][$menu_id]['page_module_link']!=4){
							if($menu['menus'][$menu_id]['id']==1){}else{
						  		 $html .= stripslashes2($menu['menus'][$menu_id]['menu_name']);
							}
						}
						
						$html .= "</a>";
						$html .= "</li>";
					}
				
			}
			if (isset($menu['parent_menus'][$menu_id])) {
				
				if($menu['menus'][$menu_id]['p_menu_id']==0){
					if($menu['menus'][$menu_id]['mega_menu']==0){
						$switchParentClass = "dropdown";
					}else{
						$switchParentClass = "dropdown";
					}					
				}else{
					$switchParentClass = "dropdown-submenu";
					//$switchParentClass = "dropdown";
				}
				
				$html .= "<li class='".$switchParentClass."' id='menu_".$menu['menus'][$menu_id]['id']."'>";
				
				if($menu['menus'][$menu_id]['page_module_link']==3 && $menu['menus'][$menu_id]['controller_name']=='#'){
				   $html .= "<a class='dropdown-toggle ' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='javascript:void(0)'>".$icon;
				  
					
				}else if($menu['menus'][$menu_id]['page_module_link']==3 && $menu['menus'][$menu_id]['controller_name']!='#'){
							
					if($menu['menus'][$menu_id]['tab_same_new']==1){
						$html .= "<a class='dropdown-toggle ' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						
					}else{
						$html .= "<a class='dropdown-toggle ' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						
					}
							
				}else if($menu['menus'][$menu_id]['page_module_link']==4){
					$html .= "<div class='dropdown-menu-content'>";
							$html .= $menu['menus'][$menu_id]['html_block'];
							$html .="</div>";
				}else{
					if($menu['menus'][$menu_id]['tab_same_new']==1){
						$html .= "<a class='dropdown-toggle' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						
					}else{
						$html .= "<a class='dropdown-toggle' data-toggle='dropdown' title='".stripslashes2($menu['menus'][$menu_id]['menu_name'])."' target='_blank' href='".base_url().$menu['menus'][$menu_id]['controller_name']."'>".$icon;
						
					}					
				}
								
				$html .= stripslashes2($menu['menus'][$menu_id]['menu_name']);
				$html .= "</a>";
				$html .= buildFrontTopMenu($menu_id, $menu);
				$html .= "</li>";
			}
			$i++;
		}

		$html .= "</ul>";
	}
	return $html;
}
}//end check buildFrontTopMenu exists

//buildFrontHomepagemiddleMenu function is used for create front footer menu
if ( ! function_exists('buildFrontMiddleMenu')){
	function buildFrontMiddleMenu($classCss=""){		
		$query = array();
		$str = '';
		
		$query = customFrontMenu(3);
		
		if(count($query)>0){
			$str .= '';
			foreach($query as $row){
				if ($row['p_menu_id']==0) {
				$str .='<div class="pt_menu"><div class="parentMenu">';
				if(trim($row['controller_name'])!="" && $row['controller_name']!=NULL && trim($row['controller_name'])!="#"){
				 if($row['page_module_link']==3 && trim($row['controller_name'])!="#"){
				 	if($row['tab_same_new']==1){
				  	$str .='<a title="'.html_escape($row['menu_name']).'" href="'.html_escape($row['controller_name']).'">';
                                        
				   }else{
				  	$str .='<a title="'.html_escape($row['menu_name']).'" target="_blank" href="'.html_escape($row['controller_name']).'">';
                                        
				   }	
				 }else if($row['page_module_link']==3 && trim($row['controller_name'])=="#"){
				 	if($row['tab_same_new']==1){
				 		$str .='<a  title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                               
				 	}else{
						$str .='<a target="_blank" title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                               
					}
				 	
				 }else{
				 	if($row['tab_same_new']==1){
				  	$str .='<a title="'.html_escape($row['menu_name']).'" href="'.base_url().html_escape($row['controller_name']).'">';
                                        
				    }else{
				  	$str .='<a title="'.html_escape($row['menu_name']).'" target="_blank" href="'.base_url().html_escape($row['controller_name']).'">';
                                       
				    }	
				 }				  
				  				
				}else{
					$str .='<a title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                        
				}				
				$str .='<span>'.html_escape($row['menu_name']).'</span>';
				$str .='</a></div></div>';
				}
			}
			$str .= ''.PHP_EOL;
			return $str;
		}else{
			return "";
		}
		
	}//end function
	
}//end buildFrontBottomMenu menu


//buildFrontBottomMenu function is used for create front footer menu
if ( ! function_exists('buildFrontBottomMenu')){
	function buildFrontBottomMenu($classCss=""){		
		$query = array();
		$str = '';
		
		$query = customFrontMenu(2);
		if(count($query)>0){
			$str .= '<ul class="'.$classCss.'">';
			foreach($query as $row){
				$str .='<li>';
				if(trim($row['controller_name'])!="" && $row['controller_name']!=NULL && trim($row['controller_name'])!="#"){
				 if($row['page_module_link']==3 && trim($row['controller_name'])!="#"){
				 	if($row['tab_same_new']==1){
				  	$str .='<a title="'.html_escape($row['menu_name']).'" href="'.html_escape($row['controller_name']).'">';
                                        
				   }else{
				  	$str .='<a title="'.html_escape($row['menu_name']).'" target="_blank" href="'.html_escape($row['controller_name']).'">';
                                        
				   }	
				 }else if($row['page_module_link']==3 && trim($row['controller_name'])=="#"){
				 	if($row['tab_same_new']==1){
				 		$str .='<a target="_blank" title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                               
				 	}else{
						$str .='<a target="_blank" title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                               
					}
				 	
				 }else{
				 	if($row['tab_same_new']==1){
				  	$str .='<a title="'.html_escape($row['menu_name']).'" href="'.base_url().html_escape($row['controller_name']).'">';
                                        
				    }else{
				  	$str .='<a title="'.html_escape($row['menu_name']).'" target="_blank" href="'.base_url().html_escape($row['controller_name']).'">';
                                       
				    }	
				 }				  
				  				
				}else{
					$str .='<a title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                        
				}				
				$str .=html_escape($row['menu_name']);
				$str .='</a></li>';
			}
			$str .= '</ul>'.PHP_EOL;
			return $str;
		}else{
			return "";
		}
		
	}//end function
	
}//end buildFrontBottomMenu menu

if(!function_exists('getSpecificMenuListById')){
	
  function getSpecificMenuListById($array=array(),$parent_id = 0,$icon){
  	if ($parent_id==0) {
  		$menu_html = '<ul class="treeMenu">';
  	} else {
  		$menu_html = '<ul style="display: block;">';
  	}
   foreach($array as $element){
	if($element['p_menu_id']==$parent_id){
	 $menu_html .= '<li> ';
	 if($element['class_id']=="active"){
	   $menu_html .='<a title="'.stripslashes2($element['menu_name']).'" href="'.base_url().'">'.$icon;
	 }
	 if($element['page_module_link']==3 && trim($element['controller_name'])=="#"){
	   $menu_html .='<a title="'.stripslashes2($element['menu_name']).'" href="javascript:void(0)" target="_blank">'.$icon;
	 }else{
		if($element['tab_same_new']==1){
		 $menu_html .='<a title="'.stripslashes2($element['menu_name']).'" href="'.$element['controller_name'].'">'.$icon;
		}else{
		 $menu_html .='<a title="'.stripslashes2($element['menu_name']).'" href="'.$element['controller_name'].'" target="_blank">'.$icon;
	    }				  	
	 }

			      
	 $menu_html .= stripslashes2($element['menu_name']);			      
	 $menu_html .= '</a>';			      
	 $menu_html .=getSpecificMenuListById($array,$element['id'],'<i class="fa fa-file-o"></i>');
	 $menu_html .= '</li>';
	}   
   } 
   $menu_html .= '</ul>';
   return $menu_html;
			
  }//end getSpecificMenuListById function
	
}//end check getSpecificMenuListById

//customMenu function is used for admin menu
if ( ! function_exists('customMenu')){
	function customMenu(){		
		$ci = get_instance();
		$filterIn =array();
		$filterIn = getPrivilege();
		
		$ci->db->select('*');
		$ci->db->from('menus');

		if(count($filterIn)>0){
			$ci->db->where_in('id',$filterIn);
		}else{
			$ci->db->where_in('id',array(1));
		}
		$ci->db->order_by('s_order asc');
		$query = $ci->db->get()->result_array();
		
		return $query;
		
	}//end function
	
}//end coustom menu

//getPrivilege function is used for get privilege for admin menu
if ( ! function_exists('getPrivilege')){
	function getPrivilege(){		
		$ci = get_instance();
		$userPrivilegeId = 0;
		$filter = array();
		
		if($ci->session->has_userdata("AUTH_USER")){
		 $userPrivilegeId =  encrypt_decrypt("decrypt",$ci->session->userdata['AUTH_USER']['USER_UPMID']);
		}
		
		$ci->db->select('upm_range');
		$ci->db->from('user_previlege_master');
		$ci->db->where(array('isdelete'=>0,'upm_id'=>$userPrivilegeId));
		$query = $ci->db->get();
		//print_r($ci->db->last_query());
		
		if($query->num_rows()>0){
			$filter = explode(',',$query->row()->upm_range);
			return $filter;
		}
		
		return array();
		
	}//end function
	
}//end getPrivilege function

if ( ! function_exists('checkActiveMenu')){
	function checkActiveMenu($crnt_controller,$controller_name,$crnt_function,$function_name="index"){
		
		if(trim($crnt_function)==""){
			$crnt_function = "index";
		}
		
		if(strtolower($function_name)==""){
		  $function_name = "index";
		}
		
		if(in_array(strtolower($crnt_function),array('add','edit','delete')) && strtolower($function_name)!="recycle"){
		  $function_name = "index";
		  $crnt_function = "index";			
		}	
		
		if(trim(strtolower($crnt_controller))==trim(strtolower($controller_name)) && strtolower($crnt_function)==strtolower($function_name)){
			return "active";			
		}else{
			return ""; 
		}
		
	}//end checkActiveMenu function
}//end check checkActiveMenu function exist

//buildMenu function is used to create navbar html view for admin panel
if ( ! function_exists('buildMenu')){
function buildMenu($parent, $menu,$crnt_controller,$crnt_function) {
	$html ="";
	static $i =0;
	$controller_name = "";
	$function_name = "";
	
	if (isset($menu['parent_menus'][$parent])) {
		
		if($i == 0){
			$html .= "<ul id='ps-page-smenu' class='page-sidebar-menu' data-auto-scroll='true' data-slide-speed='200'>";
			$html .= "<li class='sidebar-toggler-wrapper'><!-- BEGIN SIDEBAR TOGGLER BUTTON -->";
			$html .= "<div class='sidebar-toggler hidden-phone'></div><!-- BEGIN SIDEBAR TOGGLER BUTTON -->";
			$html .= "</li>";
			$i++;
		}else{
			$html .="<ul class='sub-menu'>";
		}		

		foreach ($menu['parent_menus'][$parent] as $menu_id) {
			
			$controller_name = $menu['menus'][$menu_id]['controller_name'];
			$function_name = $menu['menus'][$menu_id]['action'];
			
			if (!isset($menu['parent_menus'][$menu_id])) {
				
				$html .= "";
					    $html .= "<li class='".checkActiveMenu($crnt_controller,$controller_name,$crnt_function,$function_name)."' id='m_".$menu['menus'][$menu_id]['id']."'>";
					    if($controller_name=='#'){
							$html .= "<a href='javascript:void(0)'>";
						}else{
							$html .= "<a href='".base_url().$controller_name;
						    $html .= "/".$function_name;
						    $html .= "'>";
						}						
						$html .= " <i class='". $menu['menus'][$menu_id]['icon_class'] ."'></i> ";
						$html .= " <span class='".$menu['menus'][$menu_id]['class_id']."'>";
						$html .= stripslashes2($menu['menus'][$menu_id]['menu_name'])."</span>";
						$html .= "</a>";
						$html .= "</li>";				
			}
			if (isset($menu['parent_menus'][$menu_id])) {
				$html .= "<li class='".checkActiveMenu($crnt_controller,$controller_name,$crnt_function,$function_name)."' id='m_".$menu['menus'][$menu_id]['id']."'>";
				if($menu['menus'][$menu_id]['class_id']=='title'){
					$html .= "<a href='javascript:void(0)'>";
					$html .= " <span class='arrow'></span>";
				}else{
					$html .= "<a href='".base_url().$controller_name;
					$html .= "/".$function_name;
					$html .= "'>";
				}
				if ($menu['menus'][$menu_id]['p_menu_id'] == 0) {
					$html .= "<i class='". $menu['menus'][$menu_id]['icon_class'] ."'></i> ";
					$html .= " <span class='".$menu['menus'][$menu_id]['class_id']."'>";				
				}else{
					$html .= " <i class='". $menu['menus'][$menu_id]['icon_class'] ."'> </i>";
				}
				
				$html .= stripslashes2($menu['menus'][$menu_id]['menu_name']). "</a>";
				$html .= buildMenu($menu_id, $menu, $crnt_controller, $crnt_function);
				$html .= "</li>";
			}
		}
		$html .= "</ul>";
	}
	return $html;
}
}//end check buildMenu exists

//get_admin_menu function is used for create dynamic drag & drop menu in admin panel
if ( ! function_exists('get_admin_menu')){
	function get_admin_menu($items,$class = 'dd-list') {

	    $html = '<ol class="'.$class.'" id="menu-id">';

	    foreach($items as $key => $value) {
	        $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >';
	        $html.= '<div class="dd-handle dd3-handle"></div>';
	        $html.= '<div class="dd3-content">';
	        $html.= '<span id="label_show'.$value['id'].'">'.trim($value['menu_name']).'</span>';
	        $html.= '<span class="span-right">/<span id="link_show'.$value['id'].'">'.$value['controller_name'].'</span>&nbsp;';
	        $html.= '<a class="edit-button modify_'.$value['id'].'" id="'.$value['id'].'" menu_name="'.trim($value['menu_name']).'" controller_name="'.trim($value['controller_name']).'" icon_class="'.trim($value['icon_class']).'" action_name="'.$value['action_name'].'" >';
	        $html.= '<i class="fa fa-pencil"></i></a>';
	        if($value['id']!=1){
				$html.= '<a class="del-button" id="'.$value['id'].'"><i class="fa fa-trash-o"></i></a></span>';
			}
	        
	        $html.= '</div>';
	        if(array_key_exists('child',$value)) {
	            $html .= get_admin_menu($value['child'],'child');
	        }
	            $html .= '</li>';
	    }
	    $html .= '</ol>';

	    return $html;

	}//end get_admin_menu function
}//end check get_admin_menu function

//get_front_menu function is used for drag & drop menu in admin panel
if ( ! function_exists('get_front_menu')){
	function get_front_menu($items,$class = 'dd-list') {

	    $html = '<ol class="'.$class.'" id="menu-id">';

	    foreach($items as $key => $value) {
	    	$id = encrypt_decrypt('encrypt',$value['id']);
	    	
	        $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >';
	        $html.= '<div class="dd-handle dd3-handle"></div>';
	        $html.= '<div class="dd3-content">';
	        $html.= '<span id="label_show'.$value['id'].'">'.trim($value['menu_name']).'</span>';
	        $html.= '<span class="span-right">';
	        $html.= '<a target="_blank" href="'.base_url('manage/Frontmenu/edit/'.$id.'/').'" class="edit-button" id="'.$value['id'].'">';
	        $html.= '<i class="fa fa-pencil"></i></a>';
	        if($value['id']!=1){
				$html.= '<a href="'.base_url('manage/Frontmenu/delete/'.$id.'/').'" class="del-button" id="'.$value['id'].'" onclick="return confirm(\'Are you sure to delete record?\'); "><i class="fa fa-trash-o"></i></a></span>';
			}
	        
	        $html.= '</div>';
	        if(array_key_exists('child',$value)) {
	            $html .= get_front_menu($value['child'],'child');
	        }
	            $html .= '</li>';
	    }
	    $html .= '</ol>';

	    return $html;

	}//end get_front_menu function
}//end check get_front_menu function

//encrypt_decrypt function is used for encrypt & decrypt data
if ( ! function_exists('encrypt_decrypt')){
	function encrypt_decrypt($action, $string,$secret_key= 'D3B361F1F159649CCE369D4B1351Ahd269P05BF9B650F409DAD9E246D'){
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_iv = '159649CCE369D4djkvun51Ahd2694084C7';

		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}

		return $output;
	}//end encrypt_decrypt function	
}//end if not exist

//encrypt_decrypt function is used for encrypt & decrypt data
if ( ! function_exists('client_encypt_decrypt')){
  function client_encrypt_decrypt($action="decrypt",$string="",$secret_key=""){
	$output = '';
	
	if(trim($string)!=""){

	$iv = 'e9f8db49806ee2823d03d5f1fc40b180';//32 hex key
	$key = '4ae66fe0af898766d52147883331e79348c3d4957d8ece1f947be3072afe7363';//64 hex key
	if(trim($secret_key)!=""){$key = hash('sha256',$secret_key);}
	
	$ivBytes = hex2bin($iv);
	$keyBytes = hex2bin($key);
	$ctBytes = base64_decode($string);

	  if($action=="encrypt"){
		$output = openssl_encrypt($string, 'aes-256-cbc', $keyBytes, 0, $ivBytes);	
	  }else{
		$output = openssl_decrypt($ctBytes, "aes-256-cbc", $keyBytes, OPENSSL_RAW_DATA , $ivBytes);	
	  }
	
	}
	
	return $output;
  }//end client_encypt_decrypt function	
}//end if not exist


//reload_captcha function is used for create captcha
if ( ! function_exists('reload_captcha')){
	function reload_captcha($vsn=1){
	 $CI =& get_instance();
	 $CI->load->helper('captcha');
	 $word = 'ABCD';
	 $pool = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
	 $str = '';
	 for ($i = 0; $i < 6; $i++){
	 	  $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		  } 
	 $word = $str;
	 $vals = array(
	 'img_path' 	=> './uploads/captcha/',
	 'word' 		=> $word,
	 'img_url'	    => site_url().'uploads/captcha/',
	 'font_size'    => 16,
	 'font_path' 	=> FCPATH.'system/fonts/texb.ttf',
	 'img_width' 	=> '160',
	 'img_height'	=> 40,
	 'expiration' 	=> 1200,
	 'time'		  	=> time(),
	 'colors'		=> array(
         				'background' => array(255, 255, 255),
         				'border' => array(255, 255, 255),
         				'text' => array(0, 0, 0),
         				'grid' => array(247, 108, 66)
     				   )
	 );
	 
	 $value = array(
	 	'captcha_time' 	=>$vals['time'],
		'ip_address'	=>$CI->input->ip_address(),
		'word'			=>$vals['word']
	 );
	 
	 $expire_time = $vals['time'] - $vals['expiration'];
	 
	 $CI->session->set_userdata($value);
	 $cap = create_captcha($vals);
	 	 
	 if($vsn!=1){
	 	return $cap['filename'];
	 }else{
	 	return $cap['image'];
	 }
	  
	}//end reload_captcha function
}//end check reload_captcha exist

if ( ! function_exists('mysql_escape_mimic')){
function mysql_escape_mimic($inp) { 
	    if(is_array($inp)) 
	        return array_map(__METHOD__, $inp); 

	    if(!empty($inp) && is_string($inp)) { 
	        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
	    } 

	    return $inp; 
		
	}//end escape function
}//end 	

if ( ! function_exists('checkaddslashes')){
	function checkaddslashes($str){        
	    if(strpos(str_replace("\'",""," $str"),"'")!=false)
	        return addslashes($str);
	    else
	        return $str;
	}
}//end	

if ( ! function_exists('stripslashes2')){
	function stripslashes2($string) {
	    $string = str_replace("\\\"", "\"", $string);
	    $string = str_replace("\\'", "'", $string);
	    $string = str_replace("\\\\", "\\", $string);
	    return $string;
	}//If you want to deal with slashes in double-byte encodings

//Mysql Injection Function
}//end
		
if ( ! function_exists('cleanQuery')){			
  function cleanQuery($string)
	{
			if(get_magic_quotes_gpc())  // prevents duplicate backslashes
			{
			$string = stripslashes2($string);
			}
			if (phpversion() >= '4.3.0')
			{
			$string = mysql_escape_mimic($string);
			}
			else
			{
			$string = mysql_escape_mimic($string);
			}
		return $string;
   } 
 }//end  

if ( ! function_exists('seoUrl')){
	function seoUrl($string) {
	    //Lower case everything
	    $string = strtolower($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
   }//end seoUrl function
}//end seoUrl function exists

if ( ! function_exists('AlertMessage')){
	
	function AlertMessage($msg){
		$str = "";
		if(isset($msg['class']) && $msg['class']!=""){
			$str = '<div class="alert alert-'.$msg['class'].' msgAlert error-message"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>'.trim($msg['message']).'</div>';
		}
		return $str;
	}//end AlertMessage function
	
}//end check AlertMessage

if ( ! function_exists('randomUniqueId')){
function randomUniqueId($length=5){
		$random= "";	
		$random = srand((double)microtime()*1000000);		
		$data = time();	
		for($i = 0; $i < $length; $i++)
		{
		$random .= substr($data, (rand()%(strlen($data))), 1);
		}
		return $random;
	}//end randomUniqueId
}

if ( ! function_exists('getHash')){
	function getHash(){
		$_SESSION['request_token'] = md5(uniqid().time()); 
		return $_SESSION['request_token'];
	}//end getHash function 
}//end check getHash function exist

if ( ! function_exists('passwordGenerator')){
	function passwordGenerator($PassSpecial=""){
		
		$special     ="";
		$length 	 = 6;
		$alpha 		 = generateRandomString(2,"abcdefghijkmnpqrstuvwxyz");
		$alpha_upper = generateRandomString(2,strtoupper($alpha));
		$numeric 	 = generateRandomString(2,"23456789");
		if(trim($PassSpecial)!=""){
			$special = generateRandomString(1,$PassSpecial);
		}
		
		$chars 		 = "";		
		$chars = $alpha . $alpha_upper . $numeric. $special;
    	
		$pw = '';
		$pw = str_shuffle($chars);
		
		return $pw;
		
	}//end passwordGenerator function 
}//end check passwordGenerator function exist

if(!function_exists('generateRandomString')){
 function generateRandomString($length = 4,$characters = '0123456789abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ'){
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }//end generateRandomString
}//end check generateRandomString
  
if(!function_exists('toTimestamp')){
 function toTimestamp($milliseconds=0){
 	//Date time statmp with milliseconds
 	$milliseconds = ($milliseconds==0)?date('U'):$milliseconds;
    $seconds = $milliseconds / 1000;
    $remainder = round($seconds - ($seconds >> 0), 3) * 1000;

    return date('YmdHis').$remainder;
 }//end toTimestamp function
}//end check toTimestamp

if ( ! function_exists('date_convert')){
	function date_convert($date,$format="Y-m-d") {
		if(trim($date)!="" && $date!=NULL){
			return date($format, strtotime($date));		
		}else{
			return null;
		}    	
	}
}//end check date_convert function

if ( ! function_exists('get_date')){
  function get_date($originalDate="",$format="d-m-Y") {
	$newDate = "";
    if(trim($originalDate)!="" && trim($originalDate)!=null && $originalDate!="0000-00-00" && $originalDate!="0000-00-00 00:00:00"){
          $newDate = date($format, strtotime($originalDate));
   	}
   		return $newDate;
  }
}//end check get_date

if ( ! function_exists('escape')){
  function escape($data){
			// Fix &entity\n;
			$data = trim($data);	
			$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
			$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
			$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
			$data = @html_entity_decode($data, ENT_COMPAT, 'UTF-8');
	
			// Remove any attribute starting with "on" or xmlns
			$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
	
			// Remove javascript: and vbscript: protocols
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
	
			// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
	
			// Remove namespaced elements (we do not need them)
			$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);		
	
			do
			{
					// Remove really unwanted tags
					$old_data = $data;
					$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
			}
			while ($old_data !== $data);
	
			// we are done...
			//return $data;
			
		   if (get_magic_quotes_gpc()){
				 $clean = mysql_escape_mimic(stripslashes2($data));
		   } else {
				 $clean = mysql_escape_mimic($data);
		   }
		   
		   //$clean1 = escapeshellcmd($clean);
		   
		   return htmlspecialchars($clean, ENT_QUOTES, 'UTF-8');
	}//escape fucntion
}//end check escape function exist

if ( ! function_exists('getChildNode')){
function getChildNode($list=array(),$parent_id=NULL,$parent_id_name="p_menu_id",$id_name="id"){
    $result = "";
    
    if($parent_id!=NULL){        
	    foreach($list as $cat){
	        if($cat[$parent_id_name] == $parent_id){
	           $current_id = $cat[$id_name];
	           $result.= ",".$current_id;
	           $result.= getChildNode($list, $current_id,$parent_id_name,$id_name);
	        }//end check parent_id is equal
	    }//end foreach
    }//end check parent_id is not null
            
    return $result;
}//end getChildNode function

}//end check exist getChildNode

if ( ! function_exists('checkLanguage')){
	
	function checkLanguage($lang=""){
		$ci = get_instance();
		
		if($ci->session->has_userdata('site_lang')==TRUE && $ci->session->userdata('site_lang') == strtolower($lang)){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}//end checkLanguage function
	
}//end check checkLanguage function exist



/**
* function getDateTimeDiff
* 
* @param undefined $currentDateTimeObj
* @param undefined $NewDateTime
* 
* @return $dateConvertObj or empty strig
* 
*  echo $dateConvertObj->days.' days total<br>';
*  echo $dateConvertObj->y.' years<br>';
*  echo $dateConvertObj->m.' months<br>';
*  echo $dateConvertObj->d.' days<br>';
*  echo $dateConvertObj->h.' hours<br>';
*  echo $dateConvertObj->i.' minutes<br>';
*  echo $dateConvertObj->s.' seconds<br>'; 
* 
*/

if ( ! function_exists('diff')){
	
	function diff($date1, $date2, $format = false){
	$diff = date_diff( date_create($date1), date_create($date2) );
	if ($format){
		return $diff->format($format);
	}
	
	return array('y' => $diff->y,
			'm' => $diff->m,
			'd' => $diff->d,
			'h' => $diff->h,
			'i' => $diff->i,
			's' => $diff->s
		);
	}
	
}//end check diff function exist

if(! function_exists('getFileInfo')){
	function getFileInfo($filename=""){
		if(trim($filename)!=""){
			$file = basename($filename);
			$file = preg_replace('/\s+/', '', $file);//remove space between words
			$filename_array = explode('.',$file);
			$ext = end($filename_array);
			$file = substr($file,0,-(strlen($ext)+1));
			return array('filename'=>$file,'extension'=>$ext);
		}
		return array('filename'=>'','extension'=>'');
	}
}//end getFileInfo

if(! function_exists('getModifierName')){
	function getModifierName($added_name="",$edited_name=""){
		if(trim($edited_name)!="" && $edited_name!=NULL){
			return ucwords($edited_name);
		}
		return ucwords($added_name);
	}
}//end getModifierName

if(! function_exists('getModifiedDate')){
	function getModifiedDate($added_date="",$edited_date=""){
		$edited_date = get_date(html_escape($edited_date));
		
		if($edited_date!=""){
			return $edited_date;
		}
		return get_date(html_escape($added_date));
	}
}//end getModifiedDate

if(! function_exists('createVisitor')){
	function createVisitor($menu_name="",$ip="") {
	  if($menu_name!="" && strtolower($menu_name)!="errors"){
	  	
	  	$ci = get_instance();
	  	$menu_type = (strtolower($menu_name)=="home") ? 1 : 2;
		
	  	$data = array(
	  			"v_type"=>$menu_type,
	  			"v_menu_name"=>$menu_name,
	  			"v_ip_address"=>$ip,
	  			"v_created_date"=>date('Y-m-d h:i:s'),
	  			);
	  	
	  	  $filter = array('v_menu_name'=>$menu_name,'v_ip_address'=>$ip,'DATE(v_created_date)'=>date('Y-m-d'));
	  	  $ci->db->select('count(1) as numrows');
	  	  $ci->db->from('comm_web_visitor');	
		  $ci->db->where($filter);	
		  $count = $ci->db->get()->row();
		  
		  if($count->numrows==0){
		  	$ci->db->insert("comm_web_visitor",$data);
		  }
	  	  
	  }	
	}//end function createVisitor
}//end exist createVisitor

if(! function_exists('getVisitorCount')){
   function getVisitorCount($web_home=TRUE) {
   
   $ci = get_instance();
   $count_row = 0;	
   
    if($web_home==TRUE){
   	   $query = $ci->db->query('SELECT COUNT(1) as count_rec FROM (SELECT COUNT(v_ip_address),DATE(v_created_date),v_ip_address FROM comm_web_visitor GROUP BY DATE(v_created_date),v_ip_address) as count_web_visitor');		
	   $count = $query->row();
	   $count_row = $count->count_rec;
    }
    
    return $count_row;
   }//end function getVisitorCount
}//end exist getVisitorCount

if(! function_exists('putVisitorCountImg')){
   function putVisitorCountImg($count_visit=0,$color="black",$dir='assets/img/counter/') {
   
    $number=$count_visit; // Storing the counter value in another variable
	$divisor=10; // setting the divisor value to 10
	$digitarray=array(); // creating an array

	do {
		$digit=($number % $divisor); // looping through the till all digits are taken
	    $number=($number/$divisor); // getting the digits from right side
	     array_push($digitarray,$digit); // storing them in the array
	} while($number >=1); // condition of do loop

	// array is to be reversed as digits are in reverse order
	$digitarray=array_reverse($digitarray);

	while (list ($key, $val) = each ($digitarray)) { // looping through the array
	  echo img(array('src'=>base_url($dir.$color.'/'.$val.'.gif'),'alt'=>$val));
	} // end of the loop
   
   }//end function putVisitorCountImg
}//end exist putVisitorCountImg

if(! function_exists('getLastUpdatedPage')){
   function getLastUpdatedPage($page_slug='') {
   
   $ci = get_instance();
   $updated_date = "";	
   
    if(trim($page_slug)!=""){
       $sql = 'SELECT COALESCE(max(MostRecentDate),"") as last_updated_date FROM (SELECT CASE WHEN page_added_date > page_edit_date THEN page_added_date ELSE page_edit_date END AS MostRecentDate FROM comm_pages WHERE page_url=?) as updated_date';
   	   $query = $ci->db->query($sql,array($page_slug));		
	   $count = $query->row();
	   $updated_date = get_date($count->last_updated_date,'d M, Y');
    }
    
    return $updated_date;
   }//end function getLastUpdatedPage
}//end exist getLastUpdatedPage

if(! function_exists('getLastUpdatedModule')){
   function getLastUpdatedModule($table='') {
   
   $ci = get_instance();
   $updated_date = "";	
   
    if(trim($table)!=""){
       $sql = 'SELECT COALESCE(max(MostRecentDate),"") as last_updated_date FROM (SELECT CASE WHEN added_date > edit_date THEN added_date ELSE edit_date END AS MostRecentDate FROM '.str_replace("'","`",$ci->db->escape($table)).') as updated_date';
   	   $query = $ci->db->query($sql);	

	   $count = $query->row();
	   $updated_date = get_date($count->last_updated_date);
    }
    
    return $updated_date;
   }//end function getLastUpdatedModule
}//end exist getLastUpdatedModule

if ( ! function_exists('getHashKey')){
  function getHashKey(){
	$key = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)); 
	return $key;
  }//end getHash function 
}//end check getHashKey function exist


function sidebarMenu() {
	$ci = get_instance();
	$menus = customFrontMenu(3);
	$mainmenu = array_keys(array_column($menus, 'p_menu_id'), 0);
	$html ="";
	$i=0;
	foreach ($mainmenu as $menuskey) {
		# code...
		if($menus[$menuskey]['p_menu_id']==0)
		{
			$submenukeys = array_keys(array_column($menus, 'p_menu_id'),$menus[$menuskey]["id"]); 
			$html .= '<div data-controller= "'.$menus[$menuskey]['controller_name'].'" class="panel panel-default" id="accordion_'.$menus[$menuskey]["id"].'">';
			$html .= '<div class="panel-heading">
			            <h4 class="panel-title">';

			if($ci->uri->segment(1)==$menus[$menuskey]['controller_name']){
				$cls = "active";
			}else{
				$cls = "";
			}

			if ($menus[$menuskey]['tab_same_new']==1) $target = '';
			else $target = 'target="_blank"';

			if (count($submenukeys)>0) {
				$html .= '<a  class="'.$cls.'" href="'.$menus[$menuskey]['controller_name'].'"><i class="fa fa-hand-o-right " aria-hidden="true"></i>'.$menus[$menuskey]['menu_name'].'</a><a data-toggle="collapse" class="cols collapsed" data-parent="#accordion" href="#collapse_'.$menus[$menuskey]["id"].'"></a>';
				
			} else {
				if ($menus[$menuskey]['page_module_link']==3 ) {
					$html .= ' <a class="'.$cls.'" href="'.$menus[$menuskey]['controller_name'].'" $target ><i class="fa fa-hand-o-right" aria-hidden="true"></i> '.$menus[$menuskey]['menu_name'].'</a>';
				} else {
					$html .= ' <a  '.$target.'   class="'.$cls.'" href="'.base_url().$menus[$menuskey]['controller_name'].'" ><i class="fa fa-hand-o-right" aria-hidden="true"></i> '.$menus[$menuskey]['menu_name'].'</a>';
				}						
			}					               	               
			$html .='   </h4>
		         	</div>';
	     	if (count($submenukeys)>0) {
	     		$html .=  childsidebarMenu($menus,$menuskey,$submenukeys,$i);
	     	} 
	     	$i++;
			$html .= "</div>";
		}
	}
	echo $html;
} //end sidebarMenu

function childsidebarMenu($menus,$menuskey,$submenukeys,$pos) {
	 $ci = get_instance();
	$html ="";
	foreach ($submenukeys as $submenukey1) {
		# code...
		$submenumskeys = array_keys(array_column($menus, 'p_menu_id'),$menus[$submenukey1]["id"]);
		if($ci->uri->segment(1)==$menus[$submenukey1]['controller_name']){
			 $cls = "show";
		} else if($ci->uri->segment(1)==$menus[$menuskey]['controller_name']) {
			 $cls = "show";
		} else{
			$cls = "";
		}
	}
	//if ($pos==0) {$cls = "show";} else { $cls ="";}
	$html .= '<div data-controller= "'.$menus[$menuskey]['controller_name'].'" id="collapse_'.$menus[$menuskey]["id"].'" class="panel-collapse collapse '.$cls.' ">
			<div class="panel-body">
   				<ul>';
    if (!empty($menus[$menuskey]['controller_name']) && $menus[$menuskey]['controller_name']!="#") {
    	if ($menus[$menuskey]['tab_same_new']==1) $target = "";
		else $target = "_blank";

    	//$html .= '<li><a href= "'.$menus[$menuskey]['controller_name'].'" target="'.$target.'">'.lang("home").'</a></li>';
    }


	foreach ($submenukeys as $submenukey) {
		# code...
		$submenumskeys = array_keys(array_column($menus, 'p_menu_id'),$menus[$submenukey]["id"]);
		if($ci->uri->segment(1)==$menus[$submenukey]['controller_name']){
			$current = "active";
		}  else{
			$current = "";
		}
		$html .= ' <li class="'.$current .'">';	

		if ($menus[$submenukey]['tab_same_new']==1) $target = '';
		else $target = 'target="_blank"';


		if (count($submenumskeys)>0) {
			$html .= '<a '.$current.' data-toggle="collapse" data-parent="#accordion" '.$menus[$submenukey]["id"].' href="#collapse_'.$menus[$submenukey]["id"].'"><i class="fa fa-hand-o-right" aria-hidden="true"></i>'.$menus[$submenukey]['menu_name'].'</a>';				
		}else {
			if ($menus[$submenukey]['page_module_link']==3 ) {			
				$html .= '<a '.$current.' '.$target.' href="'.$menus[$submenukey]['controller_name'].'"><span>»</span>'.$menus[$submenukey]['menu_name'].'</a>';
			} else {
				$html .= '<a '.$current.' '.$target.' href="'.base_url().$menus[$submenukey]['controller_name'].'"><span>»</span>'.$menus[$submenukey]['menu_name'].'</a>';
			}			
		}
		if (count($submenumskeys)>0) {
			$html .= childsidebarMenu($menus,$submenukey,$submenumskeys,2);
		}
		$html .= ' </li>';
	}
	$html .= '		</ul>
            </div>
         </div>';
    return  $html;
} // end childsidebarMenu


function  getSiteDetails() {
		$ci= get_instance();
		$filter = array('id'=>1);
		
		if(checkLanguage("english")){
			$col_name = 'tag_line_en as title,';
		}else{
			$col_name = 'tag_line_hi as title,';
		}
		
		$col_name .= 'logo,website_name,account_details';
		
		$ci->db->select($col_name);
		$query = $ci->db->get_where('comm_settings',$filter);
		return $query->row();
}// end getSiteDetails


/////////////////////////////////////////////////// New Website //////////////////////

//buildFrontHomepagemiddleMenu function is used for create front footer menu
if ( ! function_exists('buildTopMenu')){
	function buildTopMenu($classCss=""){		
		$query = array();
		$str = '';
		
		$query = customFrontMenu(1);
		
		if(count($query)>0){
			$str .= '';
			foreach($query as $row){
				if ($row['p_menu_id']==0) {
				$str .='<div class="pt_menu"><div class="parentMenu">';
				if(trim($row['controller_name'])!="" && $row['controller_name']!=NULL && trim($row['controller_name'])!="#"){
				 if($row['page_module_link']==3 && trim($row['controller_name'])!="#"){
				 	if($row['tab_same_new']==1){
				  	$str .='<a title="'.html_escape($row['menu_name']).'" href="'.html_escape($row['controller_name']).'">';
                                        
				   }else{
				  	$str .='<a title="'.html_escape($row['menu_name']).'" target="_blank" href="'.html_escape($row['controller_name']).'">';
                                        
				   }	
				 }else if($row['page_module_link']==3 && trim($row['controller_name'])=="#"){
				 	if($row['tab_same_new']==1){
				 		$str .='<a  title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                               
				 	}else{
						$str .='<a target="_blank" title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                               
					}
				 	
				 }else{
				 	if($row['tab_same_new']==1){
				  	$str .='<a title="'.html_escape($row['menu_name']).'" href="'.base_url().html_escape($row['controller_name']).'">';
                                        
				    }else{
				  	$str .='<a title="'.html_escape($row['menu_name']).'" target="_blank" href="'.base_url().html_escape($row['controller_name']).'">';
                                       
				    }	
				 }				  
				  				
				}else{
					$str .='<a title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                        
				}				
				$str .='<span>'.html_escape($row['menu_name']).'</span>';
				$str .='</a></div></div>';
				}
			}
			$str .= ''.PHP_EOL;
			return $str;
		}else{
			return "";
		}
		
	}//end function
	
}//end buildFrontBottomMenu menu


if ( ! function_exists('buildMobileTopMenu')){
	function buildMobileTopMenu($classCss=""){		
		$query = array();
		$str = '';
		
		$query = customFrontMenu(1);
		
		if(count($query)>0){
			$str .= '<ul id="ma-mobilemenu" class="mobilemenu nav-collapse collapse">';
			foreach($query as $row){
				if ($row['p_menu_id']==0) {
				$str .='<li>';
				if(trim($row['controller_name'])!="" && $row['controller_name']!=NULL && trim($row['controller_name'])!="#"){
				 if($row['page_module_link']==3 && trim($row['controller_name'])!="#"){
				 	if($row['tab_same_new']==1){
				  	$str .='<a title="'.html_escape($row['menu_name']).'" href="'.html_escape($row['controller_name']).'">';
                                        
				   }else{
				  	$str .='<a title="'.html_escape($row['menu_name']).'" target="_blank" href="'.html_escape($row['controller_name']).'">';
                                        
				   }	
				 }else if($row['page_module_link']==3 && trim($row['controller_name'])=="#"){
				 	if($row['tab_same_new']==1){
				 		$str .='<a  title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                               
				 	}else{
						$str .='<a target="_blank" title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                               
					}
				 	
				 }else{
				 	if($row['tab_same_new']==1){
				  	$str .='<a title="'.html_escape($row['menu_name']).'" href="'.base_url().html_escape($row['controller_name']).'">';
                                        
				    }else{
				  	$str .='<a title="'.html_escape($row['menu_name']).'" target="_blank" href="'.base_url().html_escape($row['controller_name']).'">';
                                       
				    }	
				 }				  
				  				
				}else{
					$str .='<a title="'.html_escape($row['menu_name']).'" href="javascript:void(0)">';
                                        
				}				
				$str .='<span>'.html_escape($row['menu_name']).'</span>';
				$str .='</a></li>';
				}
			}
			$str .= '</ul>'.PHP_EOL;
			return $str;
		}else{
			return "";
		}
		
	}//end function
	
}//end buildFrontBottomMenu menu



?>