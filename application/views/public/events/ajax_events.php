<?php
// get the data and pass it to your view
$token_name = $this->security->get_csrf_token_name();
$token_hash = $this->security->get_csrf_hash();
echo form_input(array('type' => 'hidden', 'id' => 'sysToken', 'name' => $token_name, 'value' => $token_hash));
?>
<?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
<div class="row">
<?php
if (isset($DataList) && count($DataList) > 0 && $DataList != FALSE):
    $i = (isset($ajaxPagination['s_no'])) ? $ajaxPagination['s_no'] : 1;
    foreach ($DataList as $row):

        if (trim($row->attachment) == "") {
            $photo = base_url() . 'assets/img/img-not-found.png';
        } else {
            $photo = base_url() . 'uploads/events/' . $row->attachment;
        }
        ?> 
        
      <div class="col-md-4">
        <div class="gallery-item">
          <a  href="<?php echo base_url('events/view/') . encrypt_decrypt('encrypt', $row->id); ?>" title='View Detail'>
                <div class="gallery-img">
                  <img src="<?php echo $photo; ?>" alt="<?php echo html_escape($row->title); ?>">
                  <i class="mdi mdi-call-made"></i>
                </div>
                <div class="desp">
                  <span class="event-date">
                  <?php echo get_date($row->event_start_date); ?>
                        <?php echo $this->lang->line('to'); ?>
                        <?php echo get_date($row->event_end_date); ?></span>
                  <h5><?php echo $row->title; ?></h5>
                </div>
            </a>
              </div>
      </div>



        <?php
        $i = $i + 1;
    endforeach;
else:
    echo '<p class="text-center">' . $this->lang->line('record_not_found') . '</p>';
endif;
?>
</div>

<?php
if (isset($ajaxPagination['output'])) {
    echo $ajaxPagination['output'];
}?>