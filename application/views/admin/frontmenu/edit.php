<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Frontmenu/'); ?>"> Menu</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Edit</a></li>
	</ul>
	<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<!------------------------------------------------------------------- -->
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet box blue">
<div class="portlet-title">
  <div class="caption">Edit  Menu</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$hidden = array('id' => html_escape(isset($DataList->id)? encrypt_decrypt('encrypt',$DataList->id):''));
$atr2 =array('id'=>'frmFrontmenu','name'=>'frmFrontmenu','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/Frontmenu/edit',$atr2,$hidden); 
?>
 <div class="form-body">
 
 		<div class="form-group">
		<label class="col-sm-2 control-label">Menu Location <span class="red">*</span></label>
		<div class="col-sm-10">
		<?php 
			echo form_dropdown(array('name'=>'menu_type_id','class'=>'form-control input-medium'),
		    isset($LocationList)?$LocationList:array(''=>'--SELECT LOCATION--'),isset($DataList->type_id) ? ($DataList->type_id):'');
		?>
		</div>	
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Menu Type <span class="red">*</span></label>
		<div class="col-sm-10">
		<?php
		 $PAGE_MODULE_LINK_LIST = array('1'=>'Pages','2'=>'Modules','3'=>'Custom Link');
		 //,'4'=>'Custom HTML'
		echo form_dropdown('page_module_link', $PAGE_MODULE_LINK_LIST, (isset($DataList->page_module_link) && $DataList->page_module_link !='' )?
         html_escape($DataList->page_module_link):'',array('class'=> 'form-control input-medium','id'=>'pml_id'));
	    ?>
		</div>
	</div><!--End form-group-->
	
	<?php
		$page_hide = "";
		$url_hide  = "";
		$html_hide  = "";
		$mega_menu_hide = "";
		
		if(in_array($DataList->page_module_link,array(1,2))){
			$url_hide  = "hide";
		    $html_hide  = "hide";
		    $mega_menu_hide= "hide";
		}else if(in_array($DataList->page_module_link,array(3))){
			$page_hide = "hide";
		    $html_hide  = "hide";
		}else{
			$page_hide = "hide";
			$url_hide= "hide";
			$mega_menu_hide= "hide";
		}
	?>
	
	<div class="form-group <?php echo $page_hide; ?>" id="page_module">
		<label class="col-sm-2 control-label"><span id="p_module_title">Pages</span> <span class="red">*</span></label>
		<div class="col-md-10">
		<?php 
		$jsPageModule = array('id'=>'page_module_id','class'=>'form-control select2me');
		
		if($DataList->page_module_link==1){
			$selected_pm_id = $DataList->page_id;
		}else if($DataList->page_module_link==2){
			$selected_pm_id = $DataList->module_id;
		}else{
			$selected_pm_id= "";
			$jsPageModule['disabled']='disabled';
		}	
		
		echo form_dropdown('page_module_id',isset($PageModuleList)?$PageModuleList:array(''=>'--select--'),$selected_pm_id,$jsPageModule);
		?>
		</div>	
	</div><!--End form-group-->
	<div class="hide">
	<div class="form-group <?php echo $mega_menu_hide; ?>" id="p_checkbox">
		<label class="col-sm-2 control-label">Is Mega Menu Heading </label>
		<div class="col-sm-10">
		<label for="mega_menu">
		<?php $MEGA_MENU = array('name'=>'mega_menu','id'=>'mega_menu','value'=>1);
		if($DataList->page_module_link!=3){
			$MEGA_MENU['disabled']='disabled';
		}else{
			if($DataList->mega_menu==1){
				$MEGA_MENU['checked']='checked';
			}
		}
		
		echo form_checkbox($MEGA_MENU);
	    ?>Yes
	    </label>
		</div>
	</div><!--End form-group-->
	</div>
	<div class="form-group <?php echo $url_hide; ?>" id="p_url">
		<label class="col-sm-2 control-label">Url <span class="red">*</span></label>
		<div class="col-sm-8">
		<?php 
		
		$URL = array( 
        'name'=>'page_url','id'=>'page_url','class'=> 'form-control',
        'placeholder'=>'Enter url','value'=>$DataList->custom_url);
        
        if($DataList->page_module_link!=3){
			$URL['disabled']='disabled';
		}
        
		echo form_input($URL);
	    ?>
	    <p class="notecls">Example: http://www.domain.gov.in/</p>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group <?php echo $html_hide; ?>" id="p_html_block">
		<label class="col-sm-2 control-label">Html Design <span class="red">*</span></label>
		<div class="col-sm-10">
		<?php 
		$HTML_DESIGN = array('name'=>'html_block','id'=>'html_block','class'=>'form-control','placeholder'=>'Enter Html Block','value'=>$DataList->html_block);
        $HTML_DESIGN1 = $DataList->html_block;
        if($DataList->page_module_link!=4){
			$HTML_DESIGN['disabled']='disabled';
			echo form_textarea($HTML_DESIGN);
		}else{
			echo $this->ckeditor->editor('html_block',@$HTML_DESIGN1);
		}

		
	    
	    ?>
	    <div id="html_block1"></div>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Menu Icon </label>
		<div class="col-sm-8">
		<?php $MENU_ICON = array( 
        'name'=>'icon_class','id'=>'icon_class','class'=> 'form-control'
        ,'placeholder'=>'Enter icon class','value'=>$DataList->icon_class);
		echo form_input($MENU_ICON);
	    ?>
		</div>
	</div><!--End form-group-->
 	 
 	<div class="form-group">
		<label class="col-sm-2 control-label">Menu Title (Hindi) <span class="red">*</span></label>
		<div class="col-sm-10">
		<?php $TITLE_HI = array( 
        'name'=>'title_hi','id'=>'title_hi','class'=> 'form-control'
        ,'placeholder'=>'Enter title in hindi','value'=>$DataList->title_hi);
		echo form_input($TITLE_HI);
	    ?>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Menu Title (English) <span class="red">*</span></label>
		<div class="col-sm-10">
		<?php $TITLE_EN = array( 
        'name'=>'title_en','id'=>'title_en','class'=> 'form-control',
        'placeholder'=>'Enter title in english','value'=>$DataList->title_en);
		echo form_input($TITLE_EN);
	    ?>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group">
		<label class="col-sm-2 control-label">URL Open In <span class="red">*</span></label>
		<div class="col-sm-10">
		<?php $SAME_NEW_TAB = array('1'=>'Same Tab','2'=>'New Tab');
		echo form_dropdown('tab_same_new', $SAME_NEW_TAB, (isset($DataList->tab_same_new) && $DataList->tab_same_new !='' )?
         html_escape($DataList->tab_same_new):"",array('class'=> 'form-control input-medium'));
	    ?>
		</div>
	</div><!--End form-group-->

 	 <div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<button type="submit" class="btn green">Update</button>
			<button type="reset" class="btn blue reset">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Frontmenu/'); ?>">Back Top Menu</a>
			<a class="btn red" href="<?php echo base_url('manage/Frontmenu/bottomMenu'); ?>">Back Bottom Menu</a>
		</div>
	</div><!--End form-group-->
	
 </div><!--End form-body-->
 <?php echo form_close(); ?>
 <!--------------------------------------------------------------------------->
