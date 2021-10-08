<?php
// get the data and pass it to your view
$token_name = $this->security->get_csrf_token_name();
$token_hash = $this->security->get_csrf_hash();
echo form_input(array('type' => 'hidden', 'id' => 'sysToken', 'name' => $token_name, 'value' => $token_hash));
?>
<?php $ajaxPagination = $this->ajax_pagination->create_links(); ?>
<div class="table-responsive tbl_style">


    <?php
    if (isset($DataList) && count($DataList) > 0 && $DataList != FALSE):
        $i = (isset($ajaxPagination['s_no'])) ? $ajaxPagination['s_no'] : 1;
       
        echo '<div class="faq-wrapper">';
        foreach ($CategoryList as $cat_id => $cat_name) {
            $record = false;
            echo '<h4>' . $cat_name;echo '</h4>';
            echo '<ul>';
            foreach ($DataList as $row):
                ?> 
                <?php
                
                if ($cat_id == $row->cat_id) {

                    echo '<li><a href="' . base_url('faq/answer/'.encrypt_decrypt('encrypt', $row->id)) . '">' . $row->title . '</a></li>';
                    $record = true;
                } 
                ?>

                <?php
                $i = $i + 1;
            endforeach;
            echo '</ul>';
            
            if($record == false){
                echo "<span class='red-star'>no record found</span>";
            }
        }
        
        echo '<div>';
    else:
        echo '<tr class="text-center"><td colspan="3">' . $this->lang->line('record_not_found') . '</td></tr>';
    endif;
    ?>


</div><!--End table responsive-->

<div class="clearfix"></div>
<?php
if (isset($ajaxPagination['output'])) {
    echo $ajaxPagination['output'];
}?>

<script>
    var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
    </script>