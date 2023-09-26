$(function () {

    $("#table_sislo_vaga").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_site_vaga",
            "type": "POST"
        }        
    });

});