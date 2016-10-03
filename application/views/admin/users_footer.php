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
var UserTable;

    var cfgform = {
        insButtonid: 'BtnUserSave', //insert select id
        uptButtonid: 'BtnUserUpdate', //update select id
        delButtonid: 'BtnUserDel', //delete select id
        formid: 'frmUser', //form id
        IdName: 'user_id', //form id
        endpoint: '/users/Usercrud'// ajax endpoint 
    };

    UserTable = $('#UserTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/users/getuserList",
        "columns": [
            {"title": "<?= $this->lang->line('userid', FALSE) ?>","data":"user_id"},
            {"title": "<?= $this->lang->line('user_name', FALSE) ?>","data":"username"},
            {"title": "<?= $this->lang->line('fullname', FALSE) ?>","data":"fullname"},
            {"title": "<?= $this->lang->line('rolename', FALSE) ?>","data":"role_name"},
            {"title": "<?= $this->lang->line('email', FALSE) ?>","data":"email"},
            {"title": "<?= $this->lang->line('phone', FALSE) ?>","data":"phone"}
        ]
    });


    $('#UserTable tbody').on('click', 'tr', function () {
        $('#frmUser #user_id').val($(this).children("td:first").text());
        selectAjax(cfgform);
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            UserTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    //$("#frmStudent #BirtDay").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
    //main form
    formAjax(cfgform, UserTable);
</script>
</body>
</html>