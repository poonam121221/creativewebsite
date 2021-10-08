
<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Frontmenu/'); ?>">Footer Menu</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">View</a></li>
		<li class="btn-group">
		<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
		<span>Actions</span><i class="fa fa-angle-down"></i>
		</button>
		<ul class="dropdown-menu pull-right" role="menu">
		<li><a href="<?php echo base_url('manage/Frontmenu/add'); ?>"><i class="fa fa-plus"></i> Add</a></li>
		</ul>
		</li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<!------------------------------------------------------------------- -->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
	
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Front Bottom Menu List</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">

<div class="row">
	<div class="col-sm-12">
	    <menu id="nestable-menu">
	      <button class="btn red" type="button" data-action="expand-all"><i class="fa fa-plus-circle"></i> Expand All</button>
	      <button class="btn purple" type="button" data-action="collapse-all"><i class="fa fa-minus-circle"></i> Collapse All</button>
	      <a class="btn green" href="<?php echo base_url('manage/Frontmenu/'); ?>"><i class="fa fa-hand-o-right"></i> Top Menu View</a>
	    </menu>
	</div><!--End column-->
</div><!--End row-->

<div class="row">
	<div class="col-sm-12">
		
<div class="cf nestable-lists">
	<div class="dd" id="nestable">
<?php 
$ref   = array();
$items = array();

$Record = customFrontMenu(2);

foreach($Record as $row) {

    $thisRef = &$ref[$row['id']];

    $thisRef['parent'] = $row['p_menu_id'];
    $thisRef['menu_name'] = trim(stripslashes2($row['title_en']));
    $thisRef['id'] = $row['id'];

   if($row['p_menu_id'] == 0) {
        $items[$row['id']] = &$thisRef;
   } else {
        $ref[$row['p_menu_id']]['child'][$row['id']] = &$thisRef;
   }
}//end foreach
 
echo get_front_menu($items);
?>
	</div>
	</div>
	
	<p></p>
    <input type="hidden" id="nestable-output">
    <button class="btn blue" id="save">Save All Menu</button>
</div><!--End column-->
</div><!--End row-->

</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">

$(document).ready(function(){

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));

    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });


});
</script>
<script type="text/javascript">
	$(function(){
		
		$('.dd').on('change', function() {
        $('#ajaxloading').modal('show');
     
          var dataString = { 
              data : $("#nestable-output").val(),
            };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("manage/Frontmenu/updateAll/"); ?>',
            data: dataString,
            cache : false,
            success: function(data){
             $('#ajaxloading').modal('hide');
             if(data=="true"){
			 	$('.custom-msgBox .modal-title').html('Success Message');
             	$('#custom-msg').html('<b> Data Successfully updated !</b>');
             	$('.custom-msgBox').modal('show'); 
			 }else{
			 	$('.custom-msgBox .modal-title').html('Error Message');
             	$('#custom-msg').html('<b> Sorry try again latter !</b>');
             	$('.custom-msgBox').modal('show'); 
			 }
             
             
            } ,error: function(xhr, status, error) {
              console.log(error);
              $('#ajaxloading').modal('hide');
            },
        });
    });

    $("#save").click(function(){
        $('#ajaxloading').modal('show');
     
          var dataString = { 
              data : $("#nestable-output").val(),
            };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("manage/Frontmenu/updateAll/"); ?>',
            data: dataString,
            cache : false,
            success: function(data){
              $('#ajaxloading').modal('hide');
              $('.custom-msgBox .modal-title').html('Success Message');
              $('#custom-msg').html('<b> Data has been saved</b>');
              $('.custom-msgBox').modal('show');          
            } ,error: function(xhr, status, error) {
              console.log(error);
              $('#ajaxloading').modal('hide');              
            }
        });
    });
    
	});//end dom
</script>