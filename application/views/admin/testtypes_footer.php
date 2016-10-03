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
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        var editor = CKEDITOR.replace('explain');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
        
        editor.on('change', function (evt) {
            // getData() returns CKEditor's HTML content.
            $("#explain").val(evt.editor.getData());
        });
        
    });
</script>

<?php
if (isset($javascript_paths)) {
    foreach ($javascript_paths as $jspath) {
        echo "<script src=" . $jspath . "></script>";
    }
}
?>
<script>
    var TestTable;

    var cfgform = {
        insButtonid: 'BtnTestTSave', //insert select id
        uptButtonid: 'BtnTestTUpdate', //update select id
        delButtonid: 'BtnTestTDel', //delete select id
        formid: 'frmTestTypes', //form id
        IdName: 'test_types_id', //form id
        ckEditor:  ['explain'],
        endpoint: '/tests/testTcrud'// ajax endpoint 
    };

    TestTable = $('#TestTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax": "/tests/getTestTList",
        "columns": [
            {"title": "<?= $this->lang->line('test_types_id', FALSE) ?>", "data": "test_types_id"},
            {"title": "<?= $this->lang->line('test_name', FALSE) ?>", "data": "test_name"},
            {"title": "<?= $this->lang->line('test_explain', FALSE) ?>", "data": "explain"},
            {"title": "<?= $this->lang->line('user_name', FALSE) ?>", "data": "fullname"},
        ]
    });


    $('#TestTable tbody').on('click', 'tr', function () {
        $('#frmTestTypes #test_types_id').val($(this).children("td:first").text());
        selectAjax(cfgform);
        
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            TestTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        
    });


    //$("#frmStudent #BirtDay").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
    //main form
    formAjax(cfgform, TestTable);
</script>
</body>
</html>