$(function () {

    $("#table_sislo_dec_servicos_list").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_servicos_dec",
            "type": "POST"
        }        
    });

});