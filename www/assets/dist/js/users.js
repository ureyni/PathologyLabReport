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
