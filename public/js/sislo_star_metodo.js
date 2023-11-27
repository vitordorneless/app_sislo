$(function () {

    $("#table_star_metodos").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_star_metodo",
            "type": "POST"
        }        
    });

});