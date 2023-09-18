$(function () {

    $("#table_sislo_vagas").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_vagas",
            "type": "POST"
        }        
    });

});