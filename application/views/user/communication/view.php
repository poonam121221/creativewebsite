<article class="min_350 noise_bg">
<div class="container data-container ptb-30">
 <div class="row dashboard-header">
 <div class="col-md-12">
  <?php echo $this->breadcrumbs->show(); ?>
 </div><!--End column-->
 </div><!--End row-->
<div class="row">
 <div class="col-md-2">
  <?php $this->view('company/element/inc_sidebar'); ?>
 </div>
 <div class="col-md-10 profile-container">
<!----------------------------------------------------------------------------------->

<!----------------------------------------------------Sangam------------------------------------------------------------------------->

<!---------------------------------------------------->
<div class="row mt-20 data-box">
 <div class="col-md-12">
  <div class="panel panel-primary data-panel">
   <div class="panel-heading row top-control">
   		<div class="col-md-6">Communication View</div>
   		<div class="col-md-6 text-right">
            <a href="<?php echo base_url('user/communication-add'); ?>" class="btn btn-default btn-xs"><em class="fa fa-pencil"></em> Compose</a>  
            <a href="<?php echo base_url('user/communication-inbox'); ?>" class="btn btn-default btn-xs"><em class="fa fa-address-book-o"></em> Inbox</a>
            <a href="<?php echo base_url('user/communication-sent'); ?>" class="btn btn-default btn-xs"><em class="fa fa-paper-plane-o"></em> Sent</a>

        </div>
   </div>
   <div class="panel-body">
   <!---------------------------------------------------->
 <div class="row"><div class="col-md-12 grid-box">
 <!--End form-group-->


			<div class="form-group row col-md-6">
				<label class="col-md-3 control-label">Sender</label>
				<div class="col-md-9">
						<?php
                            echo $name = html_escape(strtoupper(trim($Data->sender_name)));  
                         ?>
				</div>
			</div><!--End form-group-->
            <div class="form-group row col-md-6">
				<label class="col-md-3 control-label">Receiver</label>
				<div class="col-md-9">
						<?php
                            echo $name = html_escape(strtoupper(trim($Data->receiver_name)));  
                         ?>
					</div>
			</div>
			
			<div class="form-group row col-md-6">
				<label class="col-md-3 control-label">Query Type</label>
				<div class="col-md-9">
									<?php echo html_escape($Data->query_name); ?>
				</div>
			</div><!--End form-group-->
			
			<div class="form-group row col-md-6">
				<label class="col-md-3 control-label">Subject</label>
				<div class="col-md-9 text-justify">
								<?php echo html_escape($Data->comm_subject); ?>
				</div>
			</div><!--End form-group-->
            <div class="form-group row col-md-6">
				<label class="col-md-3 control-label">Message</label>
				<div class="col-md-9 text-justify">
							<?php echo stripslashes2(html_entity_decode(html_escape($Data->comm_message))); ?>
				</div>
			</div>
 				<?php  if($Data->comm_attachmnet){  ?>  
                <div class="form-group row col-md-6">
                <label class="col-md-3 control-label">Attachment</label>
                <div class="col-md-9">
              				<a href="<?php echo base_url('uploads/communication/'.$Data->comm_attachmnet); ?>" target="_blank"><i class="fa fa-download"></i></a></div>
                </div>
                <?php } ?>
            
			<!--End form-group-->
 </div></div>
   <!---------------------------------------------------->  
   
</div><!--End panel-body-->
</div><!--End panel-->
</div><!--End column-->
</div><!--End row data-box-->
<!---------------------------------------------------->


<!----------------------------------------------------------------------------------->
</div><!--End column-->
</div><!--End row-->
</div><!--End container-->
</article>		
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.pwstrength.bootstrap/src/pwstrength.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>scripts/CustomFormTool.js"></script>
<style>
.btn-view{
    text-decoration: none !important;
    background: #ffffff;
    color: #5f5f5f!important;
    padding: 4px;
    min-width: 25px;
    height: 25px;
    display: block;
    float: left;
    border-radius: 3px;
    margin: 0px 2px;
    font-size: 18px;
}
.top-control{
	margin: 0px;
	}
.grid-box .row {
    background: #f9f9f9;
    margin: 5px;
    border: 1px solid #ececec;
	width: 48%;
}
.grid-box .row:hover{
	background: #f5f5f5;
	}
</style>