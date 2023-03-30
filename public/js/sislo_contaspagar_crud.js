$(document).ready(function () {
    $('#referencia').mask('00/0000');
    $('.convert_money').mask('#.##0,00', {reverse: true});

    $("#sislo_contaapagar").validate({
        messages: {
            vencimento: {
                required: 'Campo Obrigatório!!!'
            },
            valor_pagar: {
                required: 'Campo Obrigatório!!!'
            },
            referencia: {
                required: 'Campo Obrigatório!!!'
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "sislo_contaapagar",
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
                    var conteudo = response === '1' ? success_note('Conta') + buttonBack('sislo_contas_pagar') : error_note('Conta') + buttonBack('sislo_contas_pagar');
                    $('#sislo_contaapagar')[0].reset();
                    $("#conteudo").empty();
                    if (response === '1') {
                        alerta('success', 'Sucesso', 'Dados Salvos!!');
                    } else {
                        alerta('error', 'Aconteceu um erro!', 'Tente Novamente!!');
                    }
                    $('html,body').animate({scrollTop: document.body.scrollHeight}, "fast");
                    $("#conteudo").html(conteudo);
                }
            });
            return false;
        }
    });

});