<?php
/**
* You can check query out put using this
* echo $ci->db->last_query();
*/

if(!function_exists('DisplayStatus')){
	
	function DisplayStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-primary">Active</span>';
		}else{
			$str = '<span class="badge badge-warning">Inactive</span>';
		}
		return $str;
	}//end DisplayStatus function
	
}//end check DisplayStatus

if(!function_exists('PublishStatus')){
	
	function PublishStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-primary">Publish</span>';
		}else{
			$str = '<span class="badge badge-danger">Pending</span>';
		}
		return $str;
	}//end PublishStatus function
	
}//end check PublishStatus

if(!function_exists('PayStatus')){
	
	function PayStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-primary">Done</span>';
		}else{
			$str = '<span class="badge badge-danger">Pending</span>';
		}
		return $str;
	}//end PayStatus function
	
}//end check PayStatus

if(!function_exists('AplicationStatus')){
	
	function AplicationStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-primary">Approved</span>';
		}else if($val==2){
			$str = '<span class="badge badge-danger">Rejected</span>';
		}else{
			$str = '<span class="badge badge-default">Pending</span>';
		}
		return $str;
	}//end AplicationStatus function
	
}//end check AplicationStatus



if(!function_exists('ActiveStatus')){
	
	function ActiveStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-primary">Active</span>';
		}else if($val==2){
			$str = '<span class="badge badge-danger">Reject</span>';
		}else{
			$str = '<span class="badge badge-warning">Inactive</span>';
		}
		return $str;
	}//end ActiveStatus function
	
}//end check ActiveStatus

if(!function_exists('DefaultStatus')){
	
	function DefaultStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-success">Yes</span>';
		}else{
			$str = '<span class="badge badge-danger">No</span>';
		}
		return $str;
	}//end PublishStatus function
	
}//end check PublishStatus

if(!function_exists('ArchiveStatus')){
	
	function ArchiveStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-primary">Yes</span>';
		}else{
			$str = '<span class="badge badge-danger">No</span>';
		}
		return $str;
	}//end ArchiveStatus function
	
}//end check ArchiveStatus

if(!function_exists('DeleteStatus')){
	
	function DeleteStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-danger">Yes</span>';
		}else{
			$str = '<span class="badge badge-primary">No</span>';
		}
		return $str;
	}//end DeleteStatus function
	
}//end check DeleteStatus

if(!function_exists('ReadStatus')){
	
	function ReadStatus($val){
		$str = "";
		if($val==1){
			$str = '<span class="badge badge-success">Read</span>';
		}else{
			$str = '<span class="badge badge-warning">Unread</span>';
		}
		return $str;
	}//end ReadStatus function
	
}//end check ReadStatus

if(!function_exists('getUserType')){
	
	function getUserType($val=0){
		$str = "";
		$val=(int)$val;
		if($val==1){
			$str = 'Company User';
		}else if($val==2){
			$str = 'Individual User';
		}else{
			$str = 'Implementing Partner';
		}
		return $str;
	}//end getUserType function
	
}//end check getUserType

if(!function_exists('getAdminType')){
	
	function getAdminType($upm_id=0,$dist_id=0,$dept_id=0){
		
		$str = "";
		$upm_id=(int)$upm_id;
		$ci = & get_instance();
		
		if($upm_id==3){
			
		 $filter = array('department_id'=>$dept_id,'status'=>1);
		 $query = $ci->db->select('department_name')->get_where('comm_departments',$filter);
		 $row = $query->row();

		  if(isset($row)){
			$str = "Department User (".$row->department_name.")";
		  }else{
		  	$str = "Department User";
		  }
		 
		}else if($upm_id==4){
			
	  	 $filter = array('district_code'=>$dist_id);
		 $query = $ci->db->select('district_name')->get_where('comm_district',$filter);
		
		 $row = $query->row();
		
		  if(isset($row)){
			$str = "District User (".$row->district_name.")";
		  }else{
		  	$str = "District User";
		  }	  
		  	 
	    }else{
	    	$str = "Administrator";
	    }//end check logged id
		
		return $str;
	}//end getAdminType function
	
}//end check getAdminType

if(!function_exists('InterestStatus')){
	
	function InterestStatus($val=0,$nameOnly=FALSE){
		$str = "";
		if($val==1){
			$strName = "Approved";
			$str = '<span class="badge badge-success">Approved</a>';
		}else{
			$strName = "Pending";
			$str = '<span class="badge badge-warning">Pending</a>';
		}
		
		if($nameOnly==TRUE){
			return $strName;
		}else{
			return $str;
		}
	}//end InterestStatus function
	
}//end check InterestStatus

if(!function_exists('InterestCount')){
	
	function InterestCount($val=0,$status,$project_id=0){
		$str = "";
		
		if($val>0){
		  $url = base_url("manage/Project/interestlist/").encrypt_decrypt('encrypt',$project_id);
		}else{
		  $url = "javascript:void(0);";
		}
		
		if($status==1){
			$str = '<a target="_blank" href="'.$url.'" class="badge badge-primary">'.$val.'</a>';
		}else{
			$str = '<a href="'.$url.'" class="badge badge-warning">'.$val.'</a>';
		}
		
		return $str;
	}//end InterestCount function
	
}//end check InterestCount

