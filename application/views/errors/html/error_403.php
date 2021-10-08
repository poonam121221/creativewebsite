<div class="main-content">
 <div class="sec-pad">
  <div class="container">
  
  <h2 class="inner-title"><?php echo $this->lang->line('error_page'); ?></h2>
  <div class="row">
    <div class="col-md-12">
	<!-------------------------Breadcrumbs--------------------------->
	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo base_url('/');?>"><?php echo $this->lang->line('home_page'); ?></a> </li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo $this->lang->line('error_page'); ?></li>
	</ol>
	</nav>
	<!-------------------------End Breadcrumbs------------------------> 
    </div>
  </div>
  
  <div class="about inner-page">  
   <div class="borderdiv">         
 <!---------------------------------------------------->
	<div class="row min-h300">
   <div class="col-md-12">
     <div class="text-center">
       <div class="errorcode">4<em class="fa fa-times-circle-o"></em>3</div>
       <p class="errormsg"><?php echo $this->lang->line('forbidden');?></p>
       <hr/>
       <a href="<?php echo base_url('/');?>" class="btn btn-sm btn-success"><span class="mdi mdi-arrow-left"></span> <?php echo $this->lang->line('back_to_home_page'); ?></a>
      </div>
    </div>
</div>
 <!---------------------------------------------------->   
    <div class="clearfix"></div>
   </div><!--End borderdiv-->   
  </div><!--End about-->
  </div><!--End container-->
  </div><!--End sec-pad-->
</div><!--End main-content-->