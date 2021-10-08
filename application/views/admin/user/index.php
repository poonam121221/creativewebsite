<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/User/'); ?>">User List</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/User/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
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
  <div class="caption">User List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
  <div class="table-responsive">
     <table id="tblUser" class="table table-bordered">
		<thead>
		<tr>
			<th>S.No.</th>
			<th>Name</th>
			<th>Designation</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>User Previledge</th>
			<!--<th>Last Modified By</th>-->
			<th>Last Modified Date</th>
			<th>Status</th>
			<th>Action</th>
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
	jQuery(function(){
		var dataTable;
		dataTable = $('#tblUser').DataTable({  
           "processing":true,  
           "serverSide":true,
           "language": {
             "processing": "<img src='<?php echo base_url('webroot/img/loading-spinner-blue.gif');?>' alt='Please wait..' class='loading'>"
           },
           "order":[],//[[ 0, 'asc' ], [ 1, 'asc' ]] 
           "iDisplayLength" : 20, 
           "lengthMenu": [ 10, 20, 25, 50, 75 ], 
           //Show options 10, 25, 50 and all records- "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
           "ajax":{  
              "url":"<?php echo base_url('manage/User/view'); ?>",  
              "type":"POST",
              "dataSrc": function (jsonData) {
   				return jsonData.data;
 			  },
 			  "error": function(){  // error handling code
                $("#tblUser_processing").css("display","none");
              }
           },
    	   "columnDefs": [
            //{"targets": [ 9 ],"visible": false,"searchable": false,},
            { "targets": [0,6,7,8], "searchable": false, "orderable": false, "visible": true }
        ] 
      });  
      
	});//end dom
</script>