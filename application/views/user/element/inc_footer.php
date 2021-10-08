<?php echo'</div>'; ?> <!--End page-content-->
<?php echo'</div>';?><!-- END PAGE CONTAINT -->
<?php echo'</div>'; ?><!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 <?php echo $copy_right; ?>
	</div>
	<div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div><!-- END FOOTER -->
<!--Model ajax loading-->
<div class="modal fade" id="ajaxloading" role="basic" aria-hidden="true">
	<div class="page-loading page-loading-boxed">
	<img src="<?php echo base_url('webroot/img/loading-spinner-blue.gif'); ?>" alt="" class="loading">
		<span>
			&nbsp;&nbsp;Loading...
		</span>
	</div>
	<div class="modal-dialog">
	<div class="modal-content"></div>
  </div>
</div>
<!-- /.modal ajax loading -->

<!-- Modal custom message-->
<div class="modal fade custom-msgBox" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Message</h4>
			</div>
			<div class="modal-body">
				<div id="custom-msg"></div><!-- End custom-page-message -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn blue" data-dismiss="modal">Close</button>
			</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<!-- /.modal end custom message -->

<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('webroot/plugins/excanvas.min.js'); ?>"></script>
<script src="<?php echo base_url('webroot/plugins/respond.min.js'); ?>"></script>  
<![endif]-->
<?php echo put_admin_footers(); ?>
<script src="<?php echo base_url('assets/js/jQuery.print.js'); ?>"></script> 
<script type="text/javascript">
jQuery(document).ready(function() {    
   App.init();
   $('#ps-page-smenu').find('li.active').parents('li').addClass('active');
});
</script>
<?php
echo "</body>";
echo "</html>";
?>   