</div><!-- End portlet-body -->
</div><!-- End BORDERED TABLE PORTLET-->
<!------------------------------------------------------------------- -->
</div><!--End column -->
</div><!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/');?>validation/dist/additional-methods.js"></script>
<script type="text/javascript">
	jQuery(function(){
	
	$("#frmFrontmenu").on('submit', function() {
       for(var instanceName in CKEDITOR.instances) {
               CKEDITOR.instances[instanceName].updateElement();
       }
     });
	
	jQuery.validator.addMethod("alphanumspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s\-\/]*$/.test(value);
	}, "Please enter character, number and space only.");

	jQuery( "#frmFrontmenu" ).validate({
		  errorElement: 'span', //default input error message container
          errorClass: 'help-block', // default input error message class
          focusInvalid: false, // do not focus the last invalid input
          ignore: "",
		  rules: { 
		    menu_type_id: {
		        required: true,
		        digits:true
		    },
		    page_module_link: {
		        required: true,
		        digits:true
		    },
		    page_module_id: {
		        required: true,
		        digits:true
		    },
			page_url:{
				required:true,
				url:false,
				maxlength:100
			},
			html_block:{
				required:true,
			},
		    title_hi: {
		        required: true,
		        minlength:2,
		        maxlength:255
		    },
		   title_en: {
		        required: true,
		        minlength:2,
		        maxlength:255
		    },
		    icon_class: {
		        minlength:2,
		        maxlength:40
		    },
		    status:{
				required: true,
		  		digits:true
			}
		  },
          highlight: function (element) { // hightlight error inputs
              $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
          },
          unhighlight: function (element) { // revert the change done by hightlight
              $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
          },errorPlacement: function (error, element) { // render error placement for each input type
              if (element.attr("data-error-container")) { 
                 error.appendTo(element.attr("data-error-container"));
              }else {
                 error.insertAfter(element); // for other inputs, just perform default behavior
              }
          }
		});	
	});
