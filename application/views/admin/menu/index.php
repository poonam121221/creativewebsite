<!-- START BREADCRUMB -->

<div class="row">
<div class="col-lg-12">
<ul class="page-breadcrumb breadcrumb">
	<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>"></a><i class="fa fa-angle-right"></i></li>  
	<li><a href="<?php echo base_url('manage/Adminmenu');?>">Menu</a><i class="fa fa-angle-right"></i></li>               
	<li class="active">Admin Menu</li>
</ul>
</div><!--End column-->
</div><!--End row-->
<!-- END BREADCRUMB -->
<div class="row">
	<div class="col-lg-12"><?php echo AlertMessage($this->session->flashdata('AppMessage'));?></div>
</div>
<!--End Validation message-->

<!-- START RESPONSIVE TABLES -->

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Create Menu</h3>
	</div><!--End panel-heading-->
	<div class="panel-body">
	<?php
	$atr =array('id'=>'frmMenu','name'=>'frmMenu','role'=>'form', 'autocomplete'=>'off','class'=>'');
   	echo form_open('manage/Adminmenu/add_update',$atr);  		
   	?>

	  <div class="row">
		<div class="col-sm-2">Menu Name <span class="red">*</span></div>
		<div class="col-sm-4">
		<?php $MENU_NAME = array( 
        'name'=>'menu_name','id'=>'menu_name','class'=> 'form-control','placeholder'=>'Enter Menu name');
		echo form_input($MENU_NAME);
	    ?>
		</div>
		
		<div class="col-sm-2">Controller Name <span class="red">*</span></div>
		<div class="col-sm-4">
		<?php $CONTROLLER_NAME = array( 
        'name'=>'controller_name','id'=>'controller_name','class'=> 'form-control','placeholder'=>'Enter Controller name');
		echo form_input($CONTROLLER_NAME);
	    ?>
		</div>
		
	  </div><!--End row-->
	  <div class="clearfix"><p></p></div>
	  
	  <div class="row">
	  
		<div class="col-sm-2">Icon Class Name <span class="red">*</span></div>
		<div class="col-sm-4">
		<?php $ICON_CLASS = array( 
        'name'=>'icon_class','id'=>'icon_class','class'=> 'form-control','placeholder'=>'Enter Icon class name');
		echo form_input($ICON_CLASS);
	    ?>
		</div>
		
		<div class="col-sm-2">Action Name</div>
		<div class="col-sm-4">
		<?php $ACTION_NAME = array( 
        'name'=>'action_name','id'=>'action_name','class'=> 'form-control','placeholder'=>'Enter Action name');
		echo form_input($ACTION_NAME);
	    ?>
		</div>
		
	  </div><!--End row-->
	  <div class="clearfix"><p></p></div>
	  
	  <div class="row">		
		<div class="col-sm-2">&nbsp;</div>
         <div class="col-sm-8"><input type="hidden" id="id" name="id" value="" /></div>
	  </div><!--End row-->  

      <div class="row">
		 <div class="col-sm-2">&nbsp;</div>
         <div class="col-sm-8">
         <input id="submit" type="button" class="btn blue" value="Submit" name="submit" />
         <button id="reset" type="reset" class="btn green" >New</button>
         </div>
	  </div>
	  
<?php echo form_close();?>                 
</div><!--End panel-body-->
</div><!--End panel-info-->                                
</div><!--End column-->
</div><!--End row-->

<div class="row">
	<div class="col-sm-12">
	    <menu id="nestable-menu">
	      <button class="btn red" type="button" data-action="expand-all"><i class="fa fa-plus-circle"></i> Expand All</button>
	      <button class="btn purple" type="button" data-action="collapse-all"><i class="fa fa-minus-circle"></i> Collapse All</button>
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

foreach($Record as $row) {

    $thisRef = &$ref[$row['id']];

    $thisRef['parent'] = $row['p_menu_id'];
    $thisRef['menu_name'] = trim(stripslashes2($row['menu_name']));
    $thisRef['controller_name'] = trim($row['controller_name']);
    $thisRef['icon_class'] = trim($row['icon_class']);
    $thisRef['action_name'] = $row['action'];
    $thisRef['id'] = $row['id'];

   if($row['p_menu_id'] == 0) {
        $items[$row['id']] = &$thisRef;
   } else {
        $ref[$row['p_menu_id']]['child'][$row['id']] = &$thisRef;
   }
}//end foreach
 
echo get_admin_menu($items);
?>
	</div>
	</div>
	
	<p></p>
    <input type="hidden" id="nestable-output">
    <button class="btn blue" id="save">Save All Menu</button>
</div><!--End column-->
</div><!--End row-->

