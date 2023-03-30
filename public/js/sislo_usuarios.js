$(function () {

    $("#table_sislo_usuarios").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_user",
            "type": "POST"
        }        
    });

});