<?php 
 $SliderTopRec = getSlider();
 if(count($SliderTopRec)>0):
?>
<div class="banner7">
    <div class="oc-banner7-container">
        <div class="flexslider oc-nivoslider">
            <div class="oc-loading"></div>
            <div id="oc-inivoslider1" class="nivoSlider">

            <?php foreach($SliderTopRec as $row):  ?>
                   
                <img src="<?php echo base_url('uploads/slider/').$row->attachment;?>" 
                data-thumb="<?php echo base_url('uploads/slider/').$row->attachment;?>" 
                alt="Page1">
                    
            <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<script type="text/javascript">
    $(window).load(function () {
        $('#oc-inivoslider1').nivoSlider({
            effect: "random",
            slices: 15,
            boxCols: 8,
            boxRows: 4,
            manualAdvance: false,
            animSpeed: 500,
            pauseTime: 5000,
            startSlide: 0,
            controlNav: true,
            directionNav: true,
            controlNavThumbs: false,
            pauseOnHover: true,
            prevText: '<i class="ion-chevron-left"></i>',
            nextText: '<i class="ion-chevron-right"></i>',
            afterLoad: function () {
                $('.oc-loading').css("display", "none");
                $('.timeloading').css('animation-duration', " 5000ms ");
            },
        });
    });
</script>

<!-- <div id="cmsblock-27" class="cmsblock">
    <div class='description'>
        <div class="banner-4">
            <div class="col-sm-4">
                <div class="col-img">
                    <a href="#">
                        <img src="<?php echo base_url('assets/img/banner4-1.jpg'); ?>"
                            alt="banner 4">
                    </a>
                </div>
                <div class="text-content">
                    <h3>Handmade</h3>
                    <h3>Accessories Good</h3>
                    <a href="#">View collection</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-img">
                    <a href="#">
                        <img src="<?php echo base_url('assets/img/banner4-2.jpg') ?>"
                            alt="banner 4">
                    </a>
                </div>
                <div class="text-content">
                    <h3>Best item</h3>
                    <h3>Handmade Kid</h3>
                    <a href="#">View collection</a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-img">
                    <a href="#">
                        <img src="<?php echo base_url('assets/img/banner4-3.jpg'); ?>"
                            alt="banner 4">
                    </a>
                </div>
                <div class="text-content">
                    <h3>Trending</h3>
                    <h3>Wooden Toys Set</h3>
                    <a href="#">View collection</a>
                </div>
            </div>
        </div>
    </div>
</div> -->