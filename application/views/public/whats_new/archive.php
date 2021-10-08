<div class="about-inner-wrapper">
    <div class="container">
        <div class="row">
             <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="brudcrum-wrapper"><?php echo $this->breadcrumbs->show(); ?></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 printbtn-wrapper">
                <button type="button" class="btn btn-warning btn-print" onclick="$('#ele1').print();">
     <span class="fa fa-print"></span> Print</button>
            </div>
        </div>
        <div class="row">

            <div class="col-md-9 no-padding" id="ele1">
                <div class="aboutus-midinner-wrapper">
                    
                    <h2><?php echo $this->lang->line('whats_new_archived'); ?></h2>
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
<div class="last-update-text"><p><?php echo isset($LastUpdatedDate)?  $this->lang->line('last_updated').':'. $LastUpdatedDate: ''; ?></p></div>
                </div>
            </div>

            <div class="col-md-3 no-padding">

                <?php echo getWhatsNew(); ?>

                <?php echo EmergencyContact(); ?>

            </div>

        </div> 
    </div>

</div>
<?php $this->load->view('element/inc_footer_slider'); ?>
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
	        url: '<?php echo base_url("WhatsNew/ajaxArchive/"); ?>'+page_num,
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