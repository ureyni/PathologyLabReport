<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="box box-info">
                <!-- form start -->
                <form id="frmPatientSearch" class="form-horizontal">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="patients" class="col-sm-2 control-label"><?= $this->lang->line('patientname', FALSE) ?></label>

                            <div class="col-sm-5">
                                <input class="col-xs-10" id="patientname" name="patientname" placeholder="<?= $this->lang->line('patientname_ph', FALSE) ?>" type="email">
                                <button type="button" id="patients_search" class="btn btn-info pull-left"><?= $this->lang->line('search', FALSE) ?></button>
                            </div>
                            <div class="col-sm-5">
                            <button type="button" id="btnReportSend" class="btn btn-info pull-right"><?= $this->lang->line('sentpatient', FALSE) ?></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="divErrors" name="divErrors"></div>
                    <table id="tblPatientsListTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?= $this->lang->line('patientid', FALSE) ?></th>
                                <th><?= $this->lang->line('fullname', FALSE) ?></th>
                                <th><?= $this->lang->line('sex', FALSE) ?></th>
                                <th><?= $this->lang->line('age', FALSE) ?></th>
                                <th><?= $this->lang->line('email', FALSE) ?></th>
                                <th><?= $this->lang->line('phone', FALSE) ?></th>
                            </tr>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="box box-default">
                <div class="box-header with-border" style="height: 16px;">
                    <h3 class="box-title">Report Info<span id="spnpatientname"></span></h3>
                </div>
                <div class="box-body">

                    <div class="box-body">
                        <form id="frmReport" class="form-horizontal">
                            <input type="hidden" id="patient_id" name="patient_id"  value=""/>
                            <input type="hidden" id="patient_reports_id" name="patient_reports_id"  value=""/>
                            <div class="form-horizontal col-sm-6">
                                <label for="reports" class="col-sm-6 control-label"><?= $this->lang->line('reportname', FALSE) ?></label>
                                <div class="input-group date col-sm-6">
                                    <input class="form-control pull-right" name="report_name" id="report_name" type="text" placeholder="<?= $this->lang->line('reportname_ph', FALSE) ?>">
                                </div>
                                <label for="reports" class="col-sm-6 control-label"><?= $this->lang->line('reportdate', FALSE) ?></label>
                                <div class="input-group date col-sm-6">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control pull-right" name="report_date" id="report_date" type="text">
                                </div>
                                <label class="col-sm-6 control-label"><?= $this->lang->line('reportsampledate', FALSE) ?></label>
                                <div class="input-group date col-sm-6" >
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control pull-left" id="date_of_sample_received"  name="date_of_sample_received" type="text">
                                </div>

                                <button type="button" id="btnReportDel" class="btn btn-info pull-right"><i class="glyphicon glyphicon-minus-sign"></i></button>
                                <button type="button" id="btnReportUpdate" class="btn btn-info pull-right"><i class="glyphicon glyphicon-edit"></i></button>
                                <button type="button" id="btnReportSave" class="btn btn-info pull-right"><i class="glyphicon glyphicon-plus-sign"></i></button>
                                <table id="ReportTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= $this->lang->line('reportid', FALSE) ?></th>
                                            <th><?= $this->lang->line('patientname', FALSE) ?></th>
                                            <th><?= $this->lang->line('reportname', FALSE) ?></th>
                                            <th><?= $this->lang->line('reportdate', FALSE) ?></th>
                                            <th><?= $this->lang->line('user_name', FALSE) ?></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <form id="frmReportDetail" class="form-horizontal">
                            <input type="hidden" id="patient_report_details_id" name="patient_report_details_id"  value=""/>
                            <input type="hidden" id="patient_reports_id" name="patient_reports_id"  value=""/>
                            <div class="form-horizontal col-sm-6">
                                <label for="text"><?= $this->lang->line('test_name', FALSE) ?></label>
                                <select class="form-control select2" name="test_types_id" id="test_types_id" style="width: 100%;">
                                    <?php
                                    $result = $this->db->select('test_types_id,test_name')->get("test_types");
                                    $rows = $result->result_array();
                                    foreach ($rows as $row) {
                                        print "<option value=\"{$row['test_types_id']}\">{$row['test_name']}</option>";
                                    }
                                    ?>    
                                </select>
                            </div>
                            <div class="form-horizontal col-sm-6">
                                <label for="text"><?= $this->lang->line('test_result', FALSE) ?></label>
                                <textarea id="test_value" name="test_value" rows="10" cols="40">
                                           test results
                                </textarea>
                                <button type="button" id="btnReportDetailDel" class="btn btn-info pull-right"><i class="glyphicon glyphicon-minus-sign"></i></button>
                                <button type="button" id="btnReportDetailUpdate" class="btn btn-info pull-right"><i class="glyphicon glyphicon-edit"></i></button>
                                <button type="button" id="btnReportDetailSave" class="btn btn-info pull-right"><i class="glyphicon glyphicon-plus-sign"></i></button>
                            </div>
                        </form>
                    </div>
                    <table id="ReportDetailTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?= $this->lang->line('patient_report_details_id', FALSE) ?></th>
                                <th><?= $this->lang->line('patientname', FALSE) ?></th>
                                <th><?= $this->lang->line('reportname', FALSE) ?></th>
                                <th><?= $this->lang->line('test_name', FALSE) ?></th>
                                <th><?= $this->lang->line('test_value', FALSE) ?></th>
                                <th><?= $this->lang->line('user_name', FALSE) ?></th>
                            </tr>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box box-default">


            </div>
            <!-- /.box-body -->
    </div>


</section>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->