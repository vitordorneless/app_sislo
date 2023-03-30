$(function () {

    $("#table_tipos_convenio").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_tiposconvenio",
            "type": "POST"
        }        
    });

});