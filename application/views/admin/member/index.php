<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Member List</a></li>		
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<!--start from layout-->

<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Search Data</h3>
	</div><!--End panel-heading-->
	<div class="panel-body">
	<div class="row">
	<?php 
	    $atr2 =array('id'=>'frmMember','name'=>'frmMember','role'=>'form', 'autocomplete'=>'off','target'=>'_blank');
   		echo form_open('manage/Member/memberreport/',$atr2); 
	?>
	   <input type="hidden" name="chapter_id" id="chp_id" value="<?php echo $chapter_id; ?>" />
	   <div class="col-sm-4">
		  <?php $TITLE = array('name'=>'fomp_id','id'=>'fomp_id','class'=> 'form-control','placeholder'=>'Search by FoMP ID');
		echo form_input($TITLE);
	    ?>
		</div>
	  	<div class="col-sm-4">
	  	<?php $TITLE = array('name'=>'email','id'=>'email','class'=> 'form-control','placeholder'=>'Search by Email');
		echo form_input($TITLE);
	    ?>
	  	</div>
		<div class="col-sm-4">
		<?php $STATUS = array(''=>'--Search by Status--','1'=>'Active','0'=>'Inactive','3'=>'Incomplete');
		echo form_dropdown('status', $STATUS, (isset($DataList->status) && $DataList->status !='' )?
         html_escape($DataList->status):set_value('status'),array('class'=> 'form-control input-medium', 'id'=>'sStatus'));
	    ?>
		</div>
   <?php echo form_close(); ?>
   
   </div><!--End row-->
	  <br/>
	  <div class="row">
	  	<div class="col-md-12">
	  	<button class="btn green" onclick="searchFilter();" name="search" id="search">
	  	<i class="fa fa-search"></i> Search</button>
	  	<button class="btn blue" onclick="searchFilter(0,1);" name="search" id="search">Reset</button>
	  	<button class="btn purple" name="getReport" id="getReport">Export to Excel</button>
	  	</div>
	  </div><!--End row-->
	
	</div><!--End panel-body-->
</div>


<div class="row">
<div class="col-md-12">
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Member List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

<div class="table-responsive">
  <div id="ajaxdata">
   <?php // get the data and pass it to your view
	 $token_name = $this->security->get_csrf_token_name();
	 $token_hash = $this->security->get_csrf_hash();
	 echo form_input(array('type'  => 'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
   ?>
  </div><!--End ajaxdata-->
  <div class="clearfix"></div>	
</div> <!--End table responsive--> 
    
</div><!--End portlet body-->    
</div><!--End portlet box-->
</div><!--End row-->
<!--End from layout-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">
$(function(){
	
	getAjaxRecord();	
	
	function getAjaxRecord(){
		searchFilter();
	}//end getAjaxRecord function
	
	$('#getReport').on('click',function(event){
	   event.preventDefault();
	   $('#frmMember').submit();
	});

});//end dom

//Do not use this function in Dom
function searchFilter(page_num,all) {
	    page_num = page_num?page_num:0;
	    all = all?all:0;
	    
	    if(all==0){
			fomp_id = $("#fomp_id").val();
			email   = $("#email").val();
			sStatus = $("#sStatus option:selected").val();
		}else{
			$("#fomp_id").val('');
			$("#email").val('');
			$("#sStatus").val('');
		}
	    
	    var tokenVal  = $(document).find('#sysToken').val();
	    var chapter_id   = "";
	    var fomp_id   = $("#fomp_id").val();
	    var email     = $("#email").val();
	    var sStatus   = $("#sStatus option:selected").val();
	    chapter_id = $("#chp_id").val();
	    
	    var dataString ={'page':page_num,'chapter_id':chapter_id,'fomp_id':fomp_id,'email':email,'sStatus':sStatus,"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	    $('#ajaxloading').modal('show');
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("manage/Member/ajaxPaginationData/"); ?>'+page_num,
	        data:dataString,
	        success: function (html) {
	            $('#ajaxdata').html(html);
	            $('#ajaxloading').modal('hide');
	        },error: function(jqXHR, textStatus, errorThrown) {
			  console.log(textStatus, errorThrown);
			  $('#ajaxloading').modal('hide');
			}
	    });
	}//end ajax searchFilter
</script>