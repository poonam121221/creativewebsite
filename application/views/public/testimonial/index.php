<?php $this->load->view('element/inc_breadcrum'); ?>

<div class="fontresize" id="content-section">
  <div class="inner-content py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="detail">
            <h4 class="linkheading"><?php echo $this->lang->line('useful_links'); ?></h4>
            <?php echo getImpLinks(8); ?> </div>
        </div>
        <div class="col-md-9">
          <div class="innertitle">
            <p class="float-left"><?php echo $this->lang->line('project'); ?></p>
            <a href="" class="btn-more float-right"><span class="mdi mdi-printer"></span> Print</a> </div>
          <div class="pagedetail">
            <div class="row searchtop">
              <div class="col-sm-4 mb-2">
                <input type="text" name="title" value="" id="sTitle" class="form-control" placeholder="<?php echo $this->lang->line('search_by_title'); ?>">
              </div>
              <div class="col-sm-4 mb-2">
                <button class="btn btn-info" onclick="searchFilter();" name="search" id="search"> <?php echo $this->lang->line('search'); ?></button>
                <button class="btn btn-danger" onclick="searchFilter(0,1);" name="search-all" id="search-all"> <?php echo $this->lang->line('reset'); ?></button>
              </div>
            </div>
            <div id="ajaxdata"> </div>
          </div>
          <?php echo isset($LastUpdatedDate)?  '<span class="updateinfo">'.$this->lang->line('last_updated').':'. $LastUpdatedDate.'</span>': ''; ?> </div>
      </div>
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
	        url: '<?php echo base_url("Events/ajaxPaginationData/"); ?>'+page_num,
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