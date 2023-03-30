$(function () {

    $("#table_sislo_ide_PEC").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_ide",
            "type": "POST"
        }        
    });

});