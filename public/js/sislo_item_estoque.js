$(function () {

    $("#table_item_estoque").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_item_estoque",
            "type": "POST"
        }        
    });

});