if(!function_exists('ProjectStatus')){
	
	function ProjectStatus($val=0,$nameOnly=FALSE){
		$str = "";
		$val = (int)$val;
		
		switch($val){
			case 1:
			    $strName = "Approved";
			    $str = '<span class="badge badge-success">'.$strName.'</span>';
				break;
			case 2:
				$strName = "Not Yet Started";
			    $str = '<span class="badge badge-primary">'.$strName.'</span>';
				break;
			case 3:
				$strName = "Ongoing";
			    $str = '<span class="badge badge-info">'.$strName.'</span>';
				break;
			case 4:
			 	$strName = "Completed";
			    $str = '<span class="badge badge-success">'.$strName.'</span>';
				break;
		    case 5:
		    	$strName = "On Hold";
			    $str = '<span class="badge badge-danger">'.$strName.'</span>';
				break;
			
			default:
				$strName = "Pending";
			    $str = '<span class="badge badge-warning">'.$strName.'</span>';
				break;
		}
		
		if($nameOnly==TRUE){
			return $strName;
		}else{
			return $str;
		}
	}//end ProjectStatus function
	
}//end check ProjectStatus

if(!function_exists('ProjectStatusList')){
	
	function ProjectStatusList(){
		$project_status = array(
		     ''=>'--SELECT PROJECT STATUS--',
		     '0'=>'Pending',
		     '1'=>'Approved',
		     '2'=>'Not Yet Started',
		     '3'=>'Ongoing',
		     '4'=>'Completed',
		     '5'=>'On Hold'
		);
		
		return $project_status;
	}//end ProjectStatusList function
	
}//end check ProjectStatusList

if(!function_exists('ProjectDocStatus')){
	
	function ProjectDocStatus($val=0,$nameOnly=FALSE){
		$str = "";
		$val = (int)$val;
		
		switch($val){
			case 1:
			    $strName = 'Approved';
			    $str = '<span class="badge badge-success">'.$strName.'</span>';	    
				break;
			case 2:
			    $strName = 'Reject';
			    $str = '<span class="badge badge-danger">'.$strName.'</span>';
				break;
						
			default:
			    $strName = 'Pending';
			    $str = '<span class="badge badge-warning">'.$strName.'</span>';
				break;
		}
		if($nameOnly==TRUE){
			return $strName;
		}else{
			return $str;
		}
		
	}//end ProjectDocStatus function
	
}//end check ProjectDocStatus

if(!function_exists('ProjectDocStatusList')){
	
	function ProjectDocStatusList(){
		$project_status = array(
		  ''=>'--SELECT PROJECT STATUS--',
		  '0'=>'Pending',
		  '1'=>'Approved',
		  '2'=>'Reject'
		);
		
		return $project_status;
	}//end ProjectDocStatusList function
	
}//end check ProjectDocStatusList

if(!function_exists('MilestoneStatus')){
	
	function MilestoneStatus($val=0,$nameOnly=FALSE){
		$str = "";
		$val = (int)$val;
		
		switch($val){
			case 0:
			    $strName = 'Not Started Yet';
			    $str = '<span class="badge badge-primary">'.$strName.'</span>';	    
				break;
			case 1:
			    $strName = 'Started';
			    $str = '<span class="badge badge-info">'.$strName.'</span>';
				break;
			case 2:
			    $strName = 'Completed';
			    $str = '<span class="badge badge-success">'.$strName.'</span>';
				break;
			case 3:
			    $strName = 'Reject';
			    $str = '<span class="badge badge-danger">'.$strName.'</span>';
				break;
			case 4:
			    $strName = 'Completed & Approved';
			    $str = '<span class="badge badge-success">'.$strName.'</span>';
				break;
						
			default:
			    $strName = 'Not Started Yet';
			    $str = '<span class="badge badge-warning">'.$strName.'</span>';
				break;
		}
		if($nameOnly==TRUE){
			return $strName;
		}else{
			return $str;
		}
		
	}//end MilestoneStatus function
	
}//end check MilestoneStatus

if(!function_exists('MilestoneStatusList')){
	
	function MilestoneStatusList(){
		$milestone_status = array(
		  ''=>'--SELECT MILESTONE STATUS--',
		  '0'=>'Not Started Yet',
		  '1'=>'Started',
		  '2'=>'Completed',
		  '3'=>'Reject',
		  '4'=>'Completed & Approved'
		);
		
		return $milestone_status;
	}//end MilestoneStatusList function
	
}//end check MilestoneStatusList

if(!function_exists('MilestonePercentageList')){
	
	function MilestonePercentageList(){
		$milestone_percentage = array(
		  ''=>'--SELECT MILESTONE PERCENTAGE--',
		  '10'=>'10%',
		  '20'=>'20%',
		  '30'=>'30%',
		  '40'=>'40%',
		  '50'=>'50%',
		  '60'=>'60%',
		  '70'=>'70%',
		  '80'=>'80%',
		  '90'=>'90%',
		  '100'=>'100%'
		);
		
		return $milestone_percentage;
	}//end MilestonePercentageList function
	
}//end check MilestonePercentageList

if(!function_exists('getDashboardLink')){
	
	function getDashboardLink($user_type=0){
		$str = "";
		$user_type = (int)$user_type;
		
		switch($user_type){
			case 1:
			  $str = anchor('company/dashboard','<em class="nc-icon nc-dashboard-level"></em> Dashboard',array('class'=>'btn-link','title'=>'Company User Dashboard'));	    
			  break;
			case 2:
			  $str = anchor('individual/dashboard','<em class="nc-icon nc-dashboard-level"></em> Dashboard',array('class'=>'btn-link','title'=>'Individual User Dashboard'));
			  break;
			case 3:
			 $str = anchor('agency/dashboard','<em class="nc-icon nc-dashboard-level"></em> Dashboard',array('class'=>'btn-link','title'=>'Implementing Partner Dashboard'));
			  break;						
			default:
			  $str = '';
			  break;
		}
		return $str;
		
	}//end getDashboardLink function
	
}//end check getDashboardLink

if(!function_exists('chkEmptyNonZero')){
	
	function chkEmptyNonZero($val,$addSign=FALSE){
		$str = "";
		if($val!="" && $val!=0){
			$str = ($addSign==TRUE)?"+".$val:$val;
		}
		return $str;
	}//end ArchiveStatus function
	
}//end check ArchiveStatus

