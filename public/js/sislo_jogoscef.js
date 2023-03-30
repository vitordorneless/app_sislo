$(function () {

    $("#table_jogoscefs").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_sislo_jogos_cef",
            "type": "POST"
        }        
    });

});