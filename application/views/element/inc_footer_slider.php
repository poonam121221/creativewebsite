<?php
	$impWebImg = getImpWebImg(15); //you can pass limit of image. default 10
	if (count($impWebImg) > 0) {
?>

<!-- partners -->
<section class="partners">
    <div class="container">
        <div class="logo-slider slider1">

        <?php  foreach ($impWebImg as $row) { ?>
		  	<div>
				<a href="<?php echo html_escape($row->url); ?>" target="_blank" title="<?php echo html_escape($row->title); ?>">
			  	<div class="img-box">
					<img src="<?php echo base_url('uploads/impweb/' . $row->attachment); ?>" alt="<?php echo html_escape($row->title); ?>">
			  	</div>
				</a>
		  	</div>
		<?php } ?>           

		</div>
	</div>
</section>
<!-- partners end-->

<?php } ?>