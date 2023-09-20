$(function () {

    $("#table_sislo_candidato_vaga").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_candidato_vaga",
            "type": "POST"
        }        
    });

});