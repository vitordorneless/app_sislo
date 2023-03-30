$(function () {

    $("#table_sislo_proteges").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_protege",
            "type": "POST"
        }        
    });

});