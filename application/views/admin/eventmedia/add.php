<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/EventMedia/'); ?>">Media</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0)">add</a></li>
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
<div class="row"><div class="col-lg-12 AlertMessage">
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
				<p>Max File Size is 10 Mb and accepted File extension is ".pdf,.doc,.docx,.jpeg,.jpg,.JPG,.JPEG,.png,.pdf,.xls,.xlsx"</p>
			</div>
		</div>		
	</div>
	<?php 
		 $atr =array('id'=>'frmuploadpicture','name'=>'frmuploadpicture','role'=>'form', 'autocomplete'=>'off','class'=>'dropzone dropzone-mini dz-clickable');
	   	 echo form_open_multipart('manage/EventMedia/insertpic',$atr);
	?>
		<div class="col-md-12 clearfix">
			<label class="col-lg-2 col-md-3 control-label">Event  <span class="red">*</span></label>
			<div class="col-lg-5 col-md-6">
			<?php 
				echo form_dropdown(array('name'=>'event_id','class'=>'form-control input-medium event_id'),
			    isset($EventList)?$EventList:array(''=>'--SELECT Event--'),isset($EventList->id) ? ($EventList->id):'');
			?>
			</div>	
			<div  class="col-lg-5 col-md-3"><button class="btn btn-success" id="button">upload </button></div>
		</div><!--End form-group-->
	<?php
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

	jQuery(document).ready(function(){

		Dropzone.autoDiscover = false;
		var accept = ".pdf,.doc,.docx,.jpeg,.jpg,.JPG,.JPEG,.png,.pdf,.xls,.xlsx";
		jQuery("#frmuploadpicture").dropzone({
	        maxFiles: 5,
			maxFilesize: 10, //MB
			//addRemoveLinks: true,
			acceptedFiles: accept,
			autoProcessQueue: false,
	        init: function () {

	        	var myDropzone = this;
				var click =0;
	        	  // Update selector to match your button
		        $("#button").click(function (e) {
		            e.preventDefault();
		            myDropzone.processQueue();
					click=1;
		        });
		        this.on('sending', function(file, xhr, formData) {
					console.log(formData);
		            // Append all form inputs to the formData Dropzone will POST
		            var data = $('#frmuploadpicture').serializeArray();
		            $.each(data, function(key, el) {
		                formData.append(el.name, el.value);
		            });
		        });
	            this.on("complete", function(data, response){
	                var res = eval('(' + data.xhr.responseText + ')');                
	            });
	        },   
	        success: function (file, response) {	        	
		      	if(response != 0){
			         // Download link
		          	if(response=="error"){
			        	location.reload();
			        }
			         var obj = jQuery.parseJSON( response );
			         var anchorEl = document.createElement('a');
			         anchorEl.setAttribute('href',obj.link);
			         anchorEl.setAttribute('removehref',obj.link);
			         anchorEl.setAttribute('target','_blank');
			         anchorEl.setAttribute('class','filelink');
			         anchorEl.innerHTML = "<br>Download";
			         file.previewTemplate.appendChild(anchorEl);
		      	}
		   },
		});
	//File Upload response from the server
	$('#file').on('change', function(e){
	
	});
        $('.event_id').on('change', function(e){
			var myDropzone = Dropzone.forElement("#frmuploadpicture");
			myDropzone.removeAllFiles(true); 
		});
	});

</script>
