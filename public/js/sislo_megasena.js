$(function () {

    $("#table_megasenas").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_megasena",
            "type": "POST"
        }        
    });

});