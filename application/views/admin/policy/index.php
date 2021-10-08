<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Policy/'); ?>">Policy</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Policy/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">View Policy</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
	<div class="clearfix"></div>
	<table id="tblPolicy" class="table table-bordered">
		<thead>
		<tr>
			<th width="3%">No.</th>
			<th width="15%">Category</th>
			<th width="20%">Title(Hindi)</th>
			<th width="20%">Title(English)</th>			
			<th width="3%">File</th>
			<th width="12%">Last Modified By</th>
			<th width="13%">Last Modified Date</th>
			<th width="5%">Status</th>
			<th width="10%">Action</th>
		</tr>
		</thead>
		<tbody>
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
 $(document).ready(function(){ 
 	var table; 
    var token = $(document).find('.sysToken').val();
 
    table = $('#tblPolicy').DataTable({  
           "processing":true,  
           "serverSide":true,
           "language": {
               "processing": "<img src='<?php echo base_url('webroot/img/loading-spinner-blue.gif');?>' alt='Please wait..' class='loading'>"},
           "order":[],//[[ 0, 'asc' ], [ 1, 'asc' ]] 
           "iDisplayLength" : 10, 
           "ajax":{  
              "url":"<?php echo base_url('manage/Policy/view'); ?>",  
              "type":"POST",
              "dataSrc": function (jsonData) {
   				return jsonData.data;
 			  }
           },
    	   "columnDefs": [
            //{"targets": [ 9 ],"visible": false,"searchable": false,},
            { "targets": [0,4,5,6,7,8], "searchable": false, "orderable": false, "visible": true }
        ] 
      });  
 });  
 </script>