if(!function_exists('getSlider')){	
	function getSlider($category=1,$limit=10){
		$ci = & get_instance();
		$filter = array('is_delete'=>0,'status'=>1);
		$filter['cat_id'] = $category;
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title,';
		}else{
			$col_name = 'title_hi as title,';
		}
		
		$col_name .= 'attachment,cat_id, desc_url';
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_sliders',$filter);
		return $query->result();
		
	}//end getSlider function
	
}//end getSlider function exist

if(!function_exists('getDrivingForce')){	
	function getDrivingForce($limit=10){
		$ci = & get_instance();
		$filter = array('is_delete'=>0,'status'=>1);
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title,designation_en as designation,';
		}else{
			$col_name = 'title_hi as title,designation_hi as designation,';
		}
		
		$col_name .= 'attachment';
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_messages',$filter);
		return $query->result();
		
	}//end getSlider function
	
}//end getSlider function exist

if(!function_exists('NotificationKey')){
	
	function NotificationKey(){
		$key = time() + floor(rand()*10000);
		return $key;
	}//end NotificationKey function
	
}//end check NotificationKey

if(!function_exists('getUnreadNotification')){
	
	function getUnreadNotification($id=0){
	  if($id!=0){
	  	$ci = & get_instance();
		$ci->db->select('count(1) as total_notification');
		$filter = array('recipent_id'=>$id,'is_unread'=>0);
		$query = $ci->db->get_where('comm_notification',$filter);
		$row = $query->row();
		
		if(isset($row)){
			return $row->total_notification;
		}
	  }//end check logged id
		return 0;
	}//end getUnreadNotification function
	
}//end check getUnreadNotification

if(!function_exists('getTestimonial')){	
	function getTestimonial($limit=10){
		$ci = & get_instance();
		$filter = array('is_delete'=>0,'status'=>1);
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title,description_en as description,';
		}else{
			$col_name = 'title_hi as title,description_hi as description,';
		}
		
		$col_name .= 'attachment , id';
		 
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_testimonials',$filter);
		
		$str = '';
		if(count($query->result())>0){
			foreach($query->result() as $row){
				$image_properties = array(
		        'src'   => 'uploads/testimonial/'.html_escape($row->attachment),
		        'alt'   => html_escape($row->title),
		        'class' => 'img-thumbnail mt-2 mt-lg-0',
		        'title' => html_escape($row->title)
				);						
				$str .='<div><div class="row">'.PHP_EOL;
				$str .='<div class="col-lg-9">'.PHP_EOL;
				$str .= '<h3>'.html_escape($row->title).'</h3>'.PHP_EOL;
				$str .= '<p>"'.html_escape($row->description).'"</p>'.PHP_EOL;
				$str .= '<a href="'.base_url('testimonial/'.$row->id.' ').'" class="btn btn-success">'.$ci->lang->line('know_more').' <i class="las la-arrow-right"></i></a>';
				$str .= '</div>';
				if(isset($row->attachment) && trim($row->attachment)!=""){					
					$str .= '<div class="col-lg-3">';	
					$str .= img($image_properties);
					$str .= '</div>';
				}
						
				$str .='</div>'.PHP_EOL;					
				$str .='</div>'.PHP_EOL;
			}
			return $str;
		}else{
			return "";
		}
		
	}//end getSlider function
	
}//end getSlider function exist

if(!function_exists('getHomeSlider')){	
	function getHomeSlider($limit=10){
		$ci = & get_instance();
		$ci->load->helper('text');
		
		$filter = array('is_delete'=>0,'status'=>1);
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title,';
		}else{
			$col_name = 'title_hi as title,';
		}
		
		$col_name .= 'attachment,desc_url';
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_sliders',$filter);
		
		$str = '';
		if(count($query->result())>0){
			foreach($query->result() as $row){
				$image_properties = array(
		        'src'   => 'uploads/slider/'.$row->attachment,
		        'alt'   => html_escape($row->title),
		        'class' => 'img-responsive',
		        'title' => html_escape($row->title)
				);
				
				$str .='<div class="item">'.PHP_EOL;
				$str .= img($image_properties);
				
				$str .='<div class="discription">'.PHP_EOL;
				$str .= character_limiter(html_escape($row->title),120);
				if(trim($row->desc_url)!=""){
				 $str .= '<a target="_blank" href="'.$row->desc_url.'" class="btn-gallery">'.$ci->lang->line('read_more').'</a>';	
				}else{
				 $str .= '<a target="_blank" href="javascript:void(0);" class="btn-gallery">'.$ci->lang->line('read_more').'</a>';
				}			
							
				$str .='</div>'.PHP_EOL;					
				$str .='</div><!--End item-->'.PHP_EOL;
			}
			return $str;
		}else{
			return "";
		}
		
	}//end getHomeSlider function
	
}//end getHomeSlider function exist

if(!function_exists('getImpWebImg')){	
	function getImpWebImg($limit=10){
		$ci = & get_instance();
		$filter = array('is_delete'=>0,'is_slide'=>1,'status'=>1,'trim(attachment)!='=>"",'trim(attachment)!='=>NULL);
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title,';
		}else{
			$col_name = 'title_hi as title,';
		}
		
		$col_name .= 'attachment,url';
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_important_website',$filter);
		return $query->result();
		
	}//end getImpWebImg function
	
}//end getImpWebImg function exist

