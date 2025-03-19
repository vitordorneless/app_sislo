$(document).ready(function () {

    $('#valor_bolao').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });

    $('#tarifa').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });

    $('#valor_tarifa').maskMoney({
        alloNegative: true,
        thousands: ".",
        decimal: ",",
        precision: 2
    });

    $("#sislo_comissao_jogos_bolao_loterias").validate({
        messages: {
            dia_inicial: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "ajax_save_formbolaoonline",
                dataType: "html",
                data: $(form).serialize(),
                beforeSend: function () {
                    clearErrors();
                    $("#conteudo").html(loadingImg("Carregando..."));
                },
                error: function (e) {
                    console.log(e);
                    alerta('error', e, e);
                },
                success: function (response) {
                    clearErrors();
                    var conteudo = response === '1' ? success_note('Comissão de jogos BOLÃO') + buttonBack('sislo_comissao_jogosboloes_online') : error_note('Comissão de jogos BOLÃO') + buttonBack('sislo_comissao_jogosboloes_online');
                    $('#sislo_comissao_jogos_bolao_loterias')[0].reset();
                    $("#conteudo").empty();
                    if (response === '1') {
                        alerta('success', 'Sucesso', 'Dados Salvos!!');
                    } else {
                        alerta('error', 'Aconteceu um erro!', 'Tente Novamente!!');
                    }
                    $('html,body').animate({ scrollTop: document.body.scrollHeight }, "fast");
                    $("#conteudo").html(conteudo);
                }
            });
            return false;
        }
    });
});