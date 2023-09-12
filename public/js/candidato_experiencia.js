$(document).ready(function () {    
    
    $("#table_sislo_experiencia").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,
        "searching": true,
        "ordering": true,
        "ajax": {
            "url": BASE_URL + "ajax_list_candidato_experiencia",
            "type": "POST"
        }
    });
});