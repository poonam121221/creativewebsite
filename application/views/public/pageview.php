<div class="inner-banner has-base-color-overlay text-center" style="background: url(images/background/1.jpg);">
    <div class="container">
        <div class="box">
            <h3><?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->title)) : ""; ?></h3>
        </div>
    </div>
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                    <?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->title)) : ""; ?>
                    </li>
                </ul>
            </div>
          
        </div>
    </div>
</div>

<?php echo (isset($DataList)) ? stripslashes2(html_entity_decode($DataList->description)) : ""; ?>

       
<?php $this->view('element/inc_newsletter'); ?>