<!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo $this->lang->line('project'); ?></h3>
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
                       <div class="pagedetail">
                                    <div class="row searchtop">
                                        <div class="col-sm-6 mb-2">
                                           <?php 
                                            echo form_dropdown(array('name'=>'category','id'=>'category','class'=>'search-control form-control'),
                                            isset($CategoryList)?$CategoryList:array(''=>'--SELECT CATEGORY--'),isset($DataList->cat_id)?($DataList->cat_id):'');
                                            ?>
                                        </div>
                                        
                                        <div class="col-sm-4 mb-2">
                                        <button type="button" onclick="searchFilter();" class="btn btn-info"> 
                                            <?php echo $this->lang->line("search");?></button>                                          
                                            <!--<button class="btn btn-danger" type="reset">Reset</button>-->
                                            
                                        </div>
                                    </div>
                                    <div class="clearflex"><br></div>
                                    <div class="row gallery-box m-0" id="ajaxdata">
                                        
                                        
                                    </div>
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
    $(function () {

        getAjaxRecord();

        function getAjaxRecord() {
            searchFilter();
        }
    });//end dom

//Do not use this function in Dom
    function searchFilter(page_num, all) {
        page_num = page_num ? page_num : 0;
        all = all ? all : 0;

        var c_id = "";
        if (all == 0) {
            c_id = $("#category").val();
        } else {
            $("#category").val('');
        }

        var tokenVal = $(document).find('#sysToken').val();

        var dataString = {'page': page_num, 'c_id': c_id, "<?php echo $this->security->get_csrf_token_name(); ?>": tokenVal};

        $('#custom-loding').removeClass('hide');

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url("Project/ajaxPaginationData/"); ?>' + page_num,
            data: dataString,
            success: function (html) {
                $('#ajaxdata').html(html);
                $('#custom-loding').addClass('hide');
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $('#custom-loding').addClass('hide');
            }
        });
    }//end ajax searchFilter
</script>