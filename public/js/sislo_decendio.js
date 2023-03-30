$(document).ready(function () {
    $("#sislo_decendio_list").validate({
        messages: {
            mes: {
                required: 'Campo Obrigatório!!!'
            },
            ano: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "ajax_list_decendio",
                dataType: "json",
                data: $(form).serialize(),
                beforeSend: function () {
                    clearErrors();
                    $("#antes").html(loadingImg("Carregando..."));
                },
                error: function (e) {
                    console.table(e);
                    alerta('error', e, e);
                },
                success: function (datas) {
                    clearErrors();
                    $("#antes").empty();
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    $("#table_sislo_decendio_list").DataTable({
                        oLanguage: DATATABLE_PTBR,
                        destroy: true,
                        searching: false,
                        ordering: false,
                        data: datas.data
                    });
                }
            });
            return false;
        }
    });
});