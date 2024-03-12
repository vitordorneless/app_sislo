$(document).ready(function () {

    $("#sislo_fechamento_caixa_outros_list").validate({
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
                url: BASE_URL + "ajax_list_fechamento_caixa_outros",
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
                    $("#sominha_pix").val(datas.sominha_pix);
                    $("#sominha_azulzinha").val(datas.sominha_azulzinha);
                    $("#sominha_outros").val(datas.sominha_outros);
                    $("#sominha_brinde").val(datas.sominha_brinde);
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    var tt = $("#table_sislo_fechamento_caixa_outros_list").DataTable({
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