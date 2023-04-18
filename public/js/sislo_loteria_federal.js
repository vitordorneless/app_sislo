$(function () {

    $("#table_sislo_loteria_federal").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_loteria_federal",
            "type": "POST"
        }        
    });

});