</script>
<script type="text/javascript">
	$(function(){
		//Menu Type Change Event
		$('#pml_id').change(function(){
			if($(this).val()==1 || $(this).val()==2){
				$('#p_url').addClass('hide');
				$('#page_url').attr('disabled','disabled');
				$('#p_checkbox').addClass('hide');
				$('#mega_menu').attr('disabled','disabled');
				$('#p_html_block').addClass('hide');
				$('#html_block').attr('disabled','disabled');
				
				$('#page_module').removeClass('hide');
				$('#page_module_id').removeAttr('disabled');
				
				dataString = {'id':$(this).val()}
				
			   if($(this).val()==2){
			   	$('#ajaxloading').modal('show');		   	
			   	
				$.ajax({
					type: "POST",
		            url: '<?php echo base_url("Ajaxmaster/getModuleList/"); ?>',
		            data: dataString,
		            cache : false,
		            success: function(data){
		              $('#page_module_id').val('').trigger("change");
		              $('#page_module_id').html(data);
		              $('#p_module_title').html('Module');
		              $('#ajaxloading').modal('hide');
		            },error: function(xhr, status, error) {
		              console.log(error);
		              $('#ajaxloading').modal('hide');
		            }
				});//end ajax
			   }else{
			   	$('#ajaxloading').modal('show');
			   	
			   	$.ajax({
					type: "POST",
		            url: '<?php echo base_url("Ajaxmaster/getPageList/"); ?>',
		            data: dataString,
		            cache : false,
		            success: function(data){
		              $('#page_module_id').val('').trigger("change");
		              $('#page_module_id').html(data);
		              $('#p_module_title').html('Page');
		              $('#ajaxloading').modal('hide');
		            },error: function(xhr, status, error) {
		              console.log(error);
		              $('#ajaxloading').modal('hide');
		            }
				});//end ajax
			   }//end check page type module				
								
			}else if($(this).val()==4){
				$('#page_module').addClass('hide');
				$('#page_module_id').attr('disabled','disabled');
				$('#p_url').addClass('hide');
				$('#page_url').attr('disabled','disabled');
				$('#p_checkbox').addClass('hide');
				$('#mega_menu').attr('disabled','disabled');
				
				$('#p_html_block').removeClass('hide');
				$('#html_block').removeAttr('disabled');	
				
			}else{
				$('#page_module').addClass('hide');
				$('#page_module_id').attr('disabled','disabled');
				$('#p_html_block').addClass('hide');
				$('#html_block').attr('disabled','disabled');
				
				$('#p_url').removeClass('hide');
				$('#page_url').removeAttr('disabled');
				$('#p_checkbox').removeClass('hide');
				$('#mega_menu').removeAttr('disabled');				
			}
		});//end Menu Type change event
		
		$('.reset').click(function(){
			$('#menu_type_id').val('');
			$('#page_module_link').val('');
			$('#page_module_id').val('');
			$('#page_url').val('');
			$('#mega_menu').removeAttr('checked');
		});
		
	});//end dom
</script>