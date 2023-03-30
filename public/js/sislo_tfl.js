$(function () {

    $("#table_sislo_tfl").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_tfl",
            "type": "POST"
        }        
    });

});