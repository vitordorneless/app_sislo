$(function () {

    $("#table_timemania_time_coracaos").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_timemania_time_coracao",
            "type": "POST"
        }        
    });

});