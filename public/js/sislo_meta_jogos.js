$(function () {

    $("#table_meta_jogos").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,
        "searching": true,
        "ordering": true,
        "ajax": {
            "url": BASE_URL + "ajax_list_meta_jogos",
            "type": "POST"
        }
    });

});