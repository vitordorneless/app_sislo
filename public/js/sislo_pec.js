$(function () {

    $("#table_sislo_PEC").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_pec",
            "type": "POST"
        }        
    });

});