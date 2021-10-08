<?php
header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=member-details-".date('d-m-Y h:i:s').".xls" );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Report</title>
<style type="text/css">
.txthead {
	background-color: #666;
	color: #FFF;
	height: 30px;
	text-align: center;
	vertical-align: middle;
	font-weight: bold;
	font-size: 15px;
}
.even {
	background-color: #eff2fc;
	text-align: left;
}
.odd {
	background-color: #FFFFFF;
	text-align: left;
}
.batchnm {
	height: 40px;
	text-align: left;
	vertical-align: middle;
	font-weight: bold;
	font-size: 20px;
}
.label {
	text-align: left !important;
	font-weight: bold;
	height: 30px !important;
}
.data {
	text-align: left !important;
	height: 30px !important;
}
.titletxt {
	font-size: 16px;
	font-weight: bold;
	height: 30px;
}
.innertableclshead {
	margin-top: 20px;
	margin-left: 100px;
}
.innertablecls {
	margin-left: 100px;
}
</style>
</head>
<body>
 <table cellpadding="1" cellspacing="1" border="1">
		<thead>
		<tr class="txthead">
			<th colspan="19">Member Details</th>
			<th colspan="6">Address</th>
			<th colspan="4">Details of Contact Person in Madhya Pradesh</th>
			<th colspan="5">Professional Profile</th>
			<th colspan="4">Educational Details</th>
		</tr>
		<tr class="txthead">
			<th width="15px">No.</th>
			<th width="15%">Chapter Name</th>
			<th width="15%">Member Name</th>
			<th width="15%">FoMP ID</th>						
			<th width="15%">Father/Husband Name</th>
			<th width="15%">Email</th>
			<th width="15%">Mobile</th>
			<th width="15%">Phone</th>
			<th width="15%">Date of Birth</th>
			<th width="15%">Is NRI</th>
			<th width="15%">Passport Number</th>
			<th width="15%">Country Issue</th>
			<th width="15%">PR Number</th>
			<th width="15%">PR Country Issue</th>
			<th width="15%">OCI / NRP Number</th>
			<th width="15%">ID Card</th>
			<th width="15%">ID Card Number</th>			
			<th width="10%">Created Date</th>
			<th width="10%">Is Chairman</th>
			<th width="10%">Is Secretary</th>
			<th width="5%">Status</th>
			
			<th width="15%">Country Name</th>
			<th width="15%">State Name</th>
			<th width="15%">City Name</th>
			<th width="15%">Postal / Zip Code</th>
			<th width="15%">Street Address</th>
			<th width="15%">Street Address Line 2</th>
			
			<th width="15%">Contact Person Name</th>
			<th width="15%">Father/Husband Name</th>
			<th width="15%">Aadhaar Number</th>
			<th width="15%">Email</th>
			
			<th width="15%">Profile Summary</th>
			<th width="15%">Expert Area</th>
			<th width="15%">Current Organization</th>
			<th width="10%">Work Experience (Years)</th>
			<th width="5%">Designation</th>
			
			<th width="15%">Degree</th>
			<th width="15%">Institute Name</th>
			<th width="10%">Additional Certificates</th>
			<th width="5%">Area of Specialization / Interest</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE):
	$i = (isset($ajaxPagination['s_no']))?$ajaxPagination['s_no']:1;
	foreach($DataList as $row):	
	$id = encrypt_decrypt('encrypt',$row['user_id']);
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape($row['chapter_name']); ?></td>
		<td><?php echo html_escape($row['user_fname']); ?></td>
		<td><?php echo html_escape($row['fomp_id']); ?></td>
		<td><?php echo html_escape($row['user_father_or_husband']); ?></td>
		<td><?php echo html_escape($row['user_email']); ?></td>
		<td><?php echo chkEmptyNonZero(html_escape($row['mobile_isd']),TRUE).' '.chkEmptyNonZero(html_escape($row['user_mobile'])); ?></td>
		<td><?php echo chkEmptyNonZero(html_escape($row['phone_isd']),TRUE).' '.chkEmptyNonZero(html_escape($row['user_phone_no'])); ?></td>
		<td><?php echo get_date($row['dob']); ?></td>
		<td><?php echo DefaultStatus(html_escape($row['is_nri'])); ?></td>
		<td><?php echo html_escape($row['passport_no']); ?></td>
		<td><?php echo html_escape($row['country_issue_name']); ?></td>
		<td><?php echo html_escape($row['pr_no']); ?></td>
		<td><?php echo html_escape($row['pr_country_issue_name']); ?></td>
		<td><?php echo html_escape($row['oci_nrp_no']); ?></td>
		<td><?php echo html_escape(GetIdentityCard($row['identity_proof'],FALSE)); ?></td>
		<td><?php echo html_escape($row['identity_number']); ?></td>		
		<td><?php echo get_date($row['add_date']); ?></td>
		<td><?php echo DefaultStatus(html_escape($row['is_chairman'])); ?></td>
		<td><?php echo DefaultStatus(html_escape($row['is_secretary'])); ?></td>
		<td><?php echo ActiveStatus(html_escape($row['user_status'])); ?></td>
		
		<td><?php echo html_escape($row['country_name']); ?></td>
		<td><?php echo html_escape($row['state_name']); ?></td>
		<td><?php echo html_escape($row['city_name']); ?></td>
		<td><?php echo html_escape($row['zipcode']); ?></td>
		<td><?php echo html_escape($row['street_address']); ?></td>
		<td><?php echo html_escape($row['street_address2']); ?></td>
		
		<td><?php echo html_escape($row['contact_name']); ?></td>
		<td><?php echo html_escape($row['contact_father_or_husband']); ?></td>
		<td><?php echo html_escape($row['contact_aadhaar']); ?></td>
		<td><?php echo html_escape($row['contact_email']); ?></td>
		
		<td><?php echo html_escape($row['profile_summary']); ?></td>
		<td><?php echo html_escape($row['expert_area']); ?></td>
		<td><?php echo html_escape($row['current_organization']); ?></td>
		<td><?php echo html_escape($row['work_experience']); ?></td>
		<td><?php echo html_escape($row['designation']); ?></td>
		
		<td><?php echo GetDegree($row['degree']); ?></td>
		<td><?php echo html_escape($row['institute_name']); ?></td>
		<td><?php echo html_escape($row['additional_certificates']); ?></td>
		<td><?php echo html_escape($row['area_of_interest']); ?></td>
   </tr>
	<?php 
	$i = $i+1;
	 endforeach;
	 else:
	 echo '<tr class="text-center"><td colspan="38">Record not found</td></tr>';
	 endif; 
	?>
	</tbody>
</table>
</body>
</html>