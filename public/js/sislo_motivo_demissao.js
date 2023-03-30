$(function () {

    $("#table_sislo_motivo_demissaos").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_motivo_demissao",
            "type": "POST"
        }        
    });

});