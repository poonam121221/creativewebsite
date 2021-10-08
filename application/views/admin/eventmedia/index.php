<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/eventmedia/'); ?>">Media</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0)">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/EventMedia/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
<!--start from layout-->

<div class="row">
<div class="col-md-12">

<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Photo Media</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

   <div class="table-responsive">

     <table id="example" class="table table-striped table-bordered dataTable">
		<thead>
		<tr>
			<th width="5%">No.</th>
			<th width="5%">Event Name</th>
			<th width="10%">Image</th>
			<th width="25%">Link</th>
			<th width="12%">Last Modified By</th>
			<th width="12%">Last Modified Date</th>
			<th width="5%">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		 $i= 0;
		 $ext="";
		 $imgChkArray = array('jpg','jpeg','JPG','JPEG','PNG','png','bmp','gif');
		 if(count($Result)>0){
		 ?>
		 <tr>
		 <?php
		 foreach($Result as $rows){ 
		 $i++;		
		 if(trim($rows['attachment'])!=""){
		 	$ext = end((explode(".", $rows['attachment'])));
		 }
		 
		 ?>
		 <td><?php echo $i; ?></td>
		 <td><?php echo $rows['project_name']; ?></td>
		 <td>
		 <?php 
		 if(in_array($ext,$imgChkArray)){
		 	echo '<a class="fancybox-button" href="'.base_url("uploads/eventmedia/").html_escape($rows['attachment']).'" data-rel="fancybox-button">';
		 	echo img(array('src'=>base_url('uploads/eventmedia/').html_escape($rows['attachment']),'title'=>'','class' => 'img-thumbnail','width'=>'80','height'=>'50'));
		 	echo '</a>';
		 }else{
		 	echo '<a target="_blank" href="'.base_url("uploads/eventmedia/").html_escape($rows['attachment']).'" data-rel="fancybox-button">';
		 	echo img(array('src'=>base_url('webroot/img/download_file.jpg'),'title'=>'','class' => 'img-thumbnail','width'=>'80','height'=>'50'));
		 	echo '</a>';
		 }
		   ?></td>
		 <td><?php echo base_url('uploads/eventmedia/').html_escape($rows['attachment']);  ?></td>
		 <td><?php echo getModifierName($rows['admin_name'],$rows['edited_name']); ?></td>
	     <td><?php echo getModifiedDate($rows['added_date'],$rows['edit_date']); ?></td>
		 <td><?php $id = encrypt_decrypt('encrypt',$rows['id']); ?>
	    <a href="<?php echo base_url('manage/EventMedia/delete/'.$id.'/'); ?>" class="btn btn-danger btn-condensed" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data" onclick="return confirm('Are you sure to delete record?'); ">
	    <i class="fa fa-trash-o"></i></a>
	    </td>
		</tr>
		<?php }
			}
		?> 
		</tbody>
	</table>
	<div class="clearfix"></div>
	</div> <!--End table responsive--> 		

    </div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
</div><!--End column -->
</div><!--End row-->

<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">
	jQuery(function(){
		jQuery('.dataTable').dataTable();
	});
</script>