</section>
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.3
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </div>
    <!-- /.container -->
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/plugins/fastclick/fastclick.js"></script>

<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Crud -->
<script src="/assets/dist/js/crud.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>
<?php
if (isset($javascript_paths)) {
    foreach ($javascript_paths as $jspath) {
        echo "<script src=" . $jspath . "></script>";
    }
}
?>
<script>
    var ReportTable, ReportDetailTable;
    var patient_reports_id = 0;
    $('#btnReportToPdf').click(function () {
        $.post("/reports/converttopdf", {'report_id': patient_reports_id})
                .done(function (data) {
                    if (typeof data.pdffile != "undefined") {
                        $('#displayPdf').html("<a href='/displaypdf?pdf=" + data.pdffile + "' target='_blank'>Display Pdf</a>");
                    }
                   // alert(data.msg);
                    setErrors(data);
                }, "json");

    });

    $('#btnReportToEmail').click(function () {
        $.post("/reports/senttopdf", {'report_id': patient_reports_id,
                                      'email': $("#email").val()})
                .done(function (data) {
                    alert(data.msg);
                    setErrors(data);
                }, "json");

    });




    ReportTable = $('#ReportTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/reports/getpatientreportList",
        "columns": [
            {"title": "<?= $this->lang->line('reportid', FALSE) ?>", "data": "patient_reports_id"},
            {"title": "<?= $this->lang->line('reportname', FALSE) ?>", "data": "report_name"},
            {"title": "<?= $this->lang->line('reportdate', FALSE) ?>", "data": "report_date"},
        ]
    });


    $('#ReportTable tbody').on('click', 'tr', function () {
        patient_reports_id = $(this).children("td:first").text();
        $.post("/reports/getpatientreportdetailList", {'report_id': patient_reports_id})
                .done(function (data) {
                    $("#divPatientDetail").html('');
                    if (typeof data[0] != "undefined") {
                        $("#email").val(data[0].email);
                        $("#divPatientDetail").append('<h4 class="box-title">Name : ' + data[0].fullname +
                                ' Age : ' + data[0].age +
                                ' Gender : ' + data[0].sex +
                                ' E-Mail : ' + data[0].email +
                                ' Phone : ' + data[0].phone +
                                '</h4>');
                        $("#divPatientDetail").append('<h4 class="box-title">Rapor Name : ' + data[0].report_name + '</h4>');
                        $("#divPatientDetail").append('<div class="box-header with-border"><i class="fa fa-text-width"></i><h3 class="box-title">Report Detail</h3></div>');
                        for (i = 0; i < data.length; i++) {
                            $("#divPatientDetail").append('<h4 class="box-title">Test Name : ' + data[i].test_name + '</h4>');
                            $("#divPatientDetail").append(data[i].test_value);
                        }
                        setErrors(data);
                    } else
                        $("#divPatientDetail").html('There is not found report details');
                }, "json");
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            ReportTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

</script>
</body>
</html>