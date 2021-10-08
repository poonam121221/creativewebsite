<link rel="stylesheet" type="text/css"
    href="<?php echo base_url('webroot/'); ?>/plugins/bootstrap-datepicker/css/datepicker.css">
<style>
.arrow-steps {
    width: 100%;
    overflow: auto;
    white-space: nowrap;
}

.arrow-steps .step {
    font-size: 15px;
    text-align: center;
    color: #000;
    font-weight: bold;
    margin: 0 3px 10px;
    padding: 15px 15px 11px 30px;
    min-width: 200px;
    display: inline-block;
    position: relative;
    background-color: #d9e3f7;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    transition: background-color 0.2s ease;
    cursor: pointer;
}

.arrow-steps .step:after,
.arrow-steps .step:before {
    content: " ";
    position: absolute;
    top: 0;
    right: -17px;
    width: 0;
    height: 0;
    border-top: 22px solid transparent;
    border-bottom: 26px solid transparent;
    border-left: 17px solid #d9e3f7;
    z-index: 2;
    transition: border-color 0.2s ease;
}

.arrow-steps .step:before {
    right: auto;
    left: 0;
    border-left: 17px solid #fff;
    z-index: 0;
}

.arrow-steps .step:first-child:before {
    border: none;
}

.arrow-steps .step:first-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.arrow-steps .step span {
    position: relative;
}

.arrow-steps .step span:before {
    opacity: 0;
    content: "✔";
    position: absolute;
    top: -2px;
    left: -20px;
}

.arrow-steps .step.done span:before {
    opacity: 1;
    -webkit-transition: opacity 0.3s ease 0.5s;
    -moz-transition: opacity 0.3s ease 0.5s;
    -ms-transition: opacity 0.3s ease 0.5s;
    transition: opacity 0.3s ease 0.5s;
}

.arrow-steps .step.current {
    color: #fff;
    background-color: #a2c785;
}

.arrow-steps .step.current:after {
    border-left: 17px solid #a2c785;
}

.step.disabled {
    cursor: none;
    pointer-events: none;
    color: #8e8e8e;
}

.tab-content {
    padding: 15px;
}

.nav.nav-tabs .nav-link {
    border-color: #e9ecef #e9ecef #dee2e6;
}

.nav.nav-tabs .nav-link.active {
    background-color: #aad088;
}
</style>
<!-- banner -->
<div class="inner-header">
    <div class="container">
        <h3><?php echo $this->lang->line('project_monitering'); ?></h3>
    </div>
</div>

