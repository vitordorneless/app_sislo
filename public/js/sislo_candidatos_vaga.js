$(document).ready(function () {

    $('.convert_money').mask('#.##0,00', {reverse: true});

    $("#table_sislo_candidatos").DataTable({
        "oLanguage": DATATABLE_PTBR,
        "autoWidth": true,        
        "searching": true,
        "ordering": true        
    });
});