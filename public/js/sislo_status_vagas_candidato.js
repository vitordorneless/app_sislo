$(function () {

    $("#table_sislo_vagas_candidato").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_vagas_candidato",
            "type": "POST"
        }        
    });

});