$(function () {

    $("#table_sislo_des_PEC").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true,        
        "ajax": {
            "url": BASE_URL + "ajax_list_des",
            "type": "POST"
        }        
    });

});