if(!function_exists('getSocailLink')){	
	function getSocailLink(){
		$ci = & get_instance();
		
		$query = $ci->db->get_where('comm_social',array('link !=' =>''));
		$str = '';
		if(count($query->result())>0){
		  foreach($query->result() as $row){
		   $str .='<li>';
		   $str .='<a title="'.$row->name.'" target="_blank" href="'.$row->link.'">';
		   $str .='<span class="'.$row->location.'"></span>';
		   //$str .=$row->name;
		   $str .='</a></li>';
		  }
		  return $str;
		}else{
			return "";
		}
	}//end getSocailLink function
	
}//end getSocailLink function exist

if(!function_exists('getWhatsNew')){
	
	function getWhatsNew($limit=5){
		$ci = & get_instance();
		$tbl = "comm_whats_new";
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title, attachment, archive_exp_date,id';
		}else{
			$col_name = 'title_hi as title, attachment, archive_exp_date,id';
		}

		$filter = array('status'=>1,'is_archive'=>0,'is_delete'=>0);
		
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		if(count($query->result())>0){
                        $str .='<div class="newsupdate-wrapper">';
                        $str .='<div class="panel panel-default">';
                        $str .='<div class="panel-heading"> <span class="glyphicon glyphicon-list-alt"></span> <b>What’s New</b></div>';
                        $str .='<div class="panel-body">';
                        $str .='<div class="row">';
                        $str .='<div class="col-xs-12">';
                        $str .='<ul id="demo3">';
			foreach($query->result() as $row){

				$str .='<li class="news-item"><span class="date">'.get_date($row->archive_exp_date,"d-M-Y").'<img src="'.base_url('assets/images/new-icon.gif').'" width="30" alt="new-icon" /></span>'.$row->title.'<a title="Read More" target="_blank" class="links2" href="';
				
				$str .=base_url('whats-new/nid/').encrypt_decrypt('encrypt',$row->id);
				
							
				$str .='">';
				//$str .=html_escape($row->title);
				$str .=''.$ci->lang->line('read_more').' <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>';
			}
                        $str .= '</div>';
                        $str .= '</div>';
                        $str .= '</div>';
                        $str .= '<div class="panel-footer"><a href="'.base_url('whats-new').'" class="link">'.$ci->lang->line('view_all').' <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></div>';
                        $str .= '</div>';
                        $str .= '</div>';
			$str .= '</ul>'.PHP_EOL;
			if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('whats-new').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';
			}
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getWhatsNew function
	
}//end getWhatsNew function exist

