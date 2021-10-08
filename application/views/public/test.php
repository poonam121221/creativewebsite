<?php $this->load->view('element/inc_breadcrum'); ?>

<div class="fontresize" id="content-section">
    <div class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="detail">
                       
                    </div>
                </div>
                <div class="col-md-9" id="print">
                            Front view check .................
                            data
                            <table>
                                <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>purpose</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($testList as $key => $value) {
                                            # code...

                                        echo '<tr><td>'.$value['name'].'</td>';
                                        echo '<td>'.$value['purpose'].'</td></tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('element/inc_footer_slider'); ?>
