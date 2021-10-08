<!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo $this->lang->line('whos_who'); ?></h3>
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

                        <div class="table-filter searchtop">
                            
                              <div class="row">
                                <div class="col-md-3">
                                  <?php
                                echo form_dropdown(array('name' => 'category', 'id' => 'category','onchange'=>'searchFilter()', 'class' => 'form-control'), isset($CategoryList) ? $CategoryList : array('' => '--SELECT CATEGORY--'), '');
                                ?>
                                </div>
                                <div class="col-md-3">
                                  <?php
                                echo form_dropdown(array('name' => 'location', 'id' => 'location','onchange'=>'searchFilter()', 'class' => 'form-control'), isset($LocationList) ? $LocationList : array('' => '--SELECT LOCATION--'), '');
                                ?>
                                </div>                          
                                <div class="col-md-3">
                                    <button class="btn btn-primary" onclick="searchFilter();" name="search" id="search">
                                    <?php echo $this->lang->line('search'); ?></button>
                                <button class="btn btn-danger" onclick="searchFilter(0, 1);" name="search-all" id="search-all"> <i class="fa fa-refresh"></i></button>
                                </div>
                              </div>
                            
                        </div>

                  <div class="clearfix"><br></div>
                        <div class="row" id="ajaxdata">
                            <?php
                            // get the data and pass it to your view
                            $token_name = $this->security->get_csrf_token_name();
                            $token_hash = $this->security->get_csrf_hash();
                            echo form_input(array('type' => 'hidden', 'id' => 'sysToken', 'name' => $token_name, 'value' => $token_hash));
                            ?>
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
			$("#category").val("1");
            searchFilter();
        }
    });//end dom

//Do not use this function in Dom
    function searchFilter(page_num, all) {
        page_num = page_num ? page_num : 0;
        all = all ? all : 0;

        var sTitle = "";
        var sCategory = 0;
		var sLocation = 0;

        if (all == 0) {
            sTitle = $("#sTitle").val();
            sCategory = $('#category option:selected').val();

			sLocation = $('#location option:selected').val();
        } else {
            $("#sTitle").val('');
            $('#category').val('');
			$('#location').val('');
        }

        var tokenVal = $(document).find('#sysToken').val();

        var dataString = {'page': page_num, 'sTitle': sTitle, 'sCategory': sCategory, 'sLocation': sLocation, "<?php echo $this->security->get_csrf_token_name(); ?>": tokenVal};

        //showLoader();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url("Whoswho/ajaxPaginationData/"); ?>' + page_num,
            data: dataString,
            success: function (html) {
                $('#ajaxdata').html(html);
          //      hideLoader();
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            //	    hideLoader();
            }
        });
    }//end ajax searchFilter
</script>