<div class="fontresize">
    <div class="inner-pages">
        <!-- Breadcrumb -->
        <div class="container">
            <?php $this->load->view('element/inc_breadcrum'); ?>
            <!-- Breadcrumb -->
            <div class="row">
                <!-- <div class="col-md-4">
                    <?php // $this->load->view('element/inc_sidebar'); 
                    ?>                
                </div> -->

                <div class="col-md-12">
                    <!-- <h4 class="main-inner-heading">Project Management Consultancy</h4> -->
                    <div class="innerpage-block">


                        <?php
                        $atr2 = array(
                            'id' => 'frmProjectMonitoring', 'name' => 'frmProjectMonitoring',
                            'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off'
                        );
                        echo form_open_multipart('ProjectMonitoring/add', $atr2);
                        ?>

                        <div class="col-md-12">
                            <p class="text-left">Empanelment of Consultancy Firms in EPCO</p><br>
                            <p class="text-left text-danger">
                            </p>

                        </div>


                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <?php echo AlertMessage($this->session->flashdata('AppMessage')); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="arrow-steps nav-tabs clearfix" id="myTab" role="tablist">
                                <a id="basicinfo-tab" data-toggle="tab" href="#basicinfo" role="tab"
                                    aria-controls="basicinfo" aria-selected="true" class="step current "> <span>
                                        Basic Info</span> </a>
                                <a id="project-tab" data-toggle="tab" href="#project" role="tab" aria-controls="project"
                                    aria-selected="false" class="step disabled">
                                    <span>Project</span> </a>
                                <a class="step disabled" id="attachment-tab" data-toggle="tab" href="#attachment"
                                    role="tab" aria-controls="attachment" aria-selected="false">
                                    <span>Attachment</span> </a>
                                <a class="step disabled" id="payment-tab" data-toggle="tab" href="#payment" role="tab"
                                    aria-controls="payment" aria-selected="false"> <span>Payment</span>
                                </a>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicinfo" role="tabpanel"
                                    aria-labelledby="basicinfo-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label
                                                for="consultancy_name"><?php echo $this->lang->line('consultancy_name'); ?></label>
                                            <?php
                                            $consultancy_name = array('name' => 'consultancy_name', 'id' => 'consultancy_name', 'class' => 'form-control', 'placeholder' => $this->lang->line('consultancy_name'));
                                            echo form_input($consultancy_name);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label
                                                for="contact_name"><?php echo $this->lang->line('contact_name'); ?></label>
                                            <?php
                                            $NAME = array('name' => 'contact_name', 'id' => 'contact_name', 'class' => 'form-control', 'placeholder' => $this->lang->line('contact_name'));
                                            echo form_input($NAME);
                                            ?>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label
                                                for="phone_number"><?php echo $this->lang->line('phone_number'); ?></label>
                                            <?php
                                            $phone_number = array('name' => 'phone_number', 'id' => 'phone_number', 'class' => 'form-control', 'placeholder' => $this->lang->line('phone_number'));
                                            echo form_input($phone_number);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exp_year"><?php echo $this->lang->line('total_exp'); ?></label>
                                            <?php
                                            $exp_year = array('name' => 'exp_year', 'id' => 'exp_year', 'class' => 'form-control', 'placeholder' => $this->lang->line('total_exp'));
                                            echo form_input($exp_year);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label
                                                for="specialization"><?php echo $this->lang->line('area_sep'); ?></label>
                                            <?php
                                            $area_sep = array('name' => 'specialization', 'id' => 'specialization', 'class' => 'form-control', 'placeholder' => $this->lang->line('area_sep'));
                                            echo form_input($area_sep);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label
                                                for="tournover_year"><?php echo $this->lang->line('annual_turnover'); ?></label>
                                            <?php
                                            $annual_turnover = array('name' => 'tournover_year', 'id' => 'tournover_year', 'class' => 'form-control', 'placeholder' => $this->lang->line('annual_turnover'));
                                            echo form_input($annual_turnover);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label
                                                for="no_of_core_staff"><?php echo $this->lang->line('no_of_staff'); ?></label>
                                            <?php
                                            $no_of_core_staff = array('name' => 'no_of_core_staff', 'id' => 'no_of_core_staff', 'class' => 'form-control', 'placeholder' => $this->lang->line('no_of_staff'));
                                            echo form_input($no_of_core_staff);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label
                                                for="address "><?php echo $this->lang->line('address_of_corres');  ?></label>
                                            <?php
                                            $address_of_corres = array(
                                                'name' => 'address', 'rows' => 4,
                                                'cols' => 20, 'id' => 'address', 'class' => 'form-control',
                                                'placeholder' => $this->lang->line('address_of_corres')
                                            );
                                            echo form_textarea($address_of_corres);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="state"><?php echo $this->lang->line('state'); ?></label>
                                            <?php

                                            echo form_dropdown(
                                                array('name' => 'state', 'id' => 'state', 'class' => 'form-control input-medium'),
                                                isset($StateList) ? $StateList : array('' => '--SELECT STATE--'),
                                                ''
                                            );
                                            ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="city"><?php echo $this->lang->line('city'); ?></label>
                                            <?php
                                            $city = array(
                                                'name' => 'city', 'id' => 'city', 'class' => 'form-control',
                                                'placeholder' => $this->lang->line('city')
                                            );
                                            echo form_input($city);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-4">

                                            <label for="pincode"><?php echo $this->lang->line('pincode'); ?></label>
                                            <?php
                                            $pincode = array(
                                                'name' => 'pincode', 'id' => 'pincode', 'class' => 'form-control',
                                                'placeholder' => $this->lang->line('pincode')
                                            );
                                            echo form_input($pincode);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="emailid"><?php echo $this->lang->line('email'); ?></label>
                                            <?php
                                            $EMAIL = array('name' => 'emailid', 'id' => 'emailid', 'class' => 'form-control', 'placeholder' => $this->lang->line('email'));
                                            echo form_input($EMAIL);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mobile"><?php echo $this->lang->line('mobile');  ?></label>
                                            <?php
                                            $mobile = array('name' => 'mobile', 'id' => 'mobile', 'class' => 'form-control', 'placeholder' => $this->lang->line('mobile'));
                                            echo form_input($mobile);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="landline"><?php echo $this->lang->line('landline');  ?></label>
                                            <?php
                                            $landline = array(
                                                'name' => 'landline', 'id' => 'landline', 'class' => 'form-control',
                                                'placeholder' => $this->lang->line('landline')
                                            );
                                            echo form_input($landline);
                                            ?>
                                        </div>
                                        <div class="form-group col-md-12 text-right">
                                            <button type="button" id="" class="btn btn-primary btn-next">Next</button>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="dob"><b>Project Assignments</b> (of last 05 years) :
                                            </label>
                                            <table class="table table-responsive project_table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $this->lang->line('serial_no'); ?></th>
                                                        <th>Title of the project </th>
                                                        <th> Area of Project </th>
                                                        <th>Project Cost in lakhs </th>
                                                        <th>Assignment Details </th>
                                                        <th>Name of Client </th>
                                                        <th>Year of execution</th>
                                                        <th>Duration of the project </th>
                                                        <th>Completion Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="default_row" data-id="1">
                                                        <td class="dynamic">1</td>
                                                        <td><?php
                                                            $project_title = array(
                                                                'name' => 'project_title[]', 'class' => 'form-control',
                                                                'placeholder' => 'Title of the project'
                                                            );
                                                            echo form_input($project_title);
                                                            ?>
                                                        </td>
                                                        <td><?php
                                                            echo  form_dropdown(
                                                                array('name' => 'area_of_project[]', 'class' => 'form-control'),
                                                                isset($AreaLIst) ? $AreaLIst : array('' => '--Select Area of Project --'),
                                                                ''
                                                            );
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $project_cost = array('name' => 'project_cost[]', 'class' => 'form-control',        'placeholder' => 'Project Cost  ');
                                                            echo form_input($project_cost);
                                                            ?>
                                                        </td>
                                                        <td><?php
                                                            $assignment_details = array(
                                                                'name' => 'assignment_details[]', 'class' => 'form-control',
                                                                'placeholder' => 'Assignment Details'
                                                            );
                                                            echo form_input($assignment_details);
                                                            ?>
                                                        </td>
                                                        <td> <?php
                                                                $name_of_cient = array(
                                                                    'name' => 'name_of_cient[]', 'class' => 'form-control',
                                                                    'placeholder' => 'Name of Client'
                                                                );
                                                                echo form_input($name_of_cient);
                                                                ?>
                                                        </td>
                                                        <td> <?php
                                                                $year_of_execution = array(
                                                                    'name' => 'year_of_execution[]', 'class' => 'year_of_execution form-control',
                                                                    'placeholder' => 'Year of execution '
                                                                );
                                                                echo form_input($year_of_execution);
                                                                ?>
                                                        </td>
                                                        <td><?php
                                                            $duration_of_project = array(
                                                                'name' => 'duration_of_project[]', 'class' => 'form-control',
                                                                'placeholder' => 'Duration of the project'
                                                            );
                                                            echo form_input($duration_of_project);
                                                            ?>
                                                        </td>
                                                        <td> <?php
                                                                $completion_status = array(
                                                                    'name' => 'completion_status[]',  'class' => 'form-control',
                                                                    'placeholder' => 'Completion Status'
                                                                );
                                                                echo form_input($completion_status);
                                                                ?>
                                                        </td>
                                                        <td><span class="deleterow"><i class="fa fa-trash"></i></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="8"></td>
                                                        <td><span class="btn btn-primary" id="addrow">Add Row</span>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Mention full detail if you are registered with any other Govt.
                                                Department/organizations/agency </label>
                                            <table class="table table-bordered agency_table">
                                                <thead>
                                                    <tr>
                                                        <th> S. No.</th>
                                                        <th> Name of Govt. Department/organizations/agency</th>
                                                        <th> Year of Registration </th>
                                                        <th> No. of Projects executed</th>
                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="dynamic">1</td>
                                                        <td> <input type="text" name="department_name[]" value=""
                                                                class="form-control"
                                                                placeholder="Name of Govt. Department/organizations/agency">
                                                        </td>
                                                        <td> <input type="text" name="registration_year[]" value=""
                                                                class="form-control registration_year"
                                                                placeholder=" Year of Registrations">
                                                        </td>
                                                        <td> <input type="text" name="no_of_project_reg[]" value=""
                                                                class="form-control"
                                                                placeholder=" No. of Projects executed">
                                                        </td>
                                                        <td><span class="deleterow"><i class="fa fa-trash"></i></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5" class="text-right"><span class="btn btn-primary"
                                                                id="addagencyrow">Add
                                                                Row</span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>


                                        </div>
                                        <div class="form-group col-md-12 text-right">
                                            <button type="button" class="btn btn-primary btn-prev">Previous</button>
                                            <button type="button" class="btn btn-primary btn-next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="attachment" role="tabpanel"
                                    aria-labelledby="attachment-tab">
                                    <div class="row">

                                        <div class="form-group col-md-12"> <label for="">Self certified documents in
                                                support of their credential</label></div>

                                        <div class="form-group col-md-12">
                                            <label for="profile_attachment">Complete Profile of the Firm (Approx. 50
                                                pages need to upload)</label>
                                            <input type="file" accept="application/pdf" name="profile_attachment" id="profile_attachment"
                                                class="form-control" placeholder="">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="work_attachment">Photocopies of work order, office order,
                                                partnership deed, completion
                                                certificate, whom so ever or proof documents in support of nature of
                                                work
                                                especially environmental related fields. (Max. 200 pages need to
                                                upload)</label>
                                            <input type="file" accept="application/pdf"  name="work_attachment" id="work_attachment"
                                                class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="balencesheet_attachment"> Copies of Balance sheet for last
                                                preceding three years. (Approx. 20 pages need
                                                to upload)</label>
                                            <input type="file" accept="application/pdf"  name="balencesheet_attachment"
                                                id="balencesheet_attachment" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="article_attachment"> Copies of article
                                                association/registration of the Firm/Company.(Approx. 60
                                                pages need to upload)</label>
                                            <input type="file" accept="application/pdf"  name="article_attachment" id="article_attachment"
                                                class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="taxcertificate_attachment">Copies of valid and up-to-date
                                                Income Tax and Sales Tax Clearance
                                                Certificates. (Approx. 20 pages need to upload)</label>
                                            <input type="file" accept="application/pdf"  name="taxcertificate_attachment"
                                                id="taxcertificate_attachment" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="staff_attachment">List of Core Staff with CV (Approx. 150
                                                pages need to upload) </label>
                                            <input type="file" accept="application/pdf"  name="staff_attachment" id="staff_attachment"
                                                class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms_condition" type="checkbox"
                                                    id="terms_condition">
                                                <label class="form-check-label" for="gridCheck">
                                                    I hereby declare that the statement filled in my application are
                                                    true and
                                                    correct and nothing has been hidden.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 text-right">
                                            <button type="button" class="btn btn-primary btn-prev">Previous</button>
                                            <button type="button" class="btn btn-primary btn-next">Next</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">

                                    <div class="form-group">
                                        <div class="form-check">

                                            <label class="form-check-label" for="gridCheck">
                                                <?php $siteDetails = getSiteDetails();  ?>
                                                <b> Online Fees : </b>
                                                <br>
                                                <?php echo $siteDetails->account_details;?>
                                               

                                          </label>
                                            <p>
                                                <label for="Transaction_id">Transaction Id</label>
                                            </p>
                                            <?php
                                            $tnx_id = array(
                                                'name' => 'tnx_id', 'id' => 'tnx_id', 'class' => 'form-control',
                                                'placeholder' => $this->lang->line('tnx_id')
                                            );
                                            echo form_input($tnx_id);
                                            ?>

                                        </div>
                                    </div>



                                    <div class="form-group col-md-12 text-right">
                                        <button type="button" class="btn btn-primary btn-prev">Previous</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden" style="display:none">
    <table>
        <tr id="default_row_view">
            <td class="dynamic">1</td>
            <td><?php
                $project_title = array(
                    'name' => 'project_title[]', 'class' => 'form-control',
                    'placeholder' => 'Title of the project'
                );
                echo form_input($project_title);
                ?></td>
            <td><?php
                echo  form_dropdown(
                    array('name' => 'area_of_project[]', 'class' => 'form-control'),
                    isset($AreaLIst) ? $AreaLIst : array('' => '--Select Area of Project --'),
                    ''
                );
                ?></td>
            <td>
                <?php
                $project_cost = array(
                    'name' => 'project_cost[]', 'class' => 'form-control',
                    'placeholder' => 'Project Cost  '
                );
                echo form_input($project_cost);
                ?>
            </td>
            <td><?php
                $assignment_details = array(
                    'name' => 'assignment_details[]', 'class' => 'form-control',
                    'placeholder' => 'Assignment Details'
                );
                echo form_input($assignment_details);
                ?></td>
            <td> <?php
                    $name_of_cient = array(
                        'name' => 'name_of_cient[]', 'class' => 'form-control',
                        'placeholder' => 'Name of Client'
                    );
                    echo form_input($name_of_cient);
                    ?></td>
            <td> <?php
                    $year_of_execution = array(
                        'name' => 'year_of_execution[]', 'class' => 'form-control year_of_execution',
                        'placeholder' => 'Year of execution '
                    );
                    echo form_input($year_of_execution);
                    ?></td>
            <td><?php
                $duration_of_project = array(
                    'name' => 'duration_of_project[]', 'class' => 'form-control',
                    'placeholder' => 'Duration of the project'
                );
                echo form_input($duration_of_project);
                ?>
            </td>
            <td> <?php
                    $completion_status = array(
                        'name' => 'completion_status[]', 'class' => 'form-control',
                        'placeholder' => 'Completion Status'
                    );
                    echo form_input($completion_status);
                    ?></td>

        </tr>

        <tr id="default_agency_row">
            <td class="dynamic">1</td>
            <td> <?php
                    $department_name = array(
                        'name' => 'department_name[]',  'class' => 'form-control',
                        'placeholder' => 'Name of Govt. Department/organizations/agency'
                    );
                    echo form_input($department_name);
                    ?></td>
            <td> <?php
                    $registration_year = array(
                        'name' => 'registration_year[]',  'class' => 'form-control registration_year',
                        'placeholder' => 'Year of Registrations'
                    );
                    echo form_input($registration_year);
                    ?></td>
            <td> <?php
                    $no_of_project_reg = array(
                        'name' => 'no_of_project_reg[]',  'class' => 'form-control',
                        'placeholder' => ' No. of Projects executed'
                    );
                    echo form_input($no_of_project_reg);
                    ?></td>
        </tr>
    </table>


