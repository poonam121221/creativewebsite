<?php $this->load->view('element/inc_breadcrum');?>
<div class="fontresize" id="content-section">
                <div class="inner-content py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="detail">
                                    <h4 class="linkheading"><?php echo $this->lang->line('useful_links'); ?></h4>
                                    <?php echo getImpLinks(); ?>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="innertitle">
                                    <p class="float-left"><?php echo $this->lang->line('photo_gallery'); ?></p>
                                    <a href="" class="btn-more float-right"><span class="mdi mdi-printer"></span> Print</a>
                                </div>
                                <div class="pagedetail">
								<?php echo form_input(array('type'  => 'hidden','id'=>'category','name'=>'','value'=>$DataList->cat_id)); ?>					
                                    <div class="row gallery-box m-0" id="ajaxdata">
                                        
                                        
                                    </div>
                                </div>
                            </div>
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
	    if(all==0){
			c_id  = $("#category").val();
		}else{
			$("#category").val('');
		}	  
		  
		var tokenVal  =  $(document).find('#sysToken').val();
		
		var dataString ={'page':page_num,'c_id':c_id,"<?php echo $this->security->get_csrf_token_name();?>":tokenVal};
	    
	    $('#custom-loding').removeClass('hide');
	    
	    $.ajax({
	        type: 'POST',
	        url: '<?php echo base_url("PhotoGallery/ajaxPaginationGallery/"); ?>'+page_num,
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