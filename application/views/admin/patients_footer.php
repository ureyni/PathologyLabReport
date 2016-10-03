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
<!-- Crud -->
<script src="/assets/dist/js/crud.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>
<?php if (isset($javascript_paths)){
     foreach ($javascript_paths as $jspath) {
         echo "<script src=".$jspath."></script>";
     }
} ?>
<script>    
var PatientTable;

    var cfgform = {
        insButtonid: 'btnPatientSave', //insert select id
        uptButtonid: 'btnPatientUpdate', //update select id
        delButtonid: 'btnPatientDel', //delete select id
        formid: 'frmPatient', //form id
        IdName: 'patients_id', //form id
        endpoint: '/patients/patientcrud'// ajax endpoint 
    };

    PatientTable = $('#PatientTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/patients/getpatientList",
        "columns": [
            {"title": "<?= $this->lang->line('patientid', FALSE) ?>","data":"patients_id"},
            {"title": "<?= $this->lang->line('fullname', FALSE) ?>","data":"fullname"},
            {"title": "<?= $this->lang->line('sex', FALSE) ?>","data":"sex"},
            {"title": "<?= $this->lang->line('age', FALSE) ?>","data":"age"},
            {"title": "<?= $this->lang->line('email', FALSE) ?>","data":"email"},
            {"title": "<?= $this->lang->line('phone', FALSE) ?>","data":"phone"},
            {"title": "<?= $this->lang->line('patientcode', FALSE) ?>","data":"code"},
            {"title": "<?= $this->lang->line('user_name', FALSE) ?>","data":"username"}
        ]
    });


    $('#PatientTable tbody').on('click', 'tr', function () {
        $('#frmPatient #patients_id').val($(this).children("td:first").text());
        selectAjax(cfgform);
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            PatientTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    //$("#frmStudent #BirtDay").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
    //main form
    formAjax(cfgform, PatientTable);
</script>
</body>
</html>