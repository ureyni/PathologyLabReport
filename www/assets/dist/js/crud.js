/*
 * Ajax Combo Box 
 */
function ChangeComboAjax(cfg) {

    $('#' + cfg.formid + ' #' + cfg.selectid).change(function () {
        $.ajaxSetup({async: false});
        $.post(cfg.endpoint, {value: this.value})
                .done(function (data) {
                    $('#' + cfg.formid + ' #' + cfg.changeid)
                            .find('option')
                            .remove()
                            .end();
                    $.each(data, function (key, value) {
                        $('#' + cfg.formid + ' #' + cfg.changeid).append($("<option/>", {
                            value: value.key,
                            text: value.value
                        }))
                    });
                }, "json");
        $.ajaxSetup({async: true});
    });

}

function fillComboAjax(cfg) {
    $.post(cfg.endpoint, {value: $('#' + cfg.formid + ' #' + cfg.selectid).val()})
            .done(function (data) {
                $('#' + cfg.formid + ' #' + cfg.changeid)
                        .find('option')
                        .remove()
                        .end();
                $.each(data, function (key, value) {
                    $('#' + cfg.formid + ' #' + cfg.changeid).append($("<option/>", {
                        value: value.key,
                        text: value.value
                    }))
                });
            }, "json");
}





/*
 * Table Fill
 */
function tableFill(tableid, data) {
    $("#" + tableid + " > thead").html("");
    $("#" + tableid + " > tbody").html("");
    $("#" + tableid + " > tfoot").html("");
    $("#" + tableid + " thead").append($("<tr/>"));
    $("#" + tableid + " tfoot").append($("<tr/>"));
    $.each(data.header, function (key, value) {
        $("#" + tableid + " thead tr:last").append("<th>" + value + "</th>");
        $("#" + tableid + " tfoot tr:last").append("<th>" + value + "</th>");
    });
    $.each(data.data, function (key, datain) {
        $("#" + tableid + " tbody").append($("<tr/>"));
        $.each(datain, function (key, value) {
            $("#" + tableid + " tbody tr:last").append("<td>" + value + "</td>");
        });
    });
    /*
     $('#' + tableid).DataTable({
     "paging": true,
     "lengthChange": false,
     "searching": false,
     "ordering": true,
     "info": true,
     "autoWidth": false
     });
     */
}

/*
 * @param {type} data result json from ajax
 * @returns {undefined}
 */

function setErrors(data) {
    if (typeof data.errors != "undefined") {
        var errors = '';
        if (Array.isArray(data.errors))
            for (index = 0; index < data.errors.length; index++) {
                errors += data.errors[index] + '</br>';

            }
        else
            errors = data.errors;
        $('#divErrors').html('<div class="alert alert-danger fade in">' +
                '<button data-dismiss="alert" class="close"><span>×</span></button>' +
                errors +
                '</div>');
    } else
        $('#divErrors').html('');
}

/*
 * Form Set Get 
 */
function formAjax(cfgform, tableObj) {
    $('#' + cfgform.insButtonid).click(function () {
        var posdata = $('#' + cfgform.formid).serializeArray();
        posdata.push({name: 'proc', value: 'save'});
        $.post(cfgform.endpoint, posdata)
                .done(function (data) {
                    if (data.id != '')
                        $('#' + cfgform.IdName).val(data.id);
                    tableObj.ajax.reload();
                    setErrors(data);
                }, "json");
    });
    $('#' + cfgform.uptButtonid).click(function () {
        var posdata = $('#' + cfgform.formid).serializeArray();
        posdata.push({name: 'proc', value: 'update'});
        $.post(cfgform.endpoint, posdata)
                .done(function (data) {
                    tableObj.ajax.reload();
                    setErrors(data);
                }, "json");
    });

    $('#' + cfgform.delButtonid).click(function () {
        var posdata = $('#' + cfgform.formid).serializeArray();
        posdata.push({name: 'proc', value: 'del'});
        $.post(cfgform.endpoint, posdata)
                .done(function (data) {
                    tableObj.ajax.reload();
                    $('#' + cfgform.formid + " input").filter(function () {
                        this.value = '';
                    });
                    setErrors(data);
                }, "json");
    });
}

function selectAjax(cfgform) {
    var posdata = $('#' + cfgform.formid).serializeArray();
    posdata.push({name: 'proc', value: 'select'});
    $.post(cfgform.endpoint, posdata)
            .done(function (data) {
                $.each(data.data, function (k, v) {
                    $.each(v, function (key, value) {
                        $('#' + cfgform.formid + ' #' + key).val(value);
                        if ($('#' + cfgform.formid + ' #' + key).is("select")) {

                            $('#' + cfgform.formid + ' #' + key).trigger("change");

                            //  alert(key + ":" +  $('#' + cfgform.formid + ' #' + key).val() + ":" + value);
                        }
                    });
                });
                if (typeof cfgform.ckEditor != "undefined")
                    for (i = 0; i < cfgform.ckEditor.length; i++)
                        CKEDITOR.instances[cfgform.ckEditor[i]].setData($("#" + cfgform.ckEditor[i]).val());

            }, "json");


}


   