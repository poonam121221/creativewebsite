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


                        <div class="panel">
                            <div class="panel-body">
                            <div class="row">
                            <div class="tt_tabsproduct_module" id="product_module782">
                                        <div class="tt-product">
                                            <ul class="tab-heading nav nav-pills">
                                                <?php $i = 0;  foreach($CategoryList as $key => $category){  ?>
                                                        <li><a data-toggle="pill" href="#tab-<?php echo $key; ?>" onclick="searchFilter('<?php echo $key; ?>')"><?php echo $category; ?></a></li>
                                                <?php $i++; } ?>
                                            </ul>
                                            <div class="tab-content">

                                                <?php $i = 0;  foreach($CategoryList as $key => $category){ ?>
                                                    <div class="tab-container  owl-theme  tab-pane fade" id="tab-<?php echo $key; ?>">
                                                    </div>
                                                <?php $i++; } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
</div>








<script type="text/javascript">
    $(function () {

        $('a[href="#tab-1').trigger("click");

        getAjaxRecord();

        function getAjaxRecord() {
            searchFilter();
        }
    });//end dom

//Do not use this function in Dom
    function searchFilter(category,page_num, all) {
        page_num = page_num ? page_num : 0;
        all = all ? all : 0;

        var c_id = "";
        if (category) {
            c_id = category;
        } 
        var tokenVal = $(document).find('#sysToken').val();

        var dataString = {'page': page_num, 'c_id': c_id, "<?php echo $this->security->get_csrf_token_name(); ?>": tokenVal};

        $('#custom-loding').removeClass('hide');

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url("PhotoGallery/ajaxPaginationData/"); ?>' + page_num,
            data: dataString,
            success: function (html) {
                $('#tab-'+category).html(html);
                $('#custom-loding').addClass('hide');
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $('#custom-loding').addClass('hide');
            }
        });
    }//end ajax searchFilter
</script>