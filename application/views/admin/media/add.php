<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Media/'); ?>">Media</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0)">add</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Media/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">Drop Your Image here</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

<div class="row">
	<div class="col-md-12">
		<div class="note note-info">
			<p>Max File Size is 10 Mb and accepted File extension is ".mp4,.pdf,.doc,.docx,.jpeg,.jpg,.JPG,.JPEG,.png,.pdf,.xls,.xlsx"</p>
		</div>
	</div>
</div>

	 <?php 
	 $atr =array('id'=>'frmuploadpicture','name'=>'frmuploadpicture','role'=>'form', 'autocomplete'=>'off','class'=>'dropzone dropzone-mini dz-clickable');

   	 echo form_open('manage/Media/insertpic',$atr);
	 echo form_close();
   	?> 		

   </div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
</div><!--End column -->
</div><!--End row-->

<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->

<script type="text/javascript">

	$(document).ready(function(){
	//File Upload response from the server
	var accept = ".pdf,.doc,.docx,.jpeg,.jpg,.JPG,.JPEG,.png,.pdf,.xls,.xlsx";
	
    Dropzone.options.dropzoneForm = {
        maxFiles: 5,
		maxFilesize: 10, //MB
		acceptedFiles: accept,
        init: function () {
            this.on("complete", function (data) {
                var res = eval('(' + data.xhr.responseText + ')');
            });
            
        }
    };
	});

</script>