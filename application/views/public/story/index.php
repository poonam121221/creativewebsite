<article id="fontSize" class="min_350 noise_bg">
 <div class="page_title">
 	<div class="h2 title_text"><?php echo $this->lang->line('success_story'); ?></div>
    <!-------------------------Breadcrumbs--------------------------->
    	<?php echo $this->breadcrumbs->show(); ?>
    <!-------------------------End Breadcrumbs------------------------> 
 </div><!--End page-title--> 

<div class="container content_box">

<div id="ele1">
		      
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
		<div class="clearfix"><p></p></div>
		
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

</div><!--End container-->
</article>

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
	    
	    $('#ajaxloading').modal('show');
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("Story/ajaxPaginationData/"); ?>'+page_num,
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