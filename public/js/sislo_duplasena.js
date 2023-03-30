$(function () {

    $("#table_duplasenas").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_duplasena",
            "type": "POST"
        }        
    });

});