$(function () {

    $("#table_sislo_milionarias").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_milionaria",
            "type": "POST"
        }        
    });

});