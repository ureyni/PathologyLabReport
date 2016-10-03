<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h1 class="box-title">Report Info</h1>
                </div>
                <div class="box-body">
                    <form id="frmReport" class="form-horizontal">
                        <div class="form-horizontal col-sm-6">
                            <table id="ReportTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><?= $this->lang->line('reportid', FALSE) ?></th>
                                        <th><?= $this->lang->line('reportname', FALSE) ?></th>
                                        <th><?= $this->lang->line('reportdate', FALSE) ?></th>
                                    </tr>

                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-horizontal col-sm-3">
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr><td>
                                            <button type="button" id="btnReportToPdf" class="btn btn-block btn-success btn-lg pull-right"><i class="fa fa-fw fa-file-pdf-o"></i>&nbsp;&nbsp;Convert To Pdf</button>
                                        </td></tr>
                                    <tr><td>
                                            <button type="button" id="btnReportToEmail" class="btn btn-block btn-success btn-lg pull-right"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Sent E-Mail</button>
                                        </td></tr>
                                    <tr><td>
                                                <label for="text"><?= $this->lang->line('email', FALSE) ?></label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="<?= $this->lang->line('sentemail', FALSE) ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div id="displayPdf"></div></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>    
                    </form>
                    
                </div>
                <div id="divErrors" name="divErrors"></div>
            </div>
            <div class="box box-default">
                <div class="box-body">
                    <div class="form-horizontal col-sm-12">
                        <h3 class="box-title"> <?= $this->config->item('LAB_NAME'); ?></h3>
                        <h5 class="box-title"> <?= $this->config->item('LAB_ADDRESS_1'); ?></h5>
                        <h5 class="box-title"> <?= $this->config->item('LAB_ADDRESS_2'); ?></h5>
                        <h5 class="box-title"> E-mail:<?= $this->config->item('LAB_EMAIL') . ' Phone:' . $this->config->item('LAB_PHONE'); ?></h5>
                    </div>
                    <div id="divPatientDetail" class="form-horizontal col-sm-12">
                    </div>
                    <div id="divReportDetail" class="form-horizontal col-sm-12">
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
    </div>


</section>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->