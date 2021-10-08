<?php

if(!function_exists('adminAccountCreation')){
	
	function adminAccountCreation($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $str .= "<p><strong>Dear ".$rec->name.",</strong></p>";
	  $str .= "<p>Your account has been ".$rec->message." by Admin-EPCO. Following are the details:</p>";
	  $str .= "<p>Designation - ".$rec->designation."</p>";
	  $str .= "<p>Username - ".$rec->username."</p>";
	  $str .= "<p>Password - ".$rec->password."</p>";
	  $str .= "<p>Mobile Number - ".$rec->mobile."</p>";
	  $str .= "<p>Please login using below URL:</p>";
	  $str .= "<a target='_blank' href='".$rec->link."'>".$rec->link."</a>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  return $str;
	}//end adminAccountCreation function
	
}//end check adminAccountCreation

if(!function_exists('userAccountCreation')){
	
	function userAccountCreation($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $str .= "<p><strong>Dear ".$rec->full_name.",</strong></p>";
	  $str .= "<p>Your account has been ".$rec->status_name." by Admin-EPCO.</p>";
	  $str .= "<p>".$rec->comment."</p>";
	  $str .= "<p>Following are the details:</p>";
	  $str .= "<p>User Type - ".$rec->user_type_name."</p>";
	  $str .= "<p>Username - ".$rec->username."</p>";
	  $str .= "<p>Email - ".$rec->email."</p>";
	  $str .= "<p>Mobile Number - ".$rec->mobile."</p>";
	  if(isset($rec->status) && $rec->status==1){
	  	$str .= "<p>Please login using below URL:</p>";
	    $str .= "<a target='_blank' href='".$rec->link."'>".$rec->link."</a>";
	  }	 
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  return $str;
	}//end userAccountCreation function
	
}//end check userAccountCreation

if(!function_exists('memberEmailVerification')){
	
	function memberEmailVerification($record=array()){
		$rec = (object)$record;
		$str  = "";
		$str .= "<p><strong>Dear ".$rec->member_name.",</strong></p>";
		$str .= "<p>Click the link below to verify your email:</p>";
		$str .= "<a target='_blank' href='".$rec->link."'>".$rec->link."</a>";
		$str .= "<br/>";
		$str .= "<p><strong>Regards</strong></p>";
		$str .= "<p><strong>EPCO Team</strong></p>";
		return $str;
	}//end memberEmailVerification function
	
}//end check memberEmailVerification

if(!function_exists('otherImplEmailVerification')){
	
	function otherImplEmailVerification($record=array()){
		$rec = (object)$record;
		$str  = "";
		$str .= "<p><strong>Dear ".$rec->member_name.",</strong></p>";
		$str .= "<p>Your account has been ".$rec->status_name." by Admin-EPCO.After Email, SMS verification and account verification you can login.</p>";
		$str .= "<p>".$rec->comment."</p>";
	    $str .= "<p>Following are the details:</p>";
		$str .= "<p><strong>Username :- ".$rec->username.",</strong></p>";
		$str .= "<p><strong>Pasword :- ".$rec->password.",</strong></p>";
		if(isset($rec->status) && $rec->status==1){
		 $str .= "<p>Click the link below to verify your email:</p>";
		 $str .= "<a target='_blank' href='".$rec->link."'>".$rec->link."</a>";
		}
		$str .= "<br/>";
		$str .= "<p><strong>Regards</strong></p>";
		$str .= "<p><strong>EPCO Team</strong></p>";
		return $str;
	}//end otherImplEmailVerification function
	
}//end check otherImplEmailVerification

if(!function_exists('impStepEmailLink')){
	
	function impStepEmailLink($record=array()){
		$rec = (object)$record;
		$str  = "";
		$str .= "<p><strong>Dear ".$rec->member_name.",</strong></p>";
		$str .= "<p>Click the link below to process next step:</p>";
		$str .= "<a target='_blank' href='".$rec->link."'>".$rec->link."</a>";
		$str .= "<br/>";
		$str .= "<p><strong>Regards</strong></p>";
		$str .= "<p><strong>EPCO Team</strong></p>";
		return $str;
	}//end impStepEmailLink function
	
}//end check impStepEmailLink

if(!function_exists('memberForgotPassword')){
	
	function memberForgotPassword($record=array()){
		$rec = (object)$record;
		$str  = "";
		$str .= "<p><strong>Dear ".$rec->name.",</strong></p>";
		$str .= "<p>Your recently requested to reset your password for your EPCO application account.</p>";
		$str .= "<p>Click the link below to reset password</p>";
		$str .= "<a target='_blank' href='".$rec->link."'>".$rec->link."</a>";
		$str .= "<p>If you did not request a password reset, please ignore this email. This password reset is only valid for the next 30 minutes.</p>";
		$str .= "<br/>";
		$str .= "<p><strong>Regards</strong></p>";
		$str .= "<p><strong>EPCO Team</strong></p>";
		return $str;
	}//end memberForgotPassword function
	
}//end check memberForgotPassword