</div>

<?php $this->load->view('element/inc_footer_slider'); ?>
<script type="text/javascript"
    src="<?php echo base_url('webroot/'); ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url('webroot/'); ?>plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('webroot/'); ?>validation/dist/additional-methods.js"></script>

<script type="text/javascript">
//var jQuery = $.noConflict(true); // <- this
</script>
<script type="text/javascript">
jQuery(function() {

    jQuery('.year_of_execution').datepicker({
        format: "yyyy",
        viewMode: "years",
        autoclose: true,

    });

    jQuery('.registration_year').datepicker({
        format: "yyyy",
        viewMode: "years",
        autoclose: true,

    });

    jQuery("#addrow").click(function() {
        var rowhtml = jQuery("#default_row_view").html();
        jQuery(".project_table tbody").append("<tr>" + rowhtml +
            "<td><span class='deleterow'><i class='fa fa-trash'></i></span></td></tr>");

        var row = jQuery(".project_table tbody #default_row");
        var dynamicValue = $(row).find('.project_table tbody  .dynamic').text();
        dynamicValue = parseInt(dynamicValue);
        jQuery('.project_table tbody  .dynamic').each(function(idx, elem) {
            jQuery(elem).text(idx + 1);
        });
        jQuery('.year_of_execution').datepicker({
            format: "yyyy",
            viewMode: "years",
            autoclose: true,

        });
    });
    jQuery("#addagencyrow").click(function() {
        var rowhtml = jQuery("#default_agency_row").html();
        jQuery(".agency_table tbody").append("<tr>" + rowhtml +
            "<td><span class='deleterow'><i class='fa fa-trash'></i></span></td></tr>");

        var row = jQuery(".agency_table tbody #default_row");
        var dynamicValue = $(row).find('.agency_table tbody  .dynamic').text();
        dynamicValue = parseInt(dynamicValue);
        jQuery('.agency_table tbody  .dynamic').each(function(idx, elem) {
            jQuery(elem).text(idx + 1);
        });

        jQuery('.registration_year').datepicker({
            format: "yyyy",
            viewMode: "years",
            autoclose: true,

        });
    });

    jQuery(document).on('click', ".deleterow", function() {
        jQuery(this).parent().parent().remove();
        jQuery('.agency_table tbody .dynamic').each(function(idx, elem) {
            jQuery(elem).text(idx + 1);
        });
        jQuery('.project_table tbody .dynamic').each(function(idx, elem) {
            jQuery(elem).text(idx + 1);
        });
    });

    $.validator.addMethod("alphanumspace", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
    }, "Please enter character,number and space only.");
    $.validator.addMethod("alphanumspacedot", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9.\s]*$/.test(value);
    }, "Please enter character,number,dot(.) and space only.");


    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    var validator = jQuery("#frmProjectMonitoring").validate({
        rules: {

            consultancy_name: {
                required: true,
                alphanumspace: true,
                maxlength: 100
            },
            contact_name: {
                required: true,
                alphanumspace: true,
                maxlength: 100
            },
            phone_number: {
                required: true,
                digits: true,
                maxlength: 10
            },
            exp_year: {
                required: true,
                number: true,
                maxlength: 100
            },
            specialization: {
                required: true,
                alphanumspace: true,
                maxlength: 100
            },
            tournover_year: {
                required: true,
                number: true,
                maxlength: 100
            },
            no_of_core_staff: {
                required: true,
                digits: true,
                maxlength: 100
            },
            address: {
                required: true,
                alphanumspace: true,
                maxlength: 100
            },
            city: {
                required: true,
                alphanumspace: true,
                maxlength: 100
            },
            state: {
                required: true,
                alphanumspace: true,
                maxlength: 100
            },
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            },
            emailid: {
                required: true,
                email: true,
                //   alphanumspace: true,
                maxlength: 100,
                remote: function() {
                    var checkit = {
                        type: "POST",
                        url: "<?php echo base_url(); ?>/ProjectMonitoring/VerifyEmail",
                        data: {
                            emailid: $('[id$=emailid]').val()
                        },
                    };

                    return checkit;
                }
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            landline: {
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            terms_condition: {
                required: true,
            },
            'project_title[]': {
                required: true,
            },
            'area_of_project[]': {
                required: true,
            },
            'assignment_details[]': {
                required: true,
            },
            'name_of_cient[]': {
                required: true,
            },
            'project_cost[]': {
                required: true,
            },
            'year_of_execution[]': {
                required: true,
            },
            'duration_of_project[]': {
                required: true,
            },
            'completion_status[]': {
                required: true,
            },
            'department_name[]': {
                required: true,
            },
            'no_of_project_reg[]': {
                required: true,
            },
            'registration_year[]': {
                required: true,
            },
            profile_attachment: {
                required: true,
                extension: 'PDF|pdf',
                filesize: 5242880 //1024*1024*25
            },
            work_attachment: {
                required: true,
                extension: 'PDF|pdf',
                filesize: 5242880 //1024*1024*25
            },
            balencesheet_attachment: {
                required: true,
                extension: 'PDF|pdf',
                filesize: 5242880 //1024*1024*25
            },
            article_attachment: {
                required: true,
                extension: 'PDF|pdf',
                filesize: 5242880 //1024*1024*25
            },
            taxcertificate_attachment: {
                required: true,
                extension: 'PDF|pdf',
                filesize: 5242880 //1024*1024*25
            },
            staff_attachment: {
                required: true,
                extension: 'PDF|pdf',
                filesize: 5242880 //1024*1024*25
            },
            tnx_id: {
                required: true,
                digits: true,
            },
        },
        messages: {
            emailid: {
                remote: "Email is already exists"
            }
        },
        checkForm: function() {
            this.prepareForm();
            for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
                if (this.findByName(elements[i].name).length != undefined && this.findByName(
                        elements[i].name).length > 1) {
                    for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                        this.check(this.findByName(elements[i].name)[cnt]);
                    }
                } else {
                    this.check(elements[i]);
                }
            }
        }
    });

    jQuery(".btn-next").click(function() {
        var tab = $(".tab-pane:visible");
        var valid = true;
        $('input', tab).each(function(i, v) {
            valid = validator.element(v) && valid;
        });
        $('textarea', tab).each(function(i, v) {
            valid = validator.element(v) && valid;
        });
        $('select', tab).each(function(i, v) {
            valid = validator.element(v) && valid;
        });
        if (!valid) {
            return;
        }
        var active = jQuery('.nav-tabs  a.current');
        active.next().removeClass('disabled');
        active.removeClass("current");
        $(".active").removeClass("active");
        active.next().addClass('current');
        active.addClass("done");
        $(".current").trigger("click");

    });
    $(".btn-prev").click(function(e) {
        var active = $('.nav-tabs a.current');
        active.prev().removeClass('done');
        active.removeClass("current");
        active.prev().addClass('current');
        //active.addClass("disabled");
        $(".active").removeClass("active");
        $(".current").trigger("click");

    });
});
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
    var img_path = "<?php echo site_url() . 'uploads/captcha/'; ?>";
    jQuery('#recap').on('click', function() {
        jQuery.get("<?php echo site_url('manage/Authuser/loadcaptcha'); ?>", function(data) {
            jQuery("#captchaimage").html('<img src="' + img_path + data +
                '" height="45px" width="150px">');
        });
    });
});
function nextTab(elem) {
    $(elem).next().find('a.step').trigger("click");
}
function prevTab(elem) {
    $(elem).prev().find('a.step').click();
}
</script>