<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('manage/Dashboard/'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="<?php echo base_url('manage/Consultancy/'); ?>">Consultancy</a><i class="fa fa-angle-right"></i></li>
            <li><a href="<?php echo base_url('manage/Consultancy/'); ?>">View</a></li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->

<!--------------------------------------------------------------------------->
<div class="row"><div class="col-lg-12">
<?php echo AlertMessage($this->session->flashdata('AppMessage'));?>
</div></div>
<!--End Validation message-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!------------------------------------------------------------------- -->
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">View Consultancy</div>
                <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
            </div>
            <!--End portlet-title-->
            <div class="portlet-body">
                <!--------------------------------------------------------------------------->
                <div class="row">
                    <div class="col-md-12 mt40">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                            Basic Details</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th>Consultancy Name</th>
                                                <td><?php echo $DataList->consultancy_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Contact Name</th>
                                                <td> <?php echo $DataList->contact_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th> Phone Number</th>
                                                <td> <?php echo $DataList->phone_number; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total Experience </th>
                                                <td> <?php echo $DataList->exp_year; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('area_sep'); ?> </th>
                                                <td> <?php echo $DataList->specialization; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('annual_turnover'); ?> </th>
                                                <td> <?php echo $DataList->tournover_year; ?>lakhs </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('no_of_staff'); ?> </th>
                                                <td> <?php echo $DataList->no_of_core_staff; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('address_of_corres'); ?> </th>
                                                <td> <?php echo $DataList->address; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('state'); ?> </th>
                                                <td> <?php print_r($StateList->state_name); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('city'); ?> </th>
                                                <td> <?php echo $DataList->city; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('pincode'); ?> </th>
                                                <td> <?php echo $DataList->pincode; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email Id</th>
                                                <td> <?php echo $DataList->emailid; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('mobile'); ?> </th>
                                                <td> <?php echo $DataList->mobile; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $this->lang->line('landline'); ?> </th>
                                                <td> <?php echo $DataList->landline; ?></td>
                                            </tr>
                                            <tr>
                                                <th> I hereby declare that the statement filled in my application
                                                    are<br>
                                                    true and correct and nothing has been hidden </th>
                                                <td><input class="form-check-input" name="terms_condition" type="checkbox" id="terms_condition" <?php echo $DataList->terms_condition == 1 ? "checked" : ""; ?>>
                                                    <label class="form-check-label" for="gridCheck">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                            Project Assignments </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="dob"><b>Project Assignments</b> (of last 05 years) :
                                                </label>
                                                <table class="table table-responsive project_table">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo $this->lang->line('serial_no'); ?></th>
                                                            <th>Title of the project </th>
                                                            <th>Area of Project </th>
                                                            <th>Project Cost in lakhs</th>
                                                            <th>Assignment Details </th>
                                                            <th>Name of Client </th>
                                                            <th>Year of execution</th>
                                                            <th>Duration of the project </th>
                                                            <th>Completion Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($ProjectList as $list) {
                                                            $i++;
                                                        ?>
                                                            <tr id="default_row" data-id="1">
                                                                <td class="dynamic"><?php echo $i; ?></td>
                                                                <td><?php
                                                                    echo $list['project_title'];
                                                                    ?>
                                                                </td>
                                                                <td><?php

                                                                    echo $AreaLIst[$list['area_of_project']];

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    echo $list['project_cost'];
                                                                    ?>
                                                                </td>
                                                                <td><?php
                                                                    echo $list['assignment_details'];
                                                                    ?>
                                                                </td>
                                                                <td> <?php
                                                                        echo $list['name_of_client'];
                                                                        ?>
                                                                </td>
                                                                <td> <?php
                                                                        echo $list['year_of_execution'];
                                                                        ?>
                                                                </td>
                                                                <td><?php
                                                                    echo $list['duration_of_project'];
                                                                    ?>
                                                                </td>
                                                                <td> <?php
                                                                        echo $list['completion_status'];
                                                                        ?>
                                                                </td>

                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                            Department/organizations/agency</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table table-responsive agency_table">
                                            <thead>
                                                <th> S. No.</th>
                                                <th> Name of Govt. Department/organizations/agency</th>
                                                <th> Year of Registration </th>
                                                <th> No. of Projects executed</th>


                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                foreach ($DepartmentList as $Plist) {

                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td class="dynamic"><?php echo $i; ?></td>
                                                        <td> <?php
                                                                echo $Plist['department_name'];
                                                                ?></td>
                                                        <td> <?php
                                                                echo $Plist['registration_year'];
                                                                ?></td>
                                                        <td> <?php
                                                                echo $Plist['no_of_project_reg'];
                                                                ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                            Self certified documents in support of their credential</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-row">

                                            <table class="table">
                                                <tr>
                                                    <th>Complete Profile of the Firm</th>
                                                    <td>
                                                        <a target="_blank" href="<?php echo base_url('uploads/projects/' . $DataList->profile_attachment); ?>"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Photocopies of work order, office order,
                                                        partnership deed,
                                                        completion
                                                        certificate, whom so ever or proof documents in support of
                                                        nature of
                                                        work
                                                        especially environmental related fields. </th>
                                                    <td>
                                                        <a target="_blank" href="<?php echo base_url('uploads/projects/' . $DataList->work_attachment); ?>"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th> Copies of Balance sheet for last preceding three years.</th>
                                                    <td>
                                                        <a target="_blank" href="<?php echo base_url('uploads/projects/' . $DataList->balencesheet_attachment); ?>"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th> Copies of article
                                                        association/registration of the
                                                        Firm/Company.</th>
                                                    <td>
                                                        <a target="_blank" href="<?php echo base_url('uploads/projects/' . $DataList->article_attachment); ?>"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Copies of valid and up-to-date
                                                        Income Tax and
                                                        Sales
                                                        Tax Clearance
                                                        Certificates. </th>
                                                    <td>
                                                        <a target="_blank" href="<?php echo base_url('uploads/projects/' . $DataList->taxcertificate_attachment); ?>"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>List of Core Staff with CV</th>
                                                    <td>
                                                        <a target="_blank" href="<?php echo base_url('uploads/projects/' . $DataList->staff_attachment); ?>"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                            Payment Details </a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-row">
                                        <label class="col-sm-4 col-md-3 control-label">Transaction ID </label>
                                        <div class="col-sm-8 col-md-9"> : <?php echo $DataList->tnx_id; ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if( $DataList->application_status==0) {?>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="col-sm-4 col-md-3 control-label"></label>
                                    <div class="col-sm-8 col-md-9">
                                        <?php
                                        $atr2 = array('id' => 'frmContactboard', 'name' => 'frmContactboard', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');
                                        echo form_open_multipart('manage/Consultancy/updatestatus', $atr2);
                                        ?>
                                        <input type="hidden" name="email" value="<?php echo $DataList->emailid; ?>">
                                        <input type="hidden" name="id" value="<?php echo $DataList->id; ?>">
                                        <button type="submit" class="btn green">Approve</button> 
                                        <a class="btn red reject_btn">Reject</a>
                                        <a class="btn purple" href="<?php echo base_url('manage/Consultancy/'); ?>">Back</a>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                                <!--End form-group-->
                                <?php
                                    $atr2 = array('id' => 'frmContactboard', 'name' => 'frmContactboard', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off');
                                    echo form_open_multipart('manage/Consultancy/updaterejstatus', $atr2);
                                ?>
                                <hr>
                                <input type="hidden" name="email" value="<?php echo $DataList->emailid; ?>">
                                <input type="hidden" name="emailid" value="<?php echo $DataList->emailid; ?>">
                                <input type="hidden" name="id" value="<?php echo $DataList->id; ?>">
                                <div id="reject_form" class="hidden">
                                    <div class="form-group">
                                        <label class="col-sm-4 col-md-3 control-label">Remark </label>
                                        <div class="col-sm-8 col-md-9">
                                            <?php $Reject_status = array(
                                                'name' => 'reject_region',  'id' => 'reject_region', 'class' => 'form-control', 'placeholder' => 'Enter Remark',
                                                'value' => ''
                                            );
                                            echo form_input($Reject_status);
                                            ?>
                                        </div>
                                    </div>
                                    <!--End form-group-->
                                    <div class="form-group">
                                        <label class="col-sm-4 col-md-3 control-label"></label>
                                        <div class="col-sm-8 col-md-9">
                                            <button type="submit" class="btn green">Submit</button>
                                            <a class="btn purple" href="<?php echo base_url('manage/Consultancy/'); ?>">Back</a>
                                        </div>
                                    </div>
                                </div>
                                <!--End form-group-->
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <?php } else {  
                            if( $DataList->application_status==1) { 
                                echo '<button class="btn green">Approved</button>';
                            }
                            if( $DataList->application_status==2) { 
                                echo '<p><button class="btn red">Rejected</button> :';
                                echo "<b> ".$DataList->reject_region."</b></p>";
                            }
                            }?>
                    </div>
                </div>
                <!--------------------------------------------------------------------------->
            </div><!-- End portlet-body -->
        </div><!-- End BORDERED TABLE PORTLET-->
        <!------------------------------------------------------------------- -->
    </div>
    <!--End column -->
</div>
<!--End row-->
<!-- END PAGE CONTENT-->
<script type="text/javascript">
    $(function() {
        jQuery("input").prop("readonly", true);
        jQuery("#reject_region").prop("readonly", false);
        jQuery("textarea").prop("readonly", true);
        jQuery("select").prop("readonly", true);
        jQuery(".reject_btn").click(function() {
            jQuery("#reject_form").removeClass("hidden");
        });
    });
</script>