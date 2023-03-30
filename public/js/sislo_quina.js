$(function () {

    $("#table_quinas").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_quina",
            "type": "POST"
        }        
    });

});