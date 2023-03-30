$(function () {

    $("#table_lotomanias").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_lotomania",
            "type": "POST"
        }        
    });

});