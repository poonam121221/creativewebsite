<div class="main-content">
 <div class="sec-pad">
  <div class="container">
  
  <h2 class="inner-title"><?php echo $this->lang->line('check_entitlement'); ?></h2>
  <div class="row">
    <div class="col-md-12">
	<!-------------------------Breadcrumbs--------------------------->
	  <?php echo $this->breadcrumbs->show(); ?>
	<!-------------------------End Breadcrumbs------------------------> 
    </div>
  </div>
  
  <div id="ele1" class="text-justify">
  <div class="about inner-page">
  
   <div class="borderdiv">    
        
 <!---------------------------------------------------->
  <div class="row">
  	<div class="col-sm-6">
  	<input type="text" name="title" value="" id="sTitle" class="form-control" placeholder="<?php echo $this->lang->line('search_by_title'); ?>">
  	</div>
	<div class="col-sm-6">
		<button class="btn btn-primary default-btn" onclick="searchFilter();" name="search" id="search">
		<i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
		<button class="btn btn-info default-btn" onclick="searchFilter(0,1);" name="search-all" id="search-all">
		<?php echo $this->lang->line('reset'); ?></button>
	</div>
	</div><!--End row-->
	<div class="clearfix"><hr/></div>
		
	<div id="ele1">		
	<!---------------------------------------------------->
	<div id="ajaxdata">
	<?php // get the data and pass it to your view
	 $token_name = $this->security->get_csrf_token_name();
	 $token_hash = $this->security->get_csrf_hash();
	 echo form_input(array('type'=>'hidden','id'=>'sysToken','name'=>$token_name,'value'=>$token_hash));
    ?>
	
	</div><!--End ajaxdata-->
	<div class="clearfix"></div>	
	<!---------------------------------------------------->                   
    </div><!--End h_about-->  
 <!----------------------------------------------------> 
  <p class="last-update"><em class="fa fa-calendar"></em> Last Updated on <?php echo (isset($LastUpdatedDate)?$LastUpdatedDate:''); ?></p>  
    <div class="clearfix"></div>
   </div><!--End borderdiv-->
   
  </div><!--End about-->
  </div><!--End ele1-->
  </div><!--End container-->
  </div><!--End sec-pad-->
</div><!--End main-content-->

<script type="text/javascript">
$(function(){
	
	getAjaxRecord();	
	
	function getAjaxRecord(){
		searchFilter();
	}
});//end dom

//Do not use this function in Dom
function searchFilter(page_num,all) {
	    page_num = page_num?page_num:0;
	    all = all?all:0;
	   
	    var sTitle  = "";
	    if(all==0){
			sTitle  = $("#sTitle").val();
		}else{
			$("#sTitle").val('');
		}	   
		
		var tokenVal  =  $(document).find('#sysToken').val(); 
		
		var dataString ={'page':page_num,'sTitle':sTitle,"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	     showLoader();
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("Entitlement/ajaxPaginationData/"); ?>'+page_num,
	        data:dataString,
	        success: function (html) {
	            $('#ajaxdata').html(html);
	             hideLoader();
	        },error: function(jqXHR, textStatus, errorThrown) {
			  console.log(textStatus, errorThrown);
			   hideLoader();
			}
	    });
	}//end ajax searchFilter
</script>