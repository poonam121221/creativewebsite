<?php 
	$menu = array( 'menus' => array(), 'parent_menus' => array());
	
	foreach($menus as $menu1) :
		//creates entry into menus array with current menu id ie. $menus['menus'][1]
		$menu['menus'][$menu1['id']] = $menu1;
		//creates entry into parent_menus array. parent_menus array contains a list of all menus with children
		$menu['parent_menus'][$menu1['p_menu_id']][] = $menu1['id']; 
	endforeach;
	
	function buildTree($parent, $menu) {
	$html ="";
	if (isset($menu['parent_menus'][$parent])) {
			$html .= "<ul>";
		foreach ($menu['parent_menus'][$parent] as $menu_id) {
			if (!isset($menu['parent_menus'][$menu_id])) {
				$html .= "<li>";
				$html .= "<input type='checkbox' value=";
				$html .= $menu['menus'][$menu_id]['id'];
				$html .= " name='ids[]'>";
				$html .= "<span>".$menu['menus'][$menu_id]['menu_name']."</span>";
				$html .= "</li>";
			}
			if (isset($menu['parent_menus'][$menu_id])) {
				$html .= "<li>";
				$html .= "<input type='checkbox' value=";
				$html .= $menu['menus'][$menu_id]['id'];
				$html .= " name='ids[]'>";
				$html .= "<span>".$menu['menus'][$menu_id]['menu_name']."</span>";
				$html .= buildTree($menu_id, $menu);
				$html .= "</li>";
			}
		}
		$html .= "</ul>";
	}
	return $html;
}
?>

<script type="text/javascript">
    $(function() {
        $('#tree').tree({
            /* specify here your options */
        });
        
        $('#example-5-checkAll').click(function(){
                    $('#tree').tree('checkAll');
        });
        
        $('#example-5-uncheckAll').click(function(){
                    $('#tree').tree('uncheckAll');
        });
        
        $('#CustLink').click(function(e){
        	e.preventDefault();
        });
        
    });
</script>
<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
	<ul class="page-breadcrumb breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
		<li><a href="<?php echo base_url('manage/Userprivilege/'); ?>">User Privilege</a><i class="fa fa-angle-right"></i></li>
		<li><a href="javascript:void(0);">Add</a></li>
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
  <div class="caption">Add User Privilege</div>
  <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
</div><!--End portlet-title-->
<div class="portlet-body">
<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<?php
$atr2 =array('id'=>'frmPrivilege','name'=>'frmPrivilege','class'=>'form-horizontal','role'=>'form', 'autocomplete'=>'off');
echo form_open('manage/Userprivilege/add',$atr2); 
?>
 <div class="form-body">
 	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label">User Privilege Name <span class="red">*</span></label>
		<div class="col-sm-8 col-md-7">
		<?php $UPM_NAME = array( 
        'name'=>'uname','id'=>'uname','class'=> 'form-control input-medium','placeholder'=>'Enter Privilege Name');
		echo form_input($UPM_NAME);
	 ?>
		</div>
	</div><!--End form-group-->
	
	<div class="form-group clearfix">
     <label class="col-sm-4 col-md-3 control-label">Privilege Description <span class="red">*</span></label>  
     <div class="col-sm-8 col-md-7">
     <?php $UPM_DESCRIPCTION = array(
        'name'          => 'upm_dese',
        'id'            => 'upm_dese',
        'class'         => 'form-control',
        'rows'          => 4,
        'cols'          => 10,
        'value'         => strip_tags(set_value('upm_dese')),
		);
		echo form_textarea($UPM_DESCRIPCTION);
	 ?>
     </div>
     </div><!--End Form-group-->
     
     <div class="form-group clearfix">
       <label class="col-sm-4 col-md-3 control-label">Privilege: <span class="red">*</span></label>  
       <div class="col-sm-8 col-md-7">
       <button type="button" id="CustLink" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal_basic">Choose Menu Privilege</button>
       </div>
     </div><!--End Form-group-->
    
<!-- MODALS -->                 
<div class="row">
<div class="col-lg-12">   
<div class="modal fade bs-modal-lg" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
      <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Privilege Menu Tree</h4>
                    </div>
                    <div class="modal-body">
                    	<button type="button" class="btn btn-success active" id="example-5-checkAll">Check all nodes</button>
						<button type="button" class="btn btn-danger" id="example-5-uncheckAll">Uncheck all nodes</button>
						<div class="clearfix"></div><br/>
                        <div id="tree">
						   <?php echo buildTree(0, $menu); ?>
						</div><!--End Tree-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>
</div>
</div><!--End column-->
</div><!--End row-->
<!-- END MODALS -->
	
	<div class="form-group">
		<label class="col-sm-4 col-md-3 control-label"></label>
		<div class="col-sm-8 col-md-7">
			<button type="submit" class="btn green">Submit</button>
			<button type="reset" class="btn blue">Clear</button>
			<a class="btn purple" href="<?php echo base_url('manage/Userprivilege/'); ?>">Back</a>
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

<script type="text/javascript" src="<?php echo base_url('webroot/');?>plugins/jquery.validate.min.js"></script>

<script type="text/javascript">
	jQuery(function(){
		
	jQuery.validator.addMethod("alphaspace", function(value, element) {
		  return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
	}, "Please enter character and space only.");

	jQuery( "#frmPrivilege" ).validate({
		  rules: { 
		  uname: {
		        required: true,
		        maxlength:50
		    },
		  upm_dese:{
		  		required: true,
		        maxlength:350
		  }
		  }
		});	
	});
</script>