if(!function_exists('userShowIntrestToProject')){
	
	function userShowIntrestToProject($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  switch($rec->msgUserType){
	  	case 1: 
	  	   //for admin
	  	   $msg.=$rec->user_name." has shown interest on project ".$rec->project_name.'.';
	  	   
	  	   break;
	  	case 2:
	  	   //for implementing partner
	  	   $msg.=$rec->user_name." shown interest on project ".$rec->project_name." and marked you as implementing partner.";
	  		break;
	  	case 3:
	  	   //for Company or user
	  	   $msg.="Welcome ".$rec->user_name." you shown interest on project ".$rec->project_name.".";
	  		break;
	  	default:
	  	    $msg.=$rec->user_name." has shown interest on project ".$rec->project_name.'.';
	  		break;
	  }
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  //$str .= "<p><strong>User Contact Email : ".$rec->user_email."</strong></p>";
	  //$str .= "<p><strong>User Contact Mobile Number : ".$rec->user_mobile."</strong></p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end userShowIntrestToProject function
	
}//end check userShowIntrestToProject

if(!function_exists('userNewDocumentNotification')){
	
	function userNewDocumentNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  switch($rec->msgUserType){
	  	case 1: 
	  	   //for admin
	  	   $msg.=$rec->user_name." has added documrnt/report for project ".$rec->project_name.' and waiting for approval.';	  	   
	  	   break;
	  	case 2:
	  	   //for implementing partner
	  	   $msg.=$rec->user_name." has added documrnt/report for project Electric Generator ".$rec->project_name.".";
	  		break;
	  	default:
	  	    $msg.=$rec->user_name." has added documrnt/report for project Electric Generator ".$rec->project_name.".";
	  		break;
	  }
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end userNewDocumentNotification function
	
}//end check userNewDocumentNotification

if(!function_exists('documentStatusNotification')){
	
	function documentStatusNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  $msg.=$rec->user_name." has changed the document status of project ".$rec->project_name.' from '.$rec->old_status.' to '.$rec->new_status.'.';
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end documentStatusNotification function
	
}//end check documentStatusNotification

if(!function_exists('documentDeleteNotification')){
	
	function documentDeleteNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  $msg.=$rec->document_name." document of project ".$rec->project_name." is deleted by ".$rec->user_name.".";
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end documentDeleteNotification function
	
}//end check documentDeleteNotification

if(!function_exists('milestoneAddNotification')){
	
	function milestoneAddNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  $msg.= "New Milestone has been added for project ".$rec->project_name.'by '.$rec->user_name.".";
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end milestoneAddNotification function
	
}//end check milestoneAddNotification

if(!function_exists('milestoneDeleteNotification')){
	
	function milestoneDeleteNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  $msg.=$rec->milestone_name." milestone of project ".$rec->project_name." is deleted by ".$rec->user_name.".";
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end milestoneDeleteNotification function
	
}//end check milestoneDeleteNotification

if(!function_exists('milestoneStatusNotification')){
	
	function milestoneStatusNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  $msg.=$rec->user_name." has changed the milestone status of project ".$rec->project_name.' from '.$rec->old_status.' to '.$rec->new_status.'.';
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end milestoneStatusNotification function
	
}//end check milestoneStatusNotification

if(!function_exists('projectAddNotification')){
	
	function projectAddNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  $msg.= "New Project ".$rec->project_name." has been added successfully by ".$rec->user_name.".";
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end projectAddNotification function
	
}//end check projectAddNotification

if(!function_exists('projectUpdateNotification')){
	
	function projectUpdateNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  $msg.= "Project ".$rec->project_name." has been updated successfully by ".$rec->user_name.".";
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end projectUpdateNotification function
	
}//end check projectUpdateNotification

if(!function_exists('projectStatusNotification')){
	
	function projectStatusNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = "";
	  
	  $msg.=$rec->user_name." has changed the status of project ".$rec->project_name.' from '.$rec->old_status.' to '.$rec->new_status.'.';
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end projectStatusNotification function
	
}//end check projectStatusNotification

if(!function_exists('projectAssignStatusNotification')){
	
	function projectAssignStatusNotification($record=array()){
	  $rec = (object)$record;
	  $str  = "";
	  $msg  = ""; 
	  
	  $msg.= "Project ".$rec->project_name." has been assigned to ".$rec->name.".";
	  
	  $str .= "<p><strong>Dear ,</strong></p>";
	  $str .= "<p>".$msg."</p>";
	  $str .= "<br/>";
	  $str .= "<p><strong>Regards</strong></p>";
	  $str .= "<p><strong>EPCO Team</strong></p>";
	  
	  if($rec->is_sms_notification==1){
	  	return $msg; //for sms/notification
	  }else{
	  	return $str;// for email
	  }
	  
	}//end projectAssignStatusNotification function
	
}//end check projectAssignStatusNotification
?>