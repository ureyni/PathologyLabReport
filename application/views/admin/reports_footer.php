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
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script src="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        var editor = CKEDITOR.replace('test_value');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

        editor.on('change', function (evt) {
            // getData() returns CKEditor's HTML content.
            $("#test_value").val(evt.editor.getData());
        });

    });
</script>
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
    $("#report_date").datepicker({'format': 'yyyy-mm-dd'});
    $("#date_of_sample_received").datepicker({'format': 'yyyy-mm-dd'});

    var PatientTableTrClick = function () {
        var patient_id = $(this).children("td:first").text();
        $('#frmReport #patient_id').val(patient_id);
        $('#spnpatientname').html("<b> - Selected Patient : " + $(this).find("td:eq(1)").text() + "</b>");
        ReportTable.ajax.url("/reports/getreportList?patient_id=" + patient_id).load();
    }

    $('#btnReportSend').click(function () {
        $.post("/labreports/reportsendpatient", {'reports_id':$('#frmReport #patient_reports_id').val()})
                .done(function (data) {
                    alert(data.msg);
                    setErrors(data);
                }, "json");
                
    });
            
    $('#patients_search').click(function () {
        var tableid = 'tblPatientsListTable';
        var posdata = $('#frmPatientSearch').serializeArray();
        $.post("/reports/patient_search", posdata)
                .done(function (data) {
                    $("#" + tableid + " > tbody").html("");
                    $.each(data.data, function (key, datain) {
                        $("#" + tableid + " tbody").append($("<tr/>"));
                        $.each(datain, function (key, value) {
                            $("#" + tableid + " tbody tr:last").append("<td>" + value + "</td>");
                        });
                    });
                    $("#" + tableid + " > tbody > tr").click(PatientTableTrClick);
                    setErrors(data);


                }, "json");
    });


    var cfgformReport = {
        insButtonid: 'btnReportSave', //insert select id
        uptButtonid: 'btnReportUpdate', //update select id
        delButtonid: 'btnReportDel', //delete select id
        formid: 'frmReport', //form id
        IdName: 'patient_reports_id', //form id
        endpoint: '/labreports/reportcrud'// ajax endpoint 
    };

    var cfgformReportDetail = {
        insButtonid: 'btnReportDetailSave', //insert select id
        uptButtonid: 'btnReportDetailUpdate', //update select id
        delButtonid: 'btnReportDetailDel', //delete select id
        formid: 'frmReportDetail', //form id
        IdName: 'patient_report_details_id', //form id
        ckEditor:  ['test_value'],
        endpoint: '/labreports/reportdetailcrud'// ajax endpoint 
    };

    ReportTable = $('#ReportTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/reports/getreportList",
        "columns": [
            {"title": "<?= $this->lang->line('reportid', FALSE) ?>", "data": "patient_reports_id"},
            {"title": "<?= $this->lang->line('patientname', FALSE) ?>", "data": "fullname"},
            {"title": "<?= $this->lang->line('reportname', FALSE) ?>", "data": "report_name"},
            {"title": "<?= $this->lang->line('reportdate', FALSE) ?>", "data": "report_date"},
            {"title": "<?= $this->lang->line('user_name', FALSE) ?>", "data": "username"}
        ]
    });

    ReportDetailTable = $('#ReportDetailTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/reports/getreportdetailList",
        "columns": [
            {"title": "<?= $this->lang->line('patient_report_details_id', FALSE) ?>", "data": "patient_report_details_id"},
            {"title": "<?= $this->lang->line('patientname', FALSE) ?>", "data": "fullname"},
            {"title": "<?= $this->lang->line('reportname', FALSE) ?>", "data": "report_name"},
            {"title": "<?= $this->lang->line('test_name', FALSE) ?>", "data": "test_name"},
            {"title": "<?= $this->lang->line('test_value', FALSE) ?>", "data": "test_value"},
            {"title": "<?= $this->lang->line('user_name', FALSE) ?>", "data": "username"}
        ]
    });


    $('#ReportTable tbody').on('click', 'tr', function () {
        var patient_reports_id = $(this).children("td:first").text();
        $('#frmReport #patient_reports_id').val(patient_reports_id);
        $('#frmReportDetail #patient_reports_id').val(patient_reports_id);
        ReportDetailTable.ajax.url("/reports/getreportdetailList?report_id=" + patient_reports_id).load();
        selectAjax(cfgformReport);
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            ReportTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#ReportDetailTable tbody').on('click', 'tr', function () {
        $('#frmReportDetail #patient_report_details_id').val($(this).children("td:first").text());
        selectAjax(cfgformReportDetail);
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            ReportDetailTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    //main form
    formAjax(cfgformReport, ReportTable);
    formAjax(cfgformReportDetail, ReportDetailTable);
</script>
</body>
</html>