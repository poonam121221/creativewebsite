<?php $id = encrypt_decrypt("decrypt",$this->session->userdata['AUTH_USER']['SERIALNO']);
$totalNotification = getUnreadNotification($id);
?>
<li class="dropdown" id="header_task_bar1">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
  <i class="fa fa-file-text"> </i> <span class="badge"><?php echo $totalNotification ;?></span>
 </a>
 <ul class="dropdown-menu extended inbox">
 <li><p>You have <?php echo $totalNotification ;?> new notification</p></li>
 <li class="external"><a href="<?php echo base_url('manage/Notification');?>" title="total notification">See all notification <i class="m-icon-swapright"></i></a></li>
 </ul>
</li>