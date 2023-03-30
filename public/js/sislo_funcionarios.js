$(function () {

    $("#table_sislo_funcionarios").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_funcionarios",
            "type": "POST"
        }        
    });

});