if(!function_exists('getCirculars')){
	
	function getCirculars($limit=5){
		$ci = & get_instance();
		$tbl = "comm_circulars";
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title, attachment,is_alert';
		}else{
			$col_name = 'title_hi as title, attachment,is_alert';
		}

		$filter = array('status'=>1,'DATE(archive_exp_date) >= '=>date('Y-m-d'),'is_delete'=>0);
		
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$ci->db->order_by('order_preference ASC');
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		if(count($query->result())>0){
			
			foreach($query->result() as $row){
				
				if($row->is_alert == 1){
					$isAlert = '<img src="'.base_url('assets/img/').'new5.gif"  class="img-responsive">';
					}
					else{
					$isAlert = '';
						}

				$str .='<div><a title="'.$row->title.'" target="_blank" href="';
				if(trim($row->attachment)!="" && $row->attachment!=NULL){
					$str .=base_url('uploads/files/').$row->attachment;
				}else{
					$str .="javascript:void(0)";
				}				
				$str .='">';
				$str .=html_escape($row->title);
				$str .=$isAlert;
				$str .='</a></div>';
			}
		
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getCirculars function
	
}//end getCirculars function exist

if(!function_exists('getTenders')){
	
	function getTenders($limit=5){
		$ci = & get_instance();
		$tbl = "comm_tender";
		
		if(checkLanguage("english")){
			$col_name = 'SUBSTRING_INDEX(title_en, " ", 10) as title,is_alert';
		}else{
			$col_name = 'SUBSTRING_INDEX(title_hi, " ", 10) as title,is_alert';
		}

		$filter = array('status'=>1,'DATE(archive_exp_date) >= '=>date('Y-m-d'),'is_delete'=>0);
		
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$ci->db->order_by('id desc');
		$query = $ci->db->get_where($tbl,$filter);
	    $ci->db->last_query();
		$str = '';
		if(count($query->result())>0){
			
			foreach($query->result() as $row){
				
				if($row->is_alert == 1){
					$isAlert = '<img src="'.base_url('assets/img/').'new5.gif"  class="img-responsive">';
					}
					else{
					$isAlert = '';
						}

				$str .='<div><a title="'.$row->title.'" target="_blank" href="';
				$str .=base_url('tender');
				$str .='">';
				$str .=html_escape($row->title);
				$str .=$isAlert;
				$str .='</a></div>';
			}
		
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getCirculars function
	
}//end getTenders function exist



if(!function_exists('getCircularCategory')){
	
	function getCircularCategory($limit=5){
		$ci = & get_instance();
		$tbl = "comm_circular_category";
		
		if(checkLanguage("english")){
			$col_name = 'cat_title_en as title';
		}else{
			$col_name = 'cat_title_hi as title';
		}

		$filter = array('cat_status'=>1);
		
		$ci->db->select('*,'.$col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		if(count($query->result())>0){
			$str .= '<ul>';
			foreach($query->result() as $row){
				$cat_id = encrypt_decrypt('encrypt',$row->cat_id);

				$str .='<li><a title="'.$row->title.'" href="'.base_url('circular/index/').$cat_id.'">';
				$str .=html_escape($row->title);
				$str .='</a></li>';
			}
			$str .= '</ul>'.PHP_EOL;
			
			if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('circular').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';
			}
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getCircularCategory function
	
}//end getCircularCategory function exist

if(!function_exists('getHospitalCategory')){
	
	function getHospitalCategory($limit=5){
		$ci = & get_instance();
		$tbl = "comm_hospital_category";
		
		if(checkLanguage("english")){
			$col_name = 'cat_title_en as title';
		}else{
			$col_name = 'cat_title_hi as title';
		}

		$filter = array('cat_status'=>1);
		
		$ci->db->select('*,'.$col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		if(count($query->result())>0){
			$str .= '<ul>';
			foreach($query->result() as $row){
				$cat_id = encrypt_decrypt('encrypt',$row->cat_id);

				$str .='<li><a title="'.$row->title.'" href="'.base_url('hospital/').$cat_id.'">';
				$str .=html_escape($row->title);
				$str .='</a></li>';
			}
			$str .= '</ul>'.PHP_EOL;
			
			if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('hospital').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';
			}
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getHospitalCategory function
	
}//end getHospitalCategory function exist

if(!function_exists('getEntitlement')){
	
	function getEntitlement($limit=5,$condition=array()){
		$ci = & get_instance();
		$tbl = "comm_entitlement";
		
		$col_name = '*';
		if(checkLanguage("english")){
			$col_name .= ',title_en as title, description_hi as description';
		}else{
			$col_name .= ',title_hi as title, description_en as description';
		}

		$filter = array('status'=>1,'is_delete'=>0);
		if(count($condition)>0){
			foreach($condition as $key1 => $val1){
			  $filter[$key1] = $val1;
			}
		}	
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');	
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		
		if(count($query->result())>0){
			$str .= '<ul>';
			foreach($query->result() as $row){

				$str .='<li><a title="'.$row->title.'" target="_blank" href="entitlement/view/';
				$str .=encrypt_decrypt('encrypt',$row->id);				
				$str .='">';
				$str .=html_escape(word_limiter($row->title,1));
				$str .='</a></li>';
			}
			$str .= '</ul>'.PHP_EOL;
			
			/*if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('entitlement').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';			
			}*/
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getEntitlement function
	
}//end getEntitlement function exist

if(!function_exists('getImpLinks')){
	
	function getImpLinks($limit=0){
		$ci = & get_instance();
		$tbl = "comm_important_links";
		$new_limit = $limit+1;
		if(checkLanguage("english")){
			$col_name = 'title_en as title, url';
		}else{
			$col_name = 'title_hi as title, url';
		}

		$filter = array('status'=>1,'is_delete'=>0);
		$ci->db->order_by('order_preference ASC');
		$ci->db->select($col_name);
                
		if($limit > 0){
			$ci->db->limit($new_limit);
		}
        $query = $ci->db->get_where($tbl,$filter);
        // print_r($ci->db->last_query());
		$str = '';
		$return = array();
		
		if(count($query->result())>0){
			$result_set = $query->result();
			if(count($result_set) > $limit && $limit > 0 ){ 
			unset($result_set[$limit]);
			$reindex = array_values($result_set);
			$result_set = $reindex; 
			}
			$str .= '<ul>';
			foreach($result_set as $row){

				$str .='<li><a title="'.$row->title.'" target="_blank" href="';
				if(trim($row->url)!="" && $row->url!=NULL){
					$str .=$row->url;
				}else{
					$str .="javascript:void(0)";
				}				
				$str .='">';
				$str .=stripslashes2($row->title);
				$str .='</a></li>';
			}
			$str .= '</ul>'.PHP_EOL;
			
			/*if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('important-links').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';
			}*/
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getImpLinks function
	
}//end getImpLinks function exist

if(!function_exists('getImpWebsites')){
	
	function getImpWebsites($limit=5){
		$ci = & get_instance();
		$tbl = "comm_important_website";
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title, url';
		}else{
			$col_name = 'title_hi as title, url';
		}

		$filter = array('status'=>1,'is_delete'=>0);
		
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		
		if(count($query->result())>0){
			$str .= '<ul>';
			foreach($query->result() as $row){

				$str .='<li><a title="'.$row->title.'" target="_blank" href="';
				if(trim($row->url)!="" && $row->url!=NULL){
					$str .=$row->url;
				}else{
					$str .="javascript:void(0)";
				}				
				$str .='">';
				$str .=stripslashes2($row->title);
				$str .='</a></li>';
			}
			$str .= '</ul>'.PHP_EOL;
			
			if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('important-websites').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';
			}
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getImpWebsites function
	
}//end getImpWebsites function exist

if(!function_exists('getNoticeBoard')){
	
	function getNoticeBoard($limit=5){
		$ci = & get_instance();
		$tbl = "comm_noticeboard";
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title, attachment';
		}else{
			$col_name = 'title_hi as title, attachment';
		}

		$filter = array('status'=>1,'is_delete'=>0,'DATE(archive_exp_date) >='=>date('Y-m-d'));
		
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		
		if(count($query->result())>0){
			$str .= '<ul>';
			foreach($query->result() as $row){

				$str .='<li><a title="'.$row->title.'" target="_blank" href="';
				if(trim($row->attachment)!="" && $row->attachment!=NULL){
					$str .=base_url('uploads/files/').$row->attachment;
				}else{
					$str .="javascript:void(0)";
				}				
				$str .='">';
				$str .=html_escape($row->title);
				$str .='</a></li>';
			}
			$str .= '</ul>'.PHP_EOL;
			
			if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('notice-board').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';
			}
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getNoticeBoard function
	
}//end getNoticeBoard function exist

if(!function_exists('getNews')){
	
	function getNews($limit=5,$view_all = FALSE, $condition=array(),$class_name=""){
		$ci = & get_instance();
		$tbl = "comm_news";
		$new_limit = $limit+1;
		$col_name = '*';
		if(checkLanguage("english")){
			$col_name .= ',title_en as title, description_hi as description,is_alert';
		}else{
			$col_name .= ',title_hi as title, description_en as description,is_alert';
		}

		$filter = array('status'=>1,'is_delete'=>0,'DATE(archive_exp_date) >= '=>date('Y-m-d'));
		if(count($condition)>0){
			foreach($condition as $key1 => $val1){
			  $filter[$key1] = $val1;
			}
		}	
		
		$ci->db->select($col_name);
		$ci->db->order_by('id DESC');	
		
		$ci->db->limit($new_limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		$isAlert = '';
		if(count($query->result())>0){
			$result_set = $query->result();
			if(count($result_set) > $limit){ 
			unset($result_set[$limit]);
			$reindex = array_values($result_set); //normalize index
			$result_set = $reindex; //update variable
			}
		
			$str .="<ul class='".$class_name."'>";
			foreach($result_set as $row){
				
				if($row->is_alert == 1){
					$isAlert = '<img src="'.base_url('assets/img/').'new5.gif"  class="img-responsive">';
					}
					else{
					$isAlert = '';
						}
				
				$str .='<li>';
				$str .='<a target="_blank" href="news-details/nid/';
				$str .=encrypt_decrypt('encrypt',$row->id);				
				$str .='">';
				$str .=html_escape($row->title);
				$str .=$isAlert;
				$str .='</a>';
				$str .='</li>';
                               
			}//end foreach
			$str .="</ul>";
			
			if($view_all==TRUE && count($query->result())>$limit){
				$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('news-details').'" class="newsall">';
				$str .= $ci->lang->line('view_all');
				$str .= '</a>';
			}			
			
			return $str;
		}else{
			//return $ci->lang->line('record_not_found');
			return $str;
		}
	}//end getNews function
	
}//end getNews function exist

if(!function_exists('getLastUpdate')){
	
	function getLastUpdate(){
		$ci = & get_instance();
		$tbl = "comm_settings";

		$query = $ci->db->get_where($tbl);
		$row = $query->row_array();
		$str = '';
		
		if(isset($row) && count($row)>0){
			
			if($row['last_updated_on']!="" && $row['last_updated_on']!="0000-00-00"){
				$str .= get_date($row['last_updated_on'],"d M Y");
			}
			
			return $str;
		}else{
			return "";
		}
	}//end getLastUpdate function
	
}//end getLastUpdate function exist

// This function is used for 
if(!function_exists('parseJsonArray')){

	function parseJsonArray($jsonArray, $parentID = 0) {

	  $return = array();
	  foreach ($jsonArray as $subArray) {
	    $returnSubSubArray = array();
	    $returnPArray = array();
	    if (isset($subArray->children)) {
	 		$returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
	    }
	    
	    $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
	    $return = array_merge($return, $returnSubSubArray);
	  }
	  return $return;
	}//end parseJsonArray fucntion
	
}//end parseJsonArray check is exist or not

if(!function_exists('getMessageBoard')){
	
	function getMessageBoard($where_in=array(),$condition=array(),$limit=5){
		$ci = & get_instance();
		$col_name ="";
		
		$tbl = "comm_messages";
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title, designation_en as designation, message_en as message,';
		}else{
			$col_name = 'title_hi as title, designation_hi as designation, message_hi as message,';
		}
		
		$col_name .= 'id,attachment,status';

		$filter = array('status'=>1, 'is_delete'=>0);
		if(count($condition)>0){
			foreach($condition as $key=>$val){
			  $filter[$key] = $val;
			}
		}
		
		if(count($where_in)>0){
			$ci->db->where_in('id', $where_in);
		}
		
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$count_rec = count($query->result());
		
		if($count_rec>0){			
			//return ($count_rec>1)?$query->result():$query->row();
                        return $query->result();
		}else{
			return array();
		}
	}//end getMessageBoard function
	
}//end getMessageBoard function exist

if(!function_exists('getEvent')){
	
	function getEvent($limit=5,$condition=array()){
		$ci = & get_instance();
		$tbl = "comm_events";
		
		$col_name = '*';
		if(checkLanguage("english")){
			$col_name .= ',title_en as title, description_hi as description';
		}else{
			$col_name .= ',title_hi as title, description_en as description';
		}

		$filter = array('status'=>1,'is_delete'=>0);
		if(count($condition)>0){
			foreach($condition as $key1 => $val1){
			  $filter[$key1] = $val1;
			}
		}	
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');	
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		
		if(count($query->result())>0){
                      //  $str .='<ul class="demo1">';
			foreach($query->result() as $row){
				
				if(trim($row->attachment)==""){
								$photo = base_url().'assets/img/img-not-found.png';
								}else{
								$photo = base_url().'uploads/events/'.$row->attachment;
								}
								$des = stripslashes2(html_entity_decode($row->description));
								
			
								$str .='<div>';
								$str .='<a href="'.base_url('events/view/').encrypt_decrypt('encrypt',$row->id).'" >';
								$str .='<div class="gallery-item">';
						        $str .='<div class="gallery-img" > <img src="'.$photo.'" alt="'.html_escape(word_limiter($row->title,15)).'"></div>';
								$str .='<div class="desp">';
								$str .='<h5>'.html_escape(word_limiter($row->title,15)).'</h5>';
						        $str .='</div>';
						        $str .='</div>';
								$str .='</a>';
							    $str .='</div>';
			
		}
	}
			$str .= PHP_EOL;
			
			
		return $str;
	}//end getNews function
	
}//end getNews function exist

if(!function_exists('getProjects')){
	
	function getProjects($limit=5,$condition=array()){
		$ci = & get_instance();
		$tbl = "comm_project";
		
		$col_name = '*';
		if(checkLanguage("english")){
			$col_name .= ',title_en as title, description_en as description';
		}else{
			$col_name .= ',title_hi as title, description_hi as description';
		}

		$filter = array('status'=>1,'is_delete'=>0);
		if(count($condition)>0){
			foreach($condition as $key1 => $val1){
			  $filter[$key1] = $val1;
			}
		}	
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');	
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		
		if(count($query->result())>0){
                      //  $str .='<ul class="demo1">';
			foreach($query->result() as $row){
				
								if(trim($row->attachment)==""){
									$photo = base_url().'assets/img/img-not-found.png';
								}else{
									$photo = base_url('uploads/project/').html_escape($row->attachment);
								}
								$des = stripslashes2(html_entity_decode($row->description));
								
								$des = substr($des,0,100 ); 
								
								$str .='<div class="panel panel-default panel-card">
										  <div class="panel-heading">
										    <img src="'.$photo.'" alt="vcr-main">
										  </div>
										  <div class="panel-figure green-color">
										   <img src="'.base_url('assets/images/video-conference.png').'" alt="market_analytics_icon">
										  </div>
										  <div class="panel-body text-center practice-area">
										    <h4 class="panel-header"><a href="'.base_url('project/view/') . encrypt_decrypt('encrypt', $row->id).'">'.word_limiter($row->title,3).' </a></h4>
										  </div>
										  <div class="panel-thumbnails">
										    <div class="hover-show-text">
										      <p>'.$des.' </p>
										    </div>
										  </div>
										</div>';


					
			
		}
	}
			$str .= PHP_EOL;
			
			
		return $str;
	}//end getProject function
	
}//end getProject function exist

if(!function_exists('getProject')){
	
	function getProject($limit=5,$condition=array()){
		$ci = & get_instance();
		$tbl = "comm_project_category";
		
		$col_name = '*';
		if(checkLanguage("english")){
			$col_name .= ',cat_title_en as title';
		}else{
			$col_name .= ',cat_title_hi as title';
		}

		$filter = array('cat_status'=>1,'is_delete'=>0);
		if(count($condition)>0){
			foreach($condition as $key1 => $val1){
			  $filter[$key1] = $val1;
			}
		}	
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');	
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		
		if(count($query->result())>0){
                      //  $str .='<ul class="demo1">';
			foreach($query->result() as $row){
				
				if(trim($row->attachment)==""){
								$photo = base_url().'assets/img/img-not-found.png';
								}else{
								$photo = base_url().'uploads/project/'.$row->attachment;
								}
								//$des = stripslashes2(html_entity_decode($row->description));
								
								//$des = substr($des,0,100 ); 
								
								
								$str .='<div>';
								$str .='<a href="'.base_url('project-view/').encrypt_decrypt('encrypt',$row->cat_id).'" class="single-event">';
								$str .='<figure class="event-thumb">';
						        $str .='<img src="'.$photo.'" class="gal-thumb img-responsive" alt="'.html_escape(word_limiter($row->title,15)).'">';
				                $str .='</figure>';
								$str .='<div class="event-info">';
								$str .='<h3 class="bold">'.html_escape(word_limiter($row->title,15)).'</h3>';
								//$str .='<div>'.$des.'</div>';
						        $str .='</div>';
								$str .='</a>';
							    $str .='</div>';
			
		}
	}
			$str .= PHP_EOL;
			
			
		return $str;
	}//end getProject function
	
}//end getProject function exist


if(!function_exists('getSchemes')){
	
	function getSchemes($limit=5,$condition=array()){
		$ci = & get_instance();
		$tbl = "comm_schemes";
		
		$col_name = '*';
		if(checkLanguage("english")){
			$col_name .= ',title_en as title, description_hi as description';
		}else{
			$col_name .= ',title_hi as title, description_en as description';
		}

		$filter = array('status'=>1,'is_delete'=>0,'is_archive'=>0);
		if(count($condition)>0){
			foreach($condition as $key1 => $val1){
			  $filter[$key1] = $val1;
			}
		}	
		
		$ci->db->select($col_name);
		$ci->db->order_by('order_preference ASC');	
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl,$filter);
		$str = '';
		
		if(count($query->result())>0){
			$str .= '<ul>';
			foreach($query->result() as $row){

				$str .='<li><a title="'.$row->title.'" target="_blank" href="schemes/view/';
				$str .=encrypt_decrypt('encrypt',$row->id);				
				$str .='">';
				$str .=html_escape($row->title);
				$str .='</a></li>';
			}
			$str .= '</ul>'.PHP_EOL;
			
			if(count($query->result())>5){
			$str .= '<a title="'.$ci->lang->line('view_all').'" href="'.base_url('schemes').'" class="txt_link text-right">';
			$str .= $ci->lang->line('view_all');
			$str .= '</a>';			
			}
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
	}//end getSchemes function
	
}//end getSchemes function exist

if(!function_exists('getLandingPage')){
	
	function getLandingPage(){
		$ci = & get_instance();
		$tbl = "comm_landing_page";
		
		$col_name = 'id,status';
		if(checkLanguage("english")){
			$col_name .= ',title_en as title, description_en as description';
		}else{
			$col_name .= ',title_hi as title, description_hi as description';
		}
		
		$ci->db->select($col_name);
		$query = $ci->db->get_where($tbl,array('status'=>1));
		$row = $query->row();

		if(isset($row) && $row->status==1){
		 return array('status'=>TRUE,'title'=>html_escape($row->title),'description'=>$row->description);
		}else{
		 return array('status'=>FALSE,'title'=>'','description'=>'');
		}
			
	}//end getLandingPage function
	
}//end getLandingPage function exist

if(!function_exists('getStory')){	
	function getStory($limit=10){
		$ci = & get_instance();
		$filter = array('status'=>1,'is_delete'=>0,'archive_exp_date >'=>date('Y-m-d H:i:s'));
		
		if(checkLanguage("english")){
			$col_name = 'title_en as title,description_en as description,';
		}else{
			$col_name = 'title_hi as title,description_hi as description,';
		}
		
		$ci->db->select('*,'.$col_name);
		$ci->db->order_by('order_preference ASC');
		$ci->db->limit($limit);
		$query = $ci->db->get_where('comm_story',$filter);
		
		$str = '';
		
		if(count($query->result())>0){
			
			foreach($query->result() as $row){
				
				$id = encrypt_decrypt('encrypt',$row->id);
			    $img_path = base_url('uploads/files/'.$row->attachment);
			    $url_path = base_url('story/view/'.$id);
			    	
				$str .='<div class="pro-item">';
				$str .=img(array('src'=>$img_path,'title'=>$row->title,'alt'=>$row->title));			
				$str .='<div class="pro-detail">';
				$str .='<a class="btn" href="'.$url_path.'" title="'.html_escape($row->title).'">';
				$str .='<i class="mdi mdi-launch"></i> '.$ci->lang->line('know_more');
				$str .='</a>';
				$str .='</div>';
				$str .='</div>'.PHP_EOL;
			}
			
			
			return $str;
		}else{
			return $ci->lang->line('record_not_found');
		}
		
	}//end getStory function
	
}//end getStory function exist

if(!function_exists('AmountINLakhs')){
	
	function AmountINLakhs($val){
		$value = 0;
		if(is_numeric($val) && $val!=0){
			$value = $val/100000;
		}
		return $value;
	/*	
	if ((number < 0) || (number > 999999999)){
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = floor(number / 10000000);  // Crore 
    var kn = floor(number / 100000);    // Lakhs
    var Hn = floor(number / 1000);      // Thousand 
    var Dn = floor(number / 100);       // Tens (deca) 
    */		
	}//end AmountINLakhs function
	
}//end check AmountINLakhs

if(!function_exists('EmergencyContact')){
    function EmergencyContact(){
        $ci = & get_instance();
        $filter = array('enabled' => 1);

        if (checkLanguage("english")) {
            $col_name = 'id,district_name,district_name as district,';
            $ci->db->order_by('district_name ASC');
        } else {
            $col_name = 'id,district_name,district_name_h as district,';
            $ci->db->order_by('district_name_h ASC');
        }

        $ci->db->select($col_name);
        $query = $ci->db->get_where('comm_district', $filter);



        $str = '';

        if (count($query->result()) > 0) {
            $str .= '<div class="emrgency-contact-wrapper">';
            $str .= '<h2>Emergency Contact</h2>';
            $str .= '<form class="form-horizontal" action="'.base_url('EmergencyContact').'" method="post">';
            $str .= '<label>Select District</label>';
            $str .= '<div class="col-md-10 nopadding">';
            $str .= '<select name="searchdistrict" class="form-control">';
            $str .= '<option>'.$ci->lang->line('all_district').'</option>';
            foreach ($query->result() as $row) {

                $id = encrypt_decrypt('encrypt', $row->id);
                $str .= '<option value="' . html_escape($row->district_name) . '">' . html_escape($row->district) . '</option>';
            }
            $str .= '</select>';
            $str .= '</div>';
            $str .= '<div class="col-md-2 nopadding">';
            $str .= '<button class="btn btn-warning" type="submit"><span class="fa fa-search"></span></button>';
            $str .= '</div>';
            $str .= '</form>';
            $str .= '<div class="clearfix"></div>';
            $str .= '<div class="wheateher-wrapper">';
            $str .= '<a href="http://www.imd.gov.in/pages/allindiawxfcbulletin.php" target="_blank">';
            $str .= '<img src="' . base_url('assets/images/wheateher.jpg') . '" class="img-responsive center-block" alt="Wheather-Photo">';
            $str .= '</a>';
            $str .= '</div>';
            $str .= '</div>' . PHP_EOL;

            return $str;
        } else {
            return $ci->lang->line('record_not_found');
        }
    }
}

if (!function_exists('getVideoLink')) {
	function getVideoLink($limit = 1)
	{
		$ci = &get_instance();
		$tbl = "comm_video_gallery";
		if (checkLanguage("english")) {
			$col_name = 'title_en as title';
		} else {
			$col_name = 'title_hi as title';
		}
		$col_name .= ",url";
		$filter = array('status' => 1, 'is_delete' => 0,'is_default'=>1);
		$ci->db->select($col_name);
		$ci->db->limit($limit);
		$query = $ci->db->get_where($tbl, $filter);
		$str = '';
		if (count($query->result()) > 0) {
			foreach ($query->result() as $row) {
				//
				$str .= '<div id="Vedioonhomepage" class="modal fade reveal-modal center">
				
				<div class="modal-dialog  modal-lg   modal-dialog-centered" style="position:relative">
				
					<div class="modal-content">	
					<button type="button" class="close" style="position: absolute;
				right: -10px;
				background: #000;
				z-index: 99;
				top: -15px;
				opacity: 1;
				width: 30px;
				height: 30px;
				border-radius: 50%;
				box-shadow: none;" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" style=" text-shadow: none;
				color: #fff;">&times;</span>
			  </button>			
						<div class="modal-body">
						<div class="video-container">
						<iframe class="responsive-iframe"  src="' . $row->url . '" 
						title="' . $row->title . '" frameborder="0" allow="accelerometer; autoplay; 
						clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
						</iframe>
						</div></div>
						</div>
					</div>
				</div>
			</div><script>
			$(document).ready(function(){
				$("#Vedioonhomepage").modal("show");
			});
		</script>
			';
			}
			//$str  .= "</ul>";		
			return $str;
		} else {
			return '';
		}
	} //end getVideoLink function	
} //end getVideoLink function exist

function is_home()
{
   $CI =& get_instance();
   return (!$CI->uri->segment(1))? TRUE: FALSE;
} 

?>