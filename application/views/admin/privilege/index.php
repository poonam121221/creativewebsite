<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Userprivilege/'); ?>">User Previlege</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Userprivilege/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
		</ul>
		</li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<!------------------------------------------------------------------- -->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">View User Previlege List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover dataTable">
		<thead>
		<tr>
			<th width="8%">S.No.</th>
			<th width="12%">Previlege Name</th>
			<th width="45%">Description</th>
			<th width="6%">Is Delete</th>
			<th width="5%">Action</th>
		</tr>
		</thead>
		<tbody> 
	<?php 
	if(isset($DataList) && count($DataList)>0  && $DataList !=FALSE){
	$i = 1;
	foreach($DataList as $row){
		
	 if($this->session->has_userdata("AUTH_USER")){
	   $sesUpmID = encrypt_decrypt('decrypt',$this->session->userdata['AUTH_USER']['USER_UPMID']);
	
	   if(($sesUpmID ==2 && in_array($row['upm_id'],array(2,3,4))) || $sesUpmID ==1){
	?>                                           
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo html_escape($row['upm_name']); ?></td>
		<td><?php echo html_escape($row['upm_description']); ?></td>
	    <td><?php echo ArchiveStatus(html_escape($row['isdelete'])); ?></td>
	    <td>
	    <?php 
	    $id = encrypt_decrypt('encrypt',$row['upm_id']);
		?>
		<a href="<?php echo base_url('manage/Userprivilege/edit/'.$id.'/'); ?>" class="btn default btn-xs purple tooltips" data-placement="top" data-original-title="Edit">
	    <i class="fa fa-edit"></i></a>	    
	    </td>
   </tr>
	<?php 
	$i = $i+1;
	  }
	  }//end check session
	 }//end foreach
	 }//end if check DataList 
	?>
	</tbody>
	</table>
	<div class="clearfix"></div>
  </div> <!--End table responsive--> 
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">
	jQuery(function(){
		jQuery('.dataTable').dataTable();
	});
</script>