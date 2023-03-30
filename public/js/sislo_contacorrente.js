$(document).ready(function () {
    $("#list_contacorrente").validate({
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
                url: BASE_URL + "ajax_list_contacorrente",
                dataType: "json",
                data: $(form).serialize(),
                beforeSend: function () {
                    clearErrors();
                    $("#antes").html(loadingImg("Carregando..."));
                },
                error: function (e) {
                    console.log(e);
                    alerta('error', e, e);
                },
                success: function (datas) {
                    clearErrors();
                    $("#antes").empty();
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    var tt = $("#table_sislo_contacorrente_list").DataTable({
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