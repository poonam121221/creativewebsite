<div id="information-information" class="container">
            
            <div class="row">
                <div id="content" class="col-sm-12">
                        <div id="cmsblock-24" class="cmsblock">
                            <div class='description'>
                                <div class="dynamic-about">
                                    <h1><?php echo $this->lang->line('photo_gallery'); ?></h1>
                                    <img src="<?php echo base_url('assets/img/bg-title-aboutus.png'); ?>" alt="bg title">
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">
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
                                <div class="row gallery-box m-0" id="ajaxdata"></div>
                            </div>
                        </div>
                </div>
            </div>
            herllo
</div>








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
            url: '<?php echo base_url("PhotoGallery/ajaxPaginationData/"); ?>' + page_num,
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