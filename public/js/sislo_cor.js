$(function () {

    $("#table_sislo_cors").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_cor",
            "type": "POST"
        }        
    });

});