$(function () {

    $("#table_sislo_lotericas").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_lotericas",
            "type": "POST"
        }        
    });

});