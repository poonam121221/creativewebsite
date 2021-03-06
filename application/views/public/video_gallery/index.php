<!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo $this->lang->line('video_gallery'); ?></h3>
    </div>
</div>

<div class="fontresize">
    <div class="inner-pages">
        <!-- Breadcrumb -->
        <div class="container">
            <?php $this->load->view('element/inc_breadcrum'); ?>
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-md-4">
                    <?php $this->load->view('element/inc_sidebar'); ?>                
                </div>
                <div class="col-md-8">
                    <!-- <h4 class="main-inner-heading">Project Management Consultancy</h4> -->
                    <div class="innerpage-block">
                        <div class="row searchtop">
                            <div class="col-sm-4 mb-2">
                                <input type="text" name="title" value="" id="sTitle" class="form-control" placeholder="<?php echo $this->lang->line('search_by_title'); ?>">
                            </div>
                            
                            <div class="col-sm-4 mb-2">
                                <button class="btn btn-info" onclick="searchFilter();" name="search" id="search">
								<?php echo $this->lang->line('search'); ?></button>
								<button class="btn btn-danger" onclick="searchFilter(0,1);" name="search-all" id="search-all">
								<?php echo $this->lang->line('reset'); ?></button>
                               
                            </div>
                        </div>
                        <div id="ajaxdata">
                            
                        </div>
                    </div>
                    <span class="last-update"><em class="icon-calendar3"></em> <?php echo isset($LastUpdatedDate)?  '<span class="updateinfo">'.$this->lang->line('last_updated').':'. $LastUpdatedDate.'</span>': ''; ?> </span>
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
	    var c_id  = "";
        var sTitle  = "";
	    if(all==0){
            sTitle  = $("#sTitle").val();
			c_id  = $("#c_id").val();
		}else{
			$("#c_id").val('');
            $("#sTitle").val('');
		}	 
		  
		var tokenVal  =  $(document).find('#sysToken').val();		
		var dataString ={'page':page_num,'sTitle':sTitle,'c_id':c_id,"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	    $('#custom-loding').removeClass('hide');	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("VideoGallery/ajaxPaginationData/"); ?>'+page_num,
	        data:dataString,
	        success: function (html) {
	            $('#ajaxdata').html(html);
	          $('#custom-loding').addClass('hide');
	        },error: function(jqXHR, textStatus, errorThrown) {
			  console.log(textStatus, errorThrown);
			 $('#custom-loding').addClass('hide');
			}
	    });
	}//end ajax searchFilter
</script>