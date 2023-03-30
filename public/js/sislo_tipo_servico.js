$(function () {

    $("#table_sislo_servico").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_servico",
            "type": "POST"
        }        
    });

});