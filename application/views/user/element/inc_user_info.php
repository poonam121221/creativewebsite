 <div class="row">
 	<div class="col-md-12 user-type"> <em class="nc-icon nc-single-01"></em> <?php echo $this->session->userdata['AUTH_LOCAL_USER']['USER_NAME']; ?> (<?php echo getUserType($this->session->userdata['AUTH_LOCAL_USER']['USER_TYPE']); ?>)</div>
 </div>
 <div class="clearfix"></div>