<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
	jQuery(function(){
		
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character, number and space only.");
	
	jQuery.validator.addMethod("alphasymbol", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\/\#]*$/.test(value);
	}, "Please enter character,forword slash(/) and hash (#) symbol only.");
	
	jQuery.validator.addMethod("alphasymbol2", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\/]*$/.test(value);
	}, "Please enter character,forword slash(/) and number only.");
	
	jQuery.validator.addMethod("alphanumspacedash", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\-\s]*$/.test(value);
	}, "Please enter character, number, space and (-) symbol only.");

	jQuery( "#frmMenu" ).validate({
		  rules: { 
			  menu_name:{
			  		required: true,
			  		minlength:2,
			        maxlength:40
			  },
			  controller_name: {
			        required: true,
			        alphasymbol:true,
			        maxlength:50
			  },
			  icon_class: {
			        required: true,
			        alphanumspacedash:true,
			        minlength:2,
			        maxlength:40
			  },
			  action_name:{
			        alphasymbol2:true,
			        maxlength:50
			  }
		  },
		  message:{
		  	menu_name: {required:"Menu name is requird field !"}
		  }
		});	
	});
</script>
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
  $(document).ready(function(){
    
    $("#submit").click(function(){
    	
     if(jQuery( "#frmMenu" ).valid()==true){

	   $('#ajaxloading').modal('show');
	   
	   var id = parseInt($("#id").val());
	   id = (isNaN(id)) ? 0 : id;
	   
       var dataString = { 
              'menu_name' : $("#menu_name").val(),
              'controller_name' : $("#controller_name").val(),
              'icon_class' : $("#icon_class").val(),
              'action_name' : $("#action_name").val(),
              'id' : id
            };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("manage/Adminmenu/add_update/"); ?>',
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){
            if(data.status==true){
				if(data.atr.type == 'add'){
					$("#menu-id").append(data.atr.menu);                 	 
	            } else if(data.atr.type == 'edit'){
	                 $('#label_show'+data.atr.id).html(data.atr.menu_name);
	                 $('#link_show'+data.atr.id).html(data.atr.controller_name);
	                 $(document).find('.modify_'+data.atr.id).attr('menu_name',data.atr.menu_name);
	                 $(document).find('.modify_'+data.atr.id).attr('controller_name',data.atr.controller_name);
	                 $(document).find('.modify_'+data.atr.id).attr('icon_class',data.atr.icon_class);
	                 $(document).find('.modify_'+data.atr.id).attr('action_name',data.atr.action_name);
	            }
	            
	            $('#menu_name').val('');
		        $('#controller_name').val('');
		        $('#id').val('');
		        $("#icon_class").val('');
		        $("#parent_id").val('');
		        $("#action_name").val('');
		        $("#submit").val('Submit');
		        
	            $('.custom-msgBox .modal-title').html('Success Message');
             	$('#custom-msg').html('<b>'+data.message+'</b>');
             	$('.custom-msgBox').modal('show'); 
			}else{
				$('.custom-msgBox .modal-title').html('Error Message');
             	$('#custom-msg').html('<b>'+data.message+'</b>');
             	$('.custom-msgBox').modal('show');
			}              
              
              $('#ajaxloading').modal('hide');
              
            } ,error: function(xhr, status, error) {
              console.log(error);
              $('#ajaxloading').modal('hide');
            }
        });
        
	 }//end validation
       
    });//end submit click event

    $('.dd').on('change', function() {
        $('#ajaxloading').modal('show');
     
          var dataString = { 
              data : $("#nestable-output").val(),
            };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("manage/Adminmenu/updateAll/"); ?>',
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
            url: '<?php echo base_url("manage/Adminmenu/updateAll/"); ?>',
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

 
    $(document).on("click",".del-button",function() {
        var x = confirm('Delete this menu?');
        var id = $(this).attr('id');
        if(x){
            $('#ajaxloading').modal('show');
             $.ajax({
                type: "POST",
                url: '<?php echo base_url("manage/Adminmenu/delete/"); ?>',
                data: { 'id' : id },
                dataType:"json",
                cache : false,
                success: function(data){
                  $('#ajaxloading').modal('hide');
                  if(data.status==true){
				  	$("li[data-id='" + id +"']").remove();
				  	
				  	$('.custom-msgBox .modal-title').html('Success Message');
              		$('#custom-msg').html('<b> Data Successfully deleted !</b>');
             		$('.custom-msgBox').modal('show'); 
				  }else{
				  	$('.custom-msgBox .modal-title').html('Error Message');
              		$('#custom-msg').html('<b>'+data.message+'</b>');
              		$('.custom-msgBox').modal('show'); 
				  }
                  
                } ,error: function(xhr, status, error) {
                  $('#ajaxloading').modal('hide');
                  console.log(error);
                }
            });
        }
    });

    $(document).on("click",".edit-button",function() {
        var id 				= $(this).attr('id');
        var menu_name 		= $(this).attr('menu_name');
        var controller_name = $(this).attr('controller_name');
        var icon_class 		= $(this).attr('icon_class');
        var parent_id 		= $(this).attr('parent_id');
        var action_name 	= $(this).attr('action_name');
        
        $("#id").val(id);
        $("#menu_name").val(menu_name);
        $("#controller_name").val(controller_name);
        $("#icon_class").val(icon_class);
        $("#action_name").val(action_name);
        $("#submit").val('Update');
    });

    $(document).on("click","#reset",function() {
        $('#menu_name').val('');
        $('#controller_name').val('');
        $('#id').val('');
        $("#icon_class").val('');
        $("#action_name").val('');
        $("#submit").val('Submit');
    